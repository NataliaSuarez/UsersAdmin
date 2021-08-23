<?php

namespace App\Lib;

class Render
{
    public static function renderBaseTemplate($base_path, $content)
    {
        return <<<HTML
        <link rel="stylesheet" type="text/css" href="$base_path/index.css">
        <script type="text/javascript" src="$base_path/src/validation-form.js"></script>
        <div class="section">
            <div class="header">
                <div class="content">
                    <div class="desktop-navbar-container">
                        <a class="link" href="/">Home</a>
                        <a class="link" href="/users">Users</a>
                        <a class="link-add" href="/users/new">NEW USER <img src="$base_path/src/assets/add_circle_outline_black_24dp.svg" style="margin-left: 4px; margin-bottom: 2px"></a>
                        <a class="link-add" href="/logout">Logout</a>
                    </div>
                    <nav class="mobile-navbar-container">
                        <input type="checkbox" id="menu">
                        <label for="menu"> ☰ </label>
                        <ul>
                            <li><a class="link" href="/">Home</a></li>
                            <li><a class="link" href="/users">Users</a></li>
                            <li><a class="link-add" href="/users/new">NEW USER <img src="$base_path/src/assets/add_circle_outline_black_24dp.svg" style="margin-left: 4px; margin-bottom: 2px"></a></li>
                            <li><a class="link-add" href="/logout">Logout</a></li>
                            <span class="close-navbar" onclick="return closeNavbar(this);"></span>
                        </ul>
                    </nav>
                </div>
                <span class="dark-title"> Users Admin</span> <!--<img src="../src/assets/people_alt_black_24dp.svg">-->
            </div>
            {$content}
        <div>
        HTML;
    }

    public static function renderPublicBaseTemplate($base_path, $content)
    {
        return <<<HTML
        <link rel="stylesheet" type="text/css" href="$base_path/index.css">
        <script type="text/javascript" src="$base_path/src/validation-form.js"></script>
        <div class="section">
            <div class="header">
                <div class="content">
                    <div class="desktop-navbar-container">
                        <a class="link" href="/login">Login</a>
                        <a class="link" href="/registration">Register</a>
                    </div>
                    <nav class="mobile-navbar-container">
                        <input type="checkbox" id="menu">
                        <label for="menu"> ☰ </label>
                        <ul>
                            <li><a class="link" href="/login">Login</a></li>
                            <li><a class="link" href="/registration">Register</a></li>
                            <span class="close-navbar" onclick="return closeNavbar(this);"></span>
                        </ul>
                    </nav>
                </div>
                <span class="dark-title"> Users Admin</span> <!--<img src="../src/assets/people_alt_black_24dp.svg">-->
            </div>
            {$content}
        <div>
        HTML;
    }

    public static function renderUserItem($user)
    {
        if (empty($user)) {
            return '';
        }
        return <<<HTML
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
}
