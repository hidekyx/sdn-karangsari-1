<div class="sc-blog-section-area sc-pt-120 sc-pb-80" id="kegiatan">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sc-heading-area sc-mb-55 text-center">
                    <span class="sub-title"><i class="icon-line"></i> Informasi</span>
                    <h2 class="title">Highlight <span class="primary-color italic">Kegiatan</span></h2>
                </div>
            </div>
        </div>
        <div class="swiper sc-blog-slider">
            <div class="swiper-wrapper">
                @foreach($kegiatan as $key => $k)
                <div class="swiper-slide" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="sc-blog-style2" >
                        <div class="blog-img">
                            <a href="{{ $k->link }}" target="_blank"><img src="{{ asset('/storage/kegiatan/'.$k->gambar) }}" alt="Blog"/></a>
                        </div>
                        <div class="sc-blog-date-box">
                            <div class="sc-date-box">
                                <h4 class="title">{{ \Carbon\Carbon::parse($k->tanggal)->isoFormat('DD')}}</h4>
                                <span class="sub-title">{{ \Carbon\Carbon::parse($k->tanggal)->isoFormat('MMM')}}</span>
                            </div>
                        </div>
                        <div class="sc-blog-text">
                            <h4>
                                <a class="title" href="{{ $k->link }}" target="_blank">{{ $k->judul }}</a>
                            </h4>
                            <div class="sc-blog-btn">
                                <a class="sc-transparent-btn" href="{{ $k->link }}" target="_blank">Baca kegiatan</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>