@extends('templates.master')

@section('content')
    <div class="container py-16 px-16">
        {{-- modal --}}
        <div id="deleteModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-red-500 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <form action="{{ route('category.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="delete_id" id="delete_id">
                            <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin menghapus kategori ini?</h3>
                            <button data-modal-toggle="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                            <button type="submit" data-modal-toggle="deleteModal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center ml-2">
                                Yakin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('product') }}" class="text-white font-medium bg-yellow-500 py-2 px-5 rounded-lg hover:opacity-80 duration-300"><i class="fa-solid fa-arrow-left"></i> Back</a>

        <div class="w-full mt-8">
            <a href="{{ route('category.form') }}" class="text-white font-medium bg-blue-500 py-3 px-6 rounded-lg hover:opacity-80 duration-300">+ Tambah Kategori</a>
        </div>

        {{-- alert --}}
        @if ($message = Session::get('success'))
            <div class="mt-8">
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

        <div class="text-2xl font-bold mt-5">List Kategori Produk</div>
        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-violet-800 uppercase bg-violet-300">
                    <tr class="divide-x">
                        <th scope="col" class="text-center px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dibuat pada
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Diupdate pada
                        </th>
                        <th scope="col" class="w-32 text-center px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->count() < 1)
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-center text-lg font-semibold">Belum ada kategori</td>
                        </tr>
                    @else
                        @foreach ($categories as $item)
                            <tr class="divide-x bg-white border-b hover:bg-gray-100">
                                <td class="text-center px-6 py-4">
                                    {{ $item->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->created_at->format('d M Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->updated_at->format('d M Y H:i:s') }}
                                </td>
                                <td class="w-32 px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ url('admin/category/' . $item->id . '/edit') }}" class="py-2 px-3 rounded-md text-white bg-yellow-500 hover:bg-yellow-600" data-tooltip-target="tooltip-edit" data-tooltip-style="light">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <button data-modal-toggle="deleteModal" type="button"
                                            value="{{ $item->id }}"
                                            class="deleteBtn py-2 px-3 rounded-md text-white bg-red-500 hover:bg-red-600"
                                            data-tooltip-target="tooltip-delete" data-tooltip-style="light">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        {{-- tooltip action button --}}
        <div id="tooltip-edit" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
            Edit Kategori
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <div id="tooltip-delete" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
            Hapus Kategori
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        {{-- pagination --}}
        <div class="mt-8">
            {!! $categories->links() !!}
        </div>
    <div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function (e) {
                e.preventDefault();

                var d_id = $(this).val();
                $('#delete_id').val(d_id);

                $('#deleteModal').modal('show');
            });
        })
    </script>
@endsection