<?php

namespace App\Http\Controllers;

use Cart;
use Carbon\Carbon;
use App\Models\Pcs;
use App\Models\Kain;
use App\Models\Warna;
use App\Models\Security;
use App\Models\PcsKeluar;
use App\Models\KainKeluar;
use App\Models\Koordinator;
use App\Models\PackingList;
use App\Models\WarnaKeluar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PackingListController extends Controller
{
    public function index()
    {
        $getPackingList = PackingList::with('kains')->orderBy('created_at', 'desc')->get();
        // dd($getPackingList);
        return view('packingList.index', [
            'title'         => 'Data Packing List',
            'packingList'   => $getPackingList,
        ]);
    }

    public function createManual()
    {
        return view('packingList.createManual', [
            'title'     => 'Formulir Kain Keluar Manual',
        ]);
    }

    public function create()
    {
        return view('packingList.createAuto', [
            'title'         => 'Formulir Kain Keluar Otomatis',
            'kain'          => Kain::whereNull('status')->get(),
            'security'      => Security::all(),
            'koordinator'   => Koordinator::all(),
        ]);
    }

    public function getWarnaOptions($kain_id)
    {
        $warnaOptions = Warna::where('kain_id', $kain_id)->orderBy('nama_warna')->get(['id', 'nama_warna', 'total_pcs']);
        return response()->json($warnaOptions);
    }

    public function getPcsOptions($warna_id)
    {
        $pcsOptions = Pcs::where('warna_id', $warna_id)
            ->where('status', null)
            ->pluck('yard', 'id');
        return response()->json($pcsOptions);
    }

    public function storeManual(Request $request)
    {
        $attr = $request->validate([
            'jenis'             => 'required',
            'nama_pengambil'    => 'required',
            'nama_security'     => 'required',
            'nama_koordinator'  => 'required',
            'tujuan'            => 'required',
            'tanggal'           => 'required',
            'barang'            => 'nullable',
            'total_pcs'         => 'nullable',
        ]);

        $currentDate = now()->format('ymd');
        $lastPackingList = DB::table('packing_lists')
            ->where('packingListNo', 'like', $currentDate . '%')
            ->latest('packingListNo')
            ->first();
        $runningNumber = ($lastPackingList) ? intval(substr($lastPackingList->packingListNo, 6)) + 1 : 1;
        $packingListNo = $currentDate . str_pad($runningNumber, 4, '0', STR_PAD_LEFT);
        $attr['packingListNo'] = $packingListNo;

        PackingList::create($attr);

        return redirect('/packingList')->with('message', 'Kain Keluar berhasil ditambah');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'jenis'             => 'required',
            'nama_pengambil'    => 'required',
            'nama_security'     => 'required',
            'nama_koordinator'  => 'required',
            'tujuan'            => 'required',
            'tanggal'           => 'required',
            'barang'            => 'nullable',
        ]);

        $currentDate = now()->format('ymd');
        $lastPackingList = DB::table('packing_lists')
            ->where('packingListNo', 'like', $currentDate . '%')
            ->latest('packingListNo')
            ->first();
        $runningNumber = ($lastPackingList) ? intval(substr($lastPackingList->packingListNo, 6)) + 1 : 1;
        $packingListNo = $currentDate . str_pad($runningNumber, 4, '0', STR_PAD_LEFT);
        $attr['packingListNo'] = $packingListNo;

        $getTujuan  = $attr['tujuan'];
        $cabangTujuan = ['Cabang Kartasura', 'Cabang Beteng', 'Cabang Salatiga', 'Cabang Ungaran'];
        if ($getTujuan == "Stand") {
            $statusPcs = 1;
        } elseif (in_array($getTujuan, $cabangTujuan)) {
            $statusPcs = 2;
        } elseif ($getTujuan == "Pembeli") {
            $statusPcs = 3;
        } elseif ($getTujuan == "Online") {
            $statusPcs = 4;
        };

        $dataPL = PackingList::create($attr);

        $listItems = $request->input('listItem');

        $decodedListItems = array_map('json_decode', $listItems);

        $rowCount = 0;

        foreach ($decodedListItems as $decodedItem) {
            $getDataKain = Kain::findOrFail($decodedItem->kain_keluar[0]->id);
            $existingKainKeluar = KainKeluar::where('nama_kain', $getDataKain->nama_kain)
                ->where('nama_desain', $getDataKain->kode_desain)
                ->where('id_packing_list', $dataPL->packingListNo)
                ->first();

            if ($existingKainKeluar) {
                $kainKeluarId = $existingKainKeluar->id;
            } else {
                $kainKeluar = new KainKeluar([
                    'packing_list_id' => $dataPL->id,
                    'id_packing_list' => $dataPL->packingListNo,
                    'nama_kain' => $getDataKain->nama_kain,
                    'nama_desain' => $getDataKain->kode_desain,
                    'lot' => $getDataKain->lot,
                ]);
                $kainKeluar->save();

                $kainKeluarId = $kainKeluar->id;
            }

            foreach ($decodedItem->kain_keluar[0]->colors as $color) {
                $namaWarna = $color->nama_warna;
                if (!Str::startsWith($namaWarna, '#')) {
                    $namaWarna = '#' . $namaWarna;
                }

                $warnaKeluar = new WarnaKeluar([
                    'kain_keluar_id' => $kainKeluarId,
                    'nama_warna' => $namaWarna,
                ]);
                $warnaKeluar->save();

                foreach ($color->pcs_keluar as $pcs) {
                    $pcsKeluar = new PcsKeluar([
                        'kain_keluar_id' => $kainKeluarId,
                        'warna_keluar_id' => $warnaKeluar->id,
                        'old_id' => $pcs->id,
                        'yard' => $pcs->quantity,
                    ]);
                    $pcsKeluar->save();

                    $getPcsAttr = Pcs::findOrFail($pcs->id);
                    $getPcsAttr->update([
                        'status' => $statusPcs,
                        'packingListNo' => $dataPL->packingListNo,
                    ]);
                    $rowCount++;
                }
            }
        }

        $dataPL->total_pcs = $rowCount;
        $dataPL->save();

        return back()->with('message', 'Kain Keluar berhasil ditambah');
    }

    public function storePage2(Request $request)
    {
        // Validate and store additional data in the database
        // ...

        return redirect('/finalPage')->with('message', 'Data added successfully.');
    }

    public function show(PackingList $packingList)
    {
        //
    }

    public function edit(PackingList $packingList)
    {
        return view('packingList.edit', [
            'title'         => 'Edit Data Packing List',
            'packingList'   => $packingList,
        ]);
    }

    public function update(Request $request, PackingList $packingList)
    {
        $attr = $request->validate([
            'jenis'             => 'required',
            'nama_pengambil'    => 'required',
            'nama_security'     => 'required',
            'nama_koordinator'  => 'required',
            'tujuan'            => 'required',
            'tanggal'           => 'required',
            'barang'            => 'nullable',
            'total_kain'        => 'nullable',
            'total_warna'       => 'nullable',
            'total_pcs'         => 'nullable',
        ]);

        $packingList->update($attr);

        return redirect('/packingList')->with('message', 'Kain Keluar berhasil diupdate');
    }

    public function destroy(PackingList $packingList)
    {
        $packingList = PackingList::with('kains.warnas.pcs')->findOrFail($packingList->id);
        foreach ($packingList->kains as $kain) {
            foreach ($kain->warnas as $warna) {
                foreach ($warna->pcs as $pcs) {
                    $getPcsAttr = Pcs::findOrFail($pcs->old_id);
                    $getPcsAttr->update([
                        'status' => null,
                        'packingListNo' => null,
                    ]);
                }
            }
        }

        // Now you can delete the PackingList
        $packingList->delete();

        return back()->with('message_delete', 'Packing List berhasil dihapus');
    }

    // ================== LAPORAN ==================
    public function laporan()
    {
        return view('laporan.packingList.index', [
            'title'         => 'Laporan Kain Keluar',
        ]);
    }

    public function generatePDF($id)
    {
        // Find the PackingList by ID
        $packingList = PackingList::findOrFail($id);
        // dd($packingList->packingListNo);
        $data = [
            'title'         => 'Laporan Packing List / Kain Keluar',
            'titleReport'   => 'Laporan  Packing List / Kain Keluar',
            'packingList'   => $packingList,
        ];

        $pdf = \PDF::loadView('packingList.pdf', $data);
        $pdf->setPaper('a4');
        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('report_packingList' . $packingList->packingListNo . '.pdf');
    }

    public function generatePackingListReport(Request $request)
    {
        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $packingList = PackingList::whereBetween('tanggal', [
            $startDate . ' 00:00:00',
            $endDateTime
        ])->orderBy('created_at')->get();

        return view('laporan.packingList.report', [
            'title'                 => 'Laporan Packing List / Kain Keluar',
            'startDate'             => $startDate,
            'endDate'               => $endDate,
            'packingList'           => $packingList,
            'dateRange'             => $startDate . ' - ' . $endDate,
        ]);
    }

    public function generatePackingListReportPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $packingList = PackingList::whereBetween('tanggal', [
            $startDate . ' 00:00:00',
            $endDateTime
        ])->orderBy('created_at')->get();

        $data = [
            'title'                 => 'Laporan  Packing List / Kain Keluar',
            'titleReport'           => 'Laporan  Packing List / Kain Keluar',
            'packingList'           => $packingList,
            'startDate'             => $startDate,
            'endDate'               => $endDate,
        ];


        $pdf = \PDF::loadView('laporan.packingList.pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('laporan_packingList.pdf');
    }
}
