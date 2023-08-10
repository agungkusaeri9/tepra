<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanDanaAnggaran extends Model
{
    use HasFactory;
    protected $table = 'penarikan_anggaran';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(PenarikanDanaAnggaranDetail::class, 'penarikan_anggaran_id', 'id');
    }
}
