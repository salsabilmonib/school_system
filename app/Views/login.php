<?php
// require_once '../Controllers/AuthController.php';
require_once '../../autoloader.php';

use App\Controllers\AuthController;
use Config\FlashBag;

$authController = new AuthController();
$authController->login();

?>

<div class="container mt-5">
	<?php $messages = FlashBag::getAll(); ?>
	<?php foreach ($messages as $type => $msgs): ?>
		<div class="alert alert-<?= $type ?>">
			<?php foreach ($msgs as $msg): ?>
				<p class="mb-0"><?= htmlspecialchars($msg) ?></p>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>





	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">
		<title>Login</title>
	</head>

	<body class="bg-light">

		<hr>


		<div class="container">
			<div class="d-flex justify-content-center align-items-center vh-100">



				<div class="card shadow  px-5 ">

					<div class="card-body">

						<h5 class="card-title"> Login </h5>
						<form method="POST">

							<div data-mdb-input-init class="form-outline mb-4">
								<br />
								<input type="text" id="username" name="username" class="form-control" placeholder="Username" />

							</div>

							<div data-mdb-input-init class="form-outline mb-4">

								<input type="text" id="password" name="password" class="form-control" placeholder="Password" />
							</div>


							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="remember" id="remember" checked />
								<label class="form-check-label" for="remember"> Remember me </label>
							</div>

							<button type="submit" id="button" value="Login" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mt-3 mb-4">Log in</button>

						</form>




					</div>
				</div>

			</div>
		</div>
		<script src="../../public/assets/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>