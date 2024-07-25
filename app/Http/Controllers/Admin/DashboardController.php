<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\PersonalTrainer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAmount = Invoice::sum('nominal');
        $totalAmount = $totalAmount ? $totalAmount : 0;
        return view('admin.dashboard', compact('totalAmount'));
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
                        <a href="#" class="btn btn-primary btn-sm" onclick="checkIn(' . $trainer->nama . ')">Check In</a>
                    </div>
                </div>'
                ]);
            } else {
                return response()->json(['message' => '<span style="color:red; font-weight:bold; font-size:24px">Personal Trainer ' . $trainer->nama . ' tidak aktif.</span>']);
            }
        } else {
            return response()->json(['message' => '<span style="color:red; font-weight:bold; font-size:30px">Personal Trainer tidak ditemukan</span>']);
        }
    }
}
