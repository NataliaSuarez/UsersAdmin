<?php

namespace App\Controller;

class Home
{
    public function indexAction()
    {
        echo <<<HTML
        <link rel="stylesheet" type="text/css" href="index.css">
        <div class="section">
            <span class="dark-title">Users Admin</span>
            <div class="content">
                <a class="link" href="/users">Users</a>
                <a class="link" href="/users/new">Create User</a>
                <a class="link" href="#">Update User</a>
                <a class="link" href="#">Remove User</a>
            </div>
        <div>
        HTML;
    }
}
