<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'isi',
        'id_user',
        'id_kategory',
        'image',
        'status',
    ];

    // public function user()
    // {

    //     return $this->belongsTo(User::class, 'id');
    // }

    // // Relasi ke tabel kategori_berita
    // public function kategori()
    // {
    //     return $this->belongsTo(BeritaKategori::class, 'id');
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke BeritaKategori
    public function kategori_berita(): BelongsTo
    {
        return $this->belongsTo(BeritaKategori::class, 'id_kategory', 'id');
    }

}
