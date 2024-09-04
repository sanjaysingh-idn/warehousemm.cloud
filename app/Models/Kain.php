<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kain extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warnas()
    {
        return $this->hasMany(Warna::class);
    }

    public function pcsCount()
    {
        return $this->warnas->flatMap(function ($warna) {
            return $warna->pcs;
        })->count();
    }

    public function pcsCountWhereSatuanNull()
    {
        return $this->warnas->flatMap(function ($warna) {
            return $warna->pcs->where('status', null);
        })->count();
    }

    public function pcsCountWhereSatuanNotNull()
    {
        return $this->warnas->flatMap(function ($warna) {
            return $warna->pcs->whereNotNull('status');
        })->count();
    }
}
