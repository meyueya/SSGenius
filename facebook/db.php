<?php
session_start();

function required_database_environment($name)
{
    $value = getenv($name);
    if ($value === false || $value === '') {
        throw new RuntimeException('Missing required environment variable: ' . $name);
    }
    return $value;
}

function obtenerDireccionIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
}

function restringirConjuntoIps($ips)
{
    if (!in_array(obtenerDireccionIP(), $ips, true)) {
        header('Location: /denied.php');
        exit;
    }
    return true;
}

function restringirIp($ip)
{
    if (obtenerDireccionIP() !== $ip) {
        header('Location: /denied.php');
        exit;
    }
    return true;
}

$groups = array(
    'PEC' => array(
        'usuario' => getenv('DB_PEC_USER'),
        'clave' => getenv('DB_PEC_PASSWORD'),
        'db' => getenv('DB_PEC_NAME'),
        'nombreCarrera' => 'PEC'
    ),
    'ILCB' => array(
        'usuario' => getenv('DB_ILCB_USER'),
        'clave' => getenv('DB_ILCB_PASSWORD'),
        'db' => getenv('DB_ILCB_NAME'),
        'nombreCarrera' => 'ILCB'
    ),
    'MASTER' => array(
        'usuario' => getenv('DB_MASTER_USER'),
        'clave' => getenv('DB_MASTER_PASSWORD'),
        'db' => getenv('DB_MASTER_NAME'),
        'nombreCarrera' => 'MASTER'
    ),
    'ULCB' => array(
        'usuario' => getenv('DB_ULCB_USER'),
        'clave' => getenv('DB_ULCB_PASSWORD'),
        'db' => getenv('DB_ULCB_NAME'),
        'nombreCarrera' => 'ULCB'
    )
);

$group = isset($_GET['grupo']) ? $_GET['grupo'] : 'ILCB';
if (!isset($groups[$group])) {
    throw new InvalidArgumentException('Unknown database group.');
}

$config = $groups[$group];
foreach (array('usuario', 'clave', 'db') as $requiredKey) {
    if ($config[$requiredKey] === false || $config[$requiredKey] === '') {
        throw new RuntimeException('Missing database environment configuration for ' . $group);
    }
}

$_SESSION['user'] = $config['usuario'];
$_SESSION['pass'] = $config['clave'];
$_SESSION['db'] = $config['db'];

$db = mysql_connect(getenv('DB_HOST') ?: 'localhost', $_SESSION['user'], $_SESSION['pass'])
    or die('Database connection failed.');
mysql_select_db($_SESSION['db'], $db) or die('Database selection failed.');
