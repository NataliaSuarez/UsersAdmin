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
                    <script type="text/javascript" src="../src/validation-form.js"></script>
                </head>
                <body>
                    <div class="section" id="home">
                        <div class="header-home">
                            <div class="content">
                                <div class="desktop-navbar-container">
                                    <a class="link" href="/">Home</a>
                                    <a class="link" href="/users">Users</a>
                                    <a class="link-add" href="/users/new">NEW USER <img src="../src/assets/add_circle_outline_black_24dp.svg" style="margin-left: 4px; margin-bottom: 2px"></a>
                                    <a class="link-add" href="/logout">Logout</a>
                                </div>
                                <nav class="mobile-navbar-container">
                                    <input type="checkbox" id="menu">
                                    <label for="menu"> ☰ </label>
                                    <ul>
                                        <li><a class="link" href="/">Home</a></li>
                                        <li><a class="link" href="/users">Users</a></li>
                                        <li><a class="link-add" href="/users/new">NEW USER <img src="../src/assets/add_circle_outline_black_24dp.svg" style="margin-left: 4px; margin-bottom: 2px"></a></li>
                                        <li><a class="link-add" href="#">Login/logout</a></li>
                                        <span class="close-navbar" onclick="return closeNavbar(this);"></span>
                                    </ul>
                                </nav>
                            </div>
                            <span class="dark-title"> Users Admin</span> <!--<img src="../src/assets/people_alt_black_24dp.svg">-->
                        </div>
                        <div class="section-home-animation">
                            <div style="icons-animation-container">
                                <img class="icon-float-loop" src="../src/assets/boy-1.svg"/>
                                <img class="icon-float-loop-2" src="../src/assets/girl-1.svg"/>
                                <img class="icon-float-loop-3" src="../src/assets/boy-3.svg"/>
                                <!-- <img class="icon-float-loop" src="../src/assets/girl-2.svg"/>
                                <img class="icon-float-loop-3" src="../src/assets/boy-2.svg"/> -->
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
                        <div class="dark-title" style="height:30%">Main actions</div>
                            <div class="slider">
                                <a href="#slide-1"></a>
                                <a href="#slide-2"></a>
                                <a href="#slide-3"></a>
                                <a href="#slide-4"></a>
                                <a href="#slide-5"></a>
                                <div class="slides">
                                    <div id="slide-1">
                                        <span>
                                            Visualization</br>
                                            <p>All users are visibles from the admin home of users. The list has the main data of each user.</p>
                                            <a href="/users">Go to admin and see all users!</a>
                                        </span>
                                        <img src="../src/assets/users.svg" width="150px"/>
                                    </div>
                                    <div id="slide-2">
                                        <span>
                                            Registration</br>
                                            <p>To enjoy the application you can register now!</p>
                                        </span>
                                        <img src="../src/assets/approve.svg" width="150px"/>
                                    </div>
                                    <div id="slide-3">
                                        <span>
                                            Create</br>
                                            <p>
                                                Users can create another users from the admin view. 
                                            </p></br>
                                            <a href="/users/new">Go to create user!</a>
                                        </span>
                                        <img src="../src/assets/upload.svg" width="150px"/>
                                    </div>
                                    <div id="slide-4">
                                        <span>
                                            Update</br>
                                            <p>Users can update individual user data of all users, without restrictions.</p>
                                        </span>
                                        <img src="../src/assets/update.svg" width="150px"/>
                                    </div>
                                    <div id="slide-5">
                                        <span>
                                            Remove</br>
                                            <p>Users can delete another users.</p>
                                        </span>
                                        <img src="../src/assets/delete.svg" width="150px"/>
                                    </div>
                            </div>
                        </div>
                        <div class="dark-section"></div>
                    </div>
                    <div class="nav-button-container">
                        <a id="swipe-button" href="" class="nav-button" onclick="return toggleSwipeButton(this)">
                            <span>^</span>
                        <a/>
                    </div>
                </body>
            </html>
        HTML;
    }
}
