<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminControl;
use Illuminate\Support\Facades\Route;
//ชื่อ guard admins
Route::prefix('admin')->middleware('guest:admins')->group(function () {
    Route::get('Formlogin', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

Route::prefix('admin')->middleware('auth:admins')->group(function () {

    //profile
    Route::get('profile', [AdminControl::class, 'profile'])->name('profile');
    //table admin
    Route::get('table_admin', [AdminControl::class, 'table_admin'])->name('table_admin');
    //create admin
    Route::post('store_admin', [AdminControl::class, 'store_admin'])->name('store_admin');
    //update admin
    Route::post('update_admin/{id}', [AdminControl::class, 'update_admin'])->name('update_admin');
    //delete admin
    Route::get('delete_admin/{id}', [AdminControl::class, 'destroy_admin'])->name('delete_admin');
    //show form change password
    Route::get('change_password', [AdminControl::class, 'change_password'])->name('change_password');
    //update password
    Route::post('update_password', [AdminControl::class, 'update_password'])->name('update_password');





    Route::get('logout_admin', [AdminAuthController::class, 'logout'])->name('logout_admin');
    //เเสดงหน้า dashboard
    Route::get('dashboard', [AdminControl::class, 'dashboard'])->name('dashboard');
    // เพิ่ม routes อื่นๆ ที่ต้องการ protect
    //update นักเรียน
    Route::post('update_student', [AdminControl::class, 'update_student'])->name('update_student');


    //ตารางจัดการข่าว
    Route::get("table_news", [AdminControl::class, "table_news"])->name('table_news');
    //update ข่าว
    Route::post('update_new', [AdminControl::class, 'update_new'])->name('update_new');
    //ฟอร์มเพิ่มข่าว
    Route::get('add-new', [AdminControl::class, 'form_news'])->name('add-new');
    //กดปุ่มเพิ่มข่าวเเล้วเรียกฟังก์ชัน insert ใน AdminControlใช้เพิ่มข่าว
    Route::post('insert', [AdminControl::class, 'insert'])->name('insert');
    //ลบข่าว
    Route::get('delete_new/{id}', [AdminControl::class, 'delete_new'])->name('delete_new');

    //ส่วนเพิ่มภาพสไลด์
    //form เพิ่มสไลด์
    Route::get('add-slide', [AdminControl::class, 'form_add_slide'])->name('add-slide');
    //เพิ่มภาพสไลด์
    Route::post('insert_slide', [AdminControl::class, 'insert_silde'])->name('insert_slide');
    //ตารางจัดการภาพสไลด์
    Route::get('table_slide', [AdminControl::class, 'table_slide_img'])->name('table_slide');
    //ลบภาพสไลด์
    Route::get('delete_slide/{id}', [AdminControl::class, 'delete_slide'])->name('delete_slide');



    //ส่วนบุคลากร
    //ฟอร์มเพิ่มบุคลากร
    Route::get('form-add-teacher', [AdminControl::class, 'form_add_teacher'])->name('add-teacher');
    //เพิ่มบุคลากร
    Route::post('insert_teacher', [AdminControl::class, 'insert_teacher'])->name('insert_teacher');
    //ตารางจัดการบุคลากร
    Route::get('table_teacher', [AdminControl::class, 'table_teacher'])->name('table_teacher');
    //เเก้ไขบุคลากร
    Route::post('update_teacher', [AdminControl::class, 'update_teacher'])->name('update_teacher');
    //ลบบุคลากร
    Route::get('delete_teacher/{id}', [AdminControl::class, 'delete_teacher'])->name('delete_teacher');


    //ส่วนผลงานนักเรียน
    //ตารางจัดการผลงาน
    Route::get('table_trophy', [AdminControl::class, 'table_trophy'])->name('table_trophy');
    //อัพเดทผลงาน
    Route::post('update_trophy', [AdminControl::class, 'update_trophy'])->name('update_trophy');
    //ฟอร์มเพิ่มผลงาน
    Route::get('form-add-trophy', [AdminControl::class, 'form_trophy'])->name('add-trophy');
    //เพิ่มผลงาน
    Route::post('insert_trophy', [AdminControl::class, 'insert_trophy'])->name('insert_trophy');
    //ลบผลงาน
    Route::get('delete_trophy/{id}', [AdminControl::class, 'delete_trophy'])->name('delete_trophy');


    //ส่วนเพิ่มเติมหน้าหลัก
    //ตารางจัดการส่วนเพิ่มเติม
    Route::get('table_addtional', [AdminControl::class, 'table_addtional'])->name('table_addtional');
    //ฟอร์มเพิ่มส่วนเพิ่มเติม
    Route::get('form-add-addtional', [AdminControl::class, 'form_addtional'])->name('add-addtional');
    //เพิ่มส่วนเพิ่มเติม
    Route::post('insert_addtional', [AdminControl::class, 'insert_addtional'])->name('insert_addtional');
    //update ส่วนเพิ่มเติม
    Route::post('update_addtional', [AdminControl::class, 'update_addtional'])->name('update-addtional');
    //ลบส่วนเพิ่มเติม
    Route::get('delete_addtional/{id}', [AdminControl::class, 'delete_addtional'])->name('delete-addtional');



    //ส่วนหลักสูตร
    //ตารางจัดการหลักสูตร
    Route::get('table_detailcourse', [AdminControl::class, 'table_detailcourse'])->name('table_detailcourse');
    //ฟอร์มเพิ่มวิชาหลักสูตร
    Route::get('form-add-detailcourse', [AdminControl::class, 'form_detailcourse'])->name('add-detailcourse');
    //เพิ่มวิชาหลักสูตร
    Route::post('insert_detailcourse', [AdminControl::class, 'insert_detailcourse'])->name('insert_detailcourse');
    //update วิชาหลักสูตร
    Route::post('update_detailcourse', [AdminControl::class, 'update_detailcourse'])->name('update_detailcourse');
    // สำหรับลบข้อมูลรายละเอียดวิชาหลักสูตร
    Route::get('delete_detailcourse/{id}', [AdminControl::class, 'delete_detailcourse'])->name('delete_detailcourse');


    //ตารางเเสดงเเผนการเรียน ปวช.
    Route::get('table_vocational', [AdminControl::class, 'table_vocational'])->name('table_vocational');
    //ตารางเเสดงเเผนการเรียน ปวส.
    Route::get('table_diploma', [AdminControl::class, 'table_diploma'])->name('table_diploma');
    //เพิ่มเเผนการเรียน
    Route::post('insert_studyplan', [AdminControl::class, 'insert_studyplan'])->name('insert_studyplan');
    //ลบเเผนการเรียน
    Route::delete('delete_studyplan/{id}', [AdminControl::class, 'delete_studyplan'])->name('delete_studyplan');
});
