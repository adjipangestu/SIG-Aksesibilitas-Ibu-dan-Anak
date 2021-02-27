<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $jenis_faskes = DB::table('datajenis')->get();
        $jam_buka = DB::table('jam_buka')->get();

        $id_jenis_faskes = !empty($request->jenis_faskes) ? ($request->jenis_faskes) : ('');
        $id_jam_buka = !empty($request->jam_buka) ? ($request->jam_buka) : ('');

        $data = $this->nilai_index($id_jenis_faskes, $id_jam_buka);
        return view('index', ['jenis_faskes' => $jenis_faskes, 'jam_buka' => $jam_buka, 'result' => $data]);
    }

    public function nilai_index($id_jenis_faskes, $id_jam_buka)
    {
        $kecamatan = DB::table('kecamatan')->get();
        $arr = [];

        $total_min = 0;
        foreach ($kecamatan as $key => $value) {
            $total_min += $this->jarakTerdekat($value->id_kecamatan, $id_jenis_faskes, $id_jam_buka);
        }

        $avg = $total_min / count($kecamatan);

        foreach ($kecamatan as $key => $value) {
            $jarak_min = !empty($this->jarakTerdekat($value->id_kecamatan, $id_jenis_faskes, $id_jam_buka)) ? $this->jarakTerdekat($value->id_kecamatan, $id_jenis_faskes, $id_jam_buka) : 0;
            $nilai_index_akses = @($jarak_min / $avg);
            $arr[] = [
                'nama_kecamatan' => $value->nama_kecamatan,
                'min' => $jarak_min,
                'avg' => $avg,
                'total_jarak_min' => $total_min,
                'nilai_index_akses' => !is_nan($nilai_index_akses) ? $nilai_index_akses : 0,
            ];
        }

        $numbers = array_column($arr, 'nilai_index_akses');

        $min = min($numbers);
        $max = max($numbers);
        $rentang = $max - $min / 5;

        $data_rentang = [
            'min' => $min,
            'max' => $max,
            'rentang' => $rentang
        ];

        $result = [];

        foreach ($arr as $key => $value) {
            $result[str_replace(' ', '_', $value['nama_kecamatan'])] = [
                'nama_kecamatan' => $value['nama_kecamatan'],
                'min' => $value['min'],
                'avg' => $value['avg'],
                'total_min' => $value['total_jarak_min'],
                'nilai_akses' => $value['nilai_index_akses'],
                'color' => $this->kelas($data_rentang, $value['nilai_index_akses'])
            ];
        }

        return $result;
    }

    public function kelas($data, $nilai)
    {
        $kelas_satu = $data['max'];
        $kelas_dua = $data['max'] - $data['rentang'];
        $kelas_tiga = $kelas_dua - $data['rentang'];
        $kelas_empat = $kelas_tiga - $data['rentang'];
        $kelas_lima = $data['min'];

        if($nilai >= $kelas_satu){
            return '#0062ff';
        } else if($nilai <= $kelas_satu && $nilai >= $kelas_dua){
            return '#4d91ff';
        } else if($nilai <= $kelas_dua && $nilai >= $kelas_tiga){
            return '#78abff';
        } else if($nilai <= $kelas_tiga && $nilai >= $kelas_empat){
            return '#a6c7ff';
        } else if($nilai <= $kelas_empat && $nilai < $kelas_lima) {
            return '#c7dcff';
        }
    }

    public function rentang($data)
    {
        $numbers = array_column($data, 'nilai_index_akses');

        $min = min($numbers);
        $max = max($numbers);
        
        $result = [
            'min' => $min,
            'max' => $max,
            'rentang' => $max - $min / 5
        ];

        return $result;
    }


    public function persebaran()
    {
        $jenis_faskes = DB::table('datajenis')->get();
        $jam_buka = DB::table('jam_buka')->get();
        return view('persebaran', ['jenis_faskes' => $jenis_faskes, 'jam_buka' => $jam_buka]);
    }

    public function jarakTerdekat($id, $id_jenis_faskes, $id_jam_buka)
    {
        $min = DB::table('jarak')->join('datafaskes', 'datafaskes.id_faskes', '=', 'jarak.id_faskes')->where('id_kecamatan', $id);

        if ($id_jenis_faskes) {
            $min->where('datafaskes.id_jenis_faskes', $id_jenis_faskes);
        }

        if ($id_jam_buka) {
            $min->where('datafaskes.id_jam_buka', $id_jam_buka);
        }

        $data = $min->min('jrk');

        return $data;
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

    public function json()
    {

        $jsonString = file_get_contents(base_path('public/peta.geojson'));
        $data = json_decode($jsonString, true);

        return $data;
        # code...
    }
}
