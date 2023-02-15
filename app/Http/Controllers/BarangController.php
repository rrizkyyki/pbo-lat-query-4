<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::table('tb_barang')->get();
        return view('barang.index', ['title' => 'Barang'], compact(['barang']));
    }

    public function store(Request $request)
    {
        DB::table('tb_barang')->insert([
            'nama_barang' => $request->nama_barang,
            'tanggal' => $request->tanggal,
            'harga_awal' => $request->harga_awal,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang
        ]);
        return redirect('/barang')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        // search id
        $barang = DB::table('tb_barang')->where('id_barang', '=', $id);

        return view('barang.edit', ['title' => 'Barang'], compact(['barang']));
    }

    public function update(Request $request, $id)
    {
        $barang = DB::table('tb_barang')->where('id_barang', '=', $id);

        $barang->update($request->except(['_token', '_method']));

        return redirect('/barang')->with('success', 'Success Updated !');
    }

    public function destroy($id)
    {
        // search id
        $barang = DB::table('tb_barang')->where('id_barang', '=', $id);

        // run the delete function
        $barang->delete();

        // back with success alert
        return redirect('/barang')->with('success', 'Success Deleted !');
    }
}
