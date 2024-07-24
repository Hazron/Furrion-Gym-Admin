<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RakBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $barang = RakBarang::all();
        return view('admin.barang', compact('barang'));
    }

    public function getData()
    {
        $barang = RakBarang::select(['id_barang', 'nama_barang', 'qty', 'harga']);

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                return '
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-success">Terjual</a>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                ';
            })
            ->editColumn('harga', function ($item) {
                return 'Rp. ' . number_format($item->harga, 2, ',', '.');
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'harga_numeric' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
        ]);

        try {
            RakBarang::create([
                'nama_barang' => $request->nama_barang,
                'qty' => $request->qty,
                'harga' => $request->harga_numeric, // Menggunakan hidden input yang menyimpan nilai numerik
            ]);

            Log::info('Berhasil menambah barang');
            return redirect()->route('admin.barang')->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah barang: ' . $e->getMessage());
            return redirect()->route('admin.barang')->with('error', 'Gagal menambah barang');
        }
    }
}
