@push('style')
    <style>
        #card-ruangan-aset:hover {
            cursor: pointer;
            opacity: 0.85;
            background-color: rgba(57, 192, 237, 0.3);
        }
    </style>
@endpush
<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
    <a href="{{ url('list-aset-ruangan', $item->id) }}" id="card-ruangan-aset">
        <div class="card" id="card-ruangan-aset">
            <img class="card-img-top hover-shadow"
                src="{{ $item->fotoSampul && Storage::exists('upload/foto_ruangan/' . $item->fotoSampul->nama_file) ? Storage::url('upload/foto_ruangan/' . $item->fotoSampul->nama_file) : asset('/assets/img/blank_photo.png') }}"
                alt="Foto Ruangan" height="220em">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="card-title fw-bold">{{ $item->nama_ruangan }}</span>
                        <p class="card-text text-black">{{ $item->deskripsi }}</p>

                    </div>
                    <div>
                        <span class="badge badge-secondary shadow">
                            <p class="m-0">{{ $item->asetTidakBergerak->count() }}
                                Aset</p>
                        </span>

                    </div>
                </div>
            </div>

            {{-- <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div> --}}
        </div>
    </a>
</div>
