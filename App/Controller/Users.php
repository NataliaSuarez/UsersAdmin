<?php

namespace App\Controller;

use App\Model\Users as UsersRepository;
use App\Lib\Request;
use App\Lib\Response;

class Users
{
    public function all()
    {
        $users = UsersRepository::all();
        $renderUsers = '';

        foreach ($users as $user) {
            $renderUsers = $renderUsers . <<<HTML
                <div style='background:#333;color:yellowgreen;font-size:16px;padding: 18px; margin-bottom: 10px'>
                    <span>{$user['user_id']}<span>
                    <span>{$user['first_name']}<span>
                    <span>{$user['last_name']}<span>
                    <span>{$user['mail']}<span>
                </div>
            HTML;
        }
        echo <<<HTML
            <html>
            <body style='min-height:90vh;background:#fafafa;display:flex;align-items:center;justify-content:center;flex-direction:column;'>
                <link rel='preconnect' href='https://fonts.googleapis.com'>
                <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                <link href='https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap' rel='stylesheet'>
                <div style='font-family:Atkinson Hyperlegible,sans-serif;'>
                    <span style='color:#333;font-size:50px;margin: 18px;'>
                    Users
                    </span>
                    <div>{$renderUsers}</div>
                <div>
            </body>
            </html>
        HTML;
    }

    public function newForm()
    {
        echo '
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet">
        <div style="min-height:100vh;background:#fafafa;display:flex;align-items:center;justify-content:center;flex-direction:column;font-family:Atkinson Hyperlegible,sans-serif;">
            <span style="color:#333;font-size:50px;margin: 18px;">Create new user</span>
            <form action="new" method="post">
                <label for="firstname">First name:</label>
                <input type="text" id="firstname" name="firstname"><br><br>
                <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname"><br><br>
                <label for="mail">Mail:</label>
                <input type="text" id="mail" name="mail"><br><br>
                <input type="submit" value="Submit">
            </form>
        <div>';
    }

    public function new(Request $req, Response $res)
    {
        $userDataForm = $req->getBody();
        $user = UsersRepository::add($userDataForm['firstname'], $userDataForm['lastname'], $userDataForm['mail']);

        echo '
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet">
        <div style="min-height:100vh;background:#fafafa;display:flex;align-items:center;justify-content:center;flex-direction:column;font-family:Atkinson Hyperlegible,sans-serif;">
            <span style="color:#333;font-size:50px;margin: 18px;">creating</span>
        <div>';
    }
}
