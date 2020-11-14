<?php
require_once __DIR__ . "/../partials/nav.php";
if (!has_role("Admin")) {
  //this will redirect to login and kill the rest of this script (prevent it from executing)
  flash("You don't have permission to access this page");
  die(header("Location: ../login.php"));
}

//we'll put this at the top so both php block have access to it
if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

//saving
if (isset($_POST["save"])) {
  if (isset($id)) {
    // First transaction is always odd
    if($id % 2 == 0){
      $id -= 1;
    }
    // ID of second transaction
    $id2 = $id + 1;

    $user = get_user_id();
    $db = getDB();

    // First Transaction
    $stmt = $db->prepare("SELECT * FROM Transactions where id = :id");
    $stmt->execute([":id" => $id]);
    $t1 = $stmt->fetch(PDO::FETCH_ASSOC);

    // Second Transaction
    $stmt->execute([":id" => $id2]);
    $t2 = $stmt->fetch(PDO::FETCH_ASSOC);

    //TODO add proper validation/checks
    $amount = $_POST["amount"];
    $memo = $_POST["memo"];

    // calculate new totals
    $newTotal1 = $t1["expected_total"] - $t1["amount"] - $amount;
    $newTotal2 = $t2["expected_total"] - $t2["amount"] + $amount;

		$stmt = $db->prepare(
			"UPDATE Transactions set amount = :amount, expected_total = :total, memo = :memo where id = :id"
    );
    
    // Update First Transaction
		$r = $stmt->execute([
			":amount" => -$amount, //Set neg
			":total" => $newTotal1,
			":memo" => $memo,
			":id" => $id,
    ]);
    
    // Update Second Transaction
		$r = $stmt->execute([
			":amount" => $amount,
			":total" => $newTotal2,
			":memo" => $memo,
			":id" => $id2,
		]);

    if ($r) {
      flash("Updated successfully with id: " . $id);
    } else {
      $e = $stmt->errorInfo();
      flash("Error updating: " . var_export($e, true));
    }
  } else {
    flash("ID isn't set, we need an ID in order to update");
  }
}

//fetching
$result = [];
if (isset($id)) {
  $id = $_GET["id"];
  $db = getDB();
  $stmt = $db->prepare("SELECT * FROM Transactions where id = :id");
  $r = $stmt->execute([":id" => $id]);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form method="POST">
	<label>Amount</label>
	<input type="number" min="0.00" name="amount" step="0.01" value="<?php safer_echo(abs($result["amount"])); ?>"/>
	<label>Memo</label>
	<input name="memo" type="text" value="<?php safer_echo($result["memo"]); ?>"/> 
	<input type="submit" name="save" value="Create"/>
</form>

<?php require __DIR__ . "/../partials/flash.php"; ?>
