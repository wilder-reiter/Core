<?php

namespace Wildgame\Router;

use Wildgame\Http\Request;

/**
 * Matches a HTTP Request with a Route definition. Returns true, if all params
 * where matches, otherwise it will always return false.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Matcher {

    /**
     * @var \Wildgame\Http\Request
     */
    private $request;

    /**
     * @var array
     */
    private $tokens = [
        ':alpha' => '[A-Za-z]+',
        ':num' => '[0-9]+',
        ':alphanum' => '[A-Za-z0-9]+',
        '' => '[0-9]+'
    ];

    /**
     * @param   \Wildgame\Http\Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @param   string  $token
     * @param   string  $pattern
     *
     * @return  string
     */
    private function translate(string $token, string $pattern) : string
    {
        // Searches the route pattern for placeholders like {id:num}
        $search = '#[\{][a-z0-9]+'.$token.'[\}]#';
        // The regular expression to be exchanged with the token name
        $replacement = $this->tokens[$token];
        // Turns the route param into a regular expression
        $result = preg_replace($search, $replacement, $pattern);

        return $result;
    }

    /**
     * @param   string  $pattern
     *
     * @return  string
     */
    private function parse(string $pattern) : string
    {
        // The parameter token namespace
        $tokens = array_keys($this->tokens);

        // Search for all kinds of parameters and translate them
        foreach ($tokens as $token) {
            $pattern = $this->translate($token, $pattern);
        }

        // The parsed regular expression ready for matching
        return '#^'.$pattern.'$#D';
    }

    /**
     * @param   \Wildgame\Router\Route  $route
     *
     * @return  bool
     */
    public function match(Route $route) : bool
    {
        // Checks, if the Request method and the route method are identical
        $method = $route->getMethod() == $this->request->method();
        if ($method === false) return false;

        // Checks if the Route is an ajax type and if the Request is matching
        $ajax = $route->isAjax() == $this->request->ajax();
        if ($ajax === false) return false;

        // Checks if the Route pattern matches the Request URI
        $regex = $this->parse($route->getPattern());
        $uri = '/' . trim($this->request->getPath(), '/');
        return preg_match($regex, $uri);
    }
}
