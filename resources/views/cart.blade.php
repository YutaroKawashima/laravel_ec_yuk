@extends('layouts.user')

@section('content')
    <div class = "item-area">
        <h2> ショッピングカート</h2>
        @forelse($errors as $error)
            <p class = "red"> {{ $error }} </p>
        @endforelse
        <div class = "item-title">
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
                    <img src = "{{ asset('./storage/photos/'.$item->image) }}" class = "product-image">
                    <span class = "name">
                        {{ $item->name }}
                    </span>

                    <form method = "post" class = "del-button">
                        <input type = "submit" value = "削除">
                        <input type = "hidden" name = "product_id" value = "{{ $item->id }}">
                        <input type = "hidden" name = "sql_kind" value = "delete">
                    </form>

                    <span class = "price red">
                        ¥{{ $item->price }}
                    </span>

                    <form method = "post" action = "{{ url('cart') }}" class = "change-amount">
                        <input type = "text" name = "amount" value = "{{ $item->amount }}" class = "amount"> 個&nbsp

                        <input type = "submit" value = "変更する">
                        <input type = "hidden" name = "product_id" value = "{{ $item->product_id }}">
                        <input type = "hidden" name = "sql_kind" value = "change">
                    </form>
                </div>
            </li>
        </ul>
        <div class = "item-area">
            <div class = "sum">
                <span class = "sum-title">
                    合計
                </span>
                <span class = "red font-size-25">
                    ¥<?php foreach( $product_info_data as $value ) {

                            $sum += $value[ 'price' ] * $value[ 'amount' ];
                            }

                            print $sum;
                    ?>
                </span>
            </div>
        </div>
        <form method = "post" action = "./finish.php">
            <div class = "purchase_button">
                <input type = "submit" value = "購入する">
                <input type = "hidden" name = "sql_kind" value = "purchase">
            </div>
        </form>
    </div>
@endsection
