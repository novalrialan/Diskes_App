<?php

namespace App\Http\Controllers;

use App\Exports\PengelolaanExport;
use Illuminate\Http\Request;
use App\Models\PengelolaanAngaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengelolaanAngaranImport;

class PengelolaanAngaranController extends Controller
{
    public function index()
    {

        $pengelolaan = PengelolaanAngaran::latest()->paginate(10);
        return view('pengolaan.index', compact('pengelolaan'));
    }

    public function exportExcel()
    {
        return Excel::download(new PengelolaanExport, 'list_pengelolaan_angaran.xlsx');
    }

    public function importExcel(Request $request)
    {

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);


        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_berkas_excel di dalam folder public
        $file->move('file_berkas_excel', $nama_file);

        // import data
        Excel::import(new PengelolaanAngaranImport, public_path('/file_berkas_excel/' . $nama_file));

        session()->flash('success', 'Data Berhasil Di Export!');

        return back();
    }
}
