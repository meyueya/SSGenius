<?php
function ssg_model_required_env($name)
{
    $value = getenv($name);
    if ($value === false || $value === '') {
        throw new RuntimeException('Missing required environment variable: ' . $name);
    }
    return $value;
}

define('DB_SERVER', getenv('DB_HOST') ?: 'localhost');
define('DB_SERVER_USERNAME', ssg_model_required_env('DB_USER'));
define('DB_SERVER_PASSWORD', ssg_model_required_env('DB_PASSWORD'));
define('DB_SERVER_DATABASE', ssg_model_required_env('DB_NAME'));
define('DNS', 'mysql:dbname=' . DB_SERVER_DATABASE . ';host=' . DB_SERVER);
