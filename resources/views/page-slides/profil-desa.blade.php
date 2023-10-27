@php
    $menuId = "menu-profil";
    $slideId = "slide-profil";
@endphp

<li class="slider-item" id="slide-profil">
    <div class="heading">
        <h1>PROFIL DESA</h1>
    </div>
    <div class="cd-half-width first-slide">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content first-content">
                        <!-- Trigger/Open The Modal -->
                        <?php
                        if (isLogin()){
                        ?>
                            <div class="btn-change-file" style="translate: 0 10px">
                                <button id="trigger-edit-profile">
                                    <img id="img-icon" src="{{ asset('web/icon/home-edit-white.svg') }}" alt="" width="50px" height="50px">
                                    EDIT PROFIL
                                </button>
                            </div>
                        <?php
                        }?>
                        <div class="row display-file">
                            <style>
                                .col-md-6.left-image {
                                position: relative;
                                /* padding: 10px; */
                                }

                                .left-image img {
                                width: 100%;
                                display: block;
                                padding-bottom: 50px;
                                }
                                
                            </style>
                            @php
                                $image = DB::select('SELECT file_path FROM files_storage WHERE code = ?', ["profil"]);
                                $firstElement = collect($image)->first();
                                $imageValue = $firstElement->file_path;

                                $extension = pathinfo($imageValue, PATHINFO_EXTENSION);
                                $contentType = getContentType($extension);
                            @endphp
                            <div class="col-md-6 left-image">
                                
                                {{-- akses file dengan storage:link --}}
                                {{-- <img class="profile-image" src="{{ asset('storage/'.$imageValue) }}" style="width: 100%;"> --}}
                            
                                {{-- akses file tanpa controller dan tanpa storage:link --}}
                                <img class="profile-image" src="data:{{ $contentType }};base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $imageValue))) }}" style="width: 100%;">
                            </div>
                            
                            @php
                                $data = DB::select('SELECT value FROM text_storage WHERE code = "welcome"');
                                $firstElement = collect($data)->first();
                                $welcomeValue = $firstElement->value;
                            @endphp
                            
                            <div class="welcome-text justify-text normal-text">
                                <?php echo $welcomeValue;?>
                            </div>
                        </div>
                        <div class="row" >
                            <style>
                                .profil-text h1,
                                .profil-text h2,
                                .profil-text h3,
                                .profil-text h4,
                                .profil-text h5,
                                .profil-text h6
                                {
                                    text-align: center;
                                }
                            </style>
                            @php
                                $data = DB::select('SELECT value FROM text_storage WHERE code = "visi"');
                                $firstElement = collect($data)->first();
                                $visiValue = $firstElement->value;
                            @endphp
                            
                            <div class="normal-text profil-text">
                                <?php echo $visiValue;?>
                            </div>

                            @php
                                $data = DB::select('SELECT value FROM text_storage WHERE code = "misi"');
                                $firstElement = collect($data)->first();
                                $misiValue = $firstElement->value;
                            @endphp
                            <div class="normal-text profil-text justify-text">
                                <?php echo $misiValue;?>
                            </div>
                            
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>

{{-- BUAT LAYANAN pop up START --}}
<!-- The Modal -->
<div id="edit-profile-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 95%">
        <span id="close-edit-profile-modal" class="close">&times;</span>
        <form id="edit-profile-form" class="auth-form" action="/update-profile" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h3>Edit Profil</h3>
            </div>
            <br><br>
            {{-- input file berupa image  --}}

            <div class="form-group">
                <input type="file" id="profil-foto"
                    onchange="validateFile('img', 'profil-foto', 'message-profil-foto', 'size-profil-foto', 'simpan-profil')"
                    name="fileInput">

                <p id="message-profil-foto" style="color: red; display: none;"></p>
                <p id="size-profil-foto" style="display: none;"></p>
                <label for="profil-foto" style="font-size: 12px;
                top: -10px;
                color: var(--color-2);">Gambar</label>
            </div>
            <br>
            
            {{-- input SELAMAT DATANG --}}
            <div class="form-group">
                {{-- Quill editor container --}}
                <div class="editor-container">
                    <div id="welcome-text-editor"><?php echo $welcomeValue;?></div>
                    <textarea id="welcome-text-input" name="welcome-text-input" style="display: none;"></textarea>
                </div>
                <label class="active" for="welcome-text-editor">Teks Selamat Datang</label>
            </div>

            <br>

            {{-- input VISI --}}
            <div class="form-group">
                {{-- Quill editor container --}}
                <div class="editor-container">
                    <div id="visi-text-editor"><?php echo $visiValue;?></div>
                    <textarea id="visi-text-input" name="visi-text-input" style="display: none;"></textarea>
                </div>
                <label class="active" for="visi-text-editor">Teks Visi Desa</label>
            </div>

            <br>

            {{-- input MISI DAN KEBIJAKAN --}}
            <div class="form-group">
                {{-- Quill editor container --}}
                <div class="editor-container">
                    <div id="misi-text-editor"><?php echo $misiValue;?></div>
                    <textarea id="misi-text-input" name="misi-text-input" style="display: none;"></textarea>
                </div>
                <label class="active" for="misi-text-editor">Teks Misi dan Kebijakan Desa</label>
            </div>

            <br>
            {{-- input KONTAK ADMIN --}}
            @php
            $data = DB::select('SELECT value FROM text_storage WHERE code = "contacts"');
            $firstElement = collect($data)->first();
            $contactsValue = $firstElement->value;
            @endphp
            <div class="form-group">
                {{-- Quill editor container --}}
                <div class="editor-container">
                    <div id="kontak-text-editor"><?php echo $contactsValue;?></div>
                    <textarea id="kontak-text-input" name="kontak-text-input" style="display: none;"></textarea>
                </div>
                <label class="active" for="kontak-text-editor">Kontak Admin</label>
            </div>

            {{-- hidden input for slide name, and menu name --}}
            <input type="text" style="display: none" name="menu-id" value="{{ $menuId }}">
            <input type="text" style="display: none" name="slide-id" value="{{ $slideId }}">
            
            <button id="simpan-profil" name="simpan-profil" type="submit">Simpan</button>
        </form>

    </div>

</div>
{{-- BUAT LAYANAN pop up END --}}
<script>
    // getModal(trigger, modal yang ditampilkan, tombol close x);
    getModal("trigger-edit-profile", "edit-profile-modal", "close-edit-profile-modal");
    quillTextEditorInForm("welcome-text-editor", "edit-profile-form", "welcome-text-input");
    quillTextEditorInForm("visi-text-editor", "edit-profile-form", "visi-text-input");
    quillTextEditorInForm("misi-text-editor", "edit-profile-form", "misi-text-input");
    quillTextEditorInForm("kontak-text-editor", "edit-profile-form", "kontak-text-input");

</script>
