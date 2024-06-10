<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $fillable = ['nama', 'tahun', 'keterangan'];

    public function alternatif() {
        return $this->hasMany(Alternatif::class);
    }
}
