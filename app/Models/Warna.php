<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kain()
    {
        return $this->belongsTo(Kain::class);
    }

    public function pcs()
    {
        return $this->hasMany(Pcs::class);
    }

    public function getTotalReadyPcsAttribute()
    {
        return $this->pcs->where('status', null)->count();
    }
}
