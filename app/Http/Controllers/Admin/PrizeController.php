<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Prize;

class PrizeController extends Controller
{
    
    public function add()
    {
        return view('admin.prize.create');
    }
    
    // 新規作成を行うメソッド
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
        
        return view('admin.prize.create');
    }
    
    public function edit()
    {
        return view('admin.prize.edit');
    }
    
    // 更新を行うメソッド
    public function update()
    {
        return view('admin.prize.edit');
    }
    
    
    
    public function rarity_add()
    {
        return view('admin.rarity.create');
    }
    
    public function rarity_create()
    {
        return view('admin.rarity.create');
    }
}
