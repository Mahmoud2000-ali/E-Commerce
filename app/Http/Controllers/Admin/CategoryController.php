<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('Admin.category.allCategory', compact('categories'));
    }

    public function AddCategory(){
        return view('Admin.category.addCategory');
    }

    public function StoreCategory(Request $request){
        $request ->validate([
            'category_name' => 'required',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace('','-',$request->category_name)),
        ]);

        return to_route('admin.allCategory')->with('message', 'Category created successfully');
    }

    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('Admin.category.editCategory', compact('category'));
    }

    public function UpdateCategory(Request $request){
        $category_id = $request->category_id;

        $request ->validate([
            'category_name' => 'required',
        ]);

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace('','-',$request->category_name)),
        ]);
        return to_route('admin.allCategory')->with('message', 'Category Update successfully');

    }

    public function DeleteCategory($id){
        Category::findOrFail($id)->delete();
        return to_route('admin.allCategory')->with('message', 'Category Delete successfully');
    }
}
