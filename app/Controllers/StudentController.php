<?php

namespace App\Controllers;

use App\Models\Student;
use Config\FlashBag;
use Config\Helpers;

require_once __DIR__ . '/../../autoloader.php';

class StudentController
{
    private Student $studentModel;
    public function __construct()
    {
        $this->studentModel = new Student();
    }

    public function getAllStudents()
    {
        return $this->studentModel->getAllStudents();
    }

    public function create_student()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $doB = trim($_POST['dob'] ?? '');
            $nationalId = trim($_POST['national_id'] ?? '');
            $photo = trim($_POST['photo'] ?? '');
            $gender = trim($_POST['gender'] ?? '');

            $created_by = trim($_POST['current_logged_in_user'] ?? '');

            if (!empty($firstName) && !empty($lastName)  && !empty($doB) &&  !empty($nationalId) && !empty($gender)) {
                // Call model to insert data
                $this->studentModel->createStudent($firstName, $lastName, $doB,  $nationalId, $photo,  $gender, $created_by);

                FlashBag::add('success', 'Student created successfully ooo!');
                Helpers::redirect("studentsPage.php");
            } else {
                FlashBag::add('warning', 'All fields are required!');
                Helpers::redirect("studentsPage.php");
            }
        }
    }

    
    public function update_student()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $doB = trim($_POST['dob'] ?? '');
            $nationalId = trim($_POST['national_id'] ?? '');
            $photo = trim($_POST['photo'] ?? '');
            $gender = trim($_POST['gender'] ?? '');

             $updated_at = date('Y-m-d H:i:s');
            $updated_by = $_POST['current_logged_in_user'] ?? '';

            if (!empty($firstName) && !empty($lastName)  && !empty($doB) &&  !empty($nationalId) && !empty($gender)) {
                // Call model to insert data
                $this->studentModel->updateStudent($firstName, $lastName, $doB,  $nationalId, $photo,  $gender, $updated_at , $updated_by);

                FlashBag::add('success', 'Student updated successfully oo!');
                Helpers::redirect("studentsPage.php");
            } else {
                FlashBag::add('warning', 'All fields are required!');
                Helpers::redirect("studentsPage.php");
            }
        }
    }


    public function delete_student($id)
    {
        $this->studentModel->deleteStudent($id);
    }

    public function getStudentById($id) {
        return $this-> studentModel->getStudentById($id) ;
    }

}

if (isset($_GET['action']) && $_GET['action'] === 'create_student') {
    $studentController = new StudentController();

    $studentController->create_student();
}

if (isset($_GET['action']) && $_GET['action'] === 'update_student' && isset($_GET['id'])) {
    $studentController = new StudentController();
    $studentController->update_student($_GET['id']);
}

if (isset($_GET['action']) && $_GET['action'] === 'delete_student' && isset($_GET['id'])) {
    $studentController = new StudentController();
    $studentController->delete_student($_GET['id']);
}

