<style>
    .discussion-text{
        text-align: left;   
        margin-top: -20px;
        
    }

    .comment-row{
        padding: 5px 1  0px 5px 10px; 
    }

    .comment-section {
        background: url({{ asset('web/icon/pattern.png') }});
        background-size: 300px 300px; /* Ukuran pola yang diulang, sesuaikan dengan ukuran pola asli */
        background-repeat: repeat; /* Mengulang pola secara horizontal dan vertikal */
        padding: 5px;
        padding-bottom: 15px;
        border: 1px solid grey;
        border-radius: 5px;
    }

    .comment-value {
        display: inline-block; /* Menjadikan elemen inline-block agar ukuran menyesuaikan isi child-nya */
        word-wrap: break-word; /* Menggunakan 'break-word' untuk memastikan teks yang panjang dibungkus ke baris selanjutnya */
        border: 1px solid grey;
        max-width: 98%;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 10px;
        margin-bottom: 5px;   
    }

    .comment-label{
        display: flex;
        justify-content: space-between;
    }
    .comment-label .dropdown{
        margin-right: -15px;
    }

    .my-comment{
        text-align: right;
    }

    .my-comment .comment-value{
        text-align: left;
        background: var(--color-5);
    }

    .others-comment .comment-value{
        text-align: left;
        background: var(--color-3);
    }
    
    .adminname{
        color: var(--color-6);
    }

    .username{
        color: var(--color-7);
    }

    /* CSS untuk styling input chat */
    
     /* Style untuk class shared-style */
    
    .chat-footer{
        background-color: var(--color-0); /* Warna background input */
        padding: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        align-items: center;
        position: fixed; /* Menggunakan posisi mengambang */
        width: 100%; /* Lebar 80% dari layar */
        bottom: 0;
        text-align: center;
        color: var(--color-3);
    }
    .chat-footer p,
    .chat-footer a
    {
        /* font-size: 12px; */
        color: var(--color-3);
    }
    @media only screen and (max-width: 600px) {
        .chat-footer p,
        .chat-footer a
        {
            font-size: 11px;
        }
    }
    .chat-input {
        background-color: white; /* Warna background input */
        border: 1px solid grey;
        padding: 5px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        align-items: center;
        z-index: 1;
        translate: 5% 0;
        width: 90%; 
        display: flex;
        color: black;
    }

    .chat-input input[type="text"] {
        flex: 1; /* Agar input text dapat mengambil sisa ruang */
        border: none;
        outline: none;
        padding: 5px;
    }

    .chat-input button{
        margin-left: 10px;
        background-color: var(--color-2);
        color: white;
        border: none;
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Memberikan efek transisi ketika properti background-color berubah */
    }

    .chat-input button[disabled]{
        pointer-events: none;
        background: none;
        color: rgb(209, 209, 209);
        transition: background-color 0.3s ease; /* Memberikan efek transisi ketika properti background-color berubah */
    }

    .chat-input button i {
        transform: rotate(45deg);
        font-size: 15px;
    }

    /* Style untuk tombol dropdown */
    .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            background: none;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style untuk konten dropdown */
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: 5px;
            padding: 5px;
            z-index: 1;
        }

        /* Style untuk opsi dalam dropdown */
        .dropdown-option {
            padding: 5px;
            cursor: pointer;
        }
        .dropdown-option a{
            color: black;
        }
</style>