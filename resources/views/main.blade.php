<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8" />
        <title>SDN Karang Sari 01 - Tangerang</title>
        <meta name="description" content="" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/assets/images/logo.png') }}" />
        <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/sal.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/magnific-popup.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/swiper.min.css') }}"  />
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/bootstrap-select.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/ico-fonts.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/odometer.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/style.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    </head>
    <body>

        @include('header')
        @if($page == "Home")
            @include('home.slider')
            <div style="background-image: url('{{ asset('storage/assets/images/bg/bg-yellow.jpg') }}'); background-size: cover;">
            @include('home.tentang_sekolah')
            @include('home.visi_misi')            
            </div>
            <div style="background-image: url('{{ asset('storage/assets/images/bg/buniess.jpg') }}'); background-size: cover;">
            @include('home.layanan')
            </div>
            <div style="background-image: url('{{ asset('storage/assets/images/bg/service-bg-two.jpg') }}'); background-size: cover;">
            @include('home.kegiatan')
            </div>
            <div style="background-image: url('{{ asset('storage/assets/images/bg/section-bg.jpg') }}'); background-size: cover;">
            @include('home.syarat')
            </div>
        @elseif($page == "Profil")
            @include('breadcrump')
            @if($subpage == "Identitas Sekolah")
                @include('profil.identitas')
            @elseif($subpage == "Profil Sekolah")
                @include('profil.profil')
            @elseif($subpage == "Sarana dan Prasarana")
                @include('profil.sarpras')
            @elseif($subpage == "Daftar Guru dan Karyawan")
                @include('profil.guru_list')
            @elseif($subpage == "Detail Guru dan Karyawan")
                @include('profil.guru_detail')
            @elseif($subpage == "Detail Siswa")
                @include('profil.siswa')
            @endif
        @endif
        @include('footer')
        @include('mobile_navigation')
        
        <div aria-hidden="true" id="search-modal" class="modal fade search-modal" role="dialog" tabindex="-1">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30px" height="30px">
                    <path
                        d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"
                    />
                </svg>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="scrollUp">
            <i class="icon-angle_right"></i>
        </div>
        <div class="boxfin-scroll-top progress-done">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 71.1186px;"></path>
            </svg>
            <div class="boxfin-scroll-top-icon">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="mdi:arrow-up" class="iconify iconify--mdi">
                    <path fill="currentColor" d="M13 20h-2V8l-5.5 5.5l-1.42-1.42L12 4.16l7.92 7.92l-1.42 1.42L13 8v12Z"></path>
                </svg>
            </div>
        </div>
    </body>
    <script src="{{ asset('storage/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/modernizr-2.8.3.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('storage/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('storage/assets/js/sal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="{{ asset('storage/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    @stack('scripts')
</html>