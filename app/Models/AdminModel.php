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
        $jumlahDataPegawai = DB::table('pegawais')->count();
        $jumlahDataPiket = DB::table('pikets')->count();

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
        unset($dataPegawai['_method'], $dataPegawai['_token']);
        // dump($dataPegawai);
        $dataPegawaiUpdate = [
            'nama_pegawai' => $dataPegawai['inputNamaPegawai'],
            'id_jenis_kelamin' => $dataPegawai['inputJenisKelaminPegawai'],
            'id_jabatan' => $dataPegawai['inputJabatanPegawai']
        ];
        // dump($dataPegawaiUpdate);

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
        $dataPegawaiBiner = [];
        for ($i = 0; $i < count($dataPegawai); $i++) {
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

        $month_name = date("F", mktime(0, 0, 0, $tanggal[1]));
        $dataTanggalTotal = [
            'namaBulan' => $month_name,
            'nomorBulan' => $tanggal[1],
            'hari' => $dataTanggalBiner
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
            $dataPiketBiner[$i] = decbin($dataPiket[$i]->id_piket);
            // if($dataPiketBiner[$i] <)

            // untuk menambah bit 0
            // agar sesuai dengan semua array
            $dataPiketBiner[$i] = str_pad($dataPiketBiner[$i], 6, '0', STR_PAD_LEFT);
        }


        return $dataPiketBiner;
    }

    public static function generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $dataMemetika)
    {

        $jumlahPopulasi = $dataMemetika['inputJumlahPopulasi'];
        $jumlahDataPegawaiBiner = count($dataPegawaiBiner);
        $jumlahDataPiketBiner = count($dataPiketBiner);
        $jumlahDataTanggalBiner = count($dataTanggalBiner['hari']);
        $kromosom = [];
        $kromosom_convert = [];


        for ($i = 0; $i < $jumlahPopulasi; $i++) {
            $indexRandomPegawai = mt_rand(0, $jumlahDataPegawaiBiner - 1);
            $indexRandomPiket = mt_rand(0, $jumlahDataPiketBiner - 1);
            $indexRandomTanggalBiner = mt_rand(0, $jumlahDataTanggalBiner - 1);
            $kromosom[$i] = $dataPegawaiBiner[$indexRandomPegawai] . $dataPiketBiner[$indexRandomPiket] . $dataTanggalBiner['hari'][$indexRandomTanggalBiner];

            // $kromosom[$i] = $dataPiketBiner[$indexRandomPiket];
        }

        dump($kromosom);
        for ($i = 0; $i < $jumlahPopulasi; $i++) {
            // $indexRandomPegawai = mt_rand(0, $jumlahDataPegawaiBiner - 1);
            // $indexRandomPiket = mt_rand(0, $jumlahDataPiketBiner - 1);
            // $indexRandomTanggalBiner = mt_rand(0, $jumlahDataTanggalBiner - 1);
            // $kromosom[$i] = $dataPegawaiBiner[$indexRandomPegawai] . $dataPiketBiner[$indexRandomPiket] . $dataTanggalBiner['hari'][$indexRandomTanggalBiner];

            // $kromosom[$i] = $dataPiketBiner[$indexRandomPiket];
            $kromosom_convert[$i] = str_split($kromosom[$i], 6);
        }
        dump($kromosom_convert);

        // dump($dataPiketBiner);
        // $indexRandomPiket = mt_rand(0, $jumlahDataPiketBiner);
        // for ($i = 0; $i < $jumlahPopulasi; $i++) {
        //     // $indexRandomPegawai = mt_rand(0, $jumlahDataPegawaiBiner);
        //     $indexRandomPiket = mt_rand(0, $jumlahDataPiketBiner);
        //     echo $indexRandomPiket . '<br>';
        // }
        // dump($jumlahDataTanggalBiner);
        // dump($dataMemetika);
        // return $dataPegawaiBiner;
    }
}
