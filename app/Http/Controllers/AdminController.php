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

        // $a = [4, 6, 2, 1, 5];
        // $b = [5, 3, 1, 9, 2];

        // function tesArray($a, $b, $x)
        // {
        //     $point = $x;
        //     $array_a = $a;
        //     $array_b = $b;
        //     $total_array_a = count($a);
        //     $total_array_b = count($b);
        //     $replace_array_a = [];
        //     $replace_array_b = [];
        //     $array_a_sementara = [];
        //     $array_b_sementara = [];

        //     echo $x;

        //     for ($i = $point - 1; $i < $total_array_a; $i++) {
        //         $replace_array_a[$i] = $array_a[$i];
        //         $replace_array_b[$i] = $array_b[$i];
        //         // $array_b_sementara = array_push($replace_array_b, $array_a_sementara);
        //         // $new_array_b = array_replace($array_b, $replace_array_b);
        //     }
        //     // print_r($replace_array_a);
        //     // echo '<br>';

        //     echo "Sebelum di replace" . '<br>';
        //     print_r($array_a);
        //     echo '<br>';

        //     print_r($array_b);
        //     echo '<br>';

        //     echo "Setelah di replace" . '<br>';

        //     $new_array_a = array_replace($array_a, $replace_array_b);
        //     print_r($new_array_a);
        //     echo '<br>';

        //     $new_array_b = array_replace($array_b, $replace_array_a);
        //     print_r($new_array_b);
        //     echo '<br>';
        //     // return print_r($new_array_a);
        //     tesArray($a, $b, rand(0, 5));
        // }

        // $waktuAkhir = new DateTime('09:20:00');
        // $selisih = $waktuAwal->diff($waktuAkhir);
        // echo $selisih->format(' %h %i %s  second(s)');

        // echo "<br>";
        // echo date("h:i:sa") . $tesWaktu;
        // echo "<br>";
        // // echo $tesWaktu - date("h:i:sa");
        // echo "<br>";

        // $t = time();
        // echo ($t . "<br>");
        // echo "<br>";
        // echo (date("Y-m-d", $t));

        // echo "<br>";
        // $tesWatku2 = new DateTime();
        // echo $tesWatku2->format('H:i:s') . date("H:i:s");
        // echo "<br>";
        // $time1 = new DateTime('09:00:59');
        // $time2 = new DateTime('12:10:30');
        // $interval = $time1->diff($time2);
        // echo $interval->format('%h Hours %i Minutes %ssecond(s)');
    }


    // proses Algoritma Memetika
    public function prosesAlgoritmaMemetika(Request $dataMemetika)
    {
        // mengambil semua data dari input
        $dataMemetikaAll = $dataMemetika->all();
        // dump($dataMemetika->all());

        // mengambil semua data pegawai
        $dataPegawai = AdminModel::getDataPegawaiAll();
        // dump($dataPegawai);

        // mengubah data pegawai menjadi binary
        $dataPegawaiBiner = AdminModel::dataPegawaiToBiner($dataPegawai);
        // dump($dataPegawaiBiner);

        // mengubah data tanggal menjadi binary
        $dataTanggalBiner = AdminModel::dataTanggalToBiner($dataMemetikaAll['inputBulanPiket']);
        // dump($dataTanggalBiner);


        // mengambil semua data piket
        $dataPiket = AdminModel::getAllDataPiket();

        // mengubah data piket menjadi binary
        $dataPiketBiner = AdminModel::dataPiketToBiner($dataPiket);
        // dump($dataPiketBiner);

        // generate populasi awal
        $populasiAwal = AdminModel::generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $dataMemetikaAll);
        // dump($populasiAwal);

        // split kromosom menjadi gen
        $convertKromosomToGen = AdminModel::splitKromosom($populasiAwal);
        // dump($convertKromosomToGen);

        // combine gen menjadi kromosom
        // ini belum begitu perlu
        echo "memetika" . '<br>';
        // $combineGenToKromosom = AdminModel::combineGen($convertKromosomToGen);
        // dump($combineGenToKromosom);


        // menghitung nilai fitness
        // $nilaiFitness = AdminModel::hitungNilaiFitness($convertKromosomToGen, $dataTanggalBiner);
        // dump($nilaiFitness);

        // $dataHari = AdminModel::tesHari($convertKromosomToGen, $dataTanggalBiner);
        // dump($dataHari);

        $nilaiFitness = AdminModel::hitungTotalNilaiFitness($convertKromosomToGen, $dataTanggalBiner);
        // dump($nilaiFitness);
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

        // mengambil semua data pegawai
        $dataPegawai = AdminModel::getDataPegawaiAll();
        // dump($dataPegawai);

        // mengubah data pegawai menjadi binary
        $dataPegawaiBiner = AdminModel::dataPegawaiToBiner($dataPegawai);
        // dump($dataPegawaiBiner);

        // mengubah data tanggal menjadi binary
        $dataTanggalBiner = AdminModel::dataTanggalToBiner($dataNeuroFuzzyAll['inputBulanPiket']);
        // dump($dataTanggalBiner);


        // mengambil semua data piket
        $dataPiket = AdminModel::getAllDataPiket();

        // mengubah data piket menjadi binary
        $dataPiketBiner = AdminModel::dataPiketToBiner($dataPiket);
        // dump($dataPiketBiner);

        // generate populasi awal
        $populasiAwal = AdminModel::generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $dataNeuroFuzzyAll);
        // dump($populasiAwal);

        // split kromosom menjadi gen
        $convertKromosomToGen = AdminModel::splitKromosom($populasiAwal);
        // dump($convertKromosomToGen);

        // combine gen menjadi kromosom
        // ini belum begitu perlu
        // $combineGenToKromosom = AdminModel::combineGen($convertKromosomToGen);
        // dump($combineGenToKromosom);

        // menghitung nilai fitness
        $nilaiFitness = AdminModel::hitungNilaiFitness($convertKromosomToGen, $dataTanggalBiner);
        // dump($nilaiFitness);


    }
}
