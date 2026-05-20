<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;
use Config\Session;
use Config\Helpers;
use Config\FlashBag;

require_once '../../autoloader.php';

$authController = new AuthController();
$userController = new UserController();

if (!Session::has('user_id')) {
    Helpers::redirect('login.php?error=Access Denied. Please log in haha.');
    exit();
}

$user_role = Session::get('role');



$all_users = $userController->getAllUsers();

if ($user_role != 'admin') {
    Helpers::redirect('login.php?error=Access Denied. Admins only.');
    exit();
}

?>

<?php require_once '_header.php'; ?>



<div class="card shadow border-0 p-4 mb-4 bg-dark text-white">
    <div class="card-body">
        <h2 class="fw-bold">Admin System</h2>
        <p class="mb-0">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?> </strong> !</p>
    </div>
</div>

<div class="card shadow border-0 p-4">
    <div class="card-body">
        <h5 class="text-dark fw-bold mb-3">Users</h5>


        <div class="input-group input-group-sm mb-4" style="max-width: 250px;">
            <input class="form-control  ps-2" id="tableSearch" type="text" placeholder="Search...">
        </div>


        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle mt-2">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Access Role</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Last Updated At</th>
                        <th>Last Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($all_users as $row): ?>
                        <tr>
                            <form method="POST" action="../Controllers/UserController.php?action=update_user&id=<?php echo $row['id']; ?>">
                                <td><strong><?php echo htmlspecialchars($row['id']); ?></strong></td>
                                <td>
                                    <input type="text" name="username" class="form-control-plaintext px-2" value="<?php echo htmlspecialchars($row['username']); ?>">
                                    <p hidden> <?php echo htmlspecialchars($row['username']); ?> </p>
                                </td>
                                <td>
                                    <input type="hidden" name="current_logged_in_user" value="<?php echo $_SESSION['username']; ?>">
                                    <input type="hidden" name="role" class="form-control-plaintext px-2" value="<?php echo htmlspecialchars($row['role']); ?>">
                                    <span class="badge <?php echo ($row['role'] === 'admin') ? 'bg-danger' : (($row['role'] === 'teacher') ? 'bg-warning text-dark' : 'bg-primary'); ?> p-2 fs-6">
                                        <?php echo ucfirst(htmlspecialchars($row['role'])); ?>
                                    </span>
                                </td>
                            </form>

                            <td class="text-muted text-center"><?php echo htmlspecialchars($row['created_at'] ?: ""); ?></td>
                            <td class="text-muted text-center"><?php echo htmlspecialchars($row['created_by'] ?: ""); ?></td>
                            <td class="text-muted text-center"><?php echo htmlspecialchars($row['updated_at'] ?: ""); ?></td>
                            <td class="text-muted text-center"><?php echo htmlspecialchars($row['updated_by'] ?: ""); ?></td>
                            <td class="d-flex gap-1">
                                <form method="POST" action="../Controllers/UserController.php?action=delete_user&id=<?php echo $row['id']; ?>" onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    <button type="submit" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg></button>
                                </form>

                                <button type="submit" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg></button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <form method="POST" action="../Controllers/UserController.php?action=create_user">
                    <!--inline data entry row -->
                    <tfoot class="table-light border-top border-dark border-2">
                        <tr>
                            <td class="text-muted text-center fw-bold bg-white">New</td>
                            <td class="bg-white">
                                <input type="text" name="new_username" class="form-control form-control-sm" placeholder="Type username..." required />
                            </td>
                            <td class="bg-white">
                                <div class="input-group input-group-sm">
                                    <select name="new_role" class="form-select form-select-sm">
                                        <option value="user">User</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <input type="hidden" name="current_logged_in_user" value="<?php echo $_SESSION['username']; ?>">


                                </div>
                            </td>
                            <td class="bg-white">
                                <input type="password" name="new_password" class="form-control form-control-sm" placeholder="Typepassword..." required />
                            </td>
                            <td> <button type="submit" value="Add" class="btn btn-success btn-sm fw-bold px-3">Add</button></td>

                        </tr>
                    </tfoot>
                </form>

            </table>
            <!-- 
            <nav aria-label="Page navigation example">
                <ul class="pagination">


                    <?php if ($pagination->hasPrevPage()): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $pagination->cur_page - 1; ?>">Previous</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    <?php endif; ?>
                    </li>


                    <?php for ($i = 1; $i <= $pagination->getTotalPages(); $i++): ?>
                        <?php if ($i == $pagination->cur_page): ?>
                            <li class="page-item active"><span class="page-link"><?php echo $i; ?></span></li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>



                    <?php if ($pagination->hasNextPage()): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $pagination->cur_page + 1; ?>">Next</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    <?php endif; ?>

                </ul>
            </nav> -->
        </div>

    </div>
</div>
</div>

<script src="../../public/assets/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('tableSearch').addEventListener('keyup', function() {
        // Get the search input value and convert to lowercase
        const value = this.value.toLowerCase();
        // Get all rows in the table body
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            // Get all text content inside the row, lowercase it
            const rowText = row.textContent.toLowerCase();

            row.style.display = rowText.includes(value) ? '' : 'none';
        });
    });
</script>

<?= require_once '_footer.php'; ?>