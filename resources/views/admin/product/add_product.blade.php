@extends('templates.master')

@section('content')
    <div class="container px-16 py-16">
        <a href="{{ route('product.view') }}" class="text-white font-medium bg-yellow-500 py-2 px-5 rounded-lg hover:opacity-80 duration-300"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="text-2xl mt-5">Form Tambah Produk</div>

        <div class="max-w-xl">
            <form class="space-y-4" action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="product_name" class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="product_name" id="product_name" 
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
                    required></textarea>
                    @if ($errors->has('product_description'))
                    <span class="text-xs text-red-500">{{ $errors->first('product_description') }}</span>
                    @endif
                </div>
                <div>
                    <label for="product_qty" class="block mb-1 text-sm font-medium text-gray-900">Stok</label>
                    <input type="number" name="product_qty" id="product_qty" 
                        class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                        required>
                    @if ($errors->has('product_qty'))
                        <span class="text-xs text-red-500">{{ $errors->first('product_qty') }}</span>
                    @endif
                </div>
                <div>
                    <label for="product_price" class="block mb-1 text-sm font-medium text-gray-900">Harga</label>
                    <input type="number" name="product_price" id="product_price" 
                        class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                        required>
                    @if ($errors->has('product_price'))
                        <span class="text-xs text-red-500">{{ $errors->first('product_price') }}</span>
                    @endif
                </div>
                <div>
                    <label for="product_category" class="block mb-1 text-sm font-medium text-gray-900">Kategori Produk</label>
                    <select name="product_category" class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih kategori produk</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->id }} - {{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('product_category'))
                        <span class="text-xs text-red-500">{{ $errors->first('product_category') }}</span>
                    @endif
                </div>
                <div>                    
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="product_image">Upload Gambar</label>
                    <input type="file" name="product_image" id="product_image" class="block w-full text-sm text-gray-900 border border-gray-400 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="product_image_help" required>
                    <p class="mt-1 text-sm text-gray-500" id="product_image_help">PNG, JPG, JPEG</p>
                    @if ($errors->has('product_image'))
                        <span class="text-xs text-red-500">{{ $errors->first('product_image') }}</span>
                    @endif
                </div>
                
                <button type="submit" class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    Tambah Produk
                </button>
            </form>
        </div>
    </div>    
@endsection