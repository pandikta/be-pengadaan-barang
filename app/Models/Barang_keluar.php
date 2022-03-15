<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_keluar extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'barang_id', 'jumlah_keluar', 'tgl_keluar'];
}
