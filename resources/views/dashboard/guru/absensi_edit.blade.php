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
                <h4 class="card-title card-title-dash">Edit Daftar kehadiran - {{ $jadwal->kelas->nama_kelas }}</h4>
                <table>
                    <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Tanggal</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ \Carbon\Carbon::parse($now)->isoFormat('dddd, D MMMM Y') }}</span></td>
                    </tr>
                    <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Pelajaran</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ $jadwal->pelajaran->nama_pelajaran }}</span></td>
                    </tr>
                    <tr>
                        <td><p class="card-subtitle card-subtitle-dash">Jam</p></td>
                        <td><span class="mx-2">:</span></td>
                        <td><span class="badge badge-opacity-warning">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span></td>
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
            <form role="form" action="{{ asset('/dashboard/absensi/update/'.$absensi->id_absensi) }}" method="post" enctype="multipart/form-data">
            @csrf
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
                            <div class="dropdown">
                                @if($d->status == "Hadir")
                                <select class="form-control btn-success text-white" name="kehadiran[{{ $d->id_siswa }}]" id="kehadiran-{{ $d->id_siswa }}" required>
                                @elseif($d->status == "Alpha")
                                <select class="form-control btn-danger text-white" name="kehadiran[{{ $d->id_siswa }}]" id="kehadiran-{{ $d->id_siswa }}" required>
                                @elseif($d->status == "Izin")
                                <select class="form-control btn-warning text-white" name="kehadiran[{{ $d->id_siswa }}]" id="kehadiran-{{ $d->id_siswa }}" required>
                                @elseif($d->status == "Sakit")
                                <select class="form-control btn-info text-white" name="kehadiran[{{ $d->id_siswa }}]" id="kehadiran-{{ $d->id_siswa }}" required>
                                @endif
                                    <option selected hidden value="{{ $d->status }}">{{ $d->status }}</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Alpha">Alpha</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            @if($d->status == "Hadir")
                            <input type="text" class="form-control" name="keterangan[{{ $d->id_siswa }}]" id="keterangan-{{ $d->id_siswa }}" placeholder="Isi Keterangan" disabled>
                            @else
                            <input type="text" class="form-control" name="keterangan[{{ $d->id_siswa }}]" id="keterangan-{{ $d->id_siswa }}" value="{{ $d->keterangan }}" placeholder="Isi Keterangan">
                            @endif
                        </td>
                        <td>
                            <div class="badge badge-opacity-primary">Hari ini</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <hr>
                <button type="submit" class="btn text-white btn-lg btn-primary me-2">Simpan Absensi</button>
            </form>
        </div>
        @push('scripts')
        <script>
            $('select').on('change', function() {
                var button_id = $(this).attr('id');
                var id = button_id.slice(10);
                var value = this.value;
                $('#kehadiran-' + id).removeClass('btn-success');
                $('#kehadiran-' + id).removeClass('btn-danger');
                $('#kehadiran-' + id).removeClass('btn-warning');
                $('#kehadiran-' + id).removeClass('btn-info');
                if(value == "Hadir") {
                    $('#kehadiran-' + id).addClass('btn-success');
                    $('#keterangan-' + id).attr('disabled', 'disabled');
                    $('#keterangan-' + id).val('').trigger('change');
                }
                else if(value == "Alpha") {
                    $('#kehadiran-' + id).addClass('btn-danger');
                    $('#keterangan-' + id).removeAttr('disabled');
                    $('#keterangan-' + id).val('Siswa alpha dalam kelas').trigger('change');
                }
                else if(value == "Izin") {
                    $('#kehadiran-' + id).addClass('btn-warning');
                    $('#keterangan-' + id).removeAttr('disabled');
                    $('#keterangan-' + id).val('Siswa izin atas keperluan tertentu').trigger('change');
                }
                else if(value == "Sakit") {
                    $('#kehadiran-' + id).addClass('btn-info');
                    $('#keterangan-' + id).removeAttr('disabled');
                    $('#keterangan-' + id).val('Siswa sakit dan tidak bisa hadir').trigger('change');
                }
            });
        </script>
        @endpush
        </div>
    </div>
    </div>
</div>
</div>