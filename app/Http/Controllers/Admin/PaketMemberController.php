<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use Yajra\DataTables\DataTables;

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

            Paket::create([
                'nama_paket' => $request->get('nama_paket'),
                'durasi' => $request->get('durasi'),
                'harga' => $harga,
                'status' => $request->get('status'),
            ]);

            return redirect()->back()->with('success', 'Paket member berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $paket = Paket::find($request->id);
        return response()->json($paket);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:pakets,id_pakets',
            'nama_paket' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'harga' => 'required|string',
            'status' => 'required|string',
        ]);

        try {
            $paket = Paket::find($request->id);
            $paket->update([
                'nama_paket' => $request->get('nama_paket'),
                'durasi' => $request->get('durasi'),
                'harga' => str_replace(['Rp ', '.'], '', $request->harga),
                'status' => $request->get('status'),
            ]);

            return redirect()->back()->with('success', 'Paket member berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $paket = Paket::findOrFail($id);
            $paket->delete();

            return response()->json(['success' => true, 'message' => 'Paket member berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function getData(Request $request)
    {
        $query = Paket::query();

        return DataTables::of($query)
            ->addColumn('harga', function ($paket) {
                return 'Rp ' . number_format($paket->harga, 0, ',', '.');
            })
            ->addColumn('aksi', function ($paket) {
                return '<button class="btn btn-warning btn-sm" data-id="' . $paket->id_pakets . '" onclick="editPaket(this)">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="hapusPaket(\'' . $paket->id_pakets . '\')">Hapus</button>' .
                    '<form id="hapusPaket_' . $paket->id_pakets . '" action="' . route('paket.destroy', $paket->id_pakets) . '" method="POST" style="display: none;">
                        @csrf
                        @method("DELETE")
                    </form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
