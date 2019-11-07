<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\AbstractBaseModel;

class User extends AbstractBaseModel
{
    const SORT = 'created_at';

    const FIELDS = [
        'uuid',
        'firstname',
        'lastname',
        'mobile_number',
        'email',
        'birthdate',
        'gender'
    ];

    protected $fillable = [
        'uuid',
        'firstname',
        'lastname',
        'mobile_number',
        'email',
        'birthdate',
        'gender'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}