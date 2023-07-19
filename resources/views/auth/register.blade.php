@extends('layouts.guest')
@section('content')
    <div class="row container">
        <div class="card card-page col-12 col-md-6 align-self-center">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('auth.register') }}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="text-muted mb-10  text-center">إنشاء حساب</h1>
                        <div class="form-group mb-5 position-relative">
                            <input name="name" type="text" class="form-control form-control-solid pe-10"
                                   placeholder="الاسم">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-5 position-relative">
                            <i class="fa fa-envelope fa-lg position-absolute top-50 translate-middle-y end-0 me-3"></i>
                            <input name="email" type="email" class="form-control form-control-solid pe-10"
                                   placeholder="البريد الالكتروني">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-5 position-relative">
                            <i class="fa fa-key fa-lg position-absolute top-50 translate-middle-y end-0 me-3"></i>
                            <input name="password" type="password" class="form-control form-control-solid pe-10"
                                   placeholder="كلمة المرور">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-5 position-relative">
                            <i class="fa fa-key fa-lg position-absolute top-50 translate-middle-y end-0 me-3"></i>
                            <input name="password_confirmation" type="password" class="form-control form-control-solid pe-10"
                                   placeholder="تاكيد كلمة المرور">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button class="btn btn-primary w-100 mb-4">
                            إنشاء حساب
                        </button>
                        <p class="text-center mb-0">لديك حساب؟
                            <a class="text-primary fw-bolder" href="{{ route('auth.login') }}">تسجيل الدخول</a>
                    </form>
                </div>
            </div>
        </div>
        <img class="col-12 col-md-6 d-none d-md-block" src="assets/images/background-auth.svg" alt="background">
    </div>
@endsection
