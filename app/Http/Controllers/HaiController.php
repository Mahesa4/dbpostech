<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaiController extends Controller
{
    public function index(Request $request, $nik, $nama)
    {
        $result = "Hai ".$nama." dengan NIK "
                    .$nik." dan id ".$request->id;
        return $result;
    }
}
