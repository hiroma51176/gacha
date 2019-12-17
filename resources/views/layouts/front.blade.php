@extends('layouts.common')

@section('title', 'ガチャシミュレータ―')

@section('content')
    <div class="container">
        @if (!is_null($result))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="caption mx-auto">
                                <div class="result">
                                    {{-- ガチャの結果を表示する --}}
                                    <h1>{{ $result }}</h1>
                                    <p>{{ "※確認用　出た数字は" . $gacha . "です"}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color=white>
        <div class="row">
            <div class="description col-md-8 mx-auto mt-3">
                <p>無料でガチャを引くことが出来るガチャシミュレータ―です</p>
                <p>排出率は次の通りです</p>
                <p>大当たり：１％　当たり：９％　はずれ：９０％</p>
                {{-- ガチャを引く --}}
                <div>
                    <a class="btn btn-primary" role="button" href="{{ action('GachaController@gachaSingle') }}">ガチャを１回引く</a>
                </div>
                
            </div>
        </div>
    </div>
@endsection