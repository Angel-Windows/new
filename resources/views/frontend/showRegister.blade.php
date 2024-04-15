@extends('frontend.layout')


@section('main')

    <div class="breadCrumbBg contacts">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">{{trans('cosmetics.main')}}</a></li>
                    <li><a href="/reg">{{trans('cosmetics.cabinet.registered')}}</a></li>
                </ul>

            </div>
        </div>
    </div>

<div class="cartBg cartTwo">
    <div class="container">
        <div class="row">
            <div class="tabs">
                <div class="tabsContent col-xs-12">
                    <div class="item row">
                        <form action="/register" method="post" class="login col-xs-12 register">
                            {!! csrf_field() !!}
                            <div class="email row">
                                <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12" for="emailText">E-mail</label>
                                <input class="col-lg-3 col-sm-6 col-md-6 col-xs-12" type="text" name="email" id="emailText" placeholder="konstantin.konstantionovsky@gmail.com" required>
                            </div>

                            <div class="password row">
                                <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12" for="passwordText">{{trans('cosmetics.cabinet.password')}}</label>
                                <input class="col-lg-3 col-sm-6 col-md-6 col-xs-12" type="password" name="password" id="passwordText" placeholder="{{trans('cosmetics.cabinet.password')}}" required>
                            </div>

                            <div class="password row">
                                <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12" for="firstName">{{trans('cosmetics.name')}}</label>
                                <input class="col-lg-3 col-sm-6 col-md-6 col-xs-12" type="text" name="firstName" id="firstName" placeholder="{{trans('cosmetics.name')}}" required>
                            </div>

                            <div class="password row">
                                <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12" for="phone">{{trans('cosmetics.phone')}}</label>
                                <input class="col-lg-3 col-sm-6 col-md-6 col-xs-12" type="text" name="phone" id="phone" placeholder="{{trans('cosmetics.phone')}}" required>
                            </div>

                            <div class="row">
                                <div class="loginSubmit col-lg-5 col-sm-9 col-md-9 col-xs-12">
                                    <input type="submit" value="{{trans('cosmetics.registration')}}">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('frontend/css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/contacts.css')}}">
@endsection
