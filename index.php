<?php

require_once __DIR__ . '/vendor/autoload.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$routes = new \Symfony\Component\Routing\RouteCollection();
$routes->add('login', new \Symfony\Component\Routing\Route('/login', array(
    '_controller' => 'Bird\Login\Controller\LoginController::indexAction'
)));

$context = new \Symfony\Component\Routing\RequestContext($_SERVER['REQUEST_URI']);
$matcher = new \Symfony\Component\Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new \Symfony\Component\HttpKernel\Controller\ControllerResolver();

$request->attributes->add($matcher->match($request->getPathInfo()));

$controller = $resolver->getController($request);
$arguments = $resolver->getArguments($request, $controller);

call_user_func_array($controller, $arguments);