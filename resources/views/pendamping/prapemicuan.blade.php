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
                        <a href="{{ route('pendamping') }}"><i class="ki-outline ki-black-left fs-1"></i></a>
                        {{ $title }}
                    </span>
                    <div class="d-flex align-items-center gap-1">
                        <input type="text" name="search_desa" class="form-control form-control-sm"
                            placeholder="Cari Desa">
                    </div>

                </div>

                <div class="d-flex flex-column gap-4">

                    @if (count($kegiatan) > 0)
                        @foreach ($kegiatan as $item)
                            <a href="{{route('pendamping.kategoripemicuan', ['id' => Crypt::encrypt($item['id'])])}}" class="card px-3 border border-gray-300 pt-2">
                                <div class="d-flex justify-content-between ps-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <i class="ki-duotone ki-briefcase text-primary fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="fw-bolder">
                                            {{ ucfirst(strtolower($item['desa'])) }},
                                            {{ ucfirst(strtolower($item['district_name'])) }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="ki-outline ki-information-5 fs-5 text-warning"></i>
                                        <span class="text-warning fs-8">Belum Lengkap</span>
                                    </div>
                                </div>

                                <div class="separator mt-2"></div>
                                <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <span>
                                            {{ $item['kegiatan'] }}
                                        </span>

                                        <div class="d-flex gap-2 mt-1 fs-7 align-items-center">
                                            <span class="text-gray-400">
                                                <i class="ki-outline ki-calendar-2"></i>
                                                {{ $item['tanggal'] }}
                                            </span>
                                            <span class="text-gray-400">
                                                |
                                            </span>
                                            <span class="text-gray-400 fs-7">
                                                <i class="fa fa-paperclip"></i>
                                                {{ $item['dokumentasi'] ? $item['dokumentasi'] : 0 }}
                                            </span>
                                            <span class="text-gray-400">
                                                |
                                            </span>
                                            <span class="text-gray-400 fs-7">
                                                <i class="ki-outline ki-profile-user fs-8"></i>
                                                0
                                            </span>

                                        </div>
                                    </div>

                                    <i class="ki-outline text-primary ki-double-right fs-1"></i>
                                </div>
                            </a>
                        @endforeach
                        <div class="d-flex justify-content-between">
                            <div class=""></div>
                            <div class="">
                                {{ $page->links() }}
                            </div>
                        </div>
                    @else
                        <div class="px-3">
                            <span>Tidak ada data yang ditampilkan</span>
                        </div>
                    @endif

                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    @php
        echo $formprapemicuan;
    @endphp
@endsection

@section('js')
    <script src="{{ asset('js/prapemicuan.js') }}"></script>
@endsection
