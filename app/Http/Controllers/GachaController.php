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
        $jackpots = $array['jackpots'];
        // \Debugbar::info($jackpot);
        
        $result = null;
        $result_total = null;
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'pickup' => $pickup, 'jackpots' => $jackpots]);
    }
    
    
    // 単発ガチャ
    public function gachaSingle()
    {
        $array = MyFunc::doGachaSingle();
        $pickup = $array['pickup'];
        $result = $array['result'];
        $result_image = $array['result_image'];
        
        $result_total = null;
        
        
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'result_image' => $result_image, 'pickup' => $pickup]);
    }
    
    // 10連ガチャ
    public function gachaMultiple()
    {
        // 10連ガチャの結果を入れる箱を用意する
        $result_total = [];
        // 最低保証判別用
        $result_dist = [];
        
        // 9回引く
        for($i = 1; $i <= 9; $i++){
            
            $array = MyFunc::doGachaSingle();
            $result = $array['result'];
            $result_image = $array['result_image'];
            
            $result_total[] = array($result, $result_image);
            $result_dist[] = $result;
            //$result_image_total[] = $result_image;
        }
        
        $pickup = $array['pickup'];
        $jackpots = $array['jackpots'];
        $hits = $array['hits'];
        
        
        // 最低保証機能
        // ガチャ結果の判別用配列$result_distに「当たり」の単語があればtrueを返す
        if(preg_grep("/当たり/", $result_dist)){
            
            $array = MyFunc::doGachaSingle();
            $result = $array['result'];
            $result_image = $array['result_image'];
            
            $result_total[] = array($result, $result_image);
            //$result_image_total[] = $result_image;
            
            
        }else{
            $gacha = mt_rand(1, 100);
            
            if($gacha == 1){
                $rand_key = array_rand($jackpots, 1);
                $result = Rarity::find(3)->rarity_name . " - " . $jackpots[$rand_key]['prize_name'];
                $result_image = $jackpots[$rand_key]['image_path'];
            
            }else{
                $rand_key = array_rand($hits, 1);
                $result = Rarity::find(2)->rarity_name . " - " . $hits[$rand_key]['prize_name'];
                $result_image = $hits[$rand_key]['image_path'];
            }
            $result_total[] = array($result, $result_image);
        }
        
        $result = null;
        
        // 配列$result_totalを5個ずつ分割する
        $chunks = array_chunk($result_total, 5);
        
        return view('layouts.front', ['result' => $result, 'result_total' => $result_total, 'pickup' => $pickup, 'chunks' => $chunks]);
    }
}
