@php
    use App\Models\Form;
    $user = \Auth::user();
    $currantLang = $user->currentLanguage();
    $languages = Utility::languages();
    $role_id = $user->roles->first()->id;
    $user_id = $user->id;
    if (Auth::user()->type == 'Admin') {
        $forms = Form::all();
        $all_forms = Form::all();
    } else {
        $forms = Form::select(['forms.*'])
            ->where(function ($query) use ($role_id, $user_id) {
                $query
                    ->whereIn('forms.id', function ($query1) use ($role_id) {
                        $query1
                            ->select('form_id')
                            ->from('assign_forms_roles')
                            ->where('role_id', $role_id);
                    })
                    ->OrWhereIn('forms.id', function ($query1) use ($user_id) {
                        $query1
                            ->select('form_id')
                            ->from('assign_forms_users')
                            ->where('user_id', $user_id);
                    })
                    ->OrWhere('assign_type', 'public');
            })
            ->get();
        $all_forms = Form::select('id','title')->where('created_by',$user->id)->get();
    }
@endphp
{{--  {{ dd($forms) }}  --}}
<nav class="dash-sidebar light-sidebar transprent-bg">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('home') }}" class="b-brand text-center">
                <!-- ========   change your logo hear   ============ -->
                @if (Utility::getsettings('dark_mode') == 'on')
                    <img src="{{ Utility::getsettings('app_logo') ? Storage::url('uploads/appLogo/app-logo.png') : Storage::url('uploads/appLogo/78x78.png') }}"
                        class="app-logo img_setting w-75" />
                @else
                    <img src="{{ Utility::getsettings('app_dark_logo') ? Storage::url('uploads/appLogo/app-dark-logo.png') : Storage::url('uploads/appLogo/78x78.png') }}"
                        class="app-logo img_setting w-75" />
                @endif
            </a>
        </div>
        <div class="navbar-content">
            <ul class="dash-navbar" style="display: block;">
                <li class="dash-item dash-hasmenu {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-home"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Dashboard') }}</span></a>
                </li>
                @can('manage-dashboardwidget')
                    <li class="dash-item dash-hasmenu {{ request()->is('index-dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('index.dashboard') }}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-square"></i></span>
                            <span class="dash-mtext custom-weight">{{ __('Dashboard Widgets') }}</span></a>
                    </li>
                @endcan
                @canany(['manage-user', 'manage-role'])
                    <li
                        class="dash-item dash-hasmenu {{ request()->is('users*') || request()->is('roles*') ? 'active dash-trigger' : 'collapsed' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-layout-2"></i></span><span
                                class="dash-mtext">{{ __('User Management') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage-user')
                                <li class="dash-item {{ request()->is('users*') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                                </li>
                            @endcan
                            @can('manage-role')
                                <li class="dash-item {{ request()->is('roles*') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['manage-form', 'manage-submitted-form'])
                    <li
                        class="dash-item dash-hasmenu {{ request()->is('forms*', 'design*') || request()->is('formvalues*') ? 'active dash-trigger' : 'collapsed' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-table"></i></span><span
                                class="dash-mtext">{{ __('Form') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage-form')
                                <li class="dash-item {{ request()->is('forms*', 'design*') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('forms.index') }}">{{ __('Forms') }}</a>
                                </li>
                                <li class="dash-item">
                                    <a href="#!" class="dash-link"><span
                                            class="dash-mtext custom-weight">{{ __('Submitted Forms') }}</span><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul
                                        class="dash-submenu {{ Request::route()->getName() == 'view.form.values' ? 'd-block' : '' }}">
                                        @foreach ($forms as $form)
                                            <li class="dash-item">
                                                <a class="dash-link {{ Request::route()->getName() == 'view.form.values' ? 'show' : '' }}"
                                                    href="{{ route('view.form.values', $form->id) }}">{{ $form->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['manage-poll'])
                    <li class="dash-item dash-hasmenu {{ request()->is('poll*') ? 'active' : '' }}">
                        <a class="dash-link" href="{{ route('poll.index') }}"><span class="dash-micon">
                                <i class="ti ti-accessible"></i></span>
                            <span class="dash-mtext">{{ __('Polls') }}</span>
                        </a>
                    </li>
                @endcanany
                @canany(['manage-mailtemplate', 'manage-language', 'manage-setting'])
                    <li
                        class="dash-item dash-hasmenu {{ request()->is('mailtemplate*') || request()->is('sms-template*') || request()->is('manage-language*') || request()->is('create-language*') || request()->is('settings*') ? 'active dash-trigger' : 'collapsed' }} || {{ request()->is('create-language*') || request()->is('settings*') ? 'active' : '' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-apps"></i></span><span
                                class="dash-mtext">{{ __('Account Setting') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage-mailtemplate')
                                <li class="dash-item {{ request()->is('mailtemplate*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('mailtemplate.index') }}">{{ __('Email Templates') }}</a>
                                </li>
                            @endcan
                            <li class="dash-item {{ request()->is('sms-template*') ? 'active' : '' }}">
                                <a class="dash-link"
                                    href="{{ route('sms-template.index') }}">{{ __('Sms Templates') }}</a>
                            </li>
                            @can('manage-language')
                                <li
                                    class="dash-item {{ request()->is('manage-language*') || request()->is('create-language*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('manage.language', [$currantLang]) }}">{{ __('Manage Languages') }}</a>
                                </li>
                            @endcan
                            @can('manage-setting')
                                <li class="dash-item {{ request()->is('settings*') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('settings') }}">{{ __('Settings') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['manage-frontend', 'manage-faqs'])
                    <li
                        class="dash-item dash-hasmenu {{ request()->is('frontend-setting*') || request()->is('faqs*') ? 'active dash-trigger' : 'collapsed' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-table"></i></span><span
                                class="dash-mtext">{{ __('Frontend Setting') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage-frontend')
                                <li class="dash-item {{ request()->is('frontend-setting*') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('frontend.page') }}">{{ __('Landing Page') }}</a>
                                </li>
                            @endcan
                            @can('manage-faqs')
                                <li class="dash-item {{ request()->is('faqs*') ? 'active' : '' }}">
                                    <a class="dash-link" href="{{ route('faqs.index') }}">{{ __('Faqs') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['manage-chat'])
                    @if (setting('pusher_status') == '1')
                        <li
                            class="dash-item dash-hasmenu {{ request()->is('chat*') ? 'active dash-trigger' : 'collapsed' }}">
                            <a href="#!" class="dash-link"><span class="dash-micon"><i
                                        class="ti ti-table"></i></span><span
                                    class="dash-mtext">{{ __('Support') }}</span><span class="dash-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                @can('manage-chat')
                                    <li class="dash-item">
                                        <a class="dash-link" href="{{ route('chats') }}">{{ __('Chats') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                @endcanany
            </ul>
        </div>
    </div>
</nav>
