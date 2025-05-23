<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use DateTime;
use RealRashid\SweetAlert\Facades\Alert;

ini_set('max_execution_time', 1800);

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




    // ===================== Algoritma Memetika =====================

    // untuk melihat menu Algoritma memetika
    public function viewAlgoritmaMemetika()
    {

        // $waktuAwal = new DateTime('09:00:59');
        // $tesWaktu = date("h:i:sa");
        $dataPenjadwalan = AdminModel::getAllDataPenjadwalanMemetika();
        return view('content.memetic.memetic', ['pegawai' => $dataPenjadwalan]);
    }


    // proses Algoritma Memetika
    public function prosesAlgoritmaMemetika(Request $dataMemetika)
    {
        // hitung waktu awal proses
        $waktuEksekusiAwal = microtime(true);

        // mengambil semua data dari input
        $dataMemetikaAll = $dataMemetika->all();
        // dump($dataMemetika->all());

        // lakukan proses algoritma memetika
        $hasilAlgoritmaMemetika = AdminModel::prosesMemetika($dataMemetikaAll);
        // ['piket' => $dataPiket, 'dataTotal' => $dataTotal]


        // dump($hasilAlgoritmaMemetika);

        // simpan data populasi awal sebagai perbandingan
        $populasiAwal = $hasilAlgoritmaMemetika['populasiAwal'];
        // dump($populasiAwal);

        // ini buat biar data duplicate ilang
        // $unique_multi_dimension = array_map("unserialize", array_unique(array_map("serialize", $populasiAwal)));
        // dump($unique_multi_dimension);

        // simpan data populasi akhir sebagai perbandingan
        $populasiAkhir = $hasilAlgoritmaMemetika['populasiAkhir'];
        // dump($populasiAkhir);

        // simpan data fitness di populasi awal
        $fitnessPopulasiAwal = $hasilAlgoritmaMemetika['totalKromosomPopulasiAwal'];
        // dump($fitnessPopulasiAwal);

        // simpan data tanggal
        $dataTanggal = $hasilAlgoritmaMemetika['dataTanggal'];
        // dump($dataTanggal);

        // ambil jumlah hari total
        $jumlahHari = $hasilAlgoritmaMemetika['jumlahHari'];
        // dump($jumlahHari);

        // simpan data fitness di populasi akhir
        $fitnessPopulasiAkhir = $hasilAlgoritmaMemetika['totalKromosomPopulasiAkhir'];
        // dump($fitnessTertinggiPopulasiAkhir);

        // simpan data hasil akhir perhitungan yang akan digunakan sebagai jadwal asli
        $jadwalAkhir = $hasilAlgoritmaMemetika['populasiAkhirPerhitungan'];
        // dump($jadwalAkhir);



        // simpan data pegawai unique
        $dataPegawaiUnique = $hasilAlgoritmaMemetika['dataPegawai'];
        // dump($dataPegawaiUnique);

        // simpan data jumlah pegawai
        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        // // hitung waktu akhir proses
        // $waktuEksekusiAkhir = microtime(true);

        // // hitung selisih waktu proses
        // $selisihWaktu = $waktuEksekusiAkhir - $waktuEksekusiAwal;

        // $executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

        // dump($selisihWaktu, $executionTime);
        // dump(date('l', strtotime($jadwalAkhir[0]['dataPiket'][0]['tanggalPiket'])));

        $executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

        $dataPenjadwalanHasil = [
            'dataInputMemetika' => $dataMemetikaAll,
            'waktuProsesMulai' => microtime(true),
            'waktuProsesSelesai' => $_SERVER["REQUEST_TIME_FLOAT"],
            'waktuProses' => $executionTime,
            'dataTanggal' => $dataTanggal,
            'jumlahHari' => $jumlahHari,
            'jumlahPegawaiUnique' => $jumlahPegawaiUnique,
            'dataPegawai' => $dataPegawaiUnique,
            'populasiAwal' => $populasiAwal,
            'populasiAkhir' => $populasiAkhir,
            'jadwalAkhir' => $jadwalAkhir,
            'totalFitnessPopulasiAwal' => $fitnessPopulasiAwal,
            'totalFitnessPopulasiAkhir' => $fitnessPopulasiAkhir,
        ];

        return view('content.memetic.hasil-memetic', $dataPenjadwalanHasil);

        // return view('content.memetic.hasil-memetic', [
        //     // 'selisihWaktu' => $selisihWaktu,
        //     'jumlahHari' => $jumlahHari,
        //     'dataTanggal' => $dataTanggal,
        //     'jumlahPegawaiUnique' => $jumlahPegawaiUnique,
        //     'dataPegawai' => $dataPegawaiUnique,
        //     'populasiAwal' => $populasiAwal,
        //     'populasiAkhir' => $populasiAkhir,
        //     'jadwalAkhir' => $jadwalAkhir,
        //     'totalFitnessPopulasiAwal' => $fitnessPopulasiAwal,
        //     'totalFitnessPopulasiAkhir' => $fitnessPopulasiAkhir
        // ]);
    }

    public function hasilProsesAlgoritmaMemetika()
    {
        return view('content.memetic.hasil-memetic');
    }



    // lihat data hasil Algoritma Memetika
    public function viewDataHasilAlgoritmaMemetika()
    {
        $dataPenjadwalan = AdminModel::getAllDataPenjadwalanMemetika();
        // dump($dataPenjadwalan);
        return view('content.memetic.view-data-memetic', ['dataPembuatanJadwal' => $dataPenjadwalan]);
    }

    public function prosesSimpanHasilPenjadwalan(Request $dataPenjadwalanMemetika)
    {
        // dump($dataPenjadwalanMemetika->all());
        $hasilData = $dataPenjadwalanMemetika->all();
        // dump($hasilData);
        $dataPenjadwalan = unserialize($hasilData['dataJadwal']);
        // dump($dataPenjadwalan);

        $dataPenjadwalan = unserialize($hasilData['dataJadwal']);
        $dataInputMemetika = unserialize($hasilData['dataInputMemetika']);
        $dataWaktuProses = unserialize($hasilData['waktuProses']);

        // dump($dataPenjadwalan, $dataInputMemetika, $dataWaktuProses);
        // dump($dataWaktuProses);
        // dump(floatval($dataWaktuProses));
        // dump(gettype($dataWaktuProses));

        // $simpanDataPenjadwalan = AdminModel::simpanDataPenjadwalanDatabaseMemetika($dataPenjadwalan);
        $simpanDataPenjadwalan = AdminModel::simpanDataPenjadwalanDatabaseMemetika($dataPenjadwalan, $dataInputMemetika, $dataWaktuProses);
        alert()->success('Simpan Data Berhasil', 'Berhasil Menyimpan Data');
        return redirect()->route('view-data-algoritma-memetika');
    }

    public function getDataPenjadwalanByTanggalPembuatan($tanggalPenjadwalan)
    {
        // dump($tanggalPenjadwalan);
        $dataPenjadwalan = AdminModel::getDataPenjadwalanByTanggalPembuatan($tanggalPenjadwalan);
        // dump($dataPenjadwalan);

        // dump($dataPenjadwalan[12]['dataPiket'][30]['idPiket']);
        $jumlahHari = count($dataPenjadwalan[0]['dataPiket']);

        $dataNilaiFitness = AdminModel::dataNilaiFitness($dataPenjadwalan);
        // dump($jumlahHari);
        return view('content.memetic.view-data-memetic-tanggal-buat', [
            'jumlahHari' => $jumlahHari,
            'dataPenjadwalan' => $dataPenjadwalan,
            'dataNilaiFitness' => $dataNilaiFitness
        ]);
    }

    public function editDataPenjadwalanByIdPenjadwalanMemetika($tanggalPenjadwalan, $idPenjadwalan)
    {
        // dump($tanggalPenjadwalan, $idPenjadwalan);

        $editDataPenjadwalan = AdminModel::editDataPenjadwalanMemetika($idPenjadwalan, $tanggalPenjadwalan);
        // dump($editDataPenjadwalan);

        $dataPiketUnique = AdminModel::getAllDataPiketUnique();
        // dump($dataPiketUnique);

        $jumlahDataPiketUnique = count($dataPiketUnique);
        // dump($jumlahDataPiketUnique);

        $dataPegawai = AdminModel::getDataPegawaiById($editDataPenjadwalan[0]->id_pegawai);
        // dump($dataPegawai);

        return view('content.memetic.form-edit-memetic', [
            'dataPiket' => $dataPiketUnique,
            'dataPenjadwalan' => $editDataPenjadwalan,
            'dataPegawai' => $dataPegawai,
            'jumlahDataPiket' => $jumlahDataPiketUnique
        ]);
    }

    public function prosesEditDataPenjadwalanByIdPenjadwalanMemetika(Request $dataInput)
    {
        $dataPenjadwalan = $dataInput->all();
        $hasilEditDataPenjadwalanMemetika = AdminModel::editDataPenjadwalanMemetikaByIdProses($dataPenjadwalan);
        // dump($hasilEditDataPenjadwalanMemetika);

        alert()->success('Edit data Berhasil', 'Berhasil Edit Data');
        return redirect()->route('view-data-penjadwalan-algoritma-memetika', ['tanggal_pembuatan' => $hasilEditDataPenjadwalanMemetika[0]->tanggal_pembuatan_jadwal]);
    }


    // hapus data penjadwalan memetika
    public function deleteDataPenjadwalanMemetikaByTanggalPembuatanJadwal($tanggalPembuatan)
    {
        // dump($tanggalPembuatan);

        $hapusDataPenjadwalan = AdminModel::deleteDataPenjadwalanMemetika($tanggalPembuatan);
        // dump($dataPenjadwalanCari);
        if ($hapusDataPenjadwalan) {
            alert()->success('Hapus Berhasil', 'Data Telah Berhasil Dihapus');
        } else {
            alert()->error('Oops', 'Data Tidak Ditemukan');
        }
        return redirect()->route('view-data-algoritma-memetika');
    }

    // ===================== Algoritma Neuro Fuzzy =====================
    // untuk melihat menu algoritma neuro fuzzy
    public function viewAlgoritmaNeuroFuzzy()
    {
        $dataPegawai = AdminModel::getAllDataPegawai();
        return view('content.neuro-fuzzy.neuro-fuzzy', ['pegawai' => $dataPegawai]);
    }


    // untuk lihat data penjadwalan
    public function viewDataHasilAlgoritmaNeuroFuzzy()
    {
        $dataPenjadwalan = AdminModel::getAllDataPenjadwalanNeuroFuzzy();
        // dump($dataPenjadwalan);
        return view('content.neuro-fuzzy.view-data-neuro-fuzzy', ['dataPembuatanJadwal' => $dataPenjadwalan]);
    }



    // --------- Ada error di bagian penjadwalan
    // nanti coba di cek lagi
    public function prosesAlgoritmaNeuroFuzzy(Request $dataNeuroFuzzy)
    {
        // mengambil semua data dari input
        $dataNeuroFuzzyAll = $dataNeuroFuzzy->all();
        // dump($dataNeuroFuzzyAll);

        // // lakukan proses algoritma memetika
        // $hasilAlgoritmaMemetika = AdminModel::prosesMemetika($dataMemetikaAll);
        $hasilAlgoritmaNeuroFuzzy = AdminModel::prosesNeuroFuzzy($dataNeuroFuzzyAll);
        // dump($hasilAlgoritmaNeuroFuzzy);
        // // ['piket' => $dataPiket, 'dataTotal' => $dataTotal]


        // simpan data tanggal
        $dataTanggal = $hasilAlgoritmaNeuroFuzzy['dataTanggal'];
        // dump($dataTanggal);


        // simpan data populasi awal sebagai perbandingan
        $populasiAwal = $hasilAlgoritmaNeuroFuzzy['populasiAwal'];
        // dump($populasiAwal);

        // ini buat biar data duplicate ilang
        // $unique_multi_dimension = array_map("unserialize", array_unique(array_map("serialize", $populasiAwal)));
        // dump($unique_multi_dimension);

        // simpan data populasi akhir sebagai perbandingan
        $populasiAkhir = $hasilAlgoritmaNeuroFuzzy['populasiAkhir'];
        // dump($populasiAkhir);

        // simpan data fitness di populasi awal
        $fitnessPopulasiAwal = $hasilAlgoritmaNeuroFuzzy['totalKromosomPopulasiAwal'];
        // dump($fitnessPopulasiAwal);

        // simpan data tanggal
        $dataTanggal = $hasilAlgoritmaNeuroFuzzy['dataTanggal'];
        // dump($dataTanggal);

        // // ambil jumlah hari total
        $jumlahHari = $hasilAlgoritmaNeuroFuzzy['jumlahHari'];
        // dump($jumlahHari);

        // simpan data fitness di populasi akhir
        $fitnessPopulasiAkhir = $hasilAlgoritmaNeuroFuzzy['totalKromosomPopulasiAkhir'];
        // dump($fitnessPopulasiAkhir);

        // simpan data hasil akhir perhitungan yang akan digunakan sebagai jadwal asli
        $jadwalAkhir = $hasilAlgoritmaNeuroFuzzy['populasiAkhirPerhitungan'];
        // dump($jadwalAkhir);



        // simpan data pegawai unique
        $dataPegawaiUnique = $hasilAlgoritmaNeuroFuzzy['dataPegawai'];
        // dump($dataPegawaiUnique);

        // simpan data jumlah pegawai
        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        // dump(date('l', strtotime($jadwalAkhir[0]['dataPiket'][0]['tanggalPiket'])));


        return view('content.neuro-fuzzy.hasil-neuro-fuzzy', [
            'dataTanggal' => $dataTanggal,
            'jumlahHari' => $jumlahHari,
            'jumlahPegawaiUnique' => $jumlahPegawaiUnique,
            'dataPegawai' => $dataPegawaiUnique,
            'populasiAwal' => $populasiAwal,
            'populasiAkhir' => $populasiAkhir,
            'jadwalAkhir' => $jadwalAkhir,
            'totalFitnessPopulasiAwal' => $fitnessPopulasiAwal,
            'totalFitnessPopulasiAkhir' => $fitnessPopulasiAkhir
        ]);
    }

    public function prosesSimpanHasilPenjadwalanNeuroFuzzy(Request $dataPenjadwalanNeuroFuzzy)
    {
        // dump($dataPenjadwalanMemetika->all());
        $hasilData = $dataPenjadwalanNeuroFuzzy->all();
        // dump($hasilData);
        $dataPenjadwalan = unserialize($hasilData['dataJadwal']);
        // dump($dataPenjadwalan);

        $simpanDataPenjadwalan = AdminModel::simpanDataPenjadwalanDatabaseNeuroFuzzy($dataPenjadwalan);
        alert()->success('Simpan Data Berhasil', 'Berhasil Menyimpan Data');
        return redirect()->route('view-data-algoritma-neuro-fuzzy');
    }

    // untuk lihat data penjadwalan berdasarkan tanggal pembuatan jadwal
    public static function getDataPenjadwalanByTanggalPembuatanNeuroFuzzy($tanggalPembuatan)
    {
        $dataPenjadwalanNeuroFuzzy = AdminModel::getDataPenjadwalanNeuroFuzzyByTanggalPembuatanHasil($tanggalPembuatan);
        // dump($dataPenjadwalanNeuroFuzzy);

        // dump($dataPenjadwalan[12]['dataPiket'][30]['idPiket']);
        $jumlahHari = count($dataPenjadwalanNeuroFuzzy[0]['dataPiket']);
        // dump($jumlahHari);
        return view('content.neuro-fuzzy.view-data-neuro-fuzzy-tanggal-buat', [
            'jumlahHari' => $jumlahHari,
            'dataPenjadwalan' => $dataPenjadwalanNeuroFuzzy
        ]);
    }

    // untuk menghapus data penjadwalan
    public function deleteDataPenjadwalanByTanggalPembuatanJadwal($dataTanggalPembuatanJadwal)
    {
        // dump($dataTanggalPembuatanJadwal);

        $dataPenjadwalanCari = AdminModel::deleteDataPenjadwalanNeuroFuzzy($dataTanggalPembuatanJadwal);
        // dump($dataPenjadwalanCari);
        if ($dataPenjadwalanCari) {

            alert()->success('Hapus Berhasil', 'Data Telah Berhasil Dihapus');
        } else {
            alert()->error('Oops', 'Data Tidak Ditemukan');
        }
        return redirect()->route('view-data-algoritma-neuro-fuzzy');
    }

    // untuk edit data penjadwalan
    public static function editDataPenjadwalanByIdPenjadwalanNeuroFuzzy($tanggalPenjadwalan, $idPenjadwalan)
    {
        // dump($tanggalPenjadwalan, $idPenjadwalan);

        $editDataPenjadwalan = AdminModel::editDataPenjadwalanNeuroFuzzy($idPenjadwalan, $tanggalPenjadwalan);
        // dump($editDataPenjadwalan);

        $dataPiketUnique = AdminModel::getAllDataPiketUnique();
        // dump($dataPiketUnique);

        $jumlahDataPiketUnique = count($dataPiketUnique);
        // dump($jumlahDataPiketUnique);

        $dataPegawai = AdminModel::getDataPegawaiById($editDataPenjadwalan[0]->id_pegawai);
        // dump($dataPegawai);

        return view('content.neuro-fuzzy.form-edit-neuro-fuzzy', [
            'dataPiket' => $dataPiketUnique,
            'dataPenjadwalan' => $editDataPenjadwalan,
            'dataPegawai' => $dataPegawai,
            'jumlahDataPiket' => $jumlahDataPiketUnique
        ]);
    }

    public function prosesEditDataPenjadwalanByIdPenjadwalanNeuroFuzzy(Request $dataPenjadwalanNeuroFuzzy)
    {
        $dataPenjadwalan = $dataPenjadwalanNeuroFuzzy->all();
        $hasilEditDataPenjadwalanNeuroFuzzy = AdminModel::editDataPenjadwalanNeuroFuzzyByIdProses($dataPenjadwalan);
        // dump($hasilEditDataPenjadwalanNeuroFuzzy);


        alert()->success('Edit data Berhasil', 'Berhasil Edit Data');

        return redirect()->route('view-data-penjadwalan-algoritma-neuro-fuzzy', ['tanggal_pembuatan' => $hasilEditDataPenjadwalanNeuroFuzzy[0]->tanggal_pembuatan_jadwal]);
    }



    // ===================== Algoritma Genetika =====================

    public function viewAlgoritmaGenetika()
    {
        // $dataPegawai = AdminModel::getAllDataPegawai();
        // return view('content.genetika.genetika', ['pegawai' => $dataPegawai]);
        return view('content.genetika.genetika');
    }



    // untuk lihat data penjadwalan
    public function viewDataHasilAlgoritmaGenetika()
    {
        $dataPenjadwalan = AdminModel::getAllDataPenjadwalanGenetika();
        // dump($dataPenjadwalan);
        return view('content.genetika.view-data-genetika', ['dataPembuatanJadwal' => $dataPenjadwalan]);
    }



    // --------- Ada error di bagian penjadwalan
    // nanti coba di cek lagi
    public function prosesAlgoritmaGenetika(Request $dataGenetika)
    {
        // mengambil semua data dari input
        $dataGenetikaAll = $dataGenetika->all();
        // dump($dataGenetikaAll);

        // lakukan proses algoritma memetika
        // $hasilAlgoritmaMemetika = AdminModel::prosesMemetika($dataMemetikaAll);
        $hasilAlgoritmaGenetika = AdminModel::prosesGenetika($dataGenetikaAll);
        // dump($hasilAlgoritmaGenetika);
        // ['piket' => $dataPiket, 'dataTotal' => $dataTotal]


        // simpan data tanggal
        $dataTanggal = $hasilAlgoritmaGenetika['dataTanggal'];
        // dump($dataTanggal);


        // simpan data populasi awal sebagai perbandingan
        $populasiAwal = $hasilAlgoritmaGenetika['populasiAwal'];
        // dump($populasiAwal);

        // ======= gak kepake ========
        // ini buat biar data duplicate ilang
        // $unique_multi_dimension = array_map("unserialize", array_unique(array_map("serialize", $populasiAwal)));
        // dump($unique_multi_dimension);

        // simpan data populasi akhir sebagai perbandingan
        $populasiAkhir = $hasilAlgoritmaGenetika['populasiAkhir'];
        // dump($populasiAkhir);

        // simpan data fitness di populasi awal
        $fitnessPopulasiAwal = $hasilAlgoritmaGenetika['totalKromosomPopulasiAwal'];
        // dump($fitnessPopulasiAwal);

        // simpan data tanggal
        $dataTanggal = $hasilAlgoritmaGenetika['dataTanggal'];
        // dump($dataTanggal);

        // // ambil jumlah hari total
        $jumlahHari = $hasilAlgoritmaGenetika['jumlahHari'];
        // dump($jumlahHari);

        // simpan data fitness di populasi akhir
        $fitnessPopulasiAkhir = $hasilAlgoritmaGenetika['totalKromosomPopulasiAkhir'];
        // dump($fitnessPopulasiAkhir);

        // simpan data hasil akhir perhitungan yang akan digunakan sebagai jadwal asli
        $jadwalAkhir = $hasilAlgoritmaGenetika['populasiAkhirPerhitungan'];
        // dump($jadwalAkhir);



        // simpan data pegawai unique
        $dataPegawaiUnique = $hasilAlgoritmaGenetika['dataPegawai'];
        // dump($dataPegawaiUnique);

        // simpan data jumlah pegawai
        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        // // dump(date('l', strtotime($jadwalAkhir[0]['dataPiket'][0]['tanggalPiket'])));

        $executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

        // dump($executionTime, microtime(true), $_SERVER["REQUEST_TIME_FLOAT"]);

        $dataPenjadwalanHasil = [
            'dataInputGenetika' => $dataGenetikaAll,
            'waktuProsesMulai' => microtime(true),
            'waktuProsesSelesai' => $_SERVER["REQUEST_TIME_FLOAT"],
            'waktuProses' => $executionTime,
            'dataTanggal' => $dataTanggal,
            'jumlahHari' => $jumlahHari,
            'jumlahPegawaiUnique' => $jumlahPegawaiUnique,
            'dataPegawai' => $dataPegawaiUnique,
            'populasiAwal' => $populasiAwal,
            'populasiAkhir' => $populasiAkhir,
            'jadwalAkhir' => $jadwalAkhir,
            'totalFitnessPopulasiAwal' => $fitnessPopulasiAwal,
            'totalFitnessPopulasiAkhir' => $fitnessPopulasiAkhir,
        ];

        // dump($dataPenjadwalanHasil);


        return view('content.genetika.hasil-genetika', $dataPenjadwalanHasil);
        // return view('content.genetika.hasil-genetika', [
        //     'waktuProsesMulai' => microtime(true),
        //     'waktuProsesSelesai' => $_SERVER["REQUEST_TIME_FLOAT"],
        //     'waktuProses' => $executionTime,
        //     'dataTanggal' => $dataTanggal,
        //     'jumlahHari' => $jumlahHari,
        //     'jumlahPegawaiUnique' => $jumlahPegawaiUnique,
        //     'dataPegawai' => $dataPegawaiUnique,
        //     'populasiAwal' => $populasiAwal,
        //     'populasiAkhir' => $populasiAkhir,
        //     'jadwalAkhir' => $jadwalAkhir,
        //     'totalFitnessPopulasiAwal' => $fitnessPopulasiAwal,
        //     'totalFitnessPopulasiAkhir' => $fitnessPopulasiAkhir
        // ]);
    }

    public function prosesSimpanHasilPenjadwalanGenetika(Request $dataPenjadwalanGenetika)
    {
        // dump($dataPenjadwalanGenetika->all());
        $hasilData = $dataPenjadwalanGenetika->all();
        // dump($hasilData);
        $dataPenjadwalan = unserialize($hasilData['dataJadwal']);
        $dataInputGenetika = unserialize($hasilData['dataInputGenetika']);
        $dataWaktuProses = unserialize($hasilData['waktuProses']);

        // dump($dataPenjadwalan, $dataInputGenetika, $dataWaktuProses);

        $simpanDataPenjadwalan = AdminModel::simpanDataPenjadwalanDatabaseGenetika($dataPenjadwalan, $dataInputGenetika, $dataWaktuProses);
        alert()->success('Simpan Data Berhasil', 'Berhasil Menyimpan Data');
        return redirect()->route('view-data-algoritma-genetika');
    }

    // untuk lihat data penjadwalan berdasarkan tanggal pembuatan jadwal
    public static function getDataPenjadwalanByTanggalPembuatanGenetika($tanggalPembuatan)
    {
        $dataPenjadwalanGenetika = AdminModel::getDataPenjadwalanByTanggalPembuatanGenetikaBaru($tanggalPembuatan);
        // dump($dataPenjadwalanGenetika);

        // dump($dataPenjadwalan[12]['dataPiket'][30]['idPiket']);
        $jumlahHari = count($dataPenjadwalanGenetika[0]['dataPiket']);

        $dataNilaiFitness = AdminModel::dataNilaiFitness($dataPenjadwalanGenetika);
        // dump($jumlahHari);
        // dump($dataNilaiFitness);
        return view('content.genetika.view-data-genetika-tanggal-buat', [
            'jumlahHari' => $jumlahHari,
            'dataPenjadwalan' => $dataPenjadwalanGenetika,
            'dataNilaiFitness' => $dataNilaiFitness
        ]);
    }

    // untuk menghapus data penjadwalan
    public function deleteDataPenjadwalanByTanggalPembuatanJadwalGenetika($dataTanggalPembuatanJadwal)
    {
        // dump($dataTanggalPembuatanJadwal);

        $dataPenjadwalanCari = AdminModel::deleteDataPenjadwalanGenetika($dataTanggalPembuatanJadwal);
        // dump($dataPenjadwalanCari);
        if ($dataPenjadwalanCari) {

            alert()->success('Hapus Berhasil', 'Data Telah Berhasil Dihapus');
        } else {
            alert()->error('Oops', 'Data Tidak Ditemukan');
        }
        return redirect()->route('view-data-algoritma-genetika');
    }

    // untuk edit data penjadwalan
    public static function editDataPenjadwalanByIdPenjadwalanGenetika($tanggalPenjadwalan, $idPenjadwalan)
    {
        // dump($tanggalPenjadwalan, $idPenjadwalan);

        $editDataPenjadwalan = AdminModel::editDataPenjadwalanGenetika($idPenjadwalan, $tanggalPenjadwalan);
        // dump($editDataPenjadwalan);

        $dataPiketUnique = AdminModel::getAllDataPiketUnique();
        // dump($dataPiketUnique);

        $jumlahDataPiketUnique = count($dataPiketUnique);
        // dump($jumlahDataPiketUnique);

        $dataPegawai = AdminModel::getDataPegawaiById($editDataPenjadwalan[0]->id_pegawai);
        // dump($dataPegawai);

        return view('content.genetika.form-edit-genetika', [
            'dataPiket' => $dataPiketUnique,
            'dataPenjadwalan' => $editDataPenjadwalan,
            'dataPegawai' => $dataPegawai,
            'jumlahDataPiket' => $jumlahDataPiketUnique
        ]);
    }

    public function prosesEditDataPenjadwalanByIdPenjadwalanGenetika(Request $dataPenjadwalanGenetika)
    {
        $dataPenjadwalan = $dataPenjadwalanGenetika->all();
        $hasilEditDataPenjadwalanGenetika = AdminModel::editDataPenjadwalanGenetikayByIdProses($dataPenjadwalan);
        // dump($hasilEditDataPenjadwalanNeuroFuzzy);


        alert()->success('Edit data Berhasil', 'Berhasil Edit Data');

        return redirect()->route('view-data-penjadwalan-algoritma-genetika', ['tanggal_pembuatan' => $hasilEditDataPenjadwalanGenetika[0]->tanggal_pembuatan_jadwal]);
    }

    // ------------------- Algoritma Memetika --------------------------------

    // lihat hasil perhitungan algoritma Memetika
    public static function lihatPerhitunganMemetika()
    {

        $dataPerhitunganMemetika = AdminModel::getAllDataPerhitunganMemetika();
        // dump($dataPerhitunganMemetika);

        $dataWaktu = AdminModel::getDataPerhitunganMemetikaWithSelisihWaktu();

        // $i = 0;
        // foreach ($dataWaktu as $dataWaktuProses) {

        //     $dataProses[$i] = floatval($dataWaktuProses->selisih_waktu);
        //     $i++;
        // }

        // dump($dataProses);
        return view(
            'content.memetic.view-data-perhitungan-memetika',
            ['dataPerhitunganMemetika' => $dataPerhitunganMemetika]
            // ,['dataWaktu' => $dataProses]
        );
        // return view('content.genetika.view-data-perhitungan-genetika', ['dataPerhitunganGenetika' => $dataPerhitunganGenetika]);
    }

    // lihat hasil perhitungan memetika berdasarkan tanggal penjadwalan
    public static function lihatPerhitunganMemetikaByTanggalPenjadwalan($tanggalPembuatanJadwal)
    {
        // dump($tanggalPembuatanJadwal);
        $dataPerhitungan = AdminModel::getDataPerhitunganMemetikaByTanggalPembuatan($tanggalPembuatanJadwal);
        // dump($dataPerhitungan);
        return view('content.memetic.view-data-perhitungan-tanggal-memetika', ['dataPerhitunganMemetika' => $dataPerhitungan]);
    }


    // ------------------- Algoritma Genetika --------------------------------
    // lihat hasil perhitungan algoritma genetika
    public static function lihatPerhitunganGenetika()
    {
        $dataPerhitunganGenetika = AdminModel::getAllDataPerhitunganGenetika();
        // dump($dataPerhitunganGenetika);

        return view('content.genetika.view-data-perhitungan-genetika', ['dataPerhitunganGenetika' => $dataPerhitunganGenetika]);
    }

    // lihat hasil perhitungan memetika berdasarkan tanggal penjadwalan
    public static function lihatPerhitunganGenetikaByTanggalPenjadwalan($tanggalPembuatanJadwal)
    {
        // dump($tanggalPembuatanJadwal);
        $dataPerhitungan = AdminModel::getDataPerhitunganGenetikaByTanggalPembuatan($tanggalPembuatanJadwal);
        // dump($dataPerhitungan);
        // dump($dataPerhitungan);
        return view('content.genetika.view-data-perhitungan-tanggal-genetika', ['dataPerhitunganGenetika' => $dataPerhitungan]);
    }
}
