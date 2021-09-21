<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use DateTime;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    // untuk lihat dashboard utama
    public function viewDashboard()
    {

        // // mengambil jumlah data pegawai dan data piket
        $totalDataPiket = AdminModel::getCountDataPiketAndPegawai();

        if ($totalDataPiket) {
            // kembali ke view dashboard
            return view('content.dashboard', ['dataTotal' => $totalDataPiket]);
        } else {
            alert()->error('Error', 'Ada kesalahan dalam pengambilan data !');
        }
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
    public function prosesEditDataPegawaiById(Request $dataPegawai, $idPegawai)
    {
        $dataPegawaiRequestEdit = $dataPegawai->all();
        // dump($idPegawai);
        // echo "ok";
        $dataPegawaiEdit = AdminModel::editDataPegawai($idPegawai, $dataPegawaiRequestEdit);

        // dump($dataPegawaiEdit);
        if ($dataPegawaiEdit) {
            alert()->success('Edit data Berhasil', 'Berhasil Edit Data');
            return redirect()->route('pegawai-view-data');
        } else {
            alert()->error('Error', 'Ada kesalahan dalam edit data');
        }
    }


    // untuk edit data pegawai base id
    public function editDataPegawaiById($idPegawai)
    {
        $dataJenisKelamin = AdminModel::getDataJenisKelamin();
        $dataJabatan = AdminModel::getAllDataJabatan();
        $dataPegawaiCari = AdminModel::getDataPegawaiById($idPegawai);
        // dump($dataPegawaiCari);
        return view('content.pegawai.pegawai-edit-data-id', [
            'jenisKelamin' => $dataJenisKelamin,
            'jabatan' => $dataJabatan,
            'pegawaiCari' => $dataPegawaiCari
        ]);
    }


    // delete data pegawai by id
    public function deleteDataPegawaiByID($idPegawai)
    {
        // panggil method untuk hapus data pegawai base by Id dari input
        $dataPegawaiCari = AdminModel::deleteDataPegawaiByID($idPegawai);

        // jika data ditemukan
        if ($dataPegawaiCari) {
            // alert berhasil delete data
            Alert::success('Sukses', 'Delete Data telah berhasil !');

            // kembali ke menu view data pegawai
            return redirect()->route('pegawai-view-data');
        } else {
            // alert data gagal dihapus
            alert()->warning('Perhatian', 'Data tidak ditemukan !');

            // kembali ke menu view data pegawai
            return redirect()->route('pegawai-view-data');
        }
    }



    // --------------- Data Piket ---------------

    //untuk melihat data piket
    public function viewDataPiket()
    {
        // mengambil semua data piket
        $dataPiket = AdminModel::getAllDataPiket();

        // mengambil jumlah semua data piket dan data pegawai
        $totalData = AdminModel::getCountDataPiketAndPegawai();

        // kembali ke menu view data piket beserta data
        return view('content.piket.piket-view-data', ['piket' => $dataPiket, 'dataTotal' => $totalData]);
        // dump($dataPiket);
    }


    //untuk view input data piket
    public function inputDataPiket()
    {
        // menuju view input data
        return view('content.piket.piket-input-data');
    }


    // proses input data piket
    public function prosesInputDataPiket(Request $dataPiket)
    {
        // ambil data piket hasil input
        $dataPiketRequest = $dataPiket->all();

        // panggil method untuk input data piket
        $dataInputPiket = AdminModel::inputDataPiket($dataPiketRequest);

        // cek jika proses input berhasil
        if ($dataInputPiket) {
            // menampilkan alert berhasil input data
            Alert::success('Success Title', 'Success Message');

            // kembali ke menu view data piket
            return redirect()->route('piket-view-data');
        } else {
            // menampilkan alert warning data ketika proses input gagal
            alert()->warning('Perhatian', 'Ada kesalahan dalam proses input data !');

            // kembali ke menu
            return redirect()->route('piket-view-data');
        }
    }

    //untuk view edit data piket
    public function editDataPiket()
    {
        // ambil semua data piket
        $dataPiket = AdminModel::getAllDataPiket();

        // ambil semua jumlah data piket dan data pegawai
        $dataTotal = AdminModel::getCountDataPiketAndPegawai();

        // kembali ke menu view data piket
        return view('content.piket.piket-edit-data', ['piket' => $dataPiket, 'dataTotal' => $dataTotal]);
    }

    public function editDataPiketById($idPiket)
    {
        // cari data piket berdasarkan idPiket
        $cariDataPiketById = AdminModel::getDataPiketById($idPiket);

        // cek apakah data ada atau tidak
        if (!empty($cariDataPiketById[0])) {

            return view('content.piket.piket-edit-data-id', ['piket' => $cariDataPiketById]);
        } else {
            // alert data data tidak ditemukan
            alert()->warning('Perhatian', 'Data tidak ditemukan !');
            return redirect()->route('piket-view-data');
        }
    }

    public function prosesEditDataPiketById($idPiket, Request $dataPiket)
    {
        $dataPiketRequestEdit = $dataPiket->all();
        // dump($dataPiketRequestEdit);
        // dump($idPiket);
        $dataPiketEdit = AdminModel::editDataPiket($idPiket, $dataPiketRequestEdit);

        // // dump($dataPiketEdit);
        if ($dataPiketEdit) {
            alert()->success('Edit data Berhasil', 'Berhasil Edit Data');
            return redirect()->route('piket-view-data');
        } else {
            alert()->error('Error', 'Ada kesalahan dalam edit data');
        }
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

        // $waktuAwal = new DateTime('09:00:59');
        // $tesWaktu = date("h:i:sa");
        $dataPegawai = AdminModel::getAllDataPegawai();
        return view('content.memetic.memetic', ['pegawai' => $dataPegawai]);
    }


    // proses Algoritma Memetika
    public function prosesAlgoritmaMemetika(Request $dataMemetika)
    {
        // mengambil semua data dari input
        $dataMemetikaAll = $dataMemetika->all();
        // dump($dataMemetika->all());

        $hasilAlgoritmaMemetika = AdminModel::prosesMemetika($dataMemetikaAll);


        // // mengambil semua data pegawai
        // $dataPegawai = AdminModel::getDataPegawaiAll();
        // // dump($dataPegawai);

        // // mengubah data pegawai menjadi binary
        // $dataPegawaiBiner = AdminModel::dataPegawaiToBiner($dataPegawai);
        // // dump($dataPegawaiBiner);

        // // mengubah data tanggal menjadi binary
        // $dataTanggalBiner = AdminModel::dataTanggalToBiner($dataMemetikaAll['inputBulanPiket']);
        // // dump($dataTanggalBiner);


        // // mengambil semua data piket
        // $dataPiket = AdminModel::getAllDataPiket();

        // // mengubah data piket menjadi binary
        // $dataPiketBiner = AdminModel::dataPiketToBiner($dataPiket);
        // // dump($dataPiketBiner);

        // // generate populasi awal
        // $populasiAwal = AdminModel::generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $dataMemetikaAll);
        // // dump($populasiAwal);

        // // split kromosom menjadi gen
        // $convertKromosomToGen = AdminModel::splitKromosom($populasiAwal);
        // // dump($convertKromosomToGen);

        // // combine gen menjadi kromosom
        // // ini belum begitu perlu
        // // echo "memetika" . '<br>';
        // // $combineGenToKromosom = AdminModel::combineGen($convertKromosomToGen);
        // // dump($combineGenToKromosom);


        // // menghitung nilai fitness
        // // $nilaiFitness = AdminModel::hitungNilaiFitness($convertKromosomToGen, $dataTanggalBiner);
        // // dump($nilaiFitness);

        // // $dataHari = AdminModel::tesHari($convertKromosomToGen, $dataTanggalBiner);
        // // dump($dataHari);



        // $nilaiFitness = AdminModel::hitungTotalNilaiFitness($convertKromosomToGen, $dataTanggalBiner);
        // // dump($nilaiFitness);

        // $kromosomTertinggi = AdminModel::seleksiBasedOnFitness($nilaiFitness);
        // // dump($kromosomTertinggi);

        // $hasilCrossover = AdminModel::singlePointCrossover($kromosomTertinggi, $dataMemetika);
        // // dump($hasilCrossover);

        // $hasilMutasi = AdminModel::bitFlipMutation($hasilCrossover);
    }

    // untuk melihat menu algoritma neuro fuzzy
    public function viewAlgoritmaNeuroFuzzy()
    {
        $dataPegawai = AdminModel::getAllDataPegawai();
        return view('content.neuro-fuzzy.neuro-fuzzy', ['pegawai' => $dataPegawai]);
    }


    public function prosesAlgoritmaNeuroFuzzy(Request $dataNeuroFuzzy)
    {

        // mengambil semua data dari input
        $dataNeuroFuzzyAll = $dataNeuroFuzzy->all();
        // dump($dataNeuroFuzzy);


        // proses algoritma neuro fuzzy
        $hasilAlgoritmaNeuroFuzzy = AdminModel::prosesMemetika($dataNeuroFuzzyAll);

        // // mengambil semua data pegawai
        // $dataPegawai = AdminModel::getDataPegawaiAll();
        // // dump($dataPegawai);

        // // mengubah data pegawai menjadi binary
        // $dataPegawaiBiner = AdminModel::dataPegawaiToBiner($dataPegawai);
        // // dump($dataPegawaiBiner);

        // // mengubah data tanggal menjadi binary
        // $dataTanggalBiner = AdminModel::dataTanggalToBiner($dataNeuroFuzzyAll['inputBulanPiket']);
        // // dump($dataTanggalBiner);


        // // mengambil semua data piket
        // $dataPiket = AdminModel::getAllDataPiket();

        // // mengubah data piket menjadi binary
        // $dataPiketBiner = AdminModel::dataPiketToBiner($dataPiket);
        // // dump($dataPiketBiner);

        // // generate populasi awal
        // $populasiAwal = AdminModel::generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $dataNeuroFuzzyAll);
        // // dump($populasiAwal);

        // // split kromosom menjadi gen
        // $convertKromosomToGen = AdminModel::splitKromosom($populasiAwal);
        // // dump($convertKromosomToGen);

        // // combine gen menjadi kromosom
        // // ini belum begitu perlu
        // // $combineGenToKromosom = AdminModel::combineGen($convertKromosomToGen);
        // // dump($combineGenToKromosom);

        // // menghitung nilai fitness
        // $nilaiFitness = AdminModel::hitungNilaiFitness($convertKromosomToGen, $dataTanggalBiner);
        // // dump($nilaiFitness);


    }
}
