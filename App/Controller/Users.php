<?php

namespace App\Controller;

use App\Model\Users as UsersRepository;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Render;

class Users
{
    public function all()
    {
        $users = UsersRepository::all();
        $renderUsers = '';

        foreach ($users as $user) {
            $renderUsers = $renderUsers . Render::renderUserItem($user);
        }

        echo Render::renderBaseTemplate('../', <<<HTML
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
        HTML);
    }

    public function new(Request $req, Response $res)
    {
        $userDataForm = $req->getBody();
        $renderAlert = '';
        if (!empty($userDataForm)) {
            $user = UsersRepository::add($userDataForm['firstname'], $userDataForm['lastname'], $userDataForm['mail']);
            $renderAlert = <<<HTML
                <span class="success-notification">{$user['first_name']} has already created with id {$user['user_id']}!<span>
            HTML;
        }

        echo Render::renderBaseTemplate('../', <<<HTML
        <div>
            {$renderAlert}
        </div>
        <div class="form-card">
            <span class="title">Create new user</span>
            <div class="form-content">
                <form action="new" method="post" class="form" onchange="return checkForm(this);">
                    <div class="text-field" style="margin-top:6px">
                        <label for="firstname">First name</label>
                        <input type="text" id="firstname" name="firstname" required placeholder="John" onchange="return validateString(this)">
                        <span class="error-text" id="error-firstname"></span>
                    </div>
                    <div class="text-field">
                        <label for="lastname">Last name</label>
                        <input type="text" id="lastname" name="lastname" required placeholder="Smith" onchange="return validateString(this)">
                        <span class="error-text" id="error-lastname"></span>
                    </div>
                    <div class="text-field">
                        <label for="mail">Mail</label>
                        <input type="email" id="mail" name="mail" placeholder="john.smith@email.com" onchange="return validateMail(this)">
                        <span class="error-text" id="error-mail"></span>
                    </div>
                    <input type="submit" id="submit" value="Add" class="submit-button">
                </form>
            </div>
        </div>
        HTML);
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
                <span class="success-notification">{$userDataForm['firstname']} has already updated!<span>
            HTML;
        }

        echo Render::renderBaseTemplate('../../', <<<HTML
            <div>
                {$renderAlert}
            </div>
            <div class="form-card">
                <span class="title">Update user</span>
                <div class="form-content">
                    <form action="/users/update/$id" method="post" class="form" onchange="return checkForm(this);">
                        <div class="text-field" style="margin-top:6px">
                            <label for="firstname">First name</label>
                            <input type="text" id="firstname" name="firstname" required placeholder="John" onchange="return validateString(this)" value={$user['first_name']}>
                            <span class="error-text" id="error-firstname"></span>
                        </div>
                        <div class="text-field">
                            <label for="lastname">Last name</label>
                            <input type="text" id="lastname" name="lastname" required placeholder="Smith" onchange="return validateString(this)" value={$user['last_name']}>
                            <span class="error-text" id="error-lastname"></span>
                        </div>
                        <div class="text-field">
                            <label for="mail">Mail</label>
                            <input type="email" id="mail" name="mail" placeholder="john.smith@email.com" onchange="return validateMail(this)" value={$user['mail']}>
                            <span class="error-text" id="error-mail"></span>
                        </div>
                        <input type="submit" id="submit" value="Update" class="submit-button">
                    </form>
                </div>
            </div>
        HTML);
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

        echo Render::renderBaseTemplate('../../../', <<<HTML
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
        HTML);
    }
}
