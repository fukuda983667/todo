<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', ['categories' => $categories]);
    }

        public function store(CategoryRequest $request)
    {
        // ->only([]);で指定のキーを配列で返す。
        $categories = $request->only(['name']);
        Category::create($categories);
        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    public function update(CategoryRequest $request)
    {
        // $category = $request->only(['name']);
        // Category::find($request->id)->update($category);

        $form = $request->all();
        // @csrfにより、csrf対策用のトークンが生成されるため、削除。連想配列の子要素が増えている状態
        unset($form['_token']);
        // レコードを検索、更新
        Category::find($request->id)->update($form);
        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }

    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}
