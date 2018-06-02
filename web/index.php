<?php

use Wildgame\Wildgame;

use Wildgame\Http\Request;
use Wildgame\Http\Response;

use Wildgame\Utility\Container;

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
    $class = substr($class, strlen('Wildgame\\'));
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

$container->register('PagesController',
function(Request $req, Response $res, Container $c) {
    return new \Wildgame\Controller\PagesController($req, $res, $c);
});

$container->register('ErrorController',
function(Request $req, Response $res, Container $c) {
    return new \Wildgame\Controller\ErrorController($req, $res, $c);
});

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

// Home page
$app->get('/', 'PagesController@showHome');

// Guest pages
$app->get('/preview', 'PagesController@showPreview');
$app->get('/support', 'PagesController@showSupport');
$app->get('/news', 'PagesController@showNews');

// Footer pages
$app->get('/privacy', 'PagesController@showPrivacy');
$app->get('/rules', 'PagesController@showRules');
$app->get('/about', 'PagesController@showAbout');
$app->get('/contact', 'PagesController@showContact');
$app->get('/legal', 'PagesController@showLegal');

/* -----------------------------------------------------------------------------
 * Dispatching
 * -------------------------------------------------------------------------- */

$app->respond();
