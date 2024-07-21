<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Paket;
use App\Models\Invoice;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        $paket = Paket::where('status', 'aktif')->get();
        return view('admin.member', compact('paket'));
    }

    public function getData()
    {
        $query = Members::query();

        return DataTables::of($query)
            ->addColumn('tanggal_daftar', function ($member) {
                return $member->tanggal_daftar;
            })
            ->addColumn('nama_paket', function ($members) {
                return Paket::find($members->paket_id)->nama_paket;
            })
            ->addColumn('status', function ($member) {
                if ($member->status == 'aktif') {
                    return '<span class="badge badge-success">Aktif</span>';
                } else {
                    return '<span class="badge badge-danger">Tidak Aktif</span>';
                }
            })
            ->addColumn('nomor_telepon', function ($member) {
                return $member->no_telpon;
            })
            ->addColumn('action', function ($member) {
                return '<button class="btn btn-warning btn-sm" data-id="' . $member->id_members . '" onclick="editMember(this)">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="hapusMember(\'' . $member->id_members . '\')">Hapus</button>';
                // '<form id="hapusMember_' . $member->id_members . '" action="' . route('members.destroy', $member->id_members) . '" method="POST" style="display: none;">
                //     @csrf
                //     @method("DELETE")
                // </form>'
            })
            ->rawColumns(['status', 'action', 'nama_paket'])
            ->make(true);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'paket_member' => 'required',
        ]);

        $members = new Members();
        $members->nama = $request->nama;
        $members->jenis_kelamin = $request->jenis_kelamin;
        $members->paket_id = $request->paket_member;
        $members->tanggal_daftar = Carbon::now();
        $members->status = 'aktif';
        $members->no_telpon = $request->no_telpon;

        $paket = Paket::find($request->paket_member);

        $tanggal_selesai = Carbon::now()->addMonths($paket->durasi);
        $members->tanggal_selesai = $tanggal_selesai;

        $members->save();

        $invoice = new Invoice();
        $invoice->tanggal = Carbon::now();
        $invoice->members_id = $members->id_members;
        $invoice->nominal = $paket->harga;
        $invoice->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data member dan invoice');
    }
}
