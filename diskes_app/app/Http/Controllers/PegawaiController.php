<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('subbagian')->latest()->paginate(5);
        return view('pegawai.index', compact('pegawai'));
    }

    public function exportToEcxel()
    {

        return  Excel::download(new PegawaiExport, 'daftar-pegawai.xlsx');
    }


    public function printTable()
    {
        $pegawai = Pegawai::with('subbagian')->get();
        return view('pegawai.printTable', compact('pegawai'));
    }

    public function create(Request $request)
    {
        // ambil semua request 
        $input = $request->all();
        // validasi datanya
        $validated = Validator::make($input, [
            'nama_pegawai' => 'required|string|max:150',
            'subbagian_id' => 'required|int',
            'jabatan' => 'required|string|max:100'
        ]);
        // cek validasi jika validasinya salah kembalikan error
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }
        // create data
        Pegawai::create($input);

        //kirimkan session
        session()->flash('success', 'Pegawai berhasil ditambahkan!');

        return back();
    }

    public function update(Request $request)
    {
        // ambil semua request 
        $input = $request->all();
        // validasi datanya
        $validated = Validator::make($input, [
            'nama_pegawai' => 'required|string|max:150',
            'subbagian_id' => 'required|int',
            'jabatan' => 'required|string|max:100'
        ]);
        // cek validasi jika validasinya salah kembalikan error
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        $pegawai =  Pegawai::findOrFail($request->id);
        $pegawai->update($input);

        //kirimkan session
        session()->flash('success', 'Pegawai berhasil update!');

        return back();
    }

    public function delete(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->id);
        $pegawai->delete();

        session()->flash('danger', 'Pegawai berhasil dihapus.');

        return back();
    }

    public function hitung()
    {
        return Pegawai::count();
    }
}