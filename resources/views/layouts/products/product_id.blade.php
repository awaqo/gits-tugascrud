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
                <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Produk</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                </div>
            </li>
            </ol>
        </nav>
  
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $products->id }}" name="product_id" id="product_id">
            <div class="w-full mt-6 flex gap-10">
                <div class="w-1/3">
                    <img class="rounded-xl" src="{{ asset('storage/products/'.$products->image) }}" alt="">
                </div>
                <div class="w-2/5 flex flex-col py-8 pr-6 divide-y">
                    <div>
                        <div class="text-xl font-bold text-gray-900">{{ $products->name }}</div>
                        <div class="text-3xl font-bold text-gray-900 mt-5 mb-5">Rp {{ number_format($products->price) }}</div>
                    </div>
                    <div class="pt-5 px-4">
                        <div class="font-bold text-lg text-blue-300">Kategori Produk</div>
                        <div class="mt-3 mb-5 font-semibold">{{ $products->category->name }}</div>
                    </div>
                    <div class="pt-5 px-4">
                        <div class="font-bold text-lg text-blue-300">Deskripsi Produk</div>
                        <div class="mt-3">{{ $products->desc }}</div>
                    </div>
                </div>
                <div class="w-1/4 py-8">
                    <div class="text-md font-bold mb-3">Pilih jumlah</div>
                    <div class="sp-quantity flex justify-between h-14 divide-x p-1 border border-gray-300 rounded-md">
                        <div class="w-full">
                            <a href="javascript:void(0)" data-multi="-1" class="ddd w-full h-full cursor-pointer flex justify-center items-center text-xl font-bold rounded-md hover:bg-blue-100 hover:text-blue-600 duration-300">-</a>
                        </div>
    
                        <div class="sp-input h-full text-2xl flex justify-center items-center">
                            <input type="text" class="border-0 text-center quantity-input" value="1" min="1" name="product_qty" >
                        </div>
    
                        <div class="w-full">
                            <a href="javascript:void(0)" data-multi="1" class="ddd w-full h-full cursor-pointer flex justify-center items-center text-xl font-bold rounded-md hover:bg-blue-100 hover:text-blue-600 duration-300">+</a>
                        </div>
                        <div class="hidden product-price">{{ $products->price }}</div>
                        <input type="hidden" value="{{ $products->price }}" name="product_price">
                    </div>
                    <div class="mt-3 text-md">Stok tersedia : <span>{{ $products->qty }}</span></div>
    
                    <div class="mt-4">
                        <div class="text-sm">Subtotal</div>
                        <div class="text-md font-bold flex gap-1">Rp <div id="total">{{ $products->price }}</div></div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="w-full text-center text-white font-semibold bg-sky-500 py-3 px-4 rounded-md hover:opacity-80 duration-300">
                            <i class="fa-solid fa-cart-shopping"></i> Masukkan ke keranjang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('a.ddd').click(function() {
            var $productContainer = $(this).closest('div.sp-quantity');
            var productPrice = parseInt($productContainer.find('div.product-price').text());
            var $quantityInput = $productContainer.find('input.quantity-input');
            var newQuantity = parseInt($quantityInput.val()) + parseInt($(this).data('multi'));

            if (newQuantity > 0) {
                // Refresh quantity input.
                $quantityInput.val(newQuantity);
                // Refresh total div.
                var currentChange = productPrice*parseInt($(this).data('multi'));
                var total = parseInt($('div#total').text());
                total += currentChange;
                $('div#total').text(total);
            }

        });
    </script>
@endsection