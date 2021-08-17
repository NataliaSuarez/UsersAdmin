<?php

namespace App\Controller;

class Home
{
    public function indexAction()
    {
        echo <<<HTML
            <html>
                <head>
                    <title>Users Admin - Project</title>
                    <link rel="stylesheet" type="text/css" href="index.css">
                </head>
                <body>
                    <div class="section">
                        <div class="header">
                            <span class="dark-title"><img src="../src/assets/people_alt_black_24dp.svg"> Users Admin</span>
                            <div class="content">
                                <a class="link" href="/users">Users list</a>
                                <a class="link-add" href="/users/new"><img src="../src/assets/add_circle_outline_black_24dp.svg">ADD NEW
                                USER</a>
                            </div>
                        </div>
                    <div>
                </body>
            </html>
        HTML;
    }
}
