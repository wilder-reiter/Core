<?php

namespace Wildgame\Container;

use ReflectionClass;

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
     * @var array
     */
    protected $singletons = [];

    /**
     * @var bool
     */
    protected $autoresolve;

    /**
     * Defines whether dependencies should be resolved automatically and
     * declares the class itself as a singleton. This is necessary for injecting
     * the container into other classes via the class constructor.
     *
     * If autoresolve is set to true, every class that needs to be loaded via
     * Dependency Injection and which has any non-class dependencies must still
     * be declared manually.
     *
     * @param   bool    $autoresolve
     *
     * @return  void
     */
    public function __construct(bool $autoresolve = true)
    {
        $this->autoresolve = $autoresolve;
        $this->definitions[Container::class]['singleton'] = true;
        $this->singletons[Container::class] = $this;
    }

    /**
     * Create and add a definition to the container. The definition will be
     * returned after its creation for the purpose of modifying it.
     *
     * @param   string  $alias
     * @param   string  $class
     *
     * @return  \Wildgame\Container\Definition
     */
    public function add(string $alias, string $class = null) : Definition
    {
        // If no classname was provided, class is identical to the alias
        $class = $class ?? $alias;

        // Create a new Definition instance and add it to the collection
        $definition = new Definition($class, $this);
        $this->definitions[$alias]['definition'] = $definition;

        // Return the definition, so that it can be modified afterwards
        return $definition;
    }

    /**
     * @param   string  $alias
     *
     * @return  bool
     */
    public function has(string $alias) : bool {
        return array_key_exists($alias, $this->definitions);
    }

    /**
     * Create and add a definition as a singleton to the container. The
     * definition will be returned as in Container::add().
     *
     * @param   string  $alias
     * @param   string  $class
     *
     * @return  \Wildgame\Container\Definition
     */
    public function singleton(string $alias, string $class = null) : Definition
    {
        // Create a normal definition but mark it as a singleton
        $definition = $this->add($alias, $class);
        $this->definitions[$alias]['singleton'] = true;

        return $definition;
    }

    /**
     * Add an already instantiated class to the singleton array. As the class
     * can no longer be modyfied through definitions, nothing will be returned.
     *
     * @param   string  $alias
     * @param   object  $class
     *
     * @return  void
     */
    public function append(string $alias, object $class)
    {
        $this->definitions[$alias]['singleton'] = true;
        $this->singletons[$alias] = $class;
    }

    /**
     * @param   string  $alias
     *
     * @return  bool
     */
    public function hasSingleton(string $alias) : bool {
        return array_key_exists($alias, $this->singletons);
    }

    /**
     * @param   string  $alias
     *
     * @return  mixed
     */
    public function get(string $alias)
    {
        // If it is a singleton, just return the instance
        if ($this->hasSingleton($alias)) {
            return $this->singletons[$alias];
        }

        // If no definition was provided, build it manually
        if ($this->has($alias) === false && $this->autoresolve === true) {
            $this->buildDefinition($alias);
        }

        // Otherwise create a new instance of the newly created instance
        $class = $this->definitions[$alias]['definition']();
        $singleton = $this->definitions[$alias]['singleton'] ?? false;

        // If the instance created is a singleton, add it to the array
        if ($singleton === true) {
            $this->singletons[$alias] = $class;
        }

        return $class;
    }

    /**
     * Resolve a classes dependencies and set Definitions automatically.
     *
     * @param   string  $alias
     *
     * @return  void
     */
    private function buildDefinition(string $alias)
    {
        $definition = $this->add($alias);

        // Get the constructor parameters
        $reflector = new ReflectionClass($alias);
        $construct = $reflector->getConstructor();
        
        $parameters = [];
        if ($construct !== null) {
            $parameters = $construct->getParameters();
        }

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass()->getName();
            $definition->needs($dependency);
        }
    }
}
