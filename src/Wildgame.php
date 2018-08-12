<?php

namespace Wildgame;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Utility\Container;

/**
 * Receives the HTTP Request data, an empty default HTTP Response and the
 * Dependency Injection Container with the required Controllers and all their
 * dependencies.
 *
 * With the help of the registered Route directions it finds the matching
 * action to take and passes the data to the responsible Controller.
 *
 * Finally it will send or return the manipulated HTTP Response returned by
 * the Controller or send a fallback HTTP Response in case of an error.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Wildgame {

    const VERSION = '0.0.1';

    /**
     * @var \Wildgame\Http\Request
     */
    private $request;

    /**
     * @var \Wildgame\Http\Response
     */
    private $response;

    /**
     * @var \Wildgame\Utility\Container
     */
    private $container;

    /**
     * @var array
     */
    private $realms = [];

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
     * @param   \Wildgame\Http\Request      $request
     * @param   \Wildgame\Http\Response     $response
     * @param   \Wildgame\Http\Container    $container
     */
    public function __construct(
        Request $request,
        Response $response,
        Container $container
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->container = $container;
    }

    /**
     * Realms are variables for common route patterns (e.g. 'horse' in
     * '/horse/training/1', '/horse/profil/1'). These variables will be added
     * to the route pattern instead of hardcoding it into the system.
     *
     * Example: '[horse]/training/{id}', '[horse]/training/{id}'
     *
     * @param   string  $name
     * @param   string  $pattern
     *
     * @return  void
     */
    public function realm(string $name, string $pattern) {
        $this->realms[$name] = $pattern;
    }

    /**
     * Adds or modifies route parameter tokens. Parameter tokens are flags for
     * checking a parameter against a regular expression. The flag will be added
     * after the parameter name with a ':'.
     *
     * Example: '[horse]/training/{id:num}'
     *
     * @param   string  $name
     * @param   string  $expression
     *
     * @return  void
     */
    public function token(string $name, string $expression) {
        $this->tokens[$name] = $expression;
    }

    /**
     * Adds a Route direction with a HTTP GET Request method.
     *
     * @param   string  $pattern
     * @param   string  $action
     *
     * @return  void
     */
    public function get(string $pattern, string $action) {
        // Add code here
    }

    /**
     * Adds a Route direction with a HTTP POST Request method.
     *
     * @param   string  $pattern
     * @param   string  $action
     *
     * @return  void
     */
    public function post(string $pattern, string $action) {
        // Add code here
    }

    /**
     * Adds a Route direction for an AJAX Request for one specific HTTP
     * Request method.
     *
     * @param   string  $pattern
     * @param   string  $action
     * @param   string  $method
     *
     * @return  void
     */
    public function ajax(string $pattern, string $action, string $method) {
        // Add code here
    }

    /**
     * Defines the action to be taken in case the matching Controller did
     * return an invalid HTTP Response or an 500 Internal Server Error.
     *
     * @param   string  $action
     *
     * @return  void
     */
    public function serverError(string $action) {
        // Add code here
    }

    /**
     * Defines the action to be taken in case no matching Route was found or a
     * 404 Not Found Response has been sent.
     *
     * @param   string  $action
     *
     * @return  void
     */
    public function notFoundError(string $action) {
        // Add code here
    }

    /**
     * Renders and sends an HTTP Response.
     *
     * @return  void
     */
    public function respond() {
        // Add code here
    }

    /**
     * Return the Response object without directly sending a response
     *
     * @return  \Wildgame\Http\Response
     */
    public function getResponse() : Response {
        // Add code here
    }
}
