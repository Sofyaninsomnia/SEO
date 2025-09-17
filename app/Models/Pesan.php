<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesan';
    protected $fillable = [
        'user_id',
        'chat',
        'feedback'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
