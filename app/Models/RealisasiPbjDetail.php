<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisasiPbjDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function realisasiPbj()
    {
        return $this->belongsTo(RealisasiPbj::class);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBarangJasa::class, 'jenis_barang_jasa_id', 'id');
    }
}
