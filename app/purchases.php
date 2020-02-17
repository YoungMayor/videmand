<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchases extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'id';
  
    public $timestamps = true;
  
    protected $guarded = [];
}
