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
     * Defines the action to be taken in case no matching Route was found or a
     * 404 Not Found Response has been sent.
     *
     * @param   string  $action
     *
     * @return  void
     */
    public function serverError(string $action) {
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
    public function notFoundError(string $action) {
        // Add code here
    }
}
