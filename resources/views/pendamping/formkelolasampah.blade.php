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
                            <span class="fs-8 text-gray-500">Input Pengelolaan Sampah</span>
                        </h3>
                    </div>

                    <div class="card-body">
                        @php
                            $q = !empty($dataKelolaSampah);
                        @endphp
                        <form id="formkelolasampah">
                            @csrf
                            <input type="hidden" id="id_prapemicuan" name="id_prapemicuans"
                                value="{{ Crypt::encrypt($data['id']) }}">

                            <div class="d-flex flex-column gap-5">
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Tanggal Pemicuan</label>
                                        <input type="text" placeholder="Pick a date" id="tanggal_pemicuan"
                                            class="form-control form-control-sm" name="tanggal_pemicuan"
                                            value="{{ $q ? $dataKelolaSampah['tanggal_pemicuan'] : '' }}" />
                                        <span class="text-danger fs-8 tanggal_pemicuan"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Jumlah Titik Pemicuan</label>
                                        <input type="number" class="form-control form-control-sm"
                                            name="jumlah_titik_pemicuan" placeholder=""
                                            value="{{ $q ? $dataKelolaSampah['jumlah_titik_pemicuan'] : '' }}" />
                                        <span class="text-danger fs-8 jumlah_titik_pemicuan"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Lokasi Pemicuan <br> (nama Dusun)</label>
                                        <input class="form-control form-control-sm" name="lokasi_pemicuan"
                                            placeholder=""
                                            value="{{ $q ? $dataKelolaSampah['lokasi_pemicuan'] : '' }}" />
                                        <span class="text-danger fs-8 lokasi_pemicuan"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Lokasi D2D <br> (nama Dusun)</label>
                                        <input class="form-control form-control-sm" name="lokasi_d2d"
                                            placeholder=""
                                            value="{{ $q ? $dataKelolaSampah['lokasi_d2d'] : '' }}" />
                                        <span class="text-danger fs-8 lokasi_d2d"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Pengelolaan Sampah</label>
                                        <select name="pengelolaan_sampah" class="form-select form-select-sm"
                                            data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach ($kelolaSampah as $item)
                                                <option value="{{ $item }}"
                                                    {{ $q && ($dataKelolaSampah['pengelolaan_sampah'] == $item) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fs-8 pengelolaan_sampah"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Kondisi Geografis</label>
                                        <select name="kondisi_geografis" class="form-select form-select-sm"
                                            data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach ($geografis as $item)
                                                <option value="{{ $item }}"
                                                    {{ $q && ($dataKelolaSampah['kondisi_geografis'] == $item) ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fs-8 kondisi_geografis"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Sarana Prasarana Umum</label>
                                        <input class="form-control form-control-sm" name="sarana_dan_prasarana_umum_desa"
                                            placeholder="contoh : Memiliki TPA, dsb"
                                            value="{{ $q ? $dataKelolaSampah['sarana_dan_prasarana_umum_desa'] : '' }}" />
                                        <span class="text-danger fs-8 sarana_dan_prasarana_umum_desa"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Layanan Kelola Sampah</label>
                                        <select name="layanan_kelola_sampah[]" class="form-select form-select-sm"
                                            data-control="select2" data-placeholder="Select an option" multiple>
                                            <option></option>
                                            @foreach ($layanan as $item)
                                                <option value="{{ $item }}"
                                                    {{ $q && (in_array($item, explode(';', $dataKelolaSampah['layanan_kelola_sampah']) ?? [])) ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fs-8 layanan_kelola_sampah"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Kegiatan Rutin</label>
                                        <select name="kegiatan_rutin" class="form-select form-select-sm"
                                            data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach ($kegRutin as $item)
                                                <option value="{{ $item }}"
                                                    {{ $q && ($dataKelolaSampah['kegiatan_rutin'] == $item) ? 'selected' : '' }}
                                                >{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fs-8 kegiatan_rutin"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Waktu Kegiatan Rutin</label>
                                        <select name="waktu_keg_rutin" class="form-select form-select-sm"
                                            data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @foreach ($waktuRutin as $item)
                                                <option value="{{ $item }}"
                                                    {{ $q && ($dataKelolaSampah['waktu_keg_rutin'] == $item) ? 'selected' : '' }}
                                                >{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger fs-8 waktu_keg_rutin"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>Nama PIC Kelola Sampah</label>
                                        <input class="form-control form-control-sm" name="kandidat_pic_kelola_sampah" 
                                            placeholder="" 
                                            value="{{ $q ? $dataKelolaSampah['kandidat_pic_kelola_sampah'] : '' }}"
                                            />
                                        <span class="text-danger fs-8 kandidat_pic_kelola_sampah"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label>No HP PIC</label>
                                        <input class="form-control form-control-sm" name="no_hp_pic"
                                            placeholder="" 
                                            value="{{ $q ? $dataKelolaSampah['no_hp_pic'] : '' }}"
                                            />
                                        <span class="text-danger fs-8 no_hp_pic"></span>
                                    </div>
                                </div>



                                <div class="d-flex flex-row gap-3 justify-content-end mt-3">
                                    <button type="button" class="btn btn-secondary">Batal</button>
                                    <button type="submit" id="infoKelolaSampahbtn" class="btn btn-primary">
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
    <script src="{{ asset('js/formKelolaSampah.js') }}"></script>
@endsection
