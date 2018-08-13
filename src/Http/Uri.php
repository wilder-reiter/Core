<?php

namespace Wildgame\Http;

/**
 * Abstraction layer for most common HTTP Requests URIs.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Uri {

    /**
     * @var string
     */
    private $scheme = '';

    /**
     * @var string
     */
    private $host = '';

    /**
     * @var string
     */
    private $path = '';

    /**
     * @param   string  $path
     */
    public function __construct(string $path) {
        $this->path = $path;
    }

    /**
     * @return  string
     */
    public function getScheme() : string {
        return $this->scheme;
    }

    /**
     * @return  string
     */
    public function getHost() : string {
        return $this->host;
    }

    /**
     * @return  string
     */
    public function getPath() : string {
        return $this->path;
    }
}
