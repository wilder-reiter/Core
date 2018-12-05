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

    private $variable = "\{\{[a-z]+\}\}";
    private $comment = "\{\{\*\}\}.+\{\{\/\*\}\}";
    private $conditional = "\{\{[a-z]+\?[a-z]+\}\}";

    /**
     * @param   string  $string
     * @param   array   $params
     *
     * @return  string
     */
    public function render(string $string, array $params) : string
    {
        // Deletions from the string
        $string = $this->deleteComments($string);

        // Simple variable printing
        $string = $this->renderConditionals($string, $params);
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
    private function renderVars(string $string, array $params) : string {
        return $string;
    }

    /**
     * Searches for conditionals in the string and prints the variable inside
     * of it, is the prefixed condition is true.
     * Conditional tags have the following syntax: {{condition?variable}}
     *
     * @param   string  $string
     * @param   array   $params
     *
     * @return  string
     */
    private function renderConditionals(string $string, array $params) : string {
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
        return preg_replace('#'.$this->comment.'#', '', $string);
    }
}
