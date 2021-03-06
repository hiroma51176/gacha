@extends('layouts.common')

@section('title', '景品の新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>景品の新規作成</h2>
                <form action="{{ action('Admin\PrizeController@create') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="prize_name" value="{{ old('prize_name') }}">
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
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
            
        </div>
    </div>
@endsection