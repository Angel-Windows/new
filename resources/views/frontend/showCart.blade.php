@extends('frontend.layout')
@section('main')
    <div class="breadCrumbBg cart">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">{{trans('cosmetics.main')}}</a></li>
                    <li><a href="/{{ $page->slug }}">{{ $page->name }}</a></li>
                </ul>
                <div class="step col-xs-12">
                    <div class="item cart hidden-xs active"><span>{{trans('cosmetics.cart.cart')}}</span></div>
                    <div class="item order "><span>{{trans('cosmetics.cart.checkout')}}</span></div>
                    <div class="item confirm "><span>{{trans('cosmetics.cart.confirmation')}}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="cartBg">
        <div class="container">
            <div class="row">

                <?php
                $cartIds = [];
                $cartPrices = [];
                ?>
                @if(count($cartProduct) > 0)
                    @foreach($cartProduct as $item)
                            <?php
                            $cartIds[] = $item['product'][0]['id'];
                            $cartPrices[] = $item['product'][0]['price'];
                            ?>
                        <div class="itemContent col-xs-12">
                            <div class="item">
                                <form action="/remove_from_cart" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="arrkey" value="{{ $item['arrKey'] }}">
                                    <div class="delete"></div>
                                </form>
                                <div class="row">
                                    <div class="title col-lg-12 col-md-12 col-sm-12 col-xs-10">{{ $item['product'][0]->name }}</div>
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                                        <div class="image">
                                            @if( $item['product'][0]->image !='')
                                                <img src="/uploads/products/sm/{{ $item['product'][0]->image }}"
                                                     alt="{{ $item['product'][0]->name }}">
                                            @else
                                                <img src="{{asset('uploads/products/sm/no_image.png')}}" alt="#">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="information col-lg-7 col-md-9 col-sm-9 col-xs-12">
                                        <ul class="charList">
                                            @foreach($item['charlist'] as $char)
                                                <li>{{ $char['name'] }}
                                                    <span>
                                                        @if (app()->getLocale()=='uk')
                                                            {{  \TranslateBranch::getTranslateText( $char['value'],'uk') }}
                                                        @else
                                                            {{ $char['value']}}
                                                        @endif

                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        {{--                                        <div data-arrkey="{{ $item['arrKey'] }}"--}}
                                        {{--                                             data-name="{{ $item['product'][0]->name }}"--}}
                                        {{--                                             data-id="{{ $item['product'][0]->id }}" class="changeChar">Изменить--}}
                                        {{--                                            параметры--}}
                                        {{--                                        </div>--}}
                                    </div>


                                    <div class="col-lg-3 col-lg-offset-0 col-md-offset-7 col-sm-offset-7 col-md-5 col-sm-5 col-xs-12 col-xs-offset-0">
                                        <div class="action">
                                            <div class="countBlock">
                                                <form action="/changeQuantity" method="post">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="product"
                                                           value="{{ $item['product'][0]->id }}">
                                                    <input type="hidden" name="arrkey" value="{{ $item['arrKey'] }}">
                                                    <input type="hidden" name="quantity"
                                                           value="{{ $item['quantity'] }}">
                                                    <div class="minus">-</div>
                                                    <div class="total">{{ $item['quantity'] }}</div>
                                                    <div class="plus">+</div>
                                                </form>
                                            </div>
                                            <div class="price">
                                                <span>{{ number_format($item['quantity'] * ($item['product'][0]->price - ($item['product'][0]->price * $userDiscount)), 2, ',', '') }}</span>
                                                Грн
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{trans('cosmetics.cart.cart_null')}}
                @endif
            </div>
        </div>
    </div>



    <div class="cartBottomBg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cartBottom">
                        <a href="/category" class="back">
                            {{trans('cosmetics.cart.next')}}
                        </a>
                        @if(count($cartProduct) > 0)
                            <a href="/cartStepTwo" class="continue">{{trans('cosmetics.cart.check')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="cartChangeForm" id="cartChangeForm">
        <div id="closeChangeForm"></div>
        <div class="title"></div>
        <div class="featureList">
            <form action="/newFeature" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="arrkey" value="">
                <input type="hidden" name="product_id" value="">
                <div id="body"></div>
            </form>
        </div>

        <a href="#" id="changeFeature" class="button">{{trans('cosmetics.save')}}</a>

    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('frontend/css/cart.css')}}">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.theme.css">
@endsection
@section('scripts')
    <!--formStyler-->
    <script type="text/javascript" src="/frontend/js/formStyler/jquery.formstyler.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend/js/cart.js')}}"></script>


    <script type="text/javascript">


        function setCount(action, obj) {
            var total = +obj.parent().find('.total').text();
            var form = $(obj).parent('form');
            //todo
            switch (action) {
                case 'minus':
                    if (total - 1 > 0) {
                        obj.parent().find('.total').text(total - 1);
                        form.find('input[name="quantity"]').val(total - 1)
                    }

                    break;
                case 'plus':
                    obj.parent().find('.total').text(total + 1);
                    form.find('input[name="quantity"]').val(total + 1);
                    break;
            }
            form.submit();
        }

        $('.minus').click(function () {
            setCount('minus', $(this));
        });
        $('.plus').click(function () {
            setCount('plus', $(this));
        });
        $('.delete').click(function () {
            $(this).parent('form').submit();
        });


        $('.changeChar').click(function () {
            $('#cartChangeForm').fadeToggle('slow');
            $('.overlay').fadeToggle('fast');

            var product_id = +$(this).data('id');
            var arrkey = $(this).data('arrkey');
            var name = $(this).data('name');
            $('#body').parent('form').find('input[name="arrkey"]').val(arrkey);
            $('#body').parent('form').find('input[name="product_id"]').val(product_id);


            $('#body').parent().parent().parent().find('.title').text(name);
            $.post('/getCharList', {_token: '{{ Session::token() }}', product_id: product_id},
                function (data) {
                    $('#body').html(data);
                    $('.featureSelect').styler();
                }
            );


        });

        $('#closeChangeForm').click(function () {
            $('#cartChangeForm').fadeOut('slow');
            $('.overlay').fadeOut('fast');
        });

        $('#changeFeature').click(function () {
            $(this).parent().find('form').submit();
        });


    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        let ofs = {
            dynx_itemid: {!! json_encode($cartIds) !!}, //указываем все id`s которые в корзине
            dynx_pagetype: 'conversionintent', //тип страницы, указать именно это значение
            dynx_totalvalue: {!! json_encode($cartPrices) !!}
        };
        console.log(ofs);
        dataLayer.push(ofs);
    </script>

@endsection