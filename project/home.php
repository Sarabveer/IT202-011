<?php
require_once __DIR__ . "/partials/nav.php";
if (!is_logged_in()) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page");
  die(header("Location: login.php"));
}
?>
    <div class="jumbotron mt-4 text-center">
      <h1 class="display-4">Welcome, <?php safer_echo(get_name()); ?>!</h1>
      <hr class="my-4">
      <p class="lead">What would you like to do today?</p>
      <p>
        <a class="btn btn-primary" href="transaction.php?type=deposit" role="button"><i class="fas fa-hand-holding-usd fa-fw"></i> Deposit</a>
        <a class="btn btn-primary" href="transaction.php?type=withdraw" role="button"><i class="fas fa-money-bill-wave fa-fw"></i> Withdraw</a>
        <a class="btn btn-primary" href="accounts.php" role="button"><i class="fas fa-wallet fa-fw"></i> View Accounts</a>
        <a class="btn btn-primary" href="create_account.php" role="button"><i class="fas fa-file-invoice-dollar fa-fw"></i> Open Account</a>
      </p>
    </div>
<?php require __DIR__ . "/partials/flash.php"; ?>
