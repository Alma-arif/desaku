<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// use Illuminate\Foundation\Auth\User;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $fillable = ['judul','file_name', 'file_path', 'user_id', 'status'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
