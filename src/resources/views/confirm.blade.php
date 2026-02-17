@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>
                    {{ $contact['last_name'] }} {{ $contact['first_name'] }}
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @php
                        $gender = ['1' => '男性', '2' => '女性', '3' => 'その他'];
                    @endphp
                    {{ $gender[$contact['gender']] }}
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ $contact['email'] }}
                    <input type="hidden" name="email" value="{{ $contact['email'] }}">
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    {{ $contact['tel1'] . $contact['tel2'] . $contact['tel3'] }}
                    <input type="hidden" name="tel" value="{{ $contact['tel1'] . $contact['tel2'] . $contact['tel3'] }}">
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    {{ $contact['address'] }}
                    <input type="hidden" name="address" value="{{ $contact['address'] }}">
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    {{ $contact['building'] }}
                    <input type="hidden" name="building" value="{{ $contact['building'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    {{ $category->content }}
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>
                    {{ $contact['detail'] }}
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                </td>
            </tr>
        </table>

        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <button class="form__button-modify" type="button" onclick="history.back()">修正</button>
        </div>
    </form>
</div>
@endsection
