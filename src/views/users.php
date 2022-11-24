<?php 
  if(!AuthController::isAdmin()){
    AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
    return;
  }

  $list = UserController::index();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("head.php"); ?>
    
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/users.css" />
    <title>Curriculum Builder</title>

  </head>
  <body>
    <?php require_once("navbar.php")?>

    <div class="container">
      <div class="users-list">
        <h1>Users</h1>
        <table>
          <thead>
            <tr>
              <th>Username</th>
              <th>Roles</th>
              <th class="text-center">Options</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($list as $item):?>
              <tr>
                <td><?= $item["username"]?></td>
                <td>
                    <?php if(count($item["roles"]) == 0) { echo "USER"; }?>
                    <?php foreach($item["roles"] as $role): ?>
                      <?= $role["name"] ?>
                    <?php endforeach;?>
                </td>
                <td class="text-center">
                  <a class="icon color-warning" href="/<?=$_ENV["BASE_DIR"] ?>/users/edit?id=<?= $item['id'] ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        
      </div>
    </div>
  </body>
</html>