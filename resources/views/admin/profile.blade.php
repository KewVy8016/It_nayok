@extends('layout-admin')
@section('title', 'Profile')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>Admin Profile</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            @if (Auth::guard('admins')->user()->image)
                                <div class="position-relative d-inline-block">
                                    <img src="{{ Storage::url(Auth::guard('admins')->user()->image) }}"
                                        class="rounded-circle img-thumbnail"
                                        style="width: 150px; height: 150px; object-fit: cover;" alt="Profile Image">
                                    <a href="#"
                                        class="position-absolute bottom-0 end-0 btn btn-sm btn-primary rounded-circle">
                                        <i class="fas fa-camera"></i>
                                    </a>
                                </div>
                            @else
                                <div class="position-relative d-inline-block">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                        style="width: 150px; height: 150px;">
                                        <i class="fas fa-user-circle text-muted" style="font-size: 80px;"></i>
                                    </div>
                                    
                                </div>
                            @endif
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="fas fa-user me-2"></i>Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-id-badge"></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::guard('admins')->user()->username }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-at"></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::guard('admins')->user()->email }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{route('change_password')}}" class="btn btn-primary">
                                <i class="fas fa-key me-2"></i>Change Password
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



@endsection
