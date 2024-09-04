<?php

namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{

    public function index()
    {
        return view('supplier.index', [
            'title'     => 'Data Supplier',
            'supplier'  => Supplier::all(),
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
            'nama_supplier'   => 'required|max:255',
            'keterangan'      => 'required',
        ]);

        $attr['input_by'] = Auth::user()->name;
        $attr['update_by'] = Auth::user()->name;

        Supplier::create($attr);

        return back()->with('message', 'Supplier berhasil ditambah');
    }

    public function show(Supplier $supplier)
    {
        //
    }

    public function edit(Supplier $supplier)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'nama_supplier'   => 'required|max:255',
            'keterangan'      => 'required',
        ]);

        $attr['update_by'] = Auth::user()->name;

        $supplier = Supplier::findOrFail($id);
        $supplier->update($attr);

        return back()->with('message', 'Supplier berhasil di update');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return back()->with('message_delete', 'Supplier berhasil dihapus');
    }
}
