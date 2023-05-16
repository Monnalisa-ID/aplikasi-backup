@extends('layouts.app')
@section('title', __('2FA'))
@section('content')
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mb-3">{{ __('Two Factor Authentication') }}</h4>
            </div>
            <div class="text-start">
                {!! Form::open([
                    'route' => ['2fa'],
                    'method' => 'POST',
                    'data-validate',
                    'class' => 'form-horizontal',
                ]) !!}
                <div class="form-group mb-3">
                    {{ Form::label('one_time_password', __('One time Password'), ['class' => 'form-label mb-2']) }}
                    {{ Form::text('one_time_password', old('one_time_password'), ['class' => 'form-control', 'onfocus','required' ,'id' => 'one_time_password']) }}
                    @if ($errors->has('email'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('one_time_password'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('one_time_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="text-center">
                    {!! Form::submit(__('Verify'), ['class' => 'form-control btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
