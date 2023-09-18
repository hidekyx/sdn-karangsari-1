<div class="sc-team-slider-pages-area sc-pt-100 sc-md-pt-75 sc-pb-100 sc-md-pb-80" data-sal="fade-in" data-sal-duration="800">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="sc-heading-area sc-mb-20 text-center">
                    <h2 class="title">
                        Jadwal <span class="primary-color italic">Guru</span> dan Karyawan
                    </h2>
                </div>
            </div>
        </div>
        <div class="swiper sc-blog-slider">
            <div class="swiper-wrapper">
                @foreach($guru as $g)
                <div class="swiper-slide">
                    <div class="sc-pages-text-area text-center">
                        <div class="sc-team-pages-content-box">
                            <a href="#"><img src="{{ asset('storage/assets/images/'.$g->foto) }}" alt="Teem"/></a>
                            <div class="sc-slider-item">
                                <div class="sc-slider-text">
                                    <h4>
                                        <a class="title" href="#">{{ $g->nama }}</a>
                                    </h4>
                                    <span class="sub-title">Guru {{ $g->pelajaran['nama_pelajaran'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="sc-slider-btn">
                            <a class="sc-white-btn-two detail-guru" id="detail-{{ $g->id_user }}" href="#detail-section">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('.detail-guru').click(function() {
        var button_id = $(this).attr('id');
        var id = button_id.slice(7);
        $.ajax({
            url: 'get-guru-data/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                let data = res['guru'];
                let url = "{{ asset('storage/assets/images/') }}";
                $('#detail-section').fadeIn();
                $('#jadwal-pelajaran tr').remove();
                $('#detail-foto').attr('src', url + "/" + data['foto']);
                $('.detail-nama').html(data['nama']);
                $('.detail-pelajaran').html('Guru ' + data['pelajaran']['nama_pelajaran']);
                $('#detail-email').html(data['email']);
                $('#detail-telp').html(data['no_telp']);
                $('#detail-alamat').html(data['alamat']);
                $.each(data['jadwal'], function(key, value) {   
                    $('#jadwal-pelajaran').append("<tr><td><h6>" + value['hari'] + "</h6></td><td><p>" + value['jam_mulai'] + " - " + value['jam_selesai'] + "</p></td><td><h6>" + value['kelas']['nama_kelas'] + "</h6></td><td><h6>" + value['pelajaran']['nama_pelajaran'] + "</h6></td></tr>");
                });
            },
            error: function(res){
                $('#detail-section').fadeOut();
                $('#jadwal-pelajaran tr').remove();
                alert('Data guru tidak ditemukan!');
            }
        });
    });
</script>
@endpush

<section class="sc-team-details-area sc-pt-40 sc-md-pt-40 sc-pb-200 sc-md-pb-150" id="detail-section" style="display: none;">
    <div class="container">
        <div class="row clearfix">
            <div class="sc-details-social col-lg-5 md-mb-50" data-sal="slide-right" data-sal-duration="800">
                <div class="inner-column">
                    <div class="image">
                        <img id="detail-foto" src="#" alt="" />
                    </div>
                    <div class="team-content text-center">
                        <h3 class="team-title title-color detail-nama"></h3>
                        <div class="text detail-pelajaran"></div>
                    </div>
                    <ul class="personal-info sc-pt-20">
                        <li class="email">
                            <i class="icon-mail"></i>
                            <span id="detail-email"></span>
                        </li>
                        <li class="phone">
                            <i class="icon-phone"></i>
                            <span id="detail-telp"></span>
                        </li>
                        <li class="map">
                            <i class="sc-mr-10 icon-map"></i>
                            <span id="detail-alamat"></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sc-team-content sc-pl-50 sc-md-pl-0 col-lg-7 sc-md-mt-45" data-sal="slide-left" data-sal-duration="800">
                <div class="inner-column">
                    <h2 class="detail-nama"></h2>
                    <p class="sc-mb-30 detail-pelajaran"></p>
                    <div class="team-skill">
                        <h3 class="skill-title">Jadwal Kelas:</h3>
                        <div class="table-responsive mt-1">
                            <table class="table select-table table-hover" id="sarpras">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                    </tr>
                                </thead>
                                <tbody id="jadwal-pelajaran"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>