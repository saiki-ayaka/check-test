@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="thanks__container">
    <div class="thanks__background-text">Thank you</div>

    <div class="thanks__content">
        <p class="thanks__message">お問い合わせありがとうございました</p>
        <a class="thanks__home-btn" href="/">HOME</a>
    </div>
</div>
@endsection