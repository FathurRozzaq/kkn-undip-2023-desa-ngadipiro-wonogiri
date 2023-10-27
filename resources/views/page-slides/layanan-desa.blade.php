@php
use Carbon\Carbon;
$menuId = "menu-layanan"; //apabila ada update data pada halaman dalam menu dan slide ini, menuId dan slideId digunakan di script untuk menampilkan halaman tersebut
$slideId = "slide-layanan";
@endphp

<li class="slider-item normal-text" id="slide-layanan">
    <div class="heading">
        <h1>LAYANAN DESA <a href="/refresh-layanan" style="color: var(--color-2);"><i class="fas fa-sync-alt"></i></a></h1> 
    </div>
    <div class="cd-half-width fourth-slide">
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
                                <button id="trigger-buat-layanan">
                                    <img id="img-icon" src="web/icon/plus-icon-white.svg" alt="" width="50px"
                                        height="50px">
                                    BUAT BARU
                                </button>
                            </div>
                            <?php
                        }?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <style>
                                        .list-layanan {
                                            display: flex;
                                            flex-wrap: wrap;
                                            gap: 20px;
                                            align-items: center;
                                        }

                                        .list-layanan .item {
                                            display: flex;
                                            /* align-items: center; */
                                            max-width: 100%;
                                            margin: 0 auto;
                                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                            
                                            /* Add shadow */
                                        }

                                        .list-layanan .item img {
                                            flex: 0 0 20%;
                                            max-width: 96%;
                                        }

                                        .list-layanan .image {
                                            text-align: center;
                                        }

                                        .list-layanan .paragraph {
                                            flex: 0 0 75%;
                                            padding-right: 30px;
                                            padding-left: 10px;
                                            text-align: left;
                                        }

                                        .list-layanan .text {
                                            translate: 0 -20px;
                                        }

                                        @media screen and (max-width: 768px) {
                                            .list-layanan .item {
                                                flex-direction: column;
                                            }

                                            .list-layanan .item img {
                                                flex: 0 0 20%;
                                                width: 100%;
                                            }

                                            .list-layanan .text {
                                                flex: 1 1 auto;
                                            }

                                            .list-layanan .tanggal table {
                                                display: none;
                                            }
                                        }
                                    </style>
                                    <div class="list-layanan display-file">
                                        {{-- 
                                            atur query select layanan dengan limit 
                                            limit ditentukan dengan session limit_layanan.
                                            nilai awal adalah 10.
                                            klik tombol selanjutnya menjadi 20, dst.
                                            
                                            --}}
                                        <?php
                                        $limit = session()->has('limit_layanan') ? session('limit_layanan') : 10;
                                        $data = DB::select("SELECT *,
                                            DATE_FORMAT(updated, CONCAT('%d ', 
                                            CASE MONTH(updated)
                                                WHEN 1 THEN 'Januari'
                                                WHEN 2 THEN 'Februari'
                                                WHEN 3 THEN 'Maret'
                                                WHEN 4 THEN 'April'
                                                WHEN 5 THEN 'Mei'
                                                WHEN 6 THEN 'Juni'
                                                WHEN 7 THEN 'Juli'
                                                WHEN 8 THEN 'Agustus'
                                                WHEN 9 THEN 'September'
                                                WHEN 10 THEN 'Oktober'
                                                WHEN 11 THEN 'November'
                                                WHEN 12 THEN 'Desember'
                                            END,
                                            ' %Y, %H:%i WIB') ) AS updated_formatted
                                            FROM layanan_desa ORDER BY updated DESC LIMIT ?;
                                        ", [$limit]);
                                        $dataCopy = $data;
                                        foreach ($data as $key => $value) {
                                            $filePath = $value->image;
                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                            $contentType = getContentType($extension);
                                        ?>
                                        
                                        <div class="item" style="width: 100%; padding-bottom: 5px;">
                                            <div class="image">
                                                {{-- <img src="{{ asset('storage/'.$value->image) }}" alt=""> --}}
                                                {{-- akses file tanpa controller dan tanpa storage:link --}}
                                                <img src="data:{{ $contentType }};base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $filePath))) }}">
                                            </div>

                                            <div class="paragraph" 
                                            style="display: flex;
                                            flex-direction: column;
                                            justify-content: space-between;">
                                                <style>
                                                    .quill-text img {
                                                        min-width: 100px;
                                                        max-width: 300px;
                                                    }
                                                    .quill-text a{
                                                        text-decoration: underline;
                                                    }

                                                </style>
                                                <div class="text quill-text">
                                                    <h3>
                                                        {{ $value->title }}
                                                    </h3>
                                                    <div class="content-text" style="text-align: justify">
                                                        <?php echo $value->description ?>
                                                    </div>
                                                </div>

                                                <div class="date-text" style="text-align: right;">
                                                    
                                                    @php
                                                        $commentCount = DB::select("SELECT COUNT(*) count FROM comments_storage WHERE id_layanan = ?",[$value->id]);
                                                        $commentCount = collect($commentCount)->first()->count;
                                                    @endphp
                                                    <div class="comment-btn" style="display: flex; justify-content: space-between;">
                                                        <a class="pc-size" href="/discussion/{{ $value->id }}" 
                                                            style="color: var(--color-4);"> {{-- border: 1px solid var(--color-4); border-radius: 20px; padding: 3px 3px 0 3px --}}
                                                            <i class="fas fa-comments" style="scale: 1.2"></i>
                                                            Komentar
                                                            <b style="color: white; background: red; padding: 3px 10px 3px 10px; border-radius: 20px;">{{ $commentCount }}</b>
                                                        </a> 
                                                        <a class="phone-size" href="/discussion/{{ $value->id }}" 
                                                            style="color: var(--color-4);"> {{-- border: 1px solid var(--color-4); border-radius: 20px; padding: 3px 3px 0 3px --}}
                                                            <i class="fas fa-comments" style="scale: 1"><b style="color: white; background: red; padding: 3px 10px 3px 10px; border-radius: 20px;">{{ $commentCount }}</b></i>
                                                        </a> 
                                                        <p>Diperbarui: {{ $value->updated_formatted }} </p>
                                                    </div>
                                                    
                                                    <?php
                                                    if (isLogin()){?>
                                                    <button class="btn-edit" id="trigger-edit-{{ $key }}">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </button>

                                                    <button class="btn-delete" id="trigger-delete-{{ $key }}">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>

                                                    <?php
                                                    }?>
                                                </div>
                                            </div>

                                        </div>

                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    
                                    @if ($limit <= session('count_layanan'))
                                    
                                    <br>
                                        <div style="text-align: center;">
                                            <a href="/next"
                                            style="font-size: 16px; text-decoration: underline;">
                                                Selanjutnya<i class="fas fa-chevron-down"></i>
                                            </a>
                                        </div>
                                    @endif
                                    
                                </div>

                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</li>

{{-- BUAT LAYANAN pop up START --}}
<!-- The Modal -->
<div id="buat-layanan-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="width: 95%">
        <span id="close-buat-layanan-modal" class="close">&times;</span>
        <form id="buat-layanan-form" class="auth-form" action="/buat-layanan" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h3>Buat Layanan Baru</h3>
            </div>
            <br><br>
            {{-- input file berupa image  --}}

            <div class="form-group">
                <input type="file" id="file-sampul"
                    onchange="validateFile('img', 'file-sampul', 'message-sampul', 'size-sampul', 'simpan-layanan')"
                    name="fileInput">

                <p id="message-sampul" style="color: red; display: none;"></p>
                <p id="size-sampul" style="display: none;"></p>
                <label for="title" style="font-size: 12px;
                top: -10px;
                color: var(--color-2);">Gambar</label>
            </div>
            <br>
            {{-- Input field for title --}}
            <div class="form-group">
                <input type="text" id="title" name="title" required>
                <label for="title" style="font-size: 12px;
                top: -10px;
                color: var(--color-2);">Judul</label>
            </div>
            <br>
            <div class="form-group">
                {{-- Quill editor container --}}
                <div class="editor-container">
                    <div id="description-layanan-editor"></div>
                    <textarea id="hidden-input" name="description-layanan" style="display: none;"></textarea>
                </div>
                <label class="active" for="description-layanan-editor">Deskripsi</label>
            </div>

            <br>

            {{-- hidden input for slide name, and menu name --}}
            <input type="text" style="display: none" name="menu-id" value="{{ $menuId }}">
            <input type="text" style="display: none" name="slide-id" value="{{ $slideId }}">

            <button id="simpan-layanan" name="simpan-layanan" type="submit">Simpan</button>
        </form>

    </div>

</div>
{{-- BUAT LAYANAN pop up END --}}

<?php
foreach ($dataCopy as $key => $value) {?>
{{-- EDIT LAYANAN pop up START --}}    
    <!-- The Modal -->
    <div id="edit-layanan-modal-{{ $key }}" class="modal">
        <!-- Modal content -->
        <div class="modal-content" style="width: 95%">
            <span id="close-edit-layanan-modal-{{ $key }}" class="close">&times;</span>
            <form id="edit-layanan-form-{{ $key }}" class="auth-form" action="/edit-layanan/{{ $value->id }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h3>Edit Layanan</h3>
                </div>
                <br><br>
                {{-- input file berupa image  --}}

                <div class="form-group">
                    <input type="file" id="file-sampul-{{ $key }}"
                        onchange="validateFile('img', 'file-sampul-{{ $key }}', 'message-sampul-{{ $key }}', 'size-sampul-{{ $key }}', 'simpan-layanan-{{ $key }}')"
                        name="fileInput">

                    <p id="message-sampul-{{ $key }}" style="color: red; display: none;"></p>
                    <p id="size-sampul-{{ $key }}" style="display: none;"></p>
                    <label for="title" style="font-size: 12px;
                                top: -10px;
                                color: var(--color-2);">Gambar</label>
                </div>
                <br>
                {{-- Input field for title --}}
                <div class="form-group">
                    <input type="text" id="title-{{ $key }}" name="title" required value="{{ $value->title }}">
                    <label for="title" style="font-size: 12px;
                                top: -10px;
                                color: var(--color-2);">Judul</label>
                </div>
                <br>
                <div class="form-group">
                    {{-- Quill editor container --}}
                    <div class="editor-container">
                        <div id="description-layanan-editor-{{ $key }}"><?php echo $value->description?></div>
                        <textarea id="hidden-input-{{ $key }}" name="description-layanan" style="display: none;"></textarea>
                    </div>
                    <label class="active" for="description-layanan-editor">Deskripsi</label>
                </div>

                <br>

                {{-- hidden input for slide name, and menu name --}}
                <input type="text" style="display: none" name="menu-id" value="{{ $menuId }}">
                <input type="text" style="display: none" name="slide-id" value="{{ $slideId }}">
                
                <button id="simpan-layanan-{{ $key }}" name="simpan-layanan" type="submit">Simpan</button>
            </form>

        </div>
    </div>
{{-- EDIT  LAYANAN pop up END --}}
{{-- HAPUS LAYANAN pop up START --}}    
    <!-- The Modal -->
    <div id="delete-layanan-modal-{{ $key }}" class="modal">
        <!-- Modal content -->
        <div class="modal-content" style="width: 350px">
            <span id="close-delete-layanan-modal-{{ $key }}" class="close">&times;</span>
            <form id="delete-layanan-form-{{ $key }}" class="auth-form" action="/delete-layanan/{{ $value->id }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <h3>Hapus Layanan</h3>
                </div>
                <br>
                <p>{{ $value->title." akan dihapus." }}</p>
                <br>
                {{-- hidden input for slide name, and menu name --}}
                <input type="text" style="display: none" name="menu-id" value="{{ $menuId }}">
                <input type="text" style="display: none" name="slide-id" value="{{ $slideId }}">
                
                <button id="delete-layanan-{{ $key }}" name="delete-layanan" 
                type="submit" style="background-color: red;">
                Hapus</button>

            </form>

        </div>
    </div>
{{-- HAPUS  LAYANAN pop up END --}}
    <script>
        // getModal(trigger, modal yang ditampilkan, tombol close x);
        getModal("trigger-edit-{{ $key }}", "edit-layanan-modal-{{ $key }}", "close-edit-layanan-modal-{{ $key }}");
        quillTextEditorInForm("description-layanan-editor-{{ $key }}", "edit-layanan-form-{{ $key }}",
            "hidden-input-{{ $key }}");
            
        getModal("trigger-delete-{{ $key }}", "delete-layanan-modal-{{ $key }}", "close-delete-layanan-modal-{{ $key }}");
    </script>
<?php
}?>


<script>
    // getModal(trigger, modal yang ditampilkan, tombol close x);
    getModal("trigger-buat-layanan", "buat-layanan-modal", "close-buat-layanan-modal");
    quillTextEditorInForm("description-layanan-editor", "buat-layanan-form", "hidden-input");

</script>
