<?php

namespace App\Model;

use App\Lib\Config;
use Connection;

class Users
{

    public static function all()
    {
        return Connection::getInstance()->pdo->query("SELECT * FROM users")->fetchAll();
    }

    public static function add($fname, $lname, $mail, $password)
    {
        $pdo = Connection::getInstance()->pdo;


        $options = [
            'cost' => 12,
        ];
        $hash_password = password_hash($password, PASSWORD_BCRYPT, $options);

        // $hash_password = hash('sha256', $password, false); //Password encryption
        $sql = 'insert into users(first_name, last_name, mail, password) values(:first_name,:last_name, :mail, :password)';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'first_name' => $fname,
            'last_name' => $lname,
            'mail' => $mail,
            'password' => $hash_password
        ]);
        // verify $pdo->lastInsertId();
        return end($pdo->query("SELECT * FROM users")->fetchAll());
    }

    public static function findById(int $id)
    {
        $pdo = Connection::getInstance()->pdo;
        $stm = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
        $stm->bindParam(1, $id, \PDO::PARAM_INT);
        $stm->execute();
        $user = $stm->fetchAll();
        if (empty($user)) {
            return null;
        } else {
            return $user[0];
        }
    }

    public static function findByMail($mail)
    {
        // TODO: add 'OR username=:username'
        $pdo = Connection::getInstance()->pdo;
        $stm = $pdo->prepare('SELECT * FROM users WHERE mail = ?');
        $stm->bindParam(1, $mail, \PDO::PARAM_STR);
        $stm->execute();
        $user = $stm->fetchAll();
        if (empty($user)) {
            return null;
        } else {
            return $user[0];
        }
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
