<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $barangs = Barang::when($keyword, function ($query) use ($keyword) {
            return $query->where('nama_barang', 'like', "%{$keyword}%")
                         ->orWhere('id_barang', 'like', "%{$keyword}%");
        })
        ->latest()
        ->get();

        return view('barang.index', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang' => 'required|string',
            'kategori' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        $lastBarang = Barang::orderBy('id_barang', 'desc')->first();
        $nextNumber = $lastBarang ? ((int) substr($lastBarang->id_barang, 4) + 1) : 1;
        $kodeBarang = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Barang::create([
            'id_barang' => $kodeBarang,
            'nama_barang' => $request->barang,
            'kategori' => $request->kategori,
            'stock' => $request->stock,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:barangs,id_barang',
            'barang' => 'required|string',
            'kategori' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        $barang = Barang::where('id_barang', $request->id)->firstOrFail();

        $barang->update([
            'nama_barang' => $request->barang,
            'kategori' => $request->kategori,
            'stock' => $request->stock,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        Barang::where('id_barang', $request->hapus)->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
