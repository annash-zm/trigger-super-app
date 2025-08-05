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
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="fw-bolder d-flex align-items-center">
                            <a href="{{ route('fasilitator') }}"><i class="ki-outline ki-black-left fs-1"></i></a>
                            {{ $title }}
                        </span>
                        <div style="max-width: 40%;">
                            <input id="search_desa" type="text" class="form-control form-control-sm"
                                placeholder="Cari Desa" />
                        </div>
                    </div>
                    <div class="content-listdesa d-flex flex-column gap-3">
                        @foreach ($kegiatan as $item)
                            <a href="{{ route('fasilitator.hasilpemicuan', ['id' => Crypt::encrypt($item['id'])]) }}"
                                class="card px-3 border border-gray-300">
                                <div class="card-title px-3 pt-3 pb-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex gap-2 align-items-center">
                                                <i class="ki-duotone ki-geolocation-home text-primary display-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bolder">
                                                        {{ ucfirst(strtolower($item['desa'])) }},
                                                        {{ ucfirst(strtolower($item['district_name'])) }}
                                                    </span>
                                                    <span class="text-gray-400 fs-8">
                                                        {{ $item['tanggal'] }} | <span
                                                            class="text-{{ $item['status'] == 1 ? 'success' : 'danger' }}">
                                                            {{ $item['status'] == 1 ? 'Sudah diinput' : 'Belum Diinput' }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <i class="ki-duotone ki-double-right text-primary display-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="d-flex justify-content-between">
                            <div class=""></div>
                            <div class="">
                                {{ $page->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@section('js')
    <script src="{{ asset('js/fasilitator.js') }}"></script>
@endsection
