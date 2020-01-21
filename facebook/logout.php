<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location: https://ssgenius.com/app/facebook/login');
exit();