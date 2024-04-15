<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="yandex-verification" content="ed9d9f0d0d0b7f4a"/>
    @if (  isset( $page->meta_title ) )
        <title>{{{ $page->meta_title }}}</title>
    @endif
    @if (  isset( $page->meta_keywords ) )
        <meta name="keywords" content="{{{ $page->meta_keywords }}}">
    @endif
    @if (  isset( $page->meta_description )  )
        <meta name="description" content="{{{ $page->meta_description }}}">
    @endif
    @if (Input::has('page'))
        <link rel="canonical" href="http://myoptics.com.ua/news"/>
    @endif
    <!--css-->
    <link rel="stylesheet" href="{{asset('frontend/css/layout.css')}}">
    @section('styles')
    @show
    <link rel="stylesheet" href="/frontend/css/media.css">
    <style type="text/css">
        .overlayCart {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
            z-index: 999;
        }

        .overlayCart:target {
            visibility: visible;
            opacity: 1;
        }

        .cartSuccess {
            margin: 170px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .cartSuccess h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }

        .cartSuccess .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .cartSuccess .close:hover {
            color: #06D85F;
        }

        .cartSuccess .content {
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px) {
            .box {
                width: 70%;
            }

            .cartSuccess {
                width: 70%;
            }
        }
    </style>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    @include('frontend.analyticstracking')
    <meta name="google-site-verification" content="3KYlf7YbWjLp91HkN_pnoOVN2TXZruEW4rgyNsKcuYU"/>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="top-content col-xs-12">
                <div class="row d-flex">

                    <div class="logo col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <a href="/">
                            <img src="/uploads/logo/{{ $settings->logo }}" alt="#">
                        </a>
                    </div>

                    <div class="right-top-content reset-padding col-lg-4 col-lg-offset-3     col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6 col-xs-6">
                        <div class="phones hidden-xs">
                            <span class="item">{{ $settings->phone1 }}</span>
                            <span class="item">{{ $settings->phone2 }}</span>
                        </div>
                        <div class="icons d-flex">
                            <div class="search"></div>
                            @if(Auth::check())
                                <a href="/personal-area">
                                    <div class="profile"></div>
                                </a>
                            @else
                                <div class="profile"></div>
                            @endif
                            <a href="/cart">
                                <div class="busket">
                                    @if( $cart_info['quantity'] > 0 )
                                        <span class="count">{{ $cart_info['quantity'] }}</span>
                                    @endif
                                </div>
                            </a>


                        </div>

                    </div>
                    <div class="lang">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="lang-link {{ strtoupper(app()->getLocale()) == $properties['native'] ? 'active' : '' }}"
                               rel="alternate" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <form id="searchForm" action={{route('search')}} method="get">

                    <input type="text" name="search" placeholder="{{trans('cosmetics.search_text')}}" required>
                    <input type="submit" value="{{trans('cosmetics.search')}}">
                    <div title="Закрыть" id="closeSearch"></div>
                </form>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="burger col-md-6 col-sm-6 col-sm-offset-3 col-md-offset-3 hidden-lg" id="burger">
                <span>Меню</span></div>

            <ul class="menu col-lg-12 col-lg-offset-0 col-md-6 col-sm-6 col-sm-offset-3 col-md-offset-3 col-xs-12">
                <li><a @if( Request::segment(1) == '' ) class="active" @endif href="/">{{trans('cosmetics.main')}}</a>
                </li>


                @foreach($categories->sortBy('id') as $cat)
                    <li><a @if( Request::segment(2) == $cat->slug ) class="active"
                           @endif href="/category/{{ $cat->slug }}">{{$cat->name}}</a>
                        @if(count( $cat->children ) )
                            <ul class="child">
                                @foreach(  $cat->children as $subcat )
                                    <li>
                                        <a href="/category/{{ $subcat->slug }}">{{$subcat->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                @foreach( $pages as $pg )
                    @if( $pg->type == 'main' && $pg->slug != '/' && !in_array($pg->id, [41]))
                        <li><a @if( Request::segment(1) == $pg->slug ) class="active"
                               @endif href="/{{ $pg->slug }}">{{ $pg->name }}</a></li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>
</header>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WL9RBS4"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
@yield('main')
</body>
<footer>
    <div class="border-container">
        <div class="container">
            <div class="row">
                <div class="footer-nav col-xs-12">
                    <div class="row">
                        <div class="footLogo col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <img src="/uploads/logo/{{ $settings->logo }}" alt="#">
                        </div>
                        <ul class="footMenu col-lg-9 col-md-8 col-sm-8 hidden-xs">
                            <li><a href="/">{{trans('cosmetics.main')}}</a></li>

                            <?php $i = 0; ?>
                            @foreach($footCatArray as $item)
                                @if($i++ < 3)
                                    <li>
                                        <a href="@if(isset($item['show_block_1']))/category/@endif{{ $item['slug'] }}">{{ $item['name'] }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="/{{ $item['slug'] }}">{{ $item['name'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="footerInfo col-xs-12">
                    <div class="row">
                        <div class="contactsInfo col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <div class="phones">
                                @if(!empty($settings->phone1))
                                    <div class="item">{{ $settings->phone1 }}</div>
                                @endif
                                @if(!empty($settings->phone2))
                                    <div class="item">{{ $settings->phone2 }}</div>
                                @endif
                            </div>
                            @if(!empty($settings->email))
                                <div class="mail">{{ $settings->email }}</div>
                            @endif
                            @if(!empty($settings->address))
                                <div class="address">{{ $settings->address }}</div>
                            @endif
                        </div>
                        <div class="footText col-lg-9 col-md-8 col-sm-8 hidden-xs">
                            {!! $settings->footText !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="copir col-xs-12">
                <span class="pull-left">{{ $settings->copir }}</span>
                <a href="{{asset('puboferta.pdf')}}" class="pull-left"
                   style="color:#888888">{{trans('cosmetics.offerta')}}</a>
                <img src="{{asset('Myoptics_Visa_MC.png')}}" class="pull-right" style="width: 170px"
                     alt="Visa MasterCard logo">
            </div>
        </div>
    </div>


</footer>


<div class="overlay"></div>
<div class="loginForm" id="loginForm">
    <div id="closeLoginForm"></div>
    <div class="title">
        {{trans('cosmetics.cabinet.enter')}}
    </div>

    <form action="/login" method="post">
        {!! csrf_field() !!}
        <label for="mail">E-mail:</label>
        <input type="text" id="mail" name="email" placeholder="konstantin.konstantionovsky@gmail.com" required>

        <label for="password">{{trans('cosmetics.cabinet.password')}}</label>
        <input type="password" id="password" name="password" required>

        <div class="formBottom">
            <input type="checkbox" name="rememberMe" class="rememberMe" id="rememberMe">
            <label class="rememberLabel" for="rememberMe">{{trans('cosmetics.cabinet.remember')}}</label>
            <a href="/password/email">{{trans('cosmetics.cabinet.forgot')}}</a>
            <a class="reg" href="/reg">{{trans('cosmetics.cabinet.registered')}}</a>
        </div>

        <div class="loginWithFB">
            <a href="{{ $facebookAuthLink }}" rel="nofollow">{{trans('cosmetics.cabinet.enter_facebook')}}</a>
        </div>

        <div class="loginWithGoogle">
            <a href="{{ $googleAuthLink }}" rel="nofollow">{{trans('cosmetics.cabinet.enter_google')}}</a>
        </div>

        <input type="submit" value="{{trans('cosmetics.cabinet.enter_short')}}">
    </form>

</div>


@if(Session::has('message'))
    <div id="popup1" class="overlayCart">
        <div class="cartSuccess">
            <div class="content">
                {{ (app()->getLocale()=='uk' ? \TranslateBranch::getTranslateText(Session::get('message'), 'uk') : Session::get('message') )  }}
            </div>
        </div>
    </div>
@endif




<!--js-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="/frontend/js/layout.js"></script>
<script type="text/javascript">
    @if(!Auth::check())
    //профиль
    $('.profile').click(function () {
        $(this).toggleClass('active');
        $('#loginForm').fadeToggle(200);
        $('.overlay').fadeToggle('fast');
    });
    @endif


    @if(Session::has('message'))

    $(document).ready(function () {
        $('.overlayCart').css({"opacity": "1", "visibility": "visible"});
        setTimeout(function () {
            $('#popup1').fadeOut(800);
        }, 1500);
    });

    @endif

</script>
@section('scripts')
@show
<!-- QnkgTmlrb2xheSBUc3Vya2Fu -->
</body>
</html>