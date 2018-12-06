<?php

namespace Wildgame\Template;

/**
 * Replaces placeholders in a given string with the concrete values.
 * Allows comments that will be deleted from the string after rendering.
 * Also implements conditional printing of values.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Template {

    /**
     * @var string
     */
    protected $comment = "#\{\{\*\}\}.+\{\{\/\*\}\}#";

    /**
     * @var string
     */
    protected $conditional = "#\{\?[a-z]+\?\}#";

    /**
     * @param   string  $string
     * @param   array   $params
     *
     * @return  string
     */
    public function renderString(string $string, array $params) : string
    {
        // Higher tier tag handling (who can contain variables)
        $string = $this->renderConditionals($string, $params);

        // Simple variable printing. Must be done *last*
        $string = $this->renderVars($string, $params);

        return $string;
    }

    /**
     * Searches for plain var tags and replaces them with the concrete values
     * provided by the $params array.
     * Variable tags have the following syntax: {{variable}}.
     *
     * @param   string  $string
     * @param   array   $params
     *
     * @return  string
     */
    public function renderVars(string $string, array $params) : string
    {
        foreach ($params as $key => $value) {
            $string = str_replace('{{'.$key.'}}', $value, $string);
        }
        return $string;
    }

    /**
     * Searches for conditionals. If the condition is true, the brackets
     * surrounding the conditional are removed only. If it is false, the block
     * will be removed entirely.
     * Condition tags look like: {?condition?} Text {{var}} {?/condition?}
     *
     * @param   string  $string
     * @param   array   $params
     *
     * @return  string
     */
    private function renderConditionals(string $string, array $params) : string
    {
        // Find conditionals and their status. Put them into an array.
        $conditionals = [];
        preg_match_all($this->conditional, $string, $conditionals);

        // Loop through conditionals.
        foreach ($conditionals[0] as $condition)
        {
            // Clean conditional for checking
            $cleaned = str_replace(['?', '{', '}'], '', $condition);

            // Remove tags on true tags and on false entire block.
            if ($params[$cleaned] === true)
            {
                $tags = [$condition, '{?/'.$cleaned.'?}'];
                $string = str_replace($tags, '', $string);
            } else {
                $regex = '#\{\?'.$cleaned.'\?\}.+\{\?\/'.$cleaned.'\?\}#';
                $string = preg_replace($regex, '', $string);
            }
        }

        return $string;
    }

    /**
     * Searches for comment tags in the given string and removes them.
     * Comments are wrapped in the {{*}} and {{/*}} tags.
     *
     * @param   string  $string
     *
     * @return  string
     */
    public function deleteComments(string $string) : string {
        return preg_replace($this->comment, '', $string);
    }
}
