<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RakBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    public function index()
    {
        $barang = RakBarang::all();
        return view('admin.barang', compact('barang'));
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


    public function edit($id)
    {
        $barang = RakBarang::findOrFail($id);
        return view('admin.edit_barang', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
        ]);

        $barang = RakBarang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = RakBarang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
