<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
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
        <h4 class="card-title">Tambah Sarana dan Prasarana Baru</h4>
        <p class="card-description">Isikan data sarana dan prasarana baru</p>
        <form role="form" action="{{ asset('/dashboard/sarpras/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="jenis_sarpras">Jenis</label>
                <input type="text" class="form-control" id="jenis_sarpras" name="jenis_sarpras" placeholder="Isi Jenis Sarana dan Prasarana" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah sarana dan prasarana" required>
            </div>
            <button type="submit" class="btn text-white btn-primary me-2">Submit</button>
        </form>
    </div>
    </div>
</div>