<?php
require_once __DIR__ . "/partials/nav.php";
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page");
  die(header("Location: login.php"));
}

$results = [];
if (isset($_SESSION['user']['username'])) {
  $username = $_SESSION['user']['username'];
}
if (!empty($username)) {
  $db = getDB();
  $stmt = $db->prepare(
    "SELECT account_number, account_type, balance FROM Accounts JOIN Users ON Accounts.user_id = Users.id WHERE Users.username = :q ORDER BY Accounts.id LIMIT 5"
  );
  $r = $stmt->execute([":q" => $username]);
  if ($r) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    flash("There was a problem fetching the results");
  }
}
?>
    <div class="mt-4">
    <?php if (count($results) > 0): ?>
      <?php foreach ($results as $r): ?>
      <div class="card mb-2">
        <div class="card-header">Account: <b><?php safer_echo($r["account_number"]); ?></b></div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Type: <?php safer_echo(ucfirst($r["account_type"])); ?></li>
          <li class="list-group-item">Balance: $<?php safer_echo($r["balance"]); ?></li>
        </ul>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>You don't have any accounts.</p>
    <?php endif; ?>
    </div>

<?php require __DIR__ . "/partials/flash.php"; ?>
