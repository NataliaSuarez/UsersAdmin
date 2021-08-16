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
                <tr class="table-row-item">
                    <td>{$user['user_id']}</td>
                    <td>{$user['first_name']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['mail']}</td>
                </tr>
            HTML;
        }

        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="index.css">
        <div class="section">
            <span class="dark-title">Users Admin</span>
            <div class="content">
                <a class="link" href="users">Users</a>
                <a class="link" href="users/new">Create User</a>
                <a class="link" href="#">Update User</a>
                <a class="link" href="#">Remove User</a>
            </div>
            <div class="list-content">
                <div class="form-card" style="width:90%; height: 70vh">
                    <span class="title">
                        Users
                    </span>
                    <table class="table-list">
                        <tr class="table-header">
                            <th># ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>@</th>
                        </tr>                       
                        {$renderUsers}
                    </table>
                </div>
            </div>
        <div>
        HTML;
    }

    public function new(Request $req, Response $res)
    {
        $userDataForm = $req->getBody();
        $renderAlert = '';
        if (!empty($userDataForm)) {
            $user = UsersRepository::add($userDataForm['firstname'], $userDataForm['lastname'], $userDataForm['mail']);
            $renderAlert = <<<HTML
                <span class="success-notification">{$user['first_name']} has already created with id {$user['user_id']}!<span>
                <!-- <button class="notification-button">x</button> -->
            HTML;
        }

        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="../index.css">
        <div class="section">
            <span class="dark-title">Users Admin</span>
            <div class="content">
                <a class="link" href="/users">Users</a>
                <a class="link" href="/users/new">Create User</a>
                <a class="link" href="#">Update User</a>
                <a class="link" href="#">Remove User</a>
            </div>
            <div>
                {$renderAlert}
            </div>
            <div class="form-card">
                <span class="title">Create new user</span>
                <div class="form-content">
                    <form action="new" method="post" class="form">
                        <div class="text-field" style="margin-top:6px">
                            <label for="firstname">First name</label>
                            <input type="text" id="firstname" name="firstname">
                        </div>
                        <div class="text-field">
                            <label for="lastname">Last name</label>
                            <input type="text" id="lastname" name="lastname">
                        </div>
                        <div class="text-field">
                            <label for="mail">Mail</label>
                            <input type="email" id="mail" name="mail">
                        </div>
                        <input type="submit" value="Add" class="submit-button">
                    </form>
                </div>
            </div>
        <div>
        HTML;

        // echo <<<HTML
        // <link rel="stylesheet" type="text/css" href="../index.css">
        // <div class="dark-section">
        // <div>
        //     {$renderAlert}
        // </div>
        // <div class="form-card">
        //     <span class="title">Create new user</span>
        //     <div class="form-content">
        //         <form action="new" method="post" class="form">
        //             <div class="text-field">
        //                 <label for="firstname">First name</label>
        //                 <input type="text" id="firstname" name="firstname">
        //             </div>
        //             <div class="text-field">
        //                 <label for="lastname">Last name</label>
        //                 <input type="text" id="lastname" name="lastname">
        //             </div>
        //             <div class="text-field">
        //                 <label for="mail">Mail</label>
        //                 <input type="email" id="mail" name="mail">
        //             </div>
        //             <input type="submit" value="Add" class="submit-button">
        //         </form>
        //     </div>
        // </div>
        // <div>
        // HTML;
    }
}
