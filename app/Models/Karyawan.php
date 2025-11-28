<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'pekerjaan'];

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class);
    }
}
