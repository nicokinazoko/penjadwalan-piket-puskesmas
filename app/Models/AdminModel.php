<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminModel extends Model
{
    use HasFactory;


    // ambil data jumlah yang telah diinput
    public static function getCountDataPiketAndPegawai()
    {
        // menghitung jumlah data pegawai di tabel pegawai
        $jumlahDataPegawai = DB::table('pegawais')->count();

        // menghitung jumlah data piket di tabel piket
        $jumlahDataPiket = DB::table('pikets')->count();

        // memasukkan data jumlah ke array
        $jumlahData = [
            'dataPegawai' => $jumlahDataPegawai,
            'dataPiket' => $jumlahDataPiket
        ];

        return $jumlahData;
    }




    // ---------- Data Piket -----------

    // ambil semua data jabatan
    public static function getAllDataJabatan()
    {
        $dataJabatan = DB::table('jabatans')
            ->orderBy('nama_jabatan')
            ->get();
        return $dataJabatan;
    }

    // ambil semua data piket
    public static function getAllDataPiket()
    {
        $dataPiket = DB::table('pikets')->get();

        return $dataPiket;
        // dump($dataPiket);
    }

    // cari data piket berdasarkan Id
    public static function getDataPiketById($idPiket)
    {
        $dataPiketCari = DB::table('pikets')
            ->where('id_piket', '=', $idPiket)
            ->get();

        return $dataPiketCari;
        // dump($dataPiketCari);
    }



    // input data piket
    public static function inputDataPiket($inputPiket)
    {
        // untuk menghilangkan array _token dari input
        unset($inputPiket['_token']);
        // echo $piket['_token'];
        $dataPiket = [
            'kode_piket' => $inputPiket['inputKodePiket'],
            'nama_piket' => $inputPiket['inputNamaPiket']
        ];
        $inputDataPiket = DB::table('pikets')->insertGetId($dataPiket);

        return $inputDataPiket;
    }

    // edit data piket
    public static function editDataPiket($idPiket, $dataPiket)
    {
        unset($dataPiket['_token'], $dataPiket['_method']);
        // dump($dataPiket);
        $dataPiketUpdate = [
            'kode_piket' => $dataPiket['inputKodePiket'],
            'nama_piket' => $dataPiket['inputNamaPiket']
        ];
        // dump($dataPiketUpdate);

        $dataPiketHasilUpdate = DB::table('pikets')
            ->where('id_piket', $idPiket)
            ->update($dataPiketUpdate);

        return $dataPiketHasilUpdate;
    }

    // hapus data piket
    public static function deleteDataPiketById($idPiket)
    {
        $deleteDataPiket = DB::table('pikets')
            ->where('id_piket', '=',  $idPiket)
            ->delete();

        // dump($deleteDataPiket);
    }




    // ---------- Data Pegawai -----------
    // ambil semua data pegawai
    public static function getAllDataPegawai()
    {
        $dataPegawai = DB::table('pegawais')
            ->join('jenis_kelamins', 'pegawais.id_jenis_kelamin', '=', 'jenis_kelamins.id_jenis_kelamin')
            ->join('jabatans', 'pegawais.id_jabatan', '=', 'jabatans.id_jabatan')
            ->get();

        return $dataPegawai;
    }

    // ambil data pegawai mentah
    public static function getDataPegawaiAll()
    {
        $dataPegawai = DB::table('pegawais')->get();

        return $dataPegawai;
    }

    // cari data pegawai berdasarkan Id
    public static function getDataPegawaiById($idPegawai)
    {
        $dataPegawaiCari = DB::table('pegawais')
            ->where('id_pegawai', $idPegawai)
            ->get();

        return $dataPegawaiCari;
        // dump($dataPiketCari);
    }

    // input data pegawai
    public static function inputDataPegawai($inputPegawai)
    {
        // menghilangkan array token dari input
        unset($inputPegawai['_token']);

        // membuat array untuk menampung hasil input pegawai yang akan dimasukkan ke db
        $dataPegawai = [
            'nama_pegawai' => $inputPegawai['inputNamaPegawai'],
            'id_jenis_kelamin' => $inputPegawai['inputJenisKelaminPegawai'],
            'id_jabatan' => $inputPegawai['inputJabatanPegawai']
        ];

        // memasukkan data ke db pegawais menggunakan query builder
        $inputDataPegawai = DB::table('pegawais')->insertGetId($dataPegawai);

        return $inputDataPegawai;
    }

    // edit data piket
    public static function editDataPegawai($idPegawai, $dataPegawai)
    {
        // menghilangkan elemen _method dari array
        unset($dataPegawai['_method'], $dataPegawai['_token']);
        // dump($dataPegawai);

        // memasukkan data ke dalam array
        $dataPegawaiUpdate = [
            'nama_pegawai' => $dataPegawai['inputNamaPegawai'],
            'id_jenis_kelamin' => $dataPegawai['inputJenisKelaminPegawai'],
            'id_jabatan' => $dataPegawai['inputJabatanPegawai']
        ];
        // dump($dataPegawaiUpdate);

        // memasukkan data ke db
        $dataPegawaiHasilUpdate = DB::table('pegawais')
            ->where('id_pegawai', $idPegawai)
            ->update($dataPegawaiUpdate);

        return $dataPegawaiHasilUpdate;
    }

    // hapus data piket
    public static function deleteDataPegawaiById($idPegawai)
    {
        $dataPegawaiHapus = DB::table('pegawais')
            ->where('id_pegawai', '=', $idPegawai)
            ->delete();

        return $dataPegawaiHapus;
    }

    // ambil data jenis kelamin
    public static function getDataJenisKelamin()
    {
        $result = DB::table('jenis_kelamins')->get();

        return $result;
    }

    // ---------- Data Penjadwalan -----------

    // ambil semua data penjadwalan
    public static function getAllDataPenjadwalan()
    {
    }

    // input data piket
    public static function inputDataPenjadwalan()
    {
    }

    // edit data piket
    public static function editDataPenjadwalan()
    {
    }

    // hapus data piket
    public static function deleteDataPenjadwalan()
    {
    }

    // ---------- Ubah Data ke Biner -----------

    // ubah data pegawai ke biner
    public static function dataPegawaiToBiner($dataPegawai)
    {
        // deklarasi variabel array untuk penyimpanan
        $dataPegawaiBiner = [];

        for ($i = 0; $i < count($dataPegawai); $i++) {
            // convert dari id_pegawai desimal menjadi binary
            $dataPegawaiBiner[$i] = decbin($dataPegawai[$i]->id_pegawai);

            // untuk menambah bit 0
            // agar sesuai dengan semua array
            $dataPegawaiBiner[$i] = str_pad($dataPegawaiBiner[$i], 6, '0', STR_PAD_LEFT);
        }

        return $dataPegawaiBiner;
    }

    // ubah data tanggal ke biner
    public static function dataTanggalToBiner($dataTanggal)
    {
        // deklarasi variabel array untuk penyimpanan
        $dataTanggalBiner = [];
        $dataTanggalTotal = [];

        // dump($dataTanggal);
        // untuk memisah antara tahun dan bulan
        $tanggal = explode('-', $dataTanggal);
        // echo $tanggal[0];

        // untuk konversi dari input bulan dan tahun ke total hari
        $totalHari = cal_days_in_month(CAL_GREGORIAN, $tanggal[1], $tanggal[0]);

        for ($i = 0; $i < $totalHari; $i++) {
            // untuk mengubah dari number menjadi binary
            $dataTanggalBiner[$i] = decbin($i + 1);

            // untuk menambah bit 0
            // agar sesuai dengan semua array
            $dataTanggalBiner[$i] = str_pad($dataTanggalBiner[$i], 6, '0', STR_PAD_LEFT);
        }

        // mendapat data nama bulan
        $month_name = date("F", mktime(0, 0, 0, $tanggal[1]));

        // masukkan data tanggal ke array
        $dataTanggalTotal = [
            'namaBulan' => $month_name,
            'nomorBulan' => $tanggal[1],
            'hari' => $dataTanggalBiner,
            'tahun' => $tanggal[0]
        ];
        // dump($dataTanggalTotal);

        return $dataTanggalTotal;
    }


    // convert data piket ke biner
    public static function dataPiketToBiner($dataPiket)
    {
        $dataPiketBiner = [];

        // dump($dataPiket);

        for ($i = 0; $i < count($dataPiket); $i++) {

            // mengubah data id_piket dari desimal menjadi binary
            $dataPiketBiner[$i] = decbin($dataPiket[$i]->id_piket);

            // untuk menambah bit 0
            // agar sesuai dengan semua array
            $dataPiketBiner[$i] = str_pad($dataPiketBiner[$i], 6, '0', STR_PAD_LEFT);
        }

        return $dataPiketBiner;
    }

    public static function generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $jumlahPopulasi)
    {

        // memasukkan data jumlah populasi variabel
        $jumlahPopulasi = $jumlahPopulasi;

        // menghitung total data di array
        $jumlahDataPegawaiBiner = count($dataPegawaiBiner);

        // menghitung total data di array
        $jumlahDataPiketBiner = count($dataPiketBiner);

        // menghitung total data di array
        $jumlahDataTanggalBiner = count($dataTanggalBiner['hari']);

        // deklarasi variabel array untuk penyimpanan
        $kromosom = [];
        // $kromosom_convert = [];
        $nilaiFitness = 0;

        for ($i = 0; $i < $jumlahPopulasi; $i++) {

            // random id_pegawai untuk menjadi gen
            $indexRandomPegawai = mt_rand(0, $jumlahDataPegawaiBiner - 1);

            // random id_piket untuk menjadi gen
            $indexRandomPiket = mt_rand(0, $jumlahDataPiketBiner - 1);

            // random tanggal untuk menjadi gen
            $indexRandomTanggalBiner = mt_rand(0, $jumlahDataTanggalBiner - 1);

            // memasukkan data gen ke dalam satu kromosom
            $kromosom[$i]['kromosom'] = $dataPegawaiBiner[$indexRandomPegawai] . $dataPiketBiner[$indexRandomPiket] . $dataTanggalBiner['hari'][$indexRandomTanggalBiner];

            // membuat elemen baru untuk menyimpan data nilai fitness
            $kromosom[$i]['nilaiFitness'] = $nilaiFitness;
        }

        return $kromosom;
    }

    // untuk memisah kromom menjadi gen
    public static function splitKromosom($kromosom)
    {
        // deklarasi array untuk menyimpan data
        $kromosomConvert = [];
        for ($i = 0; $i < count($kromosom); $i++) {

            // memasukkan data kromosom ke array baru
            $kromosomConvert[$i]['kromosom'] = $kromosom[$i]['kromosom'];

            // memasukkan data nilai fitness ke kromosom baru
            $kromosomConvert[$i]['nilaiFitness'] = $kromosom[$i]['nilaiFitness'];

            // memisahkan kromosom menjadi tiga bagian dengan panjang 6
            $kromosomConvert[$i]['gen'] = str_split($kromosom[$i]['kromosom'], 6);
            // $kromosomConvert[$i]['gen']['idPegawai'] = $kromosomConvert[$i]['gen'][0];

            // $array = array(33 => $oldarray[0], 37 => $oldarray[1]);
            // $array = array('test' => $oldarray[0], 'test2' => $oldarray[1]);
        }
        return $kromosomConvert;
    }

    // combine gen untuk menjadi kromosom
    public static function combineGen($kromosom)
    {
        for ($i = 0; $i < count($kromosom); $i++) {
            // menggabungkan
            $kromosom[$i]['kromosom'] = $kromosom[$i]['gen'][0] . $kromosom[$i]['gen'][1] . $kromosom[$i]['gen'][2];
            unset($kromosom[$i]['gen']);
        }
        return $kromosom;
    }

    // ini coding ulang
    // ada kesalahan di bagian cek data
    public static function hitungNilaiFitness($kromosom, $dataTanggal)
    {
        // echo date("l", mktime(0, 0, 0, 8, 31, 2021));
        // $tanggal = date("l", mktime(0,0,0,$dataTanggal['hari'][1],$dataTanggal['nomorBulan'],$dataTanggal['tahun']));
        // echo $tanggal;

        $totalSatu = '';
        $totalDua = '';
        $totalTiga = '';
        $totalEmpat = '';

        // $tanggalKromosom = date("l", mktime(0, 0, 0, 1, 10, 2021));
        // echo $tanggalKromosom;

        // $totalDays = cal_days_in_month(CAL_GREGORIAN, $dataTanggal['nomorBulan'], $dataTanggal['tahun']);
        // for ($i = 1; $i <= $totalDays; $i++) {
        //     $tanggalKromosom = date("l", mktime(0, 0, 0, $i, $dataTanggal['nomorBulan'], $dataTanggal['tahun']));
        //     echo $tanggalKromosom . ' ' . $i . ' ' . $dataTanggal['nomorBulan'] . ' ' . $dataTanggal['tahun'] . '<br>';
        // }

        // start menghitung nilai fitness masing-masing kromosom
        for ($i = 0; $i < count($kromosom); $i++) {

            // convert data tanggal menjadi nama hari
            $tanggalKromosom = date("l", mktime(0, 0, 0, $dataTanggal['nomorBulan'],  $kromosom[$i]['gen'][2], $dataTanggal['tahun']));
            // dump($tanggalKromosom);

            // cek apakah ada data pegawai di tabel pegawai
            $dataPegawai = AdminModel::getDataPegawaiById(bindec($kromosom[$i]['gen'][0]));
            $dataPiket = Adminmodel::getDataPiketById(bindec($kromosom[$i]['gen'][1]));

            // if(bindec($kromosom[$i]['gen'][2]) <= 7 || bindec($kromosom[$i]['gen'][2]) >= 14 || bindec($kromosom[$i]['gen'][2]) <= 21){
            //     dump($kromosom[$i]);
            // }
            // jika ada data pegawai
            if ($dataPegawai) {
                // tambah nilai fitness
                $kromosom[$i]['nilaiFitness']++;

                // cek data untuk dr. Amelia
                // id = 10 = 001010
                // tanggal 24 prolanis = 35
                // RPU senin rabu jumat = 18 = 010010
                // R infeksius selasa kamis sabtu = 21 = 010101
                // binary untuk RPU = 001010010010
                // binary untuk R.Inf = 001010010101
                if ($dataPegawai[0]->nama_pegawai === "dr. Amelia") {
                    if ($dataPiket[0]->kode_piket === "Prolanis") {
                        if (bindec($kromosom[$i]['gen'][2]) === 24) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    } else
                    if ($dataPiket[0]->kode_piket === "RPU") {
                        if (
                            $tanggalKromosom === "Monday" || $tanggalKromosom === "Wednesday" ||
                            $tanggalKromosom === "Friday"
                        ) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    } else
                    if ($dataPiket[0]->kode_piket === "R.Inf") {
                        if (
                            $tanggalKromosom === "Tuesday" || $tanggalKromosom === "Thursday" ||
                            $tanggalKromosom === "Saturday"
                        ) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    }
                }

                // cek untuk data dr. Dwi Bhakti P
                // RPU selasa, kamis, sabtu = 18 = 010010
                // R infeksius senin, rabu jumat = 21 = 010101
                // binary untuk RPU = 001010010010
                // binary untuk R.Inf = 001010010101

                if ($dataPegawai[0]->nama_pegawai === 'dr. Dwi Bhakti P') {
                    if ($dataPiket[0]->kode_piket === "RPU") {
                        if (
                            $tanggalKromosom === "Tuesday" || $tanggalKromosom === "Thursday" ||
                            $tanggalKromosom === "Saturday"
                        ) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    } else
                        if ($dataPiket[0]->kode_piket === "R.Inf") {
                        if (
                            $tanggalKromosom === "Monday" || $tanggalKromosom === "Wednesday" ||
                            $tanggalKromosom === "Friday"
                        ) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    }
                }


                // cek untuk data Nely Puspita
                // Selasa pertama dengan Kamis ketiga, Posbindu
                // id pegawai 13
                // dump($dataPegawai);
                if ($dataPegawai[0]->nama_pegawai === 'Nely Puspita') {
                    if ($dataPiket[0]->kode_piket == 'PB') {
                        if (
                            bindec($kromosom[$i]['gen'][2]) <= 7 ||
                            (bindec($kromosom[$i]['gen'][2]) <= 21 &&
                                bindec($kromosom[$i]['gen'][2]) >= 14)
                        ) {
                            if ($tanggalKromosom === 'Tuesday' || $tanggalKromosom === 'Thursday') {
                                $kromosom[$i]['nilaiFitness']++;
                            } else {
                                $kromosom[$i]['nilaiFitness']--;
                            }
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    } else {
                        // jika piket != PB
                        // ini masih belum tau gimana ngitung fitness nya
                        // $kromosom[$i]['nilaiFitness']--;
                    }
                }
            } else {
                // kurangi nilai fitness
                $kromosom[$i]['nilaiFitness']--;
            }

            // cek apakah jadwal ada di hari minggu
            // hari minggu = hari libur
            // jadi tidak kerja
            if ($tanggalKromosom === 'Sunday') {

                // kurangi nilai fitness
                $kromosom[$i]['nilaiFitness']--;
            } else {

                // tambah nilai fitness
                $kromosom[$i]['nilaiFitness']++;
            }


            if ($kromosom[$i]['nilaiFitness'] > 2) {
                echo "Lebih dari 2 <br>";
                $totalSatu++;
                echo $kromosom[$i]['nilaiFitness'] . '<br>';
                echo $dataPegawai[0]->nama_pegawai . '<br>';
                echo $dataPiket[0]->kode_piket . '<br>';
                echo $tanggalKromosom . '<br>';
                echo bindec($kromosom[$i]['gen'][2]) . ' , ' . $dataTanggal['nomorBulan'] . '<br> <br>';
            } else
            if ($kromosom[$i]['nilaiFitness'] <= 2 && $kromosom[$i]['nilaiFitness'] > 0) {
                $totalDua++;
            } else
            if ($kromosom[$i]['nilaiFitness'] <= 0) {
                $totalTiga++;
            }
            // else {
            //     if ($kromosom[$i]['nilaiFitness'] ) {
            //         $totalEmpat++;
            //     }
            // }


        }
        echo 'Total > 2 = ' . $totalSatu . ', Total > 0 = ' . $totalDua . ', Total < 0 = ' . $totalTiga;



        // echo $dataPegawai[0]->id_pegawai;
        // dump($dataPegawai);
        // dump($kromosom);

        return $kromosom;
        // return $tanggal;
        // return $dataTanggal;
        // dump($tanggal);
        // dump($dataTanggal);
    }

    public static function tesHari($kromosom, $dataTanggal)
    {
        $tanggalKromosom = date("l", mktime(0, 0, 0, 1, 10, 2021));
        echo $tanggalKromosom . '<br>';


        $totalDays = cal_days_in_month(CAL_GREGORIAN, $dataTanggal['nomorBulan'], $dataTanggal['tahun']);

        foreach ($kromosom as $dataKromosom) {
            $tanggalKromosom = date("l", mktime(0, 0, 0, bindec($dataKromosom['gen'][2]), $dataTanggal['nomorBulan'], $dataTanggal['tahun']));
            echo $tanggalKromosom . ' ' . bindec($dataKromosom['gen'][2]) . ' ' . $dataTanggal['nomorBulan'] . ' ' . $dataTanggal['tahun'] . '<br>';
        }


        // for ($i = 1; $i <= $totalDays; $i++) {
        //     $tanggalKromosom = date("l", mktime(0, 0, 0, $i, $dataTanggal['nomorBulan'], $dataTanggal['tahun']));
        //     echo $tanggalKromosom . ' ' . $i . ' ' . $dataTanggal['nomorBulan'] . ' ' . $dataTanggal['tahun'] . '<br>';
        // }
    }

    public static function hitungTotalNilaiFitness($kromosom, $dataTanggal)
    {
        $totalTiga = 0;
        $totalDua = 0;
        $totalSatu = 0;
        $totalNol = 0;
        $totalMinSatu = 0;
        $hitungFitnessKromosom = [];
        $i = 0;
        $jumlahKromosom = count($kromosom);
        echo $jumlahKromosom;

        for ($i = 0; $i < $jumlahKromosom; $i++) {

            // untuk mengambil data pegawai berdasarkan id pegawai dari kromosom
            $dataPegawai = AdminModel::getDataPegawaiById(bindec($kromosom[$i]['gen'][0]));
            // untuk mengambil data pegawai berdasarkan id piket dari kromosom
            $dataPiket = Adminmodel::getDataPiketById(bindec($kromosom[$i]['gen'][1]));

            // untuk mengambil data hari berdasarkan binary tanggal dari kromosom
            $tanggalKromosom = date("l", mktime(0, 0, 0, $dataTanggal['nomorBulan'], bindec($kromosom[$i]['gen'][2]), $dataTanggal['tahun']));


            if ($dataPegawai !== [] && $dataPiket !== []) {


                if ($tanggalKromosom === 'Sunday') {
                    $kromosom[$i]['nilaiFitness']--;
                } else {
                    $kromosom[$i]['nilaiFitness']++;
                }

                // constraint untuk dr Amelia
                // Tanggal 24, prolanis
                // RPU senin rabu jumat
                // R Inf selasa kamis sabtu

                if ($dataPegawai[0]->nama_pegawai == 'dr. Amelia') {
                    $kromosom[$i]['nilaiFitness']++;

                    if ($dataPiket[0]->kode_piket === 'Prolanis') {
                        if (bindec($kromosom[$i]['gen'][2]) === 24) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    } else
                            if ($dataPiket[0]->kode_piket === 'RPU') {
                        if (
                            $tanggalKromosom === 'Monday' || $tanggalKromosom === 'Wednesday'
                            || $tanggalKromosom === 'Friday'
                        ) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    } else
                            if ($dataPiket[0]->kode_piket === 'R.Inf') {
                        if (
                            $tanggalKromosom === 'Tuesday' || $tanggalKromosom === 'Thursday'
                            || $tanggalKromosom === 'Saturday'
                        ) {
                            $kromosom[$i]['nilaiFitness']++;
                        } else {
                            $kromosom[$i]['nilaiFitness']--;
                        }
                    }
                } else

                    // constraint untuk dr Amelia
                    // RPU selasa, kamis, sabtu
                    // R infeksius senin, rabu jumat

                    if ($dataPegawai[0]->nama_pegawai === 'dr. Dwi Bhakti P') {
                        $kromosom[$i]['nilaiFitness']++;
                        if ($dataPiket[0]->kode_piket === 'RPU') {
                            if (
                                $tanggalKromosom === 'Tuesday' || $tanggalKromosom === 'Thursday'
                                || $tanggalKromosom === 'Saturday'
                            ) {
                                $kromosom[$i]['nilaiFitness']++;
                            } else {
                                $kromosom[$i]['nilaiFitness']--;
                            }
                        } else
                            if ($dataPiket[0]->kode_piket === 'R.Inf') {
                            if (
                                $tanggalKromosom === 'Monday' || $tanggalKromosom === 'Wednesday'
                                || $tanggalKromosom === 'Friday'
                            ) {
                                $kromosom[$i]['nilaiFitness']++;
                            } else {
                                $kromosom[$i]['nilaiFitness']--;
                            }
                        }
                    }

                    // constraint untuk Eni Sud
                    // Sabtu kedua, posbindu


                    else
                            if ($dataPegawai[0]->nama_pegawai === 'Eni Sudaryati') {
                        $kromosom[$i]['nilaiFitness']++;
                        if ($dataPiket[0]->kode_piket === 'PB') {
                            if (
                                $tanggalKromosom === 'Saturday' &&
                                bindec($kromosom[$i]['gen'][2]) >= 7 &&
                                bindec($kromosom[$i]['gen'][2]) <= 14
                            ) {
                                $kromosom[$i]['nilaiFitness']++;
                            } else {
                                $kromosom[$i]['nilaiFitness']--;
                            }
                        }
                    } else

                        // constraint untuk Nely Puspita
                        // Selasa pertama dengan Kamis ketiga, Posbindu

                        if ($dataPegawai[0]->nama_pegawai === 'Nely Puspita') {
                            $kromosom[$i]['nilaiFitness']++;
                            if ($dataPiket[0]->kode_piket === 'PB') {
                                if (
                                    ($tanggalKromosom === 'Tuesday'
                                        && bindec($kromosom[$i]['gen'][2]) <= 7)
                                    ||
                                    ($tanggalKromosom === 'Thursday'
                                        && bindec($kromosom[$i]['gen'][2]) >= 7
                                        && bindec($kromosom[$i]['gen'][2]) <= 14)
                                ) {
                                    $kromosom[$i]['nilaiFitness']++;
                                } else {
                                    $kromosom[$i]['nilaiFitness']--;
                                }
                            }
                        } else

                            // constaint Martiningsih
                            // Kamis keempat, senin kedua, posbindu
                            // Sabtu ketiga, KKR

                            if ($dataPegawai[0]->nama_pegawai === 'Martiningsih') {
                                $kromosom[$i]['nilaiFitness']++;
                                if ($dataPiket[0]->kode_piket === 'PB') {
                                    if (($tanggalKromosom === 'Thursday'
                                            && bindec($kromosom[$i]['gen'][2]) >= 21)
                                        ||
                                        ($tanggalKromosom === 'Monday'
                                            && bindec($kromosom[$i]['gen'][2]) >= 7
                                            && bindec($kromosom[$i]['gen'][2]) <= 14)
                                    ) {
                                        $kromosom[$i]['nilaiFitness']++;
                                    } else {
                                        $kromosom[$i]['nilaiFitness']--;
                                    }
                                }
                            } else

                                // constraint untuk Endah lestari
                                // Setiap senin, Ruang Infeksius

                                if ($dataPegawai[0]->nama_pegawai === 'Endah Lestari') {
                                    $kromosom[$i]['nilaiFitness']++;
                                    if ($dataPiket[0]->kode_piket === "R.Inf") {
                                        if ($tanggalKromosom === 'Monday') {
                                            $kromosom[$i]['nilaiFitness']++;
                                        } else {
                                            $kromosom[$i]['nilaiFitness']--;
                                        }
                                    }
                                } else

                                    // constraint untuk Eni setioningsih
                                    // Setiap kamis jumat bendahara

                                    if ($dataPegawai[0]->nama_pegawai === 'Eni Setioningsih') {
                                        $kromosom[$i]['nilaiFitness']++;
                                        if ($dataPiket[0]->kode_piket === "BDH") {
                                            if ($tanggalKromosom === 'Thursday' || $tanggalKromosom === 'Friday') {
                                                $kromosom[$i]['nilaiFitness']++;
                                            } else {
                                                $kromosom[$i]['nilaiFitness']--;
                                            }
                                        }
                                    } else

                                        // Rabu minggu pertama, posbindu
                                        // Sabtu ketiga, rutan
                                        // Tanggal 24, prolanis
                                        // Setiap rabu, PKD , ini PKD gak tau apa

                                        if ($dataPegawai[0]->nama_pegawai === 'Margi Yuwono') {
                                            $kromosom[$i]['nilaiFitness']++;
                                            if ($dataPiket[0]->kode_piket === 'PB') {
                                                if (
                                                    $tanggalKromosom === 'Wednesday'
                                                    && bindec($kromosom[$i]['gen'][2]) <= 7
                                                ) {
                                                    $kromosom[$i]['nilaiFitness']++;
                                                } else {
                                                    $kromosom[$i]['nilaiFitness']--;
                                                }
                                            } else
                                                    if ($dataPiket[0]->kode_piket === 'LP') {
                                                // Sabtu ketiga, rutan
                                                if (
                                                    $tanggalKromosom === 'Saturday'
                                                    && bindec($kromosom[$i]['gen'][2]) >= 14
                                                    && bindec($kromosom[$i]['gen'][2]) <= 21
                                                ) {
                                                    $kromosom[$i]['nilaiFitness']++;
                                                } else {
                                                    $kromosom[$i]['nilaiFitness']--;
                                                }
                                            } else
                                                    if ($dataPiket[0]->kode_piket === 'Prolanis') {
                                                // Tanggal 24, prolanis
                                                if (bindec($kromosom[$i]['gen'][2]) === 24) {
                                                    $kromosom[$i]['nilaiFitness']++;
                                                } else {
                                                    $kromosom[$i]['nilaiFitness']--;
                                                }
                                            } else
                                                    if ($dataPiket[0]->kode_piket === 'PKD') {
                                            }
                                        } else

                                            // constraint untuk Ari S
                                            // Sabtu ketiga senin keempat, posbindu
                                            if ($dataPegawai[0]->nama_pegawai === 'Ari S') {
                                                $kromosom[$i]['nilaiFitness']++;
                                                if ($dataPiket[0]->kode_piket === 'PB') {
                                                    if (($tanggalKromosom === 'Saturday'
                                                            && bindec($kromosom[$i]['gen'][2]) >= 14
                                                            && bindec($kromosom[$i]['gen'][2]) <= 21)
                                                        ||
                                                        ($tanggalKromosom === 'Monday'
                                                            && bindec($kromosom[$i]['gen'][2]) >= 21)
                                                    ) {
                                                        $kromosom[$i]['nilaiFitness']++;
                                                    } else {
                                                        $kromosom[$i]['nilaiFitness']--;
                                                    }
                                                }
                                            } else

                                                // constraint untuk Suripah
                                                // Selasa keempat, posbindu

                                                if ($dataPegawai[0]->nama_pegawai === 'Suripah') {
                                                    $kromosom[$i]['nilaiFitness']++;
                                                    if ($dataPiket[0]->kode_piket === 'PB') {
                                                        if (
                                                            $tanggalKromosom === 'Tuesday'
                                                            && bindec($kromosom[$i]['gen'][2]) >= 21
                                                        ) {
                                                            $kromosom[$i]['nilaiFitness']++;
                                                        } else {
                                                            $kromosom[$i]['nilaiFitness']--;
                                                        }
                                                    }
                                                } else
                                                    // constraint untuk Heriah
                                                    // Senin MTBS

                                                    if ($dataPegawai[0]->nama_pegawai === 'Heriyah Safari') {
                                                        $kromosom[$i]['nilaiFitness']++;
                                                        if ($dataPiket[0]->kode_piket === "Mtbs/RT") {
                                                            if (
                                                                $tanggalKromosom === 'Monday'
                                                            ) {
                                                                $kromosom[$i]['nilaiFitness']++;
                                                            } else {
                                                                $kromosom[$i]['nilaiFitness']--;
                                                            }
                                                        }
                                                    } else
                                                        // constraint untuk Ukhulul
                                                        // Setiap hari surveillance
                                                        // Selalu surveillance

                                                        if ($dataPegawai[0]->nama_pegawai === "Ukhulul") {
                                                            $kromosom[$i]['nilaiFitness']++;
                                                            if ($dataPiket[0]->kode_piket === "Surveillance") {
                                                                $kromosom[$i]['nilaiFitness']++;
                                                            } else {
                                                                $kromosom[$i]['nilaiFitness']--;
                                                            }
                                                        } else
                                                            // Tanggal 24, prolanis
                                                            // Setiap senin RPU

                                                            if ($dataPegawai[0]->nama_pegawai === 'Anisa') {
                                                                $kromosom[$i]['nilaiFitness']++;
                                                                if ($dataPiket[0]->kode_piket === 'RPU') {
                                                                    if ($tanggalKromosom === 'Monday') {
                                                                        $kromosom[$i]['nilaiFitness']++;
                                                                    } else {
                                                                        $kromosom[$i]['nilaiFitness']--;
                                                                    }
                                                                } else
                                                                        if ($dataPiket[0]->kode_piket === 'Prolanis') {
                                                                    if (bindec($kromosom[$i]['gen'][2]) === 24) {
                                                                        $kromosom[$i]['nilaiFitness']++;
                                                                    } else {
                                                                        $kromosom[$i]['nilaiFitness']--;
                                                                    }
                                                                } else {
                                                                    $kromosom[$i]['nilaiFitness']--;
                                                                }
                                                            }
            } else {
                $kromosom[$i]['nilaiFitness']--;
            }
        }




        $hitungFitnessKromosom = $kromosom;
        return $kromosom;
    }

    // error baru
    // kalo data gak sesuai dengan jumlah total array nanti offset 0
    // akalinnya pake di kasih batasan dulu di bagian ambil base id nya

    // hitung nilai fitness baru
    public static function hitungNilaiFitnessBaru($kromosom, $dataTanggal)
    {
        $jumlahKromosom = count($kromosom);
        // echo $jumlahKromosom;

        // menghitung nilai fitness sebanyak jumlah kromosom
        for ($i = 0; $i < $jumlahKromosom; $i++) {

            // ambil data pegawai dari database
            // $dataPegawai[$i] = AdminModel::getDataPegawaiById(bindec($kromosom[$i]['gen'][0]));
            $dataPegawai[$i] = AdminModel::getDataPegawaiById(15);
            // ambil data piket dari database

            // $dataPiket[$i] = Adminmodel::getDataPiketById(bindec($kromosom[$i]['gen'][1]));
            $dataPiket[$i] = Adminmodel::getDataPiketById(17);

            // echo $dataPegawai[$i][0]->nama_pegawai;
            // ambil data tanggal dari input
            $tanggalKromosom[$i] = date("l", mktime(0, 0, 0, $dataTanggal['nomorBulan'], bindec($kromosom[$i]['gen'][2]), $dataTanggal['tahun']));

            // dump($dataPegawai[$i]);
            // $dataKromosom[$i] = [
            //     'idPegawai' => $dataPegawai[$i][0]->id_pegawai,
            //     'namaPegawai' => $dataPegawai[$i][0]->nama_pegawai,
            //     'idPiket' => $dataPiket[$i][0]->id_piket,
            //     'namaPiket' => $dataPiket[$i][0]->kode_piket
            // ];
            // dump($dataKromosom[$i]);

            // dump($dataPegawai[$i][0]);
            // echo $dataPegawai[$i][0]->nama_pegawai . '<br>';
            // if($dataPegawai[$i][0]->nama_pegawai === "dr. Dwi Bhakti P"){
            //     echo "Ada datanya";
            // }

            // cek apakah data pegawai tidak ada di database
            // jika tidak ada fitness - 1
            // if ($dataPegawai[$i] === []) {

            //     // nilai fitness -1
            //     $kromosom[$i]['nilaiFitness']--;
            // } else {

            //     // jika data pegawai ada di database
            //     // cek apakah data piket tidak ada di database
            //     // jika tidak ada fitness - 1
            //     if ($dataPiket[$i] === []) {

            //         // nilai fitness -1
            //         $kromosom[$i]['nilaiFitness']--;
            //     } else {
            //         // jika data ada di db

            //         // jika hari Minggu, libur maka fitness - 1
            //         if ($tanggalKromosom[$i] === "Sunday") {
            //             $kromosom[$i]['nilaiFitness']--;
            //             // dump($kromosom[$i]);
            //         } else {
            //             $kromosom[$i]['nilaiFitness']++;


            //             // constraint untuk dr Amelia
            //             // Tanggal 24, prolanis
            //             // RPU senin rabu jumat
            //             // R Inf selasa kamis sabtu
            //             if ($dataPegawai[$i][0]->nama_pegawai === "dr. Amelia") {
            //                 $kromosom[$i]['nilaiFitness']++;
            //                 // dump($kromosom[$i]);
            //                 if ($dataPiket[$i][0]->kode_piket === 'Prolanis') {
            //                     if (bindec($kromosom[$i]['gen'][2]) === 24) {
            //                         $kromosom[$i]['nilaiFitness']++;
            //                     } else {
            //                         $kromosom[$i]['nilaiFitness']--;
            //                     }
            //                 } else
            //                 if ($dataPiket[$i][0]->kode_piket === 'RPU') {
            //                     if (
            //                         $tanggalKromosom[$i] === 'Monday' || $tanggalKromosom[$i] === 'Wednesday'
            //                         || $tanggalKromosom[$i] === 'Friday'
            //                     ) {
            //                         $kromosom[$i]['nilaiFitness']++;
            //                     } else {
            //                         $kromosom[$i]['nilaiFitness']--;
            //                     }
            //                 } else
            //                 if ($dataPiket[$i][0]->kode_piket === 'R.Inf') {
            //                     if (
            //                         $tanggalKromosom[$i] === 'Tuesday' || $tanggalKromosom[$i] === 'Thursday'
            //                         || $tanggalKromosom[$i] === 'Saturday'
            //                     ) {
            //                         $kromosom[$i]['nilaiFitness']++;
            //                     } else {
            //                         $kromosom[$i]['nilaiFitness']--;
            //                     }
            //                 }
            //             } else

            //                 // constraint untuk dr. Dwi Bhakti P
            //                 // RPU selasa, kamis, sabtu
            //                 // R infeksius senin, rabu jumat

            //                 if ($dataPegawai[$i][0]->nama_pegawai === 'dr. Dwi Bhakti P') {
            //                     $kromosom[$i]['nilaiFitness']++;
            //                     if ($dataPiket[$i][0]->kode_piket === 'RPU') {
            //                         if (
            //                             $tanggalKromosom[$i] === 'Tuesday' || $tanggalKromosom[$i] === 'Thursday'
            //                             || $tanggalKromosom[$i] === 'Saturday'
            //                         ) {
            //                             $kromosom[$i]['nilaiFitness']++;
            //                         } else {
            //                             $kromosom[$i]['nilaiFitness']--;
            //                         }
            //                     } else
            //                 if ($dataPiket[$i][0]->kode_piket === 'R.Inf') {
            //                         if (
            //                             $tanggalKromosom[$i] === 'Monday' || $tanggalKromosom[$i] === 'Wednesday'
            //                             || $tanggalKromosom[$i] === 'Friday'
            //                         ) {
            //                             $kromosom[$i]['nilaiFitness']++;
            //                         } else {
            //                             $kromosom[$i]['nilaiFitness']--;
            //                         }
            //                     }
            //                 } else

            //                     // constraint untuk Eni Sud
            //                     // Sabtu kedua, posbindu


            //                     if ($dataPegawai[$i][0]->nama_pegawai === 'Eni Sudaryati') {
            //                         $kromosom[$i]['nilaiFitness']++;
            //                         if ($dataPiket[$i][0]->kode_piket === 'PB') {
            //                             if (
            //                                 $tanggalKromosom[$i] === 'Saturday' &&
            //                                 bindec($kromosom[$i]['gen'][2]) >= 7 &&
            //                                 bindec($kromosom[$i]['gen'][2]) <= 14
            //                             ) {
            //                                 $kromosom[$i]['nilaiFitness']++;
            //                             } else {
            //                                 $kromosom[$i]['nilaiFitness']--;
            //                             }
            //                         }
            //                     } else

            //                         // constraint untuk Nely Puspita
            //                         // Selasa pertama dengan Kamis ketiga, Posbindu

            //                         if ($dataPegawai[$i][0]->nama_pegawai === 'Nely Puspita') {
            //                             $kromosom[$i]['nilaiFitness']++;
            //                             if ($dataPiket[$i][0]->kode_piket === 'PB') {
            //                                 if (
            //                                     ($tanggalKromosom[$i] === 'Tuesday'
            //                                         && bindec($kromosom[$i]['gen'][2]) <= 7)
            //                                     ||
            //                                     ($tanggalKromosom[$i] === 'Thursday'
            //                                         && bindec($kromosom[$i]['gen'][2]) >= 7
            //                                         && bindec($kromosom[$i]['gen'][2]) <= 14)
            //                                 ) {
            //                                     $kromosom[$i]['nilaiFitness']++;
            //                                 } else {
            //                                     $kromosom[$i]['nilaiFitness']--;
            //                                 }
            //                             }
            //                         } else

            //                             // constaint Martiningsih
            //                             // Kamis keempat, senin kedua, posbindu
            //                             // Sabtu ketiga, KKR

            //                             if ($dataPegawai[$i][0]->nama_pegawai === 'Martiningsih') {
            //                                 $kromosom[$i]['nilaiFitness']++;
            //                                 if ($dataPiket[$i][0]->kode_piket === 'PB') {
            //                                     if (($tanggalKromosom[$i] === 'Thursday'
            //                                             && bindec($kromosom[$i]['gen'][2]) >= 21)
            //                                         ||
            //                                         ($tanggalKromosom[$i] === 'Monday'
            //                                             && bindec($kromosom[$i]['gen'][2]) >= 7
            //                                             && bindec($kromosom[$i]['gen'][2]) <= 14)
            //                                     ) {
            //                                         $kromosom[$i]['nilaiFitness']++;
            //                                     } else {
            //                                         $kromosom[$i]['nilaiFitness']--;
            //                                     }
            //                                 }
            //                             } else

            //                                 // constraint untuk Endah lestari
            //                                 // Setiap senin, Ruang Infeksius

            //                                 if ($dataPegawai[$i][0]->nama_pegawai === 'Endah Lestari') {
            //                                     $kromosom[$i]['nilaiFitness']++;
            //                                     if ($dataPiket[$i][0]->kode_piket === "R.Inf") {
            //                                         if ($tanggalKromosom[$i] === 'Monday') {
            //                                             $kromosom[$i]['nilaiFitness']++;
            //                                         } else {
            //                                             $kromosom[$i]['nilaiFitness']--;
            //                                         }
            //                                     }
            //                                 } else

            //                                     // constraint untuk Eni setioningsih
            //                                     // Setiap kamis jumat bendahara

            //                                     if ($dataPegawai[$i][0]->nama_pegawai === 'Eni Setioningsih') {
            //                                         $kromosom[$i]['nilaiFitness']++;
            //                                         if ($dataPiket[$i][0]->kode_piket === "BDH") {
            //                                             if ($tanggalKromosom === 'Thursday' || $tanggalKromosom === 'Friday') {
            //                                                 $kromosom[$i]['nilaiFitness']++;
            //                                             } else {
            //                                                 $kromosom[$i]['nilaiFitness']--;
            //                                             }
            //                                         }
            //                                     } else

            //                                         // Rabu minggu pertama, posbindu
            //                                         // Sabtu ketiga, rutan
            //                                         // Tanggal 24, prolanis
            //                                         // Setiap rabu, PKD , ini PKD gak tau apa

            //                                         if ($dataPegawai[$i][0]->nama_pegawai === 'Margi Yuwono') {
            //                                             $kromosom[$i]['nilaiFitness']++;
            //                                             if ($dataPiket[$i][0]->kode_piket === 'PB') {
            //                                                 if (
            //                                                     $tanggalKromosom === 'Wednesday'
            //                                                     && bindec($kromosom[$i]['gen'][2]) <= 7
            //                                                 ) {
            //                                                     $kromosom[$i]['nilaiFitness']++;
            //                                                 } else {
            //                                                     $kromosom[$i]['nilaiFitness']--;
            //                                                 }
            //                                             } else
            //                                                 if ($dataPiket[$i][0]->kode_piket === 'LP') {
            //                                                 // Sabtu ketiga, rutan
            //                                                 if (
            //                                                     $tanggalKromosom === 'Saturday'
            //                                                     && bindec($kromosom[$i]['gen'][2]) >= 14
            //                                                     && bindec($kromosom[$i]['gen'][2]) <= 21
            //                                                 ) {
            //                                                     $kromosom[$i]['nilaiFitness']++;
            //                                                 } else {
            //                                                     $kromosom[$i]['nilaiFitness']--;
            //                                                 }
            //                                             } else
            //                                                 if ($dataPiket[$i][0]->kode_piket === 'Prolanis') {
            //                                                 // Tanggal 24, prolanis
            //                                                 if (bindec($kromosom[$i]['gen'][2]) === 24) {
            //                                                     $kromosom[$i]['nilaiFitness']++;
            //                                                 } else {
            //                                                     $kromosom[$i]['nilaiFitness']--;
            //                                                 }
            //                                             } else
            //                                                 if ($dataPiket[$i][0]->kode_piket === 'PKD') {
            //                                                 $kromosom[$i]['nilaiFitness']++;
            //                                             } else {
            //                                                 $kromosom[$i]['nilaiFitness']--;
            //                                             }
            //                                         } else

            //                                             // constraint untuk Ari S
            //                                             // Sabtu ketiga senin keempat, posbindu
            //                                             if ($dataPegawai[$i][0]->nama_pegawai === 'Ari S') {
            //                                                 $kromosom[$i]['nilaiFitness']++;
            //                                                 if ($dataPiket[$i][0]->kode_piket === 'PB') {
            //                                                     if (($tanggalKromosom === 'Saturday'
            //                                                             && bindec($kromosom[$i]['gen'][2]) >= 14
            //                                                             && bindec($kromosom[$i]['gen'][2]) <= 21)
            //                                                         ||
            //                                                         ($tanggalKromosom === 'Monday'
            //                                                             && bindec($kromosom[$i]['gen'][2]) >= 21)
            //                                                     ) {
            //                                                         $kromosom[$i]['nilaiFitness']++;
            //                                                     } else {
            //                                                         $kromosom[$i]['nilaiFitness']--;
            //                                                     }
            //                                                 }
            //                                             } else

            //                                                 // constraint untuk Suripah
            //                                                 // Selasa keempat, posbindu

            //                                                 if ($dataPegawai[$i][0]->nama_pegawai === 'Suripah') {
            //                                                     $kromosom[$i]['nilaiFitness']++;
            //                                                     if ($dataPiket[$i][0]->kode_piket === 'PB') {
            //                                                         if (
            //                                                             $tanggalKromosom === 'Tuesday'
            //                                                             && bindec($kromosom[$i]['gen'][2]) >= 21
            //                                                         ) {
            //                                                             $kromosom[$i]['nilaiFitness']++;
            //                                                         } else {
            //                                                             $kromosom[$i]['nilaiFitness']--;
            //                                                         }
            //                                                     }
            //                                                 } else
            //                                                     // constraint untuk Heriah
            //                                                     // Senin MTBS

            //                                                     if ($dataPegawai[$i][0]->nama_pegawai === 'Heriyah Safari') {
            //                                                         $kromosom[$i]['nilaiFitness']++;
            //                                                         if ($dataPiket[$i][0]->kode_piket === "Mtbs/RT") {
            //                                                             if (
            //                                                                 $tanggalKromosom === 'Monday'
            //                                                             ) {
            //                                                                 $kromosom[$i]['nilaiFitness']++;
            //                                                             } else {
            //                                                                 $kromosom[$i]['nilaiFitness']--;
            //                                                             }
            //                                                         }
            //                                                     } else
            //                                                         // constraint untuk Ukhulul
            //                                                         // Setiap hari surveillance
            //                                                         // Selalu surveillance

            //                                                         if ($dataPegawai[$i][0]->nama_pegawai === "Ukhulul") {
            //                                                             $kromosom[$i]['nilaiFitness']++;
            //                                                             if ($dataPiket[$i][0]->kode_piket === "Surveillance") {
            //                                                                 $kromosom[$i]['nilaiFitness']++;
            //                                                             } else {
            //                                                                 $kromosom[$i]['nilaiFitness']--;
            //                                                             }
            //                                                         } else
            //                                                             // Tanggal 24, prolanis
            //                                                             // Setiap senin RPU

            //                                                             if ($dataPegawai[$i][0]->nama_pegawai === 'Anisa') {
            //                                                                 $kromosom[$i]['nilaiFitness']++;
            //                                                                 if ($dataPiket[$i][0]->kode_piket === 'RPU') {
            //                                                                     if ($tanggalKromosom === 'Monday') {
            //                                                                         $kromosom[$i]['nilaiFitness']++;
            //                                                                     } else {
            //                                                                         $kromosom[$i]['nilaiFitness']--;
            //                                                                     }
            //                                                                 } else
            //                                                             if ($dataPiket[$i][0]->kode_piket === 'Prolanis') {
            //                                                                     if (bindec($kromosom[$i]['gen'][2]) === 24) {
            //                                                                         $kromosom[$i]['nilaiFitness']++;
            //                                                                     } else {
            //                                                                         $kromosom[$i]['nilaiFitness']--;
            //                                                                     }
            //                                                                 } else {
            //                                                                     $kromosom[$i]['nilaiFitness']--;
            //                                                                 }
            //                                                             }
            //         }
            //     }
            // }
            // if ($kromosom[$i]['nilaiFitness'] === 3) {
            //     dump($kromosom[$i]);
            // }
        }
        // dump($dataKromosom);
        return $kromosom;
        // echo count($dataBaru);
        // dump($kromosom);
    }

    public static function seleksiBasedOnFitness($kromosom)
    {
        $fitnessKromosomMax1 = 0;
        $fitnessKromosomMax2 = 0;
        $kromosomFitnessMax1 = [];
        $kromosomFitnessMax2 = [];

        foreach ($kromosom as $dataKromosom) {
            if ($dataKromosom['nilaiFitness'] >= $fitnessKromosomMax1) {
                $fitnessKromosomMax2 = $fitnessKromosomMax1;
                $fitnessKromosomMax = $dataKromosom['nilaiFitness'];
                $kromosomFitnessMax1 = $dataKromosom;
            } else {
                $fitnessKromosomMax2 = $dataKromosom['nilaiFitness'];
                $kromosomFitnessMax2 = $dataKromosom;
            }
        }

        foreach ($kromosom as $dataKromosom) {
            if (
                $dataKromosom['nilaiFitness'] >= $fitnessKromosomMax2
                && $fitnessKromosomMax2 <= $fitnessKromosomMax1
            ) {
                $fitnessKromosomMax2 = $dataKromosom['nilaiFitness'];
                $kromosomFitnessMax2 = $dataKromosom;
            } else
            if (
                $dataKromosom['nilaiFitness'] >= $fitnessKromosomMax1
                && $fitnessKromosomMax1 <= $fitnessKromosomMax2
            ) {
                $fitnessKromosomMax1 = $dataKromosom['nilaiFitness'];
                $kromosomFitnessMax1 = $dataKromosom;
            }
        }

        $kromosomMax = [$kromosomFitnessMax1, $kromosomFitnessMax2];
        // dump($kromosomMax);
        return $kromosomMax;
    }

    // ini buat seleksi baru
    // ambil nilai fitness tertinggi
    // udah di sort di bagian urutan fitness
    public static function seleksiFitnessTertinggiBaru($kromosom)
    {
        $kromosomTertinggiPertama = $kromosom[0];
        $kromosomTertinggiKedua = $kromosom[1];

        $hasilSeleksi = [$kromosomTertinggiPertama, $kromosomTertinggiKedua];

        return $hasilSeleksi;
    }

    public static function urutanFitnessTertinggi($kromosom)
    {
        // mengurutkan nilai fitness tertinggi
        $kolomNilaiFitness = array_column($kromosom, 'nilaiFitness');
        // dump($columns);
        array_multisort($kolomNilaiFitness, SORT_DESC, $kromosom);
        // dump($kromosom);
        return $kromosom;
    }

    // single point crossover
    public static function singlePointCrossoverBaru($kromosom, $crossoverRateInput)
    {
        $nilaiFitness = 0;
        $jumlahKromosom = count($kromosom);
        // menghilangkan gen agar tidak tertimpa
        for ($i = 0; $i < $jumlahKromosom; $i++) {
            unset($kromosom[$i]['gen']);
        }

        $splitKromosomA = str_split($kromosom[0]['kromosom']);
        $splitKromosomB = str_split($kromosom[1]['kromosom']);
        // dump($kromosom);

        // dump($splitKromosomA, $splitKromosomB);
        $tempKromosomA = [];
        $tempKromosomB = [];
        $tempGenKromosomA = [];
        $tempGenKromosomB = [];
        $kromosomBaruA = [];
        $kromosomBaruB = [];
        $kromosomBaru = [];
        $kromosomHasilCrossover = [];
        $jumlahGen = count($splitKromosomA);

        $crossoverRateRandom = mt_rand(0, 100) / 100;
        $singlePoint = mt_rand(1, $jumlahGen);

        // ini nanti dihapus
        // cuma untuk nge cek di mana poin crossover
        echo $singlePoint;

        if ($crossoverRateRandom > $crossoverRateInput) {
            echo "Berhasil Crossover";
            $kromosomBaruA = $splitKromosomA;
            $kromosomBaruB = $splitKromosomB;
            for ($i = $singlePoint - 1; $i < $jumlahGen; $i++) {

                // simpan hasil data crossover di temp
                $tempKromosomA[$i] = $splitKromosomA[$i];
                $tempKromosomB[$i] = $splitKromosomB[$i];

                // coba replace langsung
                $tempGenKromosomA = array_replace($splitKromosomA, $tempKromosomB);
                $tempGenKromosomB = array_replace($splitKromosomB, $tempKromosomA);

                // $kromosom_a_baru = array_replace($split_kromosom_a, $array_b);
                // $kromosom_b_baru = array_replace($split_kromosom_b, $array_a);
            }
        } else {
            $tempGenKromosomA = $splitKromosomA;
            $tempGenKromosomB = $splitKromosomB;
        }

        $kromosomBaruA = implode($tempGenKromosomA);
        $kromosomBaruB = implode($tempGenKromosomB);



        // dump($kromosomBaruA, $kromosomBaruB);
        // memasukkan kromosom hasi crossover ke variabel kromosom baru
        $kromosomBaru = [$kromosomBaruA, $kromosomBaruB];

        // memasukkan data kromomom baru ke kromosom hasil
        for ($i = 0; $i < $jumlahKromosom; $i++) {
            $kromosomHasilCrossover[$i]['kromosom'] = $kromosomBaru[$i];
            $kromosomHasilCrossover[$i]['nilaiFitness'] = 0;
        }

        // dump($kromosomHasilCrossover);

        $splitKromosomBaru = AdminModel::splitKromosom($kromosomHasilCrossover);
        // dump($splitKromosomBaru);
        return $splitKromosomBaru;
    }

    public static function singlePointCrossover($kromosom, $dataTanggalInput)
    {

        // crossover rate
        // jika kurang dari random bilangan
        // lakukan crossover
        $i = 0;
        $nilaiFitness = 0;
        foreach ($kromosom as $dataKromosom) {
            unset($kromosom[$i]['gen']);
            // unset($kromosom[$i]['gen']);
            $i++;
        }

        $array_a = [];
        $array_b = [];
        $kromosom_a_baru = [];
        $kromosom_b_baru = [];
        $split_kromosom_a = str_split($kromosom[0]['kromosom']);
        $split_kromosom_b = str_split($kromosom[1]['kromosom']);
        $singlePoint = mt_rand(0, count($split_kromosom_a));
        echo $singlePoint . count($split_kromosom_a) .  '<br>';

        // error 3,11
        // nanti coba kalo replace langsung
        for ($i = $singlePoint; $i < count($split_kromosom_a); $i++) {
            $array_a[$i] = $split_kromosom_a[$i];
            // echo $array_a[$i] ;
            $array_b[$i] = $split_kromosom_b[$i];
        }
        echo '<br>';

        // echo "Sebelum Crossover " . '<br>';
        // print_r($split_kromosom_a) . '<br>';
        // print_r($split_kromosom_b) . '<br>';
        // dump($kromosom);


        // echo "Setelah Crossover " . '<br>';
        $kromosom_a_baru = array_replace($split_kromosom_a, $array_b);
        $kromosom_b_baru = array_replace($split_kromosom_b, $array_a);
        // print_r($kromosom_a_baru) . '<br>';
        // print_r($kromosom_b_baru) . '<br>';

        $kromosom[0]['kromosom'] = implode($kromosom_a_baru);
        $kromosom[1]['kromosom'] = implode($kromosom_b_baru);
        $dataTanggal = AdminModel::dataTanggalToBiner($dataTanggalInput);
        // dump($dataTanggal);
        $nilaiFitness = 0;
        for ($i = 0; $i < count($kromosom); $i++) {
            $kromosom[$i]['nilaiFitness'] = $nilaiFitness = 0;;
        }
        $splitKromosom = AdminModel::splitKromosom($kromosom);
        $cekFitness = AdminModel::hitungTotalNilaiFitness($splitKromosom, $dataTanggal);

        // dump($cekFitness);

        // dump($kromosom);

        return $cekFitness;
        // mutation rate
        // jika kurang dari random bilangan
        // lakukan crossover
    }


    // mutasi kromosom
    // tukar nilai 0 dengan 1
    public static function bitFlipMutationBaru($kromosom)
    {
        // masukkan data kromosom ke variabel baru untuk mempermudah
        $kromosomPertama = $kromosom[0];
        $kromosomKedua = $kromosom[1];

        // split data kromosom menjadi gen agar mudah ditukar
        $splitKromosomA = str_split($kromosomPertama['kromosom']);
        $splitKromosomB = str_split($kromosomKedua['kromosom']);

        // echo "Sebelum mutasi";
        // dump($splitKromosomA, $splitKromosomB);

        // simpan data jumlah gen untuk perulangan
        $jumlahGen = count($splitKromosomA);
        // echo $jumlahGen . '<br>';

        // hitung index random untuk menunjuk daerah mutasi
        $indexRandom = mt_rand(1, $jumlahGen);
        echo $indexRandom;

        // ubah 1 menjadi 0 dan sebaliknya untuk kromosom A
        if ($splitKromosomA[$indexRandom - 1] === "0") {
            $splitKromosomA[$indexRandom - 1] = "1";
        } else
        if ($splitKromosomA[$indexRandom - 1] === "1") {
            $splitKromosomA[$indexRandom - 1] = "0";
        }

        // ubah 1 menjadi 0 dan sebaliknya untuk kromosom B
        if ($splitKromosomB[$indexRandom - 1] === "0") {
            $splitKromosomB[$indexRandom - 1] = "1";
        } else
        if ($splitKromosomB[$indexRandom - 1] === "1") {
            $splitKromosomB[$indexRandom - 1] = "0";
        }

        // echo "Sesudah mutasi";
        // dump($splitKromosomA, $splitKromosomB);

        // menggabungkan kromosom hasil mutasi
        $hasilKromosomMutasiA = join("", $splitKromosomA);
        $hasilKromosomMutasiB = join("", $splitKromosomB);

        // untuk menambahkan array kromomosom

        $kromosomHasilMutasi = [$hasilKromosomMutasiA, $hasilKromosomMutasiB];
        $kromosomBaru = [];

        // untuk menambahkan array kromomosom
        for ($i = 0; $i < 2; $i++) {
            $kromosomBaru[$i]['kromosom'] = $kromosomHasilMutasi[$i];
            $kromosomBaru[$i]['nilaiFitness'] = 0;
        }

        return $kromosomBaru;
    }


    public static function bitFlipMutation($kromosom)
    {
        $split_kromosom_a = str_split($kromosom[0]['kromosom']);
        $split_kromosom_b = str_split($kromosom[1]['kromosom']);
        $indexRandom = mt_rand(1, count($split_kromosom_a));
        // echo $indexRandom . '<br>';

        // echo "Sebelum Mutasi" . '<br>';
        // dump($split_kromosom_a);
        // dump($split_kromosom_b);

        // $indexKromosomA = $split_kromosom_a[$indexRandom - 1];
        // $indexKromosomB = $split_kromosom_b[$indexRandom - 1];


        // ini nanti dibuat if biar kalo kurang dari 0 gak error
        if ($split_kromosom_a[$indexRandom - 1] === "0") {
            $split_kromosom_a[$indexRandom - 1] = "1";
        } elseif ($split_kromosom_a[$indexRandom - 1] === "1") {
            $split_kromosom_a[$indexRandom - 1] = "0";
        }

        if ($split_kromosom_b[$indexRandom - 1] === "0") {
            $split_kromosom_b[$indexRandom - 1] = "1";
        } elseif ($split_kromosom_a[$indexRandom - 1] === "1") {
            $split_kromosom_b[$indexRandom - 1] = "0";
        }

        // echo "Setelah Mutasi" . '<br>';

        // untuk menggabungkan kromosom hasil mutasi
        $hasilKromosomMutasiA = join("", $split_kromosom_a);
        $hasilKromosomMutasiB = join("", $split_kromosom_b);

        $kromosomHasilMutasi = [$hasilKromosomMutasiA, $hasilKromosomMutasiB];
        $kromosomBaru = [];

        // untuk menambahkan array kromomosom
        for ($i = 0; $i < 2; $i++) {
            $kromosomBaru[$i]['kromosom'] = $kromosomHasilMutasi[$i];
            $kromosomBaru[$i]['nilaiFitness'] = 0;
        }
        return $kromosomBaru;
        // dump($split_kromosom_a);
        // dump($split_kromosom_b);
    }


    public static function prosesMemetika($dataMemetika)
    {
        // dump($dataMemetika);

        // =============== Deklarasi Variabel ===============
        // untuk menyimpan data jumlah populasi
        $jumlahPopulasi = intval($dataMemetika['inputJumlahPopulasi']);

        // untuk menyimpan jumlah generasi
        $jumlahGenerasi = intval($dataMemetika['inputJumlahGenerasi']);

        // untuk menyimpan data nilai mutation rate
        $mutationRateInput = floatval($dataMemetika['inputMutationRate']);

        // untuk menyimpan data nilai crossover rate
        $crossoverRateInput = floatval($dataMemetika['inputCrossoverRate']);

        // untuk menyimpan data tanggal
        $dataTanggal = $dataMemetika['inputBulanPiket'];




        // echo $crossoverRateInput . '<br>';
        // echo $mutationRateInput  . '<br>';
        // echo $jumlahPopulasi . '<br>';

        // =============== Data Pegawai ===============
        // mengambil data pegawai
        $dataPegawai = AdminModel::getDataPegawaiAll();
        // dump($dataPegawai);

        // mengubah data pegawai menjadi binary
        $dataPegawaiBiner = AdminModel::dataPegawaiToBiner($dataPegawai);
        // dump($dataPegawaiBiner);



        // =============== Data Tanggal ===============
        // mengubah data tanggal menjadi binary
        $dataTanggalBiner = AdminModel::dataTanggalToBiner($dataTanggal);
        // dump($dataTanggalBiner);



        // =============== Data Piket ===============
        // mengambil semua data piket
        $dataPiket = AdminModel::getAllDataPiket();
        // dump($dataPiket);


        // mengubah data piket menjadi binary
        $dataPiketBiner = AdminModel::dataPiketToBiner($dataPiket);
        // dump($dataPiketBiner);

        // generate populasi awal
        $populasiAwal = AdminModel::generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $jumlahPopulasi);
        // dump($populasiAwal);

        // split kromosom menjadi gen
        $convertKromosomToGen = AdminModel::splitKromosom($populasiAwal);
        // dump($convertKromosomToGen);


        $hitungNilaiFitnessKromosom = AdminModel::hitungNilaiFitnessBaru($convertKromosomToGen, $dataTanggalBiner);
        // dump($hitungNilaiFitnessKromosom);

        // // ======================= INI PERCOBAAN  ========================

        // $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
        // // dump($urutanKromosomFitnessTertinggi);

        // echo "Fitness Tertinggi";
        // // pemilihan dua kromosom tertinggi
        // $hasilSeleksiKromosomFitnessTertinggi = AdminModel::seleksiFitnessTertinggiBaru($urutanKromosomFitnessTertinggi);
        // dump($hasilSeleksiKromosomFitnessTertinggi);

        // // tes crossover
        // $hasilCrossoverKromosom = AdminModel::singlePointCrossoverBaru($hasilSeleksiKromosomFitnessTertinggi, $crossoverRateInput);
        // // dump($hasilCrossover);

        // // hitung nilai fitness baru hasil crossover
        // $hitungNilaiFitnessHasilCrossover = AdminModel::hitungNilaiFitnessBaru($hasilCrossoverKromosom, $dataTanggalBiner);
        // dump($hitungNilaiFitnessHasilCrossover);

        // // mutasi dua kromosom hasil crossover
        // $kromosomHasilMutasi = AdminModel::bitFlipMutationBaru($hasilCrossoverKromosom);
        // // dump($kromosomHasilMutasi);

        // // split kromosom menjadi gen hasil mutasi
        // $splitKromosomHasilMutasi = AdminModel::splitKromosom($kromosomHasilMutasi);
        // // dump($splitKromosomHasilMutasi);

        // // hitung nilai fitness baru hasil mutasi
        // // disini ada error karena data kosong
        // // error ini ntar
        // $hitungNilaiFitnessHasilMutasi = AdminModel::hitungNilaiFitnessBaru($splitKromosomHasilMutasi, $dataTanggalBiner);
        // dump($hitungNilaiFitnessHasilMutasi);

        // kondisi selesai
        // hitung perhitungan crossover berdasarkan total populasi hasil input
        // for ($i = 0; $i < $jumlahGenerasi; $i++) {


        // }
    }
}
