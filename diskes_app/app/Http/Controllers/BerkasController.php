<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\VerifikasiBerkas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::with('pegawai', 'verifikasi')->latest()->paginate(5);
        $pegawai = auth()->user()->id;
        return view('berkas.index', compact('berkas', 'pegawai'));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        // validasi datanya
        $validated = Validator::make($input, [
            'pegawai_id' => 'required|int',
            'tanggal' => 'required',
            'title' => 'required|string|max:100',
            'keterangan' => 'required|max:150',
            'file' => 'required|mimes:doc,xlx,xls,pdf|max:2048'
        ]);
        // cek validasi jika validasinya salah kembalikan error
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        $file = request()->file('file') ? request()->file('file')->store('file_berkas') : null;
        $input['file'] = $file;
        $berkas = Berkas::create($input);


        if (isset($berkas)) {
            $veriB = new VerifikasiBerkas;
            $veriB->berkas_id = $berkas->id;
            $veriB->tanggal_verifikasi = $berkas->tanggal;
            $veriB->status = request('status');
            $veriB->save();
        }

        session()->flash('success', 'berkas berhasil ditambahkan!');


        return back();
    }


    public function update(Request $request)
    {
        $input = $request->all();
        // validasi datanya
        $validated = Validator::make($input, [
            'pegawai_id' => 'required|int',
            'tanggal' => 'required',
            'title' => 'required|string|max:100',
            'keterangan' => 'required|max:150',
            'file' => 'required|mimes:doc,xlx,xls,pdf|max:2048'
        ]);
        // cek validasi jika validasinya salah kembalikan error
        if ($validated->fails()) {
            return back()->withErrors($validated->errors());
        }

        $berkas = Berkas::findOrFail($request->id);

        Storage::delete($request->fileOld); // query delete riwayat file lama
        $file = request()->file('file') ? request()->file('file')->store('file_berkas') : null;
        $input['file'] = $file;

        $berkas->update($input);

        session()->flash('success', 'berkas berhasil di edit!');
        return back();
    }


    public function delete(Request $request)
    {

        $id = $request->id;
        $berkas = Berkas::findOrFail($id);
        // validasi delete check id di table verifikasi
        if ($berkas->verifikasi()->exists()) {
            return back()->with('faild', 'berkas masih ditangani di verifikasi, tidak boleh dihapus');
        }

        $berkas->delete();
        Storage::delete($request->file); // query delete file 

        session()->flash('danger', 'data berkas berhasil dihapus');
        return back();
    }

    public function hitung()
    {
        return Berkas::count();
    }
}
