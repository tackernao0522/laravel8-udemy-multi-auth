<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>領収書</title>

    <style type="text/css">
        * {
            font-family: ipaexg;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            font-size: 16px;
            font-weight: normal;
            font-family: ipaexg;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: green; font-size: 26px;"><strong>EasyShop - 領収書</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
                    EasyShop Head Office
                    Email:support@easylearningbd.com <br>
                    Mob: 1245454545 <br>
                    Dhaka 1207,Dhanmondi:#4 <br>
            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width=" 100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>購入者お名前:</strong> {{ $order->user->name }} 様<br>
                    <strong>購入者メールアドレス:</strong> {{ $order->user->email  }} <br>
                    <strong>購入者電話番号:</strong> {{ $order->user->phone  }} <br><br>

                    @php
                    $div = $order->division->division_name;
                    $dis = $order->district->district_name;
                    $town = $order->town->town_name;
                    @endphp

                    <strong>お届け先郵便番号:</strong> {{ $order->post_code  }} <br>
                    <strong>お届け先住所:</strong> {{ $div }}{{ $dis }}{{ $town }} {{ $order->notes }} <br>
                    <strong>お届け先電話番号:</strong> {{ $order->phone  }} <br>
                    <strong>お届け先メールアドレス:</strong> {{ $order->email  }} <br>
                    <strong>お届け先お名前:</strong> {{ $order->name }} 様<br>
                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">購入番号:</span> #{{ $order->invoice_no }}</h3>
                注文日: {{ $order->order_date }} <br>
                配送日: {{ $order->delivered_date }} <br>
                お支払い方法 : {{ $order->payment_method }} </span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>お買い上げ商品</h3>
    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>画像</th>
                <th>商品名</th>
                <th>サイズ</th>
                <th>カラー</th>
                <th>商品コード</th>
                <th>数量</th>
                <th>単価</th>
                <th>合計価格</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
            <tr class="font">
                <td align="center">
                    <img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product->product_thambnail}") }}" height="50px" width="50px" height="60px;" width="60px;" alt="">
                </td>
                <td align="center" style="font-size: 10px">{!! nl2br(e( $item->product->product_name_ja )) !!}</td>
                <td align="center" style="font-size: 10px">
                    @if($item->size == NULL)
                    ---
                    @else
                    {{ $item->size }}
                    @endif
                </td>
                <td align="center" style="font-size: 10px">{{ $item->color }}</td>
                <td align="center" style="font-size: 10px">{{ $item->product->product_code }}</td>
                <td align="center" style="font-size: 10px">{{ $item->qty }}</td>
                <td align="center" style="font-size: 10px; width: 10%">¥ {{ number_format($item->price) }}(税込)</td>
                <td align="center" style="font-size: 10px; width: 20%">¥ {{ number_format($item->price * $item->qty) }}(税込)</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">小計:</span> ¥ {{ number_format($order->amount) }}(税込)</h2>
                <h2><span style="color: green;">総合計価格:</span> ¥ {{ number_format($order->amount) }}(税込)</h2>
                {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>お買い上げ誠に有難うございました。</p>
    </div>
    <!-- <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div> -->
</body>

</html>
