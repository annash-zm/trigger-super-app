@extends('layouts.master')
{{-- @extends('admin.static.sidebar') --}}
@extends('static.header')
@extends('static.footer')

@section('css')
    <style>
        .text-ellipsis {
            display: inline-block;
            width: 300px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
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
                        <a href="{{ route('fasilitator.listdesa') }}"><i class="ki-outline ki-black-left fs-1"></i></a>
                        <h3>
                            Form Hasil Pemicuan Desa {{ ucfirst(strtolower($desa['desa'])) }} <br>
                            <span class="fs-8 text-gray-500">Input hasil pemicuan</span>
                        </h3>
                    </div>

                    <div class="card-body">
                        <form id="hasilpemicuan" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $idPemicuan }}" id="idpemicuan" name="idpemicuan">
                            <div class="d-flex flex-column gap-5">
                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">RT</label>
                                        <input class="form-control form-control-sm" name="rt" placeholder="Input RT"
                                            id="rt" value="{{ !empty($data) ? $data['rt'] : '' }}" />
                                        <span class="text-danger fs-8 rt"></span>
                                    </div>

                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="kegiatan">RW</label>
                                        <input class="form-control form-control-sm" name="rw" placeholder="Input RW"
                                            id="rw" value="{{ !empty($data) ? $data['rw'] : '' }}" />
                                        <span class="text-danger fs-8 rw"></span>
                                    </div>
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <div class="row">
                                        <div class="d-flex flex-column gap-2 fv-row col-6">
                                            <label for="kegiatan">Jml Peserta Hadir</label>
                                            <input class="form-control form-control-sm" name="jml_peserta"
                                                value="{{ !empty($data) ? $data['jml_peserta'] : '' }}"
                                                placeholder="Jml Peserta Hadir" id="hadir" />
                                            <span class="text-danger fs-8 hadir"></span>
                                        </div>
                                        <div class="d-flex flex-column gap-2 fv-row col-6">
                                            <label for="kegiatan">Jml Berlangganan</label>
                                            <input class="form-control form-control-sm" name="jml_berlangganan"
                                                value="{{ !empty($data) ? $data['jml_berlangganan'] : '' }}"
                                                placeholder="Jml Peserta Berlangganan" id="jml_berlangganan" />
                                            <span class="text-danger fs-8 langganan"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column gap-2 fv-row col-12">
                                        <label for="peserta">Usulan Warga dalam RKM</label>
                                        <textarea name="usulan_rkm" class="form-control form-control-sm" id="" rows="3"
                                            placeholder="ex : kerja bakti, penutupan spot pembuangan sampah, sosialisasi, etc">{{ !empty($data) ? $data['usulan_rkm'] : '' }}</textarea>
                                        <span class="text-danger fs-8 usulan"></span>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="d-flex flex-column fv-row col-12">

                                        <label for="peserta">Input Berkas</label>
                                        <span class="fs-8 text-gray-500">*Daftar Hadir, kesediaan berlangganan, RKM dan
                                            catatan</span>
                                        @if (!empty($data))
                                            @php
                                                $berkas = json_decode($data['berkas']);
                                            @endphp
                                            <div class="mb-2 mt-2 text-danger">
                                                @foreach ($berkas as $file)
                                                    <div class="d-flex gap-1 align-items-center">
                                                        <i class="fa fa-file text-danger"></i>
                                                        <span class="text-ellipsis">
                                                            {{ $file->fileName }}
                                                        </span>
                                                        <a onclick="delFile('berkas', '{{ $file->fileId }}')"
                                                            href="javascript:void(0);"><i
                                                                class="fa fa-trash text-danger"></i></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <input class="form-control mt-2 form-control-sm" name="berkas[]"
                                            accept="application/pdf,image/*" type="file" id="berkas" multiple />
                                        <span class="text-danger fs-8 berkas"></span>
                                    </div>
                                    {{-- 
                                    <div class="d-flex flex-column gap-2 fv-row col-6">
                                        <label for="notulen">Catatan Kegiatan</label>
                                        <input class="form-control form-control-sm" name="notulensi" accept=".pdf"
                                            type="file" id="notulen" />
                                        <span class="text-danger fs-8 notulen"></span>
                                    </div> --}}
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <label for="">Dokumentasi</label>
                                    @if (!empty($data))
                                        @php
                                            $dokumentasi = json_decode($data['dokumentasi']);
                                        @endphp
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($dokumentasi as $foto)
                                                <div class="symbol symbol-25 d-flex flex-column gap-1">
                                                    <img src="{{ Storage::url('dokumentasi/' . $foto->fileId) }}"
                                                        alt="Foto" class="object-fit-cover">
                                                    <a onclick="delFile('dokumentasi', '{{ $foto->fileId }}')"
                                                        href="javascript:void(0);" class="text-center"><i
                                                            class="fa fa-trash text-danger text-center"></i></a>
                                                </div>
                                            @endforeach
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
                                    <span class="text-danger fs-8 dokumentasi"></span>
                                </div>

                                <div class="d-flex flex-row gap-3 justify-content-end">
                                    {{-- <button class="btn btn-secondary">
                                        Batal
                                    </button> --}}
                                    <button type="submit" id="saveHasilPemicuan" class="btn btn-primary">
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
    <script src="{{ asset('js/fasilitator.js') }}"></script>
@endsection
