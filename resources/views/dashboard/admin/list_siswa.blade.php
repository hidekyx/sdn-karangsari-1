<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Siswa</h4>
                    <p class="card-subtitle card-subtitle-dash">Total siswa: <b>{{ $total_siswa }}</b></p>
                </div>
                <div>
                    <a href="{{ asset('/dashboard/siswa/tambah') }}"><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Tambah Siswa Baru</button></a>
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
                <table class="table select-table table-hover" id="siswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama/Kelas</th>
                            <th>Alamat Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $key => $s)
                        <tr>
                            <td><h6>{{ $key+1 }}</h6></td>
                            <td>
                                <div class="d-flex">
                                <div>
                                    <h6>{{ $s->nama_siswa }}</h6>
                                    <p>{{ $s->kelas->nama_kelas }}</p>
                                </div>
                                </div>
                            </td>
                            <td>
                                <p>{{ $s->alamat_siswa }}</p>
                            </td>
                            <td>
                                <h6>{{ \Carbon\Carbon::parse($s->tanggal_lahir)->isoFormat('D MMMM Y')}}</h6>
                            </td>
                            <td>
                                <a href="{{ asset('/dashboard/siswa/edit/'.$s->id_siswa) }}"><button type="button" class="btn btn-warning btn-rounded btn-fw text-white w-100">Edit</button></a>
                                <form role="form" action="{{ asset('/dashboard/siswa/delete/'.$s->id_siswa) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-rounded btn-fw text-white w-100">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @push('scripts')
                <script>
                    $(document).ready( function () {
                        $('#siswa').DataTable();
                    } );
                </script>
                @endpush
            </div>
        </div>
        </div>
    </div>
    </div>
</div>