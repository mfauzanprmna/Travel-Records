<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catper extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu',
        'lokasi',
        'suhu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
