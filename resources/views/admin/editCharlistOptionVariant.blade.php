@extends('admin.layout')

@section('main')

    <h1><a href="/master/charlist_option_variants/show/{{ $post->charlist_id }}" class="glyphicon glyphicon-circle-arrow-left"></a>{{ $title }}</h1><br>

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
    @endif

    @include('errors.formErrors')

    {!! Form::model( $post, array( 'class' => 'form-horizontal', 'role' => 'form', 'files' => true) ) !!}

    @foreach(config('translatable.locales') as $locale)
        <div class="form-group">
            {!! Form::label('name', "Название-{$locale}", array('class'=>'col-sm-2 control-label') ) !!}
            <div class="col-sm-10">
                {{--                                {!! Form::text("{$locale}[name]",   $post->translate($locale)->name, array('class'=>'form-control') ) !!}--}}
                <input type="text" class="form-control" id=""
                       name="{{$locale}}[name]"
                       value="{{ $post->translate($locale)->name ?? '' }}">
            </div>
        </div>
    @endforeach

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>


    {!! Form::close() !!}
@stop