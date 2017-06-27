<?php

$route = new Zend_Controller_Router_Route(
    'converter',
    array(
        'controller' => 'Converter',
        'action'     => 'convert'
    )
);

$router->addRoute('converter', $route);