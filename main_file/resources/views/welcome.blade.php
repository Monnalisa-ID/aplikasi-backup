@php
    $currency = env('CURRENCY_SYMBOL');
    $user = App\Models\User::all();
    // @dd($user->name)

    // $roles = App\Models\Role::whereNotIn('name', ['Super Admin', 'Admin'])
    //     ->pluck('name', 'name')
    //     ->all();
@endphp
@section('title')
    {{ __('Home') }}
@endsection
<!DOCTYPE html>
<html lang="en">
@include('layouts.front_header')
<header id="home" class="bg-primary">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-sm-5">
                <h2 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                    {{ config('app.name') }}
                </h2>
                <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                    {{ Utility::getsettings('apps_paragraph')
                        ? Utility::getsettings('apps_paragraph')
                        : __('Prime Laravel Form Builder is software for creating automated systems,
                                                                                        you can create your own forms without writing a line of code.
                                                                                        you have only to use the Drag & Drop to build your form and start using it.') }}
                </p>
            </div>
            <div class="col-sm-5">
                <img src="{{ Utility::getsettings('image')
                    ? Storage::url(Utility::getsettings('image'))
                    : asset('vendor/front_image/image.svg') }}"
                    class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
            </div>
        </div>
    </div>
</header>
<section id="layouts" class="">
    <div class="container">
        <div class="row align-items-center justify-content-end mb-5">
            <div class="col-sm-4">
                <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                    {{ Utility::getsettings('menu_name') ? Utility::getsettings('menu_name') : __('Dashboard') }}
                </h1>
                <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                    {{ Utility::getsettings('menu_subtitle') ? Utility::getsettings('menu_subtitle') : __('All in one place') }}
                    <br />
                    {{ Utility::getsettings('menu_title') ? Utility::getsettings('menu_title') : __('CRM system') }}
                </h2>
                <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                    {{ Utility::getsettings('menu_title') ? Utility::getsettings('menu_title') : __('Use these awesome forms to login or create new account in your project for free.') }}
                </p>
            </div>
            <div class="col-sm-6">
                <img src="{{ Utility::getsettings('images1')
                    ? Storage::url(Utility::getsettings('images1'))
                    : asset('vendor/front_image/images1.png') }}"
                    class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
            </div>
        </div>
        <div class="row align-items-center justify-content-start">
            <div class="col-sm-6">
                <img src="{{ Utility::getsettings('images2')
                    ? Storage::url(Utility::getsettings('images2'))
                    : asset('vendor/front_image/images2.svg') }}"
                    class="img-fluid header-img wow animate__fadeInLeft" data-wow-delay="0.2s" />
            </div>
            <div class="col-sm-4">
                <h1 class="mb-sm-4 f-w-600 wow animate__fadeInRight" data-wow-delay="0.2s">
                    {{ Utility::getsettings('submenu_name') ? Utility::getsettings('submenu_name') : __('Dashboard') }}
                </h1>
                <h2 class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.4s">
                    {{ Utility::getsettings('submenu_subtitle') ? Utility::getsettings('submenu_subtitle') : __('All in one place') }}
                    <br />
                    {{ Utility::getsettings('submenu_title') ? Utility::getsettings('submenu_title') : __('CRM system') }}
                </h2>
                <p class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.6s">
                    {{ Utility::getsettings('submenu_paragraph')
                        ? Utility::getsettings('submenu_paragraph')
                        : __('Use these awesome forms to login or create new account in your project for free.') }}
                </p>
                <div class="my-4 wow animate__fadeInRight" data-wow-delay="0.8s">
                    <a href="#pricing" class="btn btn-primary"><i
                            class="fas fa-shopping-cart me-2"></i>{{ __('Buy now') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="features" class="feature">
    <div class="container">
        <div class="row justify-content-center wow animate__fadeInLeft" data-wow-delay="0.2s">
            <div class="col-xl-6 col-md-9 title">
                <h2>
                    <span class="d-block mb-3">
                        {{ Utility::getsettings('feature_name') ? Utility::getsettings('feature_name') : __('Features') }}
                    </span>
                    {{ config('app.name') }}
                </h2>
                <p class="m-0">
                    {{ config('app.name') }}
                    {{ Utility::getsettings('feature_paragraph')
                        ? Utility::getsettings('feature_paragraph')
                        : __('is software for creating automated systems, you can create your own forms without writing a line of code.
                                                                        you have only to use the Drag & Drop to build your form and start using it.') }}
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            @if ($features)
                @foreach ($features as $feature)
                    <div class="col-lg-3 col-md-6 ">
                        <div class="card wow animate__fadeInUp w-100 h-100" data-wow-delay="0.2s"
                            style="
                                visibility: visible;
                                animation-delay: 0.2s;
                                animation-name: fadeInUp;">
                            <div class="card-body">
                                <div class="theme-avtar {{ $feature->theme_color }}">
                                    <i class="{{ $feature->avtar_format }}"></i>
                                </div>
                                <h4 class="my-3 f-w-600">
                                    {{ $feature->feature_subname }}
                                </h4>
                                <p class="mb-0">
                                    {{ substr($feature->feature_subparagraph, 0, 150) . (strlen($feature->feature_subparagraph) > 150 ? '...' : '') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<section class="form" id="feature">
    <div class="container">
        <div class="section-title title text-center">
            <h2>
                {{ __('Forms') }}
            </h2>
            <p class="m-0">
                {{ __('Use these awesome forms to login or create public form in your project for free.') }}
            </p>
        </div>
        <div class="blog-slide">
            @foreach ($forms as $form)
                @php
                    $hashids = new Hashids('', 20);
                    $id = $hashids->encodeHex($form->id);
                @endphp
                <div class="blog-card">
                    <div class="blog-card-inner">
                        <a href="{{ route('forms.survey', $id) }}" class="img-wrapper">
                            <img
                                src="{{ Storage::exists($form->logo) ? asset('storage/app/' . $form->logo) : Storage::url('uploads/appLogo/78x78.png') }}">
                            <div class="blog-lbl date-lbl"> {{ $form->created_at->toFormattedDateString() }}
                            </div>
                        </a>
                        <div class="blog-content">
                            <div class="blog-top-content">
                                <h4>
                                    <a href="{{ route('forms.survey', $id) }}">
                                        {{ $form->title }}
                                    </a>
                                </h4>
                            </div>
                            <div class="blog-bottom-content">
                                <div class="client-info mb-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="client-img">
                                            <img
                                                src="{{ $form->User->avatar ? Storage::url($form->User->avatar) : Storage::url('avatar/avatar.png') }}">
                                        </div>
                                        <div class="client-name">
                                            <h6> {{ $form->User->name }} </h6>
                                        </div>
                                    </div>
                                    <a href="{{ route('forms.survey', $id) }}"
                                        class="btn btn-primary d-inline-flex align-items-center" tabindex="0">
                                        {{ __('Form View') }}
                                        <i class="ti ti-chevron-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="faq" class="faq">
    <div class="container">
        <div class="row justify-content-center wow animate__fadeInLeft" data-wow-delay="0.2s">
            <div class="col-xl-6 col-md-9 title">
                <h2>
                    {{ Utility::getsettings('faq_title') ? Utility::getsettings('faq_title') : __('Frequently Asked Questions') }}
                </h2>
                <p class="m-0">
                    {{ Utility::getsettings('faq_paragraph')
                        ? Utility::getsettings('faq_paragraph')
                        : __('Use these awesome forms to login or create new account in your project for free.') }}
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-xxl-8">
                <div class="accordion accordion-flush" id="accordionExample">
                    @foreach ($faqs as $faq)
                        <div class="accordion-item card wow animate__fadeInLeft" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="headingOne{{ $faq->id }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne{{ $faq->id }}" aria-expanded="true"
                                    aria-controls="collapseOne{{ $faq->id }}">
                                    <span class="d-flex align-items-center ">
                                        <i class="ti ti-info-circle text-primary"></i> {{ $faq->quetion }}
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseOne{{ $faq->id }}" class="accordion-collapse collapse"
                                aria-labelledby="headingOne{{ $faq->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="side-feature">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-3">
                <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                    {{ Utility::getsettings('sidefeature_name') ? Utility::getsettings('sidefeature_name') : __('Dashboard') }}
                </h1>
                <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                    {{ Utility::getsettings('sidefeature_title') ? Utility::getsettings('sidefeature_title') : __('All in one place') }}
                    <br />
                    {{ Utility::getsettings('sidefeature_subtitle') ? Utility::getsettings('sidefeature_subtitle') : __('CRM system') }}
                </h2>
                <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                    {{ Utility::getsettings('sidefeature_paragraph')
                        ? Utility::getsettings('sidefeature_paragraph')
                        : __('Use these awesome forms to login or create new account in your project for free.') }}
                </p>
            </div>
            <div class="col-sm-9">
                <div class="row feature-img-row">
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image1')
                            ? Storage::url(Utility::getsettings('image1'))
                            : asset('vendor/front_image/image1.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.2s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image2')
                            ? Storage::url(Utility::getsettings('image2'))
                            : asset('vendor/front_image/image2.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.4s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image3')
                            ? Storage::url(Utility::getsettings('image3'))
                            : asset('vendor/front_image/image3.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.6s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image4')
                            ? Storage::url(Utility::getsettings('image4'))
                            : asset('vendor/front_image/image4.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.8s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image5')
                            ? Storage::url(Utility::getsettings('image5'))
                            : asset('vendor/front_image/image5.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.3s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image6')
                            ? Storage::url(Utility::getsettings('image6'))
                            : asset('vendor/front_image/image6.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.5s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image7')
                            ? Storage::url(Utility::getsettings('image7'))
                            : asset('vendor/front_image/image7.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.7s" />
                    </div>
                    <div class="col-3">
                        <img src="{{ Utility::getsettings('image8')
                            ? Storage::url(Utility::getsettings('image8'))
                            : asset('vendor/front_image/image8.png') }}"
                            class="img-fluid header-img wow animate__fadeInRight card-img-top card-img-custom"
                            data-wow-delay="0.9s" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.front_footer')
<script>
    let ost = 0;
    document.addEventListener("scroll", function() {
        let cOst = document.documentElement.scrollTop;
        if (cOst == 0) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
        } else if (cOst > ost) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
            document.querySelector(".navbar").classList.remove("default");
        } else {
            document.querySelector(".navbar").classList.add("default");
            document
                .querySelector(".navbar")
                .classList.remove("top-nav-collapse");
        }
        ost = cOst;
    });
    var wow = new WOW({
        animateClass: "animate__animated",
    });
    wow.init();

</script>
</body>

</html>
