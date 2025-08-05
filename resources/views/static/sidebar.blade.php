@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('sidebar')
    <!--begin::Aside-->
    <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
        data-kt-drawer-activate="{default: false, lg: false}" data-kt-drawer-overlay="false"
        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
        data-kt-drawer-toggle="#kt_aside_mobile_toggle">
        
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid bg-white">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
                data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                    id="#kt_aside_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ Route::is('pendamping') ? 'active' : '' }}" href="">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Home</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">
                                Pemicuan
                            </span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link
                            href="">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-address-book fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pra Pemicuan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link"
                            href="">
                            <span class="menu-icon">
                                <i class="fa fa-location fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pemicuan</span>
                        </a>
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link"
                            href="">
                            <span class="menu-icon">
                                <i class="fa fa-person fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pasca Pemicuan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                   
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
            <!--begin::Footer-->
            <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
                <a href="" class="btn btn-flex btn-custom btn-primary w-100">
                    <span class="btn-label me-3">Sign Out</span>
                    <i class="fa fa-sign-out"></i>
                </a>
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Aside menu-->

    </div>
    <!--end::Aside-->
@endsection
