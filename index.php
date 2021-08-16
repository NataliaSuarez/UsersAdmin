<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\Config;
use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;


$LOG_PATH = Config::get('LOG_PATH', '');

Router::get('/', function () {
  (new Home())->indexAction();
});

Router::get('/user/([0-9]*)', function (Request $req, Response $res) {
    $res->toJSON([
        'user' =>  ['id' => $req->params[0]],
        'status' => 'ok'
    ]);
});

App::run();