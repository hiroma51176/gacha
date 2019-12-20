@extends('layouts.common')

@section('title', 'ガチャシミュレータ―')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>ガチャシミュレータ―</h1>
        </div>
        <div class="row">
            <div class="description col-md-8 mx-auto mt-3">
                <p>無料でガチャを引くことが出来るガチャシミュレータ―です</p>
                <p>排出率は次の通りです</p>
                <p>大当たり：１％　当たり：１９％　はずれ：８０％</p>
                <p>最低保証：１回は当たり以上が出ます。</p>
                <p>{{ "ピックアップ：" . $pickup }}</p>
                {{-- ガチャを引く --}}
                <div>
                    <a class="btn btn-primary" role="button" href="{{ action('GachaController@gachaSingle') }}">ガチャを１回引く</a>
                    <a class="btn btn-primary" role="button" href="{{ action('GachaController@gachaMultiple') }}">ガチャを１０回引く</a>
                </div>
            </div>
        </div>
        <hr color=white>
        {{-- 単発ガチャの場合 --}}
        @if (!is_null($result))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="caption mx-auto">
                                {{-- ガチャの結果を表示する --}}
                                <div class="result">
                                    <h2>結果</h2>
                                    <h2>{{ $result }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        {{-- 10連ガチャの場合 --}}
        @if (!is_null($result_total))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="caption mx-auto">
                                {{-- ガチャの結果を表示する --}}
                                <div class="result">
                                    <h2>結果</h2>
                                    <ul style="list-style:none">
                                        @foreach ($result_total as $result)
                                            <li>{{ $result }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection