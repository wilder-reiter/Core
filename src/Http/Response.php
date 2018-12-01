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
    private $protocol = 'HTTP/1.0';

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
        'css' => 'text/css',
        'html' => 'text/html',
        'json' => 'application/json',
        'text' => 'text/plain'
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
     * Creates a default Response with the server protocol with the code 200,
     * the content type text/html and an empty body. (Factory)
     *
     * @return  \Wildgame\Http\Response
     */
    public static function createDefaultHtml() : Response
    {
        $default = new static(200);

        // If no server protocol is set, set to the safe default of HTTP/1.0
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ?
            $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

        $default->setProtocol($protocol);
        $default->setType('html');
        $default->setTextBody('');

        return $default;
    }

    /**
     * @param   string  $protocol
     *
     * @return  void
     */
    public function setProtocol(string $protocol) {
        $this->protocol = $protocol;
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
    public function setTextBody(string $body) {
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
    public function withType(string $type) : Response
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
    public function withTextBody(string $body) : Response
    {
        $clone = clone $this;
        $clone->setTextBody($body);
        return $clone;
    }

    /**
     * @param   array   $body
     *
     * @return  \Wildgame\Http\Response
     */
    public function withJsonBody(array $body) : Response
    {
        $clone = clone $this;
        $clone->setJsonBody($body);
        return $clone;
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
     * Returns the (encoded) Response body as a string.
     *
     * @return  string
     */
    public function getBody() : string {
        return $this->body;
    }

    /**
     * Returns the decoded JSON body as a PHP array.
     *
     * @return  array
     */
    public function getRawJsonBody() : array {
        return json_decode($this->body);
    }

    /**
     * @param   string  $location
     *
     * @return  void
     */
    public function redirect(string $location)
    {
        header("Location: ".$location);
        exit;
    }
}
