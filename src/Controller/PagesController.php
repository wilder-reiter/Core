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

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showPreview() : Response {
        return $this->response->withBody('Hier muss die Spiel-Vorschau hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showSupport() : Response {
        return $this->response->withBody('Hier muss der Support hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showNews() : Response {
        return $this->response->withBody('Hier müssen die News hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showPrivacy() : Response {
        return $this->response->withBody('Hier muss die Datenschutzbestimmung hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showRules() : Response {
        return $this->response->withBody('Hier muss die Regel-Seite hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showAbout() : Response {
        return $this->response->withBody('Hier muss die Über WR-Seite hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showContact() : Response {
        return $this->response->withBody('Hier muss das Kontaktformular hin.');
    }

    /**
     * @return  \Wildgame\Http\Response
     */
    public function showLegal() : Response {
        return $this->response->withBody('Hier muss das Impressum hin.');
    }
}
