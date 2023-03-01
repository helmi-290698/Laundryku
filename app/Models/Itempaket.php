<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itempaket extends Model
{
    use HasFactory;
    protected $table = "itempakets";
    protected $fillable = ["item_id", "harga_reguler", "harga_oneday", "harga_express"];
    public function item()
    {
        return $this->belongsTo(item::class);
    }
}
