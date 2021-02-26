<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;

class FaskesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return view('admin.faskes.index');
    }

    public function dataList()
    {
        $data = DB::table('datafaskes')->orderBy('id_faskes', 'DESC')
                    ->join('kelurahan', 'kelurahan.id_kelurahan', '=', 'datafaskes.id_kelurahan')
                    ->join('datajenis', 'datajenis.id_jenis_faskes', '=', 'datafaskes.id_jenis_faskes')
                    ->join('jam_buka', 'jam_buka.id_jam_buka', '=', 'datafaskes.id_jam_buka')
                    ->get();
        return Datatables::of($data)
                ->addColumn('telp', function ($data) {
                    if($data->telp == ""){
                        return '-';
                    } else {
                        return $data->telp;
                    }  
                })
                ->addColumn('tipe', function ($data) {
                    if($data->tipe == ""){
                        return '-';
                    } else {
                        return $data->tipe;
                    }  
                })
                ->addColumn('action', function ($data) {
                    return  '<a href="'.route('admin.faskes.edit', ['id' => $data->id_faskes]).'" class="btn btn-xs btn-success mr-10">Edit</a>'. 
                            '<a href="'.route('admin.faskes.delete', ['id' => $data->id_faskes]).'" class="btn btn-xs btn-danger deleted">Hapus</a>';
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function add()
    {
        $jam_buka = DB::table('jam_buka')->get();
        $jenis_faskes = DB::table('datajenis')->get();
        $kelurahan = DB::table('kelurahan')->get();

        return view('admin.faskes.add', ['jam_buka' => $jam_buka, 'jenis_faskes' => $jenis_faskes, 'kelurahan' => $kelurahan]);
    }

    public function addDo(Request $request)
    {
        $this->validate($request, [
            'nama_faskes' => 'required',
            'jam_buka' => 'required',
            'jenis_faskes' => 'required',
            'tahun' => 'required',
            'kelurahan' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ],
        [
            'nama_faskes.required' => 'Nama Faskes tidak boleh kosong',
            'jam_buka.required' => 'Jam Buka tidak boleh kosong',
            'jenis_faskes.required' => 'Jenis Fasilitas tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'kelurahan.required' => 'Keluarahan tidak boleh kosong',
            'lat.required' => 'Latitude tidak boleh kosong',
            'long.required' => 'Longitude tidak boleh kosong',
        ]);

        DB::table('datafaskes')->insert([
            'nama_faskes' => $request->input('nama_faskes'),
            'id_jam_buka' => $request->input('jam_buka'),
            'id_jenis_faskes' => $request->input('jenis_faskes'),
            'telp' => $request->input('telp'),
            'tipe' => $request->input('type'),
            'tahun' => $request->input('tahun'),
            'id_kelurahan' => $request->input('kelurahan'),
            'alamat' => $request->input('alamat'),
            'latitude' => $request->input('lat'),
            'longitude' => $request->input('long'),
        ]);

        return redirect()->route('admin.faskes.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jam_buka = DB::table('jam_buka')->get();
        $jenis_faskes = DB::table('datajenis')->get();
        $kelurahan = DB::table('kelurahan')->get();

        $faskes = DB::table('datafaskes')->where('id_faskes', $id)->first();

        if(!$faskes){
            return redirect()->route('admin.faskes.index')->with('success', 'Data tidak ditemukan atau sudah dihapus');
        }

        return view('admin.faskes.edit', [
            'jam_buka' => $jam_buka, 
            'jenis_faskes' => $jenis_faskes, 
            'kelurahan' => $kelurahan,
            'faskes' => $faskes
        ]);
    }

    public function editDo(Request $request, $id)
    {
        $this->validate($request, [
            'nama_faskes' => 'required',
            'jam_buka' => 'required',
            'jenis_faskes' => 'required',
            'tahun' => 'required',
            'kelurahan' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ],
        [
            'nama_faskes.required' => 'Nama Faskes tidak boleh kosong',
            'jam_buka.required' => 'Jam Buka tidak boleh kosong',
            'jenis_faskes.required' => 'Jenis Fasilitas tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'kelurahan.required' => 'Keluarahan tidak boleh kosong',
            'lat.required' => 'Latitude tidak boleh kosong',
            'long.required' => 'Longitude tidak boleh kosong',
        ]);

        DB::table('datafaskes')->where('id_faskes', $id)
            ->update([
                'nama_faskes' => $request->input('nama_faskes'),
                'id_jam_buka' => $request->input('jam_buka'),
                'id_jenis_faskes' => $request->input('jenis_faskes'),
                'telp' => $request->input('telp'),
                'tipe' => $request->input('type'),
                'tahun' => $request->input('tahun'),
                'id_kelurahan' => $request->input('kelurahan'),
                'alamat' => $request->input('alamat'),
                'latitude' => $request->input('lat'),
                'longitude' => $request->input('long'),
            ]);

        return redirect()->route('admin.faskes.index')->with('success', 'Data berhasil diupdate');
    }
    
    public function delete($id)
    {
        DB::table('datafaskes')->where('id_faskes', $id)->delete();

        return redirect()->route('admin.faskes.index')->with('success', 'Data berhasil dihapus');
    }
}
