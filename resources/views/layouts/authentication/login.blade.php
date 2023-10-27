<!-- Trigger/Open The Modal -->
<?php
if (isLogin()){
?>
{{-- <button class="btn-nav" id="logout-btn">LOGOUT</button> --}}
<a href="/logout" class="a-nav">LOGOUT</a>
@include('css.style-is-login')
<?php
}else if(isLoginUser()){?>
<a href="/logout" class="a-nav">LOGOUT</a>
<?php
}else{
?>
<button class="btn-nav" id="login-btn">LOGIN</button>
<?php
}?>

{{-- Login pop up START --}}
<!-- The Modal -->
<div id="login-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 350px">
        <span id="close-login-modal" class="close">&times;</span>
        <form class="auth-form" action="/login" method="POST">
            @csrf
            <h3>Login</h3>
            <br>
            <div class="form-group">
                <input type="text" id="username" name="username" required @if (session('fail')=='login' )
                    value={{ session('username') }} @endif>
                <label for="username" @if (session('fail')=='login' ) class="active" @endif>Email atau Username</label>
            </div>
            <style>
                #show-password-btn {
                    border: none;
                    background: none;
                    margin-top: -20px;
                    translate: 110px -30px;
                }

                .visibility-icon {
                    height: 10px;
                }

            </style>

            <div class="form-group">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
                {{-- <button type="button" id="show-password-btn"><img class="visibility-btn" src="web/icon/eye.svg" alt=""></button> --}}
            </div>
            <button type="button" id="show-password-btn"><img id="visibility-icon" class="visibility-icon"
                    src="{{ asset('web/icon/eye.svg') }}" alt=""></button>

            {{-- Menampilkan pesan kesalahan setelah salah login --}}
            @if (session('fail') == 'login')
            <p class="warning-text" style="color: red; translate: -40px -20px;">
                Username dan password tidak sesuai!</p>
            <style>
                #login-modal {
                    display: block;
                }

            </style>
            <?php
                // Menghapus session 'fail' setelah menampilkan pesan kesalahan
                session()->forget('fail');
                ?>
            @endif

            <a href="#" id="forget-password-btn" style="color: var(--color-4); translate: -85px -20px">Lupa
                password?</a>
            <button type="submit">Login</button>
        </form>
    </div>

</div>
{{-- Login pop up END --}}

{{-- Register pop up START --}}
<!-- The Modal -->
<div id="register-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 350px">
        <span id="close-register-modal" class="close">&times;</span>
        <form class="auth-form" action="/register" method="POST">
            @csrf
            <h3>Buat Akun</h3>
            <br>
            <div class="form-group">
                <input type="text" id="username" name="username" required 
                @if (session('fail') == 'register') value={{ session('username') }} @endif>
                <label for="username" 
                @if (session('fail') == 'register') class="active" @endif
                >Username</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" required 
                @if (session('fail') == 'register') value={{ session('email') }} @endif>
                <label for="email" 
                @if (session('fail') == 'register') class="active" @endif
                >Email</label>
            </div>
            
            <div class="form-group">
                <input type="password" id="password-input-3" name="password" required>
                <label for="password" >Password</label>
                
            </div>
            <button type="button" class="show-password-btn" id="show-password-btn-3"><img id="visibility-icon-3" class="visibility-icon" src="{{ asset('web/icon/eye.svg') }}" alt=""></button>

            {{-- Menampilkan pesan kesalahan setelah salah login --}}
            @if (session('fail') == 'register')
                @if (session('not-available') == 'username')
                    <p class="warning-text" style="color: red; text-align:left">Username tidak tersedia. Silakan ganti username.</p>    
                    <style>
                        #register-modal{
                            display: block;
                        }
                    </style>    
                @endif
                @if (session('not-available') == 'email')
                    <p class="warning-text" style="color: red;">Email tidak tersedia. Silakan ganti email.</p>    
                    <style>
                        #register-modal{
                            display: block;
                        }
                    </style>    
                @endif
                <?php
                // Menghapus session 'fail' setelah menampilkan pesan kesalahan
                session()->forget('fail');
                session()->forget('not-available');
                ?>
            @endif
            
            {{-- <a href="#" id="forget-password-btn" style="color: var(--color-4); translate: -85px -20px">Lupa password?</a> --}}
            <button type="submit">Buat Akun</button>
        </form>
    </div>

