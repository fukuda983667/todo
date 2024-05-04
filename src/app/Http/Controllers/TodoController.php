<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    // indexに$requestを引数に指定するとリダイレクトループしてエラーになる。
    public function index()
    {
        // categoriesテーブルが紐づいたTodosテーブルを取得
        $todos = Todo::with('category')->get();
        // categoriesテーブルのみ取得
        $categories = Category::all();
        return view('index', ['todos' => $todos,'categories' => $categories]);
    }

    public function store(TodoRequest $request)
    {
        // ->only([]);で指定のキーを配列で返す。
        $todo = $request->only(['content','category_id']);
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
        Todo::find($request->id)->update($form);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        // categoriesテーブルを参照しつつ、検索
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }
}
