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

session_start();
$conn = Connection::getInstance();

require('./migrations.php');

if (!empty($_SESSION['uid'])) {
  $session_uid = $_SESSION['uid'];
  Router::get('/', function () {
    (new Home())->indexAction();
  });

  Router::get('/users', function (Request $req, Response $res) {
    (new Users())->all();
  });

  Router::get('/users/new', function (Request $req, Response $res) {
    (new Users())->new($req, $res);
  });

  Router::post('/users/new', function (Request $req, Response $res) {
    (new Users())->new($req, $res);
  });

  Router::get('/users/update/([0-9]*)', function (Request $req, Response $res) {
    (new Users())->update($req, $res);
  });

  Router::post('/users/update/([0-9]*)', function (Request $req, Response $res) {
    (new Users())->update($req, $res);
  });

  Router::get('/users/remove/([0-9]*)', function (Request $req, Response $res) {
    (new Users())->remove($req, $res);
  });

  Router::get('/logout', function (Request $req, Response $res) {
    (new Users())->logout($req, $res);
  });

  // API REST
  // Router::get('/api/user/([0-9]*)', function (Request $req, Response $res) {
  //   $res->toJSON([
  //     'user' =>  ['id' => $req->params[0]],
  //     'status' => 'ok'
  //   ]);
  // });
}
if (empty($session_uid)) {
  Router::get('/login', function (Request $req, Response $res) {
    (new Users())->login($req, $res);
  });
  Router::post('/login', function (Request $req, Response $res) {
    (new Users())->login($req, $res);
  });
  Router::get('/registration', function (Request $req, Response $res) {
    (new Users())->registration($req, $res);
  });
  Router::post('/registration', function (Request $req, Response $res) {
    (new Users())->registration($req, $res);
  });
}

App::run();
