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
    private renderVars(string $string, array $params) : string {
        // Add code here
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
    private renderConditionals(string $string, array $params) : string {
        // Add code here
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
        // Add code here
    }
}
