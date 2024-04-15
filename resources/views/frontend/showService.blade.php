@extends('frontend.layout')

@section('main')

    <div class="breadCrumbBg contacts">
        <div class="container">
            <div class="row">
                <ul class="breadCrumbs col-xs-12">
                    <li><a href="/">{{trans('cosmetics.main')}}</a></li>
                    <li><a href="/{{ $page->slug }}">{{ $page->name }}</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="pers_area not col-xs-12">
                <div class="row">

                    @if (Auth::check())
                        <form action="/service" method="post" class="notificationForm col-lg-4" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="formRow">
                                <label for="title"> {{trans('cosmetics.cabinet.service_application')}} </label><br>
                                <input type="text" name="title" id="title" required>
                            </div>

                            <div class="formRow">
                                <label for="text"> {{trans('cosmetics.cabinet.service_text')}} </label><br>
                                <textarea name="text" id="text" placeholder="Текст заявки" required></textarea>
                            </div>

                            <div class="formRow">
                                <label for="filestyle"> {{trans('cosmetics.cabinet.service_image')}}</label><br>
                                <input class="filestyle" data-value="" data-buttontext="{{trans('cosmetics.cabinet.service_file')}}" data-buttonname="btn-primary" data-icon="false" multiple="true" name="file[]" type="file" id="filestyle">
                            </div>

                            <input type="submit" value="{{trans('cosmetics.cabinet.create')}}">
                        </form>


                        <div class="title col-xs-12">{{trans('cosmetics.cabinet.service_exist')}}</div>


                        <div class="notList col-xs-12">

                            @if(count($service) > 0)
                                <table>
                                    <tr class="thead">
                                        <th>{{trans('cosmetics.cabinet.service_date')}}</th>
                                        <th>Тема</th>
                                        <th></th>
                                    </tr>

                                    @foreach($service as $item)
                                        <tr class="tbody">
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->title }}</td>
                                        </tr>
                                    @endforeach

                                </table>
                            @else
                                {{trans('cosmetics.cabinet.not_notify')}}
                            @endif
                        </div>

                    @endif
                </div>
            </div>
        </div>
        <!-- wrapper end -->

        @endsection

        @section('scripts')

        @endsection

        @section('styles')
            <link rel="stylesheet" href="/frontend/css/contacts.css">
            <link rel="stylesheet" href="/frontend/css/user.css">
@endsection
