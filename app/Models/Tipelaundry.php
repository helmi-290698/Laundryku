<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipelaundry extends Model
{
    use HasFactory;
    protected $table = "tipelaundries";
    protected $fillable = ["name_tipe"];
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
