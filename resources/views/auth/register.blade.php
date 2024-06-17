@extends('layouts.app')

@section('title', 'عضویت')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center bg-info">
                            <i class="bi bi-person text-white fs-1 mt-2"></i>
                        </div>
                        <h3 class="text-center text-muted mb-4" style="font-family: Shabnam">ایجاد حساب</h3>
                        <form action="{{ route('register') }}" method="POST" class="login-form">
                            @csrf
                            @method('post')

                            <div class="form-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="نام" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="نام کاربری" value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="رمز عبور" value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control @error('password', 'password_confirmation') is-invalid @enderror" placeholder="تائید رمز عبور" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-info text-white rounded submit px-3">عضویت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
