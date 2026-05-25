<?php

namespace App\Models;

require_once '../../autoloader.php';

use Config\Database;

class Teacher
{
    public function getAllTeachers()
    {
        $sql = "SELECT * FROM teachers";
        return Database::fetchAll($sql);
    }

    public function getTeacherById($id)
    {
        $sql = "SELECT * FROM teachers WHERE id = :id";
        return Database::fetchOne($sql, ['id' => $id]);
    }

    public function createTeacher($firstName, $lastName, $nationalId, $phoneNum, $email)
    {
        $sql = "INSERT INTO teachers (first_name, last_name, national_id, phone_num, email) VALUES (:firstName, :lastName, :nationalId, :phoneNum, :email)";
        return Database::fetchOne($sql, [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'nationalId' => $nationalId,
            'phoneNum' => $phoneNum,
            'email' => $email
        ]);
    }

    public function updateTeacher($id, $firstName, $lastName, $nationalId, $phoneNum, $email)
    {
        $sql = "UPDATE teachers SET first_name = :firstName, last_name = :lastName, national_id = :nationalId, phone_num = :phoneNum, email = :email WHERE id = :id";
        return Database::fetchOne($sql, [
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'nationalId' => $nationalId,
            'phoneNum' => $phoneNum,
            'email' => $email
        ]);
    }

    public function deleteTeacher($id)
    {
        $sql = "DELETE FROM teachers WHERE id = :id";
        return Database::fetchOne($sql, ['id' => $id]);
    }
}
