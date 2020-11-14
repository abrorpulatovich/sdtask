<?php

$db_local = require __DIR__ . '/db_local.php';

$default = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=sdtask',
    'username' => 'root',
    'password' => 'khantech1992',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

$default['dsn'] = $db_local['dsn'];
$default['username'] = $db_local['username'];
$default['password'] = $db_local['password'];

return $default;