<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
// $config = require __DIR__ . '/database.global.php';



$capsule->addConnection([
    'driver' => 'mysql',
        'username' =>'root',
        'password' =>'root_password',
        'host' =>'mariadb_container',
        'database' =>  'app_db',
        'port' =>  3306,
        'charset' => 'utf8',
        'collation' =>'utf8_unicode_ci',
        'prefix' => '',
]);




// $capsule->addConnection([
//     'driver'    => $config['database']['driver'],
//     'host'      => $config['database']['host'],
//     'database'  => $config['database']['database'],
//     'username'  => $config['database']['username'],
//     'password'  => $config['database']['password'],
//     'charset'   => $config['database']['charset'],
//     'collation' => $config['database']['collation'],
//     'prefix'    => '',
// ]);
// Set the event dispatcher used by Eloquent models... (optional)
// use Illuminate\Contracts\Events\Dispatcher;
// use Illuminate\Container\Container;
// $capsule->setEventDispatcher(new Dispatcher(new Container()));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();