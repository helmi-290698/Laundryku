<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = ["consument_id", "total_biaya", "diskon", "biaya_lainya", "tanggal_masuk"];
    public function laundry()
    {
        return $this->hasMany(Laundry::class);
    }
    public function consument()
    {
        return $this->belongsTo(Consument::class);
    }
}
