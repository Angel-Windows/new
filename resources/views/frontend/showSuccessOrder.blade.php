@extends('frontend.layout')


@section('main')
    <?php
    $transactionProducts = [];
    $productIds = [];
    $productPrices = [];
    foreach ($cartProduct as $product){
        $productIds[] = $product['product']->id;
        $productPrices[] = $product['product']->price;

        $transactionProducts[] = (object)[
            'sku' => $product['product']->code,
            'name' => htmlspecialchars($product['product']->name),
            'category' => 'category',
            'price' => $product['product']->price,
            'quantity' => $product['quantity'],
        ];
    }
    ?>

    <script>
        window.dataLayer = window.dataLayer || [];
        let ofs = {
            'event': 'transaction',
            'transactionId': {{ $order->id }},
            'transactionAffiliation': 'myoptics',
            'transactionTotal': {{ $order->total_cost }},
            'transactionTax': 0,
            'transactionShipping': 0,
            'transactionProducts': {!! json_encode($transactionProducts) !!}
        }
        console.log(ofs)
        dataLayer.push(ofs);
    </script>

    <div class="breadCrumbBg cart">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/cart">Корзина товаров</a></li>
{{--                    <li><a href="/{{ $page->slug }}">{{ $page->name }}</a></li>--}}
                </ul>
            </div>
        </div>
    </div>

    <div class="cartBg cartTwo">
        <div class="container">
            <div class="row">
                <div class="tabs">
                    Ваш заказ успешно оформлен. Мы с Вами свяжемся в ближайшее время. Спасибо!
                </div>
            </div>
        </div>
    </div>

<!--    --><?php
//        var_dump($order->total_cost);
//        var_dump("<pre>");
//    var_dump($order,$cartProduct);
//    var_dump("</pre>");
//    die();?>





@endsection

@section('styles')
    <link rel="stylesheet" href="/frontend/css/cart.css">	<link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.theme.css">
@endsection

@section('scripts')
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            dynx_itemid: {!! json_encode($productIds) !!}, //указываем все id которые в заказе
            dynx_pagetype: 'conversion', //тип страницы, указать именно это значение
            dynx_totalvalue: {!! json_encode($productPrices) !!}
        });
    </script>



    <!--formStyler-->
    <script type="text/javascript" src="/frontend/js/formStyler/jquery.formstyler.min.js"></script>
    <script type="text/javascript" src="/frontend/js/cart.js"></script>
@endsection