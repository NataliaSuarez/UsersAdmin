<?php

namespace App\Controller;

class Home
{
    public function indexAction()
    {
        echo '
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet">
        <div style="min-height:100vh;background:#fafafa;display:flex;align-items:center;justify-content:center;flex-direction:column;font-family:Atkinson Hyperlegible,sans-serif;">
            <span style="color:#333;font-size:50px;margin: 24px;">Welcome to Users Admin</span>
            <div style="display:flex;justify-content:center;align-items:center;">
                <a style="text-transform: uppercase;margin:3px; padding:4px 8px;height: max-content;background: #333;color: yellowgreen;" href="users">Users</a>
                <a style="text-transform: uppercase;margin:3px; padding:4px 8px;height: max-content;background: #333;color: yellowgreen;" href="users/new">Create User</a>
                <a style="text-transform: uppercase;margin:3px; padding:4px 8px;height: max-content;background: #333;color: yellowgreen;" href="#">Update User</a>
                <a style="text-transform: uppercase;margin:3px; padding:4px 8px;height: max-content;background: #333;color: yellowgreen;" href="#">Remove User</a>
            </div>
        <div>';
    }
}
