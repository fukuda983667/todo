<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(TodoRequest $request)
    {
        $todos = Todo::all();
        $message = $request->input('message');
        return view('index', ['todos' => $todos],['message' => $message]);
    }

    public function store(Request $request)
    {
        // ->only([]);で指定のキーを配列で返す。
        $todo = $request->only(['content']);
        Todo::create($todo);
        return redirect()->route('index.route', ['message' => 'Todoを作成しました']);
    }
}
