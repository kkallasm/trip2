@extends('layouts.one_column')

@section('title')
    
    {{ trans("content.$type.index.title") }}

@stop

@section('header1.right')
    
    @include('component.button', [ 
        'route' => route('content.create', ['type' => $type]),
        'title' => trans("content.$type.create.title")
    ])

@stop

@section('header2.content')

    @include('component.filter')

@stop

@section('content.one')

    @foreach ($contents as $content)

        <div class="utils-padding-bottom">
                            
            <a href="{{ route('content.show', [$content->type, $content]) }}">
                    
                <img src="{{ $content->imagePreset('large') }}" />
                
            </a>

        </div>

        <div class="utils-padding-bottom">

            @include('component.row', [
                'profile' => [
                    'modifiers' => '',
                    'image' => $content->user->imagePreset(),
                    'route' => route('user.show', [$content->user])
                ],
                'title' => $content->title,
                'text' => view('component.content.text', ['content' => $content]),
                'actions' => view('component.actions', ['actions' => $content->getActions()]),
                'extra' => view('component.flags', ['flags' => $content->getFlags()]),
                'body' => $content->body_filtered,
            ])

        </div>
        
        @include('component.comment.index', [
            'comments' => $content->comments,
        ])

    @endforeach

    @include('component.pagination',
        ['collection' => $contents]
    )

@stop
