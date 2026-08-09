<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        $count = $barangs->count();

        return view('dashboard', compact('barangs', 'count'));
    }
}
