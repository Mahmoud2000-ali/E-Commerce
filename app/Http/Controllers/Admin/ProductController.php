<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('Admin.product.allProduct', compact('products'));
    }

    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $Subcategories = Subcategory::latest()->get();
        return view('Admin.product.addProduct', compact('categories', 'Subcategories'));
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $image = $request->file('product_image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_image->move(public_path('upload'), $image_name);
        $image_url = 'upload/' . $image_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_image' => $image_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),

        ]);
        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);
        return to_route('admin.allProduct')->with('message', 'Product Added successfully');
    }

    public function editProductImage($id)
    {
        $productInfo = Product::findOrFail($id);
        return view('Admin.product.editProductImage', compact('productInfo'));
    }

    public function UpdateProductImage(Request $request)
    {
        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('product_image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_image->move(public_path('upload'), $image_name);
        $image_url = 'upload/' . $image_name;

        $id = $request->id;
        Product::findOrFail($id)->update([
            'product_image' => $image_url,
        ]);

        return to_route('admin.allProduct')->with('message', 'Product Image Update successfully');
    }

    public function editProduct($id)
    {
        $products = Product::findOrFail($id);

        return view('Admin.product.editProduct', compact('products'));
    }

    public function UpdateProduct(Request $request)
    {

        $productId = $request->id;

        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
        ]);

        Product::findOrFail($productId)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);
        return to_route('admin.allProduct')->with('message', 'Product Update successfully');
    }

    public function deleteProduct($id)
    {

        $cat_id = Product::where('id', $id)->value('product_category_id');
        $subCat_id = Product::where('id', $id)->value('product_subcategory_id');
        Category::where('id', $cat_id)->decrement('product_count', 1);
        Subcategory::where('id', $subCat_id)->decrement('product_count', 1);
        Product::findOrFail($id)->delete();

        return to_route('admin.allProduct')->with('message', 'Product Delete successfully');
    }
}
