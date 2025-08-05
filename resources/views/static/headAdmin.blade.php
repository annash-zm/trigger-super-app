@section('header')
    <!--begin::Header-->
    <div id="kt_header" class="header align-items-stretch">
        <!--begin::Brand-->
        <div class="header-brand bg-white">
            <!--begin::Logo-->
            <a href="#">
                <div class="d-flex align-items-center gap-2">
                    <img alt="Logo" src="https://dlh.banyuwangikab.go.id/images/bwh.webp" class="h-50px h-lg-75px" />
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-1">

                        </div>
                    </div>
                </div>
            </a>
            <!--end::Logo-->
            <!--begin::Action group-->
            <div class="d-flex align-items-stretch overflow-auto pt-3 pt-lg-0">
                <a href="#" class="btn btn-icon btn-sm btn-active-color-primary text-dark me-2"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30px">
                        <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/general/gen059.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2x"><svg width="16" height="15"
                                viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="6" width="16" height="3" rx="1.5" fill="currentColor" />
                                <rect opacity="0.3" y="12" width="8" height="3" rx="1.5"
                                    fill="currentColor" />
                                <rect opacity="0.3" width="12" height="3" rx="1.5" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Symbol-->
                </a>

                
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-50"
                    data-kt-menu="true">
                     <!--begin::Menu item-->
                    <div class="menu-item px-2">
                       
                        <a href="{{ route('admin') }}" class="menu-link px-5">
                            <i class="ki-outline ki-abstract-26 me-2 fs-4"></i>
                            Dashboard
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-2">
                        <a href="{{route('admin.pra-pemicuan')}}" class="menu-link px-5">
                            <i class="ki-outline ki-abstract-20 me-2 fs-4"></i>
                            Pra Pemicuan
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-2">
                        <a href="{{route('admin.userAdmin')}}" class="menu-link px-5">
                            <i class="ki-outline ki-faceid fs-4 me-2"></i>
                            Admin
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-2">
                        <a href="{{route('admin.pendamping')}}" class="menu-link px-5">
                            <i class="ki-outline ki-profile-user fs-4 me-2"></i>
                            Pendamping
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-2">
                        <a href="{{route('admin.fasilitator')}}" class="menu-link px-5">
                            <i class="ki-outline ki-switch fs-4 me-2"></i>
                            Fasilitator
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>

                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-30px">
                            <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="" />
                        </div>
                        <!--end::Symbol-->
                    </a>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('assets/media/avatars/blank.png') }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-inline-block text-truncate align-items-center fs-5"
                                        style="max-width: 150px">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary text-truncate fs-7"
                                        style="max-width: 150px">
                                        {{ Auth::user()->email }}
                                    </a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-2">
                            <a href="" class="menu-link px-5">
                                <i class="fa fa-user me-3"></i>
                                Profile
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-2 my-1">
                            <a href="" class="menu-link px-5">
                                <i class="fa fa-gear me-3"></i>
                                Settings
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-2">
                            <a href="{{ route('logout') }}" class="menu-link px-5">
                                <i class="fa fa-sign-out me-3"></i>
                                Sign Out
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->

                </div>
                <!--end::Theme mode-->
            </div>
            <!--end::Action group-->
        </div>
        <!--end::Brand-->
        <!--begin::Toolbar-->
        <div class="toolbar d-flex align-items-stretch">
            <!--begin::Toolbar container-->
            <div
                class="container-xxl py-6 py-lg-0 d-flex flex-row align-items-lg-stretch justify-content-xl-between justify-content-between">
                <!--begin::Page title-->
                <div class="page-title d-flex justify-content-center flex-column me-5">
                    <!--begin::Title-->
                    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">
                        Trigger Super App
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Home</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">{{ $title }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->



            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
@endsection
