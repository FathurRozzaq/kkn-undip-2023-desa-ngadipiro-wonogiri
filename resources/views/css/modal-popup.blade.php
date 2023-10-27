<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 3;
        /* Sit on top */
        padding-top: 50px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        padding-top: 5px;
        border: 1px solid #888;
        width: 500px;
        animation-name: modalopen;
        animation-duration: 0.5s;
    }

    @keyframes modalopen {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* The Close Button */
    .close {
        color: #000000;
        float: right;
        font-size: 28px;
        font-weight: bold;
        padding-left: 5px;
        padding-right: 5px;
        opacity: 1;
    }

    .close:hover,
    .close:focus {
        color: rgb(255, 255, 255);
        background: red;
        text-decoration: none;
        cursor: pointer;
        opacity: 1;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .auth-form input[type="text"],
    .auth-form input[type="password"],
    .auth-form input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .auth-form button[type="submit"],
    .auth-form .trigger {
        padding: 10px 30px;
        background-color: var(--color-2);
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .auth-form button[type="submit"]:focus,
    .auth-form .trigger:focus  {
        background-color: var(--color-1);
    }

    button[type="submit"]:disabled,
    .auth-form .trigger:disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Input Form START*/
    .form-group {
        position: relative;
        width: 100%;
    }

    .form-group label {
        position: absolute;
        top: 40%;
        left: 10px;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    /* Tambahkan gaya baru ketika label memiliki class "active" */
    .form-group label.active {
        font-size: 12px;
        top: -10px;
        color: var(--color-2);
    }

    .active-label {
        font-size: 12px;
        top: -10px;
        color: var(--color-2);
    }

    .form-group input[type="text"],
    .form-group input[type="password"],
    .form-group input[type="email"],
    .form-group input[type="file"] {
        width: 100%;

        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="password"]:focus,
    .form-group input[type="email"]:focus,
    .form-group input[type="file"]:focus {
        outline: none;
        border-color: var(--color-2);
    }

    .form-group input[type="text"]:focus+label,
    .form-group input[type="password"]:focus+label,
    .form-group input[type="email"]:focus+label,
    .form-group input[type="file"]:focus+label {
        font-size: 12px;
        top: -10px;
        color: var(--color-2);
    }

    /* Input Form End */
    
    /* style fontawesome untuk tombol yang memiliki icon di dalamnya, seperti edit, delete */
    .btn-edit {
        padding: 4px 8px;
        border: none;
        background-color: var(--color-2);
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-delete {
        padding: 4px 8px;
        border: none;
        background-color: red;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-red {
        background-color: red;
    }

    .btn-cancel{
        background-color: rgb(214, 214, 214);
        color: black;
        border: 1px solid rgb(214, 214, 214);
    }

    button i {
        margin-right: 8px;
    }

    .show-password-btn {
        border: none;
        background: none;
        margin-top: -20px;
        translate: 110px -30px;
    }

    .visibility-icon {
        height: 10px;
    }
</style>

<script>
    // Get the modal
    function getModal(button, modal, close) {
        var modal = document.getElementById(modal);

        // Get the button that opens the modal
        var btn = document.getElementById(button);

        // Get the <span> element that closes the modal
        var span = document.getElementById(close);

        // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

    }

    function display(modal) {
        modal.style.display = "block";
    }

    function hide(modal) {
        modal.style.display = "none";
    }

    function seePassword(password,icon) {
        var passwordInput = $(password);
        var passwordFieldType = passwordInput.attr("type");
        var visibilityIcon = $(icon);
        
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
</script>

<script>
    function validateFile(typeFile, fileInputId, fileMessageId, fileSizeId, btnId) {
        const fileInput = document.getElementById(fileInputId);
        const fileMessage = document.getElementById(fileMessageId);
        const fileSize = document.getElementById(fileSizeId);
        const btnSubmit = document.getElementById(btnId);
        const file = fileInput.files[0];
        var allowedExtensions = [];

        // Check if a file is selected
        if (file) {
            const size = file.size / 1024 / 1024; // Convert to MB

            // Check file extension
            if (typeFile == "img") {
                allowedExtensions = ["jpg", "jpeg", "png", "gif", "svg"];
            } else {
                allowedExtensions = ["jpg", "jpeg", "png", "gif", "svg", "pdf"];
            }

            const fileExtension = file.name.split(".").pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                fileMessage.textContent = "Error: Tipe file tidak didukung. Tipe yang diperbolehkan: " +
                    allowedExtensions.join(", ");
                fileMessage.style.display = "block";
                fileSize.style.display = "none";
                btnSubmit.disabled = true;
                btnSubmit.style.opacity = 0.5;
                return false;
            } else {
                // Check file size (15MB limit)
                if (size > 15) {
                    fileMessage.textContent = "Error: Ukuran file melebihi 15MB.";
                    fileMessage.style.display = "block";
                    fileSize.style.display = "none";
                    btnSubmit.disabled = true;
                    btnSubmit.style.opacity = 0.5;
                    return false;
                } else {
                    fileSize.textContent = "Ukuran: " + size.toFixed(2) + " MB";
                    fileSize.style.display = "block";
                    fileMessage.style.display = "none";
                    btnSubmit.disabled = false;
                    btnSubmit.style.opacity = 1;
                    return true;
                }
            }

        } else {
            fileMessage.style.display = "none";
            fileSize.style.display = "none";
            btnSubmit.disabled = true;
            btnSubmit.style.opacity = 0.5;
            return false;
        }
    }

</script>

<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('https://cdn.quilljs.com/1.3.6/quill.js') }}"></script>
<script>
    function quillTextEditorInForm(editorId, formId, hiddenInputId) {
        // Initialize Quill editor
        var quill = new Quill('#' + editorId, {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    // ['link', 'image']
                    ['link']
                ]
            }
        });

        // Save the Quill content to the hidden input on form submit
        var form = document.querySelector('#' + formId);
        form.addEventListener('submit', function (event) {
            var content = document.querySelector('#' + hiddenInputId);
            content.value = quill.root.innerHTML;
        });
    }

</script>
