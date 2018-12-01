<?php

namespace Wildgame\Container;

/**
 * Small container for collecting simple, related data.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Collection {

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param   string  $name
     * @param   string  $value
     *
     * @return  void
     */
    public function add(string $name, string $value) {
        $this->data[$name] = $value;
    }

    /**
     * @param   string  $name
     *
     * @return  string
     */
    public function get(string $name) : ?string {
        if ($this->has($name)) return $this->data[$name];
    }

    /**
     * @param   string  $name
     *
     * @return  boolean
     */
    public function has(string $name) : bool {
        return array_key_exists($name, $this->data);
    }

    /**
     * @return  bool
     */
    public function empty() : bool {
        return empty($this->data);
    }
}
