<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $data['title'] = 'Admin - Produk';
        $data['products'] = Product::with('category')->paginate(10);
        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Produk';
        $data['categories'] = Category::all();
        return view('admin.product.add_product', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:100'],
            'product_description' => ['required', 'string'],
            'product_qty' => ['required', 'numeric'],
            'product_price' => ['required', 'numeric'],
            'product_category' => ['required'],
            'product_image' => ['required', 'mimes:png,jpg,jpeg']
        ]);
        if($request->hasFile('product_image')) {
            
            $image = $request->file('product_image');
            $image->storeAs('public/products', $image->hashName());

            Product::create([
                'name' => $validated['product_name'],
                'desc' => $validated['product_description'],
                'qty' => $validated['product_qty'],
                'price' => $validated['product_price'],
                'category_id' => $validated['product_category'],
                'image' => $image->hashName()
            ]);
        }

        return redirect()->route('product.view')->with('success', 'Berhasil menambahkan produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Produk';
        $data['products'] = Product::with('category')->find($id);
        
        return view('admin.product.show_product', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Produk';
        $data['categories'] = Category::all();
        $data['products'] = Product::with('category')->find($id);
        return view('admin.product.edit_product', $data);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:100'],
            'product_description' => ['required', 'string'],
            'product_qty' => ['required', 'numeric'],
            'product_price' => ['required', 'numeric'],
            'product_category' => ['required'],
            'product_image' => ['mimes:png,jpg,jpeg']
        ]);

        $data = Product::find($id);

        if($request->hasFile('product_image')) {
            unlink(storage_path('app\public\products\\'.$data->image));

            $image = $request->file('product_image');
            $image->storeAs('public/products', $image->hashName());

            Product::where('id', $id)->update([
                'name' => $validated['product_name'],
                'desc' => $validated['product_description'],
                'qty' => $validated['product_qty'],
                'price' => $validated['product_price'],
                'category_id' => $validated['product_category'],
                'image' => $image->hashName()
            ]);
        }
        else {
            Product::where('id', $id)->update([
                'name' => $validated['product_name'],
                'desc' => $validated['product_description'],
                'qty' => $validated['product_qty'],
                'price' => $validated['product_price'],
                'category_id' => $validated['product_category'],
            ]);
        }

        return redirect()->route('product.view')->with('success', 'Berhasil mengupdate produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->delete_id);
        unlink(storage_path('app\public\products\\'.$product->image));
        $product->delete();
        
        return redirect()->route('product.view')->with('success', 'Berhasil menghapus produk');
    }
}
