<div class="col-lg-12 d-flex flex-column">
<div class="row flex-grow">
    <div class="col-lg-8 col-md-12 grid-margin">
    <div class="card card-rounded">
        <div class="card-body">
        @if (Session::has('success'))
            <div role="alert" class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                <strong><i class="fa fa-exclamation-circle"></i>Berhasil!</strong>
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="d-sm-flex justify-content-between align-items-start">
            <div>
                <h4 class="card-title card-title-dash">Jadwal kelas hari ini</h4>
                <p class="card-subtitle card-subtitle-dash">Anda memiliki <span class="badge btn-info">{{ $jadwal_hari_ini->count() }}</span> jadwal kelas pada hari <span class="badge btn-info">{{ \Carbon\Carbon::parse($now)->isoFormat('dddd, D MMMM Y') }}</span></p>
            </div>
        </div>
        <div class="table-responsive  mt-1">
            <table class="table select-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari/Jam</th>
                        <th>Kelas/Pelajaran</th>
                        <th>Jadwal</th>
                        <th>Menu</th>
                        <th>Absensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal_hari_ini as $key => $j)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <h6>{{ $j->hari }}</h6>
                            <p>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</p>
                        </td>
                        <td>
                            <h6>{{ $j->kelas->nama_kelas }}</h6>
                            <p>{{ $j->pelajaran->nama_pelajaran }}</p>
                        </td>
                        <td>
                            @if($j->status == "Belum Mulai")
                            <div class="badge badge-opacity-warning" style="width: 150px;">Belum Mulai</div>
                            @elseif($j->status == "Sedang Berlangsung - Sudah Absen" || $j->status == "Sedang Berlangsung - Belum Absen")
                            <div class="badge badge-opacity-primary" style="width: 150px;">Sedang Berlangsung</div>
                            @elseif($j->status == "Sudah Selesai - Sudah Absen" || $j->status == "Sudah Selesai - Belum Absen")
                            <div class="badge badge-opacity-success" style="width: 150px;">Sudah Selesai</div>
                            @endif
                        </td>
                        <td>
                            @if($j->status == "Sedang Berlangsung - Belum Absen" || $j->status == "Sudah Selesai - Belum Absen")
                            <a href="{{ asset('/dashboard/absensi/create/'.$j->id_jadwal) }}" ><button type="button" class="btn btn-outline-primary btn-lg btn-fw mt-2" style="width: 200px;"><i class="mdi mdi-plus"></i>Mulai Absensi</button></a>
                            @elseif($j->status == "Sedang Berlangsung - Sudah Absen" || $j->status == "Sudah Selesai - Sudah Absen")
                            <a href="{{ asset('/dashboard/absensi/edit/'.$j->id_jadwal.'/'.$j->id_absensi) }}" ><button type="button" class="btn btn-outline-success btn-lg btn-fw mt-2" style="width: 200px;"><i class="mdi mdi-check"></i>Edit Absensi</button></a>
                            @elseif($j->status == "Belum Mulai")
                            -
                            @endif
                        </td>
                        <td>
                            @if($j->status == "Belum Mulai" || $j->status == "Sedang Berlangsung - Belum Absen" || $j->status == "Sudah Selesai - Belum Absen")
                            <div class="badge btn-danger" style="width: 150px;">Belum Absen</div>
                            @elseif($j->status == "Sedang Berlangsung - Sudah Absen" || $j->status == "Sudah Selesai - Sudah Absen")
                            <div class="badge btn-success" style="width: 150px;">Sudah Absen</div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>

    <div class="col-lg-4 col-md-12  grid-margin stretch-card">
    <div class="card card-rounded">
        <div class="card-body card-rounded">
        <h4 class="card-title  card-title-dash">Jadwal Kelas Bulan Ini</h4>
        @foreach($jadwal_bulan_ini as $key => $jb)
        @if($key < 7)
        <div class="list align-items-center border-bottom py-2 jadwal-bulanan" id="jadwal-{{ $key }}">
        @else
        <div class="list align-items-center border-bottom py-2 jadwal-bulanan" id="jadwal-{{ $key }}" style="display: none;">
        @endif
            <div class="wrapper w-100">
            <p class="mb-2 font-weight-medium">
                {{ $jb->kelas->nama_kelas }} ({{ $jb->pelajaran->nama_pelajaran }})
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-calendar text-muted me-1"></i>
                    <p class="mb-0 text-small" style="font-weight: bold;">{{ $jb->hari }}</p>
                    <i class="mx-2 mdi mdi-clock text-muted me-1"></i>
                    <p class="mb-0 text-small" style="font-weight: bold;">{{ $jb->jam_mulai }} - {{ $jb->jam_selesai }}</p>
                </div>
            </div>
            </div>
        </div>
        @endforeach
        <div class="list align-items-center pt-3">
            <div class="wrapper w-100">
            <p class="mb-0">
                <a href="#" class="fw-bold text-primary" id="tampilkan-jadwal">Tampilkan semua <i class="mdi mdi-arrow-right ms-2"></i></a>
            </p>
            </div>
        </div>
        </div>
    </div>
    </div>
    @push('scripts')
    <script>
        $('#tampilkan-jadwal').click(function() {
            $('.jadwal-bulanan').fadeIn();
            $('#tampilkan-jadwal').fadeOut();
        });
    </script>
    @endpush
</div>
</div>