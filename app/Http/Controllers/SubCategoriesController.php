<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;


class SubCategoriesController extends Controller
{
    public function index()
    {
    }
    public function create()
    {
        return view('modals.addSubCategory');
    }

    public function store(Request $request, SubCategory $subCategory)
    {
        $subCategory->fill($request->all())->save();
        return \response()->json(['status' => 'error', 'msg' => $subCategory->name]);
    }

    public function edit($id)
    {
        $subCategory = SubCategory::find($id);
        return response()->view('modals.editSubCategory', compact('subCategory'));
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->fill($request->all())->save();
        return \response()->json(['status' => 'error', 'msg' => $subCategory->name.'updated']);
    }

    public function destroy($id)
    {
        SubCategory::find($id)->destroy();
        return \response()->json(['status' => 'error', 'msg' =>'destroyed']);
    }
}
