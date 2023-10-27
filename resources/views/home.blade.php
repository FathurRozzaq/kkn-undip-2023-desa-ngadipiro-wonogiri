@include('layouts.header')
@include('functions')

        <div class="cd-slider-nav">
            <nav><span class="cd-marker item-1"></span>
                <ul>
                    <li id="menu-profil" name="menu-profil"><a href="#0">
                            <div class="image-icon"><img src="web/img/ico-home.png" style="scale: 0.9"></div>
                            <h6>PROFIL DESA</h6>
                        </a>
                    </li>
                    <li id="menu-struktur" name="menu-struktur"><a href="#0">
                            <div class="image-icon"><img src="web/img/ico-bagan.png" style="scale: 1.3"></div>
                            <h6>STRUKTUR</h6>
                        </a>
                    </li>
                    <li id="menu-peta" name="menu-peta"><a href="#0">
                            <div class="image-icon"><img src="web/img/ico-map.png" style="scale: 0.9"></div>
                            <h6>PETA DESA</h6>
                        </a>
                    </li>
                    <li id="menu-layanan" name="menu-layanan"><a href="#0">
                            <div class="image-icon"><img src="web/img/ico-layanan.png" style="scale: 0.8"></div>
                            <h6>LAYANAN DESA</h6>
                        </a>
                    </li>
                    {{-- setiap 10 detik tambahkan dan hapus class 'selected' pada pasangan elemen berikut secara bergantian.
                    misal, tambah class 'selected' pada menu-struktur dan slide-struktur. 
                    10 detik kemudian, hapus class 'selected' pada menu-struktur dan slide-struktur, 
                    tambah class 'selected' pada menu-peta dan slide-peta
                    
                    menu-struktur 
                    slide-struktur

                    menu-peta 
                    slide-peta

                    menu-layanan 
                    slide-layanan

                    menu-profil 
                    slide-profil --}}
                    {{-- <li><a href="#0">
                            <div class="image-icon"><img src="web/img/icon-umkm.png" style="scale: 0.8"></div>
                            <h6>DATA UMKM</h6>
                        </a>
                    </li> --}}
                    <?php
                    if (isLogin()){
                    ?>
                    {{-- <li><a href="#0">
                        <div class="image-icon"><img src="web/img/ico-penduduk.png" style="scale: 0.7;"></div>
                        <h6>DATA PENDUDUK</h6>
                        </a>
                    </li> --}}
                    <?php
                    }?>
                    
                </ul>
            </nav>
        </div> <!-- .cd-slider-nav -->
        <ul class="cd-hero-slider">
            @include('page-slides.profil-desa')
            @include('page-slides.struktur-organisasi')
            @include('page-slides.peta-desa')
            {{-- @include('page-slides.data-umkm') --}}
            @include('page-slides.layanan-desa')
            <?php
            if (isLogin()){
            ?>
                {{-- @include('page-slides.data-penduduk') --}}
            <?php
            }?>
        </ul> <!-- .cd-hero-slider -->
    </section> <!-- .cd-hero -->

    @include('layouts.footer')