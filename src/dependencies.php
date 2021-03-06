<?php
// Configuration for Slim Dependency Injection Container

$container = $app->getContainer();

// Flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// CSRF check
$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard();
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// Using Twig as template engine
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('templates', [
        'cache' => false //'cache'
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

// Doctrine configuration
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// Customized Resources
$container['resources'] = function ($c) {
    return [
        'urls'  => new \YAUS\Resource\UrlResource($c->get('em'), $c->get('em')->getRepository('YAUS\Entity\Url')),
        'flash' => $c->get('flash'),
        'csrf'  => $c->get('csrf')
    ];
};

// URLS API...
$container['YAUS\Api\UrlApiAction'] = function ($c) {
    $urlResource = new \YAUS\Resource\UrlResource($c->get('em'), $c->get('em')->getRepository('YAUS\Entity\Url'));
    return new YAUS\Api\UrlApiAction($urlResource);
};

// AdminController for URLs
$container['YAUS\Controller\AdminUrlController'] = function ($c) {
    return new YAUS\Controller\AdminUrlController($c->get('view'), $c->get('resources'));
};

// AdminController for URLs
$container['YAUS\Controller\AdminHpController'] = function ($c) {
    return new YAUS\Controller\AdminHpController($c->get('view'), $c->get('resources'));
};

// Homepage controller
$container['YAUS\Controller\HomepageController'] = function ($c) {
    return new YAUS\Controller\HomepageController($c->get('view'), $c->get('resources'));
};

// Redirect controller
$container['YAUS\Controller\RedirectController'] = function ($c) {
    return new YAUS\Controller\RedirectController($c->get('view'), $c->get('resources'));
};

