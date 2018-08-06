<?php

namespace App\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class PayLog extends Model
{
    protected $table = 'paylogs';
    protected $fillable = [
        'sum',
    ];
}
