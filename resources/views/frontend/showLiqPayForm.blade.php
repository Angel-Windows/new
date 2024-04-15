@extends('frontend.layout')


@section('main')

    <div class="breadCrumbBg cart">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/cart">Корзина товаров</a></li>
{{--                    <li><a href="/{{ $page->slug }}">{{ $page->name }}</a></li>--}}
                </ul>
                <div class="step col-xs-12">
                    <div class="item cart hidden-xs"><span>Корзина товаров</span></div>
                    <div class="item order active"><span>Оформление заказа</span></div>
                    <div class="item confirm hidden-xs"><span>Подтверджение заказа</span></div>
                </div>
            </div>
        </div>
    </div>



    <div class="cartBg cartTwo">
        <div class="container">
            <div class="row">
                <div class="tabs">
                    {!! $form['form'] !!}
                </div>
            </div>
        </div>
    </div>







@endsection

@section('styles')
    <link rel="stylesheet" href="/frontend/css/cart.css">	<link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.theme.css">
@endsection

@section('scripts')
    <!--formStyler-->
    <script type="text/javascript" src="/frontend/js/formStyler/jquery.formstyler.min.js"></script>
    <script type="text/javascript" src="/frontend/js/cart.js"></script>
@endsection