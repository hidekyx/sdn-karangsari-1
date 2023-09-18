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
        <h4 class="card-title">Edit Siswa - {{ $siswa->nama_siswa }}</h4>
        <p class="card-description">Edit identitas siswa</p>
        <form role="form" action="{{ asset('/dashboard/siswa/update/'.$siswa->id_siswa) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_kelas">Kelas</label>
                <select class="form-control" id="id_kelas" name="id_kelas" required>
                    <option value="{{ $siswa->id_kelas }}" selected hidden>{{ $siswa->kelas->nama_kelas }}</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Isi Nama Siswa" value="{{ $siswa->nama_siswa }}" required>
            </div>
            <div class="form-group">
                <label for="alamat_siswa">Alamat Siswa</label>
                <textarea class="form-control" name="alamat_siswa" id="alamat_siswa" rows="4" required style="height: auto;">{{ $siswa->alamat_siswa }}</textarea>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ $siswa->tanggal_lahir }}" required>
            </div>
            <button type="submit" class="btn text-white btn-primary me-2">Submit</button>
        </form>
    </div>
    </div>
</div>