<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;

class KecamatanController extends Controller
{
    public function index()
    {
        return view('admin.kecamatan.index');
    }

    public function listKecamatan()
    {
        $data = DB::table('kecamatan')->join('kabupaten', 'kabupaten.id_kabupaten', '=', 'kecamatan.id_kabupaten')
                ->orderBy('id_kecamatan', 'DESC')
                ->get();

        return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return  '<a href="'.route('admin.kecamatan.edit', ['id' => $data->id_kecamatan]).'" class="btn btn-xs btn-success mr-10">Edit</a>'. 
                            '<a href="'.route('admin.kecamatan.delete', ['id' => $data->id_kecamatan]).'" class="btn btn-xs btn-danger deleted">Hapus</a>';
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function add()
    {
        $kabupaten = DB::table('kabupaten')->get();
        return view('admin.kecamatan.add', ['kabupaten' => $kabupaten]);
    }

    public function addDo(Request $request)
    {
        $this->validate($request, [
            'nama_kecamatan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'id_kabupaten' => 'required',
        ],
        [
            'nama_kecamatan.required' => 'Nama kecamatan tidak boleh kosong',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'id_kabupaten.required' => 'Kabupaten tidak boleh kosong',
        ]);

        DB::table('kecamatan')->insert([
            'nama_kecamatan' => $request->input('nama_kecamatan'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'id_kabupaten' => $request->input('id_kabupaten'),
            'center' => $request->input('latitude').', '. $request->input('longitude'),
        ]);

        return redirect()->route('admin.kecamatan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kecamatan = DB::table('kecamatan')->where('id_kecamatan', $id)->first();
        $kabupaten = DB::table('kabupaten')->get();

        return view('admin.kecamatan.edit', ['kecamatan' => $kecamatan, 'kabupaten'=> $kabupaten]);
    }

    public function editDo(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kecamatan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'id_kabupaten' => 'required',
        ],
        [
            'nama_kecamatan.required' => 'Nama kecamatan tidak boleh kosong',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'id_kabupaten.required' => 'Kabupaten tidak boleh kosong',
        ]);

        DB::table('kecamatan')->where('id_kecamatan', $id)->update([
            'nama_kecamatan' => $request->input('nama_kecamatan'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'id_kabupaten' => $request->input('id_kabupaten'),
            'center' => $request->input('latitude').', '. $request->input('longitude'),
        ]);


        return redirect()->route('admin.kecamatan.index')->with('success', 'Data berhasil diedit');
    }

    public function delete($id)
    {

        DB::table('kecamatan')->where('id_kecamatan', $id)->delete();


        return redirect()->route('admin.kecamatan.index')->with('success', 'Data berhasil dihapus');
    }
}
