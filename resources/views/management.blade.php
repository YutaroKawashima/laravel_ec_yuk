@extends('layouts.auth')

@section('title', '商品管理ページ')

@section('content')
    <section>
        <h2>商品の登録</h2>
        @forelse($errors->all() as $error)
            <span class = "red">{{ $error }}</span>
            @empty
        @endforelse
        <form method="post" action="{{ url('/admin/management') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
                <label>
                    商品名:
                    <input type="text" name="name" value="">
                </label>
            </div>
            <div>
                <label>
                    価格:
                    <input type="text" name="price" value="">
                </label>
            </div>
            <div>
                <label>
                    在庫数:
                    <input type="text" name="stock" value="">
                </label>
            </div>
            <div>
                <label>
                    画像：
                    <input type="file" name="image">
                </label>
            </div>
            <div>
                <select name="status">
                    <option value="1">非公開</option>
                    <option value="0">公開</option>
                </select>
            </div>
            <input type="hidden" name="sql_kind" value="insert">
            <div><input type="submit" value="★★★商品追加★★★"></div>
        </form>
    </section>
    <section>
        <h2>商品情報一覧・変更</h2>
        <table>
            <caption>商品一覧</caption>
                <tr>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>ステータス</th>
                    <th> 操作 </th>
                </tr>
            @forelse($product as $item)
                <tr>
                    <form method = "post" action="{{ url('/admin/management/change') }}">
                        {{ csrf_field() }}
                        <td>
                            <img class = "item-image" src = "{{ asset('./storage/photos/'.$item->image) }}">
                        </td>
                        <td class = "product_name_width">
                            {{ $item->name }}
                        </td>
                        <td class = "text_align_right">
                            {{ $item->price }}
                        </td>
                        <td>
                            <input type = "text" class = "input_text_width text_align_right" name = "update_stock" value = "{{ $item->stock->stock }}">
                            <input type = "hidden" name = "product_id" value = "{{ $item->id }}"> <br>
                            <input type = "submit" value = "変更">
                        </td>
                    </form>
                    <form method = "post" action="{{ url('/admin/management/change_s') }}">
                        {{ csrf_field() }}
                        <td>
                            @if ($item->status === 1)

                                <input type = "submit" name = "change_status" value  = "公開 → 非公開">

                            @elseif ($item->status === 0)

                                <input type = "submit" name = "change_status" value = "非公開 → 公開">

                            @endif

                            <input type = "hidden" name = "update_status" value = "{{ $item->status }}">
                            <input type = "hidden" name = "product_id" value = "{{ $item->id }}">
                        </td>
                    </form>
                    <form method = "post" action="{{ url('/admin/management/'. $item->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <td>
                            <input type = "submit" name = "delete_data" value = "削除">

                            <input type = "hidden" name = "delete_data">
                            <input type = "hidden" name = "product_id" value = "{{ $item->id }}">
                            <input type = "hidden" name = "sql_kind" value = "delete">
                        </td>
                    </form>
                </tr>
                @empty
                <p> データがありません </p>
            @endforelse
        </table>
    </section>
@endsection
