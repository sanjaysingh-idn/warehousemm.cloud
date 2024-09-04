<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function index()
    {
        return view('koordinator.index', [
            'title'     => 'Data koordinator',
            'koordinator'  => Koordinator::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nama_koordinator'   => 'required|max:255',
        ]);

        Koordinator::create($attr);

        return back()->with('message', 'koordinator berhasil ditambah');
    }

    public function show(koordinator $koordinator)
    {
        //
    }

    public function edit(koordinator $koordinator)
    {
        //   
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'nama_koordinator'   => 'required|max:255',
        ]);

        $koordinator = Koordinator::findOrFail($id);
        $koordinator->update($attr);

        return back()->with('message', 'koordinator berhasil di update');
    }

    public function destroy($id)
    {
        $koordinator = Koordinator::findOrFail($id);
        $koordinator->delete();
        return back()->with('message_delete', 'koordinator berhasil dihapus');
    }
}
