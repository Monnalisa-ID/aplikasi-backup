@php
    $hashids = new Hashids('', 20);
    $id = $hashids->encodeHex($poll->id);
@endphp
@extends('layouts.main')
@section('title', __('Result'))
@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h4 class="m-b-10">{{ __('Result') }}</h4>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">{!! Html::link(route('home'), __('Dashboard'), []) !!}</li>
            <li class="breadcrumb-item">{!! Html::link(route('poll.index'), __('Polls'), []) !!}</li>
            <li class="breadcrumb-item active"> {{ __('Result') }} </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-7 mx-auto order-xl-1">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Result') }}</h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12" id="chart_div">
                        <style>
                            .pie-chart {
                                width: 100%;
                                height: 400px;
                                margin: 0 auto;
                                float: right;
                            }

                            .text-center {
                                text-align: center;
                            }

                            @media (max-width: 991px) {
                                .pie-chart {
                                    width: 100%;
                                }
                            }
                        </style>
                        <script src="{{ asset('assets/js/loader.js') }}"></script>
                        <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
                        <div class="row">
                            <div class="col-lg-12  mb-3">
                                <div id="chartDiv" class="pie-chart"></div>
                            </div>
                            <div class="col-lg-12  mb-3">
                                <div id="chartDivs" class="pie-chart"></div>
                            </div>
                            <script type="text/javascript">
                                function drawChart() {
                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string', 'Pizza');
                                    data.addColumn('number', 'Populartiy');
                                    data.addRows([
                                        @foreach ($options['options'] as $label => $count)
                                            ['{{ $label }}', {{ $count }}],
                                        @endforeach
                                    ]);
                                    var options = {
                                        title: "{{ $poll['title'] }}",
                                        sliceVisibilityThreshold: .0,
                                    };
                                    var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
                                    chart.draw(data, options);

                                    var chart = new google.visualization.ColumnChart(document.getElementById('chartDivs'));
                                    chart.draw(data, options);
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('meeting.poll.fill', $poll->id) }}" class="btn btn-primary"><i class="me-2"
                            data-feather="skip-back"></i>{{ __('Back To Poll') }}</a>
                    <a class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="share"
                        href="javascript:void(0);" id="share-poll"
                        data-action="{{ route('poll.shares.meetings', $poll->id) }}"><i class="me-2"
                            data-feather="share-2"></i>{{ __('Share') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto order-xl-1">
            <div class="card">
                <div class="card-header">
                    <h5><i class="me-2" data-feather="users"></i>{{ __('Who voted what?') }}</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    @foreach ($chartData->meeting_answer_options as $key => $value)
                                        <th>{{ Utility::date_time_format($value->datetime) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="participant-vote">
                                    <th> {{ count($votes) }} {{ __('participant') }}</th>
                                    @foreach ($options['options'] as $key => $option)
                                        <th>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-check text-success">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg> {{ $option }}
                                        </th>
                                    @endforeach
                                </tr>
                                @if ($poll->meeting_hide_participants_from_each_other != 1)
                                    @foreach ($votes as $vote)
                                        <tr>
                                            <td>{{ $vote->name }}</td>
                                            @foreach ($options['options'] as $key => $option)
                                                @if (Utility::date_time_format($vote->vote) == $key)
                                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-check text-success">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg></td>
                                                @else
                                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x text-danger">
                                                            <line x1="18" y1="6" x2="6"
                                                                y2="18">
                                                            </line>
                                                            <line x1="6" y1="6" x2="18"
                                                                y2="18">
                                                            </line>
                                                        </svg></td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto order-xl-1">
            <div class="card">
                <div class="card-header">
                    <h5> <i class="me-2" data-feather="share-2"></i>{{ __('Share') }}</h5>
                </div>
                <div class="card-body ">
                    <div class="form-group col-6 m-auto">
                        <p>{{ __('Use this link to share the poll with your participants.') }}</p>
                        <div class="input-group">
                            <input type="text" value="{{ route('poll.survey.meeting', $id) }}"
                                class="form-control js-content" id="pc-clipboard-1" placeholder="Type some value to copy">
                            <a href="#" class="btn btn-primary js-copy" data-clipboard="true"
                                data-clipboard-target="#pc-clipboard-1"> {{ __('Copy') }}
                            </a>
                        </div>
                        <div class="mt-3 social-links-share">
                            <a href="https://api.whatsapp.com/send?text={{ route('poll.survey.meeting', $id) }}"
                                title="Whatsapp" class="social-links-share-main">
                                <i class="ti ti-brand-whatsapp"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ route('poll.survey.meeting', $id) }}"
                                title="Twitter" class="social-links-share-main">
                                <i class="ti ti-brand-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/share.php?u={{ route('poll.survey.meeting', $id) }}"
                                title="Facebook" class="social-links-share-main">
                                <i class="ti ti-brand-facebook"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('poll.survey.meeting', $id) }}"
                                title="Linkedin" class="social-links-share-main">
                                <i class="ti ti-brand-linkedin"></i>
                            </a>
                            <a href="javascript:void(1);" class="social-links-share-main" title="Show QR Code"
                                data-action="{{ route('poll.share.qr.meeting', $id) }}" id="share-qr">
                                <i class="ti ti-qrcode"></i>
                            </a>
                            <a href="javascript:void(0)" title="Embed" class="social-links-share-main"
                                onclick="copyToClipboard('#embed-form-{{ $poll->id }}')"
                                id="embed-form-{{ $poll->id }}"
                                data-url='<iframe src="{{ route('poll.survey.meeting', $id) }}" scrolling="auto" align="bottom" style="height:100vh;" width="100%"></iframe>'>
                                <i class="ti ti-code"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($poll->meeting_allow_comments == 1)
        <div class="row">
            <div class="col-xl-7 mx-auto order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <h5> <i class="me-2" data-feather="message-circle"></i>{{ __('Comments') }}</h5>
                    </div>
                    {!! Form::open([
                        'route' => 'comment.store',
                        'method' => 'Post',
                    ]) !!}
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('Enter your name')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::textarea('comment', null, [
                                'class' => 'form-control',
                                'rows' => '3',
                                'required',
                                'placeholder' => __('Add a comment'),
                            ]) !!}
                        </div>
                    </div>
                    <input type="hidden" id="poll_id" name="poll_id" value="{{ $poll->id }}">
                    <div class="card-footer">
                        <div class="text-end">
                            {!! Form::submit(__('Add a comment'), ['class' => 'btn btn-primary col-md-3']) !!}
                        </div>
                        {!! Form::close() !!}
                        @foreach ($poll->commmant as $value)
                            <div class="comments-item">
                                <div class="comment-user-icon">
                                    <img src="{{ asset('assets/images/comment.png') }}" alt="">
                                </div>
                                <span class="comment-info text-left">
                                    <h6>{{ $value->name }}</h6>
                                    <span class="d-block"><small>{{ $value->comment }}</small></span>
                                    <h6 class="d-block"><small>({{ $value->created_at->diffForHumans() }})</small>
                                        <a href="#reply-comment" class="text-dark reply-comment-{{ $value->id }}"
                                            id="comment-reply" data-bs-toggle="collapse" data-id="{{ $value->id }}"
                                            title="{{ __('Reply') }}">
                                            {{ __('Reply') }}</i></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['comment.destroy', $value->id],
                                            'id' => 'delete-form-' . $value->id,
                                            'class' => 'd-inline',
                                        ]) !!}
                                        <a href="#" class="text-dark show_confirm" title="Delete"
                                            id="delete-form-{{ $value->id }}">{{ __('Delete') }}</a>
                                        {!! Form::close() !!}
                                    </h6>
                                    <li class="list-inline-item"> </li>
                                    @foreach ($value->replyby as $reply_value)
                                        <div class="comment-replies">
                                            <div class="comment-user-icon">
                                                <img src="{{ asset('assets/images/comment.png') }}" alt="">
                                            </div>
                                            <div class="comment-replies-content">
                                                <h6>{{ $reply_value->name }}</h6>
                                                <span class="d-block"><small>{{ $reply_value->reply }}</small></span>
                                                <h6 class="d-block">
                                                    <small>({{ $reply_value->created_at->diffForHumans() }})</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </span>
                            </div>
                            {!! Form::open([
                                'route' => 'comment_reply.store',
                                'method' => 'Post',
                                'data-validate',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="row commant" id="reply-comment-{{ $value->id }}">
                                <div class="form-group">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('Enter your name')]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea('reply', null, [
                                        'class' => 'form-control',
                                        'rows' => '2',
                                        'required',
                                        'placeholder' => __('Add a comment'),
                                    ]) !!}
                                </div>
                                <input type="hidden" id="poll_id" name="poll_id" value="{{ $poll->id }}">
                                <input type="hidden" id="comment_id" name="comment_id" value="{{ $value->id }}">
                                <div class="card-footer">
                                    <div class="text-end">
                                        {!! Form::submit(__('Add a Reply'), ['class' => 'btn btn-primary col-md-3']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('script')
    <script>
        window.onload = function() {
            google.load("visualization", "1.1", {
                packages: ["corechart"],
                callback: 'drawAllChart'
            });
        };

        function drawAllChart() {
            drawChart();
        }
    </script>
    <script src="{{ asset('assets/js/plugins/clipboard.min.js') }}"></script>
    <script>
        new ClipboardJS('[data-clipboard=true]').on('success', function(e) {
            e.clearSelection();
        });
    </script>
    <script>
        $(function() {
            $('body').on('click', '#share-poll', function() {
                var action = $(this).data('action');
                var modal = $('#common_modal1');
                $.get(action, function(response) {
                    modal.find('.modal-title').html('{{ __('Share') }}');
                    modal.find('.modal-body').html(response.html);
                    feather.replace();
                    let area = document.createElement('textarea');
                    document.body.appendChild(area);
                    area.style.display = "none";
                    let content = document.querySelectorAll('.js-content');
                    let copy = document.querySelectorAll('.js-copy');
                    for (let i = 0; i < copy.length; i++) {
                        copy[i].addEventListener('click', function() {
                            area.style.display = "block";
                            area.value = content[i].innerText;
                            area.select();
                            document.execCommand('copy');
                            area.style.display = "none";
                            this.innerHTML = 'Copied ';
                            setTimeout(() => this.innerHTML = "Copy", 2000);
                        });
                    }
                    modal.modal('show');
                })
            });
        });
    </script>
    <script>
        $(function() {
            $('body').on('click', '#share-qr', function() {
                var action = $(this).data('action');
                var modal = $('#common_modal2');
                $.get(action, function(response) {
                    modal.find('.modal-title').html('{{ __('QR Code') }}');
                    modal.find('.modal-body').html(response.html);
                    feather.replace();
                    modal.modal('show');
                })
            });
        });
    </script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).data('url')).select();
            document.execCommand("copy");
            $temp.remove();
            notifier.show('Great!', '{{ __('Embed great success.') }}', 'success',
                '{{ asset('assets/images/notification/ok-48.png') }}', 4000);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.commant').hide();
            $(document).on('click', '#comment-reply', function() {
                var dataId = $(this).attr("data-id");
                $('#reply-comment-' + dataId).show();

            });
        });
    </script>
    <script>
        (function() {
            let area = document.createElement('textarea');
            document.body.appendChild(area);
            area.style.display = "none";
            let content = document.querySelectorAll('.js-content');
            let copy = document.querySelectorAll('.js-copy');
            for (let i = 0; i < copy.length; i++) {
                copy[i].addEventListener('click', function() {
                    area.style.display = "block";
                    area.value = content[i].innerText;
                    area.select();
                    document.execCommand('copy');
                    area.style.display = "none";
                    this.innerHTML = 'Copied ';
                    setTimeout(() => this.innerHTML = "Copy", 2000);
                });
            }
        })();
    </script>
@endpush
