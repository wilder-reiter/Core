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
     * @var array
     */
    private $pathSegments = [];

    /**
     * @param   string  $scheme
     * @param   string  $host
     * @param   string  $path
     */
    public function __construct(string $scheme, string $host, string $path)
    {
        $this->setScheme($scheme);
        $this->host = $host;
        $this->setPath($path);
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
     * @param   string  $path
     *
     * @return  void
     */
    public function setPath(string $path)
    {
        $cleanPath = trim($path, '/');
        $this->path = '/' . $cleanPath;
        $this->pathSegments = explode('/', $cleanPath);
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
     * @param   string  $host
     *
     * @return  \Wildgame\Http\Uri
     */
    public function withHost(string $host) : Uri
    {
        $clone = clone $this;
        $clone->host = $host;
        return $clone;
    }

    /**
     * @param   string  $path
     *
     * @return  \Wildgame\Http\Uri
     */
    public function withPath(string $path) : Uri
    {
        $clone = clone $this;
        $clone->setPath($path);
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

    /**
     * @return  array
     */
    public function getPathSegments() : array {
        return $this->pathSegments;
    }

    /**
     * @param   int     $key
     *
     * @return  string
     */
    public function getPathSegment(int $key) : string {
        return $this->pathSegments[$key];
    }
}
