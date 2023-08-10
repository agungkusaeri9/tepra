<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermasalahanPenarikanDanaAnggaran extends Model
{
    use HasFactory;
    protected $table = 'permasalahan_anggarans';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timTepra()
    {
        return $this->belongsTo(User::class, 'tim_tepra_user_id', 'id');
    }
}
