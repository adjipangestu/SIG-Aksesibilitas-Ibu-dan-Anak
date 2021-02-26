<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $jenis_faskes = DB::table('datajenis')->get();
        return view('index', ['jenis_faskes' => $jenis_faskes]);
    }
}
