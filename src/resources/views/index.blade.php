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

    <form action="/todos" class="form__todo--create" method="post">
        @csrf
        <div class="form__input--text">
            <input type="text" name="content"/>
        </div>
        <div class="form__button--create">
            <button class="form__button--submit" type="submit">作成</button>
        </div>
    </form>

    <h2>Todo</h2>

    @foreach ($todos as $todo)
    <div class="edit__content">
        <form action="/todos/update" class="form__update" method="post">
            @csrf
            @method('PATCH')
            <div class="form__input--text">
                <input type="text" name="content" value="{{ $todo['content'] }}"/>
            </div>
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
    @endforeach
</div>

@endsection
