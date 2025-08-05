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
                            $q = !empty($dataDesa);
                        @endphp
                        <form id="forminfodesa">
                            @csrf
                            <input type="hidden" id="id_prapemicuan" name="id_prapemicuan"
                                value="{{ Crypt::encrypt($data['id']) }}">
                            <div class="d-flex flex-column gap-5">
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Jumlah RW</label>
                                        <input class="form-control form-control-sm" name="rw"
                                            placeholder="Jumlah RW di desa" id="rw"
                                            value="{{ $q ? $dataDesa['jumlah_rw'] : '' }}" />
                                        <span class="text-danger fs-8 rw"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="pendidikan">Pendidikan Warga</label>
                                        <select name="pendidikan" class="form-select form-select-sm" data-control="select2"
                                            data-placeholder="Select an option">
                                            <option></option>
                                            <option value="SD"
                                                {{ $q && $dataDesa['pendidikan_warga'] == 'SD' ? 'selected' : '' }}>SD
                                            </option>
                                            <option value="SMP"
                                                {{ $q && $dataDesa['pendidikan_warga'] == 'SMP' ? 'selected' : '' }}>SMP
                                            </option>
                                            <option value="SMA"
                                                {{ $q && $dataDesa['pendidikan_warga'] == 'SMA' ? 'selected' : '' }}>SMA
                                            </option>
                                            <option value="S1"
                                                {{ $q && $dataDesa['pendidikan_warga'] == 'S1' ? 'selected' : '' }}>S1
                                            </option>
                                            <option value="S2"
                                                {{ $q && $dataDesa['pendidikan_warga'] == 'S2' ? 'selected' : '' }}>S2
                                            </option>
                                            <option value="S3"
                                                {{ $q && $dataDesa['pendidikan_warga'] == 'S3' ? 'selected' : '' }}>S3
                                            </option>
                                        </select>
                                        <span class="text-danger fs-8 pendidikan"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Pekerjaan Warga</label>
                                        <input class="form-control form-control-sm" name="pekerjaan"
                                            value="{{ $q ? $dataDesa['pekerjaan_masyarakat'] : '' }}"
                                            placeholder="Pekerjaan rata-rata warga" id="pekerjaan" />
                                        <span class="text-danger fs-8 pekerjaan"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="tgl">Kelembagaan Sosial</label>
                                        <input class="form-control form-control-sm" name="kelembagaan" value="{{ $q ? $dataDesa['kelembagaan_sosial'] : '' }}"
                                            placeholder="Kelembagaan sosial di desa" id="pekerjaan" />
                                        <span class="text-danger fs-8 kelembagaan"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">Nama Tokoh</label>
                                        <input class="form-control form-control-sm" name="nama_tokoh" value="{{ $q ? $dataDesa['nama_tokoh'] : '' }}"
                                            placeholder="Nama tokoh desa" id="pendidikan" />
                                        <span class="text-danger fs-8 nama_tokoh"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="tgl">No HP Tokoh</label>
                                        <input class="form-control form-control-sm" name="no_hp_tokoh" value="{{ $q ? $dataDesa['nomor_hp_tokoh'] : '' }}"
                                            placeholder="No HP tokoh di desa" id="pendidikan" />
                                        <span class="text-danger fs-8 no_hp_tokoh"></span>
                                    </div>
                                </div>

                                <div class="d-flex flex-row gap-3 justify-content-end">
                                    <button class="btn btn-secondary">
                                        Batal
                                    </button>
                                    <button type="submit" id="infoDesabtn" class="btn btn-primary">
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
    <script src="{{ asset('js/forminfodesa.js') }}"></script>
@endsection
