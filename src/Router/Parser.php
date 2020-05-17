<?php

namespace Wildgame\Router;

use Wildgame\Http\Request;
use Wildgame\Http\Uri;

/**
 * Parses the Request URI and saves the URL parameters as GET input into the
 * HTTP Request.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2020 Lisa Saalfrank
 */
class Parser {

    /**
     * @var \Wildgame\Http\Request
     */
    private $request;

    /**
     * @param   \Wildgame\Http\Request  $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @param   mixed   $segment
     *
     * @return  bool
     */
    private function isParam($segment) : bool
    {
        $pos = strpos($segment, '{');
        return $pos !== false && $pos == 0;
    }

    /**
     * @param   string  $param
     *
     * @return  string
     */
    private function getParamName(string $param) : string
    {
        $param = ltrim($param, '{');
        $param = rtrim($param, '}');
        return explode(':', $param)[0];
    }

    /**
     * @param   array   $uriSegments
     * @param   array   $patternSegments
     *
     * @return  \Wildgame\Http\Request
     */
    private function translate(
        array $uriSegments,
        array $patternSegments
    ) : Request
    {
        // The original Request Input
        $input = $this->request->getInput();
        // Determine the number of segments
        $segments = count($patternSegments);

        // Loop through the pattern segments and find the params
        for ($i = 0; $i < $segments; $i++)
        {
            // Determines whether a segment is a param
            if ($this->isParam($patternSegments[$i]))
            {
                $paramName = $this->getParamName($patternSegments[$i]);
                $input = $input->withAddedGet($paramName, $uriSegments[$i]);
            }
        }
        // Return a clone of Request with the now added GET parameters
        return $this->request->withInput($input);
    }

    /**
     * @param   \Wildgame\Router\Route  $route
     *
     * @return  \Wildgame\Http\Request
     */
    public function parse(Route $route) : Request
    {
        // Get the pattern
        $pattern = $route->getPattern();

        // If no parameter is present, respond with the original request
        if (strpos($pattern, '/{') === false) {
            return $this->request;
        }

        // Get the URI segments
        $uriSegments = $this->request->getUri()->getPathSegments();

        // Get the pattern segments
        $patternUri = $this->request->getUri()->withPath($pattern);
        $patternSegments = $patternUri->getPathSegments();

        // Save the URI params into the Request object and return it
        return $this->translate($uriSegments, $patternSegments);
    }
}
