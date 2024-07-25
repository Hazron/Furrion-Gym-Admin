<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\Invoice;
use App\Models\PersonalTrainer;
use Illuminate\Http\Request;
use Illmuniate\Support\Facades\Log;

class PersonalTrainerController extends Controller
{
    public function index()
    {
        $activeMembers = Members::where('status', 'aktif')->get();
        $personalTrainers = PersonalTrainer::all();
        return view('admin.pt', compact('activeMembers', 'personalTrainers'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'nama_trainer' => 'required|string',
            'sesi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1028',
        ]);

        $bukti_pembayaran = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $bukti_pembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
        }

        $personalTrainer = PersonalTrainer::create([
            'sesi' => $this->getNameSesi($request->input('sesi')),
            'nama' => $request->input('nama'),
            'personal_trainer' => $request->input('nama_trainer'),
            'status' => 'Aktif',
            'maksimal_visit' => $this->getMaxVisit($request->input('sesi')),
            'visit' => 0,
            'tanggal_mulai' => $request->input('tanggal_mulai'),
        ]);

        // Invoice::create([
        //     'tanggal' => now(),
        //     'members_id' => $request->input('nama'),
        //     'sesi_pt' => $this->getNameSesi($request->input('sesi')),
        //     'nominal' => $this->getNominal($request->input('sesi')),
        //     'tipe_invoice' => 'Register Personal Trainer',
        //     'bukti_pembayaran' => $bukti_pembayaran,
        // ]);

        return redirect()->route('admin.trainer')->with('success', 'Data berhasil disimpan');
    }

    private function getMaxVisit($sesi)
    {
        $maxVisits = [
            '1' => '10',
            '2' => '20',
            '3' => '50',
            '4' => '10',
            '5' => '20',
            '6' => '50',
        ];

        return $maxVisits[$sesi] ?? '0';
    }

    private function getNominal($sesi)
    {
        $nominals = [
            '1' => 'Rp 1.200.000',
            '2' => 'Rp 2.000.000',
            '3' => 'Rp 4.000.000',
            '4' => 'Rp 2.000.000',
            '5' => 'Rp 3.800.000',
            '6' => 'Rp 7.000.000',
        ];

        return $nominals[$sesi] ?? 'Rp 0';
    }

    private function getNameSesi($sesi)
    {
        $names = [
            '1' => 'Singel Session 10x',
            '2' => 'Single Session 20x',
            '3' => 'Single Session 30x',
            '4' => 'Couple Session 10x',
            '5' => 'Couple Session 20x',
            '6' => 'Couple Session 50x',
        ];

        return $names[$sesi] ?? 'Null';
    }

    public function updateVisit($id)
    {
        $trainer = PersonalTrainer::find($id);

        if ($trainer) {
            $trainer->visit = ($trainer->visit ? $trainer->visit : 0) + 1;
            $trainer->save();

            return response()->json([
                'message' => '<div class="text-center mt-3">
                    <span style="color:green; font-weight:bold; font-size:30px">Personal Trainer ' . $trainer->nama . ' berhasil check-in. Total visit: ' . $trainer->visit . '</span>
                    <br>
                    <span style="color:blue; font-weight:bold; font-size:20px">Total visit sekarang: ' . $trainer->visit . ' x</span>
                </div>',
                'success' => true
            ]);
        } else {
            return response()->json([
                'message' => 'Personal Trainer tidak ditemukan',
                'success' => false
            ]);
        }
    }

    public function checkInByName($name)
    {
        Log::info('Received request to check in for trainer: ' . $name);

        $trainer = PersonalTrainer::where('nama', $name)->first();

        if (!$trainer) {
            return response()->json(['message' => 'Trainer not found', 'success' => false], 404);
        }

        Log::info('Trainer found: ', $trainer->toArray());

        $trainer->visit = ($trainer->visit ?? 0) + 1;
        $trainer->save();

        Log::info('Trainer visit updated: ', $trainer->toArray());

        return response()->json([
            'message' => 'Check-in successful. Total visits: ' . $trainer->visit,
            'success' => true
        ]);
    }
}
