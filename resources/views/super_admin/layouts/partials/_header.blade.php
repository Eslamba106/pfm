<div id="headerMain" class="d-none">
    <?php $lang = session()->get('locale'); ?>

    <header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container shadow">

        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo -->
                <a class="navbar-brand" href="" aria-label="">
                    <img class="navbar-brand-logo" onerror="this.src='{{ asset('assets/finexerp_logo.png') }}'"
                        src="{{ asset('assets/finexerp_logo.png') }}" alt="Logo">
                    <img class="navbar-brand-logo-mini"
                        onerror="this.src='{{ asset('assets/finexerp_logo.png') }}'"
                        src="{{ asset('assets/finexerp_logo.png') }}" alt="Logo">
                </a>
                <!-- End Logo -->
            </div>

            <div class="navbar-nav-wrap-content-left">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3 d-xl-none">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                        data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                        data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
            </div>

            <button type="button" onclick="window.history.back();" class="btn btn--primary">{{ __('general.back') }}</button>
            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right"
                style="{{ Session::get('locale') === 'ar' ? 'margin-left:unset; margin-right: auto' : 'margin-right:unset; margin-left: auto' }}">
                <!-- Navbar -->
               

                <ul class="navbar-nav align-items-center flex-row">
                    <!--<li class="nav-item d-none d-sm-inline-block">
                            <label class="switcher">
                                <input class="switcher_input" type="checkbox" checked="checked">
                                <span class="switcher_control"></span>
                            </label>
                        </li>-->

                    <li class="nav-item d-none d-md-inline-block">
                        <div class="hs-unfold">
                            <div>

                                <div
                                    class="topbar-text dropdown disable-autohide {{ Session::get('locale') === 'ar' ? 'ml-3' : 'm-1' }} text-capitalize">
                                    @if ($lang == 'ar' )
                                        <a class="topbar-link dropdown-toggle d-flex align-items-center title-color"
                                            href="{{ route('lang', 'ar') }}" data-toggle="dropdown">
                                            <img class="{{ Session::get('locale') === 'ar' ? 'ml-2' : 'mr-2' }}"
                                                width="20"
                                                src="{{ asset('assets/front-end') }}/img/flags/bh.png"
                                                alt="Eng">
                                        </a>
                                    @elseif($lang == 'en' || $lang == null)
                                        <a class="topbar-link dropdown-toggle d-flex align-items-center title-color"
                                            href="{{ route('lang', 'en') }}" data-toggle="dropdown">
                                            <img class="{{ Session::get('locale') === 'ar' ? 'ml-2' : 'mr-2' }}"
                                                width="20"
                                                src="{{ asset('assets/front-end') }}/img/flags/en.png"
                                                alt="Eng">
                                        </a>
                                    @endif
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item py-1" href="{{ route('lang', 'ar') }}">
                                                <img class="{{ Session::get('locale') === 'ar' ? 'ml-2' : 'mr-2' }}"
                                                    width="20"
                                                    src="{{ asset('assets/front-end') }}/img/flags/bh.png"
                                                    alt="{{ __('general.arabic') }}" />
                                                <span class="text-capitalize">{{ __('general.arabic') }}</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item py-1" href="{{ route('lang', 'en') }}">
                                                <img class="{{ Session::get('locale') === 'ar' ? 'ml-2' : 'mr-2' }}"
                                                    width="20"
                                                    src="{{ asset('assets/front-end') }}/img/flags/en.png"
                                                    alt="{{ __('general.english') }}" />
                                                <span class="text-capitalize">{{ __('general.english') }}</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- <li class="nav-item d-none d-md-inline-block">
                        <div class="hs-unfold">
                            <a title="Website home"
                                class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                href="" target="_blank">
                                <i class="tio-globe"></i>
                            </a>
                        </div>
                    </li> --}}
{{-- 
                    <li class="nav-item d-none d-md-inline-block">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                href="">
                                <i class="fas fa-clock"></i>
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li> --}}
                    {{-- @endif --}}



                    <li class="nav-item view-web-site-info">
                        <div class="hs-unfold">
                            <a onclick="openInfoWeb()" href="javascript:"
                                class="bg-white js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle">
                                <i class="tio-info"></i>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker media align-items-center gap-3 navbar-dropdown-account-wrapper dropdown-toggle dropdown-toggle-left-arrow"
                                href="javascript:;"
                                data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>
                                <div class="d-none d-md-block media-body text-right">
                                    @if (auth()->guard('admins')->check())
                                        <h5 class="profile-name mb-0">
                                            <?php $name = explode(' ' , Auth::user()->name) ?>
                                            {{ $name[0] }}
                                        </h5>
                                        <span class="fz-12">
                                            {{ auth()->guard('admins')->user()->role_name ?? '' }}
                                        </span>
                                    @else
                                    @endif

                                </div>
                                <div class="avatar border avatar-circle">
                                    <img class="avatar-img"
                                        onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                        src="{{ asset('storage/app/admin') }}/e}}" alt="Image Description">
                                    <span class="d-none avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center text-break">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ asset('storage/app/admin') }}"
                                                alt="Image Description">
                                        </div>
                                        <div class="media-body">
                                            @if (auth()->check())
                                                <span class="card-title h5">{{ auth()->user()->name }}</span>
                                                <span class="card-text">{{ auth()->user()->user_name }}</span>
                                            @else
                                                <span class="card-title h5">auth</span>
                                                <span class="card-text">auth email</span>
                                            @endif


                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('admin_settings'  ) }}">
                                    <span class="text-truncate pr-2"
                                        title="Settings">{{ __('settings.settings') }}</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:"
                                    onclick="Swal.fire({
                                    title: '{{ __('login.do_you_want_to_logout') }}',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#377dff',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: `{{ __('general.yes') }}`,
                                    denyButtonText: `{{ __('Do_not_Logout') }}`,
                                    cancelButtonText: `{{ __('general.cancel') }}`,
                                    }).then((result) => {
                                    if (result.value) {
                                    location.href='{{ route('admin.logout') }}';
                                    } else{
                                    Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out">{{ __('login.logout') }}</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
        <div id="website_info" style="display: none;" class="bg-secondary w-100">
            <div class="p-3">
                <div class="bg-white p-1 rounded">
                    @php($local = session()->has('locale') ? session('local') : 'ar')
                    {{-- @php($lang = \App\Model\BusinessSetting::where('type', 'language')->first()) --}}
                    <div
                        class="topbar-text dropdown disable-autohide {{ Session::get('locale') === 'ar' ? 'ml-3' : 'm-1' }} text-capitalize">
                        <a class="topbar-link dropdown-toggle title-color d-flex align-items-center" href="#"
                            data-toggle="dropdown">
                            {{-- @foreach (json_decode($lang['value'], true) as $data)
                                @if ($data['code'] == $local)
                                    <img class="{{Session::get('locale') === "ar" ? 'ml-2' : 'mr-2'}}"
                                         width="20"
                                         src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                         alt="Eng">
                                    {{$data['name']}}
                                @endif
                            @endforeach --}}
                        </a>
                        <ul class="dropdown-menu">
                            {{-- @foreach (json_decode($lang['value'], true) as $key => $data)
                                @if ($data['status'] == 1)
                                    <li>
                                        <a class="dropdown-item pb-1"
                                           href="">
                                            <img
                                                class="{{Session::get('locale') === "ar" ? 'ml-2' : 'mr-2'}}"
                                                width="20"
                                                src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                                alt="{{$data['name']}}"/>
                                            <span class="text-capitalize">{{$data['name']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach --}}
                        </ul>
                    </div>
                </div>
                <div class="bg-white p-1 rounded mt-2">
                    <a title="Website home" class="p-2 title-color" href="" target="_blank">
                        <i class="tio-globe"></i>
                        {{-- <span class="btn-status btn-sm-status btn-status-danger"></span> --}}
                        {{ __('view_website') }}
                    </a>
                </div>
                {{-- @if (\App\CPU\Helpers::module_permission_check('support_section')) --}}
                <div class="bg-white p-1 rounded mt-2">
                    <a class="p-2  title-color" href="">
                        <i class="tio-email"></i>
                        {{ __('message') }}
                        {{-- @php($message=\App\Model\Contact::where('seen',0)->count())
                            @if ($message != 0)
                                <span>({{ $message }})</span>
                            @endif --}}
                    </a>
                </div>
                {{-- @endif --}}
                {{-- @if (\App\CPU\Helpers::module_permission_check('order_management')) --}}
                <div class="bg-white p-1 rounded mt-2">
                    <a class="p-2  title-color" href="">
                        <i class="tio-shopping-cart-outlined"></i>
                        {{ __('order_list') }}
                    </a>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </header>
</div>
<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>
