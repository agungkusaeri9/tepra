<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetPbj extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function triwulan()
    {
        return $this->belongsTo(Triwulan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TargetPbjDetail::class);
    }
}
