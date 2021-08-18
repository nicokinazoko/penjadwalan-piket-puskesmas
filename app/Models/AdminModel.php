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
        for($i = 0; $i < count($dataPegawai); $i++){
            $dataPegawai[$i] = decbin($dataPegawai[$i]->id_pegawai);
            // echo $data[$i]->id_pegawai . '<br>';
            // $dataPegawai[$i] = $data[$i]->id_pegawai;
        }

        return $dataPegawaiBiner;
    }

    // ubah data tanggal ke biner
    public static function dataTanggalToBiner($dataTanggal){
        $dataTanggalBiner = [];

        // dump($dataTanggal);
        // untuk memisah antara tahun dan bulan
        $tanggal = explode('-', $dataTanggal);
        // echo $tanggal[0];

        // untuk konversi dari input bulan dan tahun ke total hari
        $totalHari = cal_days_in_month(CAL_GREGORIAN, $tanggal[1], $tanggal[0]);

        for($i = 0; $i < $totalHari; $i++){
            $dataTanggalBiner[$i] = decbin($i+1);
        }

        return $dataTanggalBiner;
    }


    // convert data piket ke biner
    public static function dataPiketToBiner($dataPiket){
        $dataPiketBiner = [];

        dump($dataPiket);

        for($i = 0; $i < count($dataPiket); $i++){
            $dataPiketBiner[$i] = decbin($dataPiket[$i]->id_piket);
        }

        return $dataPiketBiner;


    }

}
