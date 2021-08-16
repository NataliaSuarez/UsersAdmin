<?php

namespace App\Model;

use App\Lib\Config;
use Connection;

class Users
{
    private static $DATA = [];

    public static function all()
    {
        $list = Connection::getInstance()->pdo->query("SELECT * FROM users")->fetchAll();
        return $list;
    }

    public static function add($fname, $lname, $mail)
    {

        $sql = 'insert into users(first_name, last_name, mail) values(:first_name,:last_name, :mail)';
        $statement = Connection::getInstance()->pdo->prepare($sql);
        $statement->execute([
            'last_name' => $fname,
            'first_name' => $lname,
            'mail' => $mail,
        ]);
        return Connection::getInstance()->pdo->query("SELECT * FROM users")->fetchAll()[-1];
    }

    public static function findById(int $id)
    {
        foreach (self::$DATA as $user) {
            if ($user->id === $id) {
                return $user;
            }
        }
        return [];
    }

    public static function load()
    {
        $DB_PATH = Connection::getInstance()->pdo;
        self::$DATA = json_decode(file_get_contents($DB_PATH));
    }

    public static function save()
    {
        $DB_PATH = Config::get('DB_PATH', __DIR__ . '/../../db.json');
        file_put_contents($DB_PATH, json_encode(self::$DATA, JSON_PRETTY_PRINT));
    }
}
