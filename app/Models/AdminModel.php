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
        $dataJabatan = DB::table('jabatans')->get();
        return $dataJabatan;
    }

    // ambil semua data piket
    public static function getAllDataPiket()
    {
        $dataPiket = DB::table('pikets')->get();

        return $dataPiket;
        // dump($dataPiket);
    }



    // input data piket
    public static function inputDataPiket($piket)
    {
        dump($piket);
    }

    // edit data piket
    public static function editDataPiket()
    {
    }

    // hapus data piket
    public static function deleteDataPiket()
    {
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

    // cari data pegawai berdasarkan id
    public static function getDataPegawaiById($id)
    {
        $dataPegawaiCari = DB::table('pegawais')->find($id);

        return $dataPegawaiCari;
        //dump($dataPegawaiCari);
    }

    // input data pegawai
    public static function inputDataPegawai($pegawai)
    {

    }

    // edit data piket
    public static function editDataPegawai()
    {
    }

    // hapus data piket
    public static function deleteDataPegawai()
    {
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

    //
}
