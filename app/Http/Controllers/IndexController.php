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

        $result = $this->result();

        return view('index', ['jenis_faskes' => $jenis_faskes, 'jam_buka' => $jam_buka, 'result' => $result]);
    }

    public function result()
    {
        $kecamatan = DB::table('kecamatan')->get();
        $result = [];
        $avg = $this->avg();

        foreach ($kecamatan as $key => $value) {
            $result[str_replace(' ', '_', $value->nama_kecamatan)] = [
                'nama_kecamatan' => $value->nama_kecamatan,
                'min' => $this->jarakTerdekat($value->id_kecamatan),
                'avg' => $avg['avg'],
                'total_min' => $avg['total_min'],
                'nilai_akses' => $this->jarakTerdekat($value->id_kecamatan) / $avg['avg'],
                'color' => $this->kelas($this->jarakTerdekat($value->id_kecamatan) / $avg['avg'])
            ];
        }

        return $result;
    }

    public function kelas($nilai)
    {
        $rentang = $this->rentang();

        $kelas_satu = $rentang['max'];
        $kelas_dua = $rentang['max'] - $rentang['rentang'];
        $kelas_tiga = $kelas_dua - $rentang['rentang'];
        $kelas_empat = $kelas_tiga - $rentang['rentang'];
        $kelas_lima = $rentang['min'];

        if($nilai >= $kelas_satu){
            return '#0062ff';
        } else if($nilai <= $kelas_satu && $nilai >= $kelas_dua){
            return '#4d91ff';
        } else if($nilai <= $kelas_dua && $nilai >= $kelas_tiga){
            return '#78abff';
        } else if($niali <= $kelas_tiga && $nilai >= $kelas_empat){
            return '#a6c7ff';
        } else if($nilai <= $kelas_empat && $nilai < $kelas_lima) {
            return '#c7dcff';
        }
    }

    public function data()
    {
        $kecamatan = DB::table('kecamatan')->get();
        $result = [];
        $avg = $this->avg();

        foreach ($kecamatan as $key => $value) {
            $result[] = [
                'nama_kecamatan' => $value->nama_kecamatan,
                'min' => $this->jarakTerdekat($value->id_kecamatan),
                'avg' => $avg['avg'],
                'total_min' => $avg['total_min'],
                'nilai_akses' => $this->jarakTerdekat($value->id_kecamatan) / $avg['avg'],
            ];
        }

        return $result;
    }

    public function rentang()
    {
        $data = $this->data();

        $numbers = array_column($data, 'nilai_akses');

        $min = min($numbers);
        $max = max($numbers);
        
        $result = [
            'min' => $min,
            'max' => $max,
            'rentang' => $max - $min / 5
        ];

        return $result;
    }

    public function avg()
    {
        $kecamatan = DB::table('kecamatan')->get();
        $total_min = 0;
        foreach ($kecamatan as $key => $value) {
            $total_min += $this->jarakTerdekat($value->id_kecamatan);
        }

        $result = [
            'total_min' => $total_min,
            'avg' => $total_min / count($kecamatan)
        ];

        return $result;
    }

    public function persebaran()
    {
        $jenis_faskes = DB::table('datajenis')->get();
        $jam_buka = DB::table('jam_buka')->get();
        return view('persebaran', ['jenis_faskes' => $jenis_faskes, 'jam_buka' => $jam_buka]);
    }

    public function jarakTerdekat($id)
    {
        $min = DB::table('jarak')->where('id_kecamatan', $id)->min('jrk');

        return $min;
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

//19 110
        
    }
}
