<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Bukutamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BukutamuController extends Controller
{
    public function index()
    {
        return view('bukutamu.index', [
            'title' => 'Daftar Buku Tamu',
            'tamu'  => Bukutamu::orderBy('hari')->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $attr = $request->validate([
            'hari'          => 'required',
            'jam_masuk'     => 'required',
            'jam_keluar'    => 'nullable',
            'nama'          => 'required',
            'keperluan'     => 'required',
        ]);

        $attr['input_by']   = Auth::user()->name;

        Bukutamu::create($attr);

        return back()->with('message', 'Buku Tamu berhasil ditambah');
    }

    public function show(Bukutamu $bukutamu)
    {
        //
    }

    public function edit(Bukutamu $bukutamu)
    {
        //
    }

    public function update(Request $request, Bukutamu $bukutamu)
    {
        // dd($request);
        $attr = $request->validate([
            'hari'          => 'required',
            'jam_masuk'     => 'required',
            'jam_keluar'    => 'nullable',
            'nama'          => 'required',
            'keperluan'     => 'required',
        ]);

        $attr['update_by']   = Auth::user()->name;

        $bukutamu = Bukutamu::findOrFail($bukutamu->id);
        $bukutamu->update($attr);;

        return back()->with('message', 'Buku Tamu berhasil ditambah');
    }

    public function destroy(Bukutamu $bukutamu)
    {
        $bukutamu = Bukutamu::findOrFail($bukutamu->id);
        $bukutamu->delete();
        return back()->with('message_delete', 'Buku Tamu berhasil dihapus');
    }

    public function laporan()
    {
        return view('laporan.tamu', [
            'title' => 'Laporan Buku Tamu',
            'tamu'  => Bukutamu::orderBy('hari')->get()
        ]);
    }

    public function generateTamuReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tamuReport = Bukutamu::whereBetween('hari', [$startDate, $endDate])->orderBy('hari')->get();

        return view('laporan.tamuReport', [
            'title'         => 'Laporan Tamu',
            'startDate'     => $startDate,
            'endDate'       => $endDate,
            'tamuReport'    => $tamuReport,
            'dateRange'     => $startDate . ' - ' . $endDate,
        ]);
    }

    public function generateTamuReportPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tamuReport = Bukutamu::whereBetween('hari', [$startDate, $endDate])->orderBy('hari')->get();

        $data = [
            'title'         => 'Laporan Tamu',
            'titleReport'   => 'Laporan Buku Tamu',
            'tamuReport'    => $tamuReport,
            'startDate'     => $startDate,
            'endDate'       => $endDate,
        ];


        $pdf = \PDF::loadView('pdf.pdfTamu', $data);

        return $pdf->stream('laporan_tamu.pdf');
    }
}
