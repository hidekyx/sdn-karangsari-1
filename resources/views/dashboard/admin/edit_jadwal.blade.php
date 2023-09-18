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
        <h4 class="card-title">Edit Jadwal</h4>
        <p class="card-description">Edit informasi data jadwal untuk guru - {{ $guru->nama }}</p>
        <form role="form" action="{{ asset('/dashboard/guru/jadwal/update/'.$jadwal->id_user.'/'.$jadwal->id_jadwal) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_kelas">Kelas</label>
                <select class="form-control" id="id_kelas" name="id_kelas" style="color:#000" required>
                    <option value="{{ $jadwal->id_kelas }}" selected hidden>{{ $jadwal->kelas->nama_kelas }}</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_pelajaran">Pelajaran</label>
                <select class="form-control" id="id_pelajaran" name="id_pelajaran" style="color:#000" required>
                    <option value="{{ $jadwal->id_pelajaran }}" selected hidden>{{ $jadwal->pelajaran->nama_pelajaran }}</option>
                    @foreach($pelajaran as $p)
                    <option value="{{ $p->id_pelajaran }}">{{ $p->nama_pelajaran }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_pelajaran">Hari</label>
                <select class="form-control" id="hari" name="hari" style="color:#000" required>
                    <option value="{{ $jadwal->hari }}" selected hidden>{{ $jadwal->hari }}</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn text-white btn-primary me-2">Submit</button>
        </form>
    </div>
    </div>
</div>