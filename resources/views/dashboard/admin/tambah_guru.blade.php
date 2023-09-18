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
        <h4 class="card-title">Tambah Guru Baru</h4>
        <p class="card-description">Isikan identitas guru baru</p>
        <form role="form" action="{{ asset('/dashboard/guru/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_guru">Nama Guru</label>
                <input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Isi Nama Guru" required>
            </div>
            <div class="form-group">
                <label for="alamat_guru">Alamat Guru</label>
                <textarea class="form-control" name="alamat_guru" id="alamat_guru" rows="4" required style="height: auto;" placeholder="Isi Alamat Guru"></textarea>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telp</label>
                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Isi No Telp" required>
            </div>
            <hr>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Isi Email" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Isi Password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Isi Ulang Password" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn text-white btn-primary me-2">Submit</button>
        </form>
    </div>
    </div>
</div>