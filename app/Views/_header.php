<?php

use App\Controllers\AuthController;

require_once '../../autoloader.php';

use Config\FlashBag;




$authController = new AuthController();
if (isset($_POST['logout'])) {
    $authController->logout();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">
    <title>Dashboard</title>


</head>

<body class="bg-light">

    <header class="navbar navbar-dark bg-secondary shadow-sm p-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <a class="navbar-brand mb-0 h1" href="#">Dashboard</a>

            <form method="POST" class="m-0">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>

        </div>
    </header>
    <div class="container mt-5">

        <?php $messages = FlashBag::getAll(); ?>
        <?php foreach ($messages as $type => $msgs): ?>
            <div class="alert alert-<?= $type ?>">
                <?php foreach ($msgs as $msg): ?>
                    <p class="mb-0"><?= htmlspecialchars($msg) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>