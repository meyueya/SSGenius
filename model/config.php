<?php

function require_database_env($name)
{
    $value = getenv($name);
    if ($value === false || $value === '') {
        throw new RuntimeException('Missing required environment variable: ' . $name);
    }
    return $value;
}

define('DB_SERVER', getenv('DB_HOST') ?: 'localhost');
define('DB_SERVER_USERNAME', require_database_env('DB_USER'));
define('DB_SERVER_PASSWORD', require_database_env('DB_PASSWORD'));
define('DB_SERVER_DATABASE', require_database_env('DB_NAME'));
define('DNS', 'mysql:dbname=' . DB_SERVER_DATABASE . ';host=' . DB_SERVER);
