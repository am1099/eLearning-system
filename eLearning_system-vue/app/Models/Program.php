<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $primaryKey = 'prog_id';
    public $timestamps = false;

    protected $fillable = [
        'prog_name',
        'prog_desc',
        'prog_type',
        'prog_difficulty',
        'validated'
    ];
}
