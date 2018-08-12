<?php

namespace Wildgame\Http;

use Wildgame\Http\Input;
use Wildgame\Http\Session;
use Wildgame\Http\Uri;

/**
 * Abstraction layer for HTTP Requests. Stores the relevant data in an easily
 * manipulatable and mockable way without affecting the original Request.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Request {

    /**
     * @var string
     */
    private $method;

    /**
     * @var bool
     */
    private $ajax;

    /**
     * @var \Wildgame\Http\Uri
     */
    private $uri;

    /**
     * @var \Wildgame\Http\Input
     */
    private $input;

    /**
     * @var \Wildgame\Http\Session
     */
    private $session;

    /**
     * @param   string                  $method
     * @param   bool                    $ajax
     * @param   \Wildgame\Http\Uri      $uri
     * @param   \Wildgame\Http\Input    $input
     * @param   \Wildgame\Http\Session  $session
     */
    public function __construct(
        string $method,
        bool $ajax,
        Uri $uri,
        Input $input,
        Session $session
    ) {
        $this->method = $method;
        $this->ajax = $ajax;
        $this->uri = $uri;
        $this->input = $input;
        $this->session = $session;
    }

    /**
     * Creates a new instance of Request based on the information extracted from
     * the global variables $_SERVER, $_GET, $_POST and $_SESSION. (Factory)
     *
     * @return  \Wildgame\Http\Request
     */
    public static function createFromGlobals() : Request {
        // Add code here
    }

    /**
     * @param   string  $method
     *
     * @return  \Wildgame\Http\Request
     */
    public function withMethod(string $method) : Request {
        // Add code here
    }

    /**
     * @param   bool    $ajax
     *
     * @return  \Wildgame\Http\Request
     */
    public function withAjax(bool $ajax) : Request {
        // Add code here
    }

    /**
     * @param   \Wildgame\Http\Uri  $uri
     *
     * @return  \Wildgame\Http\Request
     */
    public function withUri(Uri $uri) : Request {
        // Add code here
    }

    /**
     * @param   \Wildgame\Http\Input    $input
     *
     * @return  \Wildgame\Http\Request
     */
    public function withInput(Input $input) : Request {
        // Add code here
    }

    /**
     * @param   \Wildgame\Http\Session  $session
     *
     * @return  \Wildgame\Http\Request
     */
    public function withSession(Session $session) : Request {
        // Add code here
    }

    /**
     * Returns the original URI object instead of the URI string.
     * For retrieving just the string use Request::uri().
     *
     * @return  \Wildgame\Http\Uri
     */
    public function getUri() : Uri {
        return $this->uri;
    }

    /**
     * @return  \Wildgame\Http\Input
     */
    public function getInput() : Input {
        return $this->input;
    }

    /**
     * @return  \Wildgame\Http\Session
     */
    public function getSession() : Session {
        return $this->session;
    }

    /**
     * Returns the HTTP Request method in only capital letters. (e.g 'GET')
     *
     * @return  string
     */
    public function method() : string {
        return strtoupper($this->method);
    }

    /**
     * Returns true if the current HTTP Request is an AJAX request.
     *
     * @return  bool
     */
    public function ajax() : bool {
        return $this->ajax;
    }

    /**
     * Returns the Request URI (e.g. '/horse/training/1') as a string
     *
     * @return  string
     */
    public function uri() : string {
        // Add code here
    }

    /**
     * Returns a single $_GET value that is identified by the first parameter
     * passed to the method.
     *
     * If there is no value for the key, null will be returned as a default.
     * With the second and optional parameter you can pass on a customized default.
     *
     * If no parameter was passed to the method, all GET values will be returned
     * as an associative array instead of returning just a single value.
     *
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function get(string $name = null, $default = null) {
        // Add code here
    }

    /**
     * Works in almost exactly the same way as the Request::get() method.
     * The only difference is the returning of $_POST values instead of $_GET.
     *
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function post(string $name = null, $default = null) {
        // Add code here
    }

    /**
     * Works the same as both Request::get() and Request::post() but returns
     * $_SESSION values instead.
     *
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function session(string $name = null, $default = null) {
        // Add code here
    }
}
