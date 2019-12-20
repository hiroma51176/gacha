<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Prize;
use App\Rarity;

class PrizeController extends Controller
{
    
    public function add()
    {
        return view('admin.prize.create');
    }
    
    // 新規作成を行うアクション
    public function create(Request $request)
    {
        // バリデーションを行う
        $this->validate($request, Prize::$rules);
        
        $prize = new Prize;
        $form = $request->all();
        
        // 画像が送られてきたら、保存して$prize->image_pathに画像のパスを保存
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $prize->image_path = basename($path);
        }else{
            $prize->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        // データベースに保存
        $prize->fill($form)->save();
        
        return redirect('admin/prize/index');
    }
    
    // 登録してある景品の一覧を表示するアクション
    public function index(Request $request)
    {
        $prizes = Prize::all();
        $rarities = Rarity::all();
        
        return view('admin.prize.index', ['prizes' => $prizes, 'rarities' => $rarities]);
    }
    
    
    public function edit(Request $request)
    {
        
        $prize = Prize::find($request->id);
        
        if (empty($prize)){
            return view('admin.prize.index');
        }
        
        return view('admin.prize.edit', ['prize_form' => $prize]);
    }
    
    // 更新を行うメソッド
    public function update(Request $request)
    {
        $this->validate($request, Prize::$rules);
        
        $prize = Prize::find($request->id);
        $prize_form = $request->all();
        
        // 画像があった場合の処理
        if(isset($prize_form['image'])){
            $path = $request->file('image')->store('public/image');
            $prize->image_path = basename($path);
            unset($prize_form['image']);
        }elseif(isset($request->remove)){
            $prize->image_path = null;
            unset($prize_form['remove']);
        }
        
        unset($prize_form['_token']);
        
        $prize->fill($prize_form)->save();
        
        return redirect('admin/prize/index');
    }
    
    
    // ここからレアリティ関係
    public function addRarity()
    {
        return view('admin.rarity.create');
    }
    
    
    public function createRarity(Request $request)
    {
        $this->validate($request, Rarity::$rules);
        
        $rarity = new Rarity;
        $form = $request->all();
        
        unset($form['_token']);
        
        $rarity->fill($form)->save();
        
        return view('admin.rarity.create');
    }
}