</div>
{{-- Register pop up END --}}

{{-- Forget Password pop up START --}}
<!-- The Modal -->
<div id="forget-password-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 350px">
        <span id="close-password-modal" class="close">&times;</span>
        <form class="auth-form" action="/send-code" method="POST">
            @csrf
            <h3>Lupa Password</h3>
            <br>
            <p>Silakan masukan email Anda. Kode akan dikirimkan ke email tersebut.</p>

            <div class="form-group">
                <input type="email" id="email" name="email" required>
                <label for="email">email</label>
            </div>
            {{-- Menampilkan pesan kesalahan setelah salah input email --}}
            @if (session('not-found') == 'email')
            <p class="warning-text" style="color: red; translate: -65px -20px;">Email tidak ditemukan!</p>
            <style>
                #forget-password-modal {
                    display: block;
                }

            </style>
            <?php
              // Menghapus session 'email' setelah menampilkan pesan kesalahan
              session()->forget('not-found');
              ?>
            @endif
            
            <button type="submit">Kirim Kode</button>
        </form>
    </div>

</div>
{{-- Forget Password pop up END --}}

{{-- Verifikasi pop up START --}}

@if (session()->has('kode'))
<style>
    #verifikasi-modal {
        display: block;
    }
</style>
@endif
<!-- The Modal -->
<div id="verifikasi-modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" style="width: 350px">
        <span id="close-verifikasi-modal" class="close">&times;</span>
        <form class="auth-form" action="/verify-user" method="POST">
            @csrf
            <h3>Verifikasi Pengguna</h3>
            <br>
            <p>Silakan cek kotak masuk atau spam di email Anda. Kemudian, masukan kode verifikasi yang dikirimkan ke email Anda.</p>

            <div class="form-group">
                <input type="text" id="kode" name="kode" required 
                oninput="checkKode('kode', 'kode-salah', 'submit-kode')">
                <label for="kode">kode</label>
            </div>
            {{-- Menampilkan pesan kesalahan setelah salah input email --}}
            <p id="kode-salah" class="warning-text" style="color: red; display:none;">
                Kode yang Anda masukan salah!</p>
            <button id="submit-kode" type="submit" disabled>Kirim Kode</button>
        </form>
    </div>
</div>
{{-- Verifikasi pop up END --}}


{{-- Verifikasi user forget password pop up START --}}
@if (session()->has('kode-forget-password'))
<style>
    #verifikasi-forget-password-modal {
        display: block;
    }
</style>
@endif
<!-- The Modal -->
<div id="verifikasi-forget-password-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 350px">
        <span id="close-verifikasi-forget-password-modal" class="close">&times;</span>
        
        <div class="auth-form">
            <h3>Verifikasi Pengguna</h3>
        <br>
        <p>Silakan cek kotak masuk atau spam di email Anda. Kemudian, masukan kode verifikasi yang dikirimkan ke email
            Anda.</p>
            <div class="form-group">
                <input type="text" id="kode-input" required 
                oninput="checkKode('kode-input', 'kode-input-salah', 'ganti-password-trigger')">
                <label for="kode">kode</label>
            </div>
            {{-- Menampilkan pesan kesalahan setelah salah input email --}}
            <p id="kode-input-salah" class="warning-text" style="color: red; display:none;">
                Kode yang Anda masukan salah!</p>
            <button id="ganti-password-trigger" class="trigger" disabled>Kirim Kode</button>    
        </div>
        
    </div>
</div>
{{-- Verifikasi user forget password pop up END --}}

{{-- Ganti Password pop up START --}}
<!-- The Modal -->
<div id="ganti-password-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 350px">
        <span id="close-ganti-password-modal" class="close">&times;</span>
        <form class="auth-form" action="/ganti-password" method="POST">
            @csrf
            <h3>Ganti Password</h3>
            <br>
            <div class="form-group">
                <input type="text" required disabled value={{ session('email') }}>
                <label for="username" class="active">Email</label>
            </div>
            
            <div class="form-group">
                <input type="password" id="input-new-password" name="password" required>
                <label for="password">Password Baru</label>
                {{-- <button type="button" id="show-password-btn"><img class="visibility-btn" src="web/icon/eye.svg" alt=""></button> --}}
            </div>
            
            <button type="button" class="show-password-btn" id="show-new-password-btn">
                <img id="show-new-password-icon" class="visibility-icon" 
                src="{{ asset('web/icon/eye.svg') }}" alt="">
            </button>

            <button type="submit">Login</button>
        </form>
    </div>

</div>
{{-- Ganti Password pop up END --}}
<script>
    // Fungsi untuk memeriksa kesamaan kode
    function checkKode(inputId, warningId, submitId) {
        var inputKode = document.getElementById(inputId).value;
        var sessionKode = "{{ session('kode')? session('kode') : session('kode-forget-password') }}"; // Mengambil nilai kode dari session menggunakan Blade syntax
        
        var warningText = document.getElementById(warningId);
        var submitBtn = document.getElementById(submitId);

        // Memeriksa kesamaan kode
        if (inputKode !== sessionKode) {
            // Jika kode tidak sama, tampilkan pesan kesalahan
            warningText.style.display = 'block';
            submitBtn.disabled = true;
        } else {
            // Jika kode sama, sembunyikan pesan kesalahan (jika sebelumnya ditampilkan)
            warningText.style.display = 'none';
            submitBtn.disabled = false;
        }
    }
</script>

<button id="verifikasi-btn" style="display: none;">Verifikasi Registrasi</button>
<button id="verifikasi-forget-password-btn" style="display: none;">Verifikasi Forget</button>
<script>
    function display(modal) {
        modal.style.display = "block";
    }

    function hide(modal) {
        modal.style.display = "none";
    }

    // script untuk pop up. Parameter ketiga disesuaikan dengan urutan penggunaan class 'close'
    getModal("login-btn", "login-modal", "close-login-modal");
    getModal("forget-password-btn", "forget-password-modal", "close-password-modal");

    getModal("verifikasi-btn", "verifikasi-modal", "close-verifikasi-modal");
    getModal("verifikasi-forget-password-btn", "verifikasi-forget-password-modal", "close-verifikasi-forget-password-modal");
    getModal("ganti-password-trigger", "ganti-password-modal", "close-ganti-password-modal");
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function handleInputFocus() {
        var inputValue = $(this).val().trim();
        var label = $(this).siblings("label");

        if (inputValue !== "") {
            label.addClass("active");
        } else {
            label.removeClass("active");
        }
    }

    function showPassword() {
        var passwordInput = $("#password");
        var passwordFieldType = passwordInput.attr("type");
        var visibilityIcon = $("#visibility-icon");

        if (passwordFieldType === "password") {
            passwordInput.attr("type", "text");
            visibilityIcon.attr("src", "{{ asset('web/icon/eye-slashed.svg') }}");
            visibilityIcon.css("height", "15px"); // Menggunakan .css() untuk mengubah properti CSS
        } else {
            passwordInput.attr("type", "password");
            visibilityIcon.attr("src", "{{ asset('web/icon/eye.svg') }}");
            visibilityIcon.css("height", "10px"); // Menggunakan .css() untuk mengubah properti CSS
        }
    }

    $(document).ready(function () {
        // Fungsi untuk mengatur class label berdasarkan status input


        // Panggil fungsi saat halaman dimuat dan input mendapat fokus atau kehilangan fokus
        $("input[type='text'], input[type='password'], input[type='email']").on("focus", handleInputFocus);
        $("input[type='text'], input[type='password'], input[type='email']").on("blur", handleInputFocus);

        // Panggil fungsi showPassword() saat tombol "Show Password" diklik
        $("#show-password-btn").on("click", showPassword);

        $("#show-new-password-btn").on("click", function() {
            seePassword("#input-new-password","#show-new-password-icon");
        }); 
    });
</script>
