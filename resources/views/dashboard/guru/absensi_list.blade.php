<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Absensi oleh guru: {{ $logged_user->nama }}</h4>
                    <p class="card-subtitle card-subtitle-dash">Total laporan data absensi: <b>{{ $absensi->count() }}</b></p>
                </div>
            </div>
            <table>
                <tr>
                    <td><p class="card-subtitle card-subtitle-dash">Status Kehadiran</p></td>
                    <td>:</td>
                    <td>
                        <span class="badge bg-success mx-1">Hadir</span>
                        <span class="badge bg-danger mx-1">Alpha</span>
                        <span class="badge bg-warning mx-1">Izin</span>
                        <span class="badge bg-info mx-1">Sakit</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <hr>
            @if (Session::has('success'))
                <div role="alert" class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                    <strong><i class="fa fa-exclamation-circle"></i>Berhasil!</strong>
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="table-responsive mt-1">
                <table class="table select-table table-hover" id="absensi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal/Jam Absensi</th>
                            <th>Jadwal</th>
                            <th>Kelas/Pelajaran</th>
                            <th>Kehadiran</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $key => $a)
                        <tr>
                            <td><h6>{{ $key+1 }}</h6></td>
                            <td>
                                <h6>{{ \Carbon\Carbon::parse($a->updated_at)->isoFormat('D MMMM Y')}}</h6>
                                <p>{{ \Carbon\Carbon::parse($a->updated_at)->isoFormat('H:m:s')}}</p>
                            </td>
                            <td>
                                <h6>{{ $a->hari }}</h6>
                                <p>{{ $a->jam_mulai }} - {{ $a->jam_selesai }}</p>
                            </td>
                            <td>
                                <h6>{{ $a->kelas->nama_kelas }}</h6>
                                <p>{{ $a->pelajaran->nama_pelajaran }}</p>
                            </td>
                            <td>
                                <div>
                                    <div class="justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        Hadir: <span class="text-success" style="font-weight: bold;">{{ $a->jumlah_hadir }}</span><br>
                                        Alpha: <span class="text-danger" style="font-weight: bold;">{{ $a->jumlah_alpha }}</span><br>
                                        Izin: <span class="text-warning" style="font-weight: bold;">{{ $a->jumlah_izin }}</span><br>
                                        Sakit: <span class="text-info" style="font-weight: bold;">{{ $a->jumlah_sakit }}</span><br>
                                        Total: <span class="text-black" style="font-weight: bold;">{{ $a->kelas->siswa->count() }}</span><br>
                                    </div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $a->persentase_hadir }}%"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $a->persentase_alpha }}%"></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $a->persentase_izin }}%"></div>
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $a->persentase_sakit }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ asset('/dashboard/absensi/detail/'.$a->id_absensi) }}"><button type="button" class="btn btn-primary btn-rounded btn-fw text-white mt-3 w-100">Detail</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @push('scripts')
                <script>
                    $(document).ready( function () {
                        $('#absensi').DataTable();
                    } );
                </script>
                @endpush
            </div>
        </div>
        </div>
    </div>
    </div>
</div>