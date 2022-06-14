<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
    <div class="card">
        <div class="profile-picture pt-3" style="text-align: center">
            <div class="avatar avatar-xxl">
                <img class="avatar-img rounded-circle shadow-sm"
                    src="{{ $item->foto_profil != null && Storage::exists('upload/foto_profil/pegawai/' . $item->foto_profil) ? Storage::url('upload/foto_profil/pegawai/' . $item->foto_profil) : asset('assets/img/no-profile4.png') }}"
                    alt="Card image cap">
            </div>
        </div>
        <div class="card-body">
            <h5 class="fw-bold">{{ $item->nama_lengkap }}</h5>
            <h6 class="mb-4 text-muted fw-bold">NIP: {{ $item->nip }}</h6>
            <ul class="list-group list-group-flush mb-2 text-center">
                @foreach ($item->asetBergerak as $item2)
                    <li class="list-group-item py-2 fw-bold">
                        <span>
                            @if ($item2->status == 'Digunakan')
                                <i class="fas fa-circle text-secondary mr-1"></i>
                            @elseif ($item2->status == 'Rusak')
                                <i class="fas fa-circle text-danger mr-1"></i>
                            @elseif ($item2->status == 'Diperbaiki')
                                <i class="fas fa-circle text-warning mr-1"></i>
                            @endif
                            {{ $item2->nama_aset . ' ' . $item2->merek . ' ' . $item2->model }}
                        </span>
                        <span class="float-right ml-auto">
                            <button class="badge badge-primary shadow btn-lihat" data-toggle="tooltip"
                                data-placement="top" title="Lihat Aset" value="{{ $item2->id }}" data-button="lihat"
                                style="cursor: pointer"><i class="fas fa-eye"></i>
                            </button>
                            <a class="badge badge-warning ubah-status-aset" data-toggle="tooltip" data-placement="top"
                                title="Ubah Status Aset" value="{{ $item2->id }}"
                                data-status_aset="{{ $item2->status }}" data-id="{{ $item2->id }}"
                                style="cursor: pointer"><i class="fas fa-cogs"></i>
                            </a>
                            {{-- @if ($item2->status == 'Digunakan') --}}
                            <a href="{{ url('ubah-aset-pegawai', $item2->id) }}" class="badge badge-secondary shadow"
                                data-toggle="tooltip" data-placement="top" title="Pindahkan Aset"><i
                                    class="fas fa-share"></i></a>
                            {{-- @endif --}}
                        </span>
                    </li>
                @endforeach
            </ul>
            <div class="text-center">
            </div>
        </div>
    </div>
</div>