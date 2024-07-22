<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoice');
    }

    public function getData()
    {
        $invoice = Invoice::get();

        return DataTables::of($invoice)
            ->addColumn('cetak', function ($invoice) {
                return '<a href="' . url('invoice/' . $invoice->bukti_pembayaran) . '" target="_blank" class="btn btn-success btn-sm">Cetak</a>';
            })
            ->addColumn('nama', function ($invoice) {
                return $invoice->member->nama;
            })
            ->addColumn('nama_paket', function ($invoice) {
                return $invoice->member->paket->nama_paket;
            })
            ->addColumn('nominal', function ($invoice) {
                return 'Rp ' . number_format($invoice->nominal, 0, ',', '.');
            })
            ->addColumn('tanggal', function ($invoice) {
                return $invoice->tanggal->locale('id_ID')->isoFormat('d MMMM Y');
            })
            ->rawColumns(['cetak', 'nama', 'nama_paket', 'nominal', 'tanggal'])
            ->make(true);
    }
}
