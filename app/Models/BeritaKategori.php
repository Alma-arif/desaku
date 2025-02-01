<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class BeritaKategori extends Model
{
    use HasFactory;
    protected $table = 'kategori_berita';

  protected $fillable = [
        'judul',
        'keterangan',
        'status'
    ];

    // public function berita()
    // {
    //     return $this->hasMany(Berita::class, 'id_kategory');
    // }

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'id_kategory', 'id');
    }

}
