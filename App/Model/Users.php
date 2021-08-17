<?php

namespace App\Model;

use App\Lib\Config;
use Connection;

class Users
{
    // public $list = [];

    public static function all()
    {
        return Connection::getInstance()->pdo->query("SELECT * FROM users")->fetchAll();
    }

    public static function add($fname, $lname, $mail)
    {
        $pdo = Connection::getInstance()->pdo;
        $sql = 'insert into users(first_name, last_name, mail) values(:first_name,:last_name, :mail)';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'last_name' => $fname,
            'first_name' => $lname,
            'mail' => $mail,
        ]);
        return end($pdo->query("SELECT * FROM users")->fetchAll());
    }

    public static function findById(int $id)
    {
        return Connection::getInstance()->pdo->query("SELECT * FROM users WHERE user_id = $id")->fetchAll()[0];
    }

    public static function update($id, $fname, $lname, $mail)
    {
        $pdo = Connection::getInstance()->pdo;
        $sql = 'UPDATE users
        SET first_name = :first_name, last_name = :last_name, mail = :mail
        WHERE user_id = :user_id';

        // prepare statement
        $statement = $pdo->prepare($sql);

        // bind params
        $statement->bindParam(':user_id', $id);
        $statement->bindParam(':first_name', $fname);
        $statement->bindParam(':last_name', $lname);
        $statement->bindParam(':mail', $mail);
        if ($statement->execute()) {
            return $pdo->query("SELECT * FROM users WHERE user_id = $id")->fetchAll()[0];
        }
    }

    public static function remove($id)
    {
        $pdo = Connection::getInstance()->pdo;
        $sql = 'DELETE FROM users WHERE user_id = :user_id';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':user_id', $id);
        if ($statement->execute()) {
            return true;
        }
    }
}
