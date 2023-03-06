<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consument extends Model
{
    use HasFactory;
    protected $table = "consuments";
    protected $fillable = ["code", "name", "address", "phone_number", "email"];
    public function laundry()
    {
        return $this->hasMany(Laundry::class);
    }
}
