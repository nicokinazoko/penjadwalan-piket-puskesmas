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

    public static function generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $dataMemetika)
    {

        // memasukkan data jumlah populasi variabel
        $jumlahPopulasi = $dataMemetika['inputJumlahPopulasi'];

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

    public static function hitungNilaiFitness($kromosom, $dataTanggal)
    {
        // $tanggal = date("l", mktime(0,0,0,$dataTanggal['hari'][1],$dataTanggal['nomorBulan'],$dataTanggal['tahun']));
        // echo $tanggal;

        $totalSatu = '';
        $totalDua = '';
        $totalTiga = '';
        $totalEmpat = '';

        // data pegawai


        // start menghitung nilai fitness masing-masing kromosom
        for ($i = 0; $i < count($kromosom); $i++) {

            // convert data tanggal menjadi nama hari
            $tanggalKromosom = date("l", mktime(0, 0, 0, $kromosom[$i]['gen'][2], $dataTanggal['nomorBulan'], $dataTanggal['tahun']));

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

                // cek untuk data Nely Puspita
                // Selasa pertama dengan Kamis ketiga, Posbindu
                // id pegawai 13
                // dump($dataPegawai);
                if ($dataPegawai[0]->nama_pegawai === 'Nely Puspita') {
                    if ($dataPiket[0]->kode_piket === 'PB') {
                        if (
                            bindec($kromosom[$i]['gen'][2]) <= 7 ||
                            (bindec($kromosom[$i]['gen'][2]) <= 21 &&
                                bindec($kromosom[$i]['gen'][2]) >= 14)
                        ) {
                            if ($tanggalKromosom == 'Tuesday' || $tanggalKromosom == 'Thursday') {
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
            if ($tanggalKromosom == 'Sunday') {

                // kurangi nilai fitness
                $kromosom[$i]['nilaiFitness']--;
            } else {

                // tambah nilai fitness
                $kromosom[$i]['nilaiFitness']++;
            }

            if ($kromosom[$i]['nilaiFitness'] > 2) {
                $totalSatu++;
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





        // for ($i = 0; $i < count($dataTanggal['hari']); $i++) {
        //     // $tanggal[$i] = date("l", mktime(0,0,0,bindec($dataTanggal['hari'][$i]),$dataTanggal['nomorBulan'],$dataTanggal['tahun']));
        //     // $tanggal[$i] = bindec($dataTanggal['hari'][$i]) . $dataTanggal['namaBulan'] . $dataTanggal['tahun'];
        //     $tanggal[$i] = date("l", mktime(0, 0, 0, $dataTanggal['nomorBulan'], bindec($dataTanggal['hari'][$i]), $dataTanggal['tahun']));
        //     if($tanggal[$i] === 'Sunday'){

        //     }
        // }
        return $kromosom;
        // return $tanggal;
        // return $dataTanggal;
        // dump($tanggal);
        // dump($dataTanggal);
    }
}
