@include('css.chat')
<li class="selected">
    <div class="heading">
        {{-- <h1>Diskusi</h1> --}}
    </div>
    <div class="cd-half-width first-slide">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="content" width="100%">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="discussion-text">
                                    {{-- ambil data komentar artikel terkait --}}
                                    <div >
                                        <h4 style="margin-bottom: -10px;">Diskusi tentang</h4>
                                        <h3 >"{{ $title }}"</h3>
                                    </div>
                                    <style>
                                        /* .admin-section .dropdown{
                                            display: block;
                                        }

                                        .user-section .my-comment .dropdown{
                                            display: block;
                                        } */

                                        .user-section .others-comment .dropdown{
                                            display: none;
                                        }
                                    </style>
                                    <div class="comment-section {{ (session('role') == 1)? 'admin-section' : 'user-section' }}">

                                        {{-- komentar dari admin
                                        komentar user yang login
                                        komentar user lain --}}
                                        <?php
                                        foreach ($comments as $key => $item) {
                                        ?>
                                        <div class="comment-row {{ ($item->user_id == session('id'))? 'my-comment' : 'others-comment' }}">
                                            <!-- Tombol dropdown -->
                                            <div class="comment-value">
                                                <div class="comment-label {{ ($item->user_role == 1)? 'adminname' : 'username' }}">
                                                    <div>
                                                        <u><b>{{ $item->username }}</b></u> <i>{{ date('d-m-Y, \p\u\k\u\l H:i', strtotime($item->time)) }} WIB</i>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="dropdown-button" id="dropdown-button-{{ $key }}" 
                                                            onclick="toggleDropdown('dropdown-content-{{ $key }}')">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <!-- Konten dropdown -->
                                                        <div class="dropdown-content" id="dropdown-content-{{ $key }}">
                                                            <div class="dropdown-option"><a href="/delete-comment/{{ $item->comment_id }}">Hapus</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>{{ $item->comment_value }}</p>
                                            </div>
                                        </div>
                                        <script>
                                            // Event listener untuk klik di luar dropdown content
                                            document.addEventListener('click', function(event) {
                                                var targetElement = event.target;
                                                // Menggunakan ID tombol dropdown untuk menemukan elemen yang sesuai
                                                var dropdownButton = document.getElementById('dropdown-button-{{ $key }}');
                                                var dropdownContent = document.getElementById('dropdown-content-{{ $key }}');

                                                // Memeriksa apakah tombol dropdown atau dropdown content yang diklik
                                                var isDropdownButtonClicked = dropdownButton.contains(targetElement);
                                                var isDropdownContentClicked = dropdownContent.contains(targetElement);

                                                // Jika dropdown content tidak sedang ditampilkan dan bukan tombol dropdown yang diklik, sembunyikan dropdown content
                                                if (!isDropdownContentClicked && !isDropdownButtonClicked) {
                                                    dropdownContent.style.display = 'none';
                                                }
                                            });
                                        </script>
                                        <?php
                                        }
                                        ?>
                                        
                                        <br><br><br>
                                        <script>
                                            function toggleDropdown(content) {
                                                // Mengambil element konten dropdown berdasarkan ID
                                                var dropdownContent = document.getElementById(content);
                                    
                                                // Memeriksa apakah konten dropdown sedang ditampilkan atau tidak
                                                if (dropdownContent.style.display === 'block') {
                                                    // Jika sedang ditampilkan, sembunyikan konten dropdown
                                                    dropdownContent.style.display = 'none';
                                                } else {
                                                    // Jika tidak ditampilkan, tampilkan konten dropdown
                                                    dropdownContent.style.display = 'block';
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</li>

@if (session('display') == 'login')
    <style>
        #login-modal{
            display: block;
        }
    </style>
    @php
        session()->forget('display');
    @endphp
@endif
{{-- footer --}}
<br><br>
<div class="chat-footer">
    @if (isLogin() || isLoginUser())
    <form id="create-comment-form" action="/send-comment" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="chat-input">
            <input type="text" name="id-layanan" value="{{ $idLayanan }}" style="display: none">
            <input type="text" name="id-user" value="{{ session('id') }}" style="display: none">

            <input type="text" name="comment-value" placeholder="Tulis pesan..." oninput="checkInput(this)">
            <button type="submit" disabled><i class="fas fa-paper-plane"></i></button>
        </div>

    </form>
    @else
    <div>
        Silakan <button class="btn-nav" id="login-btn-2">Login</button>
        atau <button class="btn-nav" id="register-btn">Buat Akun</button> untuk berkomentar.
    </div>
    @endif

    {{-- Footer dan kontak admin --}}
    @php
    $contacts = DB::select("SELECT * FROM text_storage WHERE code = 'contacts'");
    $contacts = collect($contacts)->first()->value;

    function removeParagraphTags($content) {
    // Menghapus tag <p> dan </p> dari konten
    $content = str_replace(['<p>', '</p>'], '', $content);
    return $content;
    }
    @endphp

    <p class="pc-size">DesaConnect, Website Desa Ngadipiro, Kecamatan Nguntoronadi, Kabupaten Wonogiri
        <br>
        <?php echo removeParagraphTags($contacts);?>
    </p>
    <p class="phone-size">DesaConnect, Desa Ngadipiro, Nguntoronadi, Wonogiri
        <br>
        <?php echo removeParagraphTags($contacts);?>
    </p>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    getModal("login-btn-2", "login-modal", "close-login-modal");
    getModal("register-btn", "register-modal", "close-register-modal");

    $(document).ready(function() {
    
        // Panggil fungsi showPassword() saat tombol "Show Password" diklik
        
        $("#show-password-btn-3").on("click", function() {
            seePassword("#password-input-3","#visibility-icon-3");
        });
    });
</script>


{{-- tombol scroll to top dan scroll to bottom --}}
<div class="scroll-buttons">
    <button class="scroll-to-top"><i class="fas fa-arrow-up"></i></button>
    <button class="scroll-to-bottom"><i class="fas fa-arrow-down"></i></button>
</div>


<style>
    .scroll-buttons {
    position: fixed;
    bottom: 17%;
    right: 30px;
    z-index: 9999;
    display: flex; /* Tambahkan display flex untuk mengatur posisi tombol secara horizontal */
    flex-direction: column; /* Atur tata letak tombol secara vertikal */
}

.scroll-buttons button {
    background-color: var(--color-1);
    color: black;
    border: none;
    padding: 5px 0 5px 8px;
    border-radius: 50%;
    cursor: pointer;
    margin: 5px;
}


/* Tambahkan style tambahan jika diperlukan */


</style>

<script>
    // Tombol "Scroll to Top"
    const scrollToTopButton = document.querySelector('.scroll-to-top');
    scrollToTopButton.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Tombol "Scroll to Bottom"
    const scrollToBottomButton = document.querySelector('.scroll-to-bottom');
    scrollToBottomButton.addEventListener('click', () => {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    });

    // Menyembunyikan atau menampilkan tombol "Scroll to Top" dan "Scroll to Bottom" berdasarkan posisi scroll
    function handleScroll() {
        const scrollY = window.scrollY;
        const windowHeight = window.innerHeight;
        const bodyHeight = document.body.clientHeight;
        const documentHeight = document.documentElement.scrollHeight;

        if (scrollY > 0) {
            scrollToTopButton.style.display = 'block';
        } else {
            scrollToTopButton.style.display = 'none';
        }

        if (scrollY + windowHeight < documentHeight) {
            scrollToBottomButton.style.display = 'block';
        } else {
            scrollToBottomButton.style.display = 'none';
        }
    }

    // Panggil fungsi handleScroll() saat halaman dimuat dan saat melakukan scroll
    window.addEventListener('load', handleScroll);
    window.addEventListener('scroll', handleScroll);
</script>

@include('js.disable-form-button')