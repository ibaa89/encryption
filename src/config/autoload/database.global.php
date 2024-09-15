<?php
declare(strict_types=1);

return [
    'database' => [
        'driver' => 'mysql',
        'username' => getenv('MYSQL_USER') ?: 'root',
        'password' => getenv('MYSQL_ROOT_PASSWORD') ?: 'root_password',
        'host' => getenv('MYSQL_HOST') ?: 'mariadb_container',
        'database' => getenv('MYSQL_DATABASE') ?: 'app_db',
        'port' => getenv('MYSQL_PORT') ?: 3306,
        'charset' => getenv('MYSQL_CHARSET') ?: 'utf8',
        'collation' => getenv('MYSQL_COLLATION') ?: 'utf8_unicode_ci',
        'prefix' => '',
    ],
];

// Now $config['database'] contains the database configuration