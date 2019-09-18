<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\AbstractBaseModel;

class Contact extends AbstractBaseModel
{
    const SORT = 'created_at';

    const FIELDS = [
        'uuid',
        'fullname',
        'mobile_number',
        'email'
    ];

    protected $fillable = [
        'uuid',
        'fullname',
        'mobile_number',
        'email'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
