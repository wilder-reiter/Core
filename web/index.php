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

$container->add(\Equidea\Controller\PagesController::class);
$container->add(\Equidea\Controller\ErrorController::class);

/* -----------------------------------------------------------------------------
 * Bootstraping
 * -------------------------------------------------------------------------- */

// New instance of the frameworks master class
$app = new Wildgame($request, $response, $container);

// Root namespaces for Controllers
$app->namespace(['controller' => 'Equidea\Controller']);

/* -----------------------------------------------------------------------------
 * Registering of routes
 * -------------------------------------------------------------------------- */

// Index page
$app->get('/', 'PagesController@showHome');

// Custom 500 Server Error and 404 Not Found pages
$app->serverError('ErrorController@serverError');
$app->notFoundError('ErrorController@notFoundError');

/* -----------------------------------------------------------------------------
 * Dispatching
 * -------------------------------------------------------------------------- */

$app->respond();
