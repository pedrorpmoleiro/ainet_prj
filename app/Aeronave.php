<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    protected $primaryKey = 'matricula';
    public $incrementing = false;
}
