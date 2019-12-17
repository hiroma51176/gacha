@extends('layouts.common')

@section('title', 'ガチャシミュレータ―')

@section('content')
    <div class="container">
        {{-- 単発ガチャの場合 --}}
        @if (!is_null($result))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="caption mx-auto">
                                {{-- ガチャの結果を表示する --}}
                                <div class="result">
                                    <h1>{{ $result }}</h1>
                                    <p>{{ "※確認用　出た数字は" . $gacha . "です"}}</p>
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
                                    <h1>結果は以下の通りです</h1>
                                    <ul>
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
        
        <hr color=white>
        <div class="row">
            <div class="description col-md-8 mx-auto mt-3">
                <p>無料でガチャを引くことが出来るガチャシミュレータ―です</p>
                <p>排出率は次の通りです</p>
                <p>大当たり：１％　当たり：１９％　はずれ：８０％</p>
                <p>１０回引いて外れのみの場合は１回追加で引き、当たり以上が出ます。</p>
                {{-- ガチャを引く --}}
                <div>
                    <a class="btn btn-primary" role="button" href="{{ action('GachaController@gachaSingle') }}">ガチャを１回引く</a>
                </div>
                <div>
                    <a class="btn btn-primary" role="button" href="{{ action('GachaController@gachaMultiple') }}">ガチャを１０回引く</a>
                </div>
            </div>
        </div>
    </div>
@endsection