@php
    use App\Facades\UtilityFacades;
    $lang = \App\Facades\UtilityFacades::getValByName('default_language');
    $primary_color = \App\Facades\UtilityFacades::getsettings('color');
    if (isset($primary_color)) {
        $color = $primary_color;
    } else {
        $color = 'theme-4';
    }
    $roles = App\Models\Role::whereNotIn('name', ['Super Admin', 'Admin'])
        ->pluck('name', 'name')
        ->all();
@endphp
@extends('layouts.main')
@section('title', __('Settings'))
@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h4 class="m-b-10">{{ __('Settings') }}</h4>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">{!! Html::link(route('home'), __('Dashboard'), []) !!}</li>
            <li class="breadcrumb-item active"> {{ __('Settings') }}</li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1"
                                class="list-group-item list-group-item-action border-0">{{ __('App Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action border-0">{{ __('General Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action border-0">{{ __('Storage Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-4"
                                class="list-group-item list-group-item-action border-0">{{ __('Pusher Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-5"
                                class="list-group-item list-group-item-action border-0">{{ __('Social Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-6"
                                class="list-group-item list-group-item-action border-0">{{ __('Email Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-7"
                                class="list-group-item list-group-item-action border-0">{{ __('Captcha Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-8"
                                class="list-group-item list-group-item-action border-0">{{ __('Payment Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-9"
                                class="list-group-item list-group-item-action border-0">{{ __('Sms Setting') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">

                    <div id="useradd-1" class="pt-0 card">
                        {!! Form::open([
                            'route' => ['settings/app-name/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card-header">
                            <h5> {{ __('App Setting') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row pt-0">

                                <div class="col-lg-4 col-sm-6 col-md-6 d-flex">
                                    <div class="card w-100">
                                        <div class="card-header">
                                            <h5>{{ __('App Light Logo') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="inner-content">
                                                <div class="logo-content mt-4 text-center py-2">
                                                    <a href="{{ Utility::getsettings('app_logo') ? Storage::url('uploads/appLogo/app-logo.png') : Storage::url('uploads/appLogo/78x78.png') }}"
                                                        target="_blank">
                                                        <img src="{{ Utility::getsettings('app_logo') ? Storage::url('uploads/appLogo/app-logo.png') : Storage::url('uploads/appLogo/78x78.png') }}"
                                                            class="img_setting" width="170px">
                                                    </a>
                                                </div>
                                                <div class="text-center choose-files mt-5">
                                                    <label for="app_logo">
                                                        <div class="bg-primary company_logo_update"> <i
                                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        {{ Form::file('app_logo', ['class' => 'form-control file', 'id' => 'app_logo', 'data-filename' => 'app_logo']) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-md-6 d-flex">
                                    <div class="card w-100">
                                        <div class="card-header">
                                            <h5>{{ __('App Dark Logo') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="inner-content">
                                                <div class="logo-content mt-4 text-center py-2">
                                                    <a href="{{ Utility::getsettings('app_dark_logo') ? Storage::url('uploads/appLogo/app-dark-logo.png') : '' }}"
                                                        target="_blank">
                                                        <img src="{{ Utility::getsettings('app_dark_logo') ? Storage::url('uploads/appLogo/app-dark-logo.png') : '' }}"
                                                            class="img_setting" width="170px">
                                                    </a>
                                                </div>
                                                <div class="text-center choose-files mt-5">
                                                    <label for="app_dark_logo">
                                                        <div class="bg-primary company_logo_update"> <i
                                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        {{ Form::file('app_dark_logo', ['class' => 'form-control file', 'id' => 'app_dark_logo', 'data-filename' => 'app_dark_logo']) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-md-6 d-flex">
                                    <div class="card w-100">
                                        <div class="card-header">
                                            <h5>{{ __('App Favicon Logo') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="inner-content">
                                                <div class="logo-content mt-4 text-center py-2">
                                                    <a href="{{ Utility::getsettings('favicon_logo') ? Storage::url('uploads/appLogo/app-favicon-logo.png') : '' }}"
                                                        target="_blank">
                                                        <img src="{{ Utility::getsettings('favicon_logo') ? Storage::url('uploads/appLogo/app-favicon-logo.png') : '' }}"
                                                            class=" img_setting" width="50px">
                                                    </a>
                                                </div>
                                                <div class="text-center choose-files mt-5">
                                                    <label for="favicon_logo">
                                                        <div class="bg-primary company_logo_update"> <i
                                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                        </div>
                                                        {{ Form::file('favicon_logo', ['class' => 'form-control file', 'id' => 'favicon_logo', 'data-filename' => 'favicon_logo']) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('app_name', __('Application Name'), ['class' => 'form-label']) }}
                                    {!! Form::text('app_name', Utility::getsettings('app_name'), [
                                        'class' => 'form-control',
                                        'placeholder' => __('Enter application name'),
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div id="useradd-2" class="">
                        {!! Form::open([
                            'route' => ['settings/auth-settings/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5>{{ __('General Settings') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('Two Factor Authentication') }}</strong>
                                                {{ !Utility::getsettings('2fa') ? __('Activate') : __('Deactivate') }}
                                                {{ __('Two Factor Authentication For Application') }}
                                            </div>
                                            <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                <label class="custom-switch mt-2 float-end">
                                                    {!! Form::checkbox('two_factor_auth', null, Utility::getsettings('2fa') ? true : false, [
                                                        'data-onstyle' => 'primary',
                                                        'class' => 'form-check-input input-primary',
                                                    ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('Email Verification') }}</strong>
                                                {{ Utility::getsettings('email_verification') == '1' ? __('Activate') : __('Deactivate') }}
                                                {{ __('Email Verification For Application') }}
                                            </div>
                                            <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                <label class="custom-switch mt-2 float-end">
                                                    {!! Form::checkbox(
                                                        'email_verification',
                                                        null,
                                                        Utility::getsettings('email_verification') == '1' ? true : false,
                                                        [
                                                            'data-onstyle' => 'primary',
                                                            'class' => 'form-check-input input-primary',
                                                        ],
                                                    ) !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('Sms Verification') }}</strong>
                                                {{ Utility::getsettings('sms_verification') == 0 ? __('Activate') : __('Deactivate') }}
                                                {{ __('Sms Verification For Application') }}
                                            </div>
                                            <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                <label class="custom-switch mt-2 float-end">
                                                    {!! Form::checkbox('sms_verification', null, Utility::getsettings('sms_verification') == '1' ? true : false, [
                                                        'data-onstyle' => 'primary',
                                                        'class' => 'form-check-input input-primary',
                                                    ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('RTL Setting') }}</strong>
                                                {{ Utility::getsettings('rtl') == '0' ? __('Deactivate') : __('Activate') }}
                                                {{ __('RTL Setting For Application') }}
                                            </div>
                                            <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                <label class="custom-switch mt-2 float-end">
                                                    {!! Form::checkbox('rtl_setting', null, Utility::getsettings('rtl') == '1' ? true : false, [
                                                        'data-onstyle' => 'primary',
                                                        'id' => 'site_rtl',
                                                        'class' => 'form-check-input input-primary',
                                                    ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group d-flex row ">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('Dark Layout') }}</strong>
                                                {{ !Utility::getsettings('dark_mode') == 'on' ? __('Activate') : __('Deactivate') }}
                                                {{ __('Dark mode for application') }}
                                            </div>
                                            <div class="col-md-4 form-check  form-switch custom-switch-v1">
                                                <label class="custom-switch form-check-label mt-2 custom-left float-end">
                                                    {!! Form::checkbox('dark_mode', null, Utility::getsettings('dark_mode') == 'on' ? true : false, [
                                                        'data-onstyle' => 'primary',
                                                        'id' => 'cust-darklayout',
                                                        'class' => 'form-check-input input-primary',
                                                    ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('Register') }}</strong>
                                                {{ Utility::getsettings('register') == '1' ? __('Activate') : __('Deactivate') }}
                                                {{ __('Register For Application') }}
                                            </div>
                                            <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                <label class="custom-switch mt-2 float-end">
                                                    {!! Form::checkbox('register', null, Utility::getsettings('register') == '1' ? true : false, [
                                                        'data-onstyle' => 'primary',
                                                        'class' => 'form-check-input input-primary',
                                                    ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group d-flex align-items-center row">
                                            <div class="col-md-8">
                                                <strong class="d-block">{{ __('Primary Color Setting') }}
                                                </strong>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="theme-color themes-color float-end">
                                                    <a href="#!"
                                                        class="{{ $color == 'theme-1' ? 'active_color' : '' }}"
                                                        data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                    {!! Form::radio('color', 'theme-1', null, ['class' => 'theme_color', 'style' => 'display: none;']) !!}
                                                    <a href="#!"
                                                        class="{{ $color == 'theme-2' ? 'active_color' : '' }}"
                                                        data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                    {!! Form::radio('color', 'theme-2', null, ['class' => 'theme_color', 'style' => 'display: none;']) !!}
                                                    <a href="#!"
                                                        class="{{ $color == 'theme-3' ? 'active_color' : '' }}"
                                                        data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                    {!! Form::radio('color', 'theme-3', null, ['class' => 'theme_color', 'style' => 'display: none;']) !!}
                                                    <a href="#!"
                                                        class="{{ $color == 'theme-4' ? 'active_color' : '' }}"
                                                        data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                    {!! Form::radio('color', 'theme-4', null, ['class' => 'theme_color', 'style' => 'display: none;']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!extension_loaded('imagick'))
                                        <small>
                                            {{ __('Note: for 2FA your server must have Imagick.') }}
                                            {!! Html::link('https://www.php.net/manual/en/book.imagick.php', __('Imagick Document'), ['target' => '_blank']) !!}
                                        </small>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::label('default_language', __('Default Language'), ['class' => 'form-label']) }}
                                        {!! Form::select('default_language', $languages, $lang, [
                                            'data-trigger',
                                            'id' => 'choices-single-default',
                                            'placeholder' => __('This is a search placeholder'),
                                            'class' => 'form-control form-control-inline-block',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('date_format', __('Date Format'), ['class' => 'form-label']) }}
                                        <select name="date_format" class="form-select" data-trigger>
                                            <option value="M j, Y"
                                                {{ Utility::getsettings('date_format') == 'M j, Y' ? 'selected' : '' }}>
                                                {{ __('Jan 1, 2020') }}</option>
                                            <option value="d-M-y"
                                                {{ Utility::getsettings('date_format') == 'd-M-y' ? 'selected' : '' }}>
                                                {{ __('01-Jan-20') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('time_format', __('Time Format'), ['class' => 'form-label']) }}
                                        <select name="time_format" class="form-select" data-trigger>
                                            <option value="g:i A"
                                                {{ Utility::getsettings('time_format') == 'g:i A' ? 'selected' : '' }}>
                                                {{ __('hh:mm AM/PM') }}</option>
                                            <option value="H:i:s"
                                                {{ Utility::getsettings('time_format') == 'H:i:s' ? 'selected' : '' }}>
                                                {{ __('HH:mm:ss') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Social Login Role') }}</label>
                                        {!! Form::select('roles', $roles, Utility::getsettings('roles'), ['class' => 'form-control', 'data-trigger']) !!}
                                        <div class="invalid-feedback">
                                            {{ __('Role is required') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('gtag', __('Gtag Tracking ID'), ['class' => 'form-label']) }}
                                        {!! Html::link(
                                            'https://support.google.com/analytics/answer/1008080?hl=en#zippy=%2Cin-this-article',
                                            __('Document'),
                                            ['target' => '_blank', 'class' => 'm-2'],
                                        ) !!}
                                        </label>
                                        {!! Form::text('gtag', Utility::getsettings('gtag'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter gtag tracking id'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div id="useradd-3" class="">
                        {!! Form::open([
                            'route' => ['settings/wasabi-setting/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'data-validate',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5> {{ __('Storage Settings') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::label('localsetting', __('Local'), ['class' => 'form-label']) }}
                                    <label class="form-switch   custom-switch-v1 col-3 mt-2 "
                                        style="margin-bottom: 12px !important;">
                                        {!! Form::radio('settingtype', 'local', Utility::getsettings('settingtype') == 'local' ? true : false, [
                                            'class' => 'form-check-input input-primary m-auto',
                                            'id' => 'localsetting',
                                        ]) !!}
                                    </label>
                                    {{ Form::label('s3setting', __('S3 setting'), ['class' => 'form-label']) }}
                                    <label class="form-switch   custom-switch-v1 col-3 mt-2 "
                                        style="margin-bottom: 12px !important;">
                                        {!! Form::radio('settingtype', 's3', Utility::getsettings('settingtype') == 's3' ? true : false, [
                                            'class' => 'form-check-input input-primary m-auto',
                                            'id' => 's3setting',
                                        ]) !!}
                                    </label>
                                </div>
                                <div id="s3"
                                    class="desc {{ Utility::getsettings('settingtype') == 's3' ? 'block' : 'd-none' }}">
                                    <div class="">
                                        <div class="row">
                                            <div class="form-group">
                                                {{ Form::label('s3_key', __('S3 Key'), ['class' => 'form-label']) }}
                                                {!! Form::text('s3_key', Utility::getsettings('s3_key'), [
                                                    'placeholder' => __('Enter s3 key'),
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('s3_secret', __('S3 Secret'), ['class' => 'form-label']) }}
                                                {!! Form::text('s3_secret', Utility::getsettings('s3_secret'), [
                                                    'placeholder' => __('Enter s3 secret'),
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('s3_region', __('S3 Region'), ['class' => 'form-label']) }}
                                                {!! Form::text('s3_region', Utility::getsettings('s3_region'), [
                                                    'placeholder' => __('Enter s3 region'),
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('s3_bucket', __('S3 Bucket'), ['class' => 'form-label']) }}
                                                {!! Form::text('s3_bucket', Utility::getsettings('s3_bucket'), [
                                                    'placeholder' => __('Enter s3 bucket'),
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('s3_url', __('S3 URL'), ['class' => 'form-label']) }}
                                                {!! Form::text('s3_url', Utility::getsettings('s3_url'), [
                                                    'placeholder' => __('Enter s3 URL'),
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('s3_endpoint', __('S3 Endpoint'), ['class' => 'form-label']) }}
                                                {!! Form::text('s3_endpoint', Utility::getsettings('s3_endpoint'), [
                                                    'placeholder' => __('Enter s3 endpoint'),
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div id="useradd-4" class="">
                        {!! Form::open([
                            'route' => ['settings/pusher-setting/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'data-validate',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5> {{ __('Pusher Setting') }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted"> {{ __('Pusher Setting') }}
                                    {!! Html::link('https://pusher.com/', __('Document'), ['target' => '_blank', 'class' => 'm-2']) !!}
                                </p>
                                <div class="">
                                    <div class="row">
                                        <div class="form-group">
                                            {{ Form::label('pusher_id', __('Pusher App ID'), ['class' => 'form-label']) }}
                                            {!! Form::text('pusher_id', Utility::getsettings('pusher_id'), [
                                                'placeholder' => __('Enter pusher app id'),
                                                'required',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('pusher_key', __('Pusher Key'), ['class' => 'form-label']) }}
                                            {!! Form::text('pusher_key', Utility::getsettings('pusher_key'), [
                                                'placeholder' => __('Enter pusher key'),
                                                'required',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('pusher_secret', __('Pusher Secret'), ['class' => 'form-label']) }}
                                            {!! Form::text('pusher_secret', Utility::getsettings('pusher_secret'), [
                                                'placeholder' => __('Enter pusher secret'),
                                                'required',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('pusher_cluster', __('Pusher Cluster'), ['class' => 'form-label']) }}
                                            {!! Form::text('pusher_cluster', Utility::getsettings('pusher_cluster'), [
                                                'placeholder' => __('Enter pusher cluster'),
                                                'required',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                {{ Form::label('pusher_status', __('Status'), ['class' => 'form-label']) }}
                                            </div>
                                            <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                <label class="custom-switch mt-2 float-end">
                                                    {!! Form::checkbox('pusher_status', null, Utility::getsettings('pusher_status') ? true : false, [
                                                        'class' => 'form-check-input form-check-input input-primary',
                                                        'id' => 'pusher_status',
                                                    ]) !!}
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div id="useradd-5" class="faq">
                        {!! Form::open([
                            'route' => ['settings/social-setting/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5> {{ __('Social Settings') }}</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="accordion accordion-flush" id="accordionExamples">
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="google">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseone"
                                                        aria-expanded="true" aria-controls="collapseone">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-brand-google text-primary"></i>
                                                            {{ __('Google') }}
                                                        </span>
                                                        @if (Utility::getsettings('googlesetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapseone" class="accordion-collapse collapse"
                                                    aria-labelledby="google" data-bs-parent="#accordionExamples"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <small
                                                                class="">{{ __('How To Enable Login With Google') }}{!! Html::link(Storage::url('pdf/login with google.pdf'), __('Document'), [
                                                                    'target' => '_blank',
                                                                    'class' => 'm-2',
                                                                ]) !!}</small>
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox('socialsetting[]', 'google', Utility::getsettings('googlesetting') == 'on' ? true : false, [
                                                                    'class' => 'form-check-input',
                                                                    'id' => 'googlesetting',
                                                                ]) !!}
                                                                {{ Form::label('googlesetting', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="form-group">
                                                                {{ Form::label('google_client_id', __('Google Client Id'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'google_client_id',
                                                                    Utility::getsettings('google_client_id') ? Utility::getsettings('google_client_id') : '',
                                                                    [
                                                                        'placeholder' => __('Enter google client id'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('google_client_secret', __('Google Client Secret'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'google_client_secret',
                                                                    Utility::getsettings('google_client_secret') ? Utility::getsettings('google_client_secret') : '',
                                                                    [
                                                                        'placeholder' => __('Enter google client secret'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('google_redirect', __('Google Redirect Url'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'google_redirect',
                                                                    Utility::getsettings('google_redirect') ? Utility::getsettings('google_redirect') : '',
                                                                    [
                                                                        'placeholder' => __('https://demo.test.com/callback/google'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="facebook">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsetwo"
                                                        aria-expanded="true" aria-controls="collapsetwo">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-brand-facebook text-primary"></i>
                                                            {{ __('Facebook') }}
                                                        </span>
                                                        @if (Utility::getsettings('facebooksetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapsetwo" class="accordion-collapse collapse"
                                                    aria-labelledby="facebook" data-bs-parent="#accordionExamples"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <small
                                                                class="">{{ __('How To Enable Login With Facebook') }}
                                                                {!! Html::link(Storage::url('pdf/login with facebook.pdf'), __('Document'), [
                                                                    'target' => '_blank',
                                                                    'class' => 'm-2',
                                                                ]) !!}</small>
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'socialsetting[]',
                                                                    'facebook',
                                                                    Utility::getsettings('facebooksetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'facebooksetting',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('facebooksetting', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="form-group">
                                                                {{ Form::label('facebook_client_id', __('Facebook Client Id'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'facebook_client_id',
                                                                    Utility::getsettings('facebook_client_id') ? Utility::getsettings('facebook_client_id') : '',
                                                                    [
                                                                        'placeholder' => __('Enter facebook client id'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('facebook_client_secret', __('Facebook Client Secret'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'facebook_client_secret',
                                                                    Utility::getsettings('facebook_client_secret') ? Utility::getsettings('facebook_client_secret') : '',
                                                                    [
                                                                        'placeholder' => __('Enter facebook client secret'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('facebook_redirect', __('Facebook Redirect Url'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'facebook_redirect',
                                                                    Utility::getsettings('FACEBOOK_REDIRECT') ? Utility::getsettings('FACEBOOK_REDIRECT') : '',
                                                                    [
                                                                        'placeholder' => __('https://demo.test.com/callback/facebook'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="github">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsethree"
                                                        aria-expanded="true" aria-controls="collapsethree">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-brand-github text-primary"></i>
                                                            {{ __('Github') }}
                                                        </span>
                                                        @if (Utility::getsettings('githubsetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapsethree" class="accordion-collapse collapse"
                                                    aria-labelledby="github" data-bs-parent="#accordionExamples"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <small
                                                                class="">{{ __('How To Enable Login With Github') }}
                                                                {!! Html::link(Storage::url('pdf/login with github.pdf'), __('Document'), [
                                                                    'target' => '_blank',
                                                                    'class' => 'm-2',
                                                                ]) !!}</small>
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox('socialsetting[]', 'github', Utility::getsettings('githubsetting') == 'on' ? true : false, [
                                                                    'class' => 'form-check-input',
                                                                    'id' => 'githubsetting',
                                                                ]) !!}
                                                                {{ Form::label('githubsetting', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="form-group">
                                                                {{ Form::label('github_client_id', __('Github Client Id'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'github_client_id',
                                                                    Utility::getsettings('github_client_id') ? Utility::getsettings('github_client_id') : '',
                                                                    [
                                                                        'placeholder' => __('Enter github client id'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('github_client_secret', __('Github Client Secret'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'github_client_secret',
                                                                    Utility::getsettings('github_client_secret') ? Utility::getsettings('github_client_secret') : '',
                                                                    [
                                                                        'placeholder' => __('Enter github client secret'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('github_redirect', __('Github Redirect Url'), ['class' => 'form-label']) }}
                                                                {!! Form::text(
                                                                    'github_redirect',
                                                                    Utility::getsettings('github_redirect') ? Utility::getsettings('github_redirect') : '',
                                                                    [
                                                                        'placeholder' => __('https://demo.test.com/callback/github'),
                                                                        'class' => 'form-control',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div id="useradd-6" class="">
                        {!! Form::open([
                            'route' => ['settings/email-setting/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5> {{ __('Email Settings') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        {{ Form::label('mail_mailer', __('Mail Mailer'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_mailer', env('MAIL_MAILER'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail mailer'),
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_host', __('Mail Host'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_host', env('MAIL_HOST'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail host'),
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_port', __('Mail Port'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_port', env('MAIL_PORT'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail port'),
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_username', __('Mail Username'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_username', env('MAIL_USERNAME'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail username'),
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_password', __('Mail Password'), ['class' => 'form-label']) }}
                                        <input class="form-control" value="{{ env('MAIL_PASSWORD') }}"
                                            placeholder="{{ __('Enter mail password') }}" name="mail_password"
                                            type="password" id="mail_password">
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_encryption', env('MAIL_ENCRYPTION'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail encryption'),
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail from address'),
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label']) }}
                                        {!! Form::text('mail_from_name', env('MAIL_FROM_NAME'), [
                                            'class' => 'form-control',
                                            'placeholder' => __('Enter mail from name'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    {!! Form::button(__('Send Test Mail'), [
                                        'class' => 'btn btn-info send_mail d-inline',
                                        'data-action' => route('test.mail'),
                                        'id' => 'test-mail',
                                    ]) !!}
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div id="useradd-7" class="">
                        {!! Form::open([
                            'route' => ['settings/captcha-setting/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5> {{ __('Capcha Settings') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row" id="captcha_setting">
                                    <div class="form-group">
                                        {!! Form::label('recahptchasetting', __('Recaptcha setting'), ['class' => 'form-label']) !!}
                                        <label class="form-switch   custom-switch-v1 col-3 mt-2"
                                            style="margin-bottom: 12px !important;">
                                            {!! Form::radio('captcha', 'recaptcha', Utility::getsettings('captcha') == 'recaptcha' ? true : false, [
                                                'class' => 'form-check-input form-check-input input-primary m-auto',
                                                'id' => 'recahptchasetting',
                                            ]) !!}
                                        </label>
                                        {!! Form::label('hcaptchasetting', __('hcaptcha setting'), ['class' => 'form-label']) !!}
                                        <label class="form-switch   custom-switch-v1 col-3 mt-2"
                                            style="margin-bottom: 12px !important;">
                                            {!! Form::radio('captcha', 'hcaptcha', Utility::getsettings('captcha') == 'hcaptcha' ? true : false, [
                                                'class' => 'form-check-input form-check-input input-primary m-auto',
                                                'id' => 'hcaptchasetting',
                                            ]) !!}
                                        </label>
                                    </div>
                                    <div id="recaptcha"
                                        class="desc {{ Utility::getsettings('captcha') != 'hcaptcha' ? 'd-block' : 'd-none' }}">
                                        <p class="text-muted"> {{ __('Recaptcha Setting') }}
                                            {!! Html::link('https://www.google.com/recaptcha/admin', __('Document'), [
                                                'class' => 'm-2',
                                                'target' => '_blank',
                                            ]) !!}
                                        </p>
                                        <div class="row">
                                            <div class="form-group">
                                                {{ Form::label('recaptcha_key', __('Recaptcha Key'), ['class' => 'form-label']) }}
                                                {!! Form::text('recaptcha_key', Utility::getsettings('recaptcha_key'), [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('Enter recaptcha key'),
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('recaptcha_secret', __('Recaptcha Secret'), ['class' => 'form-label']) }}
                                                {!! Form::text('recaptcha_secret', Utility::getsettings('recaptcha_secret'), [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('Enter recaptcha secret'),
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div id="hcaptcha"
                                        class="desc {{ Utility::getsettings('captcha') == 'hcaptcha' ? 'd-block' : 'd-none' }}">
                                        <p class="text-muted"> {{ __('Hcaptcha Setting') }}
                                            {!! Html::link('https://docs.hcaptcha.com/switch', __('Document'), ['class' => 'm-2', 'target' => '_blank']) !!}
                                        </p>
                                        <div class="row">
                                            <div class="form-group">
                                                {{ Form::label('hcaptcha_key', __('Hcaptcha Key'), ['class' => 'form-label']) }}
                                                {!! Form::text('hcaptcha_key', Utility::getsettings('hcaptcha_key'), [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('Enter hcaptcha key'),
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('hcaptcha_secret', __('Hcaptcha Secret'), ['class' => 'form-label']) }}
                                                {!! Form::text('hcaptcha_secret', Utility::getsettings('hcaptcha_secret'), [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('Enter hcaptcha secret'),
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div id="useradd-8" class="faq">
                        {!! Form::open([
                            'route' => ['settings/stripe-setting/update'],
                            'method' => 'POST',
                            'id' => 'setting-form',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h5> {{ __('Payment Settings') }}</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="accordion accordion-flush" id="accordionExample">
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="stripe">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse1"
                                                        aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Stripe') }}
                                                        </span>
                                                        @if (UtilityFacades::getsettings('stripesetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapse1" class="accordion-collapse collapse"
                                                    aria-labelledby="stripe" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'stripe',
                                                                    UtilityFacades::getsettings('stripesetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_stripe_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_stripe_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('stripe_key', __('Stripe Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('stripe_key', UtilityFacades::getsettings('stripe_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter stripe key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('stripe_secret', UtilityFacades::getsettings('stripe_secret'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter stripe secret'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="razorpay">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse2"
                                                        aria-expanded="true" aria-controls="collapse2">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Razorpay') }}
                                                        </span>
                                                        @if (UtilityFacades::getsettings('razorpaysetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapse2" class="accordion-collapse collapse"
                                                    aria-labelledby="razorpay" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'razorpay',
                                                                    UtilityFacades::getsettings('razorpaysetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_razorpay_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_razorpay_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('razorpay_key', __('Razorpay Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('razorpay_key', UtilityFacades::getsettings('razorpay_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter razorpay key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('razorpay_secret', __('Razorpay Secret'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('razorpay_secret', UtilityFacades::getsettings('razorpay_secret'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter razorpay secret'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="paypal">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsepaypal"
                                                        aria-expanded="true" aria-controls="collapsepaypal">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Paypal') }}
                                                        </span>
                                                        @if (UtilityFacades::getsettings('paypalsetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapsepaypal" class="accordion-collapse collapse"
                                                    aria-labelledby="paypal" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'paypal',
                                                                    UtilityFacades::getsettings('paypalsetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_paypal_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_paypal_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 pb-4">
                                                            {{ Form::label('paypal_mode', __('Paytm Environment'), ['class' => 'paypal-label col-form-label']) }}
                                                            <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                {!! Form::radio(
                                                                                    'paypal_mode',
                                                                                    'sandbox',
                                                                                    UtilityFacades::getsettings('paypal_mode') == 'sandbox' ? true : false,
                                                                                    ['class' => 'form-check-input'],
                                                                                ) !!}{{ __('Sandbox') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                {!! Form::radio('paypal_mode', 'live', UtilityFacades::getsettings('paypal_mode') == 'live' ? true : false, [
                                                                                    'class' => 'form-check-input',
                                                                                ]) !!}{{ __('Live') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('client_id', __('Paypal Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('client_id', UtilityFacades::getsettings('paypal_sandbox_client_id'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter paypal key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('client_secret', __('Paypal Secret'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('client_secret', UtilityFacades::getsettings('paypal_sandbox_client_secret'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter paypal secret'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="paytm">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsepaytm"
                                                        aria-expanded="true" aria-controls="collapsepaytm">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Paytm') }}
                                                        </span>
                                                        @if (Utility::getsettings('paytmsetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapsepaytm" class="accordion-collapse collapse"
                                                    aria-labelledby="paytm" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'paytm',
                                                                    UtilityFacades::getsettings('paytmsetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_paytm_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_paytm_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-12 pb-4">
                                                                {{ Form::label('paypal_mode', __('Paytm Environment'), ['class' => 'paypal-label col-form-label']) }}
                                                                <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    {!! Form::radio(
                                                                                        'paytm_environment',
                                                                                        'local',
                                                                                        UtilityFacades::getsettings('paytm_environment') == 'local' ? true : false,
                                                                                        ['class' => 'form-check-input'],
                                                                                    ) !!}{{ __('Local') }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    {!! Form::radio(
                                                                                        'paytm_environment',
                                                                                        'production',
                                                                                        UtilityFacades::getsettings('paytm_environment') == 'production' ? true : false,
                                                                                        ['class' => 'form-check-input'],
                                                                                    ) !!}{{ __('Production') }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('merchant_id', __('Paytm Merchant Id'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('merchant_id', UtilityFacades::getsettings('paytm_merchant_id'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter paytm merchant id'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('merchant_key', __('Paytm Merchant Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('merchant_key', UtilityFacades::getsettings('paytm_merchant_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter paytm merchant key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="flutterwave">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseflutterwave"
                                                        aria-expanded="true" aria-controls="collapseflutterwave">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Flutterwave') }}
                                                        </span>
                                                        @if (UtilityFacades::getsettings('flutterwavesetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapseflutterwave" class="accordion-collapse collapse"
                                                    aria-labelledby="flutterwave" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'flutterwave',
                                                                    UtilityFacades::getsettings('flutterwavesetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_flutterwave_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_flutterwave_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('flw_public_key', __('Flutterwave Public Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('flw_public_key', UtilityFacades::getsettings('flw_public_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter flutterwave public key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('flw_secret_key', __('Flutterwave Secret Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('flw_secret_key', UtilityFacades::getsettings('flw_secret_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter flutterwave secret key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="paystack">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsepaystack"
                                                        aria-expanded="true" aria-controls="collapsepaystack">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Paystack') }}
                                                        </span>
                                                        @if (UtilityFacades::getsettings('paystacksetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapsepaystack" class="accordion-collapse collapse"
                                                    aria-labelledby="paystack" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'paystack',
                                                                    UtilityFacades::getsettings('paystacksetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_paystack_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_paystack_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('paystack_public_key', __('Paystack Public Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('paystack_public_key', UtilityFacades::getsettings('paystack_public_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter paystack public key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{ Form::label('paystack_secret_key', __('Paystack Secret Key'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('paystack_secret_key', UtilityFacades::getsettings('paystack_secret_key'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter paystack secret key'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-11">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse10"
                                                        aria-expanded="true" aria-controls="collapse10">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('CoinGate') }}
                                                        </span>
                                                        @if (UtilityFacades::getsettings('coingatesetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapse10" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-11" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'coingate',
                                                                    UtilityFacades::getsettings('coingatesetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_coingate_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_coingate_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 pb-4">
                                                            {{ Form::label('coingate_mode', __('CoinGate Mode'), ['class' => 'col-form-label']) }}
                                                            <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                {!! Form::radio(
                                                                                    'coingate_mode',
                                                                                    'sandbox',
                                                                                    UtilityFacades::getsettings('coingate_environment') == 'sandbox' ? true : false,
                                                                                    ['class' => 'form-check-input'],
                                                                                ) !!}{{ __('Sandbox') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                {!! Form::radio(
                                                                                    'coingate_mode',
                                                                                    'live',
                                                                                    UtilityFacades::getsettings('coingate_environment') == 'live' ? true : false,
                                                                                    ['class' => 'form-check-input'],
                                                                                ) !!}{{ __('Live') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            {{ Form::label('coingate_auth_token', __('CoinGate Auth Token'), ['class' => 'form-label']) }}
                                                            {!! Form::text('coingate_auth_token', UtilityFacades::getsettings('coingate_auth_token'), [
                                                                'class' => 'form-control',
                                                                'placeholder' => __('Enter coingate auth token'),
                                                                'id' => 'coingate_auth_token',
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="mercado">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsemercado"
                                                        aria-expanded="true" aria-controls="collapsemercado">
                                                        <span class="d-flex align-items-center flex-1">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            {{ __('Mercado') }}
                                                        </span>
                                                        @if (Utility::getsettings('mercadosetting') == 'on')
                                                            <a
                                                                class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                        @endif
                                                    </button>
                                                </h2>
                                                <div id="collapsemercado" class="accordion-collapse collapse"
                                                    aria-labelledby="mercado" data-bs-parent="#accordionExample"
                                                    style="">
                                                    <div class="accordion-body">
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                {!! Form::checkbox(
                                                                    'paymentsetting[]',
                                                                    'mercado',
                                                                    Utility::getsettings('mercadosetting') == 'on' ? true : false,
                                                                    [
                                                                        'class' => 'form-check-input',
                                                                        'id' => 'is_mercado_enable',
                                                                    ],
                                                                ) !!}
                                                                {{ Form::label('is_mercado_enable', __('Enable'), ['class' => 'custom-control-label form-control-label']) }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 pb-4">
                                                            {{ Form::label('mercado_mode', __('Mercado Environment'), ['class' => 'mercado-label col-form-label']) }}
                                                            <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                {!! Form::radio(
                                                                                    'mercado_mode',
                                                                                    'sandbox',
                                                                                    UtilityFacades::getsettings('mercado_mode') == 'sandbox' ? true : false,
                                                                                    ['class' => 'form-check-input'],
                                                                                ) !!}{{ __('Sandbox') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                {!! Form::radio('mercado_mode', 'live', UtilityFacades::getsettings('mercado_mode') == 'live' ? true : false, [
                                                                                    'class' => 'form-check-input',
                                                                                ]) !!}{{ __('Live') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="form-group">
                                                                {{ Form::label('mercado_access_token', __('Mercado Access Token'), ['class' => 'form-label']) }}
                                                                {!! Form::text('mercado_access_token', UtilityFacades::getsettings('mercado_access_token'), [
                                                                    'class' => 'form-control',
                                                                    'placeholder' => __('Enter mercado access token'),
                                                                    'id' => 'mercado_access_token',
                                                                ]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (\Auth::user()->type == 'Super Admin')
                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="offline">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseoffline"
                                                            aria-expanded="true" aria-controls="collapseoffline">
                                                            <span class="d-flex align-items-center flex-1">
                                                                <i class="ti ti-credit-card text-primary"></i>
                                                                {{ __('Offline Setting') }}
                                                            </span>
                                                            @if (UtilityFacades::getsettings('offlinesetting') == 'on')
                                                                <a
                                                                    class="btn btn-sm btn-success float-end me-3 text-white">{{ __('Active') }}</a>
                                                            @endif
                                                        </button>
                                                    </h2>
                                                    <div id="collapseoffline" class="accordion-collapse collapse"
                                                        aria-labelledby="offline" data-bs-parent="#accordionExample"
                                                        style="">
                                                        <div class="accordion-body">
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    {!! Form::checkbox(
                                                                        'paymentsetting[]',
                                                                        'offline',
                                                                        UtilityFacades::getsettings('offlinesetting') == 'on' ? true : false,
                                                                        [
                                                                            'class' => 'form-check-input',
                                                                            'id' => 'is_offline_enable',
                                                                        ],
                                                                    ) !!}
                                                                    {{ Form::label('is_offline_enable', __('Enable Offline'), ['class' => 'custom-control-label form-control-label']) }}
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="form-group">
                                                                    {{ Form::label('payment_mode', __('Offline Mode Name'), ['class' => 'form-label']) }}
                                                                    {!! Form::text('payment_mode', UtilityFacades::getsettings('payment_mode'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter offline mode name'),
                                                                    ]) !!}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('payment_details', __('Payment Details'), ['class' => 'form-label']) }}
                                                                    {!! Form::textarea('payment_details', UtilityFacades::getsettings('payment_details'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => __('Enter payment details'),
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary', 'id' => 'save-btn']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div id="useradd-9" class="card">
                        {!! Form::open([
                            'route' => 'settings/sms-setting/update',
                            'method' => 'POST',
                            'enctype' => 'multipart/form-data',
                            'id' => 'setting-form',
                        ]) !!}
                        <div class="card-header">
                            <h5> {{ __('Sms Setting') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 py-2">
                                    <div class="">
                                        <label for="multi_sms" class="form-label"> {{ __('Sms Setting') }} </label>
                                    </div>
                                </div>
                                <div class="col-6 py-2 text-end">
                                    <div class="form-group">
                                        <div class="form-switch custom-switch-v1 d-inline-block">
                                            {!! Form::checkbox(
                                                'multisms_setting',
                                                null,
                                                UtilityFacades::getsettings('multisms_setting') == 'on' ? true : false,
                                                [
                                                    'class' => 'form-check-input input-primary',
                                                    'id' => 'multi_sms',
                                                ],
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 multi_sms {{ UtilityFacades::getsettings('multisms_setting') == 'on' ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        {{ Form::label('smssetting_twilio', __('Twilio'), ['class' => 'form-label']) }}
                                        <label class="form-switch custom-switch-v1 col-3 mt-2 ms-2">
                                            {!! Form::radio('smssetting', 'twilio', Utility::getsettings('smssetting') == 'twilio' ? true : false, [
                                                'class' => 'form-check-input input-primary',
                                                'id' => 'smssetting_twilio',
                                            ]) !!}
                                        </label>
                                        {{ Form::label('smssetting_nexmo', __('Nexmo'), ['class' => 'form-label']) }}
                                        <label class="form-switch custom-switch-v1 col-3 mt-2 ms-2">
                                            {!! Form::radio('smssetting', 'nexmo', Utility::getsettings('smssetting') == 'nexmo' ? true : false, [
                                                'class' => 'form-check-input input-primary',
                                                'id' => 'smssetting_nexmo',
                                            ]) !!}
                                        </label>
                                    </div>
                                    <div id="twilio"
                                        class="desc {{ Utility::getsettings('smssetting') == 'twilio' ? 'block' : 'd-none' }}">
                                        <div class="">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="name">{{ __('Twilio SID') }}</label>
                                                    <input type="text" name="twilio_sid" class="form-control"
                                                        value="{{ Utility::getsettings('twilio_sid') }}"
                                                        placeholder="{{ __('Enter twilio sid') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="name">{{ __('Twilio Auth Token') }}</label>
                                                    <input type="text" name="twilio_auth_token" class="form-control"
                                                        value="{{ Utility::getsettings('twilio_auth_token') }}"
                                                        placeholder="{{ __('Enter twilio auth token') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="name">{{ __('Twilio Verify SID') }}</label>
                                                    <input type="text" name="twilio_verify_sid" class="form-control"
                                                        value="{{ Utility::getsettings('twilio_verify_sid') }}"
                                                        placeholder="{{ __('Enter verify sid') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label"
                                                        for="name">{{ __('Twilio Number') }}</label>
                                                    <input type="text" name="twilio_number" class="form-control"
                                                        value="{{ Utility::getsettings('twilio_number') }}"
                                                        placeholder="{{ __('Enter number') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="nexmo"
                                        class="desc {{ Utility::getsettings('smssetting') == 'nexmo' ? 'block' : 'd-none' }}">
                                        <div class="">
                                            <div class="row">
                                                <div class="form-group">
                                                    {{ Form::label('nexmo_key', __('Nexmo Key'), ['class' => 'form-label']) }}
                                                    {!! Form::text('nexmo_key', Utility::getsettings('nexmo_key'), [
                                                        'placeholder' => __('Enter nexmo key'),
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('nexmo_secret', __('Nexmo Secret'), ['class' => 'form-label']) }}
                                                    {!! Form::text('nexmo_secret', Utility::getsettings('nexmo_secret'), [
                                                        'placeholder' => __('Enter nexmo secret'),
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('nexmo_url', __('Nexmo Url'), ['class' => 'form-label']) }}
                                                    {!! Form::text('nexmo_url', Utility::getsettings('nexmo_url'), [
                                                        'placeholder' => __('Enter nexmo url'),
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ Form::button(__('Save'), ['type' => 'submit', 'id' => 'save-btn', 'class' => 'btn btn-primary float-end mb-3']) }}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
@push('script')
    <script>
        feather.replace();
        var pctoggle = document.querySelector("#pct-toggler");
        if (pctoggle) {
            pctoggle.addEventListener("click", function() {
                if (
                    !document.querySelector(".pct-customizer").classList.contains("active")
                ) {
                    document.querySelector(".pct-customizer").classList.add("active");
                } else {
                    document.querySelector(".pct-customizer").classList.remove("active");
                }
            });
        }
        var themescolors = document.querySelectorAll(".themes-color > a");
        for (var h = 0; h < themescolors.length; h++) {
            var c = themescolors[h];
            c.addEventListener("click", function(event) {
                var targetElement = event.target;
                if (targetElement.tagName == "SPAN") {
                    targetElement = targetElement.parentNode;
                }
                var temp = targetElement.getAttribute("data-value");
                removeClassByPrefix(document.querySelector("body"), "theme-");
                document.querySelector("body").classList.add(temp);
            });
        }
        var custdarklayout = document.querySelector("#cust-darklayout");
        custdarklayout.addEventListener("click", function() {
            if (custdarklayout.checked) {
                document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute("src",
                    "../assets/images/logo.svg");
                document.querySelector("#main-style-link").setAttribute("href", "../assets/css/style-dark.css");
            } else {
                document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute("src",
                    "../assets/images/logo-dark.svg");
                document.querySelector("#main-style-link").setAttribute("href", "../assets/css/style.css");
            }
        });

        function check_theme(color_val) {
            $('.theme-color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
        $('body').on('click', '.send_mail', function() {
            var action = $(this).data('action');
            var modal = $('#common_modal');
            $.get(action, function(response) {
                modal.find('.modal-title').html('{{ __('Test Mail') }}');
                modal.find('.body').html(response);
                modal.modal('show');
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".socialsetting").trigger("select");
        });
        $(document).on('change', ".socialsetting", function() {
            var test = $(this).val();
            if ($(this).is(':checked')) {
                if (test == 'google') {
                    $("#google").fadeIn(500);
                    $("#google").removeClass('d-none');
                } else if (test == 'facebook') {
                    $("#facebook").fadeIn(500);
                    $("#facebook").removeClass('d-none');
                } else if (test == 'github') {
                    $("#github").fadeIn(500);
                    $("#github").removeClass('d-none');
                } else if (test == 'linkedin') {
                    $("#linkedin").fadeIn(500);
                    $("#linkedin").removeClass('d-none');
                }
            } else {
                if (test == 'google') {
                    $("#google").fadeOut(500);
                    $("#google").addClass('d-none');
                } else if (test == 'facebook') {
                    $("#facebook").fadeOut(500);
                    $("#facebook").addClass('d-none');
                } else if (test == 'github') {
                    $("#github").fadeOut(500);
                    $("#github").addClass('d-none');
                } else if (test == 'linkedin') {
                    $("#linkedin").fadeOut(500);
                    $("#linkedin").addClass('d-none');
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($("input[name$='captcha']").is(':checked')) {
                $("#recaptcha").fadeIn(500);
                $("#recaptcha").removeClass('d-none');
            } else {
                $("#recaptcha").fadeOut(500);
                $("#recaptcha").addClass('d-none');
            }
            $(".paymenttsetting").trigger("select");
        });
        $(document).on('change', ".paymenttsetting", function() {
            var test = $(this).val();
            if ($(this).is(':checked')) {
                if (test == 'razorpay') {
                    $("#razorpay").fadeIn(500);
                    $("#razorpay").removeClass('d-none');
                } else if (test == 'stripe') {
                    $("#stripe").fadeIn(500);
                    $("#stripe").removeClass('d-none');
                } else if (test == 'paytm') {
                    $("#paytm").fadeIn(500);
                    $("#paytm").removeClass('d-none');
                } else if (test == 'paypal') {
                    $("#paypal").fadeIn(500);
                    $("#paypal").removeClass('d-none');
                } else if (test == 'flutterwave') {
                    $("#flutterwave").fadeIn(500);
                    $("#flutterwave").removeClass('d-none');
                } else if (test == 'paystack') {
                    $("#paystack").fadeIn(500);
                    $("#paystack").removeClass('d-none');
                } else if (test == 'mercado') {
                    $("#mercado").fadeIn(500);
                    $("#mercado").removeClass('d-none');
                } else if (test == 'offline') {
                    $("#offline").fadeIn(500);
                    $("#offline").removeClass('d-none');
                }
            } else {
                if (test == 'razorpay') {
                    $("#razorpay").fadeOut(500);
                    $("#razorpay").addClass('d-none');
                } else if (test == 'paytm') {
                    $("#paytm").fadeOut(500);
                    $("#paytm").removeClass('d-none');
                } else if (test == 'stripe') {
                    $("#stripe").fadeOut(500);
                    $("#stripe").addClass('d-none');
                } else if (test == 'flutterwave') {
                    $("#flutterwave").fadeIn(500);
                    $("#flutterwave").removeClass('d-none');
                } else if (test == 'paypal') {
                    $("#paypal").fadeOut(500);
                    $("#paypal").addClass('d-none');
                } else if (test == 'paystack') {
                    $("#paystack").fadeOut(500);
                    $("#paystack").addClass('d-none');
                } else if (test == 'mercado') {
                    $("#mercado").fadeIn(500);
                    $("#mercado").removeClass('d-none');
                } else if (test == 'offline') {
                    $("#offline").fadeOut(500);
                    $("#offline").addClass('d-none');
                }
            }
        });
    </script>
    <script>
        $(document).on('click', "input[name$='captchasetting']", function() {
            if (this.checked) {
                $('#captcha_setting').fadeIn(500);
                $("#captcha_setting").removeClass('d-none');
                $("#captcha_setting").addClass('d-block');
            } else {
                $('#captcha_setting').fadeOut(500);
                $("#captcha_setting").removeClass('d-block');
                $("#captcha_setting").addClass('d-none');
            }
        });
        $(document).on('click', "input[name$='captcha']", function() {
            var test = $(this).val();
            if (test == 'hcaptcha') {
                $("#hcaptcha").fadeIn(500);
                $("#hcaptcha").removeClass('d-none');
                $("#recaptcha").addClass('d-none');
            } else {
                $("#recaptcha").fadeIn(500);
                $("#recaptcha").removeClass('d-none');
                $("#hcaptcha").addClass('d-none');
            }
        });
    </script>
    <script>
        $(document).on('click', "input[name$='settingtype']", function() {
            var test = $(this).val();
            if (test == 's3') {
                $("#s3").fadeIn(500);
                $("#s3").removeClass('d-none');
            } else {
                $("#s3").fadeOut(500);
            }
        });
        $(document).on('change', "#multi_sms", function() {
            if ($(this).is(':checked')) {
                $(".multi_sms").fadeIn(500);
                $('.multi_sms').removeClass('d-none');
                $('#twilio').removeClass('d-none');
            } else {
                $(".multi_sms").fadeOut(500);
                $(".multi_sms").addClass('d-none');
            }
        });
        $(document).on('click', "input[name$='smssetting']", function() {
            var test = $(this).val();
            $("#twilio").fadeOut(500);
            if (test == 'twilio') {
                $("#twilio").fadeIn(500);
                $("#twilio").removeClass('d-none');
                $("#nexmo").fadeOut(500);
            } else {
                $("#nexmo").fadeIn(500);
                $("#nexmo").removeClass('d-none');
                $("#twilio").fadeOut(500);
            }
        });
    </script>
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
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
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
@endpush
