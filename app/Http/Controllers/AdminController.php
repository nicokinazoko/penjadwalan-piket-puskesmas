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
    public function viewDataPegawai()
    {
        return view('content.pegawai.pegawai-view-data');
    }

    //Untuk input data Pegawai
    public function inputDataPegawai()
    {
        return view('content.pegawai.pegawai-input-data');
    }

    //Untuk view edit data Pegawai
    public function editDataPegawai()
    {
        return view('content.pegawai.pegawai-edit-data');
    }

    // untuk edit data pegawai base id
    public function editDataPegawaiById()
    {
        return view('content.pegawai.pegawai-edit-data-id');
    }


    //Data Piket

    //untuk melihat data piket
    public function viewDataPiket()
    {
        return view('content.piket.piket-view-data');
    }

    //untuk input data piket
    public function inputDataPiket()
    {
        return view('content.piket.piket-input-data');
    }

    //untuk view edit data piket
    public function editDataPiket()
    {
        return view('content.piket.piket-edit-data');
    }

    public function editDataPiketById()
    {
        return view('content.piket.piket-edit-data-id');
    }


    // untuk melihat menu Algoritma memetika
    public function viewAlgoritmaMemetika(){
        return view('content.memetic.memetic');
    }

    // untuk melihat menu algoritma neuro fuzzy
    public function viewAlgoritmaNeuroFuzzy(){
        return view('content.neuro-fuzzy.neuro-fuzzy');
    }
}
