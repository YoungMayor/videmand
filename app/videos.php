<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class videos extends Model
{
    use Searchable; 

    protected $table = 'videos';
    protected $primaryKey = 'id';
  
    public $timestamps = true;
  
    protected $guarded = [];

    
  public function searchableAs(){
    return "search_index";
  }

  public function toSearchableArray(){
    $array = $this->toArray(); 

    return [
      "title" => $array['title'], 
      "description" => $array['description']
    ];
  }

}
