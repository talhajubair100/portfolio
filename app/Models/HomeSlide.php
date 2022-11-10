<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;
    //protected $guarded = [];

    protected $fillable = [
        'title',
        'short_description',
        'home_slide',
        'video_url',
    ];
}
