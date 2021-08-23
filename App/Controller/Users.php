<?php

namespace App\Controller;

use App\Model\Users as UsersRepository;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Render;
use Exception;

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
                <div class="card-container" style="width:90%">
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
            $user = UsersRepository::add($userDataForm['firstname'], $userDataForm['lastname'], $userDataForm['mail'], $userDataForm['password']);
            $renderAlert = <<<HTML
                <span class="success-notification">{$user['first_name']} has already created with id {$user['user_id']}!<span>
            HTML;
            header("refresh:1;url=/users");
        }

        echo Render::renderBaseTemplate('../', <<<HTML
        <div>
            {$renderAlert}
        </div>
        <div class="card-container">
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
                    <div class="text-field">
                        <label for="mail">Password</label>
                        <input type="password" id="password" name="password" placeholder="********">
                        <!-- onchange="return validatePassword(this)" -->
                        <span class="error-password" id="error-password"></span>
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
            header("refresh:1;url=/users");
        }

        echo Render::renderBaseTemplate('../../', <<<HTML
            <div>
                {$renderAlert}
            </div>
            <div class="card-container">
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
                        <!-- <div class="text-field">
                            <label for="mail">Password</label>
                            <input type="password" id="password" name="password" placeholder="********">
                            <span class="error-password" id="error-password"></span>
                        </div> -->
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
                <div class="card-container" style="width:90%">
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

    public function login(Request $req, Response $res)
    {
        $userDataForm = $req->getBody();
        $renderAlert = '';
        $loginForm = <<<HTML
            <div class="card-container">
                <span class="title">Login</span>
                <div class="form-content">
                    <form action="login" method="post" class="form" onchange="return checkForm(this);">
                        <div class="text-field">
                            <label for="mail">Mail</label>
                            <input type="email" id="mail" name="mail" placeholder="john.smith@email.com" onchange="return validateMail(this)">
                            <span class="error-text" id="error-mail"></span>
                        </div>
                        <div class="text-field">
                            <label for="mail">Password</label>
                            <input type="password" id="password" name="password" placeholder="********">
                            <!-- onchange="return validatePassword(this)" -->
                            <span class="error-password" id="error-password"></span>
                        </div>
                        <span>
                            <a href="/registration" style="font-size:12px;">Create a new account</a>
                        </span>
                        <input type="submit" id="submit" value="Login" class="submit-button">
                    </form>
                </div>
            </div>
        HTML;

        /// render login form
        if (empty($userDataForm)) {
            echo Render::renderPublicBaseTemplate('../', <<<HTML
            <div>
                {$renderAlert}
            </div>
            {$loginForm}
            HTML);
            return;
        }

        /// user not exists -> render form with error
        $user = UsersRepository::findByMail($userDataForm['mail']);
        if (empty($user)) {
            $renderAlert = <<<HTML
                    <span class="error-notification">{$userDataForm['mail']} isn's exists yet!<span>
                HTML;
            echo Render::renderPublicBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                {$loginForm}
            HTML);
            return;
        }

        $mail = $user['mail'];
        $password = $user['password'];
        if ($mail === $userDataForm['mail'] && password_verify($userDataForm['password'], $password)) {
            $_SESSION['uid'] = $user['user_id'];
            $renderAlert = <<<HTML
                    <span class="success-notification">You're logged now!<span>
                HTML;
            header("refresh:0;url=/");
            echo Render::renderBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                {$loginForm}
            HTML);
            return;
        } else {
            $renderAlert = <<<HTML
                    <span class="success-notification">Mail or passwords are not ok!<span>
                HTML;
            echo Render::renderPublicBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                {$loginForm}
            HTML);
            return;
        }
    }

    public function registration(Request $req, Response $res)
    {
        $userDataForm = $req->getBody();
        $renderAlert = '';
        $registerForm = <<<HTML
            <div class="card-container">
                <span class="title">Sign up</span>
                <div class="form-content">
                    <form action="registration" method="post" class="form" onchange="return checkForm(this);">
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
                        <div class="text-field">
                            <label for="mail">Password</label>
                            <input type="password" id="password" name="password" placeholder="********">
                            <!-- onchange="return validatePassword(this)" -->
                            <span class="error-password" id="error-password"></span>
                        </div>
                        <span>
                            <a href="/login" style="font-size:12px;">Do you have an account?</a>
                        </span>
                        <input type="submit" id="submit" value="Add" class="submit-button">
                    </form>
                </div>
            </div>
        HTML;

        try {
            /// get -> render with form
            if (empty($userDataForm)) {
                echo Render::renderPublicBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                {$registerForm}
                HTML);
                return;
            }

            /// user already exist -> render form with error
            if (!empty(UsersRepository::findByMail($userDataForm['mail']))) {
                $renderAlert = <<<HTML
                    <span class="error-notification">{$userDataForm['mail']} is already exists!<span>
                HTML;
                echo Render::renderPublicBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                {$registerForm}
                HTML);
                return;
            }

            /// try save user
            $user = UsersRepository::add($userDataForm['firstname'], $userDataForm['lastname'], $userDataForm['mail'], $userDataForm['password']);
            $renderAlert = <<<HTML
                <span class="success-notification">{$user['first_name']} was created!<span>
            HTML;
            // $_SESSION['uid'] = $user['user_id'];
            // var_dump($user['user_id']);
            // var_dump($_SESSION);

            /// render login
            echo Render::renderPublicBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                <div class="card-container">
                    <span class="title">Login</span>
                    <div class="form-content">
                        <form action="login" method="post" class="form" onchange="return checkForm(this);">
                            <div class="text-field">
                                <label for="mail">Mail</label>
                                <input type="email" id="mail" name="mail" placeholder="john.smith@email.com" onchange="return validateMail(this)">
                                <span class="error-text" id="error-mail"></span>
                            </div>
                            <div class="text-field">
                                <label for="mail">Password</label>
                                <input type="password" id="password" name="password" placeholder="********">
                                <!-- onchange="return validatePassword(this)" -->
                                <span class="error-password" id="error-password"></span>
                            </div>
                            <input type="submit" id="submit" value="Add" class="submit-button">
                        </form>
                    </div>
                </div>
            HTML);
            return;
        } catch (Exception $e) {
            var_dump($e);
            $renderAlert = <<<HTML
                <span class="error-notification">Something went wrong!<span>
            HTML;
            echo Render::renderPublicBaseTemplate('../', <<<HTML
                <div>
                    {$renderAlert}
                </div>
                {$registerForm}
            HTML);
            return;
        }
    }

    public function logout(Request $req, Response $res)
    {
        $renderAlert = '';
        $loginForm = <<<HTML
            <div class="card-container">
                <span class="title">Login</span>
                <div class="form-content">
                    <form action="login" method="post" class="form" onchange="return checkForm(this);">
                        <div class="text-field">
                            <label for="mail">Mail</label>
                            <input type="email" id="mail" name="mail" placeholder="john.smith@email.com" onchange="return validateMail(this)">
                            <span class="error-text" id="error-mail"></span>
                        </div>
                        <div class="text-field">
                            <label for="mail">Password</label>
                            <input type="password" id="password" name="password" placeholder="********">
                            <!-- onchange="return validatePassword(this)" -->
                            <span class="error-password" id="error-password"></span>
                        </div>
                        <span>
                            <a href="/registration" style="font-size:12px;">Create a new account</a>
                        </span>
                        <input type="submit" id="submit" value="Login" class="submit-button">
                    </form>
                </div>
            </div>
        HTML;

        $_SESSION['uid'] = null;

        echo Render::renderPublicBaseTemplate('../', <<<HTML
            <div>
                {$renderAlert}
            </div>
            {$loginForm}
            HTML);
        return;
    }
}
