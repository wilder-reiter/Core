<?php

namespace Wildgame\Container;

/**
 * Represents the definition of a class and its dependencies. By use of the
 * injected Container, it instantiates the class and resolves its dependencies.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2019 Lisa Saalfrank
 */
class Definition {

    /**
     * @var string
     */
    private $class;

    /**
     * @var \Wildgame\Container\Container
     */
    private $container;

    /**
     * @var array
     */
    private $dependencies = [];

    /**
     * @param   string                          $class
     * @param   \Wildgame\Container\Container   $container
     */
    public function __construct(string $class, Container $container)
    {
        $this->class = $class;
        $this->container = $container;
    }

    /**
     * Add a dependency by providing the registered classes alias. If no alias
     * has been provided, use the full classname instead.
     *
     * @param   string  $dependency
     *
     * @return  \Wildgame\Container\Definition
     */
    public function needs(string $dependency) : Definition
    {
        $this->dependencies[] = $dependency;
        // Return the instance for method chaining
        return $this;
    }

    /**
     * Returns a new instance of the described class.
     *
     * @return  mixed
     */
    public function __invoke()
    {
        $arguments = [];

        // Get all dependencies from the injected container
        foreach ($this->dependencies as $dependency) {
            $arguments[] = $this->container->get($dependency);
        }

        // Create and return a new instance of the class
        $reflection = new \ReflectionClass($this->class);
        return $reflection->newInstanceArgs($arguments);
    }
}
