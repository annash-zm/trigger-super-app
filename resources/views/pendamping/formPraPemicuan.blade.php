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
                    <div class="d-flex gap-2 px-2 py-5">
                            <a href="{{ route('pendamping.data-pemicuan') }}"><i
                                    class="ki-outline ki-black-left fs-1"></i></a>
                            <h3>
                                Form Pra Pemicuan <br>
                                <span class="fs-8 text-gray-500">Input data pra pemicuan</span>
                            </h3>
                        </div>

                    <div class="card-body">
                        <ul class="nav" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1 active"
                                    data-bs-toggle="tab" href="#info" aria-selected="true" role="tab">Informasi
                                    Umum</a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1"
                                    data-bs-toggle="tab" href="#prapemicuan" aria-selected="false" tabindex="-1"
                                    role="tab">Data Pra Pemicuan</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <form id="prapemicuan" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex flex-column gap-5">
                                        <div class="row">
                                            <div class="d-flex flex-column gap-2 fv-row col-6">
                                                <label for="kegiatan">Nama Kegiatan</label>
                                                <select name="kegiatan" class="form-select form-select-sm"
                                                    data-control="select2" data-placeholder="Select an option">
                                                    <option></option>
                                                    <option value="Sosialisasi Desa">Sosialisasi Desa</option>
                                                    <option value="PKS">PKS</option>
                                                </select>
                                                <span class="text-danger fs-8 kegiatan"></span>
                                            </div>

                                            <div class="d-flex flex-column gap-2 fv-row col-6">
                                                <label for="tgl">Tanggal</label>
                                                <input class="form-control form-control-sm" name="tgl"
                                                    placeholder="Pick a date" id="tgl" />
                                                <span class="text-danger fs-8 tgl"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column gap-2">
                                            <div class="row">
                                                <div class="fv-row col-6">
                                                    <label for="kegiatan">Kecamatan</label>
                                                    <select name="kecamatan" class="form-select form-select-sm"
                                                        id="kecamatan" data-control="select2"
                                                        data-placeholder="Select an option">
                                                        <option></option>
                                                    </select>
                                                    <span class="text-danger fs-8 kecamatan"></span>
                                                </div>
                                                <div class="fv-row col-6">
                                                    <label for="desa">Desa</label>
                                                    <select name="desa" id="desa" class="form-select form-select-sm"
                                                        data-control="select2" data-placeholder="Select an option">
                                                        <option></option>
                                                    </select>
                                                    <span class="text-danger fs-8 desa"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="d-flex flex-column gap-2 fv-row col-6">
                                                <label for="peserta">Jumlah Peserta</label>
                                                <input class="form-control form-control-sm" name="jumlah_peserta"
                                                    placeholder="Jumlah peserta" id="peserta" />
                                                <span class="text-danger fs-8 peserta"></span>
                                            </div>

                                            <div class="d-flex flex-column gap-2 fv-row col-6">
                                                <label for="notulen">Notulensi</label>
                                                <input class="form-control form-control-sm" name="notulensi" accept=".pdf"
                                                    type="file" id="notulen" />
                                                <span class="text-danger fs-8 notulen"></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column gap-2">
                                            <label for="">Dokumentasi</label>
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
                                            <span class="text-danger fs-8 dokumentasi"></span>
                                        </div>

                                        <div class="d-flex flex-row gap-3 justify-content-end">
                                            <button class="btn btn-secondary">
                                                Reset
                                            </button>
                                            <button type="submit" id="savePraPemicu" class="btn btn-primary">
                                                <span class="indicator-label">Simpan</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle"></span></span>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="prapemicuan" role="tabpanel">
                                {{-- <form action="" class="d-flex flex-column gap-8">
                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Jumlah Dusun</label>
                                            <input type="text" placeholder="" class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Jumlah RW</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Jumlah RT</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Jumlah Jiwa</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Pendidikan warga</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Tidak sekolah</option>
                                                <option value="2">SD</option>
                                                <option value="2">SMP</option>
                                                <option value="2">SMA</option>
                                                <option value="2">S1</option>
                                                <option value="2">S2</option>
                                                <option value="2">S3</option>
                                            </select>
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Pekerjaan Masyarakat</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Kelembagaan Sosial</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Nama Tokoh</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Nomor Hp Tokoh</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Tradisi</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Dibakar</option>
                                                <option value="2">Dibuang Ke Sungai</option>
                                                <option value="2">Dibuang ke Lahan Kosong</option>
                                                <option value="2">Dibuang Ke Lubang Galian</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Kondisi Geografis</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Daratan</option>
                                                <option value="2">Perairan</option>
                                                <option value="3">Pantai</option>
                                                <option value="4">Pegunungan</option>
                                            </select>
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Sarpras Desa</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Pengelolaan Sampah</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Layanan desa</option>
                                                <option value="2">Layanan Swasta</option>
                                                <option value="3">Bank Sampah</option>
                                                <option value="4">Tidak ada layanan</option>
                                            </select>
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Sarpras Desa</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Kegiatan rutin</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Kerja Bakti</option>
                                                <option value="2">Pengajian</option>
                                                <option value="3">Posyandu</option>
                                                <option value="4">Pertemuan PKK</option>
                                                <option value="5">Kegiatan Desa</option>
                                            </select>
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Waktu Kegiatan</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Lokasi Pemicuan</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Kerja Bakti</option>
                                                <option value="2">Pengajian</option>
                                                <option value="3">Posyandu</option>
                                                <option value="4">Pertemuan PKK</option>
                                                <option value="5">Kegiatan Desa</option>
                                            </select>
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Lokasi D2D</label>
                                            <select name="kegiatan" class="form-select form-select-sm"
                                                data-control="select2" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="1">Kerja Bakti</option>
                                                <option value="2">Pengajian</option>
                                                <option value="3">Posyandu</option>
                                                <option value="4">Pertemuan PKK</option>
                                                <option value="5">Kegiatan Desa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 fv-row">
                                            <label for="">Tanggal Pemicuan</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-6 fv-row">
                                            <label for="">Jumlah Titik Pemicuan</label>
                                            <input type="text" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </form> --}}
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
    <script src="{{ asset('js/formpemicuan.js') }}"></script>
@endsection
