@extends('layouts.main')

@section('title')

	{{ trans('error.404.title') }}

@stop

@section('header')

    @include('component.header',[
        'modifiers' => 'm-alternative'
    ])

@stop

@section('content')
    @include('component.masthead', [
        'modifiers' => 'm-alternative',
        'image' => \App\Image::getRandom()
    ])

    <div class="l-one-column">
        @include('component.card', [
            'text' => str_replace("\n", "<br>", trans('error.404.body')),
            'modifiers' => 'm-blue',
        ])
    </div>

@stop
