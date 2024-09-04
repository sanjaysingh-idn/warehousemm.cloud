<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KainKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function packingList()
    {
        return $this->belongsTo(PackingList::class);
    }

    public function warnas()
    {
        return $this->hasMany(WarnaKeluar::class);
    }
}
