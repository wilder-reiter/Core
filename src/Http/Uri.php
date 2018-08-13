<?php

namespace Wildgame\Http;

/**
 * Abstraction layer for most common HTTP Request URIs with scheme (http),
 * host (www.website.com) and path (/realm/page).
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
    public function __construct(string $scheme, string $host, string $path)
    {
        $this->setScheme($scheme);
        $this->host = $host;
        $this->path = $path;
    }

    /**
     * @param   string  $scheme
     *
     * @return  void
     */
    public function setScheme(string $scheme) {
        $this->scheme = str_replace('://', '', $scheme);
    }

    /**
     * @param   string  $scheme
     *
     * @return  \Wildgame\Http\Uri
     */
    public function withScheme(string $scheme) : Uri
    {
        $clone = clone $this;
        $clone->setScheme($scheme);
        return $clone;
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
