<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    // untuk lihat dashboard utama
    public function viewDashboard()
    {
        // mengambil jumlah data pegawai dan data piket
        $totalDataPiket = AdminModel::getCountDataPiketAndPegawai();

        // kembali ke view dashboard
        return view('content.dashboard', ['dataTotal' => $totalDataPiket]);
    }


    // --------------- Data Pegawai ---------------

    // Untuk lihat data Pegawai
    public function viewDataPegawai()
    {
        // mengambil semua data pegawai
        $dataPegawai = AdminModel::getAllDataPegawai();

        // mengambil data jumlah pegawai
        $dataJumlahData = AdminModel::getCountDataPiketAndPegawai();

        // kembali ke menu view data pegawai dengan data pegawai dan jumlah data pegawai
        return view('content.pegawai.pegawai-view-data', ['pegawai' => $dataPegawai, 'dataTotal' => $dataJumlahData]);
        // dump($dataJumlahData);

    }

    // Untuk input data Pegawai
    public function inputDataPegawai()
    {
        // ambil data jenis kelamin untuk input
        $dataJenisKelamin = AdminModel::getDataJenisKelamin();

        // ambil data jabatan untuk input
        $dataJabatan = AdminModel::getAllDataJabatan();

        // kembali ke menu input data pegawai dengan data jenis kelamin dan data jabatan
        return view('content.pegawai.pegawai-input-data', ['jenisKelamin' => $dataJenisKelamin, 'jabatan' => $dataJabatan]);
    }

    // Proses input data Pegawai
    public static function prosesInputDataPegawai(Request $dataPegawai)
    {
        // request data pegawai hasil input
        $dataPegawaiRequest = $dataPegawai->all();

        // proses memasukkan data pegawai ke db
        $dataPegawai = AdminModel::inputDataPegawai($dataPegawaiRequest);

        // cek jika ada kesalahan dalam input data
        if (!$dataPegawai) {
            alert()->error('Error', 'Error Input Data');
        } else {
            // alert berhasil untuk input data
            Alert::success('Sukses', 'Input Data telah berhasil !');

            // kembali ke menu view data pegawai
            return redirect()->route('pegawai-view-data');
        }
    }

    //Untuk view edit data Pegawai
    public function editDataPegawai()
    {
        // ambil data pegawai
        $dataPegawai = AdminModel::getAllDataPegawai();

        // ambil data jumlah pegawai dan jumlah piket
        $dataTotal = AdminModel::getCountDataPiketAndPegawai();

        // redirect ke view edit data 
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


    // delete data pegawai by id
    public function deleteDataPegawaiByID($idPegawai)
    {
        $dataPegawaiCari = AdminModel::deleteDataPegawaiByID($idPegawai);
        if ($dataPegawaiCari) {
            Alert::success('Sukses', 'Input Data telah berhasil !');
            return redirect()->route('pegawai-view-data');
        } else {
            alert()->warning('Perhatian', 'Data tidak ditemukan !');
            return redirect()->route('pegawai-view-data');
        }
    }



    // --------------- Data Piket ---------------

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
        Alert::success('Success Title', 'Success Message');
        return redirect()->route('piket-view-data');
    }

    //untuk view edit data piket
    public function editDataPiket()
    {
        $dataPiket = AdminModel::getAllDataPiket();
        $dataTotal = AdminModel::getCountDataPiketAndPegawai();
        return view('content.piket.piket-edit-data', ['piket' => $dataPiket, 'dataTotal' => $dataTotal]);
    }

    public function editDataPiketById($idPiket)
    {
        $cariDataPiketById = AdminModel::getDataPiketById($idPiket);
        // dump($cariDataPiketById);
        if (!$cariDataPiketById) {
            echo "data tidak ada";
        } else {
            return view('content.piket.piket-edit-data-id', ['piket' => $cariDataPiketById]);
        }
    }

    public function prosesEditDataPiketById($idPiket)
    {
    }

    // delete data piket by ID
    public function deleteDataPiketById($idPiket)
    {
        $dataPiketHapus = AdminModel::deleteDataPiketById($idPiket);

        if ($dataPiketHapus) {
            Alert::success('Sukses', 'Delete Data telah berhasil !');
            return redirect()->route('piket-view-data');
        } else {
            alert()->warning('Perhatian', 'Data tidak ditemukan !');
            return redirect()->route('pegawai-view-data');
        }
    }



    // dump($dataPiketHapus);



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
