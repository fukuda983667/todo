<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    // indexに$requestを引数に指定するとリダイレクトループしてエラーになる。
    public function index()
    {
        $todos = Todo::all();
        return view('index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request)
    {
        // ->only([]);で指定のキーを配列で返す。
        $todo = $request->only(['content']);
        Todo::create($todo);
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        // $todo = $request->only(['content']);
        // Todo::find($request->id)->update($todo);

        $form = $request->all();
        // @csrfにより、csrf対策用のトークンが生成されるため、削除。連想配列の子要素が増えている状態
        unset($form['_token']);
        // レコードを検索、更新
        todo::find($request->id)->update($form);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }
}
