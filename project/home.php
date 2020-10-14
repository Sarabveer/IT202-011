<?php
require_once __DIR__ . "/partials/nav.php";

$email = "";
if (isset($_SESSION["user"]) && isset($_SESSION["user"]["email"])) {
  $email = $_SESSION["user"]["email"];
}
?>
<p>Welcome, <?php echo $email; ?></p>
