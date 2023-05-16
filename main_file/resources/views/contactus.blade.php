@php
    config([
        'captcha.sitekey' => Utility::getsettings('recaptcha_key'),
        'captcha.secret' => Utility::getsettings('recaptcha_secret'),
    ]);
@endphp
<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ __('Contact us') }}
@endsection
@include('layouts.front_header')
<!-- [ Header ] start -->
<header id="home" class="bg-primary blog_detail">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-sm-12">
                <h1 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.2s">
                    {{ __('Contact Us') }}
                </h1>
            </div>
        </div>
    </div>
</header>
<!-- [ Header ] End -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <article class="article article-detail article-noshadow">
                    <div class="p-0">
                        <div>
                            {!! setting('contact_us') !!}
                        </div>

                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <article class="article article-detail article-noshadow">
                    <div class="p-0">
                        <iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?q={{ setting('latitude') }},{{ setting('longitude') }}&hl=en&z=14&amp;output=embed">
                        </iframe>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <section class="contactus" id="contactus">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="card text-center hover-translate-y-n10 hover-shadow-lg cards-1">
                        <div class="px-5 pb-5 pt-5">
                            <div class="py-4">
                                <div class="icon text-primary icon-sm mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-phone-call">
                                        <path
                                            d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="fw-1">{{ __('Skype') }}</div>
                            <div class="mt-4">
                                <a href="skype:live:{{ Utility::getsettings('skype_id') }}"
                                    class="link-underline-primary al-1">{{ Utility::getsettings('skype_name') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-center hover-translate-y-n10 hover-shadow-lg cards-1">
                        <div class="px-5 pb-5 pt-5">
                            <div class="py-4">
                                <div class="icon text-primary icon-sm mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                        <circle cx="12" cy="12" r="3">
                                        </circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="fw-1">{{ __('Technical support') }}</div>
                            <div class="mt-4">
                                <a href="mailto:{{ Utility::getsettings('technical_support_email') }}"
                                    class="link-underline-primary">{{ Utility::getsettings('technical_support_email') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-center hover-translate-y-n10 hover-shadow-lg cards-1">
                        <div class="px-5 pb-5 pt-5">
                            <div class="py-4">
                                <div class="icon text-primary icon-sm mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4">
                                        </circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="fw-1">{{ __('Custom projects') }}</div>
                            <div class="mt-4">
                                <a href="mailto:{{ Utility::getsettings('custom_projects_email') }}"
                                    class="link-underline-primary">{{ Utility::getsettings('custom_projects_email') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <article class="article article-detail article-noshadow">
                    <div class="p-0">
                        <section class="custom-section" id="sct-form-contact">
                            <div class="container position-relative zindex-100">
                                <div class="row justify-content-center mb-1">
                                    <div class="col-lg-6 text-center">
                                        <h3>{{ __('Contact us') }}</h3>
                                        <p class="lh-190">
                                            {{ __('If there is something we can help you with jut let us know. We will be more than happy to offer you our help') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card ">
                                            <div class="card-header">
                                                <h5> {{ __('Contact us') }}</h5>
                                            </div>
                                            {!! Form::open([
                                                'route' => 'contact.mail',
                                                'method' => 'Post',
                                                'class' => 'p-4',
                                                'enctype' => 'multipart/form-data',
                                            ]) !!}
                                            <div class="form-group">
                                                {!! Form::text('name', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('Your name'),
                                                    'required',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::email('email', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('email@example.com'),
                                                    'required',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::text('contact_no', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => __('+40-745-234-567'),
                                                    'required',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::textarea('message', null, [
                                                    'class' => 'form-control',
                                                    'data-toggle' => 'autosize',
                                                    'rows' => '3',
                                                    'placeholder' => __('Tell us a few words ...'),
                                                    'required',
                                                ]) !!}
                                            </div>
                                            @if (Utility::getsettings('contact_us_recaptcha_status') == '1')
                                            <div class="text-center">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                        @endif
                                            <hr />
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-block btn-lg btn-primary mt-3 float-end">{{ __('Send your message') }}</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@include('layouts.front_footer')
<script type="text/javascript" charset="UTF-8"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
</body>

</html>
