@extends('layouts.master')
{{-- @extends('admin.static.sidebar') --}}
@extends('static.headAdmin')
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


                <div class="mt-5">
                    <h3>
                        Overview Dashboard
                    </h3>

                    <div class="d-flex flex-row justify-content-between gap-3">
                        <div class="w-50 rounded border border-gray-300 p-3">
                            <div class="d-flex flex-column gap-2">
                                <span class="fa fa-city text-gray-500 fs-2"></span>
                                <span class="fs-7">Desa pemicuan</span>
                                <h3>{{ $desaPemicuan }} <span>desa</span></h3>
                            </div>
                        </div>
                        <div class="w-50 rounded border border-gray-300 p-3">
                            <div class="d-flex flex-column gap-2">
                                <span class="fa fa-location-dot fs-2 text-gray-500"></span>
                                <span class="fs-7">Titik pemicuan</span>
                                <h3>120 <span>titik</span></h3>
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
                            Peta Pemicuan
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
