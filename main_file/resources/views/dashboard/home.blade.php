@extends('layouts.main')
@section('title', __('Dashboard'))
@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h4 class="m-b-10">{{ __('Dashboard') }}</h4>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 col-sm-12">
            <a href="users">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20 text-muted">{{ __('Total User') }}</h6>
                                <h3 class="">{{ isset($user) ? $user : 0 }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-users bg-primary text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
            <a href="forms">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20 text-muted">{{ __('Total Form') }}</h6>
                                {{--  <h3 class="">{{ isset($form) ? $form : 0 }}</h3>  --}}
                                <h3 class="">{{ isset($forms) ? $forms : 0 }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-file-text bg-success text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
            <a href="#">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20 text-muted">{{ __('Total Submited Form') }}</h6>
                                <h3 class="">{{ isset($submitted_form) ? $submitted_form : 0 }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-ad-2 bg-danger text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
            <a href="#">
                <div class="card comp-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-20 text-muted">{{ __('Total Poll') }}</h6>
                                <h3 class="">{{ isset($poll) ? $poll : 0 }}</h3>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-ad-2 bg-info text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <section id="draggable-cards">
            <div class="row" id="widget-drag-area">
                @if (isset($widgets))
                    @foreach ($widgets as $widget)
                        @if ($widget->size == '25.00')
                            <div class="col-md-6 col-xl-3 sortable" data-id="{{ $widget->id }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">
                                            {{ $widget->title }}
                                            <div class="float-end">
                                                <button type="button"class="btn btn-md" data-bs-original-title="Move"
                                                    data-bs-toggle="tooltip" data-title="Move">
                                                    <i class="fa fa-arrows-alt handle"></i>
                                                </button>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="widgetnew" id="{{ $widget->id }}">
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12" id="chart{{ $widget->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($widget->size == '33.00')
                            <div class="col-md-6 col-xl-4 sortable" data-id="{{ $widget->id }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">
                                            {{ $widget->title }}
                                            <div class="float-end">
                                                <button type="button"class="btn btn-md" data-bs-original-title="Move"
                                                    data-bs-toggle="tooltip" data-title="Move">
                                                    <i class="fa fa-arrows-alt handle"></i>
                                                </button>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="widgetnew" id="{{ $widget->id }}">
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12" id="chart{{ $widget->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($widget->size == '50.00')
                            <div class="col-md-6 col-xl-6 sortable" data-id="{{ $widget->id }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">
                                            {{ $widget->title }}
                                            <div class="float-end">
                                                <button type="button"class="btn btn-md" data-bs-original-title="Move"
                                                    data-bs-toggle="tooltip" data-title="Move">
                                                    <i class="fa fa-arrows-alt handle"></i>
                                                </button>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="widgetnew" id="{{ $widget->id }}">
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12" id="chart{{ $widget->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 col-xl-12 sortable" data-id="{{ $widget->id }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="mb-0">
                                            {{ $widget->title }}
                                            <div class="float-end">
                                                <button type="button"class="btn btn-md" data-bs-original-title="Move"
                                                    data-bs-toggle="tooltip" data-title="Move">
                                                    <i class="fa fa-arrows-alt handle"></i>
                                                </button>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="widgetnew" id="{{ $widget->id }}">
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12" id="chart{{ $widget->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/dragdrop/dragula.min.css') }}">
@endpush
@push('script')
    <script src="{{ asset('vendor/apex-chart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/dragdrop/dragula.min.js') }}"></script>
    <script>
        var widgetnew = $('.widgetnew').map((_, el) => el.id).get();
        widgetnew.forEach(function(val) {
            var cate_id = (val);
            $.ajax({
                url: '{{ route('widget.chartdata') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    widget: cate_id,
                },
                success: function(data) {
                    type = data.type;
                    if (type == "form") {
                        var k = [];
                        var v = [];
                        $.each(data, function(response, dt) {
                            $.each(dt.options, function(key, value) {
                                k += key + ",";
                                v += value + ',';
                            });
                        });
                        k = k.slice(0, -1);
                        v = v.slice(0, -1);
                        chart = data.chart_type;
                        if (chart == "bar") {
                            var options = {
                                title: {
                                    text: data.label,
                                    fontSize: 24
                                },
                                chart: {
                                    type: 'bar',
                                },
                                series: [{
                                    name: data.label,
                                    data: v.split(',').map(x => {
                                        return parseInt(x)
                                    })
                                }],
                                xaxis: {
                                    categories: k.split(',')
                                }
                            }
                        } else {
                            var options = {
                                series: v.split(',').map(x => {
                                    return parseInt(x)
                                }),
                                chart: {
                                    width: '100%',
                                    type: 'pie',
                                },
                                labels: k.split(','),
                                title: {
                                    text: data.label,
                                },
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };
                        }
                        var chart = new ApexCharts(document.querySelector("#chart" + data.id), options);
                        chart.render();
                    } else {
                        // Utility::date_time_format($value->datetime)
                        var k = [];
                        var v = [];
                        $.each(data.options, function(key, val) {
                            k += key + ",";
                            v += val + ',';
                        });
                        k = k.slice(0, -1);
                        v = v.slice(0, -1);
                        chart = data.chart_type;
                        if (chart == "bar") {
                            var options = {
                                title: {
                                    text: data.label,
                                    fontSize: 24
                                },
                                chart: {
                                    type: 'bar',
                                },
                                series: [{
                                    name: data.label,
                                    data: v.split(',').map(x => {
                                        return parseInt(x)
                                    })
                                }],
                                xaxis: {
                                    categories: k.split(',')
                                }
                            }
                        } else {
                            var options = {
                                series: v.split(',').map(x => {
                                    return parseInt(x)
                                }),
                                chart: {
                                    width: '100%',
                                    type: 'pie',
                                },
                                labels: k.split(','),
                                title: {
                                    text: data.label,
                                },
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };
                        }
                        var chart = new ApexCharts(document.querySelector("#chart" + data.id), options);
                        chart.render();
                    }
                }
            })
        });
    </script>
    <script>
        $(function() {
            dragula([document.getElementById('widget-drag-area')], {
                moves: function(el, container, handle) {
                    return handle.classList.contains('handle');
                }
            }).on('drop', function(el, t) {
                var position = [];
                $(t).find('.sortable').each(function(index, data) {
                    position[index] = $(data).data('id');
                });
                $.ajax({
                    url: "{{ route('updatedash.dashboard') }}",
                    data: {
                        position: position,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    success: function(data) {
                        notifier.show('Done!', 'Chart updated successfully.', 'success',
                            '{{ asset('assets/images/notification/ok-48.png') }}', 4000);
                    },
                    error: function(data) {
                        notifier.show('Failed!', 'Chart does not updated.', 'danger',
                            '{{ asset('assets/images/notification/high_priority-48.png') }}',
                            4000);
                    }
                })
            });
        });
    </script>
@endpush
