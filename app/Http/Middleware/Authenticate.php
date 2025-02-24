<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Authenticate
{
    // ฟังก์ชันนี้จะถูกเรียกใช้เมื่อผู้ใช้เข้าถึง route ที่มี middleware
    public function handle($request, Closure $next)
    {
        // ตรวจสอบว่าเป็นผู้ใช้ที่ล็อกอินหรือไม่
        if (Auth::guest()) {
            return redirect()->route('login'); // ถ้าไม่ได้ล็อกอิน, redirect ไปที่หน้า login
        }

        // แชร์ข้อมูลผู้ใช้ที่ล็อกอินไปยังทุกๆ view
        View::share('User', Auth::admins());

        // ถ้าผู้ใช้ล็อกอินแล้ว, ให้ไปยังขั้นตอนถัดไป
        return $next($request);
    }

    // ฟังก์ชันนี้จะถูกเรียกใช้เมื่อผู้ใช้ไม่ได้ล็อกอิน
    protected function redirectTo($request)
    {
        // เช็คว่า request คาดหวัง JSON หรือไม่ (ใช้ในกรณี API)
        if (!$request->expectsJson()) {
            return route('login'); // redirect ไปหน้า login
        }
    }

}
