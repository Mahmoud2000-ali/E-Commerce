<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $allSubCategories = Subcategory::latest()->get();
        return view('Admin.subcategory.allSubcategory', compact('allSubCategories'));
    }

    public function AddSubCategory(){
        $categories = Category::latest()->get();
        return view('Admin.subcategory.addSubcategory', compact("categories"));
    }

    public function StoreSubCategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ]);

        $category_id = $request->category_id;
        $category_name = Category::where('id', $category_id)->value('category_name');

        Subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,
        ]);
        Category::where('id', $category_id)->increment('subcategory_count',1);

        return to_route('admin.allSubcategory')->with('message', 'SubCategory Added successfully');

    }

    public function editSubCategory($id){
        $Subcategory = Subcategory::findOrFail($id);
        return view('Admin.subcategory.editSubCategory', compact('Subcategory'));
    }

    public function UpdateSubCategory(Request $request){

        $request ->validate([
            'subcategory_name' => 'required',
        ]);
        $subcatid = $request->subcatid;

        Subcategory::findOrFail($subcatid)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('','-',$request->category_name)),
        ]);
        return to_route('admin.allSubcategory')->with('message', 'SubCategory Update successfully');

    }

    public function DeleteSubCategory($id){
        $cat_id = Subcategory::where('id', $id)->value('category_id');
        Subcategory::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('subcategory_count', 1);

        return to_route('admin.allSubcategory')->with('message', 'Category Delete successfully');
    }
}
