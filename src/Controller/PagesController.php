<?php

namespace Wildgame\Controller;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Utility\Container;

/**
 * Controller for all simple displaying pages.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class PagesController {

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
    public function showHome() : Response {
        return $this->response->withBody('Willkommen beim Wilden Reiter.');
    }
}
