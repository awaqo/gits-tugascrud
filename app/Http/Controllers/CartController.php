<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Cart';
        $data['products'] = Product::all();
        $data['carts'] = Cart::with('product')->get();
        return view('layouts.cart.cart', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'product_id' => 'required',
            'product_qty' => 'required'
        ]);

        // $data = Cart::with('product')->get();
        // $x = 0;
        // if($data[$x]->product->id == $request->product_id) {
        //     dd("same");
        // }
        // for ($i=0; $i < ; $i++) { 
        //     # code...
        // }
        // dd($data->toArray(), $data[$x]->product->id, $request->product_id);
        $data = Cart::all(); 

        $price = $request->product_price;
        $qty = $request->product_qty;
        $subtotal = $price*$qty;

        if(empty($data->product_id)) {
            Cart::create([
                'qty' => $validated['product_qty'],
                'product_id' => $validated['product_id'],
                'total' => $subtotal
            ]);
        } else {
            $checkQty = Cart::find($request->product_id);
            $old_qty = $checkQty->qty;
            $new_qty = ($old_qty + $request->product_qty);

            Cart::where('product_id', $request->product_id)->update([
                'qty' => $new_qty
            ]);
        }

        return redirect()->route('product')->with('success', 'Berhasil menambahkan produk ke cart');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect()->route('cart')->with('success', 'Berhasil menghapus produk dari cart');
    }
}
