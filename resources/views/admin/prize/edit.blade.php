@extends('layouts.common')

@section('title', '景品の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>景品の編集</h2>
                <form action="{{ action('Admin\PrizeController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    {{-- 景品名のフォーム --}}
                    <div class="form-group row">
                        <label class="col-md-2" for="prize_name">景品名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="prize_name" value="{{ $prize_form->prize_name }}">
                        </div>
                    </div>
                    {{-- レアリティのフォーム --}}
                    <div class="form-group row">
                        <label class="col-md-2" for="rarity_id">レアリティ</label>
                        <div class="col-md-4">
                            <select class="form-control" name="rarity_id">
                                <option value="">選択してください</option>
                                <option value="1">はずれ</option>
                                <option value="2">当たり</option>
                                <option value="3">大当たり</option>
                            </select>
                        </div>
                    </div>
                    {{-- 画像のフォーム --}}
                    <div class="form-group row">
                        <label class="col-md-2" for="prize_name">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中： {{ $prize_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $prize_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection