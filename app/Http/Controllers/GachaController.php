<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lib\MyFunc;

use App\Prize;
use App\Rarity;

class GachaController extends Controller
{
    public function start()
    {
        $array = MyFunc::pickup();
        $pickup = $array['pickup'];
        
        $result = null;
        $result_total = null;
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'pickup' => $pickup]);
    }
    
    
    // 単発ガチャ
    public function gachaSingle()
    {
        $array = MyFunc::doGachaSingle();
        $result = $array['result'];
        $pickup = $array['pickup'];
        
        $result_total = null;
        
        
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'pickup' => $pickup]);
    }
    
    // 10連ガチャ
    public function gachaMultiple()
    {
        // 10連ガチャの結果を入れる箱を用意する
        $result_total = [];
        
        // 10回引く
        for($i = 1; $i <= 9; $i++){
            
            $array = MyFunc::doGachaSingle();
            $result = $array['result'];
            
            $result_total[] = $result;
        }
        
        $pickup = $array['pickup'];
        $jackpot = $array['jackpot'];
        $hit = $array['hit'];
        
        
        // 最低保証機能
        // ガチャ結果の配列$result_totalに「当たり」の単語があればtrueを返す
        if(preg_grep("/当たり/", $result_total)){
            
            $array = MyFunc::doGachaSingle();
            $result = $array['result'];
            
            $result_total[] = $result;
            
        }else{
            $gacha = mt_rand(1, 100);
            
            if($gacha == 1){
                $rand_key = array_rand($jackpot, 1);
                $result_add = "大当たり  " . $jackpot[$rand_key];
            
            }else{
                $rand_key = array_rand($hit, 1);
                $result_add = "当たり " . $hit[$rand_key];
            }
            $result_total[] = $result_add;
        }
        
        $result = null;
        
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'pickup' => $pickup]);
    }
}
