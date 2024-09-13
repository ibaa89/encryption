<?php
require 'vendor/autoload.php';

use Phpmig\Adapter;
use Pimple\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

$config = require "config/autoload/database.global.php";
$container = new Container();

$container['config'] = [
    'driver'    => $config['database']['driver'],
    'host'      => $config['database']['host'],
    'database'  => $config['database']['database'],
    'username'  => $config['database']['username'],
    'password'  => $config['database']['password'],
    'charset'   => $config['database']['charset'],
    'collation' => $config['database']['collation'],
    'prefix'    => '',
];

$container['db'] = function ($c) {
    $capsule = new Capsule();
    $capsule->addConnection($c['config']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$container['phpmig.adapter'] = function ($c) {
    return new Adapter\Illuminate\Database($c['db'], 'migrations');
};

$container['phpmig.migrations'] = function () {
    return glob(__DIR__ . '/migrations/*.php');
};
$container['phpmig.migrations_path'] = __DIR__ . '/migrations';
return $container;