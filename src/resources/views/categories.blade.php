@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endsection

@section('content')

@if(session('message'))
    <!-- 'message'がnullでない場合に表示するコンテンツ -->
    <div class="result__message--successfully">
        <p>{{ session('message') }}</p>
    </div>
@endif

@error('name')
    <div class="result__message--error">
        <p>{{$message}}</p>
    </div>
@enderror

<div class="category__content">

    <form action="/categories" class="form__category--create" method="post">
        @csrf
        <div class="form__input--text">
            <input type="text" name="name"/>
        </div>
        <div class="form__button--create">
            <button class="form__button--submit" type="submit">作成</button>
        </div>
    </form>

    <table class="category__list" style="width: 100%;">
        <tr>
            <th>
                <p>Category</p>
            </th>
        </tr>

        @foreach ($categories as $category)
        <tr>
            <td>
                <div class="edit__content">
                    <form action="/categories/update" class="form__update" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form__input--text">
                            <input type="text" name="name" value="{{ $category['name'] }}"/>
                        </div>
                        <div class="form__button--update">
                            <button class="form__button--submit" type="submit" name="id" value="{{ $category['id'] }}">更新</button>
                        </div>
                    </form>

                    <form action="/categories/delete" class="form__delete" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="form__button--delete">
                            <button class="form__button--submit" type="submit" name="id" value="{{ $category['id'] }}">削除</button>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach

    </table>
</div>

@endsection
