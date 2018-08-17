<?php

namespace Wildgame\Container;

/**
 * Small dependency injection container.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Container {

    /**
     * @var array
     */
    private $collection = [];

    /**
     * @param   string  $alias
     * @param   string  $class
     *
     * @return  \Wildgame\Container\Definition
     */
    public function add(string $alias, string $class = null) : Definition {
        // Add code here
    }

    /**
     * @param   string  $id
     */
    public function get(string $id) {
        // Add code here
    }

    /**
     * @param   string  $id
     *
     * @return  bool
     */
    public function has(string $id) : bool {
        // Add code here
    }
}
