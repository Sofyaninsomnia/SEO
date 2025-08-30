<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran_kas extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_kas';
    protected $fillable = [
        'tanggal',
        'jumlah',
        'keterangan',
        'dokumentasi'
    ];
}
