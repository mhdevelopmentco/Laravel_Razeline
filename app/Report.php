<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id', 'reportee_id', 'reason'
    ];

    public $timestamps = true;

    public $table = 'reports';
}
