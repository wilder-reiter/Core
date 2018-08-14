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
     * @return  \Wildgame\Http\Uri
     */
    public static function createFromServer() : Uri {
        // Add code here
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
     * Returns the scheme part of the HTTP URI without a trailing double dott
     * and slashes, e.g. 'https' in 'https://www.example.com/horse/training/1/'.
     *
     * @return  string
     */
    public function getScheme() : string {
        return $this->scheme;
    }

    /**
     * Returns the path part of the HTTP URI without a trailing slash, e.g.
     * 'www.example.com' in 'https://www.example.com/horse/training/1/'.
     *
     * @return  string
     */
    public function getHost() : string {
        return $this->host;
    }

    /**
     * Returns the path part of the HTTP URI without a trailing slash, e.g.
     * '/horse/training/1' in 'https://www.example.com/horse/training/1/'.
     *
     * @return  string
     */
    public function getPath() : string {
        return $this->path;
    }

    /**
     * Returns all the split URI path segments without the seperating slashes.
     * 'horse/training/1' will return 0 => 'horse', 1 => 'training' => 2 => '1'.
     *
     * @return  array
     */
    public function getPathSegments() : array {
        return $this->pathSegments;
    }

    /**
     * Returns a single URI path segment by its position key. The key 1 will
     * return 'training' for '/horse/training/1'.
     *
     * @param   int     $key
     *
     * @return  string
     */
    public function getPathSegment(int $key) : string {
        return $this->pathSegments[$key];
    }
}
