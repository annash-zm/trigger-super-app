@if (count($kegiatan) > 0)
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
                                    {{ $item['desa'] }}, {{ $item['district_name'] }}
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
    @if ($page != [])
        <div class="d-flex justify-content-between">
            <div class=""></div>
            <div class="">
                {{ $page->links() }}
            </div>
        </div>
    @endif
@else
    <span>- Data tidak ditemukan -</span>
@endif
