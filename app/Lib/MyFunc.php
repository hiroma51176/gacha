<?php

namespace App\Lib;

use App\Prize;
use App\Rarity;

class MyFunc
{
    // ピックアップを決めて、Modelからデータをを取り出す関数
    public static function pickup()
    {
        $timestamp = time();
        $day = date('j', $timestamp);
        
        // 当たりの中身
        // $hit = array('AA', 'BB', 'CC', 'DD', 'EE');
        // Prize Modelからrarity_idが2(当たり)に限定したデータを取り出して配列にする
        $hits = Prize::where('rarity_id', 2)->get()->toArray();
        //$hit = array_column($hits, 'prize_name');
        
        // 大当たりの中身
        // $jackpot =[];
        // Prize Modelからrarity_idが3(大当たり)に限定したデータを取り出して配列にする
        $jackpots = Prize::where('rarity_id', 3)->get()->toArray();
        //$jackpot = array_column($jackpots, 'prize_name');
        
        // ピックアップを決める ※UTC基準
        if($day % 2 == 0){
            //$pickup = "今日は大当たりの中で、Aが出やすい日です";
            $pickup = "今日は" . Rarity::find(3)->rarity_name . "の中で、" . $jackpots[0]['prize_name'] . "が出やすい日です";
            // $jackpot = array('A', 'A', 'B');
            $jackpots[] = $jackpots[0];
            

        }else{
            //$pickup = "今日は大当たりの中で、Bが出やすい日です";
            $pickup = "今日は" . Rarity::find(3)->rarity_name . "の中で、" . $jackpots[1]['prize_name'] . "が出やすい日です";
            // $jackpot = array('A', 'B', 'B');
            $jackpots[] = $jackpots[1];

        }
        
        $array = array("pickup" => $pickup, "hits" => $hits, 'jackpots' => $jackpots);
        return $array;
    }
    
    //ガチャを１回引く関数
    public static function doGachaSingle()
    {
        // 大当たりの中身とピックアップ
        $array = MyFunc::pickup();
        $pickup = $array['pickup'];
        $jackpots = $array['jackpots'];
        $hits = $array['hits'];
        
        //$miss = Prize::find(1);
        
        // ガチャを実行
        $gacha = mt_rand(1, 100);
        
        // 大当たりの場合
        if($gacha == 1){
            $rand_key = array_rand($jackpots, 1);
            // $result = "大当たり  " . $jackpot[$rand_key];
            $result = Rarity::find(3)->rarity_name . " - " . $jackpots[$rand_key]['prize_name'];
            
        // 当たりの場合
        }elseif($gacha <= 20){
            $rand_key = array_rand($hits, 1);
            //$result = "当たり  " . $hit[$rand_key];
            $result = Rarity::find(2)->rarity_name . " - " . $hits[$rand_key]['prize_name'];
            
        //はずれの場合
        }else{
            //$result = "はずれ";
            $result = Rarity::find(1)->rarity_name;
        }
        $array = array("result" => $result, "pickup" => $pickup, "jackpots" => $jackpots, "hits" =>$hits);
        return $array;
    }
    
}