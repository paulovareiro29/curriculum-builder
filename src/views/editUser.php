<?php
if (!AuthController::isAdmin()) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  return;
}

$user = UserController::get($_GET['id']);
if ($user === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/users");
$roles = RoleController::index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>
  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/edit.css" />

  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="container">
  <div id="badge-edit-success" class="alert alert-success d-none">Curriculum has been saved successfuly!</div>
  <div id="badge-edit-error" class="alert alert-danger d-none">An error occured while trying to save.</div>
</div>

<div class="container">
  <div class="edit-container">
    <nav id="edit-navigation" class="col">
      <ul>
        <li class="active" data-link="roles"><i class="fa-solid fa-user"></i>
          <p>Roles</p>
        </li>
      </ul>
    </nav>

    <form id="edit-form" data-user="<?= $user['id'] ?>" class="col" enctype="multipart/form-data">
      <div id="main-content" class="form-row">
        <div id="roles">
          <h1>Roles</h1>
          <button class="btn btn-primary" type="button" id="add-role">Add role</button>

          <div id="role-list" class="items-list multiple-row">
            <?php foreach ($user['roles'] as $item) : ?>
              <div class="item form-row" data-id="<?= $item['id'] ?>">
                <div class="form-group">
                  <label>Role</label>
                  <select data-role value="<?= $item['id'] ?>">
                    <?php foreach ($roles as $role) : ?>
                      <option value="<?= $role['id'] ?>" <?php if ($role['name'] == $item['name']) : ?> selected <?php endif; ?>><?= $role['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <button class="btn btn-danger" type="button">X</button>
              </div>
            <?php endforeach; ?>
          </div>

        </div>
      </div>
      <div class="form-row">
        <button type="submit" name="edit-user">SAVE</button>
      </div>
    </form>
  </div>
</div>

<?php echo "<script>const availableRoles = [";
foreach ($roles as $role) {
  echo "{id: {$role['id']}, name: '{$role['name']}'},";
}
echo "]</script>"; ?>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/editPage.js"></script>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/editUser.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>