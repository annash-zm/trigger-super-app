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
                <div class="card">
                    <div class="p-5 border border-info rounded bg-light-info mb-3">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex gap-2">
                                <i class="ki-outline ki-cheque text-info fs-2x"></i>
                                <div class="d-flex flex-column">
                                    <span class="fw-bolder">Note</span>
                                    <span class="fs-9 text-gray-600">
                                        Input jumlah titik pemicuan pada masing-masing jenis pendanaan
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 px-2 pt-5">
                        <a href="{{ route('pendamping.kategoripemicuan', ['id' => Crypt::encrypt($data['id'])]) }}"><i
                                class="ki-outline ki-black-left fs-1"></i></a>
                        <h3>
                            Form Pra Pemicuan <br>
                            <span class="fs-8 text-gray-500">Input Informasi Desa</span>
                        </h3>
                    </div>

                    <div class="card-body">

                        @php
                            $q = !empty($dataDana);
                        @endphp
                        <form id="forminfodana">
                            @csrf
                            <input type="hidden" id="id_prapemicuan" name="id_prapemicuan"
                                value="{{ Crypt::encrypt($data['id']) }}">
                            <div class="d-flex flex-column gap-5">
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Konsumsi Desa</label>
                                        <input class="form-control form-control-sm" name="konsumsi_desa" placeholder=""
                                            id="rw" value="{{ $q ? $dataDana['dana_konsumsi_desa'] : '' }}" />
                                        <span class="text-danger fs-8 konsumsi_desa"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="pendidikan">Konsumsi Puskesmas</label>
                                        <input class="form-control form-control-sm" name="konsumsi_puskesmas" placeholder=""
                                            id="rw" value="{{ $q ? $dataDana['dana_konsumsi_puskesmas'] : '' }}" />
                                        <span class="text-danger fs-8 konsumsi_puskesmas"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Konsumsi Dinkes</label>
                                        <input class="form-control form-control-sm" name="konsumsi_dinkes"
                                            value="{{ $q ? $dataDana['dana_konsumsi_dinkes'] : '' }}" placeholder=""
                                            id="pekerjaan" />
                                        <span class="text-danger fs-8 konsumsi_dinkes"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="tgl">Konsumsi BWI Hijau</label>
                                        <input class="form-control form-control-sm" name="konsumsi_bwi_hijau"
                                            value="{{ $q ? $dataDana['dana_konsumsi_bwihijau'] : '' }}" placeholder=""
                                            id="pekerjaan" />
                                        <span class="text-danger fs-8 konsumsi_bwi_hijau"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Honor Desa</label>
                                        <input class="form-control form-control-sm" name="honor_desa"
                                            value="{{ $q ? $dataDana['dana_honor_desa'] : '' }}" placeholder=""
                                            id="pendidikan" />
                                        <span class="text-danger fs-8 honor_desa"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="tgl">Honor Puskesmas</label>
                                        <input class="form-control form-control-sm" name="honor_puskesmas"
                                            value="{{ $q ? $dataDana['dana_honor_puskesmas'] : '' }}" placeholder=""
                                            id="pendidikan" />
                                        <span class="text-danger fs-8 honor_puskesmas"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Honor Dinkes</label>
                                        <input class="form-control form-control-sm" name="honor_dinkes"
                                            value="{{ $q ? $dataDana['dana_honor_dinkes'] : '' }}" placeholder=""
                                            id="pendidikan" />
                                        <span class="text-danger fs-8 honor_dinkes"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="tgl">Honor BWI Hijau</label>
                                        <input class="form-control form-control-sm" name="honor_bwi_hijau"
                                            value="{{ $q ? $dataDana['dana_honor_bwihijau'] : '' }}" placeholder=""
                                            id="pendidikan" />
                                        <span class="text-danger fs-8 honor_bwi_hijau"></span>
                                    </div>
                                </div>

                                <div class="d-flex flex-row gap-3 justify-content-end">
                                    <button class="btn btn-secondary">
                                        Batal
                                    </button>
                                    <button type="submit" id="infoDanabtn" class="btn btn-primary">
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
    <script src="{{ asset('js/formInfoDana.js') }}"></script>
@endsection
