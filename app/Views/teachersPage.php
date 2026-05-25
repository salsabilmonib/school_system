<?php

use App\Controllers\AuthController;
use App\Controllers\TeacherController;
use Config\Session;
use Config\Helpers;



require_once __DIR__ . '/../../autoloader.php';

$authController = new AuthController();
$controller = new TeacherController();
$teachers = $controller->getAllTeachers();


if (!Session::has('user_id')) {
    Helpers::redirect('login.php?error=Access Denied. Please log in boo.');
    exit();
}


?>








<?php require_once '_header.php'; ?>



<div class="container py-5">

    <div class="shadow-sm" style="border: 1px solid #c3d7f1; border-radius: 16px; background-color: #ffffff; padding: 32px;">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4 mb-5">
            <div class="d-flex flex-wrap align-items-center gap-4 flex-grow-1 flex-sm-grow-0">
                <div>
                    <h2 class="fw-bold m-0" style="color: #0f172a; font-size: 1.75rem; tracking-content: -0.02em;">Teachers</h2>

                </div>


                <div class="d-flex align-items-center px-3 py-2 gap-2" style="border: 1px solid #cbd5e1; border-radius: 10px; max-width: 320px; width: 100%; background-color: #f8fafc; transition: border 0.2s ease;">
                    <i class="bi bi-search text-muted" style="font-size: 0.95rem;"></i>
                    <input type="text" id="teacherSearch" class="form-control p-0 shadow-none border-0 bg-transparent" placeholder="Search Teacher..." style="font-size: 0.95rem; color: #334155;">
                    <i class="bi bi-mic-fill text-muted cursor-pointer" style="font-size: 0.95rem;"></i>
                </div>
            </div>

            <button type="button" data-bs-toggle="modal" data-bs-target="#addTeacherModal" class="btn px-4 py-2   d-inline-flex align-items-center gap-2" style="background-color: #4f46e5; color: #ffffff; border: none; border-radius: 10px; font-weight: 500; font-size: 0.95rem; transition: background-color 0.2s ease;">
                Add Teacher
            </button>

        </div>

        <!-- CARDS GRID -->
        <div class="row g-4">
            <?php if (!empty($teachers) && is_array($teachers)): ?>
                <?php foreach ($teachers as $teacher): ?>
                    <div class="col-12 col-md-6 col-lg-4 teacher-card">

                        <div class="p-4 d-flex flex-column h-100 justify-content-between" style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #ffffff; min-height: 240px; transition: transform 0.2s ease, box-shadow 0.2s ease;">

                            <div>

                                <div class="d-flex align-items-start justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">

                                        <!--photo -->
                                        <div class="d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px; background-color: #e0e7ff; color: #4f46e5;">
                                            <i class="bi bi-person-fill fs-5"></i>
                                        </div>


                                        <div>
                                            <h5 id="teacherSearch" class="fw-semibold mb-1" style="color: #0f172a; font-size: 1.05rem;">
                                                <?php echo htmlspecialchars(($teacher['first_name'] ?? '') . ' ' . ($teacher['last_name'] ?? '')); ?>
                                            </h5>
                                            <div class="text-muted d-flex align-items-center gap-1 mb-0" style="font-size: 0.85rem;">
                                                <i class="bi bi-envelope text-muted" style="font-size: 0.75rem;"></i>
                                                <?php echo htmlspecialchars($teacher['email'] ?? ''); ?>
                                            </div>
                                            <div class="text-muted d-flex align-items-center gap-1" style="font-size: 0.85rem;">
                                                <i class="bi bi-telephone text-muted" style="font-size: 0.75rem;"></i>
                                                <?php echo htmlspecialchars($teacher['phone_num'] ?? ''); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editTeacherModal<?php echo $teacher['id']; ?>" class="btn p-1 border-0 shadow-none d-inline-flex" style="color: #94a3b8; border-radius: 6px;">edit</button>
                                        <form method="POST" action="../Controllers/TeacherController.php?action=delete_teacher&id=<?php echo $teacher['id']; ?>" onsubmit="return confirm('Are you sure you want to delete this teacher?');">

                                            <button type="submit" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg></button>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <div class="pt-3" style="border-top: 1px solid #f1f5f9;">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#viewScheduleModal<?php echo $teacher['id']; ?>" class="btn w-100 py-2 d-inline-flex align-items-center justify-content-center gap-2" style="font-weight: 500; font-size: 0.85rem; color: #eeecf0; background-color: #8473d1; transition: background-color 0.2s ease;">
                                    View Schedule
                                </button>
                            </div>

                            <!-- 
                            <div class="modal fade custom-modal" id="viewScheduleModal<?php echo $teacher['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> <?php echo htmlspecialchars(($teacher['first_name'] ?? '') . ' ' . ($teacher['last_name'] ?? '')) . ' Schedule'; ?>
                                            </h5>
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="img-wrapper">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/1.webp" alt="Schedule" class="img-fluid rounded shadow-sm" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> -->



                            <div class="modal fade" id="editTeacherModal<?php echo $teacher['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="../Controllers/TeacherController.php?action=update_teacher&id=<?php echo $teacher['id']; ?>">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="firstName" class="col-form-label">First Name:</label>
                                                    <input type="text" name="first_name" class="form-control" id="firstName" value="<?php echo htmlspecialchars($teacher['first_name'] ?? ''); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastName" class="col-form-label">Last Name:</label>
                                                    <input type="text" name="last_name" class="form-control" id="lastName" value="<?php echo htmlspecialchars($teacher['last_name'] ?? ''); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nationalId" class="col-form-label">National ID:</label>
                                                    <input type="text" name="national_id" class="form-control" id="nationalId" value="<?php echo htmlspecialchars($teacher['national_id'] ?? ''); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phoneNum" class="col-form-label">Phone Number:</label>
                                                    <input type="text" name="phone_num" class="form-control" id="phoneNum" value="<?php echo htmlspecialchars($teacher['phone_num'] ?? ''); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="col-form-label">Email:</label>
                                                    <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($teacher['email'] ?? ''); ?>">
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" value="Add" class="btn btn-primary">Update Teacher</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Added .modal-lg for extra horizontal space -->
                            <div class="modal fade custom-modal" id="viewScheduleModal<?php echo $teacher['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> <?php echo htmlspecialchars(($teacher['first_name'] ?? '') . ' ' . ($teacher['last_name'] ?? '') . '\'s Schedule'); ?> </h5>
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row g-4">

                                                <div class="col-md-8">
                                                    <div class="teacher-info mb-3">


                                                        <p class="text-muted small" id="selected-schedule-title-<?php echo $teacher['id']; ?>">Current Active Schedule</p>
                                                    </div>
                                                    <div class="img-wrapper bg-light rounded d-flex align-items-center justify-content-center" style="min-height: 300px;">
                                                        <!-- ID added to target this image via JS -->
                                                        <img id="mainScheduleImg<?php echo $teacher['id']; ?>"
                                                            src="https://b-cdn.net"
                                                            alt="Schedule View"
                                                            class="img-fluid rounded shadow-sm" />
                                                    </div>
                                                </div>

                                                <!-- RIGHT COLUMN: Archive Links -->
                                                <div class="col-md-4 border-start-md">
                                                    <h6 class="fw-bold mb-3 text-secondary">Previous Schedules</h6>
                                                    <div class="list-group list-group-flush schedule-history-list">
                                                        <!-- Link 1 (Active by default) -->
                                                        <button type="button"
                                                            class="list-group-item list-group-item-action active">
                                                            <i class="bi bi-calendar-check me-2"></i> 2025-2026 - Semester 2
                                                        </button>

                                                        <!-- Link 2 -->
                                                        <button type="button"
                                                            class="list-group-item list-group-item-action">
                                                            <i class="bi bi-clock-history me-2"></i> 2025-2026 - Semester 1
                                                        </button>

                                                        <!-- Link 3 -->
                                                        <button type="button"
                                                            class="list-group-item list-group-item-action">

                                                            <i class="bi bi-clock-history me-2"></i> 2024-2025 - Semester 2
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0 bg-light-subtle">
                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty-->
                <div class="col-12 text-center py-5">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background-color: #f1f5f9; color: #94a3b8; border-radius: 50%;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <h5 class="fw-semibold text-dark mb-1">No teachers registered</h5>
                </div>
            <?php endif; ?>
        </div>

    </div>


    <!-- ADD TEACHER MODAL -->
    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="current_logged_in_user" value="<?php echo $_SESSION['username']; ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="../Controllers/TeacherController.php?action=create_teacher">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="firstName" class="col-form-label">First Name:</label>
                            <input type="text" name="first_name" class="form-control" id="firstName">
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="col-form-label">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" id="lastName">
                        </div>
                        <div class="form-group">
                            <label for="nationalId" class="col-form-label">National ID:</label>
                            <input type="text" name="national_id" class="form-control" id="nationalId">
                        </div>
                        <div class="form-group">
                            <label for="phoneNum" class="col-form-label">Phone Number:</label>
                            <input type="text" name="phone_num" class="form-control" id="phoneNum">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username:</label>
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="Add" class="btn btn-primary">Add Teacher</button>
                    </div>
                </form>

            </div>
        </div>
    </div>










</div>


<script src="../../public/assets/js/bootstrap.bundle.min.js"> </script>
<script>
    document.getElementById('teacherSearch').addEventListener('keyup', function() {
        // Get the search input value and convert to lowercase
        const value = this.value.toLowerCase();

        // Select all the teacher column wrappers
        const cards = document.querySelectorAll('.teacher-card');

        cards.forEach(card => {
            // Get all text content inside this specific card (Names, Email, Phone)
            const cardText = card.textContent.toLowerCase();

            // If matched, show column; if not, hide completely using Bootstrap's d-none
            if (cardText.includes(value)) {
                card.classList.remove('d-none');
            } else {
                card.classList.add('d-none');
            }
        });
    });
</script>


<?php require_once '_header.php'; ?>