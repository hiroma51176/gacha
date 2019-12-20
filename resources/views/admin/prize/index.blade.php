@extends('layouts.common')
@section('title', '登録済みの景品一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>景品一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\PrizeController@add') }}" role="button" class="btn btn-primary">景品新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-prize col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">景品名</th>
                                <th width="20%">レアリティ</th>
                                <th width="30%">画像</th>
                                <th width="10%">操作</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prizes as $prize)
                                <tr>
                                    <th>{{ $prize->id }}</th>
                                    <td>{{ $prize->prize_name }} </td>
                                    <td>{{ $prize->rarity->rarity_name }}</td>
                                    <td>
                                        @if ($prize->image_path)
                                            <img src="{{ asset('storage/image/' . $prize->image_path) }}"alt="はずれの画像">
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\PrizeController@edit', ['id' => $prize->id ]) }}">編集</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- ここからレアリティ一覧 --}}
        <hr color=white>
        <div class="row">
            <h2>レアリティ一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\PrizeController@addRarity') }}" role="button" class="btn btn-primary">レアリティ新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-prize col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">レアリティ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rarities as $rarity)
                                <tr>
                                    <th>{{ $rarity->id }}</th>
                                    <td>{{ $rarity->rarity_name }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection