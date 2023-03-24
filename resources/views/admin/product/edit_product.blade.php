@extends('templates.master')

@section('content')
    <div class="container px-16 pt-16">
        <a href="{{ route('product.view') }}" class="text-white font-medium bg-yellow-500 py-2 px-5 rounded-lg hover:opacity-80 duration-300"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="text-2xl mt-5">Form Edit Produk</div>

        <div class="max-w-4xl mt-6">
            <form action="{{ url('admin/product/' . $products->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="space-y-4">
                        <div>
                            <label for="product_name" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" value="{{ $products->name }}" name="product_name" id="product_name" 
                                class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                                required>
                            @if ($errors->has('product_name'))
                                <span class="text-xs text-red-500">{{ $errors->first('product_name') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="product_description" class="block mb-1 text-sm font-medium text-gray-900">Deskripsi</label>
                            <textarea type="text" name="product_description" id="product_description" rows="3" 
                            class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                            required>{{ $products->desc }}</textarea>
                            @if ($errors->has('product_description'))
                            <span class="text-xs text-red-500">{{ $errors->first('product_description') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="product_qty" class="block mb-1 text-sm font-medium text-gray-900">Stok</label>
                            <input type="number" value="{{ $products->qty }}" name="product_qty" id="product_qty" 
                                class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                                required>
                            @if ($errors->has('product_qty'))
                                <span class="text-xs text-red-500">{{ $errors->first('product_qty') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="product_price" class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                            <input type="number" value="{{ $products->price }}" name="product_price" id="product_price" 
                                class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                                required>
                            @if ($errors->has('product_price'))
                                <span class="text-xs text-red-500">{{ $errors->first('product_price') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="product_category" class="block mb-1 text-sm font-medium text-gray-900">Kategori Produk</label>
                            <select name="product_category" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $products->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_category'))
                                <span class="text-xs text-red-500">{{ $errors->first('product_category') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="max-w-xs space-y-4">
                        <div class="overflow-hidden rounded-lg">
                            <label class="block text-sm mb-2 font-medium text-gray-900" for="product_image">Gambar Produk</label>
                            <img src="{{ asset('storage/products/' . $products->image) }}" alt="Gambar {{ $products->name }}">
                        </div>
                        <div>                    
                            <label class="block text-sm mb-2 font-medium text-gray-900" for="product_image">Upload Gambar Baru <span class="text-sm text-red-500">*Jika perlu</span></label>
                            <input type="file" name="product_image" id="product_image" class="block w-full text-sm text-gray-900 border border-gray-400 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="product_image_help">
                            <p class="mt-1 text-sm text-gray-500" id="product_image_help">PNG, JPG, JPEG</p>
                            @if ($errors->has('product_image'))
                                <span class="text-xs text-red-500">{{ $errors->first('product_image') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    Edit Produk
                </button>
            </form>
        </div>
    </div>
@endsection