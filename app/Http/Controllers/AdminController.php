<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //untuk lihat dashboard utama
    public function viewDashboard()
    {
        return view('content.dashboard');
    }

    // Data Pegawai

    //Untuk lihat data Pegawai
    public function viewDataPegawai(){
        return view('content.pegawai.pegawai-view-data');
    }

    //Untuk input data Pegawai
    public function inputDataPegawai(){
        return view('content.pegawai.pegawai-input-data');
    }

    //Untuk edit data Pegawai
    public function editDataPegawai(){
        return view('content.pegawai.pegawai-edit-data');
    }


    //Data Piket

    //untuk melihat data piket
    public function viewDataPiket(){
        return view('content.piket.piket-view-data');
    }

    //untuk input data piket
    public function inputDataPiket(){
        return view('content.piket.piket-input-data');
    }

    //untuk edit data piket
    public function editDataPiket(){
        return view('content.piket.piket-edit-data');
    }

}
