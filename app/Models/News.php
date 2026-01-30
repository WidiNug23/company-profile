<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $primaryKey = 'id_berita'; // ⬅️ INI KUNCINYA

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'isi',
        'image',
        'author',
        'jenis_berita',
        'tanggal_publikasi',
        'tanggal_update'
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'tanggal_update' => 'datetime',
    ];

    const CREATED_AT = 'tanggal_publikasi';
    const UPDATED_AT = 'tanggal_update';
}
