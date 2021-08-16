<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\Config;
use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;
use App\Controller\Users;

include "Connection.php";

$LOG_PATH = Config::get('LOG_PATH', '');

$conn = Connection::getInstance();

Router::get('/', function () {
  (new Home())->indexAction();
});

Router::get('/users', function (Request $req, Response $res) {
  (new Users())->all();
});

Router::get('/users/new', function (Request $req, Response $res) {
  (new Users())->newForm($req, $res);
});

Router::post('/users/new', function (Request $req, Response $res) {
  (new Users())->new($req, $res);
});

Router::get('/api/user/([0-9]*)', function (Request $req, Response $res) {
  $res->toJSON([
    'user' =>  ['id' => $req->params[0]],
    'status' => 'ok'
  ]);
});

App::run();
