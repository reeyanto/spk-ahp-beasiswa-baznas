<?php

namespace App\Models;

use App\Models\SubKriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $fillable = ['kode', 'nama', 'keterangan'];

    public function alternatif_kriteria() {
        return $this->hasMany(AlternatifKriteria::class);
    }

    public function subkriteria() {
        return $this->hasMany(SubKriteria::class);
    }
}
