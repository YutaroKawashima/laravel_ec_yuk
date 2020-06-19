@extends('layouts.user')

@section('content')

    @forelse($errors as $error)
        <p> {{ $error }} </p>
        @empty
    @endforelse
    <h2 class = "item-area padding-left-50 padding-top-20">商品一覧</h2>
    @forelse($product as $item)
        <form method = "post">
            {{ csrf_field() }}
            <div id = "flex" class = "item-area">
                <div class = "product">
                    <span>
                        <img class = "item-image" src = "{{ asset('./storage/photos/'.$item->image) }}">
                    </span>
                    <span> {{ $item->name }} </span>
                    <span> ¥{{ $item->price }} </span>

                    @if ( $item->stock->stock === 0 )
                        <span class = "red"> 売り切れ </span>
                    @else
                        <input class = "cart-button" type = "submit" value = "カートに入れる">
                        <input type = "hidden" name = "product_id" value = "{{ $item->id }}">
                    @endif
                </div>
            </div>
        </form>
        @empty
        <div class = "item-area">
            <p> データがありません </p>
        </div>
    @endforelse
@endsection
