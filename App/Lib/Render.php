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
                    <a class="link" href="/">Home</a>
                    <a class="link" href="/users">Users</a>
                    <a class="link-add" href="/users/new">NEW USER <img src="$base_path/src/assets/add_circle_outline_black_24dp.svg" style="margin-left: 4px; margin-bottom: 2px"></a>
                    <a class="link-add" href="#">Login/logout</a>
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
