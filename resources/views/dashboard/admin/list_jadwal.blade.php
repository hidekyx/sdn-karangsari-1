<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Jadwal Guru - {{ $guru->nama }}</h4>
                    <p class="card-subtitle card-subtitle-dash">Total jadwal: <b>{{ $total_jadwal }}</b></p>
                </div>
                <div>
                    <a href="{{ asset('/dashboard/guru/jadwal/tambah/'.$guru->id_user) }}"><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-alarm-plus"></i>Tambah Jadwal Baru</button></a>
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
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwal as $key => $j)
                        <tr>
                            <td><h6>{{ $key+1 }}</h6></td>
                            <td>
                                <h6>{{ $j->kelas->nama_kelas }}</h6>
                            </td>
                            <td>
                                <h6>{{ $j->pelajaran->nama_pelajaran }}</h6>
                            </td>
                            <td>
                                <p>{{ $j->hari }}</p>
                            </td>
                            <td>
                                <h6>{{ $j->jam_mulai }}</h6>
                            </td>
                            <td>
                                <h6>{{ $j->jam_selesai }}</h6>
                            </td>
                            <td>
                                <a href="{{ asset('/dashboard/guru/jadwal/edit/'.$j->id_user.'/'.$j->id_jadwal) }}"><button type="button" class="btn btn-warning btn-rounded btn-fw text-white w-100">Edit</button></a>
                                <form role="form" action="{{ asset('/dashboard/guru/jadwal/delete/'.$j->id_user.'/'.$j->id_jadwal) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-rounded btn-fw text-white w-100">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>