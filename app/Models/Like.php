<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => 'boolean',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
