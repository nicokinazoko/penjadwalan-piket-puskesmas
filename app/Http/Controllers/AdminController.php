<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;

class AdminController extends Controller
{
    //untuk lihat dashboard utama
    public function viewDashboard()
    {
        $totalDataPiket = AdminModel::getCountDataPiketAndPegawai();
        return view('content.dashboard', ['dataTotal' => $totalDataPiket]);
    }

    // Data Pegawai

    //Untuk lihat data Pegawai
    public function viewDataPegawai()
    {
        $dataPegawai = AdminModel::getAllDataPegawai();
        $dataJumlahData = AdminModel::getCountDataPiketAndPegawai();
        return view('content.pegawai.pegawai-view-data', ['pegawai' => $dataPegawai, 'dataTotal' => $dataJumlahData]);
        // dump($dataJumlahData);

    }

    //Untuk input data Pegawai
    public function inputDataPegawai()
    {
        $dataJenisKelamin = AdminModel::getDataJenisKelamin();
        $dataJabatan = AdminModel::getAllDataJabatan();
        return view('content.pegawai.pegawai-input-data', ['jenisKelamin' => $dataJenisKelamin, 'jabatan' => $dataJabatan]);
    }

    // Proses input data Pegawai
    public static function prosesInputDataPegawai()
    {
    }

    //Untuk view edit data Pegawai
    public function editDataPegawai()
    {
        $dataPegawai = AdminModel::getAllDataPegawai();
        $dataTotal = AdminModel::getCountDataPiketAndPegawai();
        return view('content.pegawai.pegawai-edit-data', ['pegawai' => $dataPegawai, 'dataTotal' => $dataTotal]);
    }

    // Proses edit data Pegawai
    public function prosesEditDataPegawaiById()
    {
    }


    // untuk edit data pegawai base id
    public function editDataPegawaiById($idPegawai)
    {
        return view('content.pegawai.pegawai-edit-data-id');
    }


    //Data Piket

    //untuk melihat data piket
    public function viewDataPiket()
    {
        $dataPiket = AdminModel::getAllDataPiket();
        $totalData = AdminModel::getCountDataPiketAndPegawai();

        return view('content.piket.piket-view-data', ['piket' => $dataPiket, 'dataTotal' => $totalData]);
        // dump($dataPiket);
    }

    //untuk input data piket
    public function inputDataPiket()
    {
        return view('content.piket.piket-input-data');
    }

    // proses input data piket
    public function prosesInputDataPiket(Request $dataPiket)
    {
        $dataPiketRequest = $dataPiket->all();
        $dataInputPiket = AdminModel::inputDataPiket($dataPiketRequest);
        
    }

    //untuk view edit data piket
    public function editDataPiket()
    {
        $dataPiket = AdminModel::getAllDataPiket();
        $dataTotal = AdminModel::getCountDataPiketAndPegawai();
        return view('content.piket.piket-edit-data', ['piket' => $dataPiket, 'dataTotal' => $dataTotal]);
    }

    public function editDataPiketById()
    {
        return view('content.piket.piket-edit-data-id');
    }


    // untuk melihat menu Algoritma memetika
    public function viewAlgoritmaMemetika()
    {
        return view('content.memetic.memetic');
    }

    // untuk melihat menu algoritma neuro fuzzy
    public function viewAlgoritmaNeuroFuzzy()
    {
        return view('content.neuro-fuzzy.neuro-fuzzy');
    }
}
