@php
    $languages = \App\Facades\UtilityFacades::languages();
    config([
        'captcha.sitekey' => Utility::getsettings('recaptcha_key'),
        'captcha.secret' => Utility::getsettings('recaptcha_secret'),
    ]);
@endphp
@extends('layouts.app')
@section('title', __('Sign in'))
@section('auth-topbar')
    <li class="nav-item">
        <select class="btn btn-primary my-1 me-2"
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"
            id="language">
            @foreach ($languages as $language)
                <option class="" @if ($lang == $language) selected @endif
                    value="{{ route('login', $language) }}">{{ Str::upper($language) }}
                </option>
            @endforeach
        </select>
    </li>
@endsection
@section('content')
    <div class="card-body">
        <div class="">
            <h2 class="mb-3 f-w-600">{{ __('Sign in') }}</h2>
        </div>
        <div class="">
            {{ Form::open(['route' => ['login'], 'method' => 'POST', 'data-validate', 'class' => 'needs-validation']) }}
            <div class="form-group mb-3">
                {{ Form::label('email', __('Email'), ['class' => 'form-label mb-2']) }}
                {!! Form::email('email', old('email'), [
                    'class' => 'form-control',
                    'id' => 'email',
                    'placeholder' => __('Enter email address'),
                    'onfocus',
                    'required',
                ]) !!}
            </div>
            <div class="form-group mb-3">
                {{ Form::label('password', __('Enter Password'), ['class' => 'form-label']) }}
                {!! Html::link(route('password.request'), __('Forgot Password ?'), ['class' => 'text-small float-end']) !!}
                {!! Form::password('password', [
                    'class' => 'form-control',
                    'placeholder' => __('Enter password'),
                    'required',
                    'tabindex' => '2',
                    'id' => 'password',
                    'autocomplete' => 'current-password',
                ]) !!}
            </div>
            <div class="form-group mb-4">
                <div class="form-check form-switch">
                    {!! Form::checkbox('customswitch1', 'agree', null, [
                        'class' => 'form-check-input',
                        'id' => 'customswitch1',
                    ]) !!}
                    {{ Form::label('customswitch1', __('Remember me'), ['class' => 'form-check-label']) }}
                </div>
            </div>
            @if (Utility::getsettings('login_recaptcha_status') == '1')
                <div class="text-center">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>
            @endif
            <div class="d-grid">
                {!! Form::submit(__('Sign In'), ['class' => 'btn btn-primary btn-block mt-3']) !!}
            </div>
            {{ Form::close() }}
        </div>
        @if (Utility::getsettings('register') == 1)
            <div class="mt-4 text-muted text-center">
                {{ __('Do not have an account?') }}
                <a href="{{ route('register') }}">{{ __('Create One') }}</a>
            </div>
        @endif
        @if (Utility::getsettings('GOOGLESETTING') == 'on' ||
                Utility::getsettings('FACEBOOKSETTING') == 'on' ||
                Utility::getsettings('GITHUBSETTING') == 'on')
            <div class="row mb-4 mt-1">
                @if (Utility::getsettings('GOOGLESETTING') == 'on' ||
                        Utility::getsettings('FACEBOOKSETTING') == 'on' ||
                        Utility::getsettings('GITHUBSETTING') == 'on')
                    <p class="my-3 text-center">{{ __('or register with') }}</p>
                @endif
                @if (Utility::getsettings('GOOGLESETTING') == 'on')
                    <div class="col-4">
                        <div class="d-grid"><a href="{{ url('/redirect/google') }}" class="btn btn-light">
                                {!! form::image(asset('assets/images/auth/img-google.svg'), null, ['class' => 'img-fluid wid-25']) !!}
                            </a></div>
                    </div>
                @endif
                @if (Utility::getsettings('FACEBOOKSETTING') == 'on')
                    <div class="col-4">
                        <div class="d-grid"><a href="{{ url('/redirect/facebook') }}" class="btn btn-light">
                                {!! form::image(asset('assets/images/auth/img-facebook.svg'), null, ['class' => 'img-fluid wid-25']) !!}
                            </a>
                        </div>
                    </div>
                @endif
                @if (Utility::getsettings('GITHUBSETTING') == 'on')
                    <div class="col-4">
                        <div class="d-grid"><a href="{{ url('/redirect/github') }}" class="btn btn-light">
                                {!! form::image(asset('assets/images/auth/github.svg'), null, ['class' => 'img-fluid wid-25']) !!}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection
