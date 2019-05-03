<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aeronave extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'matricula';
    public $incrementing = false;
}
