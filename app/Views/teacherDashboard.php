<?php

use App\Controllers\AuthController;
use Config\Helpers;
use Config\Session;
// require_once 'header.php';
// require_once '../Controllers/AuthController.php';
require_once '../../autoloader.php';

$authController = new AuthController();



if (!Session::has('user_id')) {
    Helpers::redirect('login.php?error=Access Denied. Please log in boo.');
    exit();
}
$user_role = Session::get('role');

?>

<?php require_once '_header.php'; ?>

<div class="card shadow border-0">
    <div class="card-body p-5">
        <h2 class="text-primary fw-bold mb-3">Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <span class="badge 'bg-secondary'; ?> p-2 fs-6">
            Role: <?php echo ucfirst(htmlspecialchars($user_role)); ?>
        </span>


        <hr>
    </div>
</div>


</div>

</div>
<script src="../../public/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>