<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DiscussionController extends Controller
{
    public function index(){
        return view('discussion');
    }

    public function displayComments(){
        $id = request()->id;
        $data = DB::select('SELECT title FROM layanan_desa WHERE layanan_desa.id = ?;', [$id]);
        $title = collect($data)->first();
        $title = $title->title;

        $data = DB::select('SELECT users.id AS "user_id",
        users.username AS "username",
        comments_storage.id AS "comment_id",
        comments_storage.value AS "comment_value",
        comments_storage.time AS "time", 
        users.role AS "user_role" 
        FROM layanan_desa, users, comments_storage
        WHERE layanan_desa.id = comments_storage.id_layanan AND users.id = comments_storage.id_user
        AND layanan_desa.id = ?
        ORDER BY time ASC;', [$id]);
        
        return view('discussion', [
            'title' => $title,
            'idLayanan' => $id,
            'comments' => $data
        ]);
    }

    public function sendComment(){
        $idLayanan = request()->input('id-layanan');
        $idUser = request()->input('id-user');
        $commentValue = request()->input('comment-value');

        DB::insert('INSERT INTO comments_storage (id_layanan, id_user, value, time) values (?, ?, ?, NOW())', [$idLayanan, $idUser, $commentValue]);

        return redirect()->back();
    }

    public function deleteComment(){
        $idComment = request()->id;

        DB::delete('DELETE FROM comments_storage WHERE id = ?', [$idComment]);

        return redirect()->back();
    }
}
