@extends('layouts.user')

@section('title', '購入完了ページ')

@section('content')
<div class = "item-title">
    <div class = "item-area">
            <span class = "price-title">
                価格
            </span>
            <span class = "amount-title">
                数量
            </span>
        </div>
        <ul>
            @forelse($cart as $item)
            <li>
                <div class = "cart-item">

                    <img src = "{{ asset('./storage/photos/'.$item->product->image) }}" class = "product-image">

                    <span class = "name">
                        {{ $item->product->name }}
                    </span>

                    <span class = "price red">
                        ¥{{ $item->product->price }}
                    </span>

                    <span class = "change-amount">
                        {{ $item->amount }}
                    </span>
                </div>
            </li>
            @empty
            <p> 商品がありません </p>
            @endforelse
        </ul>
        <div class = "item-area">
            <div class = "sum">
                <span class = "sum-title">
                    合計
                </span>
                <span class = "red font-size-25">
                    ¥{{ $total_price }}
                </span>
            </div>
        </div>
    </div>
@endsection
