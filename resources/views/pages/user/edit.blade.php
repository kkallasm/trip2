@extends('layouts.one_column')

@section('title')
    {{ $title }}
@stop

@section('content.one')

    <div class="r-user-edit__content-wrap">

        <div class="r-user-edit__content">

            {!! Form::model(isset($user) ? $user : null, [
                'url' => $url,
                'method' => isset($method) ? $method : 'post',
                'files' => true
            ]) !!}

            <div class="c-columns m-2-cols m-space">

                <div class="c-columns__item">

                    <div class="c-form__group">

                        @include('component.title', [
                            'title' => trans('user.edit.account.title'),
                            'modifiers' => 'm-orange'
                        ])

                    </div>

                    <div class="c-form__group">

                        {!! Form::text('name', null, [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.name.title')
                        ]) !!}

                    </div>

                    <div class="c-form__group">

                        {!! Form::email('email', null, [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.email.title')
                        ]) !!}

                    </div>

                    <div class="c-form__group">

                        {!! Form::password('password', [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.password.title')
                        ]) !!}

                    </div>

                    <div class="c-form__group">

                        {!! Form::password('password_confirmation', [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.password_confirmation.title')
                        ]) !!}

                    </div>

                </div>

                <div class="c-columns__item">

                    <div class="c-form__group">

                        @include('component.title', [
                            'title' => trans('user.edit.contact.title'),
                            'modifiers' => 'm-orange'
                        ])

                    </div>

                    <div class="c-form__group">

                        {!! Form::url('contact_facebook', null, [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.contact_facebook.title')
                        ]) !!}
            
                    </div>

                    <div class="c-form__group">

                        {!! Form::url('contact_twitter', null, [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.contact_twitter.title')
                        ]) !!}

                    </div>

                    <div class="c-form__group">

                        {!! Form::url('contact_instagram', null, [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.contact_instagram.title')
                        ]) !!}

                    </div>

                    <div class="c-form__group">

                        {!! Form::url('contact_homepage', null, [
                            'class' => 'c-form__input',
                            'placeholder' => trans('user.edit.field.contact_homepage.title')
                        ]) !!}

                    </div>

                </div>

            </div>

            <div class="c-form__group">

                @include('component.title', [
                    'title' => trans('user.edit.general.title'),
                    'modifiers' => 'm-orange'
                ])

            </div>

            <div class="c-form__group">

                {!! Form::text('real_name', null, [
                    'class' => 'c-form__input',
                    'placeholder' => trans('user.edit.field.real.name.title')
                ]) !!}

            </div>

            <div class="c-form__group">

                <div class="c-form__label">
                    {{ trans('user.edit.choose.gender') }}
                </div>

                {!! Form::radio('gender', '1', null, [
                    'id' => 'gender1'
                ]) !!}

                {!! Form::label('gender1', trans('user.gender.1')) !!}

                {!! Form::radio('gender', '2', null, [
                    'id' => 'gender2'
                ]) !!}

                {!! Form::label('gender2', trans('user.gender.2')) !!}

            </div>

            <div class="c-form__group">

                <div class="c-form__label">
                    {{ trans('user.edit.field.birthyear.title') }}
                </div>

                @include('component.date.select', [
                    'from' => \Carbon\Carbon::parse('-100 years')->year,
                    'to' => \Carbon\Carbon::now()->year,
                    'selected' => $user->birthyear ? $user->birthyear : \Carbon\Carbon::parse('-30 years')->year,
                    'key' => 'birthyear'
                ])

            </div>

            <div class="c-form__group">

                {!! Form::textarea('description', null, [
                    'class' => 'c-form__input m-high',
                    'placeholder' => trans('user.edit.field.description.title')
                ]) !!}

            </div>

            <div class="c-form__group">

                @include('component.title', [
                    'title' => trans('user.edit.notify.title'),
                    'modifiers' => 'm-orange'
                ])

            </div>

            <div class="c-form__group">

                {!! Form::checkbox('notify_message') !!}

                {!! trans('user.edit.field.notify_message.title') !!}

            </div>

            <div class="c-form__group">

                {!! Form::checkbox('notify_follow') !!}

                {!! trans('user.edit.field.notify_follow.title') !!}

            </div>

            <div class="c-form__group">

                {!! Form::submit($submit, [
                    'class' => 'c-button m-large m-block'
                ]) !!}

            </div>

            {!! Form::close() !!}

        </div>

        <div class="r-user-edit__sidebar">

            <div class="r-user-edit__sidebar-block">

                <div class="r-user-edit__sidebar-block-inner">

                    <div class="c-form__group">

                        @include('component.user.image', [
                            'image' => $user->imagePreset('small_square') . '?' . str_random(4),
                            'modifiers' => 'm-full m-center',
                        ])

                    </div>

                    <div class="c-form__group">

                        @include('component.image.form', [
                            'form' => [
                                'url' => $url,
                                'method' => isset($method) ? $method : 'post',
                                'model' => isset($user) ? $user : null,
                                'files' => true
                            ],
                            'name' => 'image',
                            'maxFileSize' => 5,
                            'uploadMultiple' => false
                        ])

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop