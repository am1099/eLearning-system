<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'actDetails_id';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'score',
        'tries',
        'time_to_complete',
        'keystrokes_recorded',
        'keystroke_rate',
        'conc_level'
    ];
}
