<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanDanaAnggaranDetail extends Model
{
    use HasFactory;
    protected $table = 'penarikan_anggaran_details';
    protected $guarded = ['id'];

    public function penarikanDana()
    {
        return $this->belongsTo(PenarikanDanaAnggaran::class, 'penarikan_anggaran_id', 'id');
    }

    public function triwulan()
    {
        return $this->belongsTo(Triwulan::class);
    }
}
