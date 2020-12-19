<?php
ob_start();
require_once __DIR__ . "/partials/nav.php";
if (is_logged_in()) {
  die(header("Location: home.php"));
}
ob_end_flush();
?>
    <div class="jumbotron mt-4 text-center">
      <h1 class="display-4">Sarabveer's Bank</h1>
      <hr class="my-4">
      <p>
        <a class="btn btn-primary" href="login.php" role="button">Login</a>
        <a class="btn btn-primary" href="register.php" role="button">Register</a>
      </p>
    </div>
<?php require __DIR__ . "/partials/flash.php"; ?>