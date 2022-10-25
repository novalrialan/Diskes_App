<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedung = Gedung::latest()->paginate(5);
        return view('gedung.index', compact('gedung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validated = Validator::make($input, [
            'kode_gedung' => 'required',
            'tanggal_peminjaman' => 'required',
            'jumlah' => 'required|int',
            'keterangan' => 'required|string'
        ]);
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        Gedung::create($input);

        session()->flash('success', 'Data berhasil disimpan!');

        return back();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gedung $gedung)
    {
        $input = $request->all();
        $validated = Validator::make($input, [
            'kode_gedung' => 'required',
            'tanggal_peminjaman' => 'required',
            'jumlah' => 'required|int',
            'keterangan' => 'required|string|min:5|max:1000'
        ]);
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        $gedung = Gedung::findOrFail($request->id);
        $gedung->update($input);

        session()->flash('success', 'berhasil mengupdate data gedung!');

        return back();
    }

    public function delete(Request $request)
    {
        $gedung = Gedung::findOrFail($request->id);
        $gedung->delete();

        session()->flash('danger', 'data gedung berhasil dihapus.');

        return back();
    }

    public function hitung()
    {
        return Gedung::count();
    }
}
