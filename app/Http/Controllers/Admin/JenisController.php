<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DB;

class JenisController extends Controller
{
    public function index()
    {
        return view('admin.jenis.index');
    }

    public function listJenis()
    {
        $data = DB::table('datajenis')->orderBy('id_jenis_faskes', 'DESC')->get();
        return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return  '<a href="'.route('admin.jenis_faskes.edit', ['id' => $data->id_jenis_faskes]).'" class="btn btn-xs btn-success mr-10">Edit</a>'. 
                            '<a href="'.route('admin.jenis_faskes.delete', ['id' => $data->id_jenis_faskes]).'" class="btn btn-xs btn-danger deleted">Hapus</a>';
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function add()
    {
        return view('admin.jenis.add');
    }

    public function addDo(Request $request)
    {
        $this->validate($request, [
            'jenis_faskes' => 'required',
        ],
        [
            'jenis_faskes.required' => 'Jenis Fasilitas Kesehatan tidak boleh kosong',
        ]);

        DB::table('datajenis')->insert([
            'jenis_faskes' => $request->input('jenis_faskes'),
        ]);

        return redirect()->route('admin.jenis_faskes.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenis_faskes = DB::table('datajenis')->where('id_jenis_faskes', $id)->first();

        return view('admin.jenis.edit', ['jenis_faskes' => $jenis_faskes]);
    }

    public function editDo(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_faskes' => 'required',
        ],
        [
            'jenis_faskes.required' => 'Jenis Fasilitas Kesehatan tidak boleh kosong',
        ]);

        DB::table('datajenis')->where('id_jenis_faskes', $id)->update([
            'jenis_faskes' => $request->input('jenis_faskes'),
        ]);


        return redirect()->route('admin.jenis_faskes.index')->with('success', 'Data berhasil diedit');
    }

    public function delete($id)
    {

        DB::table('datajenis')->where('id_jenis_faskes', $id)->delete();


        return redirect()->route('admin.jenis_faskes.index')->with('success', 'Data berhasil dihapus');
    }
}
