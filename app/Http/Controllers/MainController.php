<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Something;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();
        $data['subCategories'] = SubCategory::get();
        $data['somethings'] = Something::get();
        return view('main', $data);
    }

    public function create()
    {
        return view('modals.addSomething');
    }

    public function store(Request $request, Something $something)
    {
        $something->fill($request->all())->save();
        $something->subCategory()->attach($request->subcategory_id);
        return \response()->json(['status' => 'error', 'msg' => $something->name]);
    }

    public function edit($id)
    {
        $something = Something::find($id);
        return response()->view('modals.editSomething', compact('something'));
    }

    public function update(Request $request, $id)
    {
        $something = Something::find($id);
        $something->fill($request->all())->save();
        $something->subCategory()->attach($request->subcategory_id);
        return \response()->json(['status' => 'error', 'msg' => $something->name.'updated']);
    }

    public function destroy($id)
    {
        Something::find($id)->destroy();
        return \response()->json(['status' => 'error', 'msg' =>'destroyed']);
    }
}
