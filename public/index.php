<?php
require_once __DIR__.'/../vendor/autoload.php';

use CapMousse\ReactRestify\Server;
use CapMousse\ReactRestify\Runner;

$server = new Server("ReactAPI", "0.0.0.1");

$server->any('/products', 'App\Controllers\ProductController')->where('id', '[0-9]?');
$server->on('NotFound', function($request, $response, $next){
    $response->write('You fail, 404');
    $response->setStatus(404);
    $next();
});

$runner = new Runner($server);
$runner->listen(1337);