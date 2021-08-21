<?php

require 'config.php';

class Connection
{
  public $pdo = null;
  private static $instance;

  //// TODO: move to config file
  private $servername = "127.0.0.1";
  private $database = "users_admin";
  private $username = "root";
  private $password = "root";

  private function __construct()
  {
    if (empty(self::$pdo)) {
      $dsn = "mysql:host=$this->servername;dbname=$this->database;";
      try {
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    } else {
      echo "$this->database is already connect!";
    }
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      $object = __CLASS__;
      self::$instance = new $object;
    }
    return self::$instance;
  }
}
