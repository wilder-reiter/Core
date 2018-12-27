<?php

namespace Wildgame\Http;

/**
 * Abstraction layer for user input. It contains data originating from the
 * $_REQUEST, $_GET and $_POST arrays but can be manipulated by adding or
 * removing elements without changing the original Request.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2019 Lisa Saalfrank
 */
class Input {

    /**
     * @var array
     */
    protected $input = [];

    /**
     * @param   array   $get
     * @param   array   $post
     */
    public function __construct(
        array $get = [],
        array $post = [],
        array $json = []
    ) {
        $this->input['get'] = $get;
        $this->input['post'] = $post;
        $this->input['json'] = $json;
    }

    /**
     * @param   array   $get
     *
     * @return  \Wildgame\Http\Input
     */
    public function withGet(array $get) : Input
    {
        $clone = clone $this;
        $clone->input['get'] = $get;
        return $clone;
    }

    /**
     * @param   array   $post
     *
     * @return  \Wildgame\Http\Input
     */
    public function withPost(array $post) : Input
    {
        $clone = clone $this;
        $clone->input['post'] = $post;
        return $clone;
    }

    /**
     * @param   array   $json
     *
     * @return  \Wildgame\Http\Input
     */
    public function withJson(array $json) : Input
    {
        $clone = clone $this;
        $clone->input['json'] = $json;
        return $clone;
    }

    /**
     * @param   string  $key
     * @param   mixed   $value
     *
     * @return  \Wildgame\Http\Input
     */
    public function withAddedGet(string $key, $value) : Input
    {
        $clone = clone $this;
        $clone->input['get'][$key] = $value;
        return $clone;
    }

    /**
     * @param   string  $key
     * @param   mixed   $value
     *
     * @return  \Wildgame\Http\Input
     */
    public function withAddedPost(string $key, $value) : Input
    {
        $clone = clone $this;
        $clone->input['post'][$key] = $value;
        return $clone;
    }

    /**
     * @param   string  $key
     * @param   mixed   $value
     *
     * @return  \Wildgame\Http\Input
     */
    public function withAddedJson(string $key, $value) : Input
    {
        $clone = clone $this;
        $clone->input['json'][$key] = $value;
        return $clone;
    }

    /**
     * @param   string  $key
     *
     * @return  \Wildgame\Http\Input
     */
    public function withoutGet(string $key) : Input
    {
        $clone = clone $this;
        unset($clone->input['get'][$key]);
        return $clone;
    }

    /**
     * @param   string  $key
     *
     * @return  \Wildgame\Http\Input
     */
    public function withoutPost(string $key) : Input
    {
        $clone = clone $this;
        unset($clone->input['post'][$key]);
        return $clone;
    }

    /**
     * @param   string  $key
     *
     * @return  \Wildgame\Http\Input
     */
    public function withoutJson(string $key) : Input
    {
        $clone = clone $this;
        unset($clone->input['json'][$key]);
        return $clone;
    }

    /**
     * @param   string  $method
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    protected function input(
        string $method = 'get',
        string $name = null,
        $default = null
    ) {
        // Checks if a specific value was requested. If yes, return it.
        if (isset($name)) {
            return $this->input[$method][$name] ?? $default;
        }
        // Otherwise return the entire array
        return $this->input[$method];
    }

    /**
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function get(string $name = null, $default = null) {
        return $this->input('get', $name, $default);
    }

    /**
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function post(string $name = null, $default = null) {
        return $this->input('post', $name, $default);
    }

    /**
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function json(string $name = null, $default = null) {
        return $this->input('json', $name, $default);
    }
}
