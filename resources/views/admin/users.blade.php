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
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <span class="fw-bolder d-flex align-items-center">
                            <a href="{{ route('admin') }}"><i class="ki-outline ki-black-left fs-1"></i></a>
                            {{ $title }}
                        </span>
                        <div class="">
                            <a href="javascript:void(0);" onclick="openFormUser('pendamping')"
                                class="btn btn-sm btn-primary mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-plus me-1"></i>
                                    Add User
                                </div>
                            </a>
                        </div>
                    </div>
                    @if (count($users) > 0)
                        @foreach ($users as $item)
                            <div class="card border border-gray-300">
                                <div class="d-flex p-3">
                                    <div class="symbol symbol-75px me-5">
                                        <img alt="Logo" src="{{ asset('images/blank.png') }}" />
                                    </div>
                                    <div class="d-flex flex-column justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-inline-block text-truncate align-items-center fs-5"
                                                style="max-width: 150px">
                                                {{ $item->name }}
                                            </div>
                                            <a href="#"
                                                class="fw-semibold text-muted text-hover-primary text-truncate fs-7"
                                                style="max-width: 150px">
                                                {{ $item->email }}
                                            </a>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <a href="javascript:void(0);"
                                                onclick="editUser('{{ Crypt::encrypt($item->id) }}')">
                                                <i class="ki-outline ki-user-edit fs-1"></i>
                                            </a>
                                            <a href="javascript:void(0);"
                                                onclick="hapusUser('{{ Crypt::encrypt($item->id) }}')">
                                                <i class="ki-outline ki-trash fs-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        echo $formUser;
    @endphp
@endsection

@section('js')
    <script src="{{ asset('js/users.js') }}"></script>
@endsection
