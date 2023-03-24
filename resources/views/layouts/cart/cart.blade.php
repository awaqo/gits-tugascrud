@extends('templates.master')

@section('content')
    <div class="container px-16 py-10">
        <!-- Breadcrumb -->
        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('product') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-400 duration-300">
                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Cart</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-3 w-full bg-gray-50 border border-gray-200 px-6 py-10">

            {{-- alert --}}
            @if ($message = Session::get('success'))
                <div class="my-6">
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

            <div class="relative overflow-x-auto shadow-lg">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-900 uppercase bg-gray-300">
                        <tr>
                            <th colspan="2" scope="col" class="w-1/3 px-6 py-3">
                                Produk
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Harga Satuan
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Kuantitas
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                Total Harga
                            </th>
                            <th scope="col" class="w-32 text-center px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($carts->count() < 1)
                            <tr>
                                <td colspan="6" class="py-4 px-6 text-center text-md font-semibold">Belum ada barang</td>
                            </tr>
                        @else
                            @foreach ($carts as $item)
                                <tr class="bg-white border-b hover:bg-gray-100">
                                    <td class="w-52 px-3 py-4">
                                        <img class="w-20 h-20" src="{{ asset('storage/products/'.$item->product->image) }}" alt="">
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        {{ $item->product->price }}
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        {{ $item->total }}
                                    </td>
                                    <td class="w-32 px-6 py-4">
                                        <div class="text-center">
                                            <a href="{{ url('cart/delete/'.$item->id) }}" class="hover:text-red-500">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection