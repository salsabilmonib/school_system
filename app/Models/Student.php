<?php

namespace App\Models;

require_once '../../autoloader.php';

use Config\Database;

class Student
{
    public function getAllStudents()
    {
        $sql = "SELECT * FROM students";
        return Database::fetchAll($sql);
    }

    public function getStudentById($id)
    {
        $sql = "SELECT * FROM students WHERE id = :id";
        return Database::fetchOne($sql, ['id' => $id]);
    }
    public function createStudent($firstName, $lastName, $doB, $nationalId, $photo, $gender, $created_by)
    {
        $sql = "INSERT INTO students (first_name, last_name, dob, national_id, photo, gender , created_at , created_by) VALUES (first_name, last_name, dob, national_id, photo, gender , created_at , created_by)";
        return Database::fetchOne($sql, [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'dob' => $doB,
            'nationalId' => $nationalId,
            'photo' => $photo,
            'gender' => $gender,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $created_by
        ]);
    }
    public function updateStudent($firstName, $lastName, $doB, $nationalId, $photo, $gender, $created_by)
    {
        $sql = "UPDATE students SET first_name = :firstName, last_name = :lastName , dob = :doB, national_id = :national_id, photo= :photo , gender = :gender , updated_at = :updated_at , updated_by = :updated_by ";
        return Database::fetchOne($sql, [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'dob' => $doB,
            'nationalId' => $nationalId,
            'photo' => $photo,
            'gender' => $gender,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $created_by
        ]);
    }
    public function deleteStudent($id)
    {
        $sql = "DELETE FROM students WHERE id = :id";
        return Database::fetchOne($sql, ['id' => $id]);
    }
}
