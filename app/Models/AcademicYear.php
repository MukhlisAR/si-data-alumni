<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    // Tambahkan baris ini untuk memberi izin (Mass Assignment)
    protected $fillable = [
        'year_name',
    ];
}