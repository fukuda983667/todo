@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@if(session('message'))
    <!-- 'message'がnullでない場合に表示するコンテンツ -->
    <div class="result__message--successfully">
        <p>{{ session('message') }}</p>
    </div>
@endif

@error('content')
    <div class="result__message--error">
        <p>{{$message}}</p>
    </div>
@enderror

<div class="todo__content">

    <h2>新規作成</h2>
    <form action="/todos" class="form__todo--create" method="post">
        @csrf
        <div class="form__input--text">
            <input type="text" name="content"/>
        </div>
        <div class="select-box">
            <!-- リクエストを送る際に、category_id(キー), $category['id'](値)が$requestに格納される-->
            <select name='category_id'>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form__button--create">
            <button class="form__button--submit" type="submit">作成</button>
        </div>
    </form>

    <h2>Todo検索</h2>
    <form action="/todos" class="form__todo--search" method="post">
        @csrf
        <div class="form__input--text">
            <input type="text" name="content"/>
        </div>
        <div class="select-box">
            <select name='category_id'>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form__button--create">
            <button class="form__button--submit" type="submit">検索</button>
        </div>
    </form>

    <table class="todo__list" style="width: 100%;">
        <tr>
            <th>
                <p>Todo</p>
            </th>
            <th>
                <p>カテゴリ</p>
            </th>
        </tr>

        @foreach ($todos as $todo)
        <tr>
            <td>
                <div class="edit__content">
                    <form action="/todos/update" class="form__update" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form__input--text">
                            <input type="text" name="content" value="{{ $todo['content'] }}"/>
                        </div>
                        <p>{{ $todo['category']['name'] }}</p>
                        <div class="form__button--update">
                            <button class="form__button--submit" type="submit" name="id" value="{{ $todo['id'] }}">更新</button>
                        </div>
                    </form>

                    <form action="/todos/delete" class="form__delete" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="form__button--delete">
                            <button class="form__button--submit" type="submit" name="id" value="{{ $todo['id'] }}">削除</button>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach

    </table>
</div>

@endsection
