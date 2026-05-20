<?php

namespace App\Controllers;

use App\Models\User;
use Config\FlashBag;
use Config\Helpers;
use Config\Pagination;

require_once __DIR__ . '/../../autoloader.php';

class UserController
{

    private User $userModel;
    private Pagination $pagination;

    public function __construct()
    {
        $this->userModel = new User();
        $cur_page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $cur_page = max(1, $cur_page);
        $per_page = 5;
        $total_records = $this->getTotalUserCount();
        $this->pagination = new Pagination($cur_page, $total_records, $per_page);
        $offset = $this->pagination->offSet();
    }
    public function create_user()
    {



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_user = trim($_POST['new_username'] ?? '');
            $new_pass = $_POST['new_password'] ?? '';
            $new_role = $_POST['new_role'] ?? 'user';
            $created_by = $_POST['current_logged_in_user'];


            if (!empty($new_user) && !empty($new_pass) && !empty($new_role)) {
                // Call model to insert data
                $this->userModel->createUser($new_user, $new_pass, $new_role, $created_by);
                FlashBag::add('success', 'User created successfully!');


                Helpers::redirect("adminDashboard.php");
            } else {
                FlashBag::add('warning', 'All fields are required!');
                Helpers::redirect("adminDashboard.php");
            }
        }
    }

    public function getAllUsers()
    {
        return $this->userModel->getAllUsers();
    }


    public function getPaginatedUsers($offset, $per_page)
    {
        return $this->userModel->getPaginatedUsers($offset, $per_page);
    }



    public function getTotalUserCount()
    {
        return $this->userModel->getTotalUserCount();
    }



    public function delete_user($user_id)
    {


        $this->userModel->deleteUser($user_id);

        FlashBag::add('danger', 'user deleted successfully!');
        Helpers::redirect("adminDashboard.php");
        exit();
    }

    public function update_user($user_id)
    {
        if (!empty($_POST['username']) || !empty($_POST['role']) || !empty($_POST['password'])) {
            $username = trim($_POST['username']);
            $role = $_POST['role'];
            $password = $_POST['password'] ?? '';
            $updated_at = date('Y-m-d H:i:s');
            $updated_by = $_POST['current_logged_in_user'] ?? '';

            $this->userModel->updateUser($user_id, $username, $password, $role, $updated_at, $updated_by);
            FlashBag::add('success', 'User updated successfully!');
            Helpers::redirect("adminDashboard.php");
        } else {
            FlashBag::add('warning', 'Field cannot be empty.');
            Helpers::redirect("adminDashboard.php");
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'create_user') {
    $userController = new UserController();
    $userController->create_user();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete_user') {
    $userController = new UserController();
    $userController->delete_user($_GET['id']);
}


if (isset($_GET['action']) && $_GET['action'] === 'update_user') {
    $userController = new UserController();
    $userController->update_user($_GET['id']);
}
