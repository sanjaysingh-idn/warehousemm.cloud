<?php

namespace App\Http\Controllers;

use App\Models\Pcs;
use App\Models\Kain;
use App\Models\Warna;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class WarnaController extends Controller
{
    public function index($kain)
    {
        $kain    = Kain::findOrFail($kain);
        $warna   = $kain->warnas()->withCount(['pcs as total_ready_pcs' => function ($query) {
            $query->where('status', null);
        }])->get()->sort(function ($a, $b) {
            $aNumber = intval(preg_replace('/[^0-9]+/', '', $a->nama_warna));
            $bNumber = intval(preg_replace('/[^0-9]+/', '', $b->nama_warna));

            return strnatcmp($aNumber, $bNumber);
        });

        return view('warna.index', [
            'title'     => $kain->nama_kain,
            'kain'      => $kain,
            'warna'     => $warna,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nama_warna' => 'required|max:255',
            'total_pcs' => 'nullable',
        ]);

        if (!Str::startsWith($attr['nama_warna'], '#')) {
            $attr['nama_warna'] = '#' . $attr['nama_warna'];
        }

        $attr['kain_id'] = $request->kain_id;
        $attr['input_by'] = Auth::user()->name;
        $attr['input_at'] = now();

        Warna::create($attr);

        return back()->with('message', 'Warna berhasil ditambah');
    }

    public function show(Warna $warna)
    {
        //
    }

    public function edit(Warna $warna)
    {
        //
    }

    public function update(Request $request, Warna $warna)
    {
        $attr = $request->validate([
            'nama_warna' => 'required|max:255',
            'total_pcs' => 'nullable',
        ]);

        if (!Str::startsWith($attr['nama_warna'], '#')) {
            $attr['nama_warna'] = '#' . $attr['nama_warna'];
        }

        $warna = Warna::findOrFail($warna->id);
        $warna->update($attr);

        return back()->with('message', 'Data Warna berhasil diubah');
    }

    public function destroy(Warna $warna)
    {
        // dd($warna->id);
        $warna = Warna::findOrFail($warna->id);
        $warna->delete();
        return back()->with('message_delete', 'Warna berhasil dihapus');
    }

    // =================== Pieces ================
    public function pcsList($kain, $warna)
    {
        $kain   = Kain::findOrFail($kain);
        $warna  = $kain->warnas()->findOrFail($warna);

        // Ambil total pcs tersedia

        $pcs    = $warna->pcs()->orderBy('yard')->get();
        // dd($pcs);
        $getTotalReadyPcs = $warna->pcs()->where('status', null)->count();

        return view('warna.pcsList', [
            'title'                 => $kain->nama_kain,
            'kain'                  => $kain,
            'warna'                 => $warna,
            'pcs'                   => $pcs,
            'getTotalReadyPcs'      => $getTotalReadyPcs,
        ]);
    }

    public function pcsStore(Request $request)
    {
        $attr = $request->validate([
            'yard'      => 'required|max:255',
            'times'     => 'required|integer|min:1',
        ]);

        $yard       = $request->yard;
        $times      = $request->input('times');
        $warnaId    = $request->warna_id;
        $input_by   = Auth::user()->name;
        $input_at   = Carbon::now();

        for ($i = 0; $i < $times; $i++) {
            // Save each yard value separately
            Pcs::create([
                'warna_id'  => $warnaId,
                'input_by'  => $input_by,
                'input_at'  => $input_at,
                'yard'      => $yard,
            ]);
        }

        // Update the total_pcs field in the warnas table
        $warna = Warna::findOrFail($request->warna_id);
        $totalPcs = Pcs::where('warna_id', $request->warna_id)->count();
        $warna->update(['total_pcs' => $totalPcs]);

        return back()->with('message', 'Pieces berhasil ditambah');
    }

    public function pcsUpdate(Request $request, $id)
    {
        $attr = $request->validate([
            'status'          => 'nullable',
            'packingListNo'   => 'required',
        ]);

        $attr['update_at'] = Carbon::now();
        $attr['update_by'] = Auth::user()->name;

        $pcs = Pcs::findOrFail($id);
        $pcs->update($attr);

        return back()->with('message', 'Pieces berhasil diubah');
    }

    public function pcsDelete($id)
    {
        // Find the Pcs record
        $pcs = Pcs::findOrFail($id);
        $warnaId = $pcs->warna_id; // Get the warna_id before deletion

        // Delete the Pcs record
        $pcs->delete();

        // Update the total_pcs field in the warnas table
        $warna = Warna::findOrFail($warnaId);
        $totalPcs = Pcs::where('warna_id', $warnaId)->count();
        $warna->update(['total_pcs' => $totalPcs]);

        return back()->with('message_delete', 'Pieces berhasil dihapus');
    }

    // =================== Pieces ================
}
