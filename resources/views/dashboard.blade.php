@extends('layouts.app')

@section('title', 'Dashboard - GudangKu')

@section('content')

@php
    $items = collect($barangs ?? []);

    $totalStock = $items->sum('stock');

    $totalKategori = $items
        ->pluck('kategori')
        ->filter()
        ->unique()
        ->count();

    $lowStock = $items
        ->filter(fn($item) => (int) $item->stock <= 5)
        ->count();

    $categoryData = $items
        ->groupBy('kategori')
        ->map(fn($rows) => $rows->count());

    $recentItems = $items
        ->sortByDesc('id_barang')
        ->take(5);
@endphp


<div class="px-4 sm:px-6 lg:px-8 py-6 sm:py-8 max-w-[1500px] mx-auto">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-7">

        <div class="text-left">

            <p class="text-xs font-medium uppercase tracking-[.16em] text-brand">
                Overview
            </p>

            <h1 class="text-2xl sm:text-3xl font-semibold text-[#292929] mt-1">
                Dashboard
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Pantau kondisi persediaan anda dengan cepat.
            </p>

        </div>


        <a
            href="{{ route('barang.index') }}"
            class="inline-flex items-center justify-center gap-2
            bg-brand hover:bg-brand-dark
            text-white text-sm font-medium
            px-4 py-2.5 rounded-xl
            shadow-sm transition"
        >

            <i class="bx bx-package text-lg"></i>

            Kelola Barang

        </a>

    </div>


    {{-- ================= STATISTICS ================= --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4 mb-6">


        {{-- TOTAL BARANG --}}
        <div class="dashboard-card bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 text-left">

            <div class="flex items-start justify-between gap-3">

                <div>

                    <p class="text-xs text-gray-500">
                        Total Barang
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-semibold mt-2">
                        {{ $count ?? $items->count() }}
                    </h2>

                </div>


                <div class="w-10 h-10 rounded-xl bg-orange-50 text-brand flex items-center justify-center">

                    <i class="bx bx-package text-xl"></i>

                </div>

            </div>


            <p class="text-[11px] text-gray-400 mt-4">
                Item terdaftar
            </p>

        </div>


        {{-- TOTAL STOK --}}
        <div class="dashboard-card bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 text-left">

            <div class="flex items-start justify-between gap-3">

                <div>

                    <p class="text-xs text-gray-500">
                        Total Stok
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-semibold mt-2">
                        {{ $totalStock }}
                    </h2>

                </div>


                <div class="w-10 h-10 rounded-xl bg-gray-100 text-sidebar flex items-center justify-center">

                    <i class="bx bx-layer text-xl"></i>

                </div>

            </div>


            <p class="text-[11px] text-gray-400 mt-4">
                Jumlah seluruh unit
            </p>

        </div>


        {{-- TOTAL KATEGORI --}}
        <div class="dashboard-card bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 text-left">

            <div class="flex items-start justify-between gap-3">

                <div>

                    <p class="text-xs text-gray-500">
                        Kategori
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-semibold mt-2">
                        {{ $totalKategori }}
                    </h2>

                </div>


                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                    <i class="bx bx-category text-xl"></i>

                </div>

            </div>


            <p class="text-[11px] text-gray-400 mt-4">
                Kategori terdaftar
            </p>

        </div>


        {{-- STOK MENIPIS --}}
        <div class="dashboard-card bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 text-left">

            <div class="flex items-start justify-between gap-3">

                <div>

                    <p class="text-xs text-gray-500">
                        Stok Menipis
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-semibold mt-2">
                        {{ $lowStock }}
                    </h2>

                </div>


                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">

                    <i class="bx bx-error-circle text-xl"></i>

                </div>

            </div>


            <p class="text-[11px] text-gray-400 mt-4">
                Stok ≤ 5 unit
            </p>

        </div>

    </div>



    {{-- ================= CHART + STOCK ================= --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">


        {{-- ================= CATEGORY CHART ================= --}}
        <section class="xl:col-span-2 bg-white border border-gray-200 rounded-2xl p-4 sm:p-6 text-left">

            <div class="flex items-start justify-between gap-4 mb-5">

                <div>

                    <h2 class="font-semibold text-base sm:text-lg">
                        Distribusi Kategori
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Komposisi barang berdasarkan kategori.
                    </p>

                </div>


                <span class="text-xs text-gray-400">
                    {{ $items->count() }} item
                </span>

            </div>


            @if($categoryData->count())

                <div class="relative h-[260px] sm:h-[300px]">

                    <canvas id="categoryChart"></canvas>

                </div>

            @else

                <div class="h-[260px] flex flex-col items-center justify-center text-center text-gray-400">

                    <i class="bx bx-bar-chart-alt-2 text-5xl mb-3"></i>

                    <p class="text-sm">
                        Belum ada data barang untuk ditampilkan.
                    </p>

                    <a
                        href="{{ route('barang.index') }}"
                        class="text-brand text-sm font-medium mt-2 hover:underline"
                    >
                        Tambah barang
                    </a>

                </div>

            @endif

        </section>



        {{-- ================= STOCK SUMMARY ================= --}}
        <section class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-6 text-left">

            <h2 class="font-semibold text-base sm:text-lg">
                Ringkasan Stok
            </h2>

            <p class="text-xs text-gray-500 mt-1 mb-5">
                Barang yang perlu diperhatikan.
            </p>


            @if($items->count())

                <div class="space-y-3">

                    @foreach($items->sortBy('stock')->take(5) as $item)

                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">

                            <div
                                class="w-9 h-9 shrink-0 rounded-lg
                                flex items-center justify-center
                                {{ (int)$item->stock <= 5
                                    ? 'bg-red-50 text-red-500'
                                    : 'bg-orange-50 text-brand' }}"
                            >

                                <i class="bx bx-package"></i>

                            </div>


                            <div class="min-w-0 flex-1">

                                <p class="text-sm font-medium truncate">
                                    {{ $item->nama_barang }}
                                </p>

                                <p class="text-[11px] text-gray-400 truncate">
                                    {{ $item->kategori }}
                                </p>

                            </div>


                            <span
                                class="text-xs font-semibold
                                {{ (int)$item->stock <= 5
                                    ? 'text-red-500'
                                    : 'text-gray-600' }}"
                            >
                                {{ $item->stock }} unit
                            </span>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="text-sm text-gray-400 py-10 text-center">
                    Belum ada data.
                </div>

            @endif


            <a
                href="{{ route('barang.index') }}"
                class="mt-5 w-full flex items-center justify-center gap-2
                border border-gray-200
                hover:border-brand hover:text-brand
                text-gray-600
                rounded-xl py-2.5
                text-sm font-medium transition"
            >

                Lihat semua barang

                <i class="bx bx-right-arrow-alt"></i>

            </a>

        </section>

    </div>



    {{-- ================= RECENT ITEMS ================= --}}
    <section class="bg-white border border-gray-200 rounded-2xl mt-4 overflow-hidden text-left">


        <div class="p-4 sm:p-6 flex items-center justify-between gap-4">

            <div>

                <h2 class="font-semibold text-base sm:text-lg">
                    Barang Terbaru
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Data barang yang terakhir ditambahkan.
                </p>

            </div>


            <a
                href="{{ route('barang.index') }}"
                class="text-xs sm:text-sm text-brand font-medium hover:underline"
            >
                Lihat semua
            </a>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-[650px] text-sm">

                <thead>

                    <tr class="border-y border-gray-100 bg-gray-50/80 text-gray-500">

                        <th class="text-left font-medium px-5 py-3">
                            Barang
                        </th>

                        <th class="text-left font-medium px-5 py-3">
                            Kategori
                        </th>

                        <th class="text-left font-medium px-5 py-3">
                            Stok
                        </th>

                        <th class="text-left font-medium px-5 py-3">
                            Kode
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($recentItems as $item)

                        <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">

                            <td class="px-5 py-3.5 font-medium">
                                {{ $item->nama_barang }}
                            </td>

                            <td class="px-5 py-3.5 text-gray-500">
                                {{ $item->kategori }}
                            </td>

                            <td class="px-5 py-3.5">

                                <span
                                    class="inline-flex items-center
                                    px-2.5 py-1 rounded-lg
                                    text-xs font-medium
                                    {{ (int)$item->stock <= 5
                                        ? 'bg-red-50 text-red-600'
                                        : 'bg-green-50 text-green-600' }}"
                                >
                                    {{ $item->stock }} unit
                                </span>

                            </td>

                            <td class="px-5 py-3.5 text-gray-500">
                                #{{ $item->id_barang }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-5 py-12 text-center text-gray-400"
                            >
                                Belum ada data barang.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</div>



{{-- ================= CHART JS ================= --}}

@if($categoryData->count())

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const canvas = document.getElementById('categoryChart');

            if (!canvas) {
                return;
            }

            const ctx = canvas.getContext('2d');

            const labels = @json($categoryData->keys()->values());

            const values = @json($categoryData->values()->values());


            new Chart(ctx, {

                type: 'doughnut',

                data: {

                    labels: labels,

                    datasets: [{
                        data: values,

                        backgroundColor: [
                            '#ff842c',
                            '#555555',
                            '#ffb37a',
                            '#333333',
                            '#ffc9a3',
                            '#888888'
                        ],

                        borderColor: '#ffffff',

                        borderWidth: 3,

                        hoverOffset: 8
                    }]

                },


                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '62%',


                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                padding: 18,

                                usePointStyle: true,

                                pointStyle: 'circle',

                                font: {
                                    family: 'Poppins',
                                    size: 12
                                }

                            }

                        },


                        tooltip: {

                            callbacks: {

                                label: function (context) {

                                    const label = context.label || '';

                                    const value = context.parsed || 0;

                                    return ` ${label}: ${value} barang`;

                                }

                            }

                        }

                    }

                }

            });

        });
    </script>

@endif

@endsection
