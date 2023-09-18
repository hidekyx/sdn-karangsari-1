<div class="col-lg-12 d-flex flex-column">
<div class="row flex-grow">
    <div class="col-lg-12 col-md-12 grid-margin">
    <div class="card card-rounded">
        <div class="card-body">
        @if(session('errors'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i><strong>Gagal!</strong>
                @foreach ($errors->all() as $error)
                <span class="text-sm">{{ $error }}</span>
                @endforeach
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-sm-flex justify-content-between align-items-start">
            <div>
                <h4 class="card-title card-title-dash">Detail Daftar Kehadiran - {{ $absensi->kelas->nama_kelas }}</h4>
                <table>
                <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Tanggal</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ \Carbon\Carbon::parse($absensi->created_at)->isoFormat('D MMMM Y') }}</span></td>
                    </tr>
                    <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Pelajaran</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ $absensi->pelajaran->nama_pelajaran }}</span></td>
                    </tr>
                    <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Jam</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ $absensi->jam_mulai }} - {{ $absensi->jam_selesai }}</span></td>
                    </tr>
                    <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Terakhir Disimpan</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ \Carbon\Carbon::parse($absensi->updated_at)->isoFormat('D MMMM Y - H:m') }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="table-responsive  mt-1">
                <table class="table select-table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kehadiran</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensi->detail as $d)
                    <tr>
                        <td>
                            <h6>{{ $d->siswa->nama_siswa }}</h6>
                            <p>{{ $d->siswa->kelas->nama_kelas }}</p>
                        </td>
                        <td>
                            @if($d->status == "Hadir")
                            <button class="btn btn-lg btn-success text-white mt-3 w-100">Hadir</button>
                            @elseif($d->status == "Alpha")
                            <button class="btn btn-lg btn-danger text-white mt-3 w-100">Alpha</button>
                            @elseif($d->status == "Izin")
                            <button class="btn btn-lg btn-warning text-white mt-3 w-100">Izin</button>
                            @elseif($d->status == "Sakit")
                            <button class="btn btn-lg btn-info text-white mt-3 w-100">Sakit</button>
                            @endif
                        </td>
                        <td>
                            <input type="text" class="form-control" value="{{ $d->keterangan }}" disabled>
                        </td>
                        <td>
                            <div class="badge badge-opacity-success">Sudah Tervalidasi</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <hr>
        </div>
        </div>
    </div>
    </div>
</div>
</div>