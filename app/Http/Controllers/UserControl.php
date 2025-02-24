<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Slide_img;
use App\Models\Teacher;
use App\Models\Trophy;
use App\Models\addtional;
use App\Models\DetailCourse;
use App\Models\Studyplan;
use App\Models\Student;

class UserControl extends Controller
{
    //เเสดงหน้าหลัก
    public function index(){ //เเสดง home
        $news = News::all()->where("category",'news');
        $breaking_news = News::all()->where("category",'breaking_news');
        $slide = Slide_img::all();
        $trophy = Trophy::orderBy('created_at', 'desc')->take(3)->get();
        $addtional = addtional::all()->where('show','1');
        return view('user.home', compact('news','breaking_news','slide','trophy','addtional'));
    }

    public function show_detail_news($id){
        $news = News::find($id);
        return view('user.new_detail', compact('news'));
    }
    public function about(){ //เเสดง about
        return view('user.about');
    }

    public function about_teacher(){ //เเสดง about_teacher
        $teacher = Teacher::all();
        return view('user.teacher',compact('teacher'));
    }
    
    public function student_trophy(){ //เเสดง student_trophy ทั้งหมด
        $trophy = Trophy::all();
        return view('user.student_trophy_all',compact('trophy'));
    }

    public function student_trophy_detail($id){ //รายละเอียดผลงาน
        $trophy = Trophy::find($id);
        return view('user.student_trophy_detail',compact('trophy'));
    }

    public  function course(){ //ส่วนเเผนการเรียน
        $subject = DetailCourse::all();
        return view('user.course',compact('subject'));
    }
    public  function vocational(){ //เเผนการเรียน ปวช
        $studyplan = Studyplan::where('name', 'ปวช.')->orderBy('year', 'desc')->get();
        return view('user.vocational', compact('studyplan'));
    }
    public  function diploma(){ //เเผนการเรียน ปวส
        $studyplan = Studyplan::where('name', 'ปวส.')->orderBy('year', 'desc')->get();
        return view('user.diploma', compact('studyplan'));
    }


    //เเสดงนักเรียนนักศึกษา
    public function student(){
        $students = Student::all();
        return view('user.student', compact('students'));
    }

}
