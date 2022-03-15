<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Barang_masuk extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'user_id', 'barang_id', 'jumlah_masuk', 'tgl_masuk'];
}
