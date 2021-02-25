<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;

class KelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return view('admin.kelurahan.index');
    }

    public function listKelurahan()
    {
        $data = DB::table('kelurahan')->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'kelurahan.id_kecamatan')
                ->orderBy('id_kelurahan', 'DESC')
                ->get();

        return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return  '<a href="'.route('admin.kelurahan.edit', ['id' => $data->id_kelurahan]).'" class="btn btn-xs btn-success mr-10">Edit</a>'. 
                            '<a href="'.route('admin.kelurahan.delete', ['id' => $data->id_kelurahan]).'" class="btn btn-xs btn-danger deleted">Hapus</a>';
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function add()
    {
        $kecamatan = DB::table('kecamatan')->get();
        return view('admin.kelurahan.add', ['kecamatan' => $kecamatan]);
    }

    public function addDo(Request $request)
    {
        $this->validate($request, [
            'nama_kelurahan' => 'required',
            'id_kecamatan' => 'required',
        ],
        [
            'nama_kelurahan.required' => 'Nama kelurahan tidak boleh kosong',
            'id_kecamatan.required' => 'Kecamatan tidak boleh kosong',
        ]);

        DB::table('kelurahan')->insert([
            'nama_kelurahan' => $request->input('nama_kelurahan'),
            'id_kecamatan' => $request->input('id_kecamatan'),
        ]);

        return redirect()->route('admin.kelurahan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelurahan = DB::table('kelurahan')->where('id_kelurahan', $id)->first();
        $kecamatan = DB::table('kecamatan')->get();

        return view('admin.kelurahan.edit', ['kelurahan' => $kelurahan, 'kecamatan'=> $kecamatan]);
    }

    public function editDo(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kelurahan' => 'required',
            'id_kecamatan' => 'required',
        ],
        [
            'nama_kelurahan.required' => 'Nama kelurahan tidak boleh kosong',
            'id_kecamatan.required' => 'Kecamatan tidak boleh kosong',
        ]);

        DB::table('kelurahan')->where('id_kelurahan', $id)->update([
            'nama_kelurahan' => $request->input('nama_kelurahan'),
            'id_kecamatan' => $request->input('id_kecamatan'),
        ]);


        return redirect()->route('admin.kelurahan.index')->with('success', 'Data berhasil diedit');
    }

    public function delete($id)
    {

        DB::table('kelurahan')->where('id_kelurahan', $id)->delete();


        return redirect()->route('admin.kelurahan.index')->with('success', 'Data berhasil dihapus');
    }
}
