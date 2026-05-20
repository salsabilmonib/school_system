<?php

namespace App\Controllers;

use Config\Session;
use Config\Cookie;
use App\Models\User;
use Config\Helpers;
use Config\FlashBag;


require_once __DIR__ . '/../../autoloader.php';

class AuthController
{


    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = $this->userModel->login($username, $password);

            if ($user) {


                Session::start();



                Session::set('user_id', $user['id']);
                Session::set('username', $user['username']);
                Session::set('role', $user['role']);


                echo Session::get('username');


                // 5. Handle "Remember Me"
                if (isset($_POST['remember'])) {
                    $lifetime = 120; // 20 minutes (Consider 2592000 for 30 days)
                    $expiryTime = time() + $lifetime;
                } else {
                    $expiryTime = 0; // Expires when browser closes
                }

                $params = session_get_cookie_params();
                var_dump(session_id());
                Cookie::set(
                    session_name(),
                    session_id(),
                    $expiryTime,
                    "/",
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );

                // 7. Render dashboard directly with active session open
                $this->showDashboard();
            } else {
                FlashBag::add('danger', 'Invalid username or passwordd');
                return "blabla";
            }
        }
    }

    public function logout()
    {

        Cookie::delete(session_name());
        Session::destroy();
        Helpers::redirect("login.php?success=Logged out successfully.");
        exit();
    }

    public function showDashboard()
    {



        $user_role = Session::get('role');



        switch ($user_role) {
            case 'admin':
                Helpers::redirect("adminDashboard.php");
                break;
            case 'teacher':
                Helpers::redirect("teacherDashboard.php");
                break;
            default:
                Helpers::redirect("login.php");
                break;
        }
    }
}
