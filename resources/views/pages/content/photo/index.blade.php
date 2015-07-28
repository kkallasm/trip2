@extends('layouts.main')

@section('title')
    {{ trans("content.$type.index.title") }}
@stop

@section('header.right')
    @include('components.button', [ 
        'route' => route('content.create', ['type' => $type]),
        'title' => trans("content.$type.create.title")
    ])
@stop

@section('content')

    <div class="utils-border-bottom">

        @include('components.filter')

    </div>

    <div class="row">
  
        @foreach ($contents as $index => $content)

            <div class="col-sm-4 utils-padding-bottom">

                <a href="{{ route('content.show', [$content->type, $content]) }}">
                    
                    @include('components.image', [
                        'image' => $content->imagePath(),
                        'options' => '-landscape'
                    ])
                
                </a>

            </div>
            
            @if (($index + 1) % 3 == 0) </div><div class="row"> @endif

        @endforeach

    </div>

    {!! $contents->render() !!}

@stop

