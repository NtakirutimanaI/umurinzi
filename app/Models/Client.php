<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'city',
        'country',
        'national_id',
        'gender',
        'date_of_birth',
        'notes',
    ];
}
