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

    // ambil semua data piket unique
    public static function getAllDataPiketUnique()
    {
        $dataPiketUnique = DB::table('pikets')->distinct()->get();
        return $dataPiketUnique;
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

    // ambil data pegawai unique
    public static function getAllDataPegawaiUnique()
    {
        $dataPegawaiUnique = DB::table('pegawais')->distinct()->get();

        return $dataPegawaiUnique;
    }

    // cari data pegawai berdasarkan Id
    public static function getDataPegawaiById($idPegawai)
    {
        $dataPegawaiCari = DB::table('pegawais')
            ->where('id_pegawai', '=', $idPegawai)
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

    // ---------- Data Penjadwalan Memetika -----------

    // ambil semua data penjadwalan
    public static function getAllDataPenjadwalanMemetika()
    {
        $dataPenjadwalanMemetika = DB::table('penjadwalan_memetika')
            ->select('tanggal_pembuatan_jadwal')
            ->distinct()
            ->get();
        // dump($dataPenjadwalanMemetika);

        // ambil jumlah data pembuatan jadwal berbeda
        $jumlahData = count($dataPenjadwalanMemetika);
        // dump($jumlahData);
        // ambil data tanggal dari database berdasarkan tanggal pembuatan
        // dump($dataPenjadwalanMemetika);

        // cek data apakah data penjadwalan kosong atau tidak
        // echo $dataPenjadwalanMemetika->isEmpty();
        if ($dataPenjadwalanMemetika->isEmpty()) {
            $dataTanggalPenjadwalan = $dataPenjadwalanMemetika;
        } else {
            for ($i = 0; $i < $jumlahData; $i++) {
                $dataTanggalPenjadwalan[$i] = DB::table('penjadwalan_memetika')->where('tanggal_pembuatan_jadwal', $dataPenjadwalanMemetika[$i]->tanggal_pembuatan_jadwal)->first();
                // $dataTanggalPenjadwalan[$i]->tanggal_pecah = explode('-', $dataTanggalPenjadwalan[$i]->tanggal_penjadwalan);
                $dataTanggalPenjadwalan[$i]->tanggal = date("F Y", strtotime($dataTanggalPenjadwalan[$i]->tanggal_penjadwalan));
                // date('d F Y H:i:s', strtotime($dataTanggalPembuatanJadwal->tanggal_pembuatan_jadwal))
            }
        }
        // dump($dataPenjadwalanMemetikaArray);|
        // echo isset($dataPenjadwalanMemetikaArray);
        // if (isset($dataPenjadwalanMemetikaArray)) {
        //     // do something
        //     echo "ini kosong loh";
        // } else {
        //     echo "ini kosong";
        // }



        // // dump($dataTanggalPenjadwalan);
        // // $user = DB::table('users')->where('name', 'John')->first();
        // // dump($dataPenjadwalanNeuroFuzzy);
        // // echo gettype($dataPenjadwalanNeuroFuzzy);

        return $dataTanggalPenjadwalan;

        // // return $dataTanggalPembuatan;
    }

    // lihat data penjadwalan piket base on tanggal pembuatan
    public static function getDataPenjadwalanByTanggalPembuatan($tanggalPembuatan)
    {
        // dump($tanggalPembuatan);
        $dataPenjadwalanDatabase = DB::table('penjadwalan_memetika')
            ->where('tanggal_pembuatan_jadwal', '=', $tanggalPembuatan)
            ->get();

        // dump($dataPenjadwalanDatabase);
        $dataPegawaiUnique = DB::table('pegawais')->get();

        // dump($pisahTanggal);

        $jumlahHari = intval(date('t', strtotime($dataPenjadwalanDatabase[0]->tanggal_penjadwalan)));
        // dump($jumlahHari);

        for ($j = 0; $j < $jumlahHari; $j++) {
            $dataPiket[$j] = [
                'idPenjadwalanMemetika' => '',
                'idPiket' => '',
                'kodePiket' => '',
                'tanggalPenjadwalan' => ''
            ];
        }


        // $dataPiket[$i] = [
        //     'idPiket' => '',
        //     'namaPiket' => '',
        //     'tanggalPiket' => '',
        //     'nilaiFitness' => ''
        // ];

        $jumlahDataPenjadwalanDatabase = count($dataPenjadwalanDatabase);
        // dump($jumlahDataPenjadwalanDatabase);

        // for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
        //     $dataBaru[$k] = DB::table('pikets')
        //         ->where('id_piket', $dataPenjadwalanDatabase[$k]->id_piket)
        //         ->limit(1)
        //         ->get();

        //         $dataPenjadwalanDatabase[$k]->kode_piket = $dataBaru[$k][0]->kode_piket;
        // }

        // dump($dataPenjadwalanDatabase);

        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            $dataPenjadwalan[$i] = [
                'idPegawai' => $dataPegawaiUnique[$i]->id_pegawai,
                'namaPegawai' => $dataPegawaiUnique[$i]->nama_pegawai,
                'dataPiket' => $dataPiket

            ];
            for ($j = 0; $j < $jumlahHari; $j++) {
                // $dataPenjadwalan[$i]['dataPiket'][$j] = [];

                for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
                    if ($dataPenjadwalanDatabase[$k]->id_pegawai === $dataPenjadwalan[$i]['idPegawai']) {
                        $pisahTanggal = explode('-', $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan);
                        $hasilTanggal = intval($pisahTanggal[2]);

                        // if ($pisahTanggal[2] === 0) {
                        //     // $dataPenjadwalan[$i]['dataPiket'][$pisahTanggal[2] - 1]['idPenjadwalanMemetika'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_memetika;
                        // } else {
                        //     $dataPenjadwalan[$i]['dataPiket'][$pisahTanggal[2] - 1]['idPenjadwalanMemetika'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_memetika;
                        //     $dataPenjadwalan[$i]['dataPiket'][$pisahTanggal[2] - 1]['idPiket'] = $dataPenjadwalanDatabase[$k]->id_piket;
                        //     $dataPenjadwalan[$i]['dataPiket'][$pisahTanggal[2] - 1]['kodePiket'] = $dataPenjadwalanDatabase[$k]->kode_piket;
                        //     $dataPenjadwalan[$i]['dataPiket'][$pisahTanggal[2] - 1]['tanggalPenjadwalan'] = $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan;
                        // }

                        if ($dataPenjadwalanDatabase[$k]->tanggal_penjadwalan !== "0000-00-00") {
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['idPenjadwalanMemetika'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_memetika;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['idPiket'] = $dataPenjadwalanDatabase[$k]->id_piket;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['kodePiket'] = $dataPenjadwalanDatabase[$k]->kode_piket;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['tanggalPenjadwalan'] = $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan;
                        }
                    }
                }
            }
        }

        // untuk tanggal yang kosong
        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            for ($j = 0; $j < $jumlahHari; $j++) {
                for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
                    if ($dataPenjadwalan[$i]['idPegawai'] === $dataPenjadwalanDatabase[$k]->id_pegawai) {
                        if (
                            $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanMemetika'] === ''
                            && $dataPenjadwalanDatabase[$k]->kode_piket === ''
                        ) {
                            $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanMemetika'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_memetika;
                        }
                    }
                }
            }
        }

        return $dataPenjadwalan;
    }

    // input data piket
    public static function inputDataPenjadwalanMemetika()
    {
    }

    // edit data piket
    public static function editDataPenjadwalanMemetika($idPenjadwalanMemetika, $tanggalPenjadwalan)
    {
        // dump($idPenjadwalanMemetika, $tanggalPenjadwalan);
        $dataPenjadwalan = DB::table('penjadwalan_memetika')
            ->where('id_penjadwalan_memetika', $idPenjadwalanMemetika)
            ->get();
        // dump($dataPenjadwalan[0]->tanggal_pembuatan_jadwal);
        $dataJadwalDatabase = explode('-', $dataPenjadwalan[0]->tanggal_pembuatan_jadwal);
        // dump($dataJadwalDatabase);
        $dataHariBaru = $dataJadwalDatabase[0] . '-' . $dataJadwalDatabase[1] . '-' . $tanggalPenjadwalan;
        // dump($dataHariBaru);
        $dataPenjadwalanUpdate = DB::table('penjadwalan_memetika')
            ->where('id_penjadwalan_memetika', $idPenjadwalanMemetika)
            ->update([
                'tanggal_penjadwalan' => $dataHariBaru,
            ]);
        // dump($dataPenjadwalan);

        $dataPenjadwalanHasilUpdateTanggal = DB::table('penjadwalan_memetika')
            ->where('id_penjadwalan_memetika', $idPenjadwalanMemetika)
            ->get();
        return $dataPenjadwalanHasilUpdateTanggal;
    }

    // edit data penjadwalan base id penjadwalan memetika
    public static function editDataPenjadwalanMemetikaByIdProses($dataPenjadwalanMemetika)
    {
        // dump($dataPenjadwalanMemetika);
        $dataPenjadwalan = DB::table('penjadwalan_memetika')
            ->where('id_penjadwalan_memetika', $dataPenjadwalanMemetika['inputIdPenjadwalan'])
            ->get();
        // dump($dataPenjadwalan);

        $dataPiket = DB::table('pikets')
            ->where('id_piket', $dataPenjadwalanMemetika['inputIdPiket'])
            ->get();

        // dump($dataPiket);

        $updateDataPenjadwalan = DB::table('penjadwalan_memetika')
            ->where('id_penjadwalan_memetika', $dataPenjadwalanMemetika['inputIdPenjadwalan'])
            ->update([
                'id_piket' => $dataPenjadwalanMemetika['inputIdPiket'],
                'kode_piket' => $dataPiket[0]->nama_piket
            ]);

        return $dataPenjadwalan;
    }

    // hapus data piket
    public static function deleteDataPenjadwalanMemetika($tanggalPenjadwalanMemetika)
    {
        // dump($tanggalPenjadwalanMemetika);
        // $dataPenjadwalanCari = AdminModel::getDataPenjadwalanNeuroFuzzyByTanggalPembuatan($dataPenjadwalanNeuroFuzzy);
        // dump($dataPenjadwalanCari);
        $hasilDeleteDataPenjadwalanMemetika = DB::table('penjadwalan_memetika')
            ->where('tanggal_pembuatan_jadwal', $tanggalPenjadwalanMemetika)
            ->delete();

        return $hasilDeleteDataPenjadwalanMemetika;
    }


    // simpan data penjadwalan ke database
    public static function simpanDataPenjadwalanDatabaseMemetika($dataPenjadwalan)
    {
        // dump($dataPenjadwalan);
        $waktuPembuatan = date_create('now')->format('Y-m-d H:i:s');
        $waktuDefault = date_create('now')->format('Y-m-d');
        $waktuPembuatanBaru = date("Y-m-d H:i:s");
        // dump($waktuPembuatanBaru);
        // $waktuPembuatan =  date('Y-m-d H:i:s');
        // echo gettype($dataPenjadwalan[0]['dataPiket'][0]['idPiket']);

        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        $dataPiketUnique = AdminModel::getAllDataPiketUnique();
        $jumlahPiketUnique = count($dataPiketUnique);
        // dump($jumlahPiketUnique);

        $jumlahDataPenjadwalan = count($dataPenjadwalan);
        // dump($jumlahDataPenjadwalan);
        $jumlahDataHari = count($dataPenjadwalan[0]['dataPiket']);
        // dump($jumlahDataHari);
        $jumlahDataTotal = $jumlahDataPenjadwalan * $jumlahDataHari;
        // dump($jumlahDataHari);

        for ($i = 0; $i < $jumlahDataPenjadwalan; $i++) {
            for ($j = 0; $j < $jumlahDataHari; $j++) {
                // id_penjadwalan_memetika	id_pegawai	id_piket	tanggal_penjadwalan	tanggal_pembuatan_jadwal
                $pisahTanggal = explode('-', $dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPiket']);
                $dataPiket = DB::table('pikets')
                    ->where('id_piket', $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'])
                    ->get();
                // $tanggal = $pisahTanggal[0] . '-' . $pisahTanggal[1] . '-' . 00;
                if (
                    $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'] === '' ||
                    $pisahTanggal[2] < 1 ||
                    // INI BARU DIEDIT
                    // COBA KALO PAKE VARIABEL LANGSUNG
                    $pisahTanggal[2] > $jumlahDataHari
                ) {

                    $insertDataDatabase = DB::table('penjadwalan_memetika')->insert([
                        // 'id_penjadwalan_memetika' => '',
                        'id_pegawai' => $dataPenjadwalan[$i]['idPegawai'],
                        'id_piket' => $dataPiketUnique[14]->id_piket,
                        'kode_piket' => '',
                        'tanggal_penjadwalan' => "0000-00-00",
                        'tanggal_pembuatan_jadwal' => $waktuPembuatanBaru

                    ]);
                } else {
                    $insertDataDatabase = DB::table('penjadwalan_memetika')->insert([
                        // 'id_penjadwalan_memetika' => '',
                        'id_pegawai' => $dataPenjadwalan[$i]['idPegawai'],
                        'id_piket' => $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'],
                        'kode_piket' => $dataPiket[0]->kode_piket,
                        'tanggal_penjadwalan' => $dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPiket'],
                        'tanggal_pembuatan_jadwal' => $waktuPembuatanBaru,
                        'nilai_fitness' => $dataPenjadwalan[$i]['dataPiket'][$j]['nilaiFitness']
                    ]);
                }
            }
        }

        // echo $insertDataDatabase;

        // dump($dataPenjadwalanDatabase);
    }



    // ---------- Data Penjadwalan Neuro Fuzzy -----------
    public static function getAllDataPenjadwalanNeuroFuzzy()
    {
        $dataPenjadwalanNeuroFuzzy = DB::table('penjadwalan_neuro_fuzzy')
            ->select('tanggal_pembuatan_jadwal')
            ->distinct()
            ->get();

        // ambil jumlah data pembuatan jadwal berbeda
        $jumlahData = count($dataPenjadwalanNeuroFuzzy);
        // dump($jumlahData);
        // ambil data tanggal dari database berdasarkan tanggal pembuatan

        for ($i = 0; $i < $jumlahData; $i++) {
            $dataTanggalPenjadwalan[$i] = DB::table('penjadwalan_neuro_fuzzy')->where('tanggal_pembuatan_jadwal', $dataPenjadwalanNeuroFuzzy[$i]->tanggal_pembuatan_jadwal)->first();
            // $dataTanggalPenjadwalan[$i]->tanggal_pecah = explode('-', $dataTanggalPenjadwalan[$i]->tanggal_penjadwalan);
            $dataTanggalPenjadwalan[$i]->tanggal = date("F Y", strtotime($dataTanggalPenjadwalan[$i]->tanggal_penjadwalan));
            // date('d F Y H:i:s', strtotime($dataTanggalPembuatanJadwal->tanggal_pembuatan_jadwal))
        }

        // dump($dataTanggalPenjadwalan);
        // $user = DB::table('users')->where('name', 'John')->first();
        // dump($dataPenjadwalanNeuroFuzzy);
        // echo gettype($dataPenjadwalanNeuroFuzzy);

        return $dataTanggalPenjadwalan;
    }


    public function prosesSimpanHasilPenjadwalanNeuroFuzzy(Request $dataPenjadwalanNeuroFuzzy)
    {
        // dump($dataPenjadwalanMemetika->all());
        $hasilData = $dataPenjadwalanNeuroFuzzy->all();
        // dump($hasilData);
        $dataPenjadwalan = unserialize($hasilData['dataJadwal']);
        // dump($dataPenjadwalan);

        $simpanDataPenjadwalan = AdminModel::simpanDataPenjadwalanDatabaseNeuroFuzzy($dataPenjadwalan);
        return redirect()->route('view-data-algoritma-neuro-fuzzy');
    }


    // edit data piket
    public static function editDataPenjadwalanNeuroFuzzy($idPenjadwalanNeuroFuzzy, $tanggalPenjadwalan)
    {
        // dump($idPenjadwalanMemetika, $tanggalPenjadwalan);
        $dataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $idPenjadwalanNeuroFuzzy)
            ->get();
        // dump($dataPenjadwalan[0]->tanggal_pembuatan_jadwal);
        $dataJadwalDatabase = explode('-', $dataPenjadwalan[0]->tanggal_pembuatan_jadwal);
        // dump($dataJadwalDatabase);
        $dataHariBaru = $dataJadwalDatabase[0] . '-' . $dataJadwalDatabase[1] . '-' . $tanggalPenjadwalan;
        // dump($dataHariBaru);
        $dataPenjadwalanUpdate = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $idPenjadwalanNeuroFuzzy)
            ->update([
                'tanggal_penjadwalan' => $dataHariBaru,
            ]);
        // dump($dataPenjadwalan);

        $dataPenjadwalanHasilUpdateTanggal = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $idPenjadwalanNeuroFuzzy)
            ->get();
        return $dataPenjadwalanHasilUpdateTanggal;
    }

    // edit data penjadwalan base id penjadwalan NeuroFuzzy
    public static function editDataPenjadwalanNeuroFuzzyByIdProses($dataPenjadwalanNeuroFuzzy)
    {
        // dump($dataPenjadwalanMemetika);
        $dataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $dataPenjadwalanNeuroFuzzy['inputIdPenjadwalan'])
            ->get();
        // dump($dataPenjadwalan);

        $dataPiket = DB::table('pikets')
            ->where('id_piket', $dataPenjadwalanNeuroFuzzy['inputIdPiket'])
            ->get();

        // dump($dataPiket);

        $updateDataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $dataPenjadwalanNeuroFuzzy['inputIdPenjadwalan'])
            ->update([
                'id_piket' => $dataPenjadwalanNeuroFuzzy['inputIdPiket'],
                'kode_piket' => $dataPiket[0]->kode_piket
            ]);

        return $dataPenjadwalan;
    }

    // hapus data piket
    public static function deleteDataPenjadwalanNeuroFuzzy($dataPenjadwalanNeuroFuzzy)
    {
        // dump($dataPenjadwalanNeuroFuzzy);
        // $dataPenjadwalanCari = AdminModel::getDataPenjadwalanNeuroFuzzyByTanggalPembuatan($dataPenjadwalanNeuroFuzzy);
        // dump($dataPenjadwalanCari);
        $hasilDeleteDataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('tanggal_pembuatan_jadwal', $dataPenjadwalanNeuroFuzzy)
            ->delete();

        return $hasilDeleteDataPenjadwalan;
    }


    // simpan data penjadwalan ke database
    public static function simpanDataPenjadwalanDatabaseNeuroFuzzy($dataPenjadwalan)
    {
        // dump($dataPenjadwalan);
        $waktuPembuatan = date_create('now')->format('Y-m-d H:i:s');
        $waktuDefault = date_create('now')->format('Y-m-d');
        $waktuPembuatanBaru = date("Y-m-d H:i:s");
        // dump($waktuPembuatanBaru);
        // $waktuPembuatan =  date('Y-m-d H:i:s');
        // echo gettype($dataPenjadwalan[0]['dataPiket'][0]['idPiket']);

        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        $dataPiketUnique = AdminModel::getAllDataPiketUnique();
        $jumlahPiketUnique = count($dataPiketUnique);
        // dump($jumlahPiketUnique);

        $jumlahDataPenjadwalan = count($dataPenjadwalan);
        $jumlahDataHari = count($dataPenjadwalan[0]['dataPiket']);
        $jumlahDataTotal = $jumlahDataPenjadwalan * $jumlahDataHari;
        // dump($jumlahDataHari);

        for ($i = 0; $i < $jumlahDataPenjadwalan; $i++) {
            for ($j = 0; $j < $jumlahDataHari; $j++) {
                // id_penjadwalan_neuro_fuzzy	id_pegawai	id_piket	tanggal_penjadwalan	tanggal_pembuatan_jadwal
                $pisahTanggal = explode('-', $dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPiket']);
                $dataPiket = DB::table('pikets')
                    ->where('id_piket', $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'])
                    ->get();
                // $tanggal = $pisahTanggal[0] . '-' . $pisahTanggal[1] . '-' . 00;
                if (
                    $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'] === '' ||
                    $pisahTanggal[2] < 1 ||
                    // INI BARU DIEDIT
                    // COBA KALO PAKE VARIABEL LANGSUNG
                    $pisahTanggal[2] > $jumlahDataHari
                ) {

                    $insertDataDatabase = DB::table('penjadwalan_neuro_fuzzy')->insert([
                        // 'id_penjadwalan_neuro_fuzzy' => '',
                        'id_pegawai' => $dataPenjadwalan[$i]['idPegawai'],
                        'id_piket' => 37,
                        'kode_piket' => '',
                        'tanggal_penjadwalan' => "0000-00-00",
                        'tanggal_pembuatan_jadwal' => $waktuPembuatanBaru
                    ]);
                } else {
                    $insertDataDatabase = DB::table('penjadwalan_neuro_fuzzy')->insert([
                        // 'id_penjadwalan_neuro_fuzzy' => '',
                        'id_pegawai' => $dataPenjadwalan[$i]['idPegawai'],
                        'id_piket' => $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'],
                        'kode_piket' => $dataPiket[0]->kode_piket,
                        'tanggal_penjadwalan' => $dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPiket'],
                        'tanggal_pembuatan_jadwal' => $waktuPembuatanBaru
                    ]);
                }
            }
        }

        // echo $insertDataDatabase;

        // dump($dataPenjadwalanDatabase);
    }


    // cari data penjadwalan neuro fuzzy by tanggal pembuatan
    public static function getDataPenjadwalanNeuroFuzzyByTanggalPembuatan($tanggalPembuatanPenjadwalan)
    {
        // dump($tanggalPembuatanPenjadwalan);
        $dataPenjadwalanCari = DB::table('penjadwalan_neuro_fuzzy')
            ->where('tanggal_pembuatan_jadwal', $tanggalPembuatanPenjadwalan)
            ->get();
        // dump($dataPenjadwalanCari);
        return $dataPenjadwalanCari;
    }


    public static function getDataPenjadwalanNeuroFuzzyByTanggalPembuatanHasil($tanggalPembuatan)
    {
        // dump($tanggalPembuatan);
        // $dataPenjadwalanDatabase = DB::table('penjadwalan_memetika')
        //     ->where('tanggal_pembuatan_jadwal', '=', $tanggalPembuatan)
        //     ->get();

        $dataPenjadwalanDatabase = AdminModel::getDataPenjadwalanNeuroFuzzyByTanggalPembuatan($tanggalPembuatan);

        // dump($dataPenjadwalanDatabase);
        $dataPegawaiUnique = DB::table('pegawais')->get();

        // dump($pisahTanggal);

        $jumlahHari = intval(date('t', strtotime($dataPenjadwalanDatabase[0]->tanggal_penjadwalan)));
        // dump($jumlahHari);

        for ($j = 0; $j < $jumlahHari; $j++) {
            $dataPiket[$j] = [
                'idPenjadwalanNeuroFuzzy' => '',
                'idPiket' => '',
                'kodePiket' => '',
                'tanggalPenjadwalan' => ''
            ];
        }


        // $dataPiket[$i] = [
        //     'idPiket' => '',
        //     'namaPiket' => '',
        //     'tanggalPiket' => '',
        //     'nilaiFitness' => ''
        // ];

        $jumlahDataPenjadwalanDatabase = count($dataPenjadwalanDatabase);
        // dump($jumlahDataPenjadwalanDatabase);

        // for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
        //     $dataBaru[$k] = DB::table('pikets')
        //         ->where('id_piket', $dataPenjadwalanDatabase[$k]->id_piket)
        //         ->limit(1)
        //         ->get();

        //         $dataPenjadwalanDatabase[$k]->kode_piket = $dataBaru[$k][0]->kode_piket;
        // }

        // dump($dataPenjadwalanDatabase);

        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            $dataPenjadwalan[$i] = [
                'idPegawai' => $dataPegawaiUnique[$i]->id_pegawai,
                'namaPegawai' => $dataPegawaiUnique[$i]->nama_pegawai,
                'dataPiket' => $dataPiket

            ];
            for ($j = 0; $j < $jumlahHari; $j++) {
                // $dataPenjadwalan[$i]['dataPiket'][$j] = [];

                for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
                    if ($dataPenjadwalanDatabase[$k]->id_pegawai === $dataPenjadwalan[$i]['idPegawai']) {
                        $pisahTanggal = explode('-', $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan);
                        $hasilTanggal = intval($pisahTanggal[2]);
                        if ($dataPenjadwalanDatabase[$k]->tanggal_penjadwalan !== "0000-00-00") {
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['idPenjadwalanNeuroFuzzy'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_neuro_fuzzy;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['idPiket'] = $dataPenjadwalanDatabase[$k]->id_piket;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['kodePiket'] = $dataPenjadwalanDatabase[$k]->kode_piket;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['tanggalPenjadwalan'] = $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan;
                        }
                    }
                }
            }
        }

        // untuk tanggal yang kosong
        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            for ($j = 0; $j < $jumlahHari; $j++) {
                for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
                    if ($dataPenjadwalan[$i]['idPegawai'] === $dataPenjadwalanDatabase[$k]->id_pegawai) {
                        if (
                            $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanNeuroFuzzy'] === ''
                            && $dataPenjadwalanDatabase[$k]->kode_piket === ''
                        ) {
                            $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanNeuroFuzzy'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_neuro_fuzzy;
                        }
                    }
                }
            }
        }

        return $dataPenjadwalan;
    }



    // ---------- Data Penjadwalan Genetika -----------
    public static function getAllDataPenjadwalanGenetika()
    {
        $dataPenjadwalanGenetika = DB::table('penjadwalan_genetikas')
            ->select('tanggal_pembuatan_jadwal')
            ->distinct()
            ->get();

        // ambil jumlah data pembuatan jadwal berbeda
        $jumlahData = count($dataPenjadwalanGenetika);
        // dump($jumlahData);
        // ambil data tanggal dari database berdasarkan tanggal pembuatan

        if ($dataPenjadwalanGenetika->isEmpty()) {
            $dataTanggalPenjadwalan = $dataPenjadwalanGenetika;
        } else {
            for ($i = 0; $i < $jumlahData; $i++) {
                $dataTanggalPenjadwalan[$i] = DB::table('penjadwalan_genetikas')->where('tanggal_pembuatan_jadwal', $dataPenjadwalanGenetika[$i]->tanggal_pembuatan_jadwal)->first();
                // $dataTanggalPenjadwalan[$i]->tanggal_pecah = explode('-', $dataTanggalPenjadwalan[$i]->tanggal_penjadwalan);
                $dataTanggalPenjadwalan[$i]->tanggal = date("F Y", strtotime($dataTanggalPenjadwalan[$i]->tanggal_penjadwalan));
                // date('d F Y H:i:s', strtotime($dataTanggalPembuatanJadwal->tanggal_pembuatan_jadwal))
            }
        }


        // dump($dataTanggalPenjadwalan);
        // $user = DB::table('users')->where('name', 'John')->first();
        // dump($dataPenjadwalanNeuroFuzzy);
        // echo gettype($dataPenjadwalanNeuroFuzzy);

        return $dataTanggalPenjadwalan;
    }


    public function prosesSimpanHasilPenjadwalanGenetika(Request $dataPenjadwalanGenetika)
    {
        // dump($dataPenjadwalanMemetika->all());
        $hasilData = $dataPenjadwalanGenetika->all();
        // dump($hasilData);
        $dataPenjadwalan = unserialize($hasilData['dataJadwal']);
        // dump($dataPenjadwalan);

        // $simpanDataPenjadwalan = AdminModel::simpanDataPenjadwalanDatabaseNeuroFuzzy($dataPenjadwalan);
        // return redirect()->route('view-data-algoritma-neuro-fuzzy');
    }


    // edit data piket
    public static function editDataPenjadwalanGenetika($idPenjadwalanNeuroFuzzy, $tanggalPenjadwalan)
    {
        // dump($idPenjadwalanMemetika, $tanggalPenjadwalan);
        $dataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $idPenjadwalanNeuroFuzzy)
            ->get();
        // dump($dataPenjadwalan[0]->tanggal_pembuatan_jadwal);
        $dataJadwalDatabase = explode('-', $dataPenjadwalan[0]->tanggal_pembuatan_jadwal);
        // dump($dataJadwalDatabase);
        $dataHariBaru = $dataJadwalDatabase[0] . '-' . $dataJadwalDatabase[1] . '-' . $tanggalPenjadwalan;
        // dump($dataHariBaru);
        $dataPenjadwalanUpdate = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $idPenjadwalanNeuroFuzzy)
            ->update([
                'tanggal_penjadwalan' => $dataHariBaru,
            ]);
        // dump($dataPenjadwalan);

        $dataPenjadwalanHasilUpdateTanggal = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $idPenjadwalanNeuroFuzzy)
            ->get();
        return $dataPenjadwalanHasilUpdateTanggal;
    }

    // edit data penjadwalan base id penjadwalan Genetika
    public static function editDataPenjadwalanGenetikayByIdProses($dataPenjadwalanNeuroFuzzy)
    {
        // dump($dataPenjadwalanMemetika);
        $dataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $dataPenjadwalanNeuroFuzzy['inputIdPenjadwalan'])
            ->get();
        // dump($dataPenjadwalan);

        $dataPiket = DB::table('pikets')
            ->where('id_piket', $dataPenjadwalanNeuroFuzzy['inputIdPiket'])
            ->get();

        // dump($dataPiket);

        $updateDataPenjadwalan = DB::table('penjadwalan_neuro_fuzzy')
            ->where('id_penjadwalan_neuro_fuzzy', $dataPenjadwalanNeuroFuzzy['inputIdPenjadwalan'])
            ->update([
                'id_piket' => $dataPenjadwalanNeuroFuzzy['inputIdPiket'],
                'kode_piket' => $dataPiket[0]->kode_piket
            ]);

        return $dataPenjadwalan;
    }

    // hapus data piket
    public static function deleteDataPenjadwalanGenetika($dataPenjadwalanGenetika)
    {
        // dump($dataPenjadwalanGenetika);
        $hasilDeleteDataPenjadwalan = DB::table('penjadwalan_genetikas')
            ->where('tanggal_pembuatan_jadwal', $dataPenjadwalanGenetika)
            ->delete();

        return $hasilDeleteDataPenjadwalan;
    }


    // simpan data penjadwalan ke database
    public static function simpanDataPenjadwalanDatabaseGenetika($dataPenjadwalan)
    {
        // dump($dataPenjadwalan);
        $waktuPembuatan = date_create('now')->format('Y-m-d H:i:s');
        $waktuDefault = date_create('now')->format('Y-m-d');
        $waktuPembuatanBaru = date("Y-m-d H:i:s");
        // dump($waktuPembuatanBaru);
        // $waktuPembuatan =  date('Y-m-d H:i:s');
        // echo gettype($dataPenjadwalan[0]['dataPiket'][0]['idPiket']);

        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        $dataPiketUnique = AdminModel::getAllDataPiketUnique();
        $jumlahPiketUnique = count($dataPiketUnique);
        // dump($jumlahPiketUnique);

        $jumlahDataPenjadwalan = count($dataPenjadwalan);
        $jumlahDataHari = count($dataPenjadwalan[0]['dataPiket']);
        $jumlahDataTotal = $jumlahDataPenjadwalan * $jumlahDataHari;
        // dump($jumlahDataHari);

        for ($i = 0; $i < $jumlahDataPenjadwalan; $i++) {
            for ($j = 0; $j < $jumlahDataHari; $j++) {
                // id_penjadwalan_neuro_fuzzy	id_pegawai	id_piket	tanggal_penjadwalan	tanggal_pembuatan_jadwal
                $pisahTanggal = explode('-', $dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPiket']);
                $dataPiket = DB::table('pikets')
                    ->where('id_piket', $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'])
                    ->get();
                // $tanggal = $pisahTanggal[0] . '-' . $pisahTanggal[1] . '-' . 00;
                if (
                    $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'] === '' ||
                    $pisahTanggal[2] < 1 ||
                    // INI BARU DIEDIT
                    // COBA KALO PAKE VARIABEL LANGSUNG
                    $pisahTanggal[2] > $jumlahDataHari
                ) {

                    $insertDataDatabase = DB::table('penjadwalan_genetikas')->insert([
                        // 'id_penjadwalan_neuro_fuzzy' => '',
                        'id_pegawai' => $dataPenjadwalan[$i]['idPegawai'],
                        'id_piket' => $dataPiketUnique[0]->id_piket,
                        'kode_piket' => '',
                        'nilai_fitness' => '',
                        'tanggal_penjadwalan' => "0000-00-00",
                        'tanggal_pembuatan_jadwal' => $waktuPembuatanBaru
                    ]);
                } else {
                    $insertDataDatabase = DB::table('penjadwalan_genetikas')->insert([
                        // 'id_penjadwalan_neuro_fuzzy' => '',
                        'id_pegawai' => $dataPenjadwalan[$i]['idPegawai'],
                        'id_piket' => $dataPenjadwalan[$i]['dataPiket'][$j]['idPiket'],
                        'kode_piket' => $dataPiket[0]->kode_piket,
                        'nilai_fitness' => $dataPenjadwalan[$i]['dataPiket'][$j]['nilaiFitness'],
                        'tanggal_penjadwalan' => $dataPenjadwalan[$i]['dataPiket'][$j]['tanggalPiket'],
                        'tanggal_pembuatan_jadwal' => $waktuPembuatanBaru,
                        'nilai_fitness' => $dataPenjadwalan[$i]['dataPiket'][$j]['nilaiFitness']
                    ]);
                }
            }
        }

        // echo $insertDataDatabase;

        // dump($dataPenjadwalanDatabase);
    }


    // cari data penjadwalan neuro fuzzy by tanggal pembuatan
    public static function getDataPenjadwalanGenetikaByTanggalPembuatan($tanggalPembuatanPenjadwalan)
    {
        // dump($tanggalPembuatanPenjadwalan);
        $dataPenjadwalanCari = DB::table('penjadwalan_genetikas')
            ->where('tanggal_pembuatan_jadwal', $tanggalPembuatanPenjadwalan)
            ->get();
        // dump($dataPenjadwalanCari);
        return $dataPenjadwalanCari;
    }



    // masih error semua
    public static function getDataPenjadwalanGenetikaByTanggalPembuatanHasil($tanggalPembuatan)
    {
        // dump($tanggalPembuatan);
        // $dataPenjadwalanDatabase = DB::table('penjadwalan_memetika')
        //     ->where('tanggal_pembuatan_jadwal', '=', $tanggalPembuatan)
        //     ->get();

        $dataPenjadwalanDatabase = AdminModel::getDataPenjadwalanGenetikaByTanggalPembuatan($tanggalPembuatan);

        // dump($dataPenjadwalanDatabase);
        $dataPegawaiUnique = DB::table('pegawais')->get();

        // dump($pisahTanggal);

        $jumlahHari = intval(date('t', strtotime($dataPenjadwalanDatabase[0]->tanggal_penjadwalan)));
        // dump($jumlahHari);

        for ($j = 0; $j < $jumlahHari; $j++) {
            $dataPiket[$j] = [
                'idPenjadwalanGenetika' => '',
                'idPiket' => '',
                'kodePiket' => '',
                'tanggalPenjadwalan' => '',
                'nilaiFitness' => ''
            ];
        }


        // $dataPiket[$i] = [
        //     'idPiket' => '',
        //     'namaPiket' => '',
        //     'tanggalPiket' => '',
        //     'nilaiFitness' => ''
        // ];

        $jumlahDataPenjadwalanDatabase = count($dataPenjadwalanDatabase);
        // dump($jumlahDataPenjadwalanDatabase);

        for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
            $dataBaru[$k] = DB::table('pikets')
                ->where('id_piket', $dataPenjadwalanDatabase[$k]->id_piket)
                ->limit(1)
                ->get();

            $dataPenjadwalanDatabase[$k]->kode_piket = $dataBaru[$k][0]->kode_piket;
        }

        // dump($dataPenjadwalanDatabase);

        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            $dataPenjadwalan[$i] = [
                'idPegawai' => $dataPegawaiUnique[$i]->id_pegawai,
                'namaPegawai' => $dataPegawaiUnique[$i]->nama_pegawai,
                'dataPiket' => $dataPiket

            ];
            for ($j = 0; $j < $jumlahHari; $j++) {
                // $dataPenjadwalan[$i]['dataPiket'][$j] = [];

                for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
                    if ($dataPenjadwalanDatabase[$k]->id_pegawai === $dataPenjadwalan[$i]['idPegawai']) {
                        $pisahTanggal = explode('-', $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan);
                        $hasilTanggal = intval($pisahTanggal[2]);
                        if ($dataPenjadwalanDatabase[$k]->tanggal_penjadwalan !== "0000-00-00") {
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['idPenjadwalanGenetika'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_genetikas;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['idPiket'] = $dataPenjadwalanDatabase[$k]->id_piket;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['kodePiket'] = $dataPenjadwalanDatabase[$k]->kode_piket;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['tanggalPenjadwalan'] = $dataPenjadwalanDatabase[$k]->tanggal_penjadwalan;
                            $dataPenjadwalan[$i]['dataPiket'][$hasilTanggal - 1]['nilaiFitness'] = $dataPenjadwalanDatabase[$k]->nilai_fitness;
                        }
                    }
                }
            }
        }

        // untuk tanggal yang kosong
        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            for ($j = 0; $j < $jumlahHari; $j++) {
                for ($k = 0; $k < $jumlahDataPenjadwalanDatabase; $k++) {
                    if ($dataPenjadwalan[$i]['idPegawai'] === $dataPenjadwalanDatabase[$k]->id_pegawai) {
                        if (
                            $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanGenetika'] === ''
                            && $dataPenjadwalanDatabase[$k]->kode_piket === ''
                        ) {
                            $dataPenjadwalan[$i]['dataPiket'][$j]['idPenjadwalanGenetika'] = $dataPenjadwalanDatabase[$k]->id_penjadwalan_genetikas;
                        }
                    }
                }
            }
        }

        return $dataPenjadwalan;
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

        // ================== DATA PEGAWAI ==================

        // mnengambil data pegawai dari db untuk diambil id nya
        $dataPegawaiDatabase = AdminModel::getDataPegawaiAll()->all();
        // dump($dataPegawaiDatabase);

        // simpan data id saja untuk pengecekan di kromosom
        $dataPegawaiIdAll = [];
        for ($i = 0; $i < count($dataPegawaiDatabase); $i++) {
            $dataPegawaiIdAll[$i] = $dataPegawaiDatabase[$i]->id_pegawai;
        }
        // dump($dataPegawaiIdAll);

        // ================== DATA PIKET ==================

        // ambil data piket dari db untuk diambil id nya
        $dataPiketDatabase = AdminModel::getAllDataPiket()->all();
        // dump($dataPiketDatabase);

        // // $cekDecimal = bindec(bindec($kromosom[20]['gen'][0]));
        // echo gettype($kromosom[0]['gen'][0]);

        // simpan data id piket untuk pengecekan di kromosom
        $dataPiketIdAll = [];
        for ($i = 0; $i < count($dataPiketDatabase); $i++) {
            $dataPiketIdAll[$i] = $dataPiketDatabase[$i]->id_piket;
        }
        // dump($dataPiketIdAll);


        // menyimpan data tanggal dari kromosom
        $tanggalHasilInput = $dataTanggal['tahun'] . '-' . $dataTanggal['nomorBulan'] . '-' . '01';

        // menghitung jumlah hari berdasarkan input
        $jumlahHariDalamBulan = intval(date('t', strtotime($tanggalHasilInput)));
        // dump($jumlahHariDalamBulan);

        // convert data tanggal menjadi jumlah hari dalam satu bulan
        // untuk mengecek apakah tanggal melebihi dari total hari maka -1
        // $tanggalHasilInput = "2021-09-34";
        // dump($tanggal[$i]);
        // pake ini untuk mengecek apakah data tanggal melebihi dari tanggal di kromosom


        // ================== START PENGHITUNGAN FITNESS ==================
        for ($i = 0; $i < $jumlahKromosom; $i++) {

            // cek apakah tanggal lebih atau kurang dari jumlah hari
            if (intval(bindec($kromosom[$i]['gen'][2])) >= 0 && bindec($kromosom[$i]['gen'][2]) <= $jumlahHariDalamBulan) {
                // echo "Sesuai dengan Tanggal";
                // jika tanggal masih di dalam jangkauan hari di bulan itu

                // masuk ke cek data pegawai ada di dalam data pegawai db atau tidak
                if (in_array(bindec($kromosom[$i]['gen'][0]), $dataPegawaiIdAll)) {
                    // echo "Ada Datanya Pegawai";

                    // jika ada di di dalam data pegawai db
                    // lakukan cek data piket ada di dalam data piket db atau tidak
                    if (in_array(bindec($kromosom[$i]['gen'][1]), $dataPiketIdAll)) {
                        // echo "Ada Datanya Piket";

                        // jika data piket ada di dalam data piket db maka start hitung fitness dengan constraint

                        // id data pegawai start 10
                        // ambil data pegawai dari database
                        $dataPegawai[$i] = AdminModel::getDataPegawaiById(bindec($kromosom[$i]['gen'][0]));
                        // dump($dataPegawai[$i]);

                        // id data piket start 18
                        // ambil data piket dari database
                        $dataPiket[$i] = Adminmodel::getDataPiketById(bindec($kromosom[$i]['gen'][1]));
                        $tanggal[$i] = $dataTanggal['tahun'] . '-' . $dataTanggal['nomorBulan'] . '-' . bindec($kromosom[$i]['gen'][2]);
                        $tanggalKromosom[$i] = date('l', strtotime($tanggal[$i]));
                        // dump($tanggalConvert[$i]);

                        // id data piket start 18
                        $dataPiket[$i] = Adminmodel::getDataPiketById(bindec($kromosom[$i]['gen'][1]));
                        // dump($dataPiket[$i]);

                        // jika data ada di db

                        // jika hari Minggu, libur maka fitness - 1
                        if ($tanggalKromosom[$i] === "Sunday") {
                            $kromosom[$i]['nilaiFitness']--;
                            // dump($kromosom[$i]);
                        } else {
                            $kromosom[$i]['nilaiFitness']++;


                            // constraint untuk dr Amelia
                            // Tanggal 24, prolanis
                            // RPU senin rabu jumat
                            // R Inf selasa kamis sabtu
                            if ($dataPegawai[$i][0]->nama_pegawai === "dr. Amelia") {
                                $kromosom[$i]['nilaiFitness']++;
                                // dump($kromosom[$i]);
                                if ($dataPiket[$i][0]->kode_piket === 'Prolanis') {
                                    if (bindec($kromosom[$i]['gen'][2]) === 24) {
                                        $kromosom[$i]['nilaiFitness']++;
                                    } else {
                                        $kromosom[$i]['nilaiFitness']--;
                                    }
                                } else
                                        if ($dataPiket[$i][0]->kode_piket === 'RPU') {
                                    if (
                                        $tanggalKromosom[$i] === 'Monday' || $tanggalKromosom[$i] === 'Wednesday'
                                        || $tanggalKromosom[$i] === 'Friday'
                                    ) {
                                        $kromosom[$i]['nilaiFitness']++;
                                    } else {
                                        $kromosom[$i]['nilaiFitness']--;
                                    }
                                } else
                                        if ($dataPiket[$i][0]->kode_piket === 'R.Inf') {
                                    if (
                                        $tanggalKromosom[$i] === 'Tuesday' || $tanggalKromosom[$i] === 'Thursday'
                                        || $tanggalKromosom[$i] === 'Saturday'
                                    ) {
                                        $kromosom[$i]['nilaiFitness']++;
                                    } else {
                                        $kromosom[$i]['nilaiFitness']--;
                                    }
                                }
                            } else

                                // constraint untuk dr. Dwi Bhakti P
                                // RPU selasa, kamis, sabtu
                                // R infeksius senin, rabu jumat

                                if ($dataPegawai[$i][0]->nama_pegawai === 'dr. Dwi Bhakti P') {
                                    $kromosom[$i]['nilaiFitness']++;
                                    if ($dataPiket[$i][0]->kode_piket === 'RPU') {
                                        if (
                                            $tanggalKromosom[$i] === 'Tuesday' || $tanggalKromosom[$i] === 'Thursday'
                                            || $tanggalKromosom[$i] === 'Saturday'
                                        ) {
                                            $kromosom[$i]['nilaiFitness']++;
                                        } else {
                                            $kromosom[$i]['nilaiFitness']--;
                                        }
                                    } else
                                        if ($dataPiket[$i][0]->kode_piket === 'R.Inf') {
                                        if (
                                            $tanggalKromosom[$i] === 'Monday' || $tanggalKromosom[$i] === 'Wednesday'
                                            || $tanggalKromosom[$i] === 'Friday'
                                        ) {
                                            $kromosom[$i]['nilaiFitness']++;
                                        } else {
                                            $kromosom[$i]['nilaiFitness']--;
                                        }
                                    }
                                } else

                                    // constraint untuk Eni Sud
                                    // Sabtu kedua, posbindu


                                    if ($dataPegawai[$i][0]->nama_pegawai === 'Eni Sudaryati') {
                                        $kromosom[$i]['nilaiFitness']++;
                                        if ($dataPiket[$i][0]->kode_piket === 'PB') {
                                            if (
                                                $tanggalKromosom[$i] === 'Saturday' &&
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

                                        if ($dataPegawai[$i][0]->nama_pegawai === 'Nely Puspita') {
                                            $kromosom[$i]['nilaiFitness']++;
                                            if ($dataPiket[$i][0]->kode_piket === 'PB') {
                                                if (
                                                    ($tanggalKromosom[$i] === 'Tuesday'
                                                        && bindec($kromosom[$i]['gen'][2]) <= 7)
                                                    ||
                                                    ($tanggalKromosom[$i] === 'Thursday'
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

                                            if ($dataPegawai[$i][0]->nama_pegawai === 'Martiningsih') {
                                                $kromosom[$i]['nilaiFitness']++;
                                                if ($dataPiket[$i][0]->kode_piket === 'PB') {
                                                    if (($tanggalKromosom[$i] === 'Thursday'
                                                            && bindec($kromosom[$i]['gen'][2]) >= 21)
                                                        ||
                                                        ($tanggalKromosom[$i] === 'Monday'
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

                                                if ($dataPegawai[$i][0]->nama_pegawai === 'Endah Lestari') {
                                                    $kromosom[$i]['nilaiFitness']++;
                                                    if ($dataPiket[$i][0]->kode_piket === "R.Inf") {
                                                        if ($tanggalKromosom[$i] === 'Monday') {
                                                            $kromosom[$i]['nilaiFitness']++;
                                                        } else {
                                                            $kromosom[$i]['nilaiFitness']--;
                                                        }
                                                    }
                                                } else

                                                    // constraint untuk Eni setioningsih
                                                    // Setiap kamis jumat bendahara

                                                    if ($dataPegawai[$i][0]->nama_pegawai === 'Eni Setioningsih') {
                                                        $kromosom[$i]['nilaiFitness']++;
                                                        if ($dataPiket[$i][0]->kode_piket === "BDH") {
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

                                                        if ($dataPegawai[$i][0]->nama_pegawai === 'Margi Yuwono') {
                                                            $kromosom[$i]['nilaiFitness']++;
                                                            if ($dataPiket[$i][0]->kode_piket === 'PB') {
                                                                if (
                                                                    $tanggalKromosom === 'Wednesday'
                                                                    && bindec($kromosom[$i]['gen'][2]) <= 7
                                                                ) {
                                                                    $kromosom[$i]['nilaiFitness']++;
                                                                } else {
                                                                    $kromosom[$i]['nilaiFitness']--;
                                                                }
                                                            } else
                                                                        if ($dataPiket[$i][0]->kode_piket === 'LP') {
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
                                                                        if ($dataPiket[$i][0]->kode_piket === 'Prolanis') {
                                                                // Tanggal 24, prolanis
                                                                if (bindec($kromosom[$i]['gen'][2]) === 24) {
                                                                    $kromosom[$i]['nilaiFitness']++;
                                                                } else {
                                                                    $kromosom[$i]['nilaiFitness']--;
                                                                }
                                                            } else
                                                                        if ($dataPiket[$i][0]->kode_piket === 'PKD') {
                                                                $kromosom[$i]['nilaiFitness']++;
                                                            } else {
                                                                $kromosom[$i]['nilaiFitness']--;
                                                            }
                                                        } else

                                                            // constraint untuk Ari S
                                                            // Sabtu ketiga senin keempat, posbindu
                                                            if ($dataPegawai[$i][0]->nama_pegawai === 'Ari S') {
                                                                $kromosom[$i]['nilaiFitness']++;
                                                                if ($dataPiket[$i][0]->kode_piket === 'PB') {
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

                                                                if ($dataPegawai[$i][0]->nama_pegawai === 'Suripah') {
                                                                    $kromosom[$i]['nilaiFitness']++;
                                                                    if ($dataPiket[$i][0]->kode_piket === 'PB') {
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

                                                                    if ($dataPegawai[$i][0]->nama_pegawai === 'Heriyah Safari') {
                                                                        $kromosom[$i]['nilaiFitness']++;
                                                                        if ($dataPiket[$i][0]->kode_piket === "Mtbs/RT") {
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

                                                                        if ($dataPegawai[$i][0]->nama_pegawai === "Ukhulul") {
                                                                            $kromosom[$i]['nilaiFitness']++;
                                                                            if ($dataPiket[$i][0]->kode_piket === "Surveillance") {
                                                                                $kromosom[$i]['nilaiFitness']++;
                                                                            } else {
                                                                                $kromosom[$i]['nilaiFitness']--;
                                                                            }
                                                                        } else
                                                                            // Tanggal 24, prolanis
                                                                            // Setiap senin RPU

                                                                            if ($dataPegawai[$i][0]->nama_pegawai === 'Anisa') {
                                                                                $kromosom[$i]['nilaiFitness']++;
                                                                                if ($dataPiket[$i][0]->kode_piket === 'RPU') {
                                                                                    if ($tanggalKromosom === 'Monday') {
                                                                                        $kromosom[$i]['nilaiFitness']++;
                                                                                    } else {
                                                                                        $kromosom[$i]['nilaiFitness']--;
                                                                                    }
                                                                                } else
                                                                                    if ($dataPiket[$i][0]->kode_piket === 'Prolanis') {
                                                                                    if (bindec($kromosom[$i]['gen'][2]) === 24) {
                                                                                        $kromosom[$i]['nilaiFitness']++;
                                                                                    } else {
                                                                                        $kromosom[$i]['nilaiFitness']--;
                                                                                    }
                                                                                } else {
                                                                                    $kromosom[$i]['nilaiFitness']--;
                                                                                }
                                                                            }
                        }
                    } else {
                        // jika data piket tidak ada di dalam data piket db
                        // kurangi nilai fitness
                        // echo "Tidak Ada Datanya Piket";
                        $kromosom[$i]['nilaiFitness']--;
                    }
                } else {
                    // jika tidak ada di dalam data pegawai db
                    // kurang nilai fitness
                    // echo "Tidak Ada Datanya Pegawai";
                    $kromosom[$i]['nilaiFitness']--;
                }
            } else {
                // jika tanggal di luar jangkauan hari di bulan itu
                // kurangi nilai fitness
                // echo "TIDAK SESUAI DENGAN TANGGAL";
                $kromosom[$i]['nilaiFitness']--;
            }
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

    public static function seleksiFitnessTertinggiBaruSearch($kromosom)
    {
        $jumlahKromosom = count($kromosom);
        // dump($kromosom);

        $kromosomFitnessTertinggiPertama['nilaiFitness'] = '';
        $kromosomFitnessTertinggiKedua['nilaiFitness'] = '';
        for ($j = 0; $j < $jumlahKromosom; $j++) {
            if ($kromosom[$j]['nilaiFitness'] > $kromosomFitnessTertinggiPertama['nilaiFitness']) {
                $kromosomFitnessTertinggiPertama = $kromosom[$j];
            } else
            if ($kromosomFitnessTertinggiPertama !== $kromosomFitnessTertinggiKedua) {
                if ($kromosom[$j]['nilaiFitness'] > $kromosomFitnessTertinggiKedua['nilaiFitness']) {
                    $kromosomFitnessTertinggiKedua = $kromosom[$j];
                }
            }
        }

        $kromosomFitnessTertinggi = [$kromosomFitnessTertinggiPertama, $kromosomFitnessTertinggiKedua];


        // dump($kromosomFitnessTertinggi);
        return $kromosomFitnessTertinggi;
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
        // echo $singlePoint;

        // jika crossover rate di sini lebih besar dari crossover rate input
        // lakukan crossover
        if ($crossoverRateRandom > $crossoverRateInput) {
            // echo "Dilakukan Crossover" . '<br>';
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
            // echo "Tidak dilakukan crossover" . '<br>';
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
        // echo $singlePoint . count($split_kromosom_a) .  '<br>';

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


    // empat metode crossover
    public static function crossoverKromosom($kromosom, $crossoverRateInput)
    {
        $randomPilihCrossover = mt_rand(1, 3);


        if ($randomPilihCrossover === 1) {
            $hasilCrossover = AdminModel::singlePointCrossoverBaru($kromosom, $crossoverRateInput);
        } else
        if ($randomPilihCrossover === 2) {
            $hasilCrossover = AdminModel::multiPointCrossover($kromosom, $crossoverRateInput);
        } else
        if ($randomPilihCrossover === 3) {
            $hasilCrossover = AdminModel::uniformCrossover($kromosom, $crossoverRateInput);
        }

        // $hasilCrossover = AdminModel::uniformCrossover($kromosom, $crossoverRateInput);
        // dump($hasilCrossover);
        return $hasilCrossover;
    }

    // multi point crossover
    public static function multiPointCrossover($kromosom, $crossoverRateInput)
    {

        // dump($kromosom);

        $jumlahKromosom = count($kromosom);
        // menghilangkan gen agar tidak tertimpa
        for ($i = 0; $i < $jumlahKromosom; $i++) {
            unset($kromosom[$i]['gen']);
        }

        $splitKromosomA = str_split($kromosom[0]['kromosom']);
        $splitKromosomB = str_split($kromosom[1]['kromosom']);


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
        // $singlePoint = mt_rand(1, $jumlahGen);


        // echo "Multi Point Crossover";
        // pilih 2 indeks random
        $angkaRandomSatu = mt_rand(0, $jumlahGen - 1);
        do {
            $angkaRandomDua = mt_rand(0, $jumlahGen - 1);
        } while ($angkaRandomSatu == $angkaRandomDua);

        // dump($angkaRandomSatu, $angkaRandomDua);

        // untuk menghitung range angka dari hasil random
        if ($angkaRandomSatu < $angkaRandomDua) {
            $indexRandomSatu = $angkaRandomSatu;
            $indexRandomDua = $angkaRandomDua;
        } else
        if ($angkaRandomSatu > $angkaRandomDua) {
            $indexRandomSatu = $angkaRandomDua;
            $indexRandomDua = $angkaRandomSatu;
        }
        // dump($jarakIndeks);

        // dump($indexRandomSatu, $indexRandomDua);

        // jika crossover rate di sini lebih besar dari crossover rate input
        // lakukan crossover
        if ($crossoverRateRandom > $crossoverRateInput) {
            for ($i = $indexRandomSatu; $i < $indexRandomDua; $i++) {
                // dump($i);

                // simpan hasil data crossover di temp
                $tempKromosomA[$i] = $splitKromosomA[$i];
                $tempKromosomB[$i] = $splitKromosomB[$i];

                // coba replace langsung
                $tempGenKromosomA = array_replace($splitKromosomA, $tempKromosomB);
                $tempGenKromosomB = array_replace($splitKromosomB, $tempKromosomA);
            }
        } else {
            // echo "Tidak dilakukan crossover" . '<br>';
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

    // uniform crossover
    public static function uniformCrossover($kromosom, $crossoverRateInput)
    {
        // echo "Uniform Crossover";


        // dump($kromosom);

        $jumlahKromosom = count($kromosom);
        // menghilangkan gen agar tidak tertimpa
        for ($i = 0; $i < $jumlahKromosom; $i++) {
            unset($kromosom[$i]['gen']);
        }

        $splitKromosomA = str_split($kromosom[0]['kromosom']);
        $splitKromosomB = str_split($kromosom[1]['kromosom']);


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
        // $singlePoint = mt_rand(1, $jumlahGen);


        // jika crossover rate di sini lebih besar dari crossover rate input
        // lakukan crossover
        if ($crossoverRateRandom > $crossoverRateInput) {
            for ($i = 0; $i < $jumlahGen; $i++) {
                // dump($i);

                // untuk variabel flip koin
                $flipKoin = mt_rand(0, 1);

                // jika flip koin 0 maka tidak terjadi crossover gen
                // jika flip koin 1 maka terjadi crossover gen
                if ($flipKoin === 0) {
                } else
                if ($flipKoin === 1) {
                    // simpan hasil data crossover di temp
                    $tempKromosomA[$i] = $splitKromosomA[$i];
                    $tempKromosomB[$i] = $splitKromosomB[$i];

                    // coba replace langsung
                    $tempGenKromosomA = array_replace($splitKromosomA, $tempKromosomB);
                    $tempGenKromosomB = array_replace($splitKromosomB, $tempKromosomA);
                }
            }
        } else {
            // echo "Tidak dilakukan crossover" . '<br>';
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

    // mutasi kromosom
    // tukar nilai 0 dengan 1
    public static function bitFlipMutationBaru($kromosom, $mutationRateInput)
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
        // echo $indexRandom;
        $mutationRate = mt_rand(0, 100) / 100;
        // dump($mutationRate);

        // jika mutation rate dari input lebih kecil dari mutation rate di sini
        // tidak lakukan mutasi
        if ($mutationRate < $mutationRateInput) {
            // echo "Dilakukan Mutasi" . '<br>';
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
        } else {
            // echo "Tidak dilakukan Mutasi" . '<br>';
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


    // ini masih belum fix
    // masih bakal replace terus data yang terakhir
    // pengecekan apakah gen hasil mutasi lebih baik dari populasi
    public static function cekDataMutasiKePopulasi($kromosom, $kromosomHasilMutasi)
    {
        // dump($kromosomHasilMutasi);
        // dump($kromosom);
        // ketika fitness kromosom populasi terakhir lebih kecil daripada kromosom hasil mutasi
        // replace data nya
        $jumlahKromosomMutasi = count($kromosomHasilMutasi);
        $jumlahKromosomPopulasi = count($kromosom);
        $hasilPop = [];
        // lakukan perulangan sebanyak jumlah data mutasi
        for ($i = 0; $i < $jumlahKromosomMutasi; $i++) {

            // urutkan data berdasarkan nilai fitness
            $kromosom = AdminModel::urutanFitnessTertinggi($kromosom);

            // jika kromosom hasil mutasi sama dengan kromosom populasi
            // tidak dilakukan replace data
            // karena nilai fitness pasti sama
            // jadi tidak butuh kromosom yang sama

            // untuk kromosom pertama populasi
            if ($kromosomHasilMutasi[$i]['kromosom'] === $kromosom[0]['kromosom']) {

                // echo "Tidak replace data" . '<br>';
            } else
                // untuk kromosom kedua populasi
                if ($kromosomHasilMutasi[$i]['kromosom'] === $kromosom[1]['kromosom']) {
                    // echo "Tidak replace data" . '<br>';
                } else {
                    // jika kromosom hasil mutasi tidak sama dengan dua kromosom populasi awal
                    // echo "Replace data" . $i . '<br>';
                    if ($kromosomHasilMutasi[$i]['nilaiFitness'] > $kromosom[$jumlahKromosomPopulasi - 1]['nilaiFitness']) {
                        // echo "Keluarkan Array Kromosom " . $i . '<br>';
                        $kromosom[$jumlahKromosomPopulasi - 1] = $kromosomHasilMutasi[$i];
                        // dump($kromosom[$jumlahKromosomPopulasi - 1]);
                    }
                }
        }

        // lakukan manual aja
        // untuk kromosom pertama hasil mutasi
        // jika kromosom hasil mutasi sama dengan kromosom populasi
        // tidak dilakukan replace data
        // karena nilai fitness pasti sama
        // jadi tidak butuh kromosom yang sama
        // if ($kromosomHasilMutasi[0]['kromosom'] === $kromosom[0]['kromosom']) {
        //     echo "Kromosom 1 mutasi = kromosom 1 populasi " . ' <br>';
        //     echo $kromosomHasilMutasi[0]['kromosom'] . ' = ' . $kromosom[0]['kromosom'] . '<br>';
        // } else
        // if ($kromosomHasilMutasi[0]['kromosom'] === $kromosom[1]['kromosom']) {
        //     echo "Kromosom 1 mutasi = kromosom 2 populasi " . ' <br>';
        //     echo $kromosomHasilMutasi[0]['kromosom'] . ' = ' . $kromosom[1]['kromosom'] . '<br>';
        // } else {
        //     if ($kromosomHasilMutasi[0]['nilaiFitness'] > $kromosom[$jumlahKromosomPopulasi - 1]['nilaiFitness']) {
        //         echo "Kromosom 1 mutasi > kromosom terakhir populasi " . ' <br>';
        //         dump($kromosom[$jumlahKromosomPopulasi - 1]);
        //         // echo $kromosomHasilMutasi[0]['kromosom'] . ' = ' . $kromosom[$jumlahKromosomPopulasi - 1]['kromosom'] . '<br>';
        //         $kromosom[$jumlahKromosomPopulasi - 1] = $kromosomHasilMutasi[0];
        //         dump($kromosom[$jumlahKromosomPopulasi - 1]);
        //     }
        // }

        // dump($kromosomUrutFitness);
        // dump($hasilPop);
        // dump($kromosomHasilMutasi);
        // echo gettype($kromosomHasilMutasi[0]['nilaiFitness']);
        // dump($jumlahSatuKromosom);
        // dump($jumlahSatuHasil);
        $hasilCekDataMutasi = AdminModel::urutanFitnessTertinggi($kromosom);
        return $hasilCekDataMutasi;
    }

    // untuk convert dari kromosom menjadi data asli
    public static function convertKromosomToData($kromosom, $dataTanggal)
    {
        // dump($kromosom, $dataTanggal);
        $jumlahKromosom = count($kromosom);
        $tanggal = explode('-', $dataTanggal);
        $dataHasilConvert = $kromosom;
        // $tanggal[$i] = $dataTanggal['tahun'] . '-' . $dataTanggal['nomorBulan'] . '-' . bindec($kromosom[$i]['gen'][2]);
        // $tanggalKromosom[$i] = date('l', strtotime($tanggal[$i]));
        // dump($tanggal);
        for ($i = 0; $i < $jumlahKromosom; $i++) {
            $dataHasilConvert[$i]['idPegawai'] = bindec($kromosom[$i]['gen'][0]);
            $dataHasilConvert[$i]['idPiket'] = bindec($kromosom[$i]['gen'][1]);
            $convertTanggal[$i] = $tanggal['0'] . '-' . $tanggal['1'] . '-' . bindec($kromosom[$i]['gen'][2]);
            $dataHasilConvert[$i]['tanggal'] = $convertTanggal[$i];
            $dataHasilConvert[$i]['hari'] = date('l', strtotime($dataHasilConvert[$i]['tanggal']));
            unset($dataHasilConvert[$i]['kromosom'], $dataHasilConvert[$i]['gen']);
        }
        // dump($dataHasilConvert);
        return $dataHasilConvert;
    }


    public static function ConvertIdKromosom($kromosom)
    {

        $jumlahKromosom = count($kromosom);
        // getDataPegawaiById
        // getDataPiketById
        for ($i = 0; $i < $jumlahKromosom; $i++) {
            $dataPegawai[$i] = AdminModel::getDataPegawaiById($kromosom[$i]['idPegawai']);
            $kromosom[$i]['namaPegawai'] = $dataPegawai[$i][0]->nama_pegawai;
            $dataPiket[$i] = AdminModel::getDataPiketById($kromosom[$i]['idPiket']);
            $kromosom[$i]['namaPiket'] = $dataPiket[$i][0]->nama_piket;
        }

        // dump($dataPegawai);
        // dump($dataPiket);
        // dump($kromosom)
        return $kromosom;
    }

    public static function hasilAkhirPenjadwalan($kromosom, $tanggal)
    {

        // dump($kromosom);
        // dump($tanggal);
        // menyimpan data tanggal dari kromosom
        $tanggalHasilInput = $tanggal['tahun'] . '-' . $tanggal['nomorBulan'] . '-' . '01';

        // menghitung jumlah hari berdasarkan input
        $jumlahHariDalamBulan = intval(date('t', strtotime($tanggalHasilInput)));
        // dump($jumlahHariDalamBulan);

        // ini buat biar data duplicate ilang
        $kromosomUnique = array_map("unserialize", array_unique(array_map("serialize", $kromosom)));
        // dump($kromosomUnique);


        // hitung jumlah kromosom unique
        $jumlahKromosomUnique = count($kromosomUnique);
        // dump($jumlahKromosomUnique);

        // hitung jumlah kromosom
        $jumlahKromosom = count($kromosom);

        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        // dump($dataPegawaiUnique);

        $jumlahPegawaiUnique = count($dataPegawaiUnique);
        // dump($jumlahPegawaiUnique);

        for ($i = 0; $i < $jumlahHariDalamBulan; $i++) {
            $dataPiket[$i] = [
                'idPiket' => '',
                'namaPiket' => '',
                'tanggalPiket' => '',
                'nilaiFitness' => ''
            ];
        }


        for ($j = 0; $j < $jumlahPegawaiUnique; $j++) {
            $dataJadwal[$j]['idPegawai'] = '';
            $dataJadwal[$j]['namaPegawai'] = '';
            $dataJadwal[$j]['dataPiket'] = $dataPiket;
            // for ($i = 0; $i < $jumlahHariDalamBulan; $i++) {
            //     $dataJadwal[$j]['dataPiket'][$i] = [
            //         'idPiket' => '',
            //         'namaPiket' => '',
            //         'tanggalPiket' => '',
            //         'nilaiFitness' => ''
            //     ];
            // }
        }
        // dump($dataJadwal);
        // dump($pisahTanggal);

        for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
            $dataJadwal[$i]['idPegawai'] = $dataPegawaiUnique[$i]->id_pegawai;
            $dataJadwal[$i]['namaPegawai'] = $dataPegawaiUnique[$i]->nama_pegawai;
            $dataJadwal[$i]['dataPiket'] = $dataPiket;
            // dump($dataJadwal[$i]['dataPiket']);
            for ($j = 0; $j < $jumlahKromosom; $j++) {
                if ($dataJadwal[$i]['idPegawai'] === $kromosom[$j]['idPegawai']) {
                    $pisahTanggal = explode('-', $kromosom[$j]['tanggal']);
                    $indeksTanggal = intval($pisahTanggal[2]);
                    // dump($dataJadwal[$i]['dataPiket']);
                    // dump($indeksTanggal);
                    if ($indeksTanggal - 1 != -1) {
                        if ($dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['idPiket'] === '') {
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['idPiket'] = $kromosom[$j]['idPiket'];
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['namaPiket'] = $kromosom[$j]['namaPiket'];
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['tanggalPiket'] = $kromosom[$j]['tanggal'];
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
                        } else
                            if ($dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['nilaiFitness'] < $kromosom[$j]['nilaiFitness']) {
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['idPiket'] = $kromosom[$j]['idPiket'];
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['namaPiket'] = $kromosom[$j]['namaPiket'];
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['tanggalPiket'] = $kromosom[$j]['tanggal'];
                            $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
                        }
                    }

                    // if ($indeksTanggal - 1 !==  -1) {
                    //     if ($dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['idPiket'] === '') {
                    //         $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['idPiket'] = $kromosom[$j]['idPiket'];
                    //         $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['namaPiket'] = $kromosom[$j]['namaPiket'];
                    //         $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['tanggalPiket'] = $kromosom[$j]['tanggal'];
                    //         $dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
                    //     } else {
                    //         if ($dataJadwal[$i]['dataPiket'][$indeksTanggal - 1]['nilaiFitness'] < $kromosom[$j]['nilaiFitness']) {
                    //             $dataJadwal[$i] = $kromosom[$j];
                    //         }
                    //     }
                    // }
                    // dump($pisahTanggal[2]);
                    // if (intval($pisahTanggal[2]) === 0) {

                    //     if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[2]]['idPiket'] === '') {
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2]]['idPiket'] = $kromosom[$j]['idPiket'];
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2]]['namaPiket'] = $kromosom[$j]['namaPiket'];
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2]]['tanggalPiket'] = $kromosom[$j]['tanggal'];
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2]]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
                    //     } else {
                    //         if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[2]]['nilaiFitness'] < $kromosom[$j]['nilaiFitness']) {
                    //             $dataJadwal[$i] = $kromosom[$j];
                    //         }
                    //     }
                    // }
                    // else {
                    //     if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[2] - 1]['idPiket'] === '') {
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2] - 1]['idPiket'] = $kromosom[$j]['idPiket'];
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2] - 1]['namaPiket'] = $kromosom[$j]['namaPiket'];
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2] - 1]['tanggalPiket'] = $kromosom[$j]['tanggal'];
                    //         $dataJadwal[$i]['dataPiket'][$pisahTanggal[2] - 1]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
                    //     } else {
                    //         if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[2] - 1]['nilaiFitness'] < $kromosom[$j]['nilaiFitness']) {
                    //             $dataJadwal[$i] = $kromosom[$j];
                    //         }
                    //     }
                    // }
                }
            }
        }

        // for ($i = 0; $i < $jumlahPegawaiUnique; $i++) {
        //     $dataJadwal[$i]['idPegawai'] = $dataPegawaiUnique[$i]->id_pegawai;
        //     $dataJadwal[$i]['namaPegawai'] = $dataPegawaiUnique[$i]->nama_pegawai;
        //     for ($j = 0; $j < $jumlahKromosom; $j++) {
        //         $tanggalKromosom[$j] = $kromosom[$j]['tanggal'];
        //         $pisahTanggal[$j] = explode('-', $tanggalKromosom[$j]);
        //         if ($dataJadwal[$i]['idPegawai'] === $kromosom[$j]['idPegawai']) {
        //             if ($pisahTanggal[$j][2] === 0) {
        //                 if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['idPiket'] === '') {
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['idPiket'] = $kromosom[$j]['idPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['namaPiket'] = $kromosom[$j]['namaPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['tanggalPiket'] = $kromosom[$j]['tanggal'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
        //                 } else
        //                     if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['nilaiFitness'] < $kromosom[$j]['nilaiFitness']) {
        //                     // $dataJadwal[$i] = $kromosom[$j];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['idPiket'] = $kromosom[$j]['idPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['namaPiket'] = $kromosom[$j]['namaPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['tanggalPiket'] = $kromosom[$j]['tanggal'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2]]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
        //                 }
        //             } else {
        //                 if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['idPiket'] === '') {
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['idPiket'] = $kromosom[$j]['idPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['namaPiket'] = $kromosom[$j]['namaPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['tanggalPiket'] = $kromosom[$j]['tanggal'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
        //                 } else

        //                     if ($dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['nilaiFitness'] < $kromosom[$j]['nilaiFitness']) {
        //                     // $dataJadwal[$i] = $kromosom[$j];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['idPiket'] = $kromosom[$j]['idPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['namaPiket'] = $kromosom[$j]['namaPiket'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['tanggalPiket'] = $kromosom[$j]['tanggal'];
        //                     $dataJadwal[$i]['dataPiket'][$pisahTanggal[$j][2] - 1]['nilaiFitness'] = $kromosom[$j]['nilaiFitness'];
        //                 }
        //             }
        //         } else {
        //             // tidak ada hasil
        //         }
        //     }
        // }

        // dump($pisahTanggal);

        // dump($dataJadwal[0]['dataPiket']);




        // dump($dataJadwal);



        // return $kromosomUnique;
        return $dataJadwal;
    }

    public static function prosesLocalSearch($kromosomPopulasi, $kromosomMutasi)
    {
        // cari dengan fitness -1 untuk menghilangkan nilai minus

        // jumlah kromosom populasi
        $jumlahKromosomPopulasi = count($kromosomPopulasi);
        // dump($jumlahKromosomPopulasi);

        // jumlah kromosom mutasi
        $jumlahKromosomMutasi = count($kromosomMutasi);

        // $dataSatuLama = 0;
        // for ($i = 0; $i < $jumlahKromosomPopulasi; $i++) {
        //     if ($kromosomPopulasi[$i]['nilaiFitness'] === -1) {
        //         $dataSatuLama++;
        //     }
        // }
        // dump($dataSatuLama);

        // dump($kromosomPopulasi[0]['kromosom'], $kromosomPopulasi[1]['kromosom']);

        for ($i = 0; $i < $jumlahKromosomMutasi; $i++) {
            // cek apakah kromosom mutasi itu sama dengan kromosom populasi
            if (
                $kromosomMutasi[$i]['kromosom'] !== $kromosomPopulasi[0]['kromosom'] ||
                $kromosomMutasi[$i]['kromosom'] !== $kromosomPopulasi[1]['kromosom']
            ) {
                for ($j = 0; $j < $jumlahKromosomPopulasi; $j++) {
                    if ($kromosomMutasi[$i]['nilaiFitness'] > $kromosomPopulasi[$j]['nilaiFitness']) {
                        if ($kromosomPopulasi[$j]['nilaiFitness'] === -1) {
                            $kromosomPopulasi[$j] = $kromosomMutasi[$i];
                            break;
                            // dump($kromosomPopulasi[$j]);
                        }
                    }
                }
            }
        }

        // $dataSatu = 0;
        // for ($i = 0; $i < $jumlahKromosomPopulasi; $i++) {
        //     if ($kromosomPopulasi[$i]['nilaiFitness'] === -1) {
        //         $dataSatu++;
        //     }
        // }
        // dump($dataSatu);

        // $hasilLocalSearch = AdminModel::urutanFitnessTertinggi($kromosomPopulasi);
        // dump($hasilLocalSearch);

        return $kromosomPopulasi;
    }

    public static function prosesHillClimbing($kromosomPopulasi, $kromosomMutasi, $kromosomTertinggi)
    {
        // dump($kromosomPopulasi);
        // dump($kromosomMutasi);

        $jumlahKromosomPopulasi = count($kromosomPopulasi);
        $jumlahKromosomMutasi = count($kromosomMutasi);

        $kromosomTerbaik = '';
        for ($i = 0; $i < $jumlahKromosomPopulasi; $i++) {
            if ($kromosomPopulasi[$i]['nilaiFitness'] === -1) {
                $kromosomTerbaik = $kromosomPopulasi[$i];
                break;
            }
        }
        // dump($kromosomTerbaik);
        $kromosomSekarang = '';
        // dump($stateBest);

        // $kromosomMutasiPertama = $kromosomMutasi[0];
        // $kromosomMutasiKedua = $kromosomMutasi[1];
        $kromosomHasilPertama['nilaiFitness'] = '';
        $kromosomHasilKedua['nilaiFitness'] = '';
        $kromosomHasil = [];
        for ($i = 0; $i < $jumlahKromosomMutasi; $i++) {
            if (
                $kromosomMutasi[$i]['kromosom'] !== $kromosomTertinggi[0]['kromosom'] ||
                $kromosomMutasi[$i]['kromosom'] !== $kromosomTertinggi[1]['kromosom']
            ) {
                for ($j = 0; $j < $jumlahKromosomPopulasi; $j++) {
                    if ($kromosomMutasi[$i] !== $kromosomPopulasi[$j]) {
                        if ($kromosomMutasi[$i]['nilaiFitness'] > $kromosomPopulasi[$j]['nilaiFitness']) {
                            if ($kromosomPopulasi[$j]['nilaiFitness'] === -1) {
                                // $kromosomHasil[$i] = $kromosomPopulasi[$j];
                                // echo "ini awal" . '<br>';
                                // dump($kromosomPopulasi[$j]);
                                $kromosomPopulasi[$j] = $kromosomMutasi[$i];
                                // dump($kromosomPopulasi[$j]);
                                break;
                            }
                        }
                    }
                }
            }
        }

        // dump($kromosomPopulasi);
        return $kromosomPopulasi;


        // dump($kromosomHasilPertama);
        // dump($kromosomHasil);
    }





    // public static function prosesMemetika($dataMemetika)
    // {
    //     // dump($dataMemetika);

    //     // =============== Deklarasi Variabel ===============
    //     // untuk menyimpan data jumlah populasi
    //     $jumlahPopulasi = intval($dataMemetika['inputJumlahPopulasi']);

    //     // untuk menyimpan jumlah generasi
    //     $jumlahGenerasi = intval($dataMemetika['inputJumlahGenerasi']);

    //     // untuk menyimpan data nilai mutation rate
    //     $mutationRateInput = floatval($dataMemetika['inputMutationRate']);

    //     // untuk menyimpan data nilai crossover rate
    //     $crossoverRateInput = floatval($dataMemetika['inputCrossoverRate']);

    //     // untuk menyimpan data tanggal
    //     $dataTanggal = $dataMemetika['inputBulanPiket'];




    //     // echo $crossoverRateInput . '<br>';
    //     // echo $mutationRateInput  . '<br>';
    //     // echo $jumlahPopulasi . '<br>';

    //     // =============== Data Pegawai ===============
    //     // mengambil data pegawai
    //     $dataPegawai = AdminModel::getDataPegawaiAll();
    //     // dump($dataPegawai);

    //     // mengubah data pegawai menjadi binary
    //     $dataPegawaiBiner = AdminModel::dataPegawaiToBiner($dataPegawai);
    //     // dump($dataPegawaiBiner);



    //     // =============== Data Tanggal ===============
    //     // mengubah data tanggal menjadi binary
    //     $dataTanggalBiner = AdminModel::dataTanggalToBiner($dataTanggal);
    //     // dump($dataTanggalBiner);


    //     // =============== Data Piket ===============
    //     // mengambil semua data piket
    //     $dataPiket = AdminModel::getAllDataPiket();
    //     // dump($dataPiket);


    //     // mengubah data piket menjadi binary
    //     $dataPiketBiner = AdminModel::dataPiketToBiner($dataPiket);
    //     // dump($dataPiketBiner);

    //     // generate populasi awal
    //     $populasiAwal = AdminModel::generatePopulasiAwal($dataPegawaiBiner, $dataPiketBiner, $dataTanggalBiner, $jumlahPopulasi);
    //     // dump($populasiAwal);

    //     // split kromosom menjadi gen
    //     $convertKromosomToGen = AdminModel::splitKromosom($populasiAwal);
    //     // dump($convertKromosomToGen);


    //     $hitungNilaiFitnessKromosom = AdminModel::hitungNilaiFitnessBaru($convertKromosomToGen, $dataTanggalBiner);
    //     // dump($hitungNilaiFitnessKromosom);

    //     $urutFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
    //     // dump($urutFitnessTertinggi);
    //     // // ======================= INI PERCOBAAN  ========================

    //     // untuk menghitung jumlah kromosom fitness
    //     $dataSatuPopulasiAwalMinimum = 0;
    //     $dataSatuPopulasiAwalDua = 0;
    //     $dataSatuPopulasiAwalSatu = 0;
    //     $dataSatuPopulasiAwalNol = 0;
    //     $dataSatuPopulasiAwalMaksimum = 0;

    //     for ($i = 0; $i < count($urutFitnessTertinggi); $i++) {
    //         if ($urutFitnessTertinggi[$i]['nilaiFitness'] === -1) {
    //             $dataSatuPopulasiAwalMinimum++;
    //         } else
    //         if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 0) {
    //             $dataSatuPopulasiAwalNol++;
    //         } else
    //         if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 1) {
    //             $dataSatuPopulasiAwalSatu++;
    //         } else
    //         if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 2) {
    //             $dataSatuPopulasiAwalDua++;
    //         } else
    //         if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 3) {
    //             $dataSatuPopulasiAwalMaksimum++;
    //         }
    //     }

    //     $populasiAwalHasilConvert = AdminModel::convertKromosomToData($urutFitnessTertinggi, $dataTanggal);
    //     // dump($populasiAwalHasilConvert);

    //     $convertDataKromosomAwal = AdminModel::ConvertIdKromosom($populasiAwalHasilConvert);
    //     // dump($convertDataKromosomAwal);

    //     // kondisi selesai
    //     // hitung perhitungan crossover berdasarkan total populasi hasil input
    //     for ($i = 0; $i < $jumlahGenerasi; $i++) {

    //         // ini parameter nya harus diganti
    //         $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
    //         // dump($urutanKromosomFitnessTertinggi);

    //         // echo "Fitness Tertinggi";
    //         // pemilihan dua kromosom tertinggi
    //         $hasilSeleksiKromosomFitnessTertinggi = AdminModel::seleksiFitnessTertinggiBaru($urutanKromosomFitnessTertinggi);
    //         // dump($hasilSeleksiKromosomFitnessTertinggi);

    //         // tes crossover
    //         $hasilCrossoverKromosom = AdminModel::singlePointCrossoverBaru($hasilSeleksiKromosomFitnessTertinggi, $crossoverRateInput);
    //         // dump($hasilCrossover);

    //         // hitung nilai fitness baru hasil crossover
    //         // $hitungNilaiFitnessHasilCrossover = AdminModel::hitungNilaiFitnessBaru($hasilCrossoverKromosom, $dataTanggalBiner);
    //         // // dump($hitungNilaiFitnessHasilCrossover);

    //         // mutasi dua kromosom hasil crossover
    //         $kromosomHasilMutasi = AdminModel::bitFlipMutationBaru($hasilCrossoverKromosom, $mutationRateInput);
    //         // dump($kromosomHasilMutasi);

    //         // split kromosom menjadi gen hasil mutasi
    //         $splitKromosomHasilMutasi = AdminModel::splitKromosom($kromosomHasilMutasi);
    //         // dump($splitKromosomHasilMutasi);

    //         // hitung nilai fitness baru hasil mutasi
    //         // disini ada error karena data kosong
    //         // error ini ntar
    //         $hitungNilaiFitnessHasilMutasi = AdminModel::hitungNilaiFitnessBaru($splitKromosomHasilMutasi, $dataTanggalBiner);
    //         // dump($hitungNilaiFitnessHasilMutasi);

    //         // ini buat replace data mutasi ke populasi
    //         // $hitungNilaiFitnessKromosom = AdminModel::cekDataMutasiKePopulasi($urutanKromosomFitnessTertinggi, $hitungNilaiFitnessHasilMutasi);
    //         // // dump($urutanKromosomFitnessTertinggi);

    //         // proses memetika / local search
    //         // cari data kromosom tertinggi untuk dicek ke mutasi
    //         $hitungNilaiFitnessKromosom = AdminModel::prosesLocalSearch($urutanKromosomFitnessTertinggi, $hitungNilaiFitnessHasilMutasi);
    //         // dump($hitungNilaiFitnessKromosom);
    //     }
    //     // dump($hitungNilaiFitnessKromosom);

    //     $dataSatuPopulasiAkhirMinimum = 0;
    //     $dataSatuPopulasiAkhirDua = 0;
    //     $dataSatuPopulasiAkhirSatu = 0;
    //     $dataSatuPopulasiAkhirNol = 0;
    //     $dataSatuPopulasiAkhirMaksimum = 0;



    //     for ($i = 0; $i < count($hitungNilaiFitnessKromosom); $i++) {
    //         if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === -1) {
    //             $dataSatuPopulasiAkhirMinimum++;
    //         } else
    //         if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 0) {
    //             $dataSatuPopulasiAkhirNol++;
    //         } else
    //         if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 1) {
    //             $dataSatuPopulasiAkhirSatu++;
    //         } else
    //         if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 2) {
    //             $dataSatuPopulasiAkhirDua++;
    //         } else
    //         if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 3) {
    //             $dataSatuPopulasiAkhirMaksimum++;
    //         }
    //     }

    //     $populasiAkhirHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
    //     // dump($populasiAkhirHasilConvert);

    //     $convertDataKromosomAkhir = AdminModel::ConvertIdKromosom($populasiAkhirHasilConvert);
    //     // dump($convertDataKromosomAkhir);

    //     // dump($dataSatuPopulasiAwalMinimum, $dataSatuPopulasiAkhirMinimum);
    //     // dump($dataSatuPopulasiAwalMaksimum, $dataSatuPopulasiAkhirMaksimum);

    //     $hasilAkhirPerhitungan = AdminModel::hasilAkhirPenjadwalan($convertDataKromosomAkhir, $dataTanggalBiner);
    //     // dump($hasilAkhirPerhitungan);

    //     // ambil data pegawai
    //     $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
    //     $hasilMemetika = [
    //         'dataTanggal' => $dataTanggalBiner,
    //         'jumlahHari' => count($dataTanggalBiner['hari']),
    //         'dataPegawai' => $dataPegawaiUnique,
    //         'populasiAwal' => $convertDataKromosomAwal,
    //         'populasiAkhir' => $convertDataKromosomAkhir,
    //         'populasiAkhirPerhitungan' => $hasilAkhirPerhitungan,
    //         'totalKromosomPopulasiAwal' => [
    //             $dataSatuPopulasiAwalMaksimum,
    //             $dataSatuPopulasiAwalDua,
    //             $dataSatuPopulasiAwalSatu,
    //             $dataSatuPopulasiAwalNol,
    //             $dataSatuPopulasiAwalMinimum
    //         ],
    //         'totalKromosomPopulasiAkhir' => [
    //             $dataSatuPopulasiAkhirMaksimum,
    //             $dataSatuPopulasiAkhirDua,
    //             $dataSatuPopulasiAkhirSatu,
    //             $dataSatuPopulasiAkhirNol,
    //             $dataSatuPopulasiAkhirMinimum
    //         ],
    //     ];

    //     return $hasilMemetika;
    // }



    // Algoritma Neuro Fuzzy
    public static function prosesNeuroFuzzy($dataNeuroFuzzy)
    {
        // dump($dataMemetika);

        // =============== Deklarasi Variabel ===============
        // untuk menyimpan data jumlah populasi
        $jumlahPopulasi = intval($dataNeuroFuzzy['inputJumlahPopulasi']);

        // untuk menyimpan jumlah generasi
        $jumlahGenerasi = intval($dataNeuroFuzzy['inputJumlahGenerasi']);

        // untuk menyimpan data nilai mutation rate
        $mutationRateInput = floatval($dataNeuroFuzzy['inputMutationRate']);

        // untuk menyimpan data nilai crossover rate
        $crossoverRateInput = floatval($dataNeuroFuzzy['inputCrossoverRate']);

        // untuk menyimpan data tanggal
        $dataTanggal = $dataNeuroFuzzy['inputBulanPiket'];




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



        // $urutFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
        // // dump($urutFitnessTertinggi);

        // // ini untuk menghitung kromosom yang gak duplikat
        // $kromosomPopulasiAwalUnique = array_map("unserialize", array_unique(array_map("serialize", $urutFitnessTertinggi)));
        // // dump($kromosomPopulasiAwalUnique);

        // // ======================= INI PERCOBAAN  ========================

        // untuk menghitung jumlah kromosom fitness
        $dataSatuPopulasiAwalMinimum = 0;
        $dataSatuPopulasiAwalDua = 0;
        $dataSatuPopulasiAwalSatu = 0;
        $dataSatuPopulasiAwalNol = 0;
        $dataSatuPopulasiAwalMaksimum = 0;

        for ($i = 0; $i < count($hitungNilaiFitnessKromosom); $i++) {
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === -1) {
                $dataSatuPopulasiAwalMinimum++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 0) {
                $dataSatuPopulasiAwalNol++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 1) {
                $dataSatuPopulasiAwalSatu++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 2) {
                $dataSatuPopulasiAwalDua++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 3) {
                $dataSatuPopulasiAwalMaksimum++;
            }
        }

        $populasiAwalHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
        // dump($populasiAwalHasilConvert);

        $convertDataKromosomAwal = AdminModel::ConvertIdKromosom($populasiAwalHasilConvert);
        // dump($convertDataKromosomAwal);


        // // kondisi selesai
        // // hitung perhitungan crossover berdasarkan total populasi hasil input
        for ($i = 0; $i < $jumlahGenerasi; $i++) {

            // // ini parameter nya harus diganti
            // $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
            // // dump($urutanKromosomFitnessTertinggi);

            //
            // $hitungNilaiFitnessKromosom = AdminModel::hitungNilaiFitnessBaru($convertKromosomToGen, $dataTanggalBiner);
            // // dump($hitungNilaiFitnessKromosom);

            // coba kalo langsung urutkan
            // // kalo gak diurutkan dulu nanti malah kelamaan cari data nya
            // $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
            // // dump($urutanKromosomFitnessTertinggi);

            // ini kalo langsung dapet kromosom tertinggi
            // $hasilSeleksiFitnessTertinggiBaruSearch = AdminModel::seleksiFitnessTertinggiBaruSearch($urutanKromosomFitnessTertinggi);
            // // dump($hasilSeleksiFitnessTertinggiBaruSearch);

            // ini baru
            $hasilSeleksiFitnessTertinggiBaruSearch = AdminModel::seleksiFitnessTertinggiBaruSearch($hitungNilaiFitnessKromosom);
            // dump($hasilSeleksiFitnessTertinggiBaruSearch);

            // tes crossover
            $hasilCrossoverKromosom = AdminModel::singlePointCrossoverBaru($hasilSeleksiFitnessTertinggiBaruSearch, $crossoverRateInput);
            // dump($hasilCrossoverKromosom);

            // hitung nilai fitness baru hasil crossover
            $hitungNilaiFitnessHasilCrossover = AdminModel::hitungNilaiFitnessBaru($hasilCrossoverKromosom, $dataTanggalBiner);
            // dump($hitungNilaiFitnessHasilCrossover);

            // // mutasi dua kromosom hasil crossover
            $kromosomHasilMutasi = AdminModel::bitFlipMutationBaru($hasilCrossoverKromosom, $mutationRateInput);
            // dump($kromosomHasilMutasi);

            // // split kromosom menjadi gen hasil mutasi
            $splitKromosomHasilMutasi = AdminModel::splitKromosom($kromosomHasilMutasi);
            // dump($splitKromosomHasilMutasi);

            // // // hitung nilai fitness baru hasil mutasi
            $hitungNilaiFitnessHasilMutasi = AdminModel::hitungNilaiFitnessBaru($splitKromosomHasilMutasi, $dataTanggalBiner);
            // dump($hitungNilaiFitnessHasilMutasi);

            // proses local search hill climbing
            $hitungNilaiFitnessKromosom = AdminModel::prosesHillClimbing($hitungNilaiFitnessKromosom, $hitungNilaiFitnessHasilMutasi, $hasilSeleksiFitnessTertinggiBaruSearch);
            // dump($hasilProsesLocalSearch);
        }
        // dump($hitungNilaiFitnessKromosom);

        $dataSatuPopulasiAkhirMinimum = 0;
        $dataSatuPopulasiAkhirDua = 0;
        $dataSatuPopulasiAkhirSatu = 0;
        $dataSatuPopulasiAkhirNol = 0;
        $dataSatuPopulasiAkhirMaksimum = 0;



        for ($i = 0; $i < count($hitungNilaiFitnessKromosom); $i++) {
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === -1) {
                $dataSatuPopulasiAkhirMinimum++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 0) {
                $dataSatuPopulasiAkhirNol++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 1) {
                $dataSatuPopulasiAkhirSatu++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 2) {
                $dataSatuPopulasiAkhirDua++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 3) {
                $dataSatuPopulasiAkhirMaksimum++;
            }
        }

        // echo $dataSatuPopulasiAwalMaksimum . '<br>' . $dataSatuPopulasiAkhirMaksimum . "<br>";
        // echo $dataSatuPopulasiAwalNol . '<br>' . $dataSatuPopulasiAkhirNol . "<br>";
        // echo $dataSatuPopulasiAwalSatu . '<br>' . $dataSatuPopulasiAkhirSatu . "<br>";
        // echo $dataSatuPopulasiAwalDua . '<br>' . $dataSatuPopulasiAkhirDua . "<br>";
        // echo $dataSatuPopulasiAwalMinimum . '<br>' . $dataSatuPopulasiAkhirMinimum;

        $populasiAkhirHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
        // dump($populasiAkhirHasilConvert);

        $convertDataKromosomAkhir = AdminModel::ConvertIdKromosom($populasiAkhirHasilConvert);
        // dump($convertDataKromosomAkhir);

        // dump($dataSatuPopulasiAwalMinimum, $dataSatuPopulasiAkhirMinimum);
        // dump($dataSatuPopulasiAwalMaksimum, $dataSatuPopulasiAkhirMaksimum);

        $hasilAkhirPerhitungan = AdminModel::hasilAkhirPenjadwalan($convertDataKromosomAkhir, $dataTanggalBiner);
        // print_r($hasilAkhirPerhitungan);
        // dump($hasilAkhirPerhitungan);

        // // ambil data pegawai
        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        $hasilMemetika = [
            'dataTanggal' => $dataTanggalBiner,
            'jumlahHari' => count($dataTanggalBiner['hari']),
            'dataPegawai' => $dataPegawaiUnique,
            'populasiAwal' => $convertDataKromosomAwal,
            'populasiAkhir' => $convertDataKromosomAkhir,
            'populasiAkhirPerhitungan' => $hasilAkhirPerhitungan,
            'totalKromosomPopulasiAwal' => [
                $dataSatuPopulasiAwalMaksimum,
                $dataSatuPopulasiAwalDua,
                $dataSatuPopulasiAwalSatu,
                $dataSatuPopulasiAwalNol,
                $dataSatuPopulasiAwalMinimum
            ],
            'totalKromosomPopulasiAkhir' => [
                $dataSatuPopulasiAkhirMaksimum,
                $dataSatuPopulasiAkhirDua,
                $dataSatuPopulasiAkhirSatu,
                $dataSatuPopulasiAkhirNol,
                $dataSatuPopulasiAkhirMinimum
            ],
        ];

        return $hasilMemetika;
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

        $urutFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
        // dump($urutFitnessTertinggi);
        // // ======================= INI PERCOBAAN  ========================

        // untuk menghitung jumlah kromosom fitness
        $dataSatuPopulasiAwalMinimum = 0;
        $dataSatuPopulasiAwalDua = 0;
        $dataSatuPopulasiAwalSatu = 0;
        $dataSatuPopulasiAwalNol = 0;
        $dataSatuPopulasiAwalMaksimum = 0;

        for ($i = 0; $i < count($urutFitnessTertinggi); $i++) {
            if ($urutFitnessTertinggi[$i]['nilaiFitness'] === -1) {
                $dataSatuPopulasiAwalMinimum++;
            } else
            if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 0) {
                $dataSatuPopulasiAwalNol++;
            } else
            if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 1) {
                $dataSatuPopulasiAwalSatu++;
            } else
            if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 2) {
                $dataSatuPopulasiAwalDua++;
            } else
            if ($urutFitnessTertinggi[$i]['nilaiFitness'] === 3) {
                $dataSatuPopulasiAwalMaksimum++;
            }
        }

        $populasiAwalHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
        // dump($populasiAwalHasilConvert);

        $convertDataKromosomAwal = AdminModel::ConvertIdKromosom($populasiAwalHasilConvert);
        // dump($convertDataKromosomAwal);

        // kondisi selesai
        // hitung perhitungan crossover berdasarkan total populasi hasil input
        for ($i = 0; $i < $jumlahGenerasi; $i++) {

            // // ini parameter nya harus diganti
            // $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
            // // dump($urutanKromosomFitnessTertinggi);

            //
            // $hitungNilaiFitnessKromosom = AdminModel::hitungNilaiFitnessBaru($convertKromosomToGen, $dataTanggalBiner);
            // // dump($hitungNilaiFitnessKromosom);

            // coba kalo langsung urutkan
            // // kalo gak diurutkan dulu nanti malah kelamaan cari data nya
            // $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
            // // dump($urutanKromosomFitnessTertinggi);

            // ini kalo langsung dapet kromosom tertinggi
            // $hasilSeleksiFitnessTertinggiBaruSearch = AdminModel::seleksiFitnessTertinggiBaruSearch($urutanKromosomFitnessTertinggi);
            // // dump($hasilSeleksiFitnessTertinggiBaruSearch);

            // ini baru
            $hasilSeleksiFitnessTertinggiBaruSearch = AdminModel::seleksiFitnessTertinggiBaruSearch($hitungNilaiFitnessKromosom);
            // dump($hasilSeleksiFitnessTertinggiBaruSearch);

            // tes crossover
            $hasilCrossoverKromosom = AdminModel::singlePointCrossoverBaru($hasilSeleksiFitnessTertinggiBaruSearch, $crossoverRateInput);
            // dump($hasilCrossoverKromosom);

            // hitung nilai fitness baru hasil crossover
            $hitungNilaiFitnessHasilCrossover = AdminModel::hitungNilaiFitnessBaru($hasilCrossoverKromosom, $dataTanggalBiner);
            // dump($hitungNilaiFitnessHasilCrossover);

            // // mutasi dua kromosom hasil crossover
            $kromosomHasilMutasi = AdminModel::bitFlipMutationBaru($hasilCrossoverKromosom, $mutationRateInput);
            // dump($kromosomHasilMutasi);

            // // split kromosom menjadi gen hasil mutasi
            $splitKromosomHasilMutasi = AdminModel::splitKromosom($kromosomHasilMutasi);
            // dump($splitKromosomHasilMutasi);

            // // // hitung nilai fitness baru hasil mutasi
            $hitungNilaiFitnessHasilMutasi = AdminModel::hitungNilaiFitnessBaru($splitKromosomHasilMutasi, $dataTanggalBiner);
            // dump($hitungNilaiFitnessHasilMutasi);

            // proses local search hill climbing
            $hitungNilaiFitnessKromosom = AdminModel::prosesHillClimbing($hitungNilaiFitnessKromosom, $hitungNilaiFitnessHasilMutasi, $hasilSeleksiFitnessTertinggiBaruSearch);
            // dump($hasilProsesLocalSearch);
        }
        // dump($hitungNilaiFitnessKromosom);

        $dataSatuPopulasiAkhirMinimum = 0;
        $dataSatuPopulasiAkhirDua = 0;
        $dataSatuPopulasiAkhirSatu = 0;
        $dataSatuPopulasiAkhirNol = 0;
        $dataSatuPopulasiAkhirMaksimum = 0;



        for ($i = 0; $i < count($hitungNilaiFitnessKromosom); $i++) {
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === -1) {
                $dataSatuPopulasiAkhirMinimum++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 0) {
                $dataSatuPopulasiAkhirNol++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 1) {
                $dataSatuPopulasiAkhirSatu++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 2) {
                $dataSatuPopulasiAkhirDua++;
            } else
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 3) {
                $dataSatuPopulasiAkhirMaksimum++;
            }
        }

        $populasiAkhirHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
        // dump($populasiAkhirHasilConvert);

        $convertDataKromosomAkhir = AdminModel::ConvertIdKromosom($populasiAkhirHasilConvert);
        // dump($convertDataKromosomAkhir);

        // dump($dataSatuPopulasiAwalMinimum, $dataSatuPopulasiAkhirMinimum);
        // dump($dataSatuPopulasiAwalMaksimum, $dataSatuPopulasiAkhirMaksimum);

        $hasilAkhirPerhitungan = AdminModel::hasilAkhirPenjadwalan($convertDataKromosomAkhir, $dataTanggalBiner);
        // dump($hasilAkhirPerhitungan);

        // ambil data pegawai
        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        $hasilMemetika = [
            'dataTanggal' => $dataTanggalBiner,
            'jumlahHari' => count($dataTanggalBiner['hari']),
            'dataPegawai' => $dataPegawaiUnique,
            'populasiAwal' => $convertDataKromosomAwal,
            'populasiAkhir' => $convertDataKromosomAkhir,
            'populasiAkhirPerhitungan' => $hasilAkhirPerhitungan,
            'totalKromosomPopulasiAwal' => [
                $dataSatuPopulasiAwalMaksimum,
                $dataSatuPopulasiAwalDua,
                $dataSatuPopulasiAwalSatu,
                $dataSatuPopulasiAwalNol,
                $dataSatuPopulasiAwalMinimum
            ],
            'totalKromosomPopulasiAkhir' => [
                $dataSatuPopulasiAkhirMaksimum,
                $dataSatuPopulasiAkhirDua,
                $dataSatuPopulasiAkhirSatu,
                $dataSatuPopulasiAkhirNol,
                $dataSatuPopulasiAkhirMinimum
            ],
        ];

        return $hasilMemetika;
    }


    // proses algoritma Genetika

    public static function prosesGenetika($dataGenetika)
    {
        // dump($dataGenetika);

        // =============== Deklarasi Variabel ===============
        // untuk menyimpan data jumlah populasi
        $jumlahPopulasi = intval($dataGenetika['inputJumlahPopulasi']);

        // untuk menyimpan jumlah generasi
        $jumlahGenerasi = intval($dataGenetika['inputJumlahGenerasi']);

        // untuk menyimpan data nilai mutation rate
        $mutationRateInput = floatval($dataGenetika['inputMutationRate']);

        // untuk menyimpan data nilai crossover rate
        $crossoverRateInput = floatval($dataGenetika['inputCrossoverRate']);

        // untuk menyimpan data tanggal
        $dataTanggal = $dataGenetika['inputBulanPiket'];


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

        //     // // ======================= INI PERCOBAAN  ========================

        // untuk menghitung jumlah kromosom fitness
        $dataSatuPopulasiAwalMinimum = 0;
        $dataSatuPopulasiAwalDua = 0;
        $dataSatuPopulasiAwalSatu = 0;
        $dataSatuPopulasiAwalNol = 0;
        $dataSatuPopulasiAwalMaksimum = 0;

        for ($i = 0; $i < count($hitungNilaiFitnessKromosom); $i++) {
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === -1) {
                $dataSatuPopulasiAwalMinimum++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 0) {
                $dataSatuPopulasiAwalNol++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 1) {
                $dataSatuPopulasiAwalSatu++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 2) {
                $dataSatuPopulasiAwalDua++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 3) {
                $dataSatuPopulasiAwalMaksimum++;
            }
        }

        // ini gak perlu dijalankan

        $populasiAwalHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
        // dump($populasiAwalHasilConvert);

        $convertDataKromosomAwal = AdminModel::ConvertIdKromosom($populasiAwalHasilConvert);
        // dump($convertDataKromosomAwal);

        // kondisi selesai
        // hitung perhitungan crossover berdasarkan total populasi hasil input
        for ($i = 0; $i < $jumlahGenerasi; $i++) {

            // ini parameter nya harus diganti
            $urutanKromosomFitnessTertinggi = AdminModel::urutanFitnessTertinggi($hitungNilaiFitnessKromosom);
            // dump($urutanKromosomFitnessTertinggi);

            // echo "Fitness Tertinggi";
            // pemilihan dua kromosom tertinggi
            $hasilSeleksiKromosomFitnessTertinggi = AdminModel::seleksiFitnessTertinggiBaru($urutanKromosomFitnessTertinggi);
            // dump($hasilSeleksiKromosomFitnessTertinggi);

            // crossover kromosom
            // $hasilCrossoverKromosom = AdminModel::singlePointCrossoverBaru($hasilSeleksiKromosomFitnessTertinggi, $crossoverRateInput);
            $hasilCrossoverKromosom = AdminModel::crossoverKromosom($hasilSeleksiKromosomFitnessTertinggi, $crossoverRateInput);
            // dump($hasilCrossoverKromosom);

            // hitung nilai fitness baru hasil crossover
            $hitungNilaiFitnessHasilCrossover = AdminModel::hitungNilaiFitnessBaru($hasilCrossoverKromosom, $dataTanggalBiner);
            // dump($hitungNilaiFitnessHasilCrossover);

            // mutasi dua kromosom hasil crossover
            $kromosomHasilMutasi = AdminModel::bitFlipMutationBaru($hasilCrossoverKromosom, $mutationRateInput);
            // dump($kromosomHasilMutasi);

            // split kromosom menjadi gen hasil mutasi
            $splitKromosomHasilMutasi = AdminModel::splitKromosom($kromosomHasilMutasi);
            // dump($splitKromosomHasilMutasi);

            // hitung nilai fitness baru hasil mutasi
            $hitungNilaiFitnessHasilMutasi = AdminModel::hitungNilaiFitnessBaru($splitKromosomHasilMutasi, $dataTanggalBiner);
            // dump($hitungNilaiFitnessHasilMutasi);

            // ini buat replace data mutasi ke populasi
            $hitungNilaiFitnessKromosom = AdminModel::cekDataMutasiKePopulasi($urutanKromosomFitnessTertinggi, $hitungNilaiFitnessHasilMutasi);
            // dump($urutanKromosomFitnessTertinggi);

            // // proses memetika / local search
            // // cari data kromosom tertinggi untuk dicek ke mutasi
            // $hitungNilaiFitnessKromosom = AdminModel::prosesLocalSearch($urutanKromosomFitnessTertinggi, $hitungNilaiFitnessHasilMutasi);
            // // dump($hitungNilaiFitnessKromosom);
        }
        //     // dump($hitungNilaiFitnessKromosom);

        $dataSatuPopulasiAkhirMinimum = 0;
        $dataSatuPopulasiAkhirDua = 0;
        $dataSatuPopulasiAkhirSatu = 0;
        $dataSatuPopulasiAkhirNol = 0;
        $dataSatuPopulasiAkhirMaksimum = 0;



        for ($i = 0; $i < count($hitungNilaiFitnessKromosom); $i++) {
            if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === -1) {
                $dataSatuPopulasiAkhirMinimum++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 0) {
                $dataSatuPopulasiAkhirNol++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 1) {
                $dataSatuPopulasiAkhirSatu++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 2) {
                $dataSatuPopulasiAkhirDua++;
            } else
                if ($hitungNilaiFitnessKromosom[$i]['nilaiFitness'] === 3) {
                $dataSatuPopulasiAkhirMaksimum++;
            }
        }

        // echo $dataSatuPopulasiAwalMaksimum . " " . $dataSatuPopulasiAkhirMaksimum . '<br>';
        // echo $dataSatuPopulasiAwalDua . " " . $dataSatuPopulasiAkhirDua . '<br>';
        // echo $dataSatuPopulasiAwalSatu . " " . $dataSatuPopulasiAkhirSatu . '<br>';
        // echo $dataSatuPopulasiAwalNol . " " . $dataSatuPopulasiAkhirNol . '<br>';
        // echo $dataSatuPopulasiAwalMinimum . " " . $dataSatuPopulasiAkhirMinimum . '<br>';

        $populasiAkhirHasilConvert = AdminModel::convertKromosomToData($hitungNilaiFitnessKromosom, $dataTanggal);
        // dump($populasiAkhirHasilConvert);

        $convertDataKromosomAkhir = AdminModel::ConvertIdKromosom($populasiAkhirHasilConvert);
        // dump($convertDataKromosomAkhir);

        // dump($dataSatuPopulasiAwalMinimum, $dataSatuPopulasiAkhirMinimum);
        // dump($dataSatuPopulasiAwalMaksimum, $dataSatuPopulasiAkhirMaksimum);

        $hasilAkhirPerhitungan = AdminModel::hasilAkhirPenjadwalan($convertDataKromosomAkhir, $dataTanggalBiner);
        // dump($hasilAkhirPerhitungan);

        // ambil data pegawai
        $dataPegawaiUnique = AdminModel::getAllDataPegawaiUnique();
        $hasilGenetika = [
            'dataTanggal' => $dataTanggalBiner,
            'jumlahHari' => count($dataTanggalBiner['hari']),
            'dataPegawai' => $dataPegawaiUnique,
            'populasiAwal' => $convertDataKromosomAwal,
            'populasiAkhir' => $convertDataKromosomAkhir,
            'populasiAkhirPerhitungan' => $hasilAkhirPerhitungan,
            'totalKromosomPopulasiAwal' => [
                $dataSatuPopulasiAwalMaksimum,
                $dataSatuPopulasiAwalDua,
                $dataSatuPopulasiAwalSatu,
                $dataSatuPopulasiAwalNol,
                $dataSatuPopulasiAwalMinimum
            ],
            'totalKromosomPopulasiAkhir' => [
                $dataSatuPopulasiAkhirMaksimum,
                $dataSatuPopulasiAkhirDua,
                $dataSatuPopulasiAkhirSatu,
                $dataSatuPopulasiAkhirNol,
                $dataSatuPopulasiAkhirMinimum
            ],
        ];

        return $hasilGenetika;
    }
}
