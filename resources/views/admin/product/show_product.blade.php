@extends('templates.master')

@section('content')
    <div class="container px-16 py-16">
        <a href="{{ route('product.view') }}" class="text-white font-medium bg-yellow-500 py-2 px-5 rounded-lg hover:opacity-80 duration-300"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <a href="{{ url('admin/product/' . $products->id . '/edit') }}" class="text-white font-medium bg-green-600 py-2 px-5 rounded-lg hover:opacity-80 duration-300"><i class="fa-solid fa-edit"></i> Edit</a>
        <div class="text-2xl mt-6 mb-6">Produk</div>

        <div class="max-w-xl">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                        <div class="border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5">
                            {{ $products->name }}
                        </div>
                    </div>
                    <div>
                        <label for="product_description" class="block mb-1 text-sm font-medium text-gray-900">Deskripsi</label>
                        <div class="border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5">
                            {{ $products->desc }}
                        </div>
                    </div>
                    <div>
                        <label for="product_qty" class="block mb-1 text-sm font-medium text-gray-900">Stok</label>
                        <div class="border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5">
                            {{ $products->qty }}
                        </div>
                    </div>
                    <div>
                        <label for="product_price" class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                        <div class="border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5">
                            {{ $products->price }}
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="product_category" class="block mb-1 text-sm font-medium text-gray-900">Kategori Produk</label>
                        <div class="border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5">
                            {{ $products->category->name }}
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/products/' . $products->image) }}" alt="Gambar {{ $products->name }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection