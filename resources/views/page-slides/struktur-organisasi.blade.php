{{-- 
CARA KERJA HALAMAN INI:
1. tombol trigger untuk menampilkan modal yaitu pop up form
2. form yang muncul bisa diisi atau di close
3. submit form membawa value input ke route
4. di controller, file lama dihapus, sedangkan file baru disimpan di storage 
--}}

@php
    $menuId = "menu-struktur";
    $slideId = "slide-struktur";
@endphp

<li class="slider-item" id="slide-struktur">
    <div class="heading">
        <h1>STRUKTUR ORGANISASI</h1>
    </div>
    <div class="cd-half-width first-slide">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="content" width="100%">
                        <div class="box-body">
                            <!-- Trigger/Open The Modal -->
                            <?php
                            if (isLogin()){
                            ?>
                                <div class="btn-change-file">
                                    <button id="btn-update-struktur">
                                        <img id="img-icon" src="web/icon/bagan-white.svg" alt="" width="50px" height="50px">
                                        GANTI GAMBAR
                                    </button>
                                </div>
                            <?php
                            }?>
                            <div class="row">
                                
                                <div class="col-xs-12">
                                    @php
                                        $data = DB::select('SELECT file_path FROM files_storage WHERE code = "struktur-organisasi"');
                                        $firstElement = collect($data)->first();
                                        $filePath = $firstElement->file_path;

                                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        $contentType = getContentType($extension);
                                    @endphp

                                    {{-- akses file dengan storage:link --}}
                                    {{-- <img class="display-file" src="{{ asset('storage/'.$firstPath) }}" width="100%" alt=""> --}}

                                    {{-- akses file tanpa controller dan tanpa storage:link --}}
                                    <img class="display-file" src="data:{{ $contentType }};base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $filePath))) }}" style="width: 100%;">
                                    
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</li>


{{-- pop up START --}}
<!-- The Modal -->
<div id="struktur-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 95%">
        <span id="close-struktur-modal" class="close">&times;</span>
        <form class="auth-form" action="/update-struktur-organisasi" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="text-align: center; ">
                <h3>Update Struktur Organisasi</h3></div>
            <br><br>
            {{-- input file berupa image  --}}
            
            <div class="form-group">
                <input type="file" id="fileInput" 
                onchange="validateFile('img', 'fileInput', 'file-message', 'file-size', 'simpan-struktur')" 
                name="fileInput" accept="image/*">
                
                <p id="file-message" style="color: red; display: none;"></p>
                <p id="file-size" style="display: none;"></p>
                <label for="title" style="font-size: 12px;
                top: -10px;
                color: var(--color-2);">Gambar</label>
            </div>
            <br>

            {{-- hidden input for slide name, and menu name --}}
            <input type="text" style="display: none" name="menu-id" value="{{ $menuId }}">
            <input type="text" style="display: none" name="slide-id" value="{{ $slideId }}">
            
            <button id="simpan-struktur" name="simpan-struktur" type="submit">Simpan</button>
        </form>
        
    </div>

</div>
{{-- pop up END --}}

<script>
    // getModal(trigger, modal yang ditampilkan, tombol close x);
    getModal("btn-update-struktur", "struktur-modal", "close-struktur-modal");
</script>