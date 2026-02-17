@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <div class="search-form">
        <form class="search-form__inner" action="/admin" method="get">
            <div class="search-form__item">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
            </div>
            <div class="search-form__item">
                <select name="gender">
                    <option value="" disabled {{ !request('gender') ? 'selected' : '' }}>性別</option>
                    <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="search-form__item">
                <select name="category_id">
                    <option value="" selected>お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $loop->iteration }}. {{ $category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__item">
                <input type="date" name="date" value="{{ request('date') }}">
            </div>
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
                <a href="/admin" class="search-form__button-reset">リセット</a>
            </div>
        </form>
        <div class="admin__sub-header">
            <form action="/admin/export" method="get">
                @foreach(request()->query() as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button class="export-button" type="submit">エクスポート</button>
            </form>

            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>

    <div class="admin__table-container">
        <table class="admin__table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>@if($contact->gender == 1) 男性 @elseif($contact->gender == 2) 女性 @else その他 @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td class="admin__table-detail">
                        <button class="detail-button" type="button" data-name="{{ $contact->last_name }} {{ $contact->first_name }}"data-gender="{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}"
                        data-email="{{ $contact->email }}"
                        data-tel="{{ $contact->tel }}"
                        data-address="{{ $contact->address }}"
                        data-building="{{ $contact->building }}"
                        data-category="{{ $contact->category->content }}"
                        data-detail="{{ $contact->detail }}"data-id="{{ $contact->id }}">詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="detailModal" class="modal">
        <div class="modal__content">
            <span class="modal__close">&times;</span>
            <table class="modal__table">
                <tr><th>お名前</th><td id="modal-name"></td></tr>
                <tr><th>性別</th><td id="modal-gender"></td></tr>
                <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
                <tr><th>電話番号</th><td id="modal-tel"></td></tr>
                <tr><th>住所</th><td id="modal-address"></td></tr>
                <tr><th>建物名</th><td id="modal-building"></td></tr>
                <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
                <tr><th>お問い合わせ内容</th><td id="modal-detail"></td></tr>
            </table>
            <form action="/admin/delete" method="post" class="delete-form">
                @csrf
                <input type="hidden" name="id" id="modal-id">
                <button type="submit" class="delete-button">削除</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.detail-button').forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById('detailModal');
                document.getElementById('modal-name').textContent = button.dataset.name;
                document.getElementById('modal-gender').textContent = button.dataset.gender;
                document.getElementById('modal-email').textContent = button.dataset.email;
                document.getElementById('modal-tel').textContent = button.dataset.tel;
                document.getElementById('modal-address').textContent = button.dataset.address;
                document.getElementById('modal-building').textContent = button.dataset.building;
                document.getElementById('modal-category').textContent = button.dataset.category;
                document.getElementById('modal-detail').textContent = button.dataset.detail;
                document.getElementById('modal-id').value = button.dataset.id;
                
                modal.style.display = 'block';
            });
        });

        window.addEventListener('click', (e) => {
            const modal = document.getElementById('detailModal');
            if (e.target === modal || e.target.className === 'modal__close') {
                modal.style.display = 'none';
            }
        });
    </script>
@endsection
