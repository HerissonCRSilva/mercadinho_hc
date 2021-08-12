<?php

namespace MercadinhoHC;

require 'constants.php';
require __DIR__ . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': $the_request = &$_GET;
        break;
    case 'POST': $the_request = &$_POST;
        break;
    default:
        $the_request = null;
}

if ($uri == '/') {
    $uri = "/Venda/verTodas";
}

$src = explode('/', $uri);
$model = ucfirst($src[1]);
$controller = $model . 'Controller';
$method = (isset($src[2])) ? $src[2] : 'index';

if (isset($src[3]) && empty($the_request)) {
    $the_request = filter_var($src[3], FILTER_SANITIZE_STRING);
}

/*
 * call current class/method
 */
try {
    $controller = __NAMESPACE__ . '\\app\\controller\\' . $controller;
    $class = new $controller();
    $set = $class->$method($the_request);
} catch (Exception $e) {
    echo 'No ' . $controller . ' found for this route', $e->getMessage(), "\n";
}

/*
 * Declare all variables if passed in return
 */
if (!empty($set) && is_array($set)) {
    foreach ($set as $k => $v) {
        ${$k} = $v;
    }
}

/*
 * If method has a view file, include
 */
$view_file = APP_VIEW . $model . DS . $method . PHP;
if (file_exists($view_file)) {
    include $view_file;
}