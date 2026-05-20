<?php

namespace App\Models;

require_once '../../autoloader.php';

use Config\Database;

class User
{

    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $user = Database::fetchOne($sql, ['username' => $username]);

        if ($user && $password === $user['password']) {
            return $user;
        } else {
            return false;
        }
    }

    public function getTotalUserCount()
    {
        $sql = "SELECT COUNT(*) FROM users";
        return Database::fetchOne($sql);
    }

    public function getPaginatedUsers($offset, $per_page)
    {
        $sql = "SELECT * FROM users ORDER BY id ASC LIMIT :offset, :limit";
        return Database::fetchAll($sql, [
            'offset' => (int)$offset,
            'limit' => (int)$per_page
        ]);
    }




    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        return Database::fetchAll($sql);
    }

    public function createUser($username, $password, $role, $created_by)
    {
        $sql = "INSERT INTO users (username, password, role, created_at, created_by) VALUES (:username, :password, :role, :created_at, :created_by)";
        return Database::fetchOne($sql, [
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $created_by
        ]);
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        return Database::fetchOne($sql, ['id' => $user_id]);
    }

    public function updateUser($user_id, $username, $password, $role, $updated_at, $updated_by)
    {
        $sql = "UPDATE users SET username = :username, password = :password, role = :role, updated_at = :updated_at, updated_by = :updated_by WHERE id = :id";
        return Database::fetchOne($sql, [
            'id' => $user_id,
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $updated_by
        ]);
    }
}
