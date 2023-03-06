<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;
    protected $table = "laundries";
    protected $fillable = ["item_id", "consument_id", "jenis_cucian", "jumlah", "total_biaya"];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function consument()
    {
        return $this->belongsTo(Consument::class);
    }
}
