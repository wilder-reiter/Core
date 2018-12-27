<?php

namespace Wildgame\Router;

/**
 * Represents the definition of a HTTP Route.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2019 Lisa Saalfrank
 */
class Route {

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var array
     */
    private $action;

    /**
     * @var string
     */
    private $method;

    /**
     * @var bool
     */
    private $ajax;

    /**
     * @var string
     */
    private $middleware;

    /**
     * @param   string  $pattern
     * @param   string  $action
     * @param   string  $method
     * @param   bool    $ajax
     */
    public function __construct(
        string $pattern,
        string $action,
        string $method,
        bool $ajax
    ) {
        $this->setPattern($pattern);
        $this->setAction($action);
        $this->method = $method;
        $this->ajax = $ajax;
    }

    /**
     * @param   string  $pattern
     *
     * @return  void
     */
    public function setPattern(string $pattern) {
        $this->pattern = $this->pattern = '/'.trim($pattern, '/');
    }

    /**
     * @return  string
     */
    public function getPattern() : string {
        return $this->pattern;
    }

    /**
     * @param   string  $action
     *
     * @return  void
     */
    public function setAction(string $action) {
        $this->action = explode('@', $action);
    }

    /**
     * @return  array
     */
    public function getAction() : array {
        return $this->action;
    }

    /**
     * @return  string
     */
    public function getMethod() : string {
        return $this->method;
    }

    /**
     * @return  bool
     */
    public function isAjax() : bool {
        return $this->ajax;
    }

    /**
     * @param   string  $middleware
     *
     * @return  void
     */
    public function before(string $middleware) {
        $this->middleware = $middleware;
    }

    /**
     * @return  string
     */
    public function getMiddleware() : string {
        return $this->middleware;
    }

    /**
     * @return  bool
     */
    public function hasMiddleware() : bool {
        return !empty($this->middleware);
    }
}
