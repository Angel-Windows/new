@extends('frontend.layout')


@section('main')

    <div class="breadCrumbBg cart">
        <div class="container">
            <div class="row">

                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">{{trans('cosmetics.main')}}</a></li>
                    <li><a href="/cart">{{trans('cosmetics.cart.cart')}}</a></li>
                    <li><a href="/cartStepTwo">{{trans('cosmetics.cart.checkout')}}</a></li>
                    {{--                    <li><a href="#">{{ $page->name }}</a></li>--}}
                </ul>

                <div class="step col-xs-12">
                    <div class="item cart hidden-xs"><span>{{trans('cosmetics.cart.cart')}}</span></div>
                    <div class="item order "><span>{{trans('cosmetics.cart.checkout')}}</span></div>
                    <div class="item confirm active"><span>{{trans('cosmetics.cart.confirmation')}}</span></div>
                </div>

            </div>
        </div>
    </div>

    <div class="cartBg cartThree">
        <div class="container">
            <div class="row">
                <div class="youOrder">
                    <div class="ytitle col-xs-12">
                        <div class="xs-small">
                            <span>{{trans('cosmetics.cart.your_order')}}</span> № {{ $countOrder }}
                        </div>
                    </div>

                    <div class="itemsList">

                        @if(count($cartProduct) > 0)
                                <?php $i = 1; ?>
                            @foreach($cartProduct as $item)

                                <div class="orderItem col-xs-12">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">
                                                <div class="num">
                                                    {{ $i++ }}
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                                                <div class="charList">
                                                    <div class="title">
                                                        @foreach ($item['product'] as $product)
                                                            {{ (app()->getLocale())=='uk' ? \TranslateBranch::getTranslateText( (string) $product->translations[0]->name , 'uk') : $product->translations[0]->name}}
                                                        @endforeach
                                                    </div>
                                                    <ul class="charUl">
                                                        @foreach($item['charlist'] as $char)
                                                            <li>
                                                                {{ (app()->getLocale())=='uk' ? \TranslateBranch::getTranslateText( (string) $char['name']  , 'uk') :  $char['name']  }}
                                                                <span>
                                                                   {{ (app()->getLocale())=='uk' ? \TranslateBranch::getTranslateText( (string) $char['value']  , 'uk') :  $char['value']  }}
                                                               </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                                                <div class="total">
                                                    <div class="count">{{ $item['quantity'] }}</div>
                                                    <div class="price">
                                                        <span>{{ number_format($item['quantity'] * $item['product'][0]->price - ($item['product'][0]->price * $userDiscount * $item['quantity']), 2, ',', '') }}</span>
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

                <div class="youDelivery">
                    <div class="dtitle col-xs-12">{{trans('cosmetics.cart.delivery_name')}}:</div>

                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="deliveryBlock">
                            <div class="ditem">
                                <div class="title">{{trans('cosmetics.cart.user')}}</div>
                                <div class="value">{{ $name }}</div>
                            </div>

                            <div class="ditem">
                                <div class="title">{{trans('cosmetics.phone')}}</div>
                                <div class="value">{{ $phone }}</div>
                            </div>

                            <div class="ditem address">
                                <div class="title">{{trans('cosmetics.cart.address_delivery')}}</div>
                                <div class="value">{{ $city }}, {{ $addres }}</div>
                            </div>

                            <div class="ditem block">
                                <div class="title">{{trans('cosmetics.cart.pay_name')}}</div>
                                <div class="value">{{ $buy->name }}</div>
                            </div>

                            <div class="ditem block">
                                <div class="title">{{trans('cosmetics.cart.comments_name')}}</div>
                                <div class="value">{{ $coment }}</div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="total">
                            <div class="totalBlock">
                                <div class="title">{{trans('cosmetics.cart.total')}}</div>
                                <div class="titem">
                                    <span class="text">{{trans('cosmetics.cart.product')}}</span>
                                    <span class="value"><b>{{ number_format($cart_info['total_price'],2,',','') }}</b> Грн</span>
                                </div>

                                <div class="titem">
                                    <span class="text">{{trans('cosmetics.cart.delivery_name')}}</span>
                                    <span class="value"><b>{{ number_format($deliveryInfo->price,2,',','') }}</b> Грн</span>
                                </div>

                                <div class="titem">
                                    <span class="text">{{trans('cosmetics.cart.from_pay')}}</span>
                                    <span class="value"><b>{{ number_format($cart_info['total_price'] + $deliveryInfo->price ,2,',','') }}</b> Грн</span>
                                </div>

                                <form action="/confirmOrder" method="post">

                                    {!! csrf_field() !!}
                                    <input type="hidden" name="name" value="{{$name}}">
                                    <input type="hidden" name="address" value="{{$addres}}">
                                    <input type="hidden" name="phone" value="{{$phone}}">
                                    <input type="hidden" name="city" value="{{$city}}">
                                    <input type="hidden" name="coment" value="{{$coment}}">
                                    <input type="hidden" name="buy" value="{{$buy->id}}">
                                    <input type="hidden" name="delivery" value="{{$deliveryInfo->id}}">
                                    <input type="hidden" name="email" value="{{$mail}}">
                                    <input type="hidden" name="total_cost"
                                           value="{{$cart_info['total_price'] + $deliveryInfo->price}}">

                                    <a id="confirmOrder" href="#" class="button">
                                        {{trans('cosmetics.cart.order_ok')}}
                                    </a>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="/frontend/css/cart.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.theme.css">
@endsection

@section('scripts')
    <!--formStyler-->
    <script type="text/javascript" src="/frontend/js/formStyler/jquery.formstyler.min.js"></script>
    <script type="text/javascript" src="/frontend/js/cart.js"></script>

    <script type="text/javascript">
        $('#confirmOrder').click(function (e) {
            e.preventDefault();
            $(this).parent('form').submit();
        });
    </script>

@endsection