<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControl; //ต้องเรียก controller ที่จะใช้งานมาเสมอ
use App\Http\Controllers\UserControl;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

//fix storage
Route::get('/fix-storage', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});


//User Zone
//หน้าหลัก
Route::get("/", [UserControl::class, "index"])->name("home");
//เเสดงรายละเอียดข่าว
Route::get("admin/new_detail/{id}", [UserControl::class,"show_detail_news"])->name("new_detail");


//เกี่ยวกับเเเผนก
Route::get("/about", [UserControl::class, "about"])->name("about");
//บุคลากร
Route::get("/about/teacher", [UserControl::class, "about_teacher"])->name("about_teacher");


//ผลงานนักเรียน
//เเสดงผลงานนักเรียนทั้งหมด
Route::get("/student_trophy", [UserControl::class,"student_trophy"])->name("student_trophy");
//เเสดงรายละเอียดผลงานนักเรียน
Route::get("/student_trophy/detail/{id}", [UserControl::class,"student_trophy_detail"])->name("student_trophy_detail");

//ส่วนเพิ่มเติม


//ส่วนหลักสูตร
Route::get("/course",[Usercontrol::class,"course"])->name('course');
//เเสดงรายละเอียดเเผนการเรียนปวช.
Route::get("/course/vocational",[Usercontrol::class,"vocational"])->name('vocational');
//เเสดงรายละเอียดเเผนการเรียนปวส
Route::get("/course/diploma",[Usercontrol::class,"diploma"])->name('diploma');

//ส่วนนักเรียนนักศึกษา
Route::get("/student",[Usercontrol::class,"student"])->name('student');



require __DIR__ . '/admin-auth.php';




