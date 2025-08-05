@extends('layouts.master')
{{-- @extends('admin.static.sidebar') --}}
@extends('static.header')
@extends('static.footer')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 200px;
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
                <div class="card">
                    <div class="d-flex gap-2 px-2 pt-5">
                        <a href="{{ route('pendamping.kategoripemicuan', ['id' => Crypt::encrypt($data['id'])]) }}">
                            <i class="ki-outline ki-black-left fs-1"></i>
                        </a>
                        <h3>
                            Form Pra Pemicuan <br>
                            <span class="fs-8 text-gray-500">Input Informasi Umum</span>
                        </h3>
                    </div>

                    <div class="card-body">
                        @php
                            $q = !empty($dataUmum);
                        @endphp
                        <form id="forminfoumum">
                            @csrf
                            <input type="hidden" id="id_prapemicuan" name="id_prapemicuans"
                                value="{{ Crypt::encrypt($data['id']) }}">

                            <div class="d-flex flex-column gap-5">
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-12">
                                        <label for="jml_spot_pembuangan">Jumlah Spot Pembuangan</label>
                                        <input class="form-control form-control-sm" name="jml_spot_pembuangan"
                                            placeholder="" id="jml_spot_pembuangan"
                                            value="{{ $q ? $dataUmum['jml_spot_pembuangan'] : '' }}" />
                                        <span class="text-danger fs-8 jml_spot_pembuangan"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-12 mt-5">
                                        <label for="lokasi_spot_pembuangan">Lokasi Spot Pembuangan - Desa
                                            {{ ucfirst(strtolower($data['desa'])) }} <br> <span
                                                class="fs-7 text-gray-600">Klik pada map untuk marking lokasi pembuangan</span><br> <span
                                                class="fs-7 text-gray-600">[Spot Pembuangan Terbesar]</span> </label>
                                        <div class="mt-2 mb-2" id="map"></div>
                                        <span class="text-danger fs-8 lokasi_spot_pembuangan"></span>
                                    </div>
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        {{-- <label for="latitude">Latitude</label> --}}
                                        <input class="form-control form-control-sm" name="lat" placeholder="latitude"
                                            value="{{ $q ? $lokasi['lat'] : '' }}" id="lat" readonly />
                                    </div>
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        {{-- <label for="Longitude">Longitude</label> --}}
                                        <input class="form-control form-control-sm" name="long" placeholder="longitude"
                                            value="{{ $q ? $lokasi['long'] : '' }}" id="long" readonly />
                                    </div>

                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <label for="">Foto Spot Pembuangan</label>
                                    @if ($q)
                                        @php
                                            $foto_spot = json_decode($dataUmum['foto_spot_pembuangan']);
                                        @endphp
                                        <div class="d-flex flex-wrap gap-2">
                                            @if (!empty($foto_spot))
                                                @foreach ($foto_spot as $foto)
                                                    <div class="symbol symbol-25 d-flex flex-column gap-1 position-relative">
                                                        <a onclick="delFotoSpot('{{ $foto->fileId }}')"
                                                            href="javascript:void(0);" style="top: -5px; right:-4px;" class="text-center position-absolute">
                                                            <i class="ki-solid text-danger ki-cross-circle fs-2"></i>
                                                        </a>
                                                        <img src="{{ Storage::url('foto_spot_pembuangan/' . $foto->fileId) }}"
                                                            alt="Foto" class="object-fit-cover">

                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="dokumentasi-1">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up fs-3x text-primary"><span
                                                    class="path1"></span><span class="path2"></span></i>

                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Click to upload.</h3>
                                                <span class="fs-7 fw-semibold text-gray-500">Upload up to 10
                                                    files</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="no_kontak_bumdes">No Kontak Bumdes</label>
                                        <input type="number" class="form-control form-control-sm" name="no_kontak_bumdes"
                                            placeholder="" id="no_kontak_bumdes"
                                            value="{{ $q ? $dataUmum['no_kontak_bumdes'] : '' }}" />
                                        <span class="text-danger fs-8 no_kontak_bumdes"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="iuran">Iuran (angkanya
                                            saja)</label>
                                        <input class="form-control form-control-sm" name="iuran" placeholder="ex : 10000"
                                            id="iuran" value="{{ $q ? $dataUmum['iuran'] : '' }}" />
                                        <span class="text-danger fs-8 iuran"></span>
                                    </div>
                                </div>



                                <div class="d-flex flex-row gap-3 justify-content-end">
                                    <button class="btn btn-secondary" type="button">
                                        Batal
                                    </button>
                                    <button type="submit" id="infoUmumbtn" class="btn btn-primary">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle"></span></span>
                                    </button>
                                </div>
                            </div>
                        </form>


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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/formInfoUmum.js') }}"></script>
@endsection
