@extends('layouts.main')
@section('title', __('Form'))
@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h4 class="m-b-10">{{ __('View Form') }}</h4>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">{!! Html::link(route('home'), __('Dashboard'), []) !!}</li>
            <li class="breadcrumb-item">{!! Html::link(route('forms.index'), __('Forms'), []) !!}</li>
            <li class="breadcrumb-item active"> {{ __('View Form') }} </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        @if (!empty($form_value->Form->logo))
            <div class="text-center gallery gallery-md">
                {!! Form::image(
                    Storage::exists($form_value->Form->logo)
                        ? asset('storage/app/' . $form_value->Form->logo)
                        : Storage::url('uploads/appLogo/78x78.png'),
                    null,
                    [
                        'class' => 'gallery-item float-none',
                        'id' => 'app-dark-logo',
                    ],
                ) !!}
            </div>
        @endif
        {{--  {{ dd($form_value) }}  --}}
        <div class="card col-md-6 mx-auto p-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5> {{ $form_value->Form->title }}</h5>
                <a href="javascript:javascript:history.go(-1)" class="btn btn-secondary float-end">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <div class="view-form-data">
                    <div class="row">
                        @foreach ($array as $keys => $rows)
                            {{--  {{ dd($array) }}  --}}
                            @foreach ($rows as $row_key => $row)
                                {{--  {{ dd($rows) }}  --}}
                                @if ($row->type == 'checkbox-group')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                        <ul>
                                            @foreach ($row->values as $key => $options)
                                                @if (isset($options->selected))
                                                    <li>
                                                        <label>{{ $options->label }}</label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                @elseif($row->type == 'file')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            @if (isset($row->value))
                                                @if ($row->multiple)
                                                    <div class="row">
                                                        @foreach ($row->value as $img)
                                                            <div class="col-xl-6 col-12">
                                                                @if (pathinfo($img, PATHINFO_EXTENSION) == 'pdf' ||
                                                                        pathinfo($img, PATHINFO_EXTENSION) == 'csv' ||
                                                                        pathinfo($img, PATHINFO_EXTENSION) == 'xlsx')
                                                                    @php
                                                                        $filename = explode('/', $img);
                                                                        $filename = end($filename);
                                                                    @endphp
                                                                    <a class="btn btn-info my-2"
                                                                        href="{{ asset('storage/app/' . $img) }}"
                                                                        type="image"
                                                                        download="">{{ $filename }}</a>
                                                                @else
                                                                    {!! Form::image(
                                                                        Storage::exists($img) ? asset('storage/app/' . $img) : Storage::url('uploads/appLogo/78x78.png'),
                                                                        null,
                                                                        [
                                                                            'class' => 'img-responsive img-thumbnailss mb-2 card-img-top card-img-custom',
                                                                        ],
                                                                    ) !!}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-xl-6 col-12">
                                                            @if ($row->subtype == 'fineuploader')
                                                                @if ($row->value[0])
                                                                    @foreach ($row->value as $img)
                                                                        @php
                                                                            $filename = explode('/', $img);
                                                                            $filename = end($filename);
                                                                        @endphp
                                                                        @if (pathinfo($img, PATHINFO_EXTENSION) == 'pdf' ||
                                                                                pathinfo($img, PATHINFO_EXTENSION) == 'csv' ||
                                                                                pathinfo($img, PATHINFO_EXTENSION) == 'xlsx')
                                                                            <a class="btn btn-info my-2"
                                                                                href="{{ asset('storage/app/' . $img) }}"
                                                                                type="image"
                                                                                download="">{{ $filename }}</a>
                                                                        @else
                                                                            {!! Form::image(
                                                                                Storage::exists($img) ? asset('storage/app/' . $img) : Storage::url('uploads/appLogo/78x78.png'),
                                                                                null,
                                                                                [
                                                                                    'class' => 'img-responsive img-thumbnailss mb-2 card-img-top card-img-custom',
                                                                                ],
                                                                            ) !!}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @else
                                                                @if (pathinfo($row->value, PATHINFO_EXTENSION) == 'pdf' ||
                                                                        pathinfo($row->value, PATHINFO_EXTENSION) == 'csv' ||
                                                                        pathinfo($row->value, PATHINFO_EXTENSION) == 'xlsx')
                                                                    @php
                                                                        $filename = explode('/', $row->value);
                                                                        $filename = end($filename);
                                                                    @endphp
                                                                    <a class="btn btn-info my-2"
                                                                        href="{{ asset('storage/app/' . $row->value) }}"
                                                                        type="image"
                                                                        download="">{{ $filename }}</a>
                                                                @else
                                                                    {!! Form::image(
                                                                        Storage::exists($row->value) ? asset('storage/app/' . $row->value) : Storage::url('uploads/appLogo/78x78.png'),
                                                                        null,
                                                                        [
                                                                            'class' => 'img-responsive img-thumbnailss mb-2 card-img-top card-img-custom',
                                                                        ],
                                                                    ) !!}
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                @elseif($row->type == 'header')
                                    <div class="col-12">
                                        <{{ $row->subtype }}>
                                            {{ $row->label }}
                                            </{{ $row->subtype }}>
                                    </div>
                                @elseif($row->type == 'paragraph')
                                    <div class="col-12">
                                        <{{ $row->subtype }}>
                                            {{ $row->label }}
                                            </{{ $row->subtype }}>
                                    </div>
                                @elseif($row->type == 'radio-group')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            @foreach ($row->values as $key => $options)
                                                @if (isset($options->selected))
                                                    {{ $options->label }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                @elseif($row->type == 'select')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            @foreach ($row->values as $options)
                                                @if (isset($options->selected))
                                                    {{ $options->label }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                @elseif($row->type == 'autocomplete')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            @foreach ($row->values as $options)
                                                @if (isset($options->selected))
                                                    {{ $options->label }}
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                @elseif($row->type == 'number')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            {{ isset($row->value) ? $row->value : '' }}
                                        </p>
                                    </div>
                                @elseif($row->type == 'text')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b><br>
                                        @if ($row->subtype == 'color')
                                            <div
                                                style="padding: 10px; margin-top: 10px;background-color: {{ $row->value }};">
                                            </div>
                                        @else
                                            <p>
                                                {{ isset($row->value) ? $row->value : '' }}
                                            </p>
                                        @endif
                                    </div>
                                @elseif($row->type == 'date')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            {{ isset($row->value) ? date('d-m-Y', strtotime($row->value)) : '' }}
                                        </p>
                                    </div>
                                @elseif($row->type == 'textarea')
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        @if ($row->subtype == 'ckeditor')
                                            {!! isset($row->value) ? $row->value : '' !!}
                                        @else
                                            <p>
                                                {{ isset($row->value) ? $row->value : '' }}
                                            </p>
                                        @endif
                                    </div>
                                @elseif($row->type == 'starRating')
                                    <div class="col-12">
                                        @php
                                            $attr = ['class' => 'form-control'];
                                            if ($row->required) {
                                                $attr['required'] = 'required';
                                            }
                                            $value = isset($row->value) ? $row->value : 0;
                                            $no_of_star = isset($row->number_of_star) ? $row->number_of_star : 5;
                                        @endphp
                                        <b> {{ Form::label($row->name, $row->label) }}@if ($row->required)
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                        <div id="{{ $row->name }}" class="starRating" data-value="{{ $value }}"
                                            data-no_of_star="{{ $no_of_star }}">
                                        </div>
                                        {!! Form::hidden($row->name, $value, ['id' => $row->name]) !!}
                                        </p>
                                    </div>
                                @elseif($row->type == 'SignaturePad')
                                    <div class="col-12">
                                        <img src="{{ asset(Storage::url($row->value)) }}">
                                    </div>
                                @elseif($row->type == 'break')
                                    <div class="col-12">
                                        <hr style="border: 1px solid #ccc">
                                    </div>
                                @elseif($row->type == 'location')
                                    @php
                                        $lat = $row->value->lat;
                                        $lng = $row->value->lng;
                                    @endphp
                                    {{--  {{ dd($array ,$lat,$lng) }}  --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            {!! Form::label('location_id', 'Location:') !!}
                                            <iframe width="100%" height="260" frameborder="0" scrolling="no"
                                                marginheight="0" marginwidth="0"
                                                src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&hl=en&z=14&amp;output=embed">
                                            </iframe>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <b>{{ Form::label($row->name, isset($row->label)) }}@if (isset($row->required))
                                                <span class="text-danger align-items-center">*</span>
                                            @endif
                                        </b>
                                        <p>
                                            {{ isset($row->value) ? $row->value : '' }}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link href="{{ asset('vendor/jqueryform/css/jquery.rateyo.min.css') }}" rel="stylesheet" />
@endpush
@push('script')
    <script src="{{ asset('vendor/jqueryform/js/jquery.rateyo.min.js') }}"></script>
    <script>
        var $starRating = $('.starRating');
        if ($starRating.length) {
            $starRating.each(function() {
                var val = $(this).attr('data-value');
                var no_of_star = $(this).attr('data-no_of_star');
                if (no_of_star == 10) {
                    val = val / 2;
                }
                $(this).rateYo({
                    rating: val,
                    readOnly: true,
                    numStars: no_of_star
                })
            });
        }
    </script>
@endpush
