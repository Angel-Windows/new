@extends('admin.layout')

@section('main')

    <h1><a href="/master/pages/{{ $type }}" class="glyphicon glyphicon-circle-arrow-left"></a>{{ $title }}</h1><br>


    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif

    @include('errors.formErrors')

    {!! Form::model($post, ['class' => 'form-horizontal', 'role' => 'form', 'files' => true ] ) !!}

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#tab_a" data-toggle="tab">Запись</a></li>
        <li><a href="#tab_b" data-toggle="tab">Параметры страницы</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="tab_a">
            <div class="form-group">&nbsp;</div>

            <div class="form-group">
                {!! Form::label('type', 'Тип страницы', array('class'=>'col-sm-2 control-label') ) !!}
                <div class="col-sm-10">
                    {!! Form::select('type', array('main' => 'Основная страница', 'other' => 'Другая страница', 'bay' => 'Страницы покупателям', 'catalog' => 'Страницы "КАТАЛОГ"'  ), $type, array( 'class'=>'form-control')) !!}
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_ru">
                    @foreach(config('translatable.locales') as $locale)
                        <div class="form-group">
                            {!! Form::label('name', "Название-{$locale}", array('class'=>'col-sm-2 control-label') ) !!}
                            <div class="col-sm-10">
                                {{--                                {!! Form::text('name',  $post->name, array('class'=>'form-control') ) !!}--}}
                                <input type="text" class="form-control" id="inputMetaTitle"
                                       name="{{$locale}}[name]"
                                       value="{{ $post->translate($locale)->name ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                    @foreach(config('translatable.locales') as $locale)
                        <div class="form-group">
                            {!! Form::label('description', "Краткое описание-{$locale}", array('class'=>'col-sm-2 control-label') ) !!}
                            <div class="col-sm-10">
                                {{--                                {!! Form::textarea('description',  $post->description, array('class'=>'form-control editor') ) !!}--}}

                                <textarea class="form-control editor" id="{{$locale}}[description]"
                                          name="{{$locale}}[description]">{{ $post->translate($locale)->description ?? '' }}</textarea>

                            </div>
                        </div>
                    @endforeach
                    @foreach(config('translatable.locales') as $locale)
                        <div class="form-group">
                            {!! Form::label('body', "Полное описание-{$locale}", array('class'=>'col-sm-2 control-label') ) !!}
                            <div class="col-sm-10">
                                {{--                            {!! Form::textarea('body',  $post->body, array('class'=>'form-control editor') ) !!}--}}
                                <textarea class="form-control editor" id="{{$locale}}[body]"
                                          name="{{$locale}}[body]">{{ $post->translate($locale)->body ?? '' }}</textarea>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="tab-pane" id="tab_b">

            <div class="form-group">&nbsp;</div>

            @if( !in_array( $post->slug, ['404']) )
                <div class="form-group">
                    <label for="inputSlug" class="col-sm-2 control-label">Адрес</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">&nbsp;/&nbsp;</span>
                            <input type="text" class="form-control" id="inputSlug" name="slug" value="{{ $post->slug }}"
                                   @if(in_array($post->id, [40, 38, 1])) disabled @endif >
                        </div>
                    </div>
                </div>
            @endif

            <div class="tab-content">
                <div class="tab-pane active" id="stab_ua">
                    @foreach(config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="inputMetaTitle" class="col-sm-2 control-label">Заголовок-{{$locale}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputMetaTitle"
                                       name="{{$locale}}[meta_title]"
                                       value="{{ $post->translate($locale)->meta_title ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                    @foreach(config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="inputMetaKeys" class="col-sm-2 control-label">Ключевые слова-{{$locale}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputMetaKeys"
                                       name="{{$locale}}[meta_keywords]"
                                       value="{{ $post->translate($locale)->meta_keywords ?? ''}}">
                            </div>
                        </div>
                    @endforeach
                    @foreach(config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="textMetaDescr" class="col-sm-2 control-label">Описание-{{$locale}}</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="textMetaDescr"
                                      name="{{$locale}}[meta_description]">{{ $post->translate($locale)->meta_description ?? ''}}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div><!-- tab content -->




    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>


    {!! Form::close() !!}

    <script>
        meta_title_touched = false;
        url_touched = false;

        $('input[name="slug"]').change(function () {
            url_touched = true;
        });


        $('input[name="name"]').keyup(function () {
            @if(!in_array($post->id, [40, 38]))

            if (!url_touched)
                $('input[name="slug"]').val(generate_url());

            @endif
            if (!meta_title_touched)
                $('input[name="meta_title"]').val($('input[name="name"]').val());
        });

        $('input[name="meta_title"]').change(function () {
            meta_title_touched = true;
        });

        function generate_url() {
            url = $('input[name="name"]').val();
            url = url.replace(/[\s]+/gi, '-');
            url = translit(url);
            url = url.replace(/[^0-9a-z_\-]+/gi, '').toLowerCase();
            return url;
        }

        function translit(str) {
            var ru = ("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")
            var en = ("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")
            var res = '';
            for (var i = 0, l = str.length; i < l; i++) {
                var s = str.charAt(i), n = ru.indexOf(s);
                if (n >= 0) {
                    res += en[n];
                } else {
                    res += s;
                }
            }
            return res;
        }
    </script>


    @include('admin.tinymce_init')

@stop