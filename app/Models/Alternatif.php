<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    protected $fillable = ['periode_id', 'nama', 'alamat', 'hp', 'jk'];

    public function periode() {
        return $this->belongsTo(Periode::class);
    }
}
