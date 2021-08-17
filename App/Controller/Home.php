<?php

namespace App\Controller;

class Home
{
    public function indexAction()
    {
        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="index.css">
        <div class="section">
            <div class="header">
                <span class="dark-title">UsersAdmin <img src="../src/assets/people_alt_black_24dp.svg"></span>
                <div class="content">
                    <a class="link" href="/users">Users</a>
                    <a class="link" href="/users/new">Create User</a>
                </div>
            </div>
        <div>
        HTML;
    }
}
