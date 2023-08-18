<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triwulan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // rentang bulan awal dan bulan akhir
    public function rentangWaktu()
    {
        return $this->konvesiBulan($this->bulan_awal) . ' ' . $this->tahun_awal . ' s.d ' . $this->konvesiBulan($this->bulan_akhir) . ' ' . $this->tahun_akhir;
    }

    // konversi bulan angka ke nama bulan
    public function konvesiBulan($nomorBulan)
    {
        switch ($nomorBulan) {
            case 1:
                $namaBulan = 'Januari';
                break;
            case 2:
                $namaBulan = 'Februari';
                break;
            case 3:
                $namaBulan = 'Maret';
                break;
            case 4:
                $namaBulan = 'April';
                break;
            case 5:
                $namaBulan = 'Mei';
                break;
            case 6:
                $namaBulan = 'Juni';
                break;
            case 7:
                $namaBulan = 'Juli';
                break;
            case 8:
                $namaBulan = 'Agustus';
                break;
            case 9:
                $namaBulan = 'September';
                break;
            case 10:
                $namaBulan = 'Oktober';
                break;
            case 11:
                $namaBulan = 'November';
                break;
            case 12:
                $namaBulan = 'Desember';
                break;
            default:
                $namaBulan = 'Bulan Tidak Valid';
                break;
        }

        return $namaBulan;
    }

    public static function daftarBulan()
    {
        return collect([
            ['nomor' => 1, 'nama' => 'Januari'],
            ['nomor' => 2, 'nama' => 'Februari'],
            ['nomor' => 3, 'nama' => 'Maret'],
            ['nomor' => 4, 'nama' => 'April'],
            ['nomor' => 5, 'nama' => 'Mei'],
            ['nomor' => 6, 'nama' => 'Juni'],
            ['nomor' => 7, 'nama' => 'Juli'],
            ['nomor' => 8, 'nama' => 'Agustus'],
            ['nomor' => 9, 'nama' => 'September'],
            ['nomor' => 10, 'nama' => 'Oktober'],
            ['nomor' => 11, 'nama' => 'November'],
            ['nomor' => 12, 'nama' => 'Desember'],
        ]);
    }

    public function scopeActive($query)
    {
        $bulan_sekarang = Carbon::now()->translatedFormat('m');
        $tahun_sekarang = Carbon::now()->translatedFormat('Y');
        $query->where('bulan_awal', '<=', $bulan_sekarang)->where('tahun_awal', '<=', $tahun_sekarang)->where('bulan_akhir', '>=', $bulan_sekarang)->where('tahun_akhir', '>=', $tahun_sekarang);
    }

    public function checkActive()
    {
        $bulan_sekarang = Carbon::now()->translatedFormat('m');
        $tahun_sekarang = Carbon::now()->translatedFormat('Y');
        $response = Triwulan::where('id', $this->id)->where('bulan_awal', '<=', $bulan_sekarang)->where('tahun_awal', '<=', $tahun_sekarang)->where('bulan_akhir', '>=', $bulan_sekarang)->where('tahun_akhir', '>=', $tahun_sekarang)->count();

        if ($response > 0)
            return true;
        else
            return false;
    }
}
