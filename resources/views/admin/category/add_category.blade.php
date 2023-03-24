@extends('templates.master')

@section('content')
    <div class="container px-16 py-16">
        <a href="{{ route('category.view') }}" class="text-white font-medium bg-yellow-500 py-2 px-5 rounded-lg hover:opacity-80 duration-300"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <div class="text-2xl mt-5">Form Tambah Kategori</div>

        <div class="max-w-xl">
            <form class="space-y-6" action="{{ route('category.add') }}" method="POST">
                @csrf
                <div>
                    <label for="category_name" class="block mb-3 text-sm font-medium text-gray-900">Nama Kategori</label>
                    <input type="text" name="category_name" id="category_name" 
                        class="bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-md block w-full p-2.5" 
                        required>
                    @if ($errors->has('name'))
                        <span class="text-xs text-red-500">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                
                <button type="submit" class="w-full text-white font-medium rounded-lg text-sm px-5 py-3 text-center bg-blue-500 hover:opacity-80">
                    Tambah Kategori
                </button>
            </form>
        </div>
    </div>    
@endsection