<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas';
    protected $fillable = [
        'user_id',
        'tgl_id',
        'setor'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tgl_kas(){
        return $this->belongsTo(Tgl::class);
    }
}
