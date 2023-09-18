<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Kegiatan</h4>
                    <p class="card-subtitle card-subtitle-dash">Total kegiatan: <b>{{ $kegiatan->count() }}</b></p>
                </div>
                <div>
                    <a href="{{ asset('/dashboard/kegiatan/tambah') }}"><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-plus"></i>Tambah Kegiatan Baru</button></a>
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
                <table class="table select-table table-hover" id="kegiatan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Dokumentasi</th>
                            <th>Link</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatan as $key => $k)
                        <tr>
                            <td><h6>{{ $key+1 }}</h6></td>
                            <td><h6>{{ \Carbon\Carbon::parse($k->tanggal)->isoFormat('D MMMM Y')}}</h6></td>
                            <td><h6>{{ $k->judul }}</h6></td>
                            <td><img src="{{ asset('/storage/kegiatan/'.$k->gambar) }}" style="min-height: 200px; width: auto; object-fit: cover;"></td>
                            <td><a href="{{ $k->link }}" target="_blank">Menuju link</a></td>
                            <td>
                                <a href="{{ asset('/dashboard/kegiatan/edit/'.$k->id_kegiatan) }}"><button type="button" class="btn btn-warning btn-rounded btn-fw text-white w-100">Edit</button></a>
                                <form role="form" action="{{ asset('/dashboard/kegiatan/delete/'.$k->id_kegiatan) }}" method="post" enctype="multipart/form-data">
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
                        $('#kegiatan').DataTable();
                    } );
                </script>
                @endpush
            </div>
        </div>
        </div>
    </div>
    </div>
</div>