<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class JarakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        $kecamatan = DB::table('kecamatan')->get();
        $data_faskes = DB::table('datafaskes')->get();

        return view('admin.jarak.index', ['kecamatan' => $kecamatan, 'data_faskes' => $data_faskes]);
    }

    public function getAlamat(Request $request)
    {
        $id_faskes = $request->input('id_faskes');
        $id_kecamatan = $request->input('id_kecamatan');
        
        try {
            $faskes = DB::table('datafaskes')->where('id_faskes', $id_faskes)->first();
            $kecamatan = DB::table('kecamatan')->where('id_kecamatan', $id_kecamatan)->first();

            return response()->json(['faskes' => $faskes, 'kecamatan' => $kecamatan], 200);
        } catch (Exception  $th) {
            return response()->json(['message' => $th->getMessage()],  $th->getStatusCode());
        }
        
    }

    public function addJarak(Request $request)
    {
        $id_faskes = $request->input('id_faskes');
        $id_kecamatan = $request->input('id_kecamatan');
        $result_jarak = $request->input('result_jarak');

        $jarak = DB::table('jarak')->where('id_kecamatan', $id_kecamatan)->where('id_faskes', $id_faskes)->first();
        if ($jarak) {
            $update = DB::table('jarak')->where('id_kecamatan', $id_kecamatan)
                        ->where('id_faskes', $id_faskes)
                        ->update(['id_kecamatan' => $id_kecamatan, 'id_faskes' => $id_faskes, 'jrk' => $result_jarak]);

            if($jarak){
                return response()->json(['status' => 'updated'], 200);
            }
    
            if ($request->ajax() || $request->wantsJson()) {
                return new JsonResponse(['message' => $e->getMessage()], 422);
            }

        } else {
            $jarak = DB::table('jarak')->insert([
                'id_kecamatan' => $id_kecamatan,
                'id_faskes' => $id_faskes,
                'jrk' => $result_jarak
            ]);

            if($jarak){
                return response()->json(['status' => 'insert'], 200);
            }
    
            if ($request->ajax() || $request->wantsJson()) {
                return new JsonResponse(['message' => $e->getMessage()], 422);
            }
        }
    }

    public function cek(Request $request)
    {
        $faskes = DB::table('jarak')
                    ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'jarak.id_kecamatan')
                    ->join('datafaskes', 'datafaskes.id_faskes', '=', 'jarak.id_faskes')
                    ->select('datafaskes.nama_faskes', 'kecamatan.nama_kecamatan');

        $id_kecamatan = !empty($request->id_kecamatan) ? ($request->id_kecamatan) : ('');

        if ($id_kecamatan) {
            $faskes->where('jarak.id_kecamatan', $id_kecamatan);
        }


        
        $data = $faskes->get();
        $group = $data->groupBy('nama_kecamatan');

        $datafaskes = DB::table('datafaskes')->count();

        echo '<h1>Jumlah Faskes : '. $datafaskes  . '</h1>';

        foreach ($group as $key => $value) {
            echo '<h3>'. $key . '<h3> Jumlah Input : '. count($value) . ' Kurang :'. ($datafaskes -  count($value)) .'<ul>';
            foreach ($value as $item) {
                echo '<li>' . $item->nama_faskes . '</li>'; 
            }
            echo '</ul><br><hr>';
        }
        // return $group;
    }
}
