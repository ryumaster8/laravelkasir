<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelContact extends Model
{
    use HasFactory;

    protected $table = 'contacts'; // Pastikan nama tabel benar
    protected $primaryKey = 'contact_id';
    protected $fillable = ['nama', 'email', 'pesan'];
    public $timestamps = false; // Tambahkan baris ini;
}