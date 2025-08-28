<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tgl extends Model
{
    use HasFactory;
    protected $table =  'tgl_kas';

    protected $fillable = [
        'tgl'
    ];

    public function kas(){
        return $this->hasMany(Kas::class);
    }
}
