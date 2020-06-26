@extends('layouts.admin')

@section('content')
    <div class="login-area form-box">
        <form method="post" action="{{ route('admin.login') }}" class = "login-form">
            {{ csrf_field() }}
            <div class="form-item form-title"> Login </div>
            <div class="form-item">
                <p class="name-area">
                    <label for="name">
                        Username
                    </label>
                    <p>
                        <input type="text" name="name" class="name-form" required>
                    </p>
                </p>
                <p class="pass-area">
                    <label for="password">
                        Password
                    </label>
                    <p>
                        <input type="password" name="password" class="pass-form" required>
                    </p>
                </p>
                <div class = "submit-area">
                    <button type="submit" class="submit-login">
                        Login
                    </button>
                    <a href="" class="set-pass">
                        Forgot your password？
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection
