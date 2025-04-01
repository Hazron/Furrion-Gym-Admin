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
use Illuminate\Support\Facades\Log;


class MemberController extends Controller
{
    public function index()
    {
        $member = Members::all();
        $paket = Paket::where('status', 'aktif')->get();
        return view('admin.member', compact('paket', 'member'));
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
            ' . ($member->status != 'aktif' ?
                    '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#tambahSesiModal" data-id="' . $member->id_members . '" onclick="setMemberId(' . $member->id_members . ')">Tambah Sesi</a>' :
                    '<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Tambah Sesi(Untuk nonaktif member)</a>') . '

            <div class="dropdown-divider"></div> 
            <a class="dropdown-item text-danger" href="#" onclick="hapusMember(\'' . $member->id_members . '\')">Delete</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tambahDurasiModal" data-id="' . $member->id_members . '">Tambah Durasi</a>' . '

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
            'tanggal_mulai' => 'required',
        ]);

        $members = new Members();
        $members->nama = $request->nama;
        $members->jenis_kelamin = $request->jenis_kelamin;
        $members->paket_id = $request->paket_member;
        $members->tanggal_daftar = $request->tanggal_mulai;
        $members->status = 'aktif';
        $members->no_telpon = $request->no_telpon;

        $paket = Paket::find($request->paket_member);

        $tanggal_selesai = Carbon::parse($request->tanggal_mulai)->addMonths($paket->durasi);
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
        } else {
            $invoice->bukti_pembayaran = null;
        }
        $invoice->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan data member dan invoice');
    }

    public function updateSesiMember(Request $request)
    {
        $request->validate([
            'id_members' => 'required|exists:members,id_members',
            'paket_id' => 'required|exists:pakets,id_pakets',
            'bukti_pembayaran' => 'nullable|mimes:jpg,png|max:500',
        ]);

        try {
            $member = Members::findOrFail($request->id_members);
            $paket = Paket::findOrFail($request->paket_id);
            $member->tanggal_selesai = Carbon::now()->addMonths($paket->durasi);
            $member->paket_id = $request->paket_id;
            $member->status = 'aktif';
            $member->save();

            $invoice = new Invoice();
            $invoice->tanggal = Carbon::now();
            $invoice->members_id = $member->id_members;
            $invoice->nominal = $paket->harga;
            $invoice->tipe_invoice = 'Update Member';

            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('invoice'), $filename);
                $invoice->bukti_pembayaran = $filename;
            }

            $invoice->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Sesi member berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function tambahDurasi(Request $request)
    {
        $request->validate([
            'id_members' => 'required|exists:members,id_members',
            'paket_id' => 'required|exists:pakets,id_pakets',
        ]);

        try {
            $member = Members::findOrFail($request->id_members);
            $paket = Paket::findOrFail($request->paket_id);
            $member->tanggal_selesai = $member->tanggal_selesai->addMonths($paket->durasi);
            $member->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Durasi member berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $member = Members::findOrFail($id);
            $member->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Member berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function autoDisableMember()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $members = Members::where('tanggal_selesai', $currentDate)->where('status', 'aktif')->get();

        foreach ($members as $member) {
            $member->status = 'tidak aktif';
            $member->save();
        }
    }

    public function deleteMember($id)
    {
        $member = Members::findOrFail($id);

        $member->delete();

        return response()->json(['status' => 'success', 'message' => 'Member berhasil dihapus.']);
    }
}
