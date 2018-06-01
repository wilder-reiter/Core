<?php

namespace Wildgame\Http;

/**
 * Abstraction layer for HTTP Requests. Stores the relevant data in an easily
 * manipulatable and mockable way without affecting the original Request.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Request {

    /**
     * Returns the HTTP Request method in only capital letters. (e.g 'GET')
     *
     * @return  string
     */
    public function method() : string {
        // Add code here
    }

    /**
     * Returns true if the current HTTP Request is an AJAX request.
     *
     * @return  bool
     */
    public function ajax() : bool {
        // Add code here
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
     * Works as both Request::get() and Request::post() but returns $_SESSION
     * values instead.
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
