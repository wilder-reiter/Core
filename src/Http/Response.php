<?php

namespace Wildgame\Http;

/**
 * Abstraction layer for a HTTP Response. Stores the relevant data so that it is
 * both manipulatable and flexible.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Response {

    /**
     * @var string
     */
    private $protocol;

    /**
     * @var array
     */
    public static $reasonPhrases = [
        200 => 'OK',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];

    /**
     * @var int
     */
    private $code;

    /**
     * @var array
     */
    public static $mimeTypes = [
        'html' => 'text/html',
        'json' => 'application/json'
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $body;

    /**
     * @param   int $code
     */
    public function __construct(int $code) {
        $this->code = $code;
    }

    /**
     * @param   string  $type
     *
     * @return  void
     */
    public function setType(string $type) {
        $this->type = self::$mimeTypes[$type];
    }

    /**
     * @param   string  $body
     *
     * @return  void
     */
    public function setHtmlBody(string $body) {
        $this->body = $body;
    }

    /**
     * @param   array   $body
     *
     * @return  void
     */
    public function setJsonBody(array $body) {
        $this->body = json_encode($body);
    }

    /**
     * @param   string  $protocol
     *
     * @return  \Wildgame\Http\Response
     */
    public function withProtocol(string $protocol) : Response
    {
        $clone = clone $this;
        $clone->protocol = $protocol;
        return $clone;
    }

    /**
     * @param   int $code
     *
     * @return  \Wildgame\Http\Response
     */
    public function withCode(int $code) : Response
    {
        $clone = clone $this;
        $clone->code = $code;
        return $clone;
    }

    /**
     * @param   string  $type
     *
     * @return  \Wildgame\Http\Response
     */
    public function withType(string $type) : Request
    {
        $clone = clone $this;
        $clone->setType($type);
        return $clone;
    }

    /**
     * @param   string  $body
     *
     * @return  \Wildgame\Http\Response
     */
    public function withBody(string $body) : Request {
        // Add code here
    }

    /**
     * Returns the HTTP protocol version (e.g. HTTP 1.0, 1.1, 2.0).
     *
     * @return  string
     */
    public function getProtocol() : string {
        return $this->protocol;
    }

    /**
     * Returns the HTTP Response code (e.g. 200, 404 or 500).
     *
     * @return  int
     */
    public function getCode() : int {
        return $this->code;
    }

    /**
     * Returns the correspending status message to a Response code (e.g.
     * 200 => OK, 404 => Not Found, 500 => Internal Server Error).
     *
     * @return  int
     */
    public function getMessage() : string {
        return self::$reasonPhrases[$this->code];
    }

    /**
     * Get the document mime type (e.g. text/html, application/json, text/css).
     *
     * @return  string
     */
    public function getType() : string {
        return $this->type;
    }

    /**
     * @return  string
     */
    public function getBody() : string {
        return $this->body;
    }
}
