<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;

class ProductsController extends Controller {


    public function products(Request $request) {
        $user = Auth::user();
        if($request->method() == "POST") {
            $info = $request->validate([
                'name' => ['required', 'unique:products,name'],
                'sku' => ['required', 'min:13'],
                'unit_id' => ['required'],
                'brand_id' => ['required'],
                'category_id' => ['required'],
                'alert' => ['required'],
                'image' => ['file', 'nullable', 'mimes:png,jpg,jpeg', 'min:1', 'max:2048'],
                'notes' => ['nullable', 'string']
            ]);

            if($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $info['image'] = base64_encode(file_get_contents($request->file('image')));
                }
            }
            $product = Product::create($info);

            if(!$product) {
                return redirect()->route('product.products')->with('error', 'Product could not be created. please try again');
            }
            return redirect()->route('product.products')->with('success', 'Product Addedd successfully');
        }

        $products = Product::orderBy('created_at', 'desc')->paginate(25);
        
        $data = [
            'title' => 'Products',
            'products' => $products,
            'product' => null,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all()
        ];

        // dd($products);
        
        return parent::render($data, 'product.products');
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
        if($request->method() == "POST") {
            $name = $request->validate([
                'name' => ['required', 'unique:categories,name']
            ]);

            $brand = Brand::create($name);

            if(!$brand) {
                return redirect()->route('product.brands')->with('error', 'Category could not be created. please try again');
            }
            return redirect()->route('product.brands')->with('success', 'Category Addedd successfully');
        }
        $brands = Brand::orderBy('created_at', 'desc')->paginate(50);
        $data = [
            'title' => 'Product Brands',
            'brands' => $brands,
            'brand' => null
        ];
        
        return parent::render($data, 'product.brands');
    }

    public function units(Request $request) {
        if($request->method() == "POST") {
            $name = $request->validate([
                'name' => ['required', 'unique:categories,name']
            ]);

            $unit = Unit::create($name);

            if(!$unit) {
                return redirect()->route('product.units')->with('error', 'Unit could not be created. please try again');
            }
            return redirect()->route('product.units')->with('success', 'Unit Addedd successfully');
        }
        $units = Unit::orderBy('created_at', 'desc')->paginate(50);
        $data = [
            'title' => 'Product Unit',
            'units' => $units,
            'unit' => null
        ];
        
        return parent::render($data, 'product.unit');
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

    private function edit_brand($id, Request $request) {
        $brand = Brand::find($id);
        if(!$brand) {
            return redirect()->route('product.brands')->with('error', 'Unable to update');
        }

        if($request->method() === 'POST') {
            $valid = $request->validate([
                'name' => ['required']
            ]);
            $exists = Brand::where('name', $valid['name'])->where('id', '!=', $brand->id)->first();
            if($exists) {
                return redirect()->route('product.brands')->with('error', 'Brand name already exists');
            }
            $brand->name = $valid['name'];
            $brand->save();
            return redirect()->route('product.brands')->with('success', 'Brand updated successfully');
        }
        
        $data = ['title' => 'Edit Brand', 'brands' => null, 'brand' =>  $brand];
        return parent::render($data, 'product.categories');
    }

    private function edit_unit($id, Request $request) {
        $unit = Unit::find($id);
        if(!$unit) {
            return redirect()->route('product.units')->with('error', 'Unable to update');
        }

        if($request->method() === 'POST') {
            $valid = $request->validate([
                'name' => ['required']
            ]);
            $exists = Unit::where('name', $valid['name'])->where('id', '!=', $unit->id)->first();
            if($exists) {
                return redirect()->route('product.units')->with('error', 'Unit name already exists');
            }
            $unit->name = $valid['name'];
            $unit->save();
            return redirect()->route('product.units')->with('success', 'Unit updated successfully');
        }
        
        $data = ['title' => 'Edit Unit', 'units' => null, 'unit' =>  $unit];
        return parent::render($data, 'product.unit');
    }

    private function edit_product($id, Request $request) {
        $unit = Product::find($id);
        if(!$unit) {
            return redirect()->route('product.units')->with('error', 'Unable to update');
        }

        if($request->method() === 'POST') {
            $valid = $request->validate([
                'name' => ['required'],
                'category_id' => ['required']
            ]);
            $exists = Product::where('name', $valid['name'])->where('id', '!=', $unit->id)->first();
            if($exists) {
                return redirect()->route('product.products')->with('error', 'Product name already exists');
            }
            $unit->name = $valid['name'];
            $unit->save();
            return redirect()->route('product.products')->with('success', 'Product updated successfully');
        }
        
        $data = ['title' => 'Edit Product', 'products' => null, 'product' =>  $unit];
        return parent::render($data, 'product.products');
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

    private function toggle_brand($id, $action) {
        $brand = Brand::find($id);
        if(!$brand) {
            return redirect()->route('product.brands');
        }
        $brand->status = ($action === 'suspend') ? false : true;
        $brand->save();
        return redirect()->route('product.categories')->with('success', 'Brand updated successfully');
    }

    public function toggle_unit($id, $action) {
        $unit = Unit::find($id);
        if(!$unit) {
            return redirect()->route('product.units');
        }
        $unit->status = ($action === 'suspend') ? false : true;
        $unit->save();
        return redirect()->route('product.units')->with('success', 'Unit updated successfully');
    }

    public function toggle_product($id, $action) {
        $unit = Product::find($id);
        if(!$unit) {
            return redirect()->route('product.units');
        }
        $unit->status = ($action === 'suspend') ? false : true;
        $unit->save();
        return redirect()->back()->with('success', 'Product updated successfully');
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
        return redirect()->route('product.categories')->with('success', 'Category deleted successfully');
    }

    private function delete_brand($id, Request $request) {
        $brand = Brand::find($id);
        if(!$brand) {
            return redirect()->route('product.brands');
        }
        $brand->products()->detach();
        $brand->delete();
        return redirect()->route('product.brands')->with('success', 'Brand deleted successfully');
    }

    private function delete_unit($id, Request $request) {
        $unit = Unit::find($id);
        if(!$unit) {
            return redirect()->route('product.categories');
        }
        $unit->products()->detach();
        $unit->delete();
        return redirect()->route('product.units')->with('success', 'Unit deleted successfully');
    }

    private function delete_product($id, Request $request) {
        $product = Product::find($id);
        if(!$product) {
            return redirect()->route('product.categories');
        }
        $product->unit()->detach();
        $product->category()->detach();
        $product->brand()->detach();
        $product->delete();
        return redirect()->route('product.products')->with('success', 'Product deleted successfully');
    }


}
