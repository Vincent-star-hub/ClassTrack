<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherStudentDashboardController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionTermController;
use App\Http\Controllers\AttendanceController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsTeacher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes that require authentication
Route::middleware('auth')->group(function () {

    // Admin Routes
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('/adminprofile', [AdminProfileController::class, 'show'])->name('admin.profile');

        // Admin Dashboard Route
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Students Routes
        Route::resource('students', StudentController::class);

        // Classes Routes
        Route::resource('classes', ClassesController::class);

        // Routes for managing sections
        Route::resource('sections', SectionController::class);

        // Teachers Routes
        Route::prefix('teachers')->name('admin.teachers.')->group(function () {
            Route::get('/', [UserController::class, 'manageTeachers'])->name('index');
            Route::get('/create', [UserController::class, 'createTeacher'])->name('create');
            Route::post('/', [UserController::class, 'storeTeacher'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'editTeacher'])->name('edit');
            Route::put('/{user}', [UserController::class, 'updateTeacher'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Admins Routes
        Route::prefix('admins')->name('admin.admins.')->group(function () {
            Route::get('/', [UserController::class, 'manageAdmins'])->name('index');
            Route::get('/create', [UserController::class, 'createAdmin'])->name('create');
            Route::post('/', [UserController::class, 'storeAdmin'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'editAdmin'])->name('edit');
            Route::put('/{user}', [UserController::class, 'updateAdmin'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Session and Terms Routes
        Route::resource('sessionterm', SessionTermController::class);
    });

    // Teacher Routes
    Route::middleware(EnsureUserIsTeacher::class)->group(function () {
        Route::get('/teacherprofile', [TeacherProfileController::class, 'show'])->name('teacher.profile');
        Route::get('teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
        Route::get('teacher/students', [TeacherStudentDashboardController::class, 'showStudents'])->name('teacher.student');
        // Attendance Routes
        Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
        route::get('/attendance/view', [AttendanceController::class, 'viewStudentAttendance'])->name('attendance.view');
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');

        Route::get('/attendance/today-report', [AttendanceController::class, 'todayReport'])->name('attendance.todayReport');
    });
});
