<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class);
    }

    public function triwulan()
    {
        return $this->belongsTo(Triwulan::class);
    }
}
