<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\PersonalTrainer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAmount = Invoice::sum('nominal');
        $totalAmount = $totalAmount ? $totalAmount : 0;
        $totalMembers = Members::where('status', 'aktif')->count();
        return view('admin.dashboard', compact('totalAmount', 'totalMembers'));
    }

    public function cekMember($nama)
    {
        $member = Members::where('nama', 'like', '%' . $nama . '%')->first();

        if ($member) {
            if ($member->status == 'aktif') {
                return response()->json(['message' => '<span style="color:green; font-weight:bold; font-size:25px">Member ' . $member->nama . ' aktif.<br> Masa Aktif Hingga ' . $member->tanggal_selesai . '</span>']);
            } else {
                return response()->json(['message' => ' <span style="color:red; font-weight:bold; font-size:24px">Member ' . $member->nama . ' tidak aktif. Harap Perpanjang Paket Member </span>']);
            }
        } else {
            return response()->json(['message' => '<span style="color:red; font-weight:bold; font-size:30px">Member tidak ditemukan</span>']);
        }
    }

    public function cekPT($nama)
    {
        $trainer = PersonalTrainer::where('nama', 'like', '%' . $nama . '%')->first();

        if ($trainer) {
            if ($trainer->status == 'Aktif') {
                return response()->json([
                    'message' => '<div class="text-center mt-3">
                    <span style="color:green; font-weight:bold; font-size:30px">Personal Trainer ' . $trainer->nama . ' aktif.</span>
                    <br>
                    <span style="color:blue; font-weight:bold; font-size:20px">Apakah ingin melakukan Check In? (Telah visit ' . $trainer->visit . ' x)</span>
                    <br>
                    <div class="text-center">
                        <a href="' . route('admin.trainer') . '" class="btn btn-primary btn-sm">Check In</a>
                    </div>
                </div>'
                ]);
            } else {
                return response()->json(['message' => '<span style="color:red; font-weight:bold; font-size:24px">Personal Trainer ' . $trainer->nama . ' tidak aktif. <br> Silakan Perpanjang Paket Personal Trainer</span>']);
            }
        } else {
            return response()->json(['message' => '<span style="color:red; font-weight:bold; font-size:30px">Personal Trainer tidak ditemukan</span>']);
        }
    }

    public function storePerVisit(Request $request)
    {
        $nama = $request->input('perVisit');

        if ($nama) {
            // Simpan data ke tabel invoices
            $invoice = new Invoice();
            $invoice->tanggal = Carbon::now()->format('Y-m-d');
            $invoice->members_id = 'null';
            $invoice->nominal = '40000,00';
            $invoice->tipe_invoice = 'Member PerVisit';
            $invoice->bukti_pembayaran = 'null';
            $invoice->save();

            // Refresh page
            return response()->json(['message' => 'Invoice berhasil ditambahkan', 'refresh' => true]);
        } else {
            return response()->json(['message' => 'Member tidak ditemukan'], 404);
        }
    }
}
