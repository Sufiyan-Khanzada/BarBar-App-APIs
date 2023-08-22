<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable = [
        'Plan_title',
        'Plan_tag_line',
        'Plan_price',
        'Plan_description',
        'image',
        
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
