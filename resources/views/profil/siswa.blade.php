<section class="sc-team-details-area sc-pt-40 sc-md-pt-40 sc-pb-200 sc-md-pb-150">
    <div class="container">
        <div class="row clearfix">
            <div class="sc-team-content sc-pl-50 sc-md-pl-0 col-lg-12 sc-md-mt-45" data-sal="slide-left" data-sal-duration="800">
                <div class="inner-column">
                    <div class="row justify-content-center sc-pb-70">
                        <div class="error-text">
                            <div class="sc-heading-area text-center">
                                <span class="sub-title"><i class="icon-line"></i> Data Siswa</span>
                                <h3 class="title">Laporan <span class="primary-color italic">Absensi</span></h3>
                            </div>
                            <center><p>Anda dapat mengecek laporan absensi dengan menggunakan nama siswa.</p>
                            <div class="form-group">
                                <select class="selectpicker w-50" title="Cari Siswa" name="id_siswa" data-live-search="true" data-size="10">
                                    @php $id_kelas = null @endphp
                                    @foreach($siswa as $s)
                                        @if($id_kelas != $s->id_kelas)
                                            <option data-divider="true"></option>
                                        @endif
                                        @php $id_kelas = $s->id_kelas @endphp
                                        <option value="{{ $s->id_siswa }}" data-subtext="{{ $s->kelas->nama_kelas }}">{{ $s->nama_siswa }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="detail-siswa" style="display: none;">
                        <h3 class="skill-title" id="detail-nama"></h3>
                        <p class="mb-0" id="detail-kelas"></p>
                        <div>
                            <span>Tanggal Lahir : </span>
                            <span id="detail-lahir"></span>
                        </div>
                        <div class="mt-2">
                            <i class="icon-map"></i>
                            <span id="detail-alamat"></span>
                        </div>
                        <div class="table-responsive mt-1">
                            <table class="table select-table table-hover" id="sarpras">
                                <thead>
                                    <tr>
                                        <th>Hari/Tanggal</th>
                                        <th>Jam</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kehadiran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="laporan-absensi"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
    $('select').on('change', function() {
        var id = this.value;
        $.ajax({
            url: 'get-siswa-data/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                let data = res['siswa'];
                $('#detail-siswa').fadeIn();
                $('#detail-nama').html(data['nama_siswa']);
                $('#detail-kelas').html(data['kelas']['nama_kelas']);
                $('#detail-lahir').html(data['tanggal_lahir']);
                $('#detail-alamat').html(data['alamat_siswa']);
                $('#laporan-absensi tr').remove();
                $.each(data['absensi'], function(key, value) {   
                    if(value['detail']['status'] == "Hadir") {
                        $('#laporan-absensi').append("<tr><td><h6>" + value['tanggal'] + "</h6></td><td><p>" + value['jam_mulai'] + " - " + value['jam_selesai'] + "</p></td><td><h6>" + value['pelajaran']['nama_pelajaran'] + "</h6></td><td><span class='badge bg-success'>" + value['detail']['status'] + "</span></td><td><p>-</p></td></tr>");
                    }
                    else if(value['detail']['status'] == "Alpha") {
                        $('#laporan-absensi').append("<tr><td><h6>" + value['tanggal'] + "</h6></td><td><p>" + value['jam_mulai'] + " - " + value['jam_selesai'] + "</p></td><td><h6>" + value['pelajaran']['nama_pelajaran'] + "</h6></td><td><span class='badge bg-danger'>" + value['detail']['status'] + "</span></td><td><p>" + value['detail']['keterangan'] + "</p></td></tr>");
                    }
                    else if(value['detail']['status'] == "Izin") {
                        $('#laporan-absensi').append("<tr><td><h6>" + value['tanggal'] + "</h6></td><td><p>" + value['jam_mulai'] + " - " + value['jam_selesai'] + "</p></td><td><h6>" + value['pelajaran']['nama_pelajaran'] + "</h6></td><td><span class='badge bg-warning'>" + value['detail']['status'] + "</span></td><td><p>" + value['detail']['keterangan'] + "</p></td></tr>");
                    }
                    else if(value['detail']['status'] == "Sakit") {
                        $('#laporan-absensi').append("<tr><td><h6>" + value['tanggal'] + "</h6></td><td><p>" + value['jam_mulai'] + " - " + value['jam_selesai'] + "</p></td><td><h6>" + value['pelajaran']['nama_pelajaran'] + "</h6></td><td><span class='badge bg-info'>" + value['detail']['status'] + "</span></td><td><p>" + value['detail']['keterangan'] + "</p></td></tr>");
                    }
                });
            },
            error: function(res){
                $('#detail-siswa').fadeOut();
                $('#laporan-absensi tr').remove();
                alert('Data siswa tidak ditemukan!');
            }
        });
    });
</script>
@endpush