<?php


// The files prod.php and dev.php are ignored in the git repositery, find below an example of their contents

// Doctrine (db)
$app['dbs.options'] = array(
'datatransfer' => array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'datatransfer',
    'user'     => 'root',
    'password' => 'root',
    ),
'manage' => array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'manage',
    'user'     => 'root',
    'password' => 'root',
    ),
);

$app['javascript_path'] = $app->share(function () {
    return '/minijs/';
});

// define log level
$app['monolog.level'] = 'WARNING';
