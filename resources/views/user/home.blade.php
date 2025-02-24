@extends('layout')

@section('title', 'หน้าหลัก')

@section('content')
    <div class="content-wrap">
        @include('component/user/slide')
        @include('component/user/hero-title')
        @include('component/user/new_update')
        @include('component/user/student_trophy')
        @include('component/user/new_8box')
    </div>
    
@endsection
   