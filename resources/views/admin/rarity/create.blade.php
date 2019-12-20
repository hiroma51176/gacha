@extends('layouts.common')

@section('title', 'レアリティの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>景品の新規作成</h2>
                <form action="{{ action('Admin\PrizeController@createRarity') }}" method="post">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    {{-- レアリティのフォーム --}}
                    <div class="form-group row">
                        <label class="col-md-2" for="rarity_name">レアリティ</label>
                        <div class="col-md-4">
                            <select class="form-control" name="rarity_name">
                                <option value="">選択してください</option>
                                <option value="はずれ">はずれ</option>
                                <option value="当たり">当たり</option>
                                <option value="大当たり">大当たり</option>
                            </select>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
            
        </div>
    </div>
@endsection