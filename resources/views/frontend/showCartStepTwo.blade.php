@extends('frontend.layout')


@section('main')

    <div class="breadCrumbBg cart">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">{{trans('cosmetics.main')}}</a></li>
                    <li><a href="/cart">{{trans('cosmetics.cart.cart')}}</a></li>
                    <li><a href="/{{ $page->slug }}">{{ $page->name }}</a></li>
                </ul>
                <div class="step col-xs-12">
                    <div class="item cart hidden-xs"><span>{{trans('cosmetics.cart.cart')}}</span></div>
                    <div class="item order active"><span>{{trans('cosmetics.cart.checkout')}}</span></div>
                    <div class="item confirm active"><span>{{trans('cosmetics.cart.confirmation')}}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="cartBg cartTwo">
        <div class="container">
            <div class="row">
                <div class="tabs">
                    <ul>
                        @if (!Auth::check())
                            <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <span>{{trans('cosmetics.cart.new_user')}}</span></li>
                            <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <span>{{trans('cosmetics.cart.old_user')}}</span></li>
                        @endif
                    </ul>
                    <div class="tabsContent col-xs-12">
                        <div class="item row">
                            <form action="/cartStepTwo" method="post">
                                {!! csrf_field() !!}
                                <div class="leftInput col-lg-6 col-md-8 col-sm-8 col-md-offset-1 col-sm-offset-1 col-lg-offset-0 col-xs-12 col-xs-offset-0">
                                    <div class="row">
                                        <label class="textLabel col-lg-4 col-md-3 col-sm-3 col-xs-12" for="name"><span
                                                    class="text">{{trans('cosmetics.cart.name_user')}}</span> <span
                                                    class="required">*</span></label>
                                        <input class="col-lg-8 col-md-9 col-sm-9 col-xs-12" type="text" name="name"
                                               id="name" placeholder="{{trans('cosmetics.cart.name_user')}}"
                                               value="@if(Auth::check()) {{ $user->lastName }} {{ $user->firstName }} {{ $user->middleName }} @endif"
                                               required>

                                        <label class="textLabel col-lg-4 col-md-3 col-sm-3 col-xs-12" for="email"><span
                                                    class="text">E-mail</span> <span class="required">*</span></label>
                                        <input class="col-lg-8 col-md-9 col-sm-9 col-xs-12" type="text" name="mail"
                                               id="email" placeholder="konstantin.konstantionovsky@gmail.com" required
                                               value="@if(Auth::check()) {{ $user->email }} @endif">


                                        <label class="textLabel col-lg-4 col-md-3 col-sm-3 col-xs-12" for="phone"><span
                                                    class="text">{{trans('main.phone')}}</span> <span
                                                    class="required">*</span></label>
                                        <input class="col-lg-8 col-md-9 col-sm-9 col-xs-12" type="text" name="phone"
                                               id="phone" placeholder="+380661234568" required
                                               value="@if(Auth::check()) {{ $user->phone }} @endif">


                                        <label class="textLabel col-lg-4 col-md-3 col-sm-3 col-xs-12" for="city"><span
                                                    class="text">{{trans('cosmetics.cart.city')}}</span> <span
                                                    class="required">*</span></label>
                                        <input class="col-lg-8 col-md-9 col-sm-9 col-xs-12" type="text" name="city"
                                               id="city" placeholder="{{trans('cosmetics.cart.city')}}" required
                                               value="@if(Auth::check()) {{ $user->city }} @endif">
                                    </div>
                                </div>
                                <div class="rightInput col-lg-6 col-md-8 col-sm-8 col-md-offset-1 col-sm-offset-1 col-lg-offset-0 col-xs-12 col-xs-offset-0">
                                    <div class="row">


                                        @if(count($delivery) > 0)
                                            <div class="col-xs-12">
                                                <div class="row">
                                                    <label class="textLabel col-lg-2 col-md-3 col-sm-3 col-xs-12"
                                                           for="delivery"><span
                                                                class="text">{{trans('cosmetics.cart.delivery')}}</span></label>
                                                    <select data-smart-positioning="false" name="delivery" id="delivery"
                                                            class="bigSelect col-lg-8 col-md-9 col-sm-9 col-xs-12">
                                                        @foreach($delivery as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-xs-12">
                                            <div class="row">
                                                <label class="textLabel col-lg-2 col-md-3 col-sm-3 col-xs-12"
                                                       for="addres"><span
                                                            class="text">{{trans('cosmetics.cart.address')}}</span></label>
                                                <input class="col-lg-8 col-md-9 col-sm-9 col-xs-12" type="text"
                                                       name="addres" id="addres"
                                                       value="@if(Auth::check()) {{ $user->address }} @endif">
                                            </div>
                                        </div>


                                        @if(count($payment) > 0)
                                            <div class="col-xs-12">
                                                <div class="row">
                                                    <label class="textLabel col-lg-2 col-md-3 col-sm-3 col-xs-12"
                                                           for="buy"><span
                                                                class="text">{{trans('cosmetics.cart.pay')}}</span></label>
                                                    <select data-smart-positioning="false" name="buy" id="buy"
                                                            class="bigSelect col-lg-8 col-md-9 col-sm-9 col-xs-12">
                                                        @foreach($payment as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>


                                <div class="coment col-xs-12">
                                    <div class="row">
                                        <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12"
                                               for="coment">{{trans('cosmetics.cart.comments')}}</label>
                                        <textarea class="col-lg-9 col-sm-6 col-md-6 col-xs-12" name="coment"
                                                  id="coment"></textarea>
                                    </div>
                                </div>


                                <div class="submit col-xs-12">
                                    <input type="submit" value="{{trans('cosmetics.cart.check')}}">
                                </div>

                            </form>
                        </div>
                        <div class="item">
                            <form action="/login" method="post" class="login col-xs-12">
                                {!! csrf_field() !!}
                                <div class="email row">
                                    <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12" for="emailText">E-mail</label>
                                    <input class="col-lg-3 col-sm-6 col-md-6 col-xs-12" type="text" name="email"
                                           id="emailText" placeholder="konstantin.konstantionovsky@gmail.com" required>
                                </div>

                                <div class="password row">
                                    <label class="col-lg-2 col-sm-3 col-md-3 col-xs-12"
                                           for="passwordText">{{trans('cosmetics.cabinet.password')}}</label>
                                    <input class="col-lg-3 col-sm-6 col-md-6 col-xs-12" type="password" name="password"
                                           id="passwordText" placeholder="{{trans('cosmetics.cabinet.password')}}"
                                           required>
                                </div>

                                <div style="margin-bottom: 20px" class="socialLogin row">
                                    <div style="text-align: right;" class="col-lg-5 col-sm-9 col-xs-12">

                                        <a style="color: #336699;font-family: 'Open Sans Regular', sans-serif;font-weight: bold;font-size: 16px;text-decoration: none;display: block;"
                                           href="{{ $facebookAuthLink }}"
                                           rel="nofollow">{{trans('cosmetics.cabinet.enter_facebook')}}</a>

                                        <a style="color: #336699;font-family: 'Open Sans Regular', sans-serif;font-weight: bold;font-size: 16px;text-decoration: none;display: block;margin-top: 10px;"
                                           href="{{ $googleAuthLink }}"
                                           rel="nofollow">{{trans('cosmetics.cabinet.enter_google')}}e</a>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="loginSubmit col-lg-5 col-sm-9 col-md-9 col-xs-12">
                                        <input type="submit" value="{{trans('cosmetics.cabinet.enter')}}">
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
    <link rel="stylesheet" href="/frontend/css/cart.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.css">
    <link rel="stylesheet" href="/frontend/js/formStyler/jquery.formstyler.theme.css">
@endsection

@section('scripts')
    <!--formStyler-->
    <script type="text/javascript" src="/frontend/js/formStyler/jquery.formstyler.min.js"></script>
    <script type="text/javascript" src="/frontend/js/cart.js"></script>
@endsection