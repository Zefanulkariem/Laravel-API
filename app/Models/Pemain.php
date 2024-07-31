<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    use HasFactory;

    public $fillable = ['nama', 'foto', 'tgl_lahir', 'harga_pasar', 'posisi', 'negara', 'id_klub'];

    public function klub()
    {
        return $this->BelongsTo(Klub::class, 'id_klub');
    }
}
