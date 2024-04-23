<?php
require_once 'vendor/autoload.php';


use App\Controllers\UploadController;

$routes = [
    '/' => 'index',
    '/upload-and-zip' => 'handleUploadAndZip'
];

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $route = rtrim($requestUri, '/');


if (array_key_exists($route, $routes)) {
    $controller = new UploadController();
    $methodName = $routes[$route];
    $controller->$methodName();

    exit();
}

http_response_code(404);
echo '404 Not Found';

?>
