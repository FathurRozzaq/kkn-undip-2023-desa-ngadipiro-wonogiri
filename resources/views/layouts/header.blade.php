@include('layouts.authentication.islogin')
<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Portal Desa Ngadipiro</title>
    <link rel="icon" href="{{ asset('web/img/title-icon.png') }}" type="image/png">
    

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    {{-- <link rel="stylesheet" href="web/css/bootstrap-theme.min.css"> --}}
    {{-- <link rel="stylesheet" href="web/css/fontAwesome.css"> --}}
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}">

    @include('css.template-web')

    @include('css.modal-popup')
    {{-- <link href="web/css/sb-admin-2.css" rel="stylesheet"> --}}
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900') }}"
        rel="stylesheet">

    <!-- Theme style : AdminLTE.min.css-->
    <link rel="stylesheet" href="{{ asset('lib/adltefr/dist/css/AdminLTE.css') }}">

    {{-- <script src="web/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script> --}}

    {{-- Quill Editor (Teks Editor yang bisa kustom teks)--}}
    <link href="{{ asset('https://cdn.quilljs.com/1.3.6/quill.snow.css') }}" rel="stylesheet">

    @php
        $countLayanan = DB::select('SELECT COUNT(*) as count FROM layanan_desa');
        $firstElement = collect($countLayanan)->first();
        session(['count_layanan'=>$firstElement->count]);
    @endphp
</head>
<body>
    <div class="overlay-image" style="opacity: 0.9"></div>
    <div class="overlay-color" style="opacity: 0.9"></div>
    
    <section class="cd-hero">
        <CENTER>
            <div class="top-nav" style="padding-top: 10px">
                <a href="/" class="btn-nav" >HOME</a>
                <a style="padding-left: 5px; color: var(--color-2);">|</a>
                @include('layouts.authentication.login')
            </div>
            
            <br>
            <img class="logo-utama" src="{{ asset('web/img/logo-utama.png') }}">
            <style>
                @media only screen and (max-width: 852px) {
                    .logo-utama{
                        width: 70%;
                        height: auto;
                    }
                }
                @media only screen and (min-width: 852px) {
                    .logo-utama{
                        width: auto;
                        height: 250px;
                    }
                }
            </style>
            
        </CENTER>