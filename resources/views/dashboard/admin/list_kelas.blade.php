<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Kelas</h4>
                    <p class="card-subtitle card-subtitle-dash">Total kelas: <b>{{ $kelas->count() }}</b></p>
                </div>
            </div>
            <hr>
            @if (Session::has('success'))
                <div role="alert" class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                    <strong><i class="fa fa-exclamation-circle"></i>Berhasil!</strong>
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="table-responsive mt-1">
                <table class="table select-table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th colspan="100%">Jadwal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas as $key => $g)
                            <tr>
                                <td><h6>{{ $key+1 }}</h6></td>
                                <td><h6>{{ $g->nama_kelas }}</h6></td>
                                <td><h6>{{ $g->guru->nama }}</h6></td>
                                <td colspan="100%">
                                    <button type="button" class="btn btn-primary btn-rounded btn-fw text-white show-jadwal" id="show-{{ $g->id_kelas }}">Tampilkan</button>
                                    <button style="display: none;" type="button" class="btn btn-warning btn-rounded btn-fw text-white hide-jadwal" id="hide-{{ $g->id_kelas }}">Sembunyikan</button>
                                </td>
                            </tr>
                            <tr style="display: none;" id="head-{{ $g->id_kelas }}">
                                <th></th>
                                <th>Hari</th>
                                <th>Jam Pelajaran</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru Pengajar</th>
                            </tr>
                            <tbody style="display: none;" id="data-{{ $g->id_kelas }}">
                                @foreach($kelas[$key]->jadwal as $j)
                                <tr>
                                    <td></td>
                                    <td>
                                        @if($j->hari == "Senin")
                                            <div class="badge badge-success">{{ $j->hari }}</div>
                                        @elseif($j->hari == "Selasa")
                                            <div class="badge badge-primary">{{ $j->hari }}</div>
                                        @elseif($j->hari == "Rabu")
                                            <div class="badge badge-danger">{{ $j->hari }}</div>
                                        @elseif($j->hari == "Kamis")
                                            <div class="badge badge-warning">{{ $j->hari }}</div>
                                        @elseif($j->hari == "Jumat")
                                            <div class="badge badge-dark">{{ $j->hari }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                                    <td><h6>{{ $j->pelajaran->nama_pelajaran }}</h6></td>
                                    <td><h6>{{ $j->guru->nama }}</h6></td>
                                </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </tbody>
                    @push('scripts')
                    <script>
                    $('.show-jadwal').click(function () {
                        var button_id = $(this).attr('id');
                        var id = button_id.slice(5);
                        $('#show-' + id).hide();
                        $('#hide-' + id).show();
                        $('#head-' + id).show();
                        $('#data-' + id).show();
                    })
                    $('.hide-jadwal').click(function () {
                        var button_id = $(this).attr('id');
                        var id = button_id.slice(5);
                        $('#show-' + id).show();
                        $('#hide-' + id).hide();
                        $('#head-' + id).hide();
                        $('#data-' + id).hide();
                    })
                    </script>
                    @endpush
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>