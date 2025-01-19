<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Mobil extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'mobils';
    protected $fillable = [
        'merek',
        'model',
        'slug',
        'no_plat',
        'photo',
        'user_id',
        'tarif_sewa_per_hari',
        'status'
    ];
    public function setModelAttribute($value)
    {
        $this->attributes['model'] = $value;
        $this->attributes['slug'] = Str::slug($value);
     }
     public function user():BelongsTo
     {
         return $this->belongsTo(User::class);
     }
}
