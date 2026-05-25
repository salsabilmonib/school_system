<?php

namespace App\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Config\FlashBag;
use Config\Helpers;

require_once __DIR__ . '/../../autoloader.php';

class TeacherController
{
    private Teacher $teacherModel;
    private User $userModel;

    public function __construct()
    {
        $this->teacherModel = new Teacher();
        $this->userModel = new User();
    }

    public function getAllTeachers()
    {
        return $this->teacherModel->getAllTeachers();
    }

    public function create_teacher()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $nationalId = trim($_POST['national_id'] ?? '');
            $phoneNum = trim($_POST['phone_num'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $created_by = trim($_POST['current_logged_in_user'] ?? '');

            if (!empty($firstName) && !empty($lastName) && !empty($nationalId) && !empty($phoneNum) && !empty($email) && !empty($username) && !empty($password)) {
                // Call model to insert data
                $this->teacherModel->createTeacher($firstName, $lastName, $nationalId, $phoneNum, $email);
                $this->userModel->createUser($username, $password, 'teacher', $created_by);
                FlashBag::add('success', 'Teacher created successfully ooo!');
                Helpers::redirect("teachersPage.php");
            } else {
                FlashBag::add('warning', 'All fields are required!');
                Helpers::redirect("teachersPage.php");
            }
        }
    }

    public function update_teacher($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $nationalId = trim($_POST['national_id'] ?? '');
            $phoneNum = trim($_POST['phone_num'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if (!empty($firstName) && !empty($lastName) && !empty($nationalId) && !empty($phoneNum) && !empty($email)) {
                // Call model to update data
                $this->teacherModel->updateTeacher($id, $firstName, $lastName, $nationalId, $phoneNum, $email);
                FlashBag::add('success', 'Teacher updated successfully!');
                Helpers::redirect("teachersPage.php");
            } else {
                FlashBag::add('warning', 'All fields are required!');
                Helpers::redirect("teachersPage.php");
            }
        }
    }

    public function getTeacherById($id)
    {
        return $this->teacherModel->getTeacherById($id);
    }

    public function delete_teacher($id)
    {

        $this->teacherModel->deleteTeacher($id);

        FlashBag::add('danger', 'teacher deleted successfully!');
        Helpers::redirect("teachersPage.php");
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'create_teacher') {
    $teacherController = new TeacherController();

    $teacherController->create_teacher();
}

if (isset($_GET['action']) && $_GET['action'] === 'update_teacher' && isset($_GET['id'])) {
    $teacherController = new TeacherController();
    $teacherController->update_teacher($_GET['id']);
}

if (isset($_GET['action']) && $_GET['action'] === 'delete_teacher' && isset($_GET['id'])) {
    $teacherController = new TeacherController();
    $teacherController->delete_teacher($_GET['id']);
}
