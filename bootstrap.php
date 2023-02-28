<?php
declare(strict_types=1);
require_once __DIR__.'/vendor/autoload.php';

use DI\ContainerBuilder;
use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use League\Event\EventDispatcher;
use League\Route\RouteCollectionInterface;
use PhpFidder\Core\Components\Core\EventSubscriber;
use PhpFidder\Core\Components\Landing\Action\index;
use PhpFidder\Core\Components\Landing\Event\IndexEvent;
use PhpFidder\Core\Components\Landing\Event\IndexListener;
use PhpFidder\Core\Components\Login\Action\Login;
use PhpFidder\Core\Components\Login\Action\Logout;
use PhpFidder\Core\Components\Registration\Action\Register;
use PhpFidder\Core\Components\UserSite\Action\Usermainsite;
use PhpFidder\Core\Renderer\TemplateRendererInterface;
use PhpFidder\Core\Renderer\TemplateRendererMiddleware;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$builder = new ContainerBuilder();

$builder->addDefinitions(__DIR__.'/dependencies.php');

$container = $builder->build();
$router = $container->get(RouteCollectionInterface::class);
$request = $container->get(ServerRequestInterface::class);
$emitter = $container->get(EmitterInterface::class);

$router->middleware($container->get(TemplateRendererMiddleware::class));
///**
// * @var EventDispatcher $dispatcher
// */
//$dispatcher = $container->get(EventDispatcherInterface::class);
//$dispatcher->subscribeTo(IndexEvent::class, $container->get(IndexListener::class));
$subscriber = $container->get(EventSubscriber::class);
$subscriber->subscribeToEvent();

// map a route
$router->map('GET', '/', index::class);
// Registration
$router->map('GET','/account/create', Register::class);
$router->map('POST','/account/create', Register::class);
// Login
$router->map('GET','/account/login', Login::class);
$router->map('POST','/account/login', Login::class);
// Logout
$router->map('GET','/account/logout', Logout::class);
// Usersite
$router->map('GET','/account/usermainsite', Usermainsite::class);
$router->map('POST','/account/usermainsite', Usermainsite::class);
$response = $router->dispatch($request);

// send the response to the browser
$emitter->emit($response);
