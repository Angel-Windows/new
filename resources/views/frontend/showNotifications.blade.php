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
                        <form action="/notifications" method="post" class="notificationForm col-lg-4">
                            {!! csrf_field() !!}
                            <div class="formRow">
                                <label for="date"> {{trans('cosmetics.cabinet.data_notify')}}</label><br>
                                <input type="date" name="delivery_date" id="date" required>
                            </div>

                            <div class="formRow">
                                <input name="repeat" type="checkbox" id="repeat">
                                <label class="repeat" for="repeat"> {{trans('cosmetics.cabinet.repeat')}}</label>
                            </div>

                            <div class="formRow">
                                <label for="interval"> {{trans('cosmetics.cabinet.interval')}}</label><br>
                                <input type="number" min="1" name="interval" id="interval"
                                       placeholder="{{trans('cosmetics.cabinet.interval')}}" required>
                            </div>

                            <input type="submit" value="{{trans('cosmetics.cabinet.create_notify')}}">
                        </form>

                        <div class="title col-xs-12">{{trans('cosmetics.cabinet.exist_notify')}}</div>


                        <div class="notList col-xs-12">

                            @if(count($notification) > 0)
                                <table>
                                    <tr class="thead">
                                        <th>{{trans('cosmetics.cabinet.date_notify')}}</th>
                                        <th class="hidden-xs">{{trans('cosmetics.cabinet.repeat_notify')}}</th>
                                        <th>{{trans('cosmetics.cabinet.repeat_interval_notify')}}</th>
                                        <th></th>
                                    </tr>

                                    @foreach($notification as $item)
                                            <?php $delivery_date = explode(' ', $item->delivery_date); ?>

                                        <tr class="tbody">
                                            <td>{{ $delivery_date[0] }}</td>
                                            <td class="hidden-xs">{{ $item->repeat == 1 ? 'Да' : 'Нет' }}</td>
                                            <td>{{trans('after_notify')}} {{ $item->interval }} {{trans('cosmetics.cabinet.days_notify')}}</td>
                                            <td>
                                                <div data-id="{{ $item->id }}" class="del"></div>
                                            </td>
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
            <script>

                $('.del').click(function () {
                    var pointer = $(this);
                    var id = pointer.data('id');
                    $.post('/notifications', {_token: '{{ Session::token() }}', id: id},
                        function (data) {
                            pointer.parent().parent('.tbody').fadeOut(function () {
                                $(this).remove();
                            });
                        });
                });

            </script>
        @endsection

        @section('styles')
            <link rel="stylesheet" href="/frontend/css/contacts.css">
            <link rel="stylesheet" href="/frontend/css/user.css">
@endsection
