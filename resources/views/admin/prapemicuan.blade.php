@extends('layouts.master')
{{-- @extends('admin.static.sidebar') --}}
@extends('static.headAdmin')
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
                        <a href="{{ route('admin') }}"><i class="ki-outline ki-black-left fs-1"></i></a>
                        {{ $title }}
                    </span>
                    <div class="d-flex align-items-center gap-1">
                        <input type="text" name="search_desa" class="form-control form-control-sm"
                            placeholder="Cari Desa">

                        <a href="javascript:void(0);" onclick="openFormExcel()" class="btn btn-sm btn-primary">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-plus me-1"></i>
                                Add
                            </div>
                        </a>
                    </div>

                </div>

                <div class="d-flex flex-column gap-4">

                    @if (count($kegiatan) > 0)
                        @foreach ($kegiatan as $item)
                            <div class="card px-3 border border-gray-300 pt-2">
                                <div class="d-flex justify-content-between ps-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <i class="ki-duotone ki-briefcase text-primary fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="fw-bolder">
                                            {{ $item['desa'] }}, {{ $item['kecamatan'] }}

                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="" class="rounded p-2 text-success fs-8 bg-light-success">
                                            <i class="ki-outline ki-search-list text-success fs-3"></i>
                                        </a>

                                        <a href="#" class="rounded p-2 text-danger fs-8 bg-light-danger">
                                            <i class="ki-outline ki-trash text-danger fs-3"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="separator"></div>
                                <div class="px-3 py-3">
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
                                            @if ($item['status'] == null)
                                                <span class="d-flex gap-1 text-danger align-items-center">
                                                    <i class="ki-outline text-danger ki-information-5"></i>
                                                    Belum diinput
                                                </span>
                                            @elseif (count(explode(';',$item['status'])) > 0)
                                                <span class="d-flex gap-1 text-warning align-items-center">
                                                    <i class="ki-outline text-warning ki-watch"></i>
                                                    On Progress
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
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
