<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;


class KabupatenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return view('admin.kabupaten.index');
    }

    public function listKabupaten()
    {
        $data = DB::table('kabupaten')->orderBy('id_kabupaten', 'DESC')->get();

        return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return  '<a href="'.route('admin.kabupaten.edit', ['id' => $data->id_kabupaten]).'" class="btn btn-xs btn-success mr-10">Edit</a>'. 
                            '<a href="'.route('admin.kabupaten.delete', ['id' => $data->id_kabupaten]).'" class="btn btn-xs btn-danger deleted">Hapus</a>';
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function add()
    {
        return view('admin.kabupaten.add');
    }

    public function addDo(Request $request)
    {
        $this->validate($request, [
            'nama_kabupaten' => 'required',
        ],
        [
            'kabupaten.required' => 'Nama kabupaten tidak boleh kosong',
        ]);

        DB::table('kabupaten')->insert([
            'nama_kabupaten' => $request->input('nama_kabupaten'),
        ]);

        return redirect()->route('admin.kabupaten.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kabupaten = DB::table('kabupaten')->where('id_kabupaten', $id)->first();

        return view('admin.kabupaten.edit', ['kabupaten' => $kabupaten]);
    }

    public function editDo(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kabupaten' => 'required',
        ],
        [
            'kabupaten.required' => 'Nama kabupaten tidak boleh kosong',
        ]);

        DB::table('kabupaten')->where('id_kabupaten', $id)->update([
            'nama_kabupaten' => $request->input('nama_kabupaten'),
        ]);


        return redirect()->route('admin.kabupaten.index')->with('success', 'Data berhasil diedit');
    }

    public function delete($id)
    {

        DB::table('kabupaten')->where('id_kabupaten', $id)->delete();


        return redirect()->route('admin.kabupaten.index')->with('success', 'Data berhasil dihapus');
    }
}
