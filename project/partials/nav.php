<?php
//we'll be including this on most/all pages so it's a good place to include anything else we want on those pages
require_once __DIR__ . "/../lib/helpers.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="//cdn.jsdelivr.net" rel="preconnect">
    <title>Sarabveer's Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<!-- Libraries -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome@5/web-fonts-with-css/css/fontawesome-all.min.css">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap.native@3/dist/bootstrap-native.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo getURL('.'); ?>">Sarabveer's Bank</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if (!is_logged_in()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo getURL('login.php'); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo getURL('register.php'); ?>">Register</a></li>
                <?php endif; ?>
                <?php if (is_logged_in()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo getURL('home.php'); ?>">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="accountsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Accounts
                        </a>
                        <div class="dropdown-menu" aria-labelledby="accountsDropdown">
                        <a class="dropdown-item" href="<?php echo getURL('accounts.php'); ?>">View Accounts</a>
                            <a class="dropdown-item" href="<?php echo getURL('create_account.php'); ?>">Create Account</a>
                            <a class="dropdown-item" href="<?php echo getURL('create_loan.php'); ?>">Take out Loan</a>
                            <a class="dropdown-item" href="<?php echo getURL('close_account.php'); ?>">Close Account</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Transaction
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo getURL('transaction.php?type=deposit'); ?>">Deposit</a>
                            <a class="dropdown-item" href="<?php echo getURL('transaction.php?type=withdraw'); ?>">Withdraw</a>
                            <a class="dropdown-item" href="<?php echo getURL('transaction.php?type=transfer'); ?>">Transfer</a>
                            <a class="dropdown-item" href="<?php echo getURL('transaction_out.php'); ?>">Transfer Out</a>
                        </div>
                    </li>
                </ul>
                <?php endif; ?>
                <?php if (is_logged_in()): ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo getURL('profile.php'); ?>">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo getURL('logout.php'); ?>">Logout</a></li>
                <?php if (has_role("Admin")): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo getURL('test/test_create_accounts.php'); ?>">Create Account</a>
                            <a class="dropdown-item" href="<?php echo getURL('test/test_list_accounts.php'); ?>">View Account</a>
                            <a class="dropdown-item" href="<?php echo getURL('test/test_create_transactions.php'); ?>">Create Transaction</a>
                            <a class="dropdown-item" href="<?php echo getURL('test/test_list_transactions.php'); ?>">View Transactions</a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
