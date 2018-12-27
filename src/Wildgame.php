<?php

namespace Wildgame;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Container\Container;

use Wildgame\Router\Router;
use Wildgame\Router\Route;

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
 * @copyright   2018-2019 Lisa Saalfrank
 */
class Wildgame {

    /**
     * The current version of the Wildgame framework package.
     */
    const VERSION = '1.2.2';

    const MAJOR_VERSION = 1;
    const MINOR_VERSION = 2;
    const RELEASE_VERSION = 2;

    /**
     * @var \Wildgame\Http\Request
     */
    private $request;

    /**
     * @var \Wildgame\Http\Response
     */
    private $response;

    /**
     * @var \Wildgame\Container\Container
     */
    private $container;

    /**
     * @var \Wildgame\Router\Router
     */
    private $router;

    /**
     * @var array
     */
    private $namespaces = [
        'controller' => 'Wildgame\Controller',
        'middleware' => 'Wildgame\Middleware'
    ];

    /**
     * @param   \Wildgame\Http\Request          $request
     * @param   \Wildgame\Http\Response         $response
     * @param   \Wildgame\Container\Container   $container
     */
    public function __construct(
        Request $request,
        Response $response,
        Container $container
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->container = $container;
        $this->router = new Router($request, $response, $container);
    }

    /**
     * Overwrites the custom namespaces for Controllers and Middleware. Default
     * is set to \Wildgame\Controller and \Wildgame\Middleware. The config must
     * be provided as an associative array with the keys 'controller' and
     * 'middleware'.
     *
     * @param   array   $namespaces
     *
     * @return  void
     */
    public function namespaces(array $namespaces) {
        $this->namespaces = $namespaces;
    }

    /**
     * Registers middleware to the router by aliasing it.
     *
     * @param   string  $alias
     * @param   string  $action
     *
     * @return  void
     */
    public function middleware(string $alias, string $action)
    {
        $action = $this->namespaces['middleware'] . '\\' . $action;
        $this->router->addMiddleware($alias, $action);
    }

    /**
     * Adds a Route direction with a HTTP GET Request method.
     *
     * @param   string  $pattern
     * @param   string  $action
     *
     * @return  \Wildgame\Router\Route
     */
    public function get(string $pattern, string $action) : Route {
        return $this->addRoute($pattern, $action, 'GET');
    }

    /**
     * Adds a Route direction with a HTTP POST Request method.
     *
     * @param   string  $pattern
     * @param   string  $action
     *
     * @return  \Wildgame\Router\Route
     */
    public function post(string $pattern, string $action) : Route {
        return $this->addRoute($pattern, $action, 'POST');
    }

    /**
     * Adds a Route direction for an AJAX Request for one specific HTTP
     * Request method.
     *
     * @param   string  $pattern
     * @param   string  $action
     * @param   string  $method
     *
     * @return  \Wildgame\Router\Route
     */
    public function ajax(
        string $pattern,
        string $action,
        string $method
    ) : Route {
        return $this->addRoute($pattern, $action, $method, true);
    }

    /**
     * Defines the action to be taken in case no matching Route was found or a
     * 404 Not Found Response has been sent.
     *
     * @param   string  $action
     *
     * @return  void
     */
    public function notFound(string $action)
    {
        $action = $this->namespaces['controller'] . '\\' . $action;
        $this->router->addNotFound($action);
    }

    /**
     * Creates a new Route and adds it to the Router.
     *
     * @param   string  $pattern
     * @param   string  $action
     * @param   string  $method
     * @param   bool    $ajax
     *
     * @return  \Wildgame\Router\Route
     */
    private function addRoute(
        string $pattern,
        string $action,
        string $method,
        bool $ajax = false
    ) : Route {
        // Add the controller namespace to the action before adding it
        $action = $this->namespaces['controller'] . '\\' . $action;
        $route = new Route($pattern, $action, $method, $ajax);

        $this->router->addRoute($route);
        return $route;
    }

    /**
     * Runs the router and either sends an HTTP Response from a matched Route
     * or the notFound or serverError fallback Route.
     *
     * @return  void
     */
    public function respond()
    {
        // Get the Response object from the controller
        $response = $this->getResponse();

        $protocol = $response->getProtocol();
        $code = $response->getCode();
        $message = $response->getMessage();

        // Translate the response and send it to the client
        header($protocol . ' ' . $code . ' ' . $message);
        header('Content-Type: ' . $response->getType());
        echo $response->getBody();
    }

    /**
     * Return the Response object without directly sending a response
     *
     * @return  \Wildgame\Http\Response
     */
    public function getResponse() : Response {
        return $this->router->dispatch();
    }
}
