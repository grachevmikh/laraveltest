<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('modals.addCategory');
    }

    public function store(Request $request, Category $category)
    {
        $category->fill($request->all())->save();
        return \response()->json(['status' => 'error', 'msg' => $category->name]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->view('modals.editCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->fill($request->all())->save();
        return \response()->json(['status' => 'error', 'msg' => $category->name.'updated']);
    }

    public function destroy($id)
    {
        Category::find($id)->destroy();
        return \response()->json(['status' => 'error', 'msg' =>'destroyed']);
    }
}
