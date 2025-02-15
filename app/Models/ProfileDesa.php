<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDesa extends Model
{
    use HasFactory;
    protected $table = 'profile_desa';
    protected $fillable = [
        'nama_desa',
        'alamat',
        'email',
        'telepon',
        'logo'
    ];
}
