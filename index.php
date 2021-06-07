<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use App\Core\{Router, Request};

try {
    Router::load('app/routes.php')
        ->direct(Request::uri(), Request::method());

} catch (\Exception $e) {
    switch ($e->getCode()) {
        case 404:
            header('HTTP/1.1 404');
            echo json_encode($e->getMessage());
            break;
        default:
            header('HTTP/1.1 500');
            echo json_encode($e->getMessage());
    }
}
