<div class="col-lg-12 d-flex flex-column">
    <div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title card-title-dash">Data Sarana dan Prasarana</h4>
                    <p class="card-subtitle card-subtitle-dash">Total sarana dan prasarana: <b>{{ $sarpras->count() }}</b></p>
                </div>
                <div>
                    <a href="{{ asset('/dashboard/sarpras/tambah') }}"><button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Tambah Sarana dan Prasarana Baru</button></a>
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
                <table class="table select-table table-hover" id="sarpras">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Sarana dan Prasarana</th>
                            <th>Jumlah</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sarpras as $key => $s)
                        <tr>
                            <td><h6>{{ $key+1 }}</h6></td>
                            <td>
                                <h6>{{ $s->jenis_sarpras }}</h6>
                            </td>
                            <td>
                                <h6>{{ $s->jumlah }}</h6>
                            </td>
                            <td>
                                <a href="{{ asset('/dashboard/sarpras/edit/'.$s->id_sarpras) }}"><button type="button" class="btn btn-warning btn-rounded btn-fw text-white w-100">Edit</button></a>
                                <form role="form" action="{{ asset('/dashboard/sarpras/delete/'.$s->id_sarpras) }}" method="post" enctype="multipart/form-data">
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
                        $('#sarpras').DataTable();
                    } );
                </script>
                @endpush
            </div>
        </div>
        </div>
    </div>
    </div>
</div>