<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcsKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function warna()
    {
        return $this->belongsTo(WarnaKeluar::class);
    }
}
