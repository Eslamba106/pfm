<style>
    /* .nav-item.active {
    background-color: #007bff !important;
    color: white !important;
}*/
</style>
<div id="sidebarMain" class="d-none">
    <?php $lang = session()->get('locale'); ?>
    <aside style="text-align: {{ $lang == 'ar' ? 'right' : 'left' }};"
        class="bg-white js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    {{-- @php(=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value) --}}
                    <a class="navbar-brand" href="{{ route('main_dashboard') }}" aria-label="Front">
                        <img onerror="this.src='{{ asset('assets/back-end/img/900x400/img1.jpg') }}'"
                            class="navbar-brand-logo-mini for-web-logo max-h-30"
                            src="{{ asset('assets/finexerp_logo.png') }}" alt="Logo">
                    </a>
                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                        class="d-none js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                    <button type="button" id="toggle-sidebar"
                        class="btn btn-sm btn--primary js-navbar-vertical-aside-toggle-invoker">
                        <i class="fas fa-angle-double-left navbar-vertical-aside-toggle-short-align"
                            data-toggle="tooltip" data-placement="right"></i>
                        <i class="fas fa-angle-double-right navbar-vertical-aside-toggle-full-align d-none"
                            data-toggle="tooltip" data-placement="right"></i>
                    </button>


                </div>

                <!-- Content -->
                <div class="navbar-vertical-content sidebar_main">
                    <!-- Search Form -->
                    <div class="sidebar--search-form pb-3 pt-4">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="js-form-search form-control form--control"
                                id="search-bar-input" placeholder="{{ __('general.search_menu') }}...">
                        </div>
                    </div>
                    <!-- End Search Form -->
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                title="{{ __('dashboard.dashboard') }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home  "></i>
                                <span style="{{ $lang == 'ar' ? 'margin-right: 8px;' : 'margin-left: 8px;' }}"
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('dashboard.dashboard') }}
                                </span>
                            </a>
                        </li>

                        <li class="navbar-vertical-aside-has-menu {{ Request::is('companies*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('companies.companies') }}">
                                <i class="fas fa-users"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                                    style="{{ $lang == 'ar' ? 'margin-right: 8px;' : 'margin-left: 8px;' }}">
                                    {{ __('companies.companies') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('companies*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('companies') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.companies') }}"
                                        title="{{ __('companies.all_companies') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('companies.all_companies') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{ \App\Models\Company::count() }}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                {{-- @can('create_company') --}}
                                <li class="nav-item {{ Request::is('companies/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.companies.create') }}"
                                        title="{{ __('companies.create_company') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('companies.create_company') }}
                                        </span>
                                    </a>
                                </li>
                                {{-- @endcan --}}

                            </ul>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/requests') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" title="{{ ui_change('requests') }}"
                                href="{{ route('admin.requests') }}">
                                <i class="fas fa-envelope"></i>
                                <span style="{{ $lang == 'ar' ? 'margin-right: 8px;' : 'margin-left: 8px;' }}"
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ ui_change('requests') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/schema') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" title="{{ ui_change('schema') }}"
                                href="{{ route('admin.schema') }}">
                                <i class="fas fa-project-diagram"></i>
                                <span style="{{ $lang == 'ar' ? 'margin-right: 8px;' : 'margin-left: 8px;' }}"
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ ui_change('schema') }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item pt-5">
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

@push('script_2')
    <script>
        $(window).on('load', function() {
            if ($(".navbar-vertical-content li.active").length) {
                $('.navbar-vertical-content').animate({
                    scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
                }, 10);
            }
        });

        //Sidebar Menu Search
        var $rows = $('.navbar-vertical-content .navbar-nav > li');
        $('#search-bar-input').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
@endpush
