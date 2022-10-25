<?php

namespace App\Http\Controllers;

use App\Exports\VerfikasiExport;
use App\Models\VerifikasiBerkas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        $verifikasi = VerifikasiBerkas::with('berkas')->latest()->paginate(5);
        return view('verifikasi.index', compact('verifikasi'));
    }

    public function exportToEcxel()
    {
        return  Excel::download(new VerfikasiExport, 'export-to-excel-verifikasi.xlsx',);
    }

    public function printTable()
    {
        $verifikasi = VerifikasiBerkas::with('berkas')->get();
        return view('verifikasi.printTable', compact('verifikasi'));
    }

    public function show($id)
    {
        $verifikasi = VerifikasiBerkas::with('berkas')->findOrFail($id);
        return view('verifikasi.show', compact('verifikasi'));
    }

    public function update(Request $request, $id)
    {
        $verifikasi = VerifikasiBerkas::findOrFail($id);
        $verifikasi->status = $request->status;
        $verifikasi->update();
        return back();
    }

    public function delete(Request $request)
    {
        $verifikasi = VerifikasiBerkas::findOrFail($request->id);
        $verifikasi->delete();
        return redirect()->back();
    }

    public function hitung()
    {
        return VerifikasiBerkas::count();
    }
}