<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use Illuminate\Support\Facades\Log;

class PaketMemberController extends Controller
{
    public function index()
    {
        return view('admin.paket');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'harga' => 'required|string',
            'status' => 'required|string',
        ]);

        try {
            $harga = str_replace(['Rp ', '.'], '', $request->harga);

            $paket = new Paket([
                'nama_paket' => $request->get('nama_paket'),
                'durasi' => $request->get('durasi'),
                'harga' => $harga,
                'status' => $request->get('status'),
            ]);

            $paket->save();

            return redirect()->back()->with('success', 'Paket member berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
}
