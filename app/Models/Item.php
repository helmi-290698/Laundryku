<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = "items";
    protected $fillable = ["name_item", "hitungan", "tipelaundry_id"];
    public function itempaket()
    {
        return $this->hasOne(Itempaket::class);
    }
    public function laundry()
    {
        return $this->hasMany(Laundry::class);
    }
    public function tipelaundry()
    {
        return $this->belongsTo(Tipelaundry::class);
    }
}
