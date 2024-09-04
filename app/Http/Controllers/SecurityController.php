<?php

namespace App\Http\Controllers;

use App\Models\Security;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function index()
    {
        return view('security.index', [
            'title'     => 'Data Security',
            'security'  => Security::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'nama_security'   => 'required|max:255',
        ]);

        Security::create($attr);

        return back()->with('message', 'Security berhasil ditambah');
    }

    public function show(Security $security)
    {
        //
    }

    public function edit(Security $security)
    {
        //   
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'nama_security'   => 'required|max:255',
        ]);

        $security = Security::findOrFail($id);
        $security->update($attr);

        return back()->with('message', 'Security berhasil di update');
    }

    public function destroy($id)
    {
        $security = Security::findOrFail($id);
        $security->delete();
        return back()->with('message_delete', 'Security berhasil dihapus');
    }
}
