<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News; //เรียกใช้ model News
use App\Models\Slide_img; //เรียกใช้ model Slide_img
use App\Models\Teacher; //เรียกใช้ model Teacher
use App\Models\Trophy; // เรียกใช้ model Trophy
use App\Models\addtional; 
use App\Models\DetailCourse;
use App\Models\Studyplan;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

// use App\Models\Admin; // This line is unnecessary and can be removed
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminControl extends Controller
{
    // สร้าง constructor สำหรับกำหนด middleware ให้กับ controller นี้ Auth คือต้องเข้าสู่ระบบก่อนถึงจะเข้าถึงหน้านี้ได้
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    //หน้าเเสดง dashboard เเก้ส่วนตรง route
    public function dashboard()
    {
        $students = Student::all();
        return view('admin.dashboard', compact('students'));
    }
    //เเก้ไขจำนวนนักเรียน
    public function update_student(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'education_level' => 'required|string',
            'male_count' => 'required|integer|min:0',
            'female_count' => 'required|integer|min:0'
        ]);

        $student = Student::findOrFail($request->student_id);

        $student->update([
            'education_level' => $request->education_level,
            'male_count' => $request->male_count,
            'female_count' => $request->female_count
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'อัพเดตข้อมูลนักเรียนสำเร็จ'
            ]);
        }

        return redirect()->route('dashboard')->with('status', [
            'type' => 'success',
            'message' => 'อัพเดตข้อมูลนักเรียนสำเร็จ'
        ]);
    }


    //เเสดงหน้า profile
    public function profile()
    {
        return view('admin.profile');
    }

    //สร้าง Admins

    //end สร้าง Admins

    //start ส่วนข่าว
    public function table_news() //เเสดงตาราง news พร้อมส่งค่าไป loop
    {
        $table_news = News::all();
        return view('admin.table_news', compact('table_news'));
    }

    public function form_news()
    {
        return view('admin.form-add-new');
    }

    public function insert(Request $request) //insert ข่าว
    {
        date_default_timezone_set('Asia/Bangkok');
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'content' => 'required|string|max:500',
                'news_type' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'title.required' => 'กรุณากรอกชื่อข่าว',
                'title.max' => 'ห้ามกรอกเกิน 100 ตัวอักษร',
                'content.required' => 'กรุณากรอกรายละเอียดข่าว',
                'content.max' => 'ห้ามกรอกเกิน 500 ตัวอักษร',
                'image.required' => 'กรุณาเลือกรูปภาพ',
                'image.max' => 'ห้ามอัปโหลดไฟล์เกิน 2 MB',
            ]
        );

        $imagePath = $request->file('image')->store('uploads/images/news', 'public');

        // Insert data into the database
        $data = [
            'title' => $request->title,
            'describe' => $request->content,
            'category' => $request->news_type,
            'image_path' => $imagePath,
            'created_by' => 'Admin', // rand name
            'created_time' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Save to database (assume your model is News)
        \App\Models\News::create($data);

        // Redirect or return a response
        return redirect()->route('add-new')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มข่าวสำเร็จ',
        ]);
    }
    //ฟังก์ชันเเก้ข่าว
    public function update_new(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'news_title' => 'required|string|max:100',
            'news_description' => 'required|string|max:500',
            'news_type' => 'required|string',
            'news_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $news = News::findOrFail($request->news_id);

        $updateData = [
            'title' => $request->news_title,
            'describe' => $request->news_description,
            'category' => $request->news_type,
            'updated_at' => now()
        ];

        if ($request->hasFile('news_image')) {
            // Delete old image
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }

            // Store new image
            $imagePath = $request->file('news_image')->store('uploads/images/news', 'public');
            $updateData['image_path'] = $imagePath;
        }

        $news->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'อัพเดตข่าวสำเร็จ'
        ]);
    }



    public function delete_new($id) //ฟังก์ชันลบข่าว
    {
        $news = News::findOrFail($id);

        // Delete the associated image file from storage
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        // Delete the news record
        $news->delete();

        return redirect()->route('table_news')->with('status', [
            'type' => 'success',
            'message' => 'ลบข่าวสำเร็จ',
        ]);
    }
    //end ส่วนข่าว





    //start ส่วนสไลด์
    public function form_add_slide() //เเสดงฟอร์มเพิ่มสไลด์
    {
        return view('admin.form-add-slide_img');
    }
    public function insert_silde(Request $request) //insert สไลด์
    {
        date_default_timezone_set('Asia/Bangkok');
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'title.required' => 'กรุณากรอกชื่อภาพสไลด์',
                'image.required' => 'กรุณาเลือกรูปภาพ',
                'image.max' => 'ห้ามอัปโหลดไฟล์เกิน 2 MB',
            ]
        );

        $imagePath = $request->file('image')->store('uploads/images/slide_img', 'public');

        // Insert data into the database
        $data = [
            'title' => $request->title,
            'image' => $imagePath,
        ];

        // Save to database (assume your model is News)
        Slide_img::create($data);

        // Redirect or return a response
        return redirect()->route('add-slide')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มสไลด์สำเร็จ',
        ]);
    }

    public function table_slide_img() //เเสดงตาราง slide_img พร้อมส่งค่าไป loop
    {
        $table_slide = Slide_img::all();
        return view('admin.table_slide_img', compact('table_slide'));
    }
    //ลบภาพสไลด์
    public function delete_slide($id)
    {
        $slide = Slide_img::findOrFail($id);

        // Delete the associated image file from storage
        if ($slide->image) {
            // Delete from public disk storage
            Storage::disk('public')->delete($slide->image);

            // Delete from storage directory if exists
            $storagePath = storage_path('app/public/' . $slide->image);
            if (file_exists($storagePath)) {
                unlink($storagePath);
            }
        }

        // Delete the slide record
        $slide->delete();

        return redirect()->route('table_slide')->with('status', [
            'type' => 'success',
            'message' => 'ลบภาพสไลด์สำเร็จ'
        ]);
    }


    //end ส่วนสไลด์

    //start ส่วนบุคลากร
    public function form_add_teacher() //เเสดงฟอร์มเพิ่มบุคลากร
    {
        return view('admin.form-add-teacher');
    }
    public function insert_teacher(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');
        $request->validate(
            [
                'nameprefix' => 'required|string|max:10',
                'name' => 'required|string|max:100',
                'lastname' => 'required|string|max:100',
                'position' => 'required|string|max:100',
                'tel' => 'required|string|max:10',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'prefix.required' => 'กรุณากรอกคำนำหน้า',
                'name.required' => 'กรุณากรอกชื่อบุคลากร',
                'name.max' => 'ห้ามกรอกเกิน 100 ตัวอักษร',
                'lastname.required' => 'กรุณากรอกนามสกุล',
                'position.required' => 'กรุณากรอกตำเเหน่ง',
                'position.max' => 'ห้ามกรอกเกิน 100 ตัวอักษร',
                'tel.required' => 'กรุณากรอกเบอร์โทร',
                'image.required' => 'กรุณาเลือกรูปภาพ',
                'image.max' => 'ห้ามอัปโหลดไฟล์เกิน 2 MB',
            ]
        );
        $imagePath = $request->file('image')->store('uploads/images/teacher', 'public');
        $data = [
            'image' => $imagePath,
            'nameprefix' => $request->nameprefix,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'tel' => $request->tel,
            'position' => $request->position,
        ];
        Teacher::create($data);
        return redirect()->route('add-teacher')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มบุคคลากรสำเร็จ',
        ]);
    }
    //เเสดงตารางบุคลากร
    public function table_teacher()
    {
        $teachers = Teacher::all();
        return view('admin.table_teacher', compact('teachers'));
    }
    //ส่วนเเก้บุคลากร
    public function update_teacher(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'nameprefix' => 'required|string|max:10',
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'tel' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $teacher = Teacher::findOrFail($request->teacher_id);

        $updateData = [
            'nameprefix' => $request->nameprefix,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'position' => $request->position,
            'tel' => $request->tel
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($teacher->image) {
                Storage::disk('public')->delete($teacher->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('uploads/images/teacher', 'public');
            $updateData['image'] = $imagePath;
        }

        $teacher->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'อัพเดตข้อมูลบุคลากรสำเร็จ'
        ]);
    }

    //ลบบุคลากร
    public function delete_teacher($id)
    {
        $teacher = Teacher::findOrFail($id);

        // Delete the associated image file from storage
        if ($teacher->image) {
            Storage::disk('public')->delete($teacher->image);
        }

        // Delete the teacher record
        $teacher->delete();

        return redirect()->route('table_teacher')->with('status', [
            'type' => 'success',
            'message' => 'ลบบุคลากรสำเร็จ',
        ]);
    }



    //end ส่วนบุคลากร

    // start ส่วนเพิ่มผลงานนักเรียน
    //เเสดงตารางจัดการผลงาน

    //ฟอร์มเพิ่มผลงาน
    public function form_trophy()
    {
        return view('admin.form-add-trophy');
    }
    //เพิ่มผลงาน
    public function insert_trophy(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');
        $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'trophy_name' => 'required|string|max:100',
                'trophy_detail' => 'required|string|max:1000',
                'trophy_type' => 'required|string|max:100',
                'trophy_level' => 'required|string',
                'placename' => 'required|string|max:100',
                'date' => 'required|date',
                'teacher_name' => 'required|string|max:100',
                'student_name' => 'required|string|max:200'
            ]
        );

        $image_path = $request->file('image')->store('uploads/images/trophy', 'public');
        $data = [
            'image' => $image_path,
            'trophy_name' => $request->trophy_name,
            'trophy_detail' => $request->trophy_detail,
            'trophy_type' => $request->trophy_type,
            'trophy_level' => $request->trophy_level,
            'placename' => $request->placename,
            'date' => $request->date,
            'teacher_name' => $request->teacher_name,
            'student_name' => $request->student_name
        ];

        Trophy::create($data);
        return redirect()->route('add-trophy')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มผลงานสำเร็จ',
        ]);
    }
    //ตารางจัดการผลงาน
    public function table_trophy()
    {
        $trophys = Trophy::all();
        return view('admin.table_trophy', compact('trophys'));
    }
    //updete ผลงาน
    public function update_trophy(Request $request)
    {
        $request->validate([
            'trophy_id' => 'required|exists:trophy,id',
            'trophy_name' => 'required|string|max:100',
            'trophy_detail' => 'required|string|max:1000',
            'trophy_type' => 'required|string|max:100',
            'trophy_level' => 'required|string',
            'placename' => 'required|string|max:100',
            'date' => 'required|date',
            'teacher_name' => 'required|string|max:100',
            'student_name' => 'required|string|max:200',
            'trophy_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $trophy = Trophy::find($request->trophy_id);

        $updateData = [
            'trophy_name' => $request->trophy_name,
            'trophy_detail' => $request->trophy_detail,
            'trophy_type' => $request->trophy_type,
            'trophy_level' => $request->trophy_level,
            'placename' => $request->placename,
            'date' => $request->date,
            'teacher_name' => $request->teacher_name,
            'student_name' => $request->student_name
        ];

        if ($request->hasFile('trophy_image')) {
            // Delete old image
            if ($trophy->image) {
                Storage::disk('public')->delete($trophy->image);
            }

            // Store new image 
            $imagePath = $request->file('trophy_image')->store('uploads/images/trophy', 'public');
            $updateData['image'] = $imagePath;
        }

        $trophy->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'อัพเดตผลงานสำเร็จ'
        ]);
    }
    //ลบ trophy
    public function delete_trophy($id)
    {
        $trophy = Trophy::findOrFail($id);

        // Delete the associated image file from storage
        if ($trophy->image) {
            Storage::disk('public')->delete($trophy->image);
        }

        // Delete the trophy record
        $trophy->delete();

        return redirect()->route('table_trophy')->with('status', [
            'type' => 'success',
            'message' => 'ลบผลงานสำเร็จ',
        ]);
    }


    //เพิ่มเติมส่วนเสริมเพิ่มเติม
    //ตารางจัดการส่วนเพิ่มเติม
    public function table_addtional()
    {
        $addtionals = addtional::all();
        return view('admin.table_addtional', compact('addtionals'));
    }
    //ฟอร์มเพิ่มส่วนเพิ่มเติม
    public function form_addtional()
    {
        return view('admin.form-add-addtional');
    }

    //เพิ่มข้อมูลส่วนเพิ่มเติม
    public function insert_addtional(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'url' => 'required',
                'show' => 'required'
            ]
        );

        $image_path = $request->file('image')->store('uploads/images/addtional', 'public');
        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'image' => $image_path,
            'show' => $request->show
        ];

        addtional::create($data);
        return redirect()->route('add-addtional')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มส่วนเพิ่มเติมสำเร็จ',
        ]);
    }
    //update ส่วนเพิ่มเติม
    public function update_addtional(Request $request)
    {
        $request->validate([
            'additional_id' => 'required|exists:addtionals,id',
            'additional_name' => 'required|string|max:100',
            'additional_url' => 'required|string',
            'additional_show' => 'required',
            'additional_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $addtional = addtional::find($request->additional_id);

        $updateData = [
            'name' => $request->additional_name,
            'url' => $request->additional_url,
            'show' => $request->additional_show
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($addtional->image) {
                Storage::disk('public')->delete($addtional->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('uploads/images/addtional', 'public');
            $updateData['image'] = $imagePath;
        }

        $addtional->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'อัพเดตส่วนเพิ่มเติมสำเร็จ'
        ]);
    }
    //ลบส่วนเพิ่มเติม
    public function delete_addtional($id)
    {
        $addtional = addtional::findOrFail($id);

        // Delete the associated image file from storage
        if ($addtional->image) {
            Storage::disk('public')->delete($addtional->image);
        }

        // Delete the addtional record
        $addtional->delete();

        return redirect()->route('table_addtional')->with('status', [
            'type' => 'success',
            'message' => 'ลบส่วนเพิ่มเติมสำเร็จ',
        ]);
    }
    //end ส่วนเพิ่มเติม


    //ส่วนหลักสูตร

    //เเสดงตารางหลักสูตร
    public function table_detailcourse()
    {
        $detailcourses = DetailCourse::all();
        return view('admin.table_detailcourse', compact('detailcourses'));
    }
    //ฟอร์มเพิ่มรายละเอียดวิชาเรียน
    public function form_detailcourse()
    {
        return view('admin.form-add-detailcourse');
    }
    //เพิ่มรายละเอียดวิชาเรียน
    public function insert_detailcourse(Request $request)
    {
        $request->validate(
            [
                'course_name' => 'required|string|max:100'
            ],
            [
                'course_name.required' => 'กรุณากรอกชื่อวิชา',
                'course_name.max' => 'ชื่อวิชาต้องไม่เกิน 100 ตัวอักษร'
            ]
        );

        $data = [
            'name' => $request->course_name
        ];

        DetailCourse::create($data);
        return redirect()->route('add-detailcourse')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มวิชาสำเร็จ'
        ]);
    }
    //update รายละเอียดวิชาเรียน
    public function update_detailcourse(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:detail_courses,id',
            'name' => 'required|string|max:255'
        ]);

        $detailcourse = DetailCourse::findOrFail($request->id);

        $updateData = [
            'name' => $request->name,
            'updated_at' => now()
        ];

        $detailcourse->update($updateData);

        return response()->json([
            'status' => 'success',
            'message' => 'อัพเดตรายละเอียดวิชาหลักสูตรสำเร็จ'
        ]);
    }
    //ลบรายละเอียดวิชาเรียน
    public function delete_detailcourse($id)
    {
        $detailcourse = DetailCourse::findOrFail($id);

        // Delete the record
        $detailcourse->delete();

        return redirect()->route('table_detailcourse')->with('status', [
            'type' => 'success',
            'message' => 'ลบรายละเอียดวิชาหลักสูตรสำเร็จ',
        ]);
    }




    //ส่วนไฟล์เเผนการเรียน
    //ตารางเเสดงเเผนการเรียน ปวช.
    public function table_vocational()
    {
        $studyplan = Studyplan::where('name', 'ปวช.')->orderBy('year', 'desc')->get();
        return view('admin.vacation', compact('studyplan'));
    }
    //ตารางเเสดงเเผนการเรียน ปวส.
    public function table_diploma()
    {
        $studyplan = Studyplan::where('name', 'ปวส.')->orderBy('year', 'desc')->get();
        return view('admin.diploma', compact('studyplan'));
    }
    public function delete_studyplan($id)
    {
        $studyplan = Studyplan::findOrFail($id);
        // Delete file from storage
        if ($studyplan->pathfile) {
            Storage::disk('public')->delete($studyplan->pathfile);
        }
        $studyplan->delete();
        return redirect()->route('table_vocational')->with('status', [
            'type' => 'success',
            'message' => 'ลบไฟล์เเผนการเรียนสำเร็จ',
        ]);
    }

    public function insert_studyplan(Request $request)
    {
        $request->validate(
            [
                'educationLevel' => 'required|string|max:100',
                'year' => 'required|numeric|min:2500|max:2599',
                'fileUpload' => 'required|mimes:pdf|max:10240'
            ],
            [
                'educationLevel.required' => 'กรุณากรอกระดับการศึกษา',
                'educationLevel.max' => 'ระดับการศึกษาต้องไม่เกิน 100 ตัวอักษร',
                'year.required' => 'กรุณากรอกปีการศึกษา',
                'year.numeric' => 'ปีการศึกษาต้องเป็นตัวเลขเท่านั้น',
                'year.min' => 'ปีการศึกษาต้องมากกว่า 2500',
                'year.max' => 'ปีการศึกษาต้องน้อยกว่า 2599',
                'fileUpload.required' => 'กรุณาเลือกไฟล์ PDF',
                'fileUpload.mimes' => 'ต้องเป็นไฟล์ PDF เท่านั้น',
                'fileUpload.max' => 'ขนาดไฟล์ต้องไม่เกิน 10MB'
            ]
        );
        // Check for duplicate study plan
        $existingPlan = Studyplan::where('name', $request->educationLevel)
            ->where('year', $request->year)
            ->first();

        if ($existingPlan) {
            return redirect()->route('table_vocational')->with('status', [
                'type' => 'danger',
                'message' => 'มีไฟล์ปีการศึกษานี้อยู่ในระบบแล้ว หากต้องเเก้ไขให้ลบไฟล์เดิมก่อนเเล้วเพิ่มใหม่'
            ]);
        }

        $extension = $request->file('fileUpload')->getClientOriginalExtension();
        $uniqueName = 'เเผนการเรียน' . $request->educationLevel . $request->year . '.' . $extension;
        $filePath = $request->file('fileUpload')->storeAs('uploads/files/studyplan', $uniqueName, 'public');

        $data = [
            'name' => $request->educationLevel,
            'year' => $request->year,
            'pathfile' => $filePath,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Studyplan::create($data);

        return redirect()->route('table_vocational')->with('status', [
            'type' => 'success',
            'message' => 'เพิ่มไฟล์แผนการเรียนสำเร็จ'
        ]);
    }
    // เเสดงตาราง admins พร้อมส่งค่าไป loop
    public function table_admin()
    {
        $admins = Admin::where('role', '!=', 'root')->get();
        return view('admin.table_admin', compact('admins'));
    }

    // เพิ่ม admin ใหม่
    public function store_admin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|max:100|unique:admins',
                'email' => 'required|string|email|max:100|unique:admins',
                'password' => 'required|string|min:8|confirmed',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                'username.required' => 'กรุณากรอกชื่อผู้ใช้',
                'username.unique' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้ว',
                'email.required' => 'กรุณากรอกอีเมล',
                'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
                'password.required' => 'กรุณากรอกรหัสผ่าน',
                'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
                'password.confirmed' => 'ยืนยันรหัสผ่านไม่ตรงกัน',
                'image.required' => 'กรุณาเลือกรูปโปรไฟล์',
                'image.max' => 'ห้ามอัปโหลดไฟล์เกิน 2 MB',
            ]
        );

        // Upload image
        $imagePath = $request->file('image')->store('uploads/images/admins', 'public');

        // Create new admin
        Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
            'role' => 'admin', // ตั้งค่าเป็น admin โดยตรง
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('table_admin')->with('success', 'เพิ่มผู้ดูแลระบบสำเร็จ');
    }

    // อัพเดทข้อมูล admin
    public function update_admin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $rules = [
            'username' => 'required|string|max:100|unique:admins,username,' . $id,
            'email' => 'required|string|email|max:100|unique:admins,email,' . $id,
        ];

        $messages = [
            'username.required' => 'กรุณากรอกชื่อผู้ใช้',
            'username.unique' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้ว',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
        ];

        // Check if changing password
        if ($request->has('change_password') && $request->change_password) {
            $rules['password'] = 'required|string|min:8|confirmed';
            $messages['password.required'] = 'กรุณากรอกรหัสผ่าน';
            $messages['password.min'] = 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร';
            $messages['password.confirmed'] = 'ยืนยันรหัสผ่านไม่ตรงกัน';
        }

        // Validate image if uploaded
        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:2048';
            $messages['image.max'] = 'ห้ามอัปโหลดไฟล์เกิน 2 MB';
        }

        $request->validate($rules, $messages);

        // Prepare update data
        $updateData = [
            'username' => $request->username,
            'email' => $request->email,
            'updated_at' => now()
        ];

        // Update password if needed
        if ($request->has('change_password') && $request->change_password) {
            $updateData['password'] = Hash::make($request->password);
        }

        // Update image if uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('uploads/images/admins', 'public');
            $updateData['image'] = $imagePath;
        }

        // Update admin record
        $admin->update($updateData);

        return redirect()->route('table_admin')->with('status', [
            'type' => 'success',
            'message' => 'อัพเดตข้อมูลผู้ดูแลระบบสำเร็จ',
        ]);
    }

    // ลบ admin
    public function destroy_admin($id)
    {
        $admin = Admin::findOrFail($id);

        // Delete the associated image file from storage
        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }

        // Delete the admin record
        $admin->delete();

        return redirect()->route('table_admin')->with('status', [
            'type' => 'success',
            'message' => 'ลบผู้ดูแลระบบสำเร็จ',
        ]);
    }
    //เเสดงฟอร์มเเก้ไขรหัส admin
    public function change_password()
    {
        return view('admin.changepass');
    }

    //เเก้ไขรหัส admin
    public function update_password(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ], [
            'current_password.required' => 'กรุณากรอกรหัสผ่านปัจจุบัน',
            'new_password.required' => 'กรุณากรอกรหัสผ่านใหม่',
            'new_password.min' => 'รหัสผ่านใหม่ต้องมีอย่างน้อย 8 ตัวอักษร',
            'confirm_password.required' => 'กรุณายืนยันรหัสผ่านใหม่',
            'confirm_password.same' => 'รหัสผ่านยืนยันไม่ตรงกับรหัสผ่านใหม่'
        ]);

        $admin = Admin::findOrFail($request->admin_id);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง']);
        }

        $admin->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', [
            'type' => 'success',
            'message' => 'เปลี่ยนรหัสผ่านสำเร็จ กรุณาเข้าสู่ระบบใหม่'
        ]);
    }
}
