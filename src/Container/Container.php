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
    protected $definitions = [];

    /**
     * Create and add a definition to the container. The defenition will be
     * returned after its creation for the purpose of modifying it.
     *
     * @param   string  $alias
     * @param   string  $class
     *
     * @return  \Wildgame\Container\Definition
     */
    public function add(string $alias, string $class = null) : Definition
    {
        // If no classname was provided, it is identical to the alias
        $class = $class ?? $alias;

        // Create a new Definition instance and add it to the collection
        $definition = new Definition($class);
        $this->definitions[$alias] = $definition;

        // Return the definition, so that it can be modified afterwards
        return $this->definition[$alias];
    }

    /**
     * @param   string  $alias
     *
     * @return  mixed
     */
    public function get(string $alias) {
        // Add code here
    }

    /**
     * @param   string  $alias
     *
     * @return  bool
     */
    public function has(string $alias) : bool {
        // Add code here
    }
}
