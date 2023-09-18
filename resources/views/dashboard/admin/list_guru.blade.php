<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Guru</h4>
                    <p class="card-subtitle card-subtitle-dash">Total guru: <b>{{ $total_guru }}</b></p>
                </div>
                <div>
                    <a href="{{ asset('/dashboard/guru/tambah') }}"><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Tambah Guru Baru</button></a>
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
                            <th>Nama Guru</th>
                            <th>Email</th>
                            <th>Alamat Guru</th>
                            <th>No Telp</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guru as $key => $g)
                        <tr>
                            <td><h6>{{ $key+1 }}</h6></td>
                            <td>
                                <div class="d-flex">
                                <div>
                                    <h6>{{ $g->nama }}</h6>
                                    <p>{{ $g->kelas }}</p>
                                </div>
                                </div>
                            </td>
                            <td>
                                <h6>{{ $g->email }}</h6>
                            </td>
                            <td>
                                <p>{{ $g->alamat }}</p>
                            </td>
                            <td>
                                <h6>{{ $g->no_telp }}</h6>
                            </td>
                            <td>
                                <a href="{{ asset('/dashboard/guru/jadwal/list/'.$g->id_user) }}"><button type="button" class="btn btn-info btn-rounded btn-fw text-white w-100">Jadwal</button></a><br>
                                <a href="{{ asset('/dashboard/guru/edit/'.$g->id_user) }}"><button type="button" class="btn btn-warning btn-rounded btn-fw text-white w-100">Edit</button></a>
                                <form role="form" action="{{ asset('/dashboard/guru/delete/'.$g->id_user) }}" method="post" enctype="multipart/form-data">
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