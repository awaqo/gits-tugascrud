@extends('templates.master')

@section('content')
    <div class="container py-10 px-16">
        <div class="mb-5 flex justify-between">
            <div>
                <a href="{{ route('product.view') }}" class="font-bold text-white bg-emerald-500 py-3 px-6 rounded-lg hover:opacity-80 duration-300">CRUD Produk</a>
                <a href="{{ route('category.view') }}" class="font-bold text-white bg-amber-500 py-3 px-6 rounded-lg hover:opacity-80 duration-300">CRUD Kategori</a>
            </div>
            <div>
                <a href="{{ route('cart') }}" class="block text-center text-xl text-sky-500 font-semibold py-3 px-4 rounded-xl hover:bg-sky-50 duration-300">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>

        {{-- alert --}}
        @if ($message = Session::get('success'))
            <div class="mb-5">
                <div id="alert-success" class="flex p-4 mb-4 mx-3 bg-green-100 border border-green-400 rounded-lg" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-base text-green-700">
                        {{ $message }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </div>
        @endif

        <h1 class="text-3xl font-bold">Produk Pilihan</h1>
        @if ($products->count() < 1)
            <div class="text-lg mt-4">Belum ada produk</div>            
        @else
            <div class="flex flex-row flex-wrap gap-4 mt-6">
                @foreach ($products as $item)
                    <div class="max-w-[240px] shadow-lg rounded-md overflow-hidden relative">
                        <div>
                            <img class="h-64 w-full" src="{{ asset('storage/products/' .$item->image) }}" alt="">
                        </div>
                        <div class="p-3 mb-14">
                            <a href="{{ url('product/detail/'.$item->id) }}" class="text-base text-gray-500 line-clamp-2 hover:text-gray-900 cursor-pointer">{{ $item->name }}</a>
                            <div class="text-lg font-bold">Rp {{ number_format($item->price) }}</div>
                            <div class="text-sm text-slate-500">Stok : <span class="font-medium">{{ $item->qty }}</span></div>
                        </div>
                        <div class="absolute bottom-3 right-3">
                            <div class="flex gap-1">
                                <a href="{{ url('product/detail/'.$item->id) }}" class="flex justify-center items-center text-xs text-white font-semibold bg-sky-500 py-2 px-4 rounded-xl hover:bg-sky-600 duration-300">
                                    Lihat Detail
                                </a>
                                <a href="#" class="block text-center text-sky-500 font-semibold bg-sky-100 py-2 px-4 rounded-xl hover:bg-sky-200 duration-300">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        {{-- pagination --}}
        <div class="mt-8">
            {!! $products->links() !!}
        </div>
    </div>
@endsection