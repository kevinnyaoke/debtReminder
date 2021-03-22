<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'name', 'idno', 'email', 'phone', 'status','amount', 'balance','added_by'
    ];
}
