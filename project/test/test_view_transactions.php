<?php require_once __DIR__ . "/../partials/nav.php";
if (!has_role("Admin")) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page");
  die(header("Location: ../login.php"));
}
//we'll put this at the top so both php block have access to it
if (isset($_GET["id"])) {
  $id = $_GET["id"];
}
//fetching
$result = [];
if (isset($id)) {
  $db = getDB();
  $stmt = $db->prepare(
    "SELECT * FROM Transactions WHERE id = :id"
  );
  $r = $stmt->execute([":id" => $id]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$result) {
    $e = $stmt->errorInfo();
    flash($e[2]);
  }
}
?>
<?php if (isset($result) && !empty($result)): ?>
    <div class="card">
        <div class="card-title">
            <?php safer_echo($result["id"]); ?>
        </div>
        <div class="card-body">
            <div>
                <p>Information</p>
                <div>Account Src: <?php safer_echo($result["act_src_id"]); ?></div>
                <div>Account Dest: <?php safer_echo($result["act_dest_id"]); ?></div>
                <div>Amount: $<?php safer_echo($result["amount"]); ?></div>
                <div>Type: <?php safer_echo($result["action_type"]); ?></div>
                <div>Memo: <?php safer_echo($result["memo"]); ?></div>
                <div>Expected Total: $<?php safer_echo($result["expected_total"]); ?></div>
                <div>Created: <?php safer_echo($result["created"]); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>Error looking up id...</p>
<?php
endif;
require __DIR__ . "/../partials/flash.php";
?>
