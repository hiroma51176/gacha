<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GachaController extends Controller
{
    public function gacha()
    {
        $gacha = rand(1, 100);
        if($gacha = 1){
            $result = "大当たりを引きました";
        }elseif($gacha <= 10){
            $result = "当たりを引きました";
        }else{
            $result = "はずれを引きました";
        }
        
        return view('result', ['result' => $result]);
    }
}
