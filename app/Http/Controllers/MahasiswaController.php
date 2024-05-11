<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = mahasiswa::all();
        return view('mhs.index', compact('mahasiswa'));
    }

    public function add()
    {
        
        return view('mhs.add');
    }
    public function store(Request $req)
    {
        Mahasiswa::create($req->all());
        return redirect('/mahasiswa');
    }
    public function edit($id)
    {
        $mhs = Mahasiswa::find($id);
        return view('mhs.edit', compact('mhs'));
    }

    public function update(Request $req, $id)
    {
        Mahasiswa::find($id)->update($req->all());
        return redirect('/mahasiswa');
    }
    
    public function delete($id)
    {
        Mahasiswa::find($id)->delete();
        return redirect('/mahasiswa');
    }

    public function cetak()
    {
        $mahasiswa = Mahasiswa::get();
        $pdf = Pdf::loadView("mhs.cetak", compact("mahasiswa"));
        return $pdf->download('mahasiswa.pdf');
    }

}
