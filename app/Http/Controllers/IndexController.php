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

    public function nilai_akses(Request $request)
    {
        $id_jenis_faskes = !empty($request->jenis_faskes) ? ($request->jenis_faskes) : ('');
        $id_jam_buka = !empty($request->jam_buka) ? ($request->jam_buka) : ('');

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
                'id' => $value->id_kecamatan,
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
        $rentang = ($max - $min) / 4;

        $data_rentang = [
            'min' => $min,
            'max' => $max,
            'rentang' => $rentang
        ];

        $result = [];

        foreach ($arr as $key => $value) {
            $result[$value['id']] = [
                'id' => $value['id'],
                'nama_kecamatan' => $value['nama_kecamatan'],
                'min' => $value['min'],
                'avg' => $value['avg'],
                'total_min' => $value['total_jarak_min'],
                'nilai_akses' => $value['nilai_index_akses'],
                'color' => $this->kelas($data_rentang, $value['nilai_index_akses']),
            ];
        }

        return response()->json($result, 200);
    }

    public function json(Request $request)
    {
        
        $id_jenis_faskes = !empty($request->jenis_faskes) ? ($request->jenis_faskes) : ('');
        $id_jam_buka = !empty($request->jam_buka) ? ($request->jam_buka) : ('');

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
                'id' => $value->id_kecamatan,
                'nama_kecamatan' => $value->nama_kecamatan,
                'min' => $jarak_min,
                'avg' => $avg,
                'total_jarak_min' => $total_min,
                'nilai_index_akses' => !is_nan($nilai_index_akses) ? $nilai_index_akses : 0,
                'coordinates' => json_decode($value->coordinates)
            ];
        }

        $numbers = array_column($arr, 'nilai_index_akses');

        $min = min($numbers);
        $max = max($numbers);
        $rentang = ($max - $min) / 4;

        $data_rentang = [
            'min' => $min,
            'max' => $max,
            'rentang' => $rentang
        ];

        $kelas_satu = $data_rentang['max'];
        $kelas_dua = $kelas_satu - $data_rentang['rentang'];
        $kelas_tiga = $kelas_dua - $data_rentang['rentang'];
        $kelas_empat = $kelas_tiga - $data_rentang['rentang'];
        $kelas_lima = $data_rentang['min'];

        $kelas = [
            '1' => $kelas_satu,
            '2' => $kelas_dua,
            '3' => $kelas_tiga,
            '4' => $kelas_empat,
            '5' => $kelas_lima 
        ];

        // return $kelas;

        $result = [];

        foreach ($arr as $key => $value) {
            $result[] = [
                'id' => $value['id'],
                'nama_kecamatan' => $value['nama_kecamatan'],
                'min' => $value['min'],
                'avg' => $value['avg'],
                'total_min' => $value['total_jarak_min'],
                'nilai_akses' => $value['nilai_index_akses'],
                'color' => $this->kelas($data_rentang, $value['nilai_index_akses']),
                'coordinates' => $value['coordinates'],
            ];
        }
        
        $features = [];

        foreach ($result as $key => $value) {
            $features[] = [
                'type' => 'Feature',
                'properties' => [
                    'id' => $value['id'],
                    'nama_kecamatan' => $value['nama_kecamatan'],
                    'min' => $value['min'],
                    'avg' => $value['avg'],
                    'total_min' => $value['total_min'],
                    'nilai_akses' => $value['nilai_akses'],
                    'color' => $value['color'],
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => array($value['coordinates'])
                ]
            ];
        }
        $json = [
            'type' => "FeatureCollection",
            'features' => $features
        ];

        

        return $json;
    }

    public function kelas($data_rentang, $nilai)
    {

        $kelas_satu = $data['max'];
        $kelas_dua = $kelas_satu- $data['rentang'];
        $kelas_tiga = $kelas_dua - $data['rentang'];
        $kelas_empat = $kelas_tiga - $data['rentang'];
        $kelas_lima = $data['min'];


        if($nilai >=$kelas_lima && $nilai <=$kelas_empat){
            return '#FBE8E7' ; //0.074587107-0.856229546 (terang)
        } else if($nilai >$kelas_empat && $nilai <=$kelas_tiga){
            return '#FFA690'; //0.856229546-1.637871984
        } else if($nilai >$kelas_tiga && $nilai <=$kelas_dua){
            return '#FF6542'; //1.637871984- 2.419514423
        } else if($nilai >$kelas_dua && $nilai <=$kelas_satu) {
            return '#BF130A'; //2.419514423 - 3.201156861 (gelap)
        }

        $kelas_satu = $data_rentang['max'];
        $kelas_dua = $kelas_satu - $data_rentang['rentang'];
        $kelas_tiga = $kelas_dua - $data_rentang['rentang'];
        $kelas_empat = $kelas_tiga - $data_rentang['rentang'];
        $kelas_lima = $data_rentang['min'];

        
        $color = '#fff';
        if($nilai >= $kelas_lima && $nilai <= $kelas_empat){
            $color = '#bbd4fc';
        } else if($nilai > $kelas_empat && $nilai <= $kelas_tiga){
            $color = '#70a7ff';
        } else if($nilai > $kelas_tiga && $nilai <= $kelas_dua){
            $color = '#3773d4';
        } else if($nilai > $kelas_dua && $nilai <= $kelas_satu){
            $color =  '#0343ab';
        }

        return $color;
    }

    public function rentang($data)
    {
        $numbers = array_column($data, 'nilai_index_akses');

        $min = min($numbers);
        $max = max($numbers);
        
        $result = [
            'min' => $min,
            'max' => $max,
            'rentang' => ($max - $min) / 4,
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
        
    }
}
