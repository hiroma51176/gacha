<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'rarity' => 'required',
        );
        
    public function prizes()
    {
        return $this->hasmany('App\Prize');
    }
}
