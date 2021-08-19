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
                    <div class="section" id->
                        <div class="header-home">
                            <div class="content">
                                <a class="link" href="/users">Users list</a>
                                <a class="link-add" href="/users/new"><img src="../src/assets/add_circle_outline_black_24dp.svg">ADD NEW
                                USER</a>
                                <a class="link-add" href="#">Login/logout</a>
                            </div>
                            <span class="dark-title"> Users Admin</span> <!--<img src="../src/assets/people_alt_black_24dp.svg">-->
                        </div>
                        <div style="height: 70%;">
                            <div style="padding-left: 20vw;padding-top: 10vh;">
                                <img class="icon-float-loop" src="../src/assets/boy-1.svg" height="120px"/>
                                <img class="icon-float-loop-2" src="../src/assets/girl-1.svg" height="120px"/>
                                <img class="icon-float-loop-3" src="../src/assets/boy-2.svg" height="120px"/>
                            </div>
                            <div class="description">
                                <div class="text-description-title">user management application</div>
                                <div class="text-description">
                                    this application implements the basic operations of creation, update and deletion without limitation of roles.</br>
                                    Register now!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-actions" id="actions-section">
                        <div class="dark-title" style="height:20%">main actions</div>
                            <div class="slider">
                                <a href="#slide-1"></a>
                                <a href="#slide-2"></a>
                                <a href="#slide-3"></a>
                                <a href="#slide-4"></a>
                                <a href="#slide-5"></a>
                                <div class="slides">
                                    <div id="slide-1">
                                        <span>
                                            Create</br>
                                            <p>
                                                Users can create another users from the admin view. 
                                            </p></br>
                                            <a href="/users/new">Go to create user!</a>
                                        </span>
                                        <img src="../src/assets/upload.svg" width="150px"/>
                                    </div>
                                    <div id="slide-2">
                                        <span>
                                            Update</br>
                                            <p>Users can update individual user data of all users, without restrictions.</p>
                                        </span>
                                        <img src="../src/assets/update.svg" width="150px"/>
                                    </div>
                                    <div id="slide-3">
                                        <span>
                                            Remove</br>
                                            <p>Users can delete another users.</p>
                                        </span>
                                        <img src="../src/assets/delete.svg" width="150px"/>
                                    </div>
                                    <div id="slide-4">
                                        <span>
                                            Visualization</br>
                                            <p>All users are visibles from the admin home of users. The list has the main data of each user.</p>
                                            <a href="/users">Go to admin and see all users!</a>
                                        </span>
                                        <img src="../src/assets/users.svg" width="150px"/>
                                    </div>
                                    <div id="slide-5">
                                        <span>
                                            Registration</br>
                                            <p>To enjoy the application you can register now!</p>
                                        </span>
                                        <img src="../src/assets/approve.svg" width="150px"/>
                                    </div>
                            </div>
                        </div>
                        <div class="dark-section"></div>
                    </div>
                </body>
            </html>
        HTML;
    }
}
