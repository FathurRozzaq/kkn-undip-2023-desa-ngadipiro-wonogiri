<?php
// $request->session();
session_start();
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
    
function isLogin()
{
    if(session()->has('id') && session('role')==1){
        $isLogin = true;
    }else{
        $isLogin = false;
    }

    return $isLogin;
}

function isLoginUser()
{
    if(session()->has('id') && session('role')==2){
        $isLogin = true;
    }else{
        $isLogin = false;
    }

    return $isLogin;
}

?>

{{-- 
buat peringatan password salah
pop up untuk notifikasi login berhasil
buat tulisan "login sebagai admin" di pojok kanan atas
--}}