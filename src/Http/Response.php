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
     * @param   string  $protocol
     *
     * @return  \Wildgame\Http\Response
     */
    public function withProtocol(string $protocol) : Response {
        // Add code here
    }

    /**
     * @param   int $code
     *
     * @return  \Wildgame\Http\Response
     */
    public function withCode(int $code) : Response {
        // Add code here
    }

    /**
     * @param   string  $type
     *
     * @return  \Wildgame\Http\Response
     */
    public function withType(string $type) : Request {
        // Add code here
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
     * @return  string
     */
    public function getProtocol() : string {
        return $this->protocol;
    }

    /**
     * @return  int
     */
    public function getCode() : int {
        return $this->code;
    }

    /**
     * @return  int
     */
    public function getMessage() : string {
        return self::$reasonPhrases[$this->code];
    }

    /**
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
