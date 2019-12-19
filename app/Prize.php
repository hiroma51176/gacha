<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $guarded = array('id');
    
    // バリデーション
    public static $rules = array(
        'prize_name' => 'required',
        'rarity_id' => 'required',
        );
}
