<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products;
use App\Models\Bin;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function filter()
    {
        $product = Product::
        select('products.*', DB::raw('categories.name as category'), DB::raw('bins.name as bin'), DB::raw('colors.name as color'), DB::raw('sizes.name as sizes'))
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('bins', 'bins.id', '=', 'products.bin_id')
            ->leftJoin('colors', 'colors.id', '=', 'products.color')
            ->leftJoin('sizes', 'sizes.id', '=', 'products.size')
            ->where('products.user_id', Auth::id())
            ->orderBy('products.id', 'desc')
            ->get();
        return DataTables::of($product)
           ->make(true);
    }

    public function create()
    {
        $data['category'] = Category::where('user_id', Auth::id())->get();
        $data['bin'] = Bin::where('user_id', Auth::id())->get();
        $data['color'] = Color::where('user_id', Auth::id())->get();
        $data['size'] = Size::where('user_id', Auth::id())->get();

        return view('product.create', $data);
    }

    public function store(Products $pr)
    {
        $image_name = '';
        if (isset($pr->image) && !empty($pr->image)) {
            $pr->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image_name = time() . '.' . $pr->image->hashName();
            $pr->image->move(public_path('images/product'), $image_name);
        }

        $product = Product::create([
            'user_id' => Auth::id(),
            'name' => $pr->name,
            'description' => $pr->description,
            'sku' => $pr->sku,
            'uom' => $pr->uom ? $pr->uom : '',
            'image' => $image_name,
            'weight' => $pr->weight,
            'width' => $pr->width,
            'height' => $pr->height,
            'color' => $pr->color,
            'size' => $pr->size,
            'category_id' => $pr->category,
            'bin_id' => $pr->bin
        ]);
        if ($product) {
            return redirect()->back()->with(['success' => 'Product ' . $pr->name . ' crated successfully']);
        }
    }

    public function view($id)
    {
        $data['product'] = $this->getProduct($id);

        return view('product.view', $data);
    }

    public function image(Request $pr)
    {
        $pr->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image_name = time() . '.' . $pr->image->hashName();
        $pr->image->move(public_path('images/product'), $image_name);
        $image = Product::find($pr->id)->update(['image' => $image_name]);
        if ($image) {
            $data['action'] = 'success';
            $data['img'] = $image_name;
            return response()->json($data);
        }
    }

    public function edit($id)
    {
        $data['uom'] = array(
            'quantity',
            'kilogram',
            'box'
        );
        $data['category'] = Category::where('user_id', Auth::id())->get();
        $data['bin'] = Bin::where('user_id', Auth::id())->get();
        $data['color'] = Color::where('user_id', Auth::id())->get();
        $data['size'] = Size::where('user_id', Auth::id())->get();
        $data['product'] = $this->getProduct($id);
        return view('product.edit', $data);
    }

    public function getProduct($id)
    {
        $product = Product::
        select('products.*', DB::raw('categories.name as category'), DB::raw('bins.name as bin'), DB::raw('colors.name as color'), DB::raw('sizes.name as size'))
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('bins', 'bins.id', '=', 'products.bin_id')
            ->leftJoin('colors', 'colors.id', '=', 'products.color')
            ->leftJoin('sizes', 'sizes.id', '=', 'products.size')
            ->where('products.user_id', Auth::id())
            ->where('products.id', $id)
            ->first();

        return $product;
    }


    public function update(Request $pr)
    {
        $pr->validate(
            [
                'name' => 'required|max:15',
                'sku' => 'required|max:10'
            ]
        );

        $image_name = '';
        if (isset($pr->image) && !empty($pr->image)) {

            $img = Product::find($pr->id);
            if (!empty($img['image'])) {
                if (file_exists("images/product/" . $img['image'])) {
                    unlink("images/product/" . $img['image']);
                }
            }
            $pr->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image_name = time() . '.' . $pr->image->hashName();
            $pr->image->move(public_path('images/product'), $image_name);
        }

        $product = Product::find($pr->id);
        $product->name = $pr->name;
        $product->description = $pr->description;
        $product->category_id = $pr->category;
        $product->sku = $pr->sku;
        $product->bin_id = $pr->bin;
        $product->uom = $pr->uom;
        if (!empty($image_name)) {
            $product->image = $image_name;
        }
        $product->weight = $pr->weigth;
        $product->width = $pr->width;
        $product->height = $pr->height;
        $product->color = $pr->color;
        $product->size = $pr->size;
        $product->save();
        if ($product) {
            return redirect()->back()->with(['success' => 'Product ' . $pr->name . ' updated successfully']);
        }
    }

    public function delete($id) {
        $i_product = Inventory::where('product_id',$id)->get();
        if (count($i_product) > 0){
            return redirect()->back()->with(['errors' => 'Product exist in warehouse']);
        }else{
            $delete = Product::where('id',$id)->delete();
            if ($delete){
                return redirect()->back()->with(['success' => 'Product deleted successfully']);
            }
        }

    }
}
