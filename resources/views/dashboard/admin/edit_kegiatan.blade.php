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
        <h4 class="card-title">Edit Kegiatan</h4>
        <p class="card-description">Edit data kegiatan</p>
        <form role="form" action="{{ asset('/dashboard/kegiatan/update/'.$kegiatan->id_kegiatan) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Isi Judul kegiatan" value="{{ $kegiatan->judul }}" required>
            </div>
            <div class="form-group">
                <label for="judul">Gambar</label>
                <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar" placeholder="Piilh gambar kegiatan">
                <img src="{{ asset('/storage/kegiatan/'.$kegiatan->gambar) }}" id="preview" style="max-width: 400px;">
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="Isi Link kegiatan" value="{{ $kegiatan->link }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatan->tanggal }}" required>
            </div>
            <button type="submit" class="btn text-white btn-primary me-2">Submit</button>
        </form>
        @push('scripts')
        <script type="text/javascript">
        $('#gambar').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').hidden = false;
            };
            reader.readAsDataURL(this.files[0]);
        });
        </script>
        @endpush
    </div>
    </div>
</div>