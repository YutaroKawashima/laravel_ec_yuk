@extends('layouts.auth')

@section('content')
    <div class="login-area form-box">
        <form method="post" action="{{ url('register') }}" class = "login-form">
            {{ csrf_field() }}
            <div class="form-item form-title"> Register </div>
            <div class="form-item">
                <p class="name-area">
                    <label for="name">
                        Username
                    </label>
                    <p>
                        <input type="text" name="name" class="name-form" value="">
                    </p>
                </p>
                <p class="pass-area">
                    <label for="password">
                        Password
                    </label>
                    <p>
                        <input type="password" name="password" class="pass-form" value="">
                    </p>
                </p>
                <div class = "submit-area">
                    <button type="submit"  value="send" class="submit-login">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
