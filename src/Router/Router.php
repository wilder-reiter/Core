<?php

namespace Wildgame\Router;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Container\Container;

/**
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2019 Lisa Saalfrank
 */
class Router {

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
     * @var array
     */
    private $routes = [];

    /**
     * @var array
     */
    private $middleware = [];

    /**
     * @var array
     */
    private $notFound;

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
    }

    /**
     * Registers middleware to the router by aliasing it.
     *
     * @param   string  $alias
     * @param   string  $action
     *
     * @return  void
     */
    public function addMiddleware(string $alias, string $action) {
        $this->middleware[$alias] = explode('@', $action);
    }

    /**
     * @param   \Wildgame\Router\Route  $route
     *
     * @return  void
     */
    public function addRoute(Route $route) {
        $this->routes[] = $route;
    }

    /**
     * @param   string  $action
     *
     * @return  void
     */
    public function addNotFound(string $action) {
        $this->notFound = explode('@', $action);
    }

    /**
     * @param   \Wildgame\Router\Route  $route
     *
     * @return  void
     */
    public function runMiddleware(Route $route)
    {
        if ($route->hasMiddleware()) {
            $mw = $this->middleware[$route->getMiddleware()];

            $args = [$this->request, $this->response];
            $class = $this->container->get($mw[0]);

            // Run middleware and refresh response
            $this->response = call_user_func_array([$class, $mw[1]], $args);
        }
    }

    /**
     * @return  array
     */
    private function find() : array
    {
        // Create new Matcher
        $matcher = new Matcher($this->request);

        // Searches the routes array for any matches
        foreach ($this->routes as $route) {
            // And if there is a match return the controller
            if ($matcher->match($route))
            {
                // Run middleware
                $this->runMiddleware($route);

                // Preprocess route and request info
                $parser = new Parser($this->request);
                $this->request = $parser->parse($route);
                return $route->getAction();
            }
        }

        // If there was no match notFound will be returned
        return $this->notFound;
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function dispatch() : Response
    {
        // Gets the controller
        $action = $this->find();
        $args = [$this->request, $this->response];
        $class = $this->container->get($action[0]);

        // Call the method
        $method = $action[1];
        return call_user_func_array([$class, $method], $args);
    }
}
