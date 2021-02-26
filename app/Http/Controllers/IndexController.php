<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $jenis_faskes = DB::table('datajenis')->get();
        $jam_buka = DB::table('jam_buka')->get();
        return view('index', ['jenis_faskes' => $jenis_faskes, 'jam_buka' => $jam_buka]);
    }

    public function persebaran()
    {
        $jenis_faskes = DB::table('datajenis')->get();
        $jam_buka = DB::table('jam_buka')->get();
        return view('persebaran', ['jenis_faskes' => $jenis_faskes, 'jam_buka' => $jam_buka]);
    }

    public function persebaranList(Request $request)
    {
        $id_jenis_faskes = !empty($request->id_jenis_faskes) ? ($request->id_jenis_faskes) : ('');
        $id_jam_buka = !empty($request->id_jam_buka) ? ($request->id_jam_buka) : ('');

        $data_faskes = DB::table('datafaskes')->select('nama_faskes', 'latitude', 'longitude', 'alamat');

        if ($id_jenis_faskes) {
            $data_faskes->where('id_jenis_faskes', $id_jenis_faskes);
        }

        if ($id_jam_buka) {
            $data_faskes->where('id_jam_buka', $id_jam_buka);
        }

        $data = $data_faskes->get();

        
        if($data){
            return response()->json($data, 200);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return new JsonResponse(['message' => $e->getMessage()], 422);
        }


        
    }
}
