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
                return '<div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Tambah Sesi</a>
                                <a class="dropdown-item" href="#">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" onclick="hapusMember(\'' . $member->id_members . '\')">Delete</a>
                            </div>
                        </div>';
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
        $invoice->tipe_invoice = 'Register Member';

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();

            if (in_array($extension, ['jpg', 'png']) && $size <= 500000) {
                $filename = Str::random(10) . '.' . $extension;
                $file->move(public_path('invoice'), $filename);
                $invoice->bukti_pembayaran = $filename;
            } else {
                return redirect()->back()->with('error', 'File must be a JPG or PNG and under 500KB.');
            }
        }
        $invoice->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data member dan invoice');
    }
}
