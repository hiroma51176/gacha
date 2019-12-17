<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GachaController extends Controller
{
    public function start()
    {
        $result = null;
        $result_total = null;
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total]);
    }
    
    
    // 単発ガチャ
    public function gachaSingle()
    {
        $result_total = null;
        
        // 大当たりの中身
        $jackpot = array('A', 'B', 'C');
        
        // 当たりの中身
        $hit = array('AA', 'BB', 'CC', 'DD', 'EE');
        
        // ガチャを実行
        $gacha = mt_rand(1, 100);
        
        // 大当たりの場合
        if($gacha == 1){
            $rand_key = array_rand($jackpot, 1);
            $result = "大当たりの" . $jackpot[$rand_key] . "を引きました";
            
        // 当たりの場合
        }elseif($gacha <= 20){
            $rand_key = array_rand($hit, 1);
            $result = "当たりの" . $hit[$rand_key] . "を引きました";
            
        //はずれの場合
        }else{
            $result = "はずれを引きました";
        }
        
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'gacha' => $gacha]);
    }
    
    // 10連ガチャ
    public function gachaMultiple()
    {
        $result = null;
        
        // 大当たりの中身
        $jackpot = array('A', 'B', 'C');
        
        // 当たりの中身
        $hit = array('AA', 'BB', 'CC', 'DD', 'EE');
        
        $result_total = [];
        
        // 10回引く
        for($i = 1; $i <= 10; $i++){
            $gacha = mt_rand(1, 100);
            
            if($gacha == 1){
            $rand_key = array_rand($jackpot, 1);
            $result_m = "大当たり--" . $jackpot[$rand_key];
            
        }elseif($gacha <= 20){
            $rand_key = array_rand($hit, 1);
            $result_m = "当たり--" . $hit[$rand_key];
            
        }else{
            $result_m = "はずれ";
            }
            $result_total[] = $result_m;
        }
        
        // 最低保証
        // ガチャ結果の配列$result_totalに当たりがあればtrueを返す
        if(preg_grep("/^当たり/", $result_total)){
            
            return view('layouts.front', ['result' => $result, 'result_total' => $result_total]);
            
        }else{
            $gacha = mt_rand(1, 100);
            
            if($gacha == 1){
                $rand_key = array_rand($jackpot, 1);
                $result_m = "大当たり--" . $jackpot[$rand_key];
            
            }else{
                $rand_key = array_rand($hit, 1);
                $result_m = "当たり--" . $hit[$rand_key];
            }
            $result_total[] = $result_m;
        }
        
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total]);
    }
}
