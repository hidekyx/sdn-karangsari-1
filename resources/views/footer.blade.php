<!--=========== Footer Section Start =========-->
<section class="sc-footer-section footer-bg-image1 sc-pt-120 sc-md-pt-80">
    <div class="container">
        <div class="row sc-pt-10 sc-pb-100 sc-md-pb-80">
            <div class="col-xl-4 col-lg-6 col-md-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="100">
                <div class="footer-about sc-md-mb-45">
                    <div class="footer-logo sc-mb-30">
                        <a href="#"><img src="{{ asset('storage/assets/images/logo.png') }}" alt="Foote Logo" /></a>
                    </div>
                    <p class="footer-des">
                        Sekolah Dasar Negeri Karang Sari 01 merupakan sekolah yang berada di Tangerang, Banten.
                    </p>
                    <div class="sc-contact-number border-style d-flex align-items-center">
                        <div class="phone-icon">
                            <div class="icon-whatsapp">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                        </div>
                        <div class="contact-number">
                            Hubungi Kami:
                            <a href="https://wa.me/+6281295527392" target="_blank" class="number">+62 812-9552-7392</a>
                        </div>
                    </div>
                    <div class="social-media mt-4">
                        <ul class="about-icon">
                            <li>
                                <a href="https://www.instagram.com/sdnkarangsari1kotatangerang/" target="_blank"><i class="icon-intragram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 sc-xs-mt-40" data-sal="slide-up" data-sal-duration="500" data-sal-delay="200">
                <div class="footer-menu-area sc-pl-35 sc-md-pl-40 sc-sm-mb-0">
                    <h4 class="footer-title white-color sc-md-mb-15">Alamat</h4>
                    <p>Marsekal Surya Dharma Komplek TNI AU RT 002/006. Kel, Karang Sari. Kec, Neglasari. Kota Tangerang</p>
                </div>
                <div class="footer-menu-area sc-pl-35 sc-md-pl-40 sc-sm-mb-0">
                    <h4 class="footer-title white-color sc-md-mb-15">Peta Sekolah</h4>
                    <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.824659914988!2d106.6336819!3d-6.1542328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f8b234109fe7%3A0xac186bb6f8b92c44!2sSdn%20Karang%20Sari%2001!5e0!3m2!1sen!2sid!4v1691985698959!5m2!1sen!2sid" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 sc-sm-mt-40" data-sal="slide-up" data-sal-duration="500" data-sal-delay="300">
                <div class="footer-menu-area sc-footer-recent footer-menu-area-left sc-pl-35 sc-blg-pl-15 sc-lg-pl-0 sc-sm-pt-30">
                    <h4 class="footer-title white-color sc-md-mb-15">Kegiatan Terbaru</h4>
                    @foreach ($kegiatan as $k)
                        <div class="sc-recent-post d-flex align-items-center sc-mb-25">
                            <div class="recent-image">
                                <a href="{{ $k->link }}" target="_blank"><img src="{{ asset('/storage/kegiatan/'.$k->gambar) }}" style="max-height: 140px;" alt="Recent"/></a>
                            </div>
                            <div class="recent-text">
                                <div class="calender-item">
                                    <span class="post-date">{{ \Carbon\Carbon::parse($k->tanggal)->isoFormat('DD MMMM YYYY')}}</span>
                                </div>
                                <h5 class="title mb-0">
                                    <a href="{{ $k->link }}" target="_blank">{{ $k->judul }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text text-center">
                        <p>© 2023 <a href="#" target="_blank"> SDN Karang Sari 01, </a> All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>