<?php

namespace App\Lib;

class MyFunc
{
    // ピックアップを決める関数
    public static function pickup()
    {
        $timestamp = time();
        $day = date('j', $timestamp);
        
        // ピックアップ
        if($day % 2 == 0){
            $pickup = "今日は大当たりの中で、Aが出やすい日です";
            $jackpot = array('A', 'A', 'B');
        }else{
            $pickup = "今日は大当たりの中で、Bが出やすい日です";
            $jackpot = array('A', 'B', 'B');
        }
        
        // 当たりの中身
        $hit = array('AA', 'BB', 'CC', 'DD', 'EE');
        
        return array("pickup" => $pickup, "jackpot" => $jackpot, "hit" => $hit);
    }
    
    //ガチャを１回引く関数
    public static function doGachaSingle()
    {
        // 大当たりの中身とピックアップ
        $array = MyFunc::pickup();
        $pickup = $array['pickup'];
        $jackpot = $array['jackpot'];
        $hit = $array['hit'];
        
        // ガチャを実行
        $gacha = mt_rand(1, 100);
        
        // 大当たりの場合
        if($gacha == 1){
            $rand_key = array_rand($jackpot, 1);
            $result = "大当たり--" . $jackpot[$rand_key];
            
        // 当たりの場合
        }elseif($gacha <= 20){
            $rand_key = array_rand($hit, 1);
            $result = "当たり--" . $hit[$rand_key];
            
        //はずれの場合
        }else{
            $result = "はずれ";
        }
        $array = array("gacha" => $gacha, "result" => $result, "pickup" => $pickup, "jackpot" => $jackpot);
        return $array;
    }
    
    
    
}