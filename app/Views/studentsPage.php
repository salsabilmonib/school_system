<?php

use App\Controllers\AuthController;
use App\Controllers\TeacherController;
use Config\Session;
use Config\Helpers;



require_once __DIR__ . '/../../autoloader.php';

$authController = new AuthController();
$controller = new TeacherController();
$teachers = $controller->getAllTeachers();


require_once '_header.php'; ?>

<div class="container py-5">

    <div class="shadow-sm" style="border: 1px solid #c3d7f1; border-radius: 16px; background-color: #ffffff; padding: 32px;">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4 mb-5">
            <div class="d-flex flex-wrap align-items-center gap-4 flex-grow-1 flex-sm-grow-0">
                <div>
                    <h2 class="fw-bold m-0" style="color: #0f172a; font-size: 1.75rem; tracking-content: -0.02em;">Students</h2>

                </div>


                <div class="d-flex align-items-center px-3 py-2 gap-2" style="border: 1px solid #cbd5e1; border-radius: 10px; max-width: 320px; width: 100%; background-color: #f8fafc; transition: border 0.2s ease;">
                    <i class="bi bi-search text-muted" style="font-size: 0.95rem;"></i>
                    <input type="text" id="teacherSearch" class="form-control p-0 shadow-none border-0 bg-transparent" placeholder="Search Teacher..." style="font-size: 0.95rem; color: #334155;">
                    <i class="bi bi-mic-fill text-muted cursor-pointer" style="font-size: 0.95rem;"></i>
                </div>



            </div>
        </div>
    </div>
</div>