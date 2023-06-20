<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller {


    public function products(Request $request) {

    }

    public function categories(Request $request) {

        if($request->method() == "POST") {
            $name = $request->validate([
                'name' => ['required', 'unique:categories,name']
            ]);

            $product = Category::create($name);

            if(!$product) {
                return redirect()->route('product.categories')->with('error', 'Category could not be created. please try again');
            }
            return redirect()->route('product.categories')->with('success', 'Category Addedd successfully');
        }
        $categories = Category::orderBy('created_at', 'desc')->paginate(50);
        $data = [
            'title' => 'Product Categories',
            'categories' => $categories,
            'category' => null
        ];
        
        return parent::render($data, 'product.categories');
    }

    public function brands(Request $request) {

    }

    public function product(Request $request) {



    }

    public function units(Request $request) {

    }

    public function edit(Request $request) {
        $type = $request->route('type');
        $id = $request->route('id');
        if(!$type || !$id) {
            return redirect()->route('product.products');
        }
        if(method_exists($this, $type)) {
            $values = [$id, $request];
            return call_user_func([$this, $type], ...$values);
        } else {
            return redirect()->route('product.categories');
        }

    }

    private function edit_category($id, Request $request) {
        $category = Category::find($id);
        if(!$category) {
            return redirect()->route('product.categories')->with('error', 'Unable to update');
        }

        if($request->method() === 'POST') {
            $valid = $request->validate([
                'name' => ['required']
            ]);

            $exists = Category::where('name', $valid['name'])->where('id', '!=', $category->id)->first();
            if($exists) {
                return redirect()->route('product.categories')->with('error', 'Category name already exists');
            }
            $category->name = $valid['name'];
            $category->save();
            return redirect()->route('product.categories')->with('success', 'Category updated successfully');
        }
        
        $data = ['title' => 'Edit Category', 'categories' => null, 'category' =>  $category];
        return parent::render($data, 'product.categories');
    }

    public function toggle(Request $request) {
        $type = $request->route('type');
        $id = $request->route('id');
        $action = $request->route('action');

        if(!$type || !$id || !$action) {
            return redirect()->route('product.products');
        }
        // dd($type);
        if(method_exists($this, $type)) {
            $values = [$id, $action];
            return call_user_func([$this, $type], ...$values);
        } else {
            return redirect()->route('product.categories');
        }
    }

    private function toggle_category($id, $action) {
        $cat = Category::find($id);
        if(!$cat) {
            return redirect()->route('product.categories');
        }
        $cat->status = ($action === 'suspend') ? false : true;
        $cat->save();
        return redirect()->route('product.categories')->with('success', 'Category updated successfully');
    }

    public function delete(Request $request) {
        $type = $request->route('type');
        $id = $request->route('id');
        if(!$type || !$id) {
            return redirect()->route('product.products');
        }
        if(method_exists($this, $type)) {
            $values = [$id, $request];
            return call_user_func([$this, $type], ...$values);
        } else {
            return redirect()->route('product.categories');
        }
    }

    private function delete_category($id, Request $request) {
        $cat = Category::find($id);
        if(!$cat) {
            return redirect()->route('product.categories');
        }
        $cat->products()->detach();
        $cat->delete();
        return redirect()->route('product.categories')->with('success', 'Category updated successfully');
    }
}
