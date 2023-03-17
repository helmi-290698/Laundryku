<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consument extends Model
{
    use HasFactory;
    protected $table = "consuments";
    protected $fillable = ["code", "name", "address", "phone_number", "email"];
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
