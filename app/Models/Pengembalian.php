<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembalian extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'pengembalians';
    protected $fillable = [
        'tanggal_pengembalian',
        'total_hari',
        'total_biaya',
        'peminjaman_id',
    ];
    public function peminjaman():BelongsTo
   {
    return $this->belongsTo(Peminjaman::class);
   }
}
