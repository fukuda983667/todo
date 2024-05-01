@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@if(isset($message))
    <!-- $messageがnullでない場合に表示するコンテンツ -->
    <div class="result__message">
        <p>{{ $message }}</p>
    </div>
@endif

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
    <form action="'/'" class="form__todo--list" method="post">
        @csrf
        <div class="form__input--text">
            <input type="text" name="content" value="{{ $todo['content'] }}"/>
        </div>

        <div class="button__wrapper">
            <div class="form__button--update">
                <button class="form__button--submit" type="submit">更新</button>
            </div>
            <div class="form__button--delete">
                <button class="form__button--submit" type="submit">削除</button>
            </div>
        </div>
    </form>
    @endforeach
</div>



@endsection
