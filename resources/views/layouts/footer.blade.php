@php
    $contacts = DB::select("SELECT * FROM text_storage WHERE code = 'contacts'");
    $contacts = collect($contacts)->first()->value;

    function removeParagraphTags($content) {
        // Menghapus tag <p> dan </p> dari konten
        $content = str_replace(['<p>', '</p>'], '', $content);
        return $content;
    }
@endphp

{{-- <div class="btn-edit-trigger" >
    <button id="trigger-edit-profile">
        <img id="img-icon" src="{{ asset('web/icon/home-edit-white.svg') }}" alt="" width="50px" height="50px">
        Edit Kontak Admin
    </button>
</div> --}}

<footer>
    <p class="phone-size">Pemerintah Desa Ngadipiro, Kec. Nguntoronadi, Kab. Wonogiri &copy;  
        @php
            $tahunSaatIni = date('Y');
            echo $tahunSaatIni;
        @endphp  
        <br>
        <?php echo removeParagraphTags($contacts);?>
    </p>
    <p class="pc-size">Pemerintah Desa Ngadipiro, Kecamatan Nguntoronadi, Kabupaten Wonogiri &copy;  
        @php
            $tahunSaatIni = date('Y');
            echo $tahunSaatIni;
        @endphp  
        <br>
        <?php echo removeParagraphTags($contacts);?>
    </p>
</footer>
<script src="{{ asset('//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}"></script>
<script>
    window.jQuery || document.write('<script src="web/js/vendor/jquery-1.11.2.min.js"><\/script>')

</script>

<script src="{{ asset('web/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/js/plugins.js') }}"></script>
<script src="{{ asset('web/js/main.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('lib/adltefr/dist/js/app.js') }}"></script>

<!-- Script untuk berpindah ke halaman yang tepat jika ada update data -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek apakah ada session updated_menu
        var updatedMenuId = "{{ session('updated_menu') }}";
        var updatedSlideId = "{{ session('updated_slide') }}";

        if (updatedMenuId) {
            // Cari elemen li dengan id yang sesuai
            var menuLi = document.getElementById(updatedMenuId);
            var slideLi = document.getElementById(updatedSlideId);

            menuLi.classList.add('selected');
            slideLi.classList.add('selected');
        }else{
            var menuLi = document.getElementById('menu-profil');
            var slideLi = document.getElementById('slide-profil');

            menuLi.classList.add('selected');
            slideLi.classList.add('selected');
        }
    });
</script>
@if (session()->has('updated_slide'))
    @php
        session()->forget('updated_menu');
        session()->forget('updated_slide');
    @endphp
@endif
</body>

</html>