<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function cekMember($nama)
    {
        $member = Members::where('nama', 'like', '%' . $nama . '%')->first();

        if ($member) {
            if ($member->status == 'aktif') {
                return response()->json(['message' => '<span style="color:green; font-weight:bold; font-size:30px">Member ' . $member->nama . ' aktif.</span>']);
            } else {
                return response()->json(['message' => ' <span style="color:red; font-weight:bold; font-size:24px">Member ' . $member->nama . ' tidak aktif. Harap Perpanjang Paket Member </span>']);
            }
        } else {
            return response()->json(['message' => '<span style="color:red; font-weight:bold; font-size:30px">Member tidak ditemukan</span>']);
        }
    }
}
