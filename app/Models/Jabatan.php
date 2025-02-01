<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Jabatan extends Model
{
    use  HasFactory;
    protected $table = 'jabatan';
    protected $fillable = [
        'nama_jabatan',
        'tingkat_jabatan',
        'keterangan_jabatan',
        'status'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_jabatan', 'id');
    }


}
