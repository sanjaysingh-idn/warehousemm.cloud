<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Desain;
use App\Models\Security;
use App\Models\Supplier;
use App\Models\KainKeluar;
use App\Models\Koordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\fileExists;

use Yajra\DataTables\DataTables;


class KainController extends Controller
{

    private function convertToSecretCode($hargaPokok)
    {
        $mapping = [
            '1' => 'S',
            '2' => 'I',
            '3' => 'A',
            '4' => 'P',
            '5' => 'T',
            '6' => 'E',
            '7' => 'R',
            '8' => 'J',
            '9' => 'U',
            '0' => 'N',
        ];

        $hargaStr = (string)$hargaPokok;
        $char1 = $mapping[$hargaStr[0]] ?? '';
        $char2 = $mapping[$hargaStr[1]] ?? '';
        // Ambil tiga digit terakhir dari harga pokok
        $lastThreeDigits = substr($hargaStr, -3);

        // Hapus digit terakhir dari tiga digit tersebut
        $lastTwoDigits = substr($lastThreeDigits, 0, 2);

        // Gabungkan hasil konversi
        return "{$char1}{$char2}/{$lastTwoDigits}";
    }

    public function index()
    {
        $kain = Kain::all();

        return view('kain.index', [
            'title'     => 'Kain',
            'kain'      => $kain,
            'supplier'  => Supplier::all(),
        ]);
    }

    public function create()
    {
        return view('kain.create', [
            'title'         => 'Formulir Barang Masuk',
            'supplier'      => Supplier::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nama_kain'     => 'required',
            'kode_desain'   => 'nullable',
            'surat_jalan'   => 'nullable',
            'lot'           => 'nullable',
            'harga'         => 'nullable',
            'satuan'        => 'nullable',
            'lokasi'        => 'nullable',
            'tgl_masuk'     => 'required',
            'keterangan'    => 'nullable',
            'status'        => 'nullable',
            'supplier_id'   => 'required',
            'foto_kain'     => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
        ]);

        // Konversi harga menjadi kode rahasia
        if ($request->harga) {
            $attr['harga'] = $this->convertToSecretCode($request->harga);
        }

        $attr['input_by'] = Auth::user()->name;
        $attr['input_at'] = Carbon::now();

        if ($request->file('foto_kain')) {
            $attr['foto_kain'] = $request->file('foto_kain')->store('foto_kain');
        }

        Kain::create($attr);

        return Redirect::to('/kain')->with('message', 'Kain berhasil ditambah');
    }

    public function show(Kain $kain)
    {
        //
    }

    public function edit($id)
    {
        return view('kain.edit', [
            'title'     => 'Edit Data Kain',
            'kain'      => Kain::findOrFail($id),
            'supplier'  => Supplier::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->foto_kain);
        $attr = $request->validate([
            'nama_kain'     => 'required',
            'kode_desain'   => 'nullable',
            'surat_jalan'   => 'nullable',
            'lot'           => 'nullable',
            'harga'         => 'nullable',
            'satuan'        => 'nullable',
            'lokasi'        => 'nullable',
            'keterangan'    => 'nullable',
            'status'        => 'nullable',
            'supplier_id'   => 'required',
            'foto_kain'     => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp',
        ]);


        $attr['update_by'] = Auth::user()->name;
        $attr['update_at'] = Carbon::now();

        $kain = Kain::findOrFail($id);

        // Konversi harga menjadi kode rahasia jika harga diinput, jika tidak, gunakan harga yang ada
        if ($request->filled('harga')) {
            $attr['harga'] = $this->convertToSecretCode($request->harga);
        } else {
            $attr['harga'] = $kain->harga;
        }

        // Delete the old image if a new one is uploaded
        if ($request->file('foto_kain')) {
            Storage::delete($kain->foto_kain);
            $attr['foto_kain'] = $request->file('foto_kain')->store('foto_kain');
        }

        $kain->update($attr);

        return redirect('/kain')->with('message', 'Data Kain berhasil diubah');
    }

    public function destroy($id)
    {
        $kain = Kain::findOrFail($id);
        $filePath = $kain->foto_kain;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $kain->delete();
        return back()->with('message_delete', 'Kain berhasil dihapus');
    }

    // ======================== LAPORAN KAIN =======================================
    public function laporan()
    {
        return view('laporan.kain.index', [
            'title'         => 'Laporan Barang Masuk',
        ]);
    }

    public function laporanPerKain($id)
    {
        $kain = Kain::findOrFail($id);
        $kain->each(function ($item) {
            $item->warnas = $item->warnas->sortBy('nama_warna');

            // Count total ready Pcs for each color
            $item->warnas->each(function ($warna) {
                $warna->total_ready_pcs = $warna->pcs->where('status', null)->count();
            });
        });

        $data = [
            'title'         => 'Laporan Per Kain',
            'titleReport'   => 'Laporan Kain ' . $kain->nama_kain,
            'kain'          => $kain,
        ];

        $pdf = \PDF::loadView('laporan.kain.pdfPerKain', $data);
        $pdf->setPaper('a4');
        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('laporan_kain_' . $kain->nama_kain . '.pdf');
    }


    public function generateKainReport(Request $request)
    {
        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $kainReport = Kain::whereBetween('tgl_masuk', [
            $startDate . ' 00:00:00',
            $endDateTime
        ])->orderBy('created_at')->get();

        return view('laporan.kain.report', [
            'title'         => 'Laporan Barang Masuk',
            'startDate'     => $startDate,
            'endDate'       => $endDate,
            'kainReport'    => $kainReport,
            'dateRange'     => $startDate . ' - ' . $endDate,
        ]);
    }

    public function generateKainReportPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $kainReport = Kain::whereBetween('tgl_masuk', [
            $startDate . ' 00:00:00',
            $endDateTime
        ])->orderBy('nama_kain')->get();

        // Sort warnas within each Kain item by nama_warna
        $kainReport->each(function ($item) {
            $item->warnas = $item->warnas->sortBy('nama_warna');
        });

        $data = [
            'title'         => 'Laporan Kain',
            'titleReport'   => 'Laporan Kain Masuk',
            'kainReport'    => $kainReport,
            'startDate'     => $startDate,
            'endDate'       => $endDate,
        ];


        $pdf = \PDF::loadView('laporan.kain.pdf', $data);
        $pdf->setPaper('a4');
        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('laporan_kain_' . $startDate . '.pdf');
    }

