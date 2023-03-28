@extends('layouts.guest')
@section('content')
    <div class="row container">

        <div class="d-flex align-items-center justify-content-center d-md-none">
            <img src="assets/images/riwaya-logo.png" alt="logo" class="w-75">
        </div>
        <div class="card card-page col-12 col-md-6 align-self-center">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('auth.login') }}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="text-muted mb-10  text-center">تسجيـــــل الدخـــــول</h1>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group mb-5 position-relative">
                            <i class="fa fa-envelope fa-lg position-absolute top-50 translate-middle-y end-0 me-3"></i>
                            <input name="email" type="email" class="form-control form-control-solid pe-10"
                                   placeholder="البريد الالكتروني">
                        </div>
                        <div class="form-group mb-5 position-relative">
                            <i class="fa fa-key fa-lg position-absolute top-50 translate-middle-y end-0 me-3"></i>
                            <input name="password" type="password" class="form-control form-control-solid pe-10"
                                   placeholder="كلمة المرور">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <label class="d-flex align-items-center gap-1">
                                تذكرني
                                <input type="checkbox" name="remember_me">
                            </label>
                            <a class="text-muted text-hover-primary">نسيت كلمة
                                المرور؟</a>
                        </div>
                        <button class="btn btn-primary w-100 mb-4">
                            تسجيل الدخول
                        </button>
                        <p class="text-center mb-0">ليس لديك حساب؟
                            <a href="{{ route('auth.show-register') }}" class="text-primary fw-bolder">انشاء حساب</a>
                    </form>
                </div>
            </div>
        </div>
        <img class="col-6 d-none d-md-block" src="assets/images/background-auth.svg" alt="background">
    </div>
@endsection
