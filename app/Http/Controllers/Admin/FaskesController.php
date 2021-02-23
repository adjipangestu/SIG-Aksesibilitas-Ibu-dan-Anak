<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;

class FaskesController extends Controller
{
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

    public function edit()
    {
        # code...
    }
    
    public function delete()
    {
        # code...
    }
}
