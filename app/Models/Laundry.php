<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;
    protected $table = "laundries";
    protected $fillable = ["item_id", "pembayaran_id",  "jenis_cucian", "jumlah", "biaya_laundry"];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