    public function generateKainReportNamaPDF(Request $request)
    {
        $namaKain = $request->input('nama_kain');

        $kainReport = Kain::where('nama_kain', 'like', '%' . $namaKain . '%')
            ->orderBy('nama_kain')
            ->get();

        // Sort warnas within each Kain item by nama_warna
        $kainReport->each(function ($item) {
            $item->warnas = $item->warnas->sortBy('nama_warna');
        });

        $data = [
            'title'         => 'Laporan Kain',
            'titleReport'   => 'Laporan Kain Masuk',
            'kainReport'    => $kainReport,
            'namaKain'      => $namaKain,
        ];

        $pdf = \PDF::loadView('laporan.kain.pdfnama', $data);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('laporan_kain_' . $namaKain . '.pdf');
    }

    public function generateKainReportKeluar(Request $request)
    {
        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $kainReport = Kain::whereBetween('created_at', [
            $startDate . ' 00:00:00',
            $endDateTime
        ])->orderBy('created_at')->get();

        return view('laporan.kainReportKeluar', [
            'title'         => 'Laporan Barang Masuk',
            'startDate'     => $startDate,
            'endDate'       => $endDate,
            'kainReport'    => $kainReport,
            'dateRange'     => $startDate . ' - ' . $endDate,
        ]);
    }

    public function generateKainReportKeluarPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $kainReport = Kain::whereBetween('created_at', [
            $startDate . ' 00:00:00',
            $endDateTime
        ])->orderBy('created_at')->get();

        $data = [
            'title'         => 'Laporan Kain',
            'titleReport'   => 'Laporan Kain Masuk',
            'kainReport'    => $kainReport,
            'startDate'     => $startDate,
            'endDate'       => $endDate,
        ];


        $pdf = \PDF::loadView('pdf.pdfKain', $data);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('laporan_kain.pdf');
    }
    // ===================== END OF LAPORAN KAIN ===================================

    public function kainKeluar()
    {
        return view('kain.keluar.index', [
            'title'         => 'Data Kain Keluar',
            'kainKeluar'    => KainKeluar::all(),
        ]);
    }
    public function kainKeluarCreate()
    {
        return view('kain.keluar.create', [
            'title'     => 'Formulir Barang Keluar',
            'supplier'  => Supplier::all(),
        ]);
    }
    public function kainKeluarStore(Request $request)
    {
        $attr = $request->validate([
            'jenis'             => 'required',
            'nama_pengambil'    => 'required',
            'nama_pembuat'      => 'required',
            'nama_security'     => 'required',
            'nama_koordinator'  => 'required',
            'tujuan'            => 'required',
            'barang'            => 'required',
            'keterangan'        => 'nullable',
            'tanggal'           => 'required',
            'total_kain'        => 'required',
            'total_pcs'         => 'required',
        ]);

        KainKeluar::create($attr);

        return Redirect::to('/kain/keluar')->with('message', 'Kain Keluar berhasil ditambah');
    }

    public function updateStatus(Request $request, $id)
    {
        $kain = Kain::findOrFail($id);
        $kain->update([
            'status' => $request->status,
        ]);

        return Redirect::to('/kain')->with('message', 'Kain berhasil diupdate');
    }

    public function searchById(Request $request)
    {
        // ddd($request);
        $request->validate([
            'search_id' => 'required|numeric',
        ]);

        $searchId = $request->input('search_id');

        try {
            $kain = Kain::findOrFail($searchId);

            // Eager load related data and sort
            $kain->load(['warnas' => function ($query) {
                $query->orderBy('nama_warna');
            }]);

            // Count total ready Pcs for each color
            $kain->warnas->each(function ($warna) {
                $warna->total_ready_pcs = $warna->pcs->where('status', null)->count();
            });

            return view('kain.getKain', [
                'title' => $kain->nama_kain,
                'kain' => $kain,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Kain with ID ' . $searchId . ' not found.');
        }
    }

    public function cetakBarcode($id)
    {
        $kain = Kain::findOrFail($id);
        $kain->each(function ($item) {
            $item->warnas = $item->warnas->sortBy('nama_warna');

            // Count total ready Pcs for each color
            $item->warnas->each(function ($warna) {
                $warna->total_ready_pcs = $warna->pcs->where('status', null)->count();
            });
        });

        // dd($kain);
        return view('kain.barcode', [
            'title'         => 'Barcode Data Kain',
            'titleReport'   => 'Barcode Kain ' . $kain->nama_kain,
            'kain'          => $kain,
        ]);
    }
}
