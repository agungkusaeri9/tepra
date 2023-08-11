<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetPbjDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function targetPbj()
    {
        return $this->belongsTo(TargetPbj::class);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBarangJasa::class, 'jenis_barang_jasa_id', 'id');
    }
}
