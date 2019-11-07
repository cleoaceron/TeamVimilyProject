<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\AbstractBaseModel;

class ContactVideo extends AbstractBaseModel
{
    const SORT = 'created_at';

    const FIELDS = [
        'video_path',
        'video_messages'
    ];

    protected $fillable = [
        'video_path',
        'video_messages'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
