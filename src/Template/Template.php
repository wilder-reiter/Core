<?php

namespace Wildgame\Template;

/**
 * Replaces placeholders in a given string with the concrete values.
 * Allows comments that will be deleted from the string after rendering.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Template {

    /**
     * @var string
     */
    private $comment = "#\{\{\*\}\}.+\{\{\/\*\}\}#";

    /**
     * @param   string  $string
     * @param   array   $params
     *
     * @return  string
     */
    public function render(string $string, array $params) : string
    {
        // Deletions from the string. First be done *first*
        $string = $this->deleteComments($string);

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
    private function renderVars(string $string, array $params) : string
    {
        foreach ($params as $key => $value) {
            $string = str_replace('{{'.$key.'}}', $value, $string);
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
    private function deleteComments(string $string) : string {
        return preg_replace($this->comment, '', $string);
    }
}
