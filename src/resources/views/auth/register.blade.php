@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>Register</h2>
    </div>
    <div class="register-form__container">
        <form class="register-form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label>お名前</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
                @error('name')
                    <p class="form__error" style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email')
                    <p class="form__error" style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech1106">
                @error('password')
                    <p class="form__error" style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-button">
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
