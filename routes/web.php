<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Halaman Home
Route::get('/', [HomeController::class, 'index']);

Route::get('/load-data/semua-penduduk', function () {
    $dataPenduduk = [];

    $data = DB::select('SELECT * FROM data_penduduk');
    foreach ($data as $key => $row) {
        $dataPenduduk[] = [
            'nama_lengkap' => $row->nama_lengkap,
            'jenis_kelamin' => $row->jenis_kelamin,
            'status_kawin' => $row->status_kawin,
            'tempat_lahir' => $row->tempat_lahir,
            'tanggal_lahir' => $row->tanggal_lahir,
            'agama' => $row->agama,
            'pendidikan' => $row->pendidikan,
            'pekerjaan' => $row->pekerjaan,
            'kewarganegaraan' => $row->kewarganegaraan,
            'alamat' => $row->alamat,
            'rw' => $row->rw,
            'rt' => $row->rt,
            'kedudukan_dalam_keluarga' => $row->kedudukan_dalam_keluarga,
            'no_ktp' => $row->no_ktp,
            'nomor_kk' => $row->nomor_kk,
            'darah' => $row->darah,
            'cacat' => $row->cacat
        ];
    }

    return response()->json($dataPenduduk);
});
Route::get('/login', function () { return redirect()->back(); });
Route::post('/login', [AuthController::class, 'login']);

Route::get('/send-code', function () { return redirect()->back(); });
Route::post('/send-code', [AuthController::class, 'sendEmail']);

Route::get('/verify-user', function () { return redirect()->back(); });
Route::post('/verify-user', [AuthController::class, 'verifyUser']);

Route::get('/register', function () { return redirect()->back(); });
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/ganti-password', function () { return redirect()->back(); });
Route::post('/ganti-password', [AuthController::class, 'changePassword']);

Route::get('/update-profile', function () { return redirect()->back(); });
Route::post('/update-profile', [HomeController::class, 'updateProfile']);

Route::get('/update-struktur-organisasi', function () { return redirect()->back(); });
Route::post('/update-struktur-organisasi', [HomeController::class, 'updateStruktur']);

Route::get('/update-peta', function () { return redirect()->back(); });
Route::post('/update-peta', [HomeController::class, 'updatePeta']);

Route::get('/buat-layanan', function () { return redirect()->back(); });
Route::post('/buat-layanan', [HomeController::class, 'createLayanan']);

Route::get('/edit-layanan/{id}', function () { return redirect()->back(); });
Route::post('/edit-layanan/{id}', [HomeController::class, 'editLayanan']);

Route::get('/delete-layanan/{id}', function () { return redirect()->back(); });
Route::post('/delete-layanan/{id}', [HomeController::class, 'deleteLayanan']);

Route::get('/next', [HomeController::class, 'nextLayanan']);
Route::get('/refresh-layanan', [HomeController::class, 'refreshLayanan']);

Route::get('/discussion', [DiscussionController::class, 'index']);
Route::get('/discussion/{id}', [DiscussionController::class, 'displayComments']);

Route::get('/send-comment', function () { return redirect()->back(); });
Route::post('/send-comment', [DiscussionController::class, 'sendComment']);

Route::get('/delete-comment/{id}', [DiscussionController::class, 'deleteComment']);

Route::get('/display-image/{filename}', 'FileController@displayImage')->name('display.image');
Route::get('/display-pdf/{filename}', [FileController::class,'displayPdf'])->name('display.pdf');
?>