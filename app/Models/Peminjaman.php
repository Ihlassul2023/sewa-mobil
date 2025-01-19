<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'peminjaman';
    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'status',
        'user_id',
        'mobil_id'
    ];
   public function mobil():BelongsTo
   {
    return $this->belongsTo(Mobil::class);
   }
   public function pengembalian():HasOne
   {
    return $this->hasOne(Pengembalian::class);
   }
}
