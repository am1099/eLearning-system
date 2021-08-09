<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $primaryKey = 'act_id';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'act_name',
        'act_desc',
        'act_difficulty',
        'correct_answer',
        'act_question',
        'act_script',
        'act_images',
        'act_min_keystrokes',
        'validated'

    ];

    protected $casts = [
        'validated' => 'boolean',
    ];
}
