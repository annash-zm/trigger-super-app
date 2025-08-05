@extends('layouts.master')
{{-- @extends('admin.static.sidebar') --}}
@extends('static.header')
@extends('static.footer')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="fw-bolder d-flex align-items-center">
                        <a href="{{ route('pendamping.listkegiatan') }}"><i class="ki-outline ki-black-left fs-1"></i></a>
                        Input Pra Pemicuan Desa {{ ucfirst(strtolower($prapemicuan['desa'])) }}
                    </span>
                </div>

                <div class="d-flex flex-column gap-4">
                    <a href="{{ route('pendamping.infodesa', ['id' => Crypt::encrypt($prapemicuan['id'])]) }}"
                        class="card border border-gray-300">
                        <div class="p-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 bg-dark rounded">
                                            <i class="ki-outline ki-parcel text-white fs-1"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bolder fs-5">Input Informasi Desa</span>
                                            <div class="text-gray-500">
                                                <span class="fs-8">Progress : {{ $progressInfoDesa }}</span>
                                                |
                                                <span class="fs-8"> {{ $modified['infoDesa'] }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="ki-outline text-primary ki-double-right fs-1"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('pendamping.infoKelolaSampah', ['id' => Crypt::encrypt($prapemicuan['id'])]) }}"
                        class="card border border-gray-300">
                        <div class="p-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 bg-dark rounded">
                                            <i class="ki-outline ki-abstract-26 text-white fs-1"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bolder fs-5">Input Pengelolaan Sampah</span>
                                            <div class="text-gray-500">
                                                <span class="fs-8">Progress : {{ $progressKelolaSampah }}</span>
                                                |
                                                <span class="fs-8">{{ $modified['infoKelolaSampah'] }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="ki-outline text-primary ki-double-right fs-1"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{route('pendamping.infoumum', ['id' => Crypt::encrypt($prapemicuan['id'])])}}" class="card border border-gray-300">
                        <div class="p-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 bg-dark rounded">
                                            <i class="ki-outline ki-abstract-20 text-white fs-1"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bolder fs-5">Input Informasi Umum</span>
                                            <div class="text-gray-500">
                                                <span class="fs-8">Progress : {{ $progressUmum }}</span>
                                                |
                                                <span class="fs-8">{{ $modified['infoUmum'] }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="ki-outline text-primary ki-double-right fs-1"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('pendamping.pendanaan', ['id' => Crypt::encrypt($prapemicuan['id'])]) }}"
                        class="card border border-gray-300">
                        <div class="p-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-2 bg-dark rounded">
                                            <i class="ki-outline ki-avalanche text-white fs-1"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bolder fs-5">Input Pendanaan</span>
                                            <div class="text-gray-500">
                                                <span class="fs-8">Progress : {{ $progressDana }}</span>
                                                |
                                                <span class="fs-8">{{ $modified['infoDana'] }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="ki-outline text-primary ki-double-right fs-1"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@section('js')
    <script src="{{ asset('js/prapemicuan.js') }}"></script>
@endsection
