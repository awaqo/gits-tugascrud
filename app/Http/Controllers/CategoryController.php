<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Kategori Produk';
        $data['categories'] = Category::paginate(10);
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Kategori';
        return view('admin.category.add_category', $data);
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
            'category_name' => ['required', 'string', 'max:100']
        ]);

        Category::create([
            'name' => $validated['category_name']
        ]);

        return redirect()->route('category.view')->with('success', 'Berhasil menambahkan kategori produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Kategori';
        $data['categories'] = Category::find($id);
        return view('admin.category.edit_category', $data);
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
            'category_name' => ['required', 'string', 'max:100']
        ]);

        Category::where('id', $id)->update([
            'name' => $validated['category_name']
        ]);

        return redirect()->route('category.view')->with('success', 'Berhasil mengupdate kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // untuk menghapus gambar yang ada di storage
        $imgProduct = Category::find($request->delete_id)->products->get(0);

        $category = Category::find($request->delete_id);
        // dd($imgProduct->image, $category->toArray());
        unlink(storage_path('app\public\products\\'.$imgProduct->image));
        $category->delete();
        
        return redirect()->route('category.view')->with('success', 'Berhasil menghapus kategori');
    }
}
