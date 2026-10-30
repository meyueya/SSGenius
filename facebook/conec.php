<?php
function ssg_required_env($name)
{
    $value = getenv($name);
    if ($value === false || $value === '') {
        throw new RuntimeException('Missing required environment variable: ' . $name);
    }
    return $value;
}

$server = getenv('DB_HOST') ?: 'localhost';
$username = ssg_required_env('DB_USER');
$password = ssg_required_env('DB_PASSWORD');
$database = ssg_required_env('DB_NAME');

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    throw new RuntimeException('Database connection failed.');
}
