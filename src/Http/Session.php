<?php

namespace Wildgame\Http;

/**
 * Abstraction layer for the global $_SESSION array. In default mode it
 * manipulates the global array disectly, in mockup mode an internal array.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018-2020 Lisa Saalfrank
 */
class Session {

    /**
     * @param   string  $name
     * @param   mixed   $default
     *
     * @return  mixed
     */
    public function get(string $name = null, $default = null)
    {
        // Checks if a specific value was requested. If yes, return it
        if (isset($name)) {
            return $_SESSION[$name] ?? $default;
        }
        // Otherwse return the entire session
        return $_SESSION;
    }

    /**
     * @param   string  $name
     * @param   mixed   $value
     *
     * @return  void
     */
    public function set(string $name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * @param   string  $name
     *
     * @return  void
     */
    public function remove(string $name) {
        unset($_SESSION[$name]);
    }
}
