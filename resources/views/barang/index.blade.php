@extends('layouts.app')

@section('title', 'Barang - GudangKu')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-6 sm:py-8 max-w-[1500px] mx-auto">

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                confirmButtonColor: '#ff842c'
            });
        });
    </script>
    @endif

    @php
        $items = collect($barangs ?? []);
        $totalStock = $items->sum('stock');
        $lowStock = $items->filter(fn($item) => (int) $item->stock <= 5)->count();
    @endphp

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6">
        <div class="text-left">
            <p class="text-xs font-medium uppercase tracking-[.16em] text-brand">Inventory</p>
            <h1 class="text-2xl sm:text-3xl font-semibold mt-1">Data Barang</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola seluruh persediaan barang anda.</p>
        </div>

        <button onclick="openPopup()"
            class="w-full lg:w-auto inline-flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white px-4 py-2.5 rounded-xl shadow-sm text-sm font-medium transition">
            <i class="bx bx-plus text-xl"></i>
            Tambah Barang
        </button>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-5">
        <div class="bg-white border border-gray-200 rounded-xl p-4 text-left">
            <p class="text-xs text-gray-500">Total Item</p>
            <p class="text-xl font-semibold mt-1">{{ $items->count() }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4 text-left">
            <p class="text-xs text-gray-500">Total Unit</p>
            <p class="text-xl font-semibold mt-1">{{ $totalStock }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4 text-left col-span-2 sm:col-span-1">
            <p class="text-xs text-gray-500">Stok Menipis</p>
            <p class="text-xl font-semibold mt-1 {{ $lowStock ? 'text-red-500' : 'text-green-600' }}">{{ $lowStock }}</p>
        </div>
    </div>

    {{-- Search / table --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="p-4 sm:p-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div class="text-left">
                <h2 class="font-semibold">Daftar Barang</h2>
                <p class="text-xs text-gray-400 mt-1">Cari berdasarkan nama atau kode barang.</p>
            </div>

            <form action="{{ route('barang.index') }}" method="GET"
                  class="w-full md:w-auto flex flex-col sm:flex-row gap-2">
                <div class="relative flex-1 md:w-64">
                    <i class="bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="keyword" autocomplete="off"
                        placeholder="Cari barang..."
                        value="{{ request('keyword') }}"
                        class="w-full h-10 border border-gray-200 rounded-xl pl-9 pr-3 text-sm outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 sm:flex-none h-10 px-4 rounded-xl bg-brand hover:bg-brand-dark text-white text-sm font-medium transition">
                        Cari
                    </button>
                    <a href="{{ route('barang.index') }}" class="flex-1 sm:flex-none h-10 px-4 rounded-xl border border-gray-200 hover:bg-gray-50 text-gray-600 text-sm font-medium flex items-center justify-center transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto scrollbar-thin">
            <table class="w-full min-w-[760px] text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left font-medium text-gray-500 px-5 py-3.5">Barang</th>
                        <th class="text-left font-medium text-gray-500 px-5 py-3.5">Kategori</th>
                        <th class="text-left font-medium text-gray-500 px-5 py-3.5">Stok</th>
                        <th class="text-left font-medium text-gray-500 px-5 py-3.5">Kode Barang</th>
                        <th class="text-right font-medium text-gray-500 px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($barangs ?? [] as $item)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-[#fffaf7] transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 shrink-0 rounded-lg bg-orange-50 text-brand flex items-center justify-center">
                                    <i class="bx bx-package text-lg"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-medium truncate max-w-[240px]">{{ $item->nama_barang }}</p>
                                    <p class="text-[11px] text-gray-400">ID #{{ $item->id_barang }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-gray-100 text-gray-600 text-xs font-medium">
                                {{ $item->kategori }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold
                                {{ (int)$item->stock <= 5 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ (int)$item->stock <= 5 ? 'bg-red-500' : 'bg-green-500' }}"></span>
                                {{ $item->stock }} unit
                            </span>
                        </td>

                        <td class="px-5 py-4 text-gray-500 font-mono text-xs">
                            #{{ $item->id_barang }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                    data-id="{{ $item->id_barang }}"
                                    data-nama="{{ $item->nama_barang }}"
                                    data-kategori="{{ $item->kategori }}"
                                    data-stock="{{ $item->stock }}"
                                    onclick="openPopup2(this)"
                                    class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center transition"
                                    title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                <form action="{{ route('barang.destroy') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="hapus" value="{{ $item->id_barang }}">
                                    <button type="submit" onclick="return hapusBarang(event, this)"
                                        class="w-9 h-9 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition"
                                        title="Hapus">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center text-gray-400">
                                <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mb-3">
                                    <i class="bx bx-package text-3xl"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-500">Belum ada data barang</p>
                                <p class="text-xs mt-1">Tambahkan barang pertama anda.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- POPUP TAMBAH --}}
<div id="popupBg" class="hidden fixed inset-0 bg-black/60 z-[1200] items-center justify-center p-4 backdrop-blur-[2px]">
    <div id="tambahBox" class="relative bg-white rounded-2xl shadow-2xl w-full max-w-[500px] max-h-[90vh] overflow-y-auto p-6 sm:p-8 opacity-0 scale-90 transition-all duration-300">
        <button onclick="closePopup()" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-lg bg-gray-100 hover:bg-red-50 hover:text-red-500 text-gray-500 flex items-center justify-center transition">
            <i class="bx bx-x text-xl"></i>
        </button>

        <div class="text-left mb-7">
            <p class="text-xs uppercase tracking-[.16em] text-brand font-medium">Inventory</p>
            <h2 class="text-2xl font-semibold mt-1">Tambah Barang</h2>
            <p class="text-sm text-gray-500 mt-1">Masukkan informasi barang baru.</p>
        </div>

        <form action="{{ route('barang.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Barang</label>
                <input type="text" name="barang" autocomplete="off" required
                    class="w-full h-11 border border-gray-200 rounded-xl px-3 outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition"
                    placeholder="Contoh: Keyboard">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Kategori</label>
                <input type="text" name="kategori" autocomplete="off" required
                    class="w-full h-11 border border-gray-200 rounded-xl px-3 outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition"
                    placeholder="Contoh: Elektronik">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Stock</label>
                <input type="number" name="stock" min="0" required
                    class="w-full h-11 border border-gray-200 rounded-xl px-3 outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition"
                    placeholder="0">
            </div>

            <button type="submit" class="w-full h-11 rounded-xl bg-brand hover:bg-brand-dark text-white font-medium transition">
                Simpan Barang
            </button>
        </form>
    </div>
</div>

{{-- POPUP EDIT --}}
<div id="popupBg2" class="hidden fixed inset-0 bg-black/60 z-[1200] items-center justify-center p-4 backdrop-blur-[2px]">
    <div id="editBox" class="relative bg-white rounded-2xl shadow-2xl w-full max-w-[500px] max-h-[90vh] overflow-y-auto p-6 sm:p-8 opacity-0 scale-90 transition-all duration-300">
        <button onclick="closePopup2()" type="button" class="absolute top-4 right-4 w-9 h-9 rounded-lg bg-gray-100 hover:bg-red-50 hover:text-red-500 text-gray-500 flex items-center justify-center transition">
            <i class="bx bx-x text-xl"></i>
        </button>

        <div class="text-left mb-7">
            <p class="text-xs uppercase tracking-[.16em] text-brand font-medium">Inventory</p>
            <h2 class="text-2xl font-semibold mt-1">Edit Barang</h2>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi barang.</p>
        </div>

        <form action="{{ route('barang.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="id" id="edit_id">

            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Barang</label>
                <input type="text" name="barang" id="edit_barang" required
                    class="w-full h-11 border border-gray-200 rounded-xl px-3 outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Kategori</label>
                <input type="text" name="kategori" id="edit_kategori" required
                    class="w-full h-11 border border-gray-200 rounded-xl px-3 outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Stock</label>
                <input type="number" name="stock" id="edit_stock" min="0" required
                    class="w-full h-11 border border-gray-200 rounded-xl px-3 outline-none focus:border-brand focus:ring-2 focus:ring-orange-100 transition">
            </div>

            <button type="submit" class="w-full h-11 rounded-xl bg-brand hover:bg-brand-dark text-white font-medium transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
