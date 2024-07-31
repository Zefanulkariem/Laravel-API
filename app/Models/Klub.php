<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    use HasFactory;

    public $fillable = ['nama_club', 'logo', 'id_liga'];

    public function liga()
    {
        return $this->BelongsTo(Liga::class, 'id_liga');
    }
    
    public function pemain()
    {
        return $this->BelongsTo(Pemain::class, 'id_klub');
    }

    public function fan()
    {
        return $this->belongsToMany(Fan::class, 'fan_klub', 'id_klub', 'id_fan');
    }
}
