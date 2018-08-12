<?php

namespace Wildgame\Controller;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Utility\Container;

/**
 * Controller for all error pages.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class ErrorController {

    /**
     * @var \Wildgame\Http\Request
     */
    private $request;

    /**
     * @var \Wildgame\Http\Response
     */
    private $response;

    /**
     * @var \Wildgame\Utility\Container
     */
    private $container;

    /**
     * @param   \Wildgame\Http\Request      $request
     * @param   \Wildgame\Http\Response     $response
     * @param   \Wildgame\Http\Container    $container
     */
    public function __construct(
        Request $request,
        Response $response,
        Container $container
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->container = $container;
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function notFoundError() : Response {
        return $this->response->withCode(404)->withBody('404 Not Found Error.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function serverError() : Response {
        return $this->response->withCode(500)->withBody('500 Server Error.');
    }
}
