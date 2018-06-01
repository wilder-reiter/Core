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
}
