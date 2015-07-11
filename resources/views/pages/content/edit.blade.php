@extends('layouts.form.wide')

@section('title')
    {{ $title }}
@stop

@section('form')
    
    {!! Form::model(isset($content) ? $content : null, array(
        'url' => $url,
        'method' => isset($method) ? $method : 'post'
    )) !!}

    @foreach ($fields as $key => $field)

        <div class="form-group">

        @if (in_array($field['type'], ['text', 'textarea', 'url', 'email']))

            {!! Form::$field['type']($key, null, [
                'class' => 'form-control input-md',
                'placeholder' => $field['title'],
                'rows' => isset($field['rows']) ? $field['rows'] : null,
            ]) !!}
    
        @elseif (in_array($field['type'], ['submit', 'button']))

            <div class="row">

                <div class="col-md-8">
                </div>

                <div class="col-md-4">
                
                    {!! Form::submit($field['title'], [
                        'class' => 'btn btn-primary btn-md btn-block'
                    ]) !!}
                    
                </div>

            </div>

        @endif

        </div>

    @endforeach

    {!! Form::close() !!}

@stop