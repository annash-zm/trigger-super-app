@extends('layouts.master')
{{-- @extends('admin.static.sidebar') --}}
@extends('static.header')
@extends('static.footer')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                {{-- <a href="{{route('fasilitator.listdesa')}}" class="mt-5">
                    <div class="p-3 bg-light-info border border-info rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <span class="text-dark fw-bolder fs-5">
                                    Input Hasil Pemicuan
                                </span>

                                <span class="fs-8 text-dark">
                                    klik untuk input hasil pemicuan
                                </span>
                            </div>
                            <i class="ki-duotone ki-double-right text-dark fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                </a> --}}

                <div class="mt-5">
                    <h3>
                        Overview Dashboard
                    </h3>

                    <div class="overflow-auto" style="white-space: nowrap; scrollbar-width: none; -ms-overflow-style: none;">
                        <div style="width: 40%;" class="d-inline-block me-3 rounded border border-gray-300 p-3">
                            <div class="d-flex flex-column gap-2">
                                <span class="fa fa-home text-gray-500 fs-2"></span>
                                <span class="fs-7">Desa pemicuan</span>
                                <h3>{{ $desaPemicuan }} <span>desa</span></h3>
                            </div>
                        </div>
                        <div style="width: 40%;" class="d-inline-block me-3 rounded border border-gray-300 p-3">
                            <div class="d-flex flex-column gap-2">
                                <span class="fas fa-chart-pie fs-2 text-gray-500"></span>
                                <span class="fs-7">Spot Pembuangan</span>
                                <h3> <span>{{ $spotPembuangan }} titik</span></h3>
                            </div>
                        </div>
                        <div style="width: 40%;" class="d-inline-block me-3 rounded border border-gray-300 p-3">
                            <div class="d-flex flex-column gap-2">
                                <span class="fa fa-location-dot fs-2 text-gray-500"></span>
                                <span class="fs-7">Titik Pemicuan</span>
                                <h3> <span>{{ $titikPemicuan }} titik</span></h3>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div id="hadir" style="width: 100%; height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h3>
                            Peta Spot Pembuangan Sampah
                        </h3>
                        <div class="card">
                            <div id="map"></div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3>
                            Jumlah Titik Pendanaan
                        </h3>
                        <div class="card">
                            <div id="dana"></div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
