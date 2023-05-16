@php
    $languages = \App\Facades\UtilityFacades::languages();
    config([
        'captcha.sitekey' => Utility::getsettings('recaptcha_key'),
        'captcha.secret' => Utility::getsettings('recaptcha_secret'),
    ]);
    $roles = App\Models\Role::whereNotIn('name', ['Super Admin', 'Admin'])
        ->pluck('name', 'name')
        ->all();
@endphp
@extends('layouts.app')
@section('title', __('Sign Up'))
@section('auth-topbar')
    <li class="nav-item">
        <select class="btn btn-primary my-1 me-2 "
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);"
            id="language">
            @foreach ($languages as $language)
                <option class="" @if ($lang == $language) selected @endif
                    value="{{ route('register', $language) }}">{{ Str::upper($language) }}
                </option>
            @endforeach
        </select>
    </li>
@endsection
@section('content')
    <div class="card-body">
        <div class="">
            <h2 class="mb-3 f-w-600">{{ __('Sign Up') }}</h2>
        </div>
        <div class="">
            {{ Form::open(['route' => ['register'], 'method' => 'POST', 'data-validate']) }}
            <div class="form-group mb-3">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                {!! Form::text('name', old('name'), [
                    'class' => 'form-control',
                    'placeholder' => __('Enter name'),
                    'required',
                    'id' => 'name',
                    'autocomplete' => 'name',
                    'autofocus',
                ]) !!}
            </div>
            <div class="form-group mb-3">
                {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
                {!! Form::email('email', old('email'), [
                    'class' => 'form-control',
                    'placeholder' => __('Enter email'),
                    'required',
                    'id' => 'email',
                    'autocomplete' => 'email',
                    'autofocus',
                ]) !!}
            </div>
            <div class="form-group mb-3">
                {{ Form::label('password', __('Password'), ['class' => 'form-label']) }}
                {!! Form::password('password', [
                    'class' => 'form-control',
                    'placeholder' => __('Enter password'),
                    'required',
                    'id' => 'password',
                    'autocomplete' => 'new-password',
                    'autofocus',
                ]) !!}
            </div>
            <div class="form-group mb-3">
                {{ Form::label('password_confirmation', __('Confirm Password'), ['class' => 'form-label']) }}
                {!! Form::password('password_confirmation', [
                    'class' => 'form-control',
                    'placeholder' => __('Enter confirm password'),
                    'required',
                    'id' => 'password-confirm',
                    'autocomplete' => 'new-password',
                    'autofocus',
                ]) !!}
            </div>
            <div class="form-group mb-3">
                {{ Form::label('country_code', __('Country Code'), ['class' => 'd-block form-label']) }}
                <select id="country_code" name="country_code"class="form-control" data-trigger>
                    @foreach (\App\Core\Data::getCountriesList() as $key => $value)
                        <option data-kt-flag="{{ $value['flag'] }}" value="{{ $key }}">
                            +{{ $value['phone_code'] }} {{ $value['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                {{ Form::label('phone', __('Phone Number'), ['class' => 'form-label']) }}
                {!! Form::number('phone', null, [
                    'autofocus' => '',
                    'required' => true,
                    'autocomplete' => 'off',
                    'placeholder' => 'Enter phone Number',
                    'class' => 'form-control',
                ]) !!}
            </div>
            <div class="form-group mb-3">
                {{ Form::label('role', __('Role'), ['class' => 'form-label']) }}
                {!! Form::text('role', Utility::getsettings('roles'), [
                    'class' => 'form-control',
                ]) !!}
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    {!! Form::checkbox('terms', 'agree', null, ['class' => 'form-check-input', 'id' => 'customCheckLogin']) !!}
                    <label class="form-check-label" for="customCheckLogin">
                        <span class="text-muted">{{ __('I agree to the') }} <a
                                href="#">{{ __('Terms') }}</a></span>
                    </label>
                </div>
            </div>
            @if (Utility::getsettings('login_recaptcha_status') == '1')
                <div class="text-center">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>
            @endif
            <div class="d-grid">
                {!! Form::submit(__('Register'), ['class' => 'btn btn-primary btn-block mt-3']) !!}
            </div>
            {{ Form::close() }}
        </div>
        <div class="mt-4 text-muted text-center">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var genericExamples = document.querySelectorAll('[data-trigger]');
            for (i = 0; i < genericExamples.length; ++i) {
                var element = genericExamples[i];
                new Choices(element, {
                    placeholderValue: 'This is a placeholder set in the config',
                    searchPlaceholderValue: 'This is a search placeholder',
                });
            }
        });
    </script>
@endpush
