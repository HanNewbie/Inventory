<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;

class Lokawisata extends Model
{
    use HasFactory;
    protected $table = 'lokawisata';
    protected $fillable = [
        'nama_lokawisata',
        'keterangan',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lokawisata_user');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'lokawisata_id', 'id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
