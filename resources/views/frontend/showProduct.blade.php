@extends('frontend.layout')

@section('product')
@endsection

@section('description')
@endsection

@section('specification')
@endsection

@section('reviews')
@endsection

@section('add-reviews')
@endsection

@section('main')
    <?php $show = 0; ?>



    <div class="breadCrumbBg card">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">{{trans('cosmetics.main')}}</a></li>
                    @foreach( $breadcrumbs as $par )
                        @if( isset($par) )
                            <li><a href="/category/{{ $par->slug }}">{{ $par->name }}</a></li>
                        @endif
                    @endforeach
                    @if( Request::segment(1) == 'product' && isset($page) )
                        <li><a href="{{ $page->slug }}">{{ $page->name }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>


    <div class="productCardBg">
        <div class="container">
            <div class="row">
                <div class="productCard col-lg-12 col-md-8 col-sm-8">
                    <div class="title">
                        {{ $page->name }}
                        <span class="code">Артикул: {{ $page->code }}</span>
                    </div>
                </div>

                <div class="productInfoContent col-xs-12">
                    <div class="row">
                        <div class="anchors col-xs-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <a href="#description" class="item col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            {{trans('cosmetics.product.desc')}}
                                        </a>

                                        <a href="#charlist" class="item col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            {{trans('cosmetics.product.options')}}
                                        </a>


                                        <a href="#rewiew" class="item col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            {{trans('cosmetics.product.comments')}}
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="productImage col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="image @if($page->discount == 1) discount @endif @if($page->new == 1) new @endif @if($page->sale == 1) sale @endif hidden-xs">
                                @if($page->image)
                                    <img src="/uploads/products/lg/{{ $page->image }}" alt="#">
                                @else
                                    <div class="item">
                                        <img src="{{asset('uploads/products/lg/no_image.png')}}" alt="no_image">
                                    </div>
                                @endif
                            </div>
                            <div id="xsSliderImage" class="visible-xs-block col-xs-12">
                                @if($page->image)
                                    @foreach( $page->imgs as $key_img => $img )
                                        <div class="item">
                                            <img src="/uploads/products/lg/{{ $img }}"
                                                 alt="{{ $page->name.' '.($key_img+1) }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <img src="{{asset('uploads/products/lg/no_image.png')}}" alt="no_image">
                                    </div>
                                @endif
                            </div>


                            @if($page->image)
                                <div class="imageSlider hidden-xs">

                                    @foreach( $page->imgs as $key_img => $img )
                                        <div class="item">
                                            <img src="/uploads/products/sm/{{ $img }}"
                                                 alt="{{ $page->name.' '.($key_img+1) }}">
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        </div>

                        <div class="productTabs col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="rating">
                                <span>{{trans('cosmetics.product.rating')}}:</span>
                                <div class="starts">
                                    @for($i = 0; $i < 5 ;$i++)
                                        <div class="item @if($page->votes != 0) @if($i < (int)($page->rating_sum / $page->votes) ) active @endif @endif "></div>
                                    @endfor
                                </div>
                            </div>

                            @if(count($charlist_options) > 0)
                                <div class="tabs">
                                    <ul>
                                        <li id="single" data-checkout="1">{{trans('cosmetics.product.sam')}}</li>
                                        <li id="double" data-checkout="0">{{trans('cosmetics.product.various')}}</li>
                                    </ul>
                                    <div class="tabsContent">
                                        <div class="item" id="single_charlist">

                                            <form action="/cartCharlist" method="post" id="singleCharlist">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="prod_id" value="{{ $page->id }}">
                                                <input type="hidden" id="single_quanbtity" name="single_quanbtity"
                                                       value="1">
                                                @foreach( $charlist as $char )

                                                        <?php
                                                        $flag = false;
                                                        if (isset($charlist_options[$char->id])) {
                                                            $array = $charlist_options[$char->id];
                                                        } else {
                                                            $array = [];
                                                        }
                                                        ?>
                                                    @foreach( $char->variants as $key => $v )
                                                        @if(is_array($array) && isset($char->variants[$key]))
                                                            @if(in_array($v->name, $array))
                                                                    <?php
                                                                    $flag = true;
                                                                    ?>
                                                            @endif
                                                        @endif
                                                    @endforeach

                                                    {{--													@if( isset($charlist_options[$char->id]) && $flag)--}}
                                                    @if( isset($charlist_options[$char->id]))
                                                        <div class="charlist">
                                                            <div class="name">{{ $char->name }}</div>
                                                            <div class="single">
                                                                <select data-smart-positioning="false"
                                                                        class="featureSelect" name="feature[]">
                                                                    @foreach( $char->variants as $v )
                                                                        @if(in_array($v->name, $charlist_options[$char->id]))
                                                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </form>

                                            <div class="charlist">
                                                <div class="name">{{trans('cosmetics.product.qty')}}</div>
                                                <div class="single">
                                                    <div class="count">
                                                        <input type="hidden" name="totalSingle" value="1">
                                                        <div class="minus">-</div>
                                                        <span class="total">1</span>
                                                        <div class="plus">+</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="item" id="double_charlist">


                                            <form action="/cartCharlist" method="post" id="doubleCharlist">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="prod_id" value="{{ $page->id }}">
                                                <input type="hidden" id="quantityLeft" name="quantityLeft" value="1">
                                                <input type="hidden" id="quantityRight" name="quantityRight" value="1">

                                                @foreach( $charlist as $char )
                                                        <?php
                                                        $flag = false;
                                                        if (isset($charlist_options[$char->id])) {
                                                            $array = $charlist_options[$char->id];
                                                        } else {
                                                            $array = [];
                                                        }
                                                        ?>

                                                    @foreach( $char->variants as $v )
                                                        @if(in_array($v->name, $array))
                                                                <?php $flag = true; ?>
                                                        @endif
                                                    @endforeach

                                                    @if( isset($charlist_options[$char->id] ) && $flag )
                                                        <div class="charlist">
                                                            <div class="name">{{ $char->name }}</div>
                                                            <div class="leftEye">
                                                                <select data-smart-positioning="false"
                                                                        class="featureSelect" name="featureleft[]">
                                                                    @foreach( $char->variants as $v )
                                                                        @if(in_array($v->name, $charlist_options[$char->id]))
                                                                                <?php $show = 1; ?>
                                                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="rightEye">
                                                                <select data-smart-positioning="false"
                                                                        class="featureSelect" name="featureright[]">
                                                                    @foreach( $char->variants as $v )
                                                                        @if(in_array($v->name, $charlist_options[$char->id]))
                                                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </form>

                                            <div class="charlist">
                                                <div class="name">{{trans('cosmetics.product.qty')}}</div>
                                                <div class="leftEye">
                                                    <div class="count">
                                                        <input type="hidden" name="totalLeft" value="1">
                                                        <div class="minus">-</div>
                                                        <span class="total">1</span>
                                                        <div class="plus">+</div>
                                                    </div>
                                                </div>

                                                <div class="rightEye">
                                                    <div class="count">
                                                        <input type="hidden" name="totalRight" value="1">
                                                        <div class="minus">-</div>
                                                        <span class="total">1</span>
                                                        <div class="plus">+</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="tabs">

                                    <div class="tabsContent">

                                        <div class="item" id="double_charlist">


                                            <form action="/cartCharlist" method="post" id="singleCharlist">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="prod_id" value="{{ $page->id }}">
                                                <input type="hidden" id="single_quanbtity" name="single_quanbtity"
                                                       value="1">
                                                <input type="hidden" id="feature" name="feature[]" value="">


                                            </form>
                                            <div class="charlist">
                                                <div class="name">{{trans('cosmetics.product.qty')}}</div>
                                                <div class="single">
                                                    <div class="count">
                                                        <input type="hidden" name="totalSingle" value="1">
                                                        <div class="minus">-</div>
                                                        <span class="total">1</span>
                                                        <div class="plus">+</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            <div class="row">
                                <div class="prices col-xs-12">
                                    @if($page->oldPrice > 0)
                                        <div class="old">{{ number_format($page->oldPrice, 2, ',', '') }}</div>
                                    @endif
                                    <div class="now">
                                        <span>{{ number_format($page->price - ($page->price * $userDiscount), 2, ',', '') }}</span>
                                        Грн
                                    </div>
                                </div>

                                <a id="buy" class="button" href="#">
                                    {{trans('cosmetics.pay')}}
                                </a>

                            </div>

                        </div>


                    </div>
                </div>


            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="infoBlock col-xs-12">
                    <div class="title" id="description">
                        <span>{{trans('cosmetics.product.desc')}}</span>
                    </div>
                    <div class="text">
                        {!! $page->body !!}
                    </div>
                </div>


                <div class="infoBlock col-xs-12">
                    <div class="title" id="charlist">
                        <span>{{trans('cosmetics.product.options')}}</span>
                    </div>
                    <div class="row">
                        <table class="charTable">

                            <tbody>

                            @if ( isset($page->specification) && $page->specification != '' )
                                @foreach($page->specification as $dtbl)
                                    <tr>
                                        <td class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                            @if (app()->getLocale()=='uk')
                                                {{ \TranslateBranch::getTranslateText($dtbl['name'], 'uk') }}

                                            @else
                                                {{$dtbl['name']}}
                                            @endif
                                        </td>
                                        <td class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
                                            @if (app()->getLocale()=='uk')
                                                {{ \TranslateBranch::getTranslateText($dtbl['value'], 'uk') }}

                                            @else
                                                {{$dtbl['name']}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                Пусто
                            @endif

                            </tbody>

                        </table>
                    </div>
                </div>


                <div class="infoBlock col-xs-12">
                    <div class="title" id="rewiew">
                        <span>{{trans('cosmetics.product.comments')}} ({{ count($prod_reviews) }})</span>
                    </div>

                    <div class="reviews">
                        <div class="sendReviewForm">
                            <div id="avatar" class="avatar">
                                <img src="{{asset('uploads/avatar/no_avatar.png')}}" alt="#">
                            </div>
                            <div class="formContent">


                                <form action="/sendRewiew" method="post">
                                    {!! csrf_field() !!}
                                    <div id="rating" class="rating">

                                        <input type="hidden" name="stars" id="stars" value="0">
                                        <input type="hidden" name="product_id" value="{{ $page->id }}">

                                        <span>{{trans('cosmetics.product.rate')}}</span>


                                        <div class="stars">
                                            <input type="radio" name="star" class="star-1" id="star-1"/>
                                            <label data-count="1" class="star-1 starSelect" for="star-1">1</label>
                                            <input type="radio" name="star" class="star-2" id="star-2"/>
                                            <label data-count="2" class="star-2 starSelect" for="star-2">2</label>
                                            <input type="radio" name="star" class="star-3" id="star-3"/>
                                            <label data-count="3" class="star-3 starSelect" for="star-3">3</label>
                                            <input type="radio" name="star" class="star-4" id="star-4"/>
                                            <label data-count="4" class="star-4 starSelect" for="star-4">4</label>
                                            <input type="radio" name="star" class="star-5" id="star-5"/>
                                            <label data-count="5" class="star-5 starSelect" for="star-5">5</label>
                                            <span></span>
                                        </div>

                                    </div>
                                    <div class="rewiewText">
                                        <input id="fullRewiew" type="text" name="text"
                                               placeholder="{{trans('cosmetics.product.take_comments')}}">
                                    </div>


                                    @if(!Auth::check())

                                        <div class="bottomRewiw">
                                            <div class="inputs">
                                                <input type="text" name="name" placeholder="Ваше Имя">
                                                <input type="text" name="mail" placeholder="Электронная почта">
                                            </div>
                                            <div class="social">
                                                <div class="stext"> {{trans('cosmetics.product.take_enter')}}</div>
                                                <div class="socials">
                                                    <a href="{{ $facebookAuthLink }}" rel="nofollow"><img
                                                                src="/frontend/img/social/fb.png" alt="#"></a>
                                                    <a href="{{ $googleAuthLink }}" rel="nofollow"><img
                                                                src="/frontend/img/social/google.png" alt="#"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <input type="submit" value="{{trans('cosmetics.product.send')}}">

                                </form>
                            </div>
                        </div>

                        <div class="items">

                            @if(count($prod_reviews) > 0)

                                @foreach($prod_reviews as $item )
                                    <div class="itemRewiew">
                                        <div class="avatar">
                                            <img src="{{asset('uploads/avatar/no_avatar.png')}}" alt="#">
                                        </div>

                                        <div class="content">
                                            <div class="top">
                                                <div class="name">{{ $item->name }}</div>
                                                <div class="stars">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <div class="item @if($i < $item->rating) active @endif"></div>
                                                    @endfor
                                                </div>
                                                {{--<div class="date">26.01.17  00:11</div>--}}
                                                {{-- 2017-06-01 17:51:18--}}

                                                    <?php
                                                    //todo
                                                    $date = explode(' ', $item->created_at);
                                                    $d = explode('-', $date[0]);

//												var_dump($date[0]);exit();

                                                    $y = $d[0];
                                                    $m = $d[1];
                                                    $dd = $d[2];


                                                    $d2 = explode(':', $date[1]);

                                                    $h = $d2[0];
                                                    $min = $d2[1];

                                                    ?>

                                                <div class="date">{{$dd}}.{{$m}}.{{$y}} {{$h}}:{{$min}}</div>
                                            </div>
                                            <div class="allText">
                                                {{ $item->text }}
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>

                </div>

            </div>
        </div>


    </div>


    @if( count( $alike_pr ) > 0 )

        <div class="alikeGoodsBg">
            <div class="container">
                <div class="alikeGoodsBlock col-xs-12">
                    <div class="ltitle">{{trans('cosmetics.product.pay_from_product')}}</div>

                    <div class="alikeGoodsSlider row">
                        @foreach( $alike_pr as $hit)

                            <div class="product col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                <div class="item">
                                    <div class="image">
                                        @if( $hit->image !='')
                                            <img src="/uploads/products/md/{{ $hit->image }}" alt="{{ $hit->name }}">
                                        @else
                                            <img src="{{trans('uploads/products/md/no_image.png')}}" alt="#">
                                        @endif
                                    </div>
                                    <div class="information">
                                        <div class="title">{{ $hit->name }}</div>
                                        <div class="text">
                                            {{ substr(strip_tags($hit->description), 0 , 120).'...' }}
                                        </div>
                                        <div class="prices">
                                            @if($hit->oldPrice > 0)
                                                <div class="old">{{ number_format($hit->oldPrice, 2, ',', '') }}</div>
                                            @endif
                                            <div class="now">
                                                <span>{{ number_format($hit->price - ($hit->price * $userDiscount), 2, ',', '') }}</span>
                                                Грн
                                            </div>
                                        </div>

                                        <a class="button" href="#">
                                            {{trans('cosmetics.pay')}}
                                        </a>

                                    </div>
                                    <div class="up-block">
                                        <div class="starts">
                                            @for($i = 0; $i < 5 ;$i++)
                                                <div class="item @if($hit->votes != 0) @if($i < (int)($hit->rating_sum / $hit->votes) ) active @endif @endif "></div>
                                            @endfor
                                        </div>

                                        <div class="characteristics">
                                                <?php $count = 0; ?>

                                            @foreach(unserialize($hit->specification) as $dtbl)
                                                @if($count++ > 2)
                                                        <?php break; ?>
                                                @endif
                                                <div class="item">
                                                    <div class="title">

                                                        @if (app()->getLocale()=='uk')
                                                            {{ \TranslateBranch::getTranslateText($dtbl['name'], 'uk') }}

                                                        @else
                                                            {{$dtbl['name']}}
                                                        @endif
                                                    </div>
                                                    <div class="value">{{ $dtbl['value'] }}</div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <a class="button" href="/product/{{ $hit->slug }}">
                                            {{trans('cosmetics.pay')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                </div>


            </div>
        </div>

    @endif

@endsection

@section('styles')
    <link rel="stylesheet" href="/frontend/css/card.css">
    <link rel="stylesheet" href="/frontend/js/slick/slick-theme.css">
    <link rel="stylesheet" href="/frontend/js/slick/slick.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.theme.css">
@endsection

@section('scripts')
    <!--formStyler-->
    <script type="text/javascript" src="/frontend/js/formStyler/jquery.formstyler.min.js"></script>
    <!--slick slider-->
    <script src="/frontend/js/slick/slick.min.js"></script>
    <script type="text/javascript" src="/frontend/js/card.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.overlayCart').css({"opacity": "1", "visibility": "visible"});
        });

        function singleToCart() {

            $('#single_quanbtity').val(+$('input[name="totalSingle"]').val());
            $('#singleCharlist').submit();

        }

        function doubleToCart() {

            $('#quantityLeft').val(+$('input[name="totalLeft"]').val());
            $('#quantityRight').val(+$('input[name="totalRight"]').val());
            $('#doubleCharlist').submit();
        }


        $('#buy').click(function (e) {
            e.preventDefault();


            console.log();

            var single = $('#single').hasClass('active');

            if (single) {
                singleToCart();
            } else {
                doubleToCart();
            }

        });

        $('label.starSelect').click(function () {
            $('#stars').val($(this).data('count'));
        });


    </script>

    {{--   Динамический ремаркетинг   --}}
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            dynx_itemid: {{ $page->id }}, //id товара из crm
            dynx_pagetype: 'offerdetail', //тип страницы, указать именно это значение
            dynx_totalvalue: {{ $page->price - ($page->price * $userDiscount) }}  //без кавычек
        });
    </script>

@endsection