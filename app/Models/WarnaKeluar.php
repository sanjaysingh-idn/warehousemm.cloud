<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarnaKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kain()
    {
        return $this->belongsTo(KainKeluar::class);
    }

    public function pcs()
    {
        return $this->hasMany(PcsKeluar::class);
    }
}
