<?php

use Wildgame\Wildgame;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Container\Container;

/**
 * Entry point for every HTTP Request sent to the server.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */

/* -----------------------------------------------------------------------------
 * Setup of autoloading
 * -------------------------------------------------------------------------- */

spl_autoload_register(function ($class) {
    include __DIR__ .'/../src/' . str_replace('\\', '/', $class) . '.php';
});

/* -----------------------------------------------------------------------------
 * Basic HTTP Setup
 * -------------------------------------------------------------------------- */

// Create the HTTP Request from the global variables
$request = Request::createFromGlobals();
// Create a default HTTP Response with text/html and the 200 OK status
$response = Response::createDefaultHtml();

/* -----------------------------------------------------------------------------
 * Registering of dependencies
 * -------------------------------------------------------------------------- */

$container = new Container();

$container->add(\Wildgame\Controller\PagesController::class);
$container->add(\Wildgame\Controller\ErrorController::class);

/* -----------------------------------------------------------------------------
 * Bootstraping
 * -------------------------------------------------------------------------- */

// New instance of the Wilder Reiter game master class
$app = new Wildgame($request, $response, $container);

/* -----------------------------------------------------------------------------
 * Route configuration
 * -------------------------------------------------------------------------- */

$app->serverError('ErrorController@serverError');
$app->notFoundError('ErrorController@notFoundError');

/* -----------------------------------------------------------------------------
 * Registering of routes
 * -------------------------------------------------------------------------- */

$app->get('/', 'PagesController@showHome');

/* -----------------------------------------------------------------------------
 * Dispatching
 * -------------------------------------------------------------------------- */

$app->respond();
