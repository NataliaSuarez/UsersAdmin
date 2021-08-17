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
                    <td class="table-cell-button-action">
                        <a href="/users/update/{$user['user_id']}">
                            <img class="table-row-button-action" src="../src/assets/edit_black_24dp.svg">
                        </a>
                    </td>
                    <td class="table-cell-button-action">
                        <a href="/users/remove/{$user['user_id']}">
                            <img class="table-row-button-action" src="../src/assets/delete_outline_black_24dp.svg">
                        </a>
                    </td>
                </tr>
            HTML;
        }

        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="index.css">
        <div class="section">
            <span class="dark-title">UsersAdmin <img src="../src/assets/people_alt_black_24dp.svg"></span>
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
                            <th></th>
                            <th></th>
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
            <span class="dark-title">UsersAdmin <img src="../src/assets/people_alt_black_24dp.svg"></span>
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
    }

    public function update(Request $req, Response $res)
    {
        $userDataForm = $req->getBody();
        $id = $req->params[0];
        $renderAlert = '';
        $user = UsersRepository::findById($id);

        /// update form data
        if (!empty($userDataForm)) {
            $user = UsersRepository::update($id, $userDataForm['firstname'], $userDataForm['lastname'], $userDataForm['mail']);
            $renderAlert = <<<HTML
                <!-- <span class="success-notification">{$user['first_name']} has already updated!<span> -->
                <span class="success-notification">{$userDataForm['firstname']} has already updated!<span>
            HTML;
        }

        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="../../index.css">
        <div class="section">
            <span class="dark-title">UsersAdmin <img src="../../src/assets/people_alt_black_24dp.svg"></span>
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
                    <form action="/users/update/$id" method="post" class="form">
                        <div class="text-field" style="margin-top:6px">
                            <label for="firstname">First name</label>
                            <input type="text" id="firstname" name="firstname" value={$user['first_name']}>
                        </div>
                        <div class="text-field">
                            <label for="lastname">Last name</label>
                            <input type="text" id="lastname" name="lastname" value={$user['last_name']}>
                        </div>
                        <div class="text-field">
                            <label for="mail">Mail</label>
                            <input type="email" id="mail" name="mail" value={$user['mail']}>
                        </div>
                        <input type="submit" value="Update" class="submit-button">
                    </form>
                </div>
            </div>
        <div>
        HTML;
    }

    public function remove(Request $req, Response $res)
    {
        $id = $req->params[0];
        $renderAlert = '';
        if (UsersRepository::remove($id)) {
            $renderAlert = <<<HTML
                <span class="success-notification">User with id {$id} has already removed!<span>
            HTML;
        }
        $users = UsersRepository::all();
        $renderUsers = '';
        foreach ($users as $user) {
            $renderUsers = $renderUsers . <<<HTML
                <tr class="table-row-item">
                    <td>{$user['user_id']}</td>
                    <td>{$user['first_name']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['mail']}</td>
                    <td class="table-cell-button-action">
                        <a href="/users/update/{$user['user_id']}">
                            <img class="table-row-button-action" src="../../../src/assets/edit_black_24dp.svg">
                        </a>
                    </td>
                    <td class="table-cell-button-action">
                        <a href="/users/remove/{$user['user_id']}">
                            <img class="table-row-button-action" src="../../../src/assets/delete_outline_black_24dp.svg">
                        </a>
                    </td>
                </tr>
            HTML;
        }

        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="../../index.css">
        <div class="section">
            <span class="dark-title">UsersAdmin <img src="../../../src/assets/people_alt_black_24dp.svg"></span>
            <div class="content">
                <a class="link" href="/users">Users</a>
                <a class="link" href="/users/new">Create User</a>
                <a class="link" href="#">Update User</a>
                <a class="link" href="#">Remove User</a>
            </div>
            <div>
                {$renderAlert}
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
                            <th></th>
                            <th></th>
                        </tr>                       
                        {$renderUsers}
                    </table>
                </div>
            </div>
        <div>
        HTML;
    }
}
