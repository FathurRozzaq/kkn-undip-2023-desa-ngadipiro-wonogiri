<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request){
        session()->flush(); //bersihkan semua session

        $username = $request->input('username');
        $password = $request->input('password');
        
        // mencari data user dengan username dan password yang sesuai
        //  versi password terenkripsi
        $cek = DB::select('SELECT count(*) AS "count" FROM users WHERE (username=? AND password=MD5(?)) OR (email=? AND password=MD5(?))', [$username, $password, $username, $password]);
        $user = DB::select('SELECT * FROM users WHERE (username=? AND password=MD5(?)) OR (email=? AND password=MD5(?))', [$username, $password, $username, $password]);

        foreach ($cek as $key => $cek) {}
        foreach ($user as $key => $user) {}

        if(($cek->count)>0){
            // cek status
            if ($user->status == 1) {
                session(['id'=>$user->id]);
                session(['role'=> $user->role]);
            } else {
                //kirim email verifikasi
                session(['email'=>$user->email]);
                session(['username'=>$user->username]);

                $code = mt_rand(100000, 999999); // generate a random 6-digit code
                session(['kode'=>$code]);
                
                $data = ['code' => $code]; // pass the code as data to the email view

                Mail::send('layouts.email.verifikasi', $data, function($message) {
                    $message->to(session('email'), session('username'))
                            ->subject('Kode Verifikasi Pengguna DesaConnect')
                            ->from('noreply@desaconnect.com', 'DesaConnect');
                });
                session()->forget(['email','username']);
                session(['id-user'=>$user->id]);
                session(['role-user'=> $user->role]);
            }
        }else{
            session(['fail'=>'login']);
            session(['username'=>$username]);
        }
        
        return redirect()->back();
    }

    public function verifyUser(){

        $id = session('id-user');
        DB::update('UPDATE users SET status = 1 WHERE id = ?', [$id]);

        session(['id'=> session('id-user')]);
        session(['role'=> session('role-user')]);

        session()->forget(['id-user', 'role-user', 'kode']);

        return redirect()->back();
    }

    public function logout(){
        session()->forget('id');
        session()->forget('role');
        session()->flush();
        return redirect()->back();
    }

    public function register(Request $request){
        session()->flush(); //bersihkan semua session
        
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        
        // mengecek ketersediaan username
        $query = DB::select('SELECT count(*) AS "count" FROM users WHERE (username=?)', [$username]);
        $countUsername = collect($query)->first()->count;
        if ($countUsername > 0){
            $isUsernameAvailable = false;
            session(['not-available'=>'username']);
        }else{
            $isUsernameAvailable = true;
        }
        
        // mengecek ketersediaan email
        $query = DB::select('SELECT count(*) AS "count" FROM users WHERE (email=?)', [$email]);
        $countEmail = collect($query)->first()->count;
        if ($countEmail > 0){
            $isEmailAvailable = false;
            session(['not-available'=>'email']);
        }else{
            $isEmailAvailable = true;
        }
        
        // Alur pembuatan user baru
        // kalau semua tersedia, jalankan query insert user, lalu buka login
        // kalau tidak tersedia salah satunya, jalankan session fail register
        // lalu redirect back

        if($isEmailAvailable && $isUsernameAvailable){
            DB::insert('insert into users (username, email, password, role) values (?, ?, MD5(?), 2)', [$username, $email, $password]);
            
            // mencari data user dengan username dan password yang sesuai
            //  versi password terenkripsi
            $emailOrPassword = $username;
            $cek = DB::select('SELECT count(*) AS "count" FROM users WHERE (username=? AND password=MD5(?)) OR (email=? AND password=MD5(?))', [$emailOrPassword, $password, $emailOrPassword, $password]);
            $user = DB::select('SELECT * FROM users WHERE (username=? AND password=MD5(?)) OR (email=? AND password=MD5(?))', [$emailOrPassword, $password, $emailOrPassword, $password]);

            $cek = collect($cek)->first()->count;
            $user = collect($user)->first();
        
            if($cek>0){
                session(['display'=> 'login']);
                return redirect()->back();
            }
        }else{
            session(['fail'=>'register']);
            session(['email'=>$email]);
            session(['username'=>$username]);
        }
        return redirect()->back();
    }

    // langkah:
    // membuat file email yang dikirim
    // menggunakan email bot yang baru
    // gmail perlu 2 way authentication untuk bisa digunakan untuk mengirim email.
    
    // fitur yang membutuhkan email:
    // - Buat Akun -> verifikasi -> Login
    // - lupa password -> ganti password -> Login


    public function sendEmail(Request $request){
        session()->flush(); //bersihkan semua session

        $email = $request->input('email');
        $countUser = DB::select('SELECT count(*) AS count FROM users WHERE email = ?', [$email]);
        $countUser = collect($countUser)->first()->count;

        if ($countUser>0) {

            $user = DB::select('SELECT * FROM users WHERE email = ?', [$email]);
            $username = collect($user)->first()->username;

            session(['email'=>$email]);
            session(['username'=>$username]);
            
            $code = mt_rand(100000, 999999); // generate a random 6-digit code
            session(['kode-forget-password'=>$code]);
            
            $data = ['code' => $code]; // pass the code as data to the email view

            Mail::send('layouts.email.verifikasi', $data, function($message) {
                $message->to(session('email'), session('username'))
                        ->subject('Kode Verifikasi Pengguna DesaConnect')
                        ->from('noreply@desaconnect.com', 'DesaConnect');
            });
            // session()->forget(['email','username']);
            
        } else {
            session(['not-found' => 'email']);
        }
        return redirect()->back();
    }

    public function changePassword(){
        $email = session('email');
        $password = request()->input('password');
        DB::update('UPDATE users SET password=MD5(?) WHERE email=?', [$password, $email]);

        $user = DB::select('SELECT * FROM users WHERE email=?', [$email]);
        $user = collect($user)->first();
        session()->flush();
        
        session(['id'=>$user->id]);
        session(['role'=> $user->role]);

        return redirect()->back();
    }
}
?>