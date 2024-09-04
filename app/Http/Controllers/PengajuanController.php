<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pengajuan.index', [
            'title'         => 'Daftar Pengajuan',
            'pengajuan'     => Pengajuan::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nama'          => 'required|max:255',
            'jabatan'       => 'required',
            'email'         => 'required|email:dns|max:150',
        ]);

        Pengajuan::create($attr);

        $whatsappNumber = '6287787488698';
        $whatsappMessage = "Hallo, saya ingin melakukan pengajuan akun di *WMS Mac Mohan*\n"
            . "Nama: {$attr['nama']}\n"
            . "Jabatan: {$attr['jabatan']}\n"
            . "Email: {$attr['email']}\n"
            . "Terimakasih";

        $encodedMessage = urlencode($whatsappMessage);

        $whatsappUrl = "https://api.whatsapp.com/send?phone={$whatsappNumber}&text={$encodedMessage}";

        return Redirect::to($whatsappUrl)->with('message', 'Pengajuan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
