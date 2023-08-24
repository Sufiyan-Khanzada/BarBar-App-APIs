<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointments extends Model
{
    use HasFactory;

     protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'appointment_date_time',
        'customer_id',

        'hair_style',
        'descsion',
        'email',
        'address',
        'gender',
        'package_id',
        

        
    ];
}
