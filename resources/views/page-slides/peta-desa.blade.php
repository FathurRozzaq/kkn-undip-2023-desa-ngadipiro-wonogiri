@php
    $menuId = "menu-peta";
    $slideId = "slide-peta";
@endphp

<li class="slider-item" id="slide-peta">
    <div class="heading">
        <h1>PETA DESA</h1>
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
                                    <button id="trigger-ganti-peta">
                                        <img id="img-icon" src="web/icon/map-white.svg" alt="" width="50px" height="50px">
                                        GANTI PETA
                                    </button>
                                </div>
                            <?php
                            }?>
                            <div class="row">
                                <div class="col-xs-12">
                                    @php
                                        $data = DB::select('SELECT file_path FROM files_storage WHERE code = "peta-desa"');
                                        $firstElement = collect($data)->first();
                                        $filePath = $firstElement->file_path;
                                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        $contentType = getContentType($extension);
                                    @endphp

                                <img src="data:{{ $contentType }};base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $filePath))) }}" 
                                class="display-file" width="100%" height="auto" style="min-height: 800px;">
                                        
                                {{-- akses file dengan storage:link --}}
                                        {{-- @if ($extension === 'pdf')
                                        <embed class="display-file" src="{{ asset('storage/'.$firstElement->file_path) }}" type="application/pdf" width="100%" height="auto" style="min-height: 800px;">
                                        @else
                                        <img class="display-file" src="{{ asset('storage/'.$firstElement->file_path) }}" alt="Image">
                                        @endif --}}
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
<div id="peta-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 95%">
        <span id="close-peta-modal" class="close">&times;</span>
        <form class="auth-form" action="/update-peta" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <h3>Update Peta Desa</h3></div>
            <br><br>
            
            {{-- input file berupa pdf atau image  --}}
            <div class="form-group">
                <input type="file" id="file-peta" 
                onchange="validateFile('img', 'file-peta', 'message-peta', 'size-peta', 'simpan-peta')" 
                name="fileInput">

                <p id="message-peta" style="color: red; display: none;"></p>
                <p id="size-peta" style="display: none;"></p>
                <label for="title" style="font-size: 12px;
                top: -10px;
                color: var(--color-2);">Gambar</label>
            </div>
            
            <br>
            {{-- hidden input for slide name, and menu name --}}
            <input type="text" style="display: none" name="menu-id" value="{{ $menuId }}">
            <input type="text" style="display: none" name="slide-id" value="{{ $slideId }}">

            <button id="simpan-peta" name="simpan-peta" type="submit">Simpan</button>
        </form>
        
    </div>

</div>
{{-- pop up END --}}

<script>
    // getModal(trigger, modal yang ditampilkan, tombol close x);
    getModal("trigger-ganti-peta", "peta-modal", "close-peta-modal");
</script>