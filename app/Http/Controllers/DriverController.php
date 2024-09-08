<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Sopir;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::orderBy('created_at', 'desc')->get();
        $sopir = Sopir::orderBy('created_at', 'desc')->get();
        $mobil = Mobil::orderBy('created_at', 'desc')->get();

        return view('driver.index', [
            'title'     => 'Notebook Driver',
            'driver'    => $driver,
            'sopir'     => $sopir,
            'mobil'     => $mobil,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $attr = $request->validate([
            'pergi'         => 'required',
            'pulang'        => 'nullable',
            'nama_pembeli'  => 'nullable',
            'tujuan'        => 'required',
            'sopir'         => 'required',
            'kernet'        => 'nullable',
            'mobil'         => 'required',
            'barang'        => 'nullable',
        ]);

        $attr['input_by']   = Auth::user()->name;

        Driver::create($attr);

        return back()->with('message', 'Notebook Driver berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        // dd($request);
        $attr = $request->validate([
            'pergi'         => 'required',
            'pulang'        => 'nullable',
            'nama_pembeli'  => 'nullable',
            'tujuan'        => 'required',
            'sopir'         => 'required',
            'kernet'        => 'nullable',
            'mobil'         => 'required',
            'barang'        => 'nullable',
        ]);

        $attr['update_by']   = Auth::user()->name;

        $driver = Driver::findOrFail($driver->id);
        $driver->update($attr);;

        return back()->with('message', 'Notebook Driver berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver = Driver::findOrFail($driver->id);
        $driver->delete();
        return back()->with('message_delete', 'Driver berhasil dihapus');
    }
}
