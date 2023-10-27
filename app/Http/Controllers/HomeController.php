<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function updateProfile(){
        // Menu dan slide terkait
        $menuId = request()->input('menu-id');
        $slideId = request()->input('slide-id');
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        //Value yang mengalami perubahan
        $welcomeValue = request()->input('welcome-text-input');
        $welcomeCode = "welcome";

        $visiValue = request()->input('visi-text-input');
        $visiCode = "visi";

        $misiValue = request()->input('misi-text-input');
        $misiCode = "misi";

        $imageValue = request()->file('fileInput');
        $imageCode = "profil";

        $contactsValue = request()->input('kontak-text-input');
        $contactsCode = "contacts";
        
        if($imageValue == NULL){
            
        }
        else{
            $image = DB::select('select file_path from files_storage where code = ?', [$imageCode]);
            $firstElement = collect($image)->first();
            $filePath = $firstElement->file_path;
            if($filePath){
                Storage::delete($filePath);
            }
            // dd($icon = $request->file('icon')->store('component'));
            $filePath = $imageValue->store('files');
            DB::update('update files_storage set file_path=? WHERE code=?', [$filePath, $imageCode]);
        }

        DB::update('update text_storage set value=? WHERE code=?', [$welcomeValue, $welcomeCode]);
        DB::update('update text_storage set value=? WHERE code=?', [$visiValue, $visiCode]);
        DB::update('update text_storage set value=? WHERE code=?', [$misiValue, $misiCode]);
        DB::update('update text_storage set value=? WHERE code=?', [$contactsValue, $contactsCode]);

        return redirect()->back();
    }

    public function updateStruktur(){
        // Menu dan slide terkait
        $menuId = request()->input('menu-id');
        $slideId = request()->input('slide-id');
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        $code = "struktur-organisasi";
        if(request()->file('fileInput')==NULL){
            
        }
        else{
            $filePath = DB::select('select file_path from files_storage where code = ?', [$code]);
            foreach ($filePath as $key => $value) {}
            if($value->file_path){
                Storage::delete($value->file_path);
            }
            // dd($icon = $request->file('icon')->store('component'));
            $filePath = request()->file('fileInput')->store('files');
            DB::update('update files_storage set file_path = ? where code = ?', [$filePath, $code]);
        }
        return redirect()->back();
    }

    public function updatePeta(){
        // Menu dan slide terkait
        $menuId = request()->input('menu-id');
        $slideId = request()->input('slide-id');
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        $code = "peta-desa";
        if(request()->file('fileInput')==NULL){
            
        }
        else{
            $filePath = DB::select('select file_path from files_storage where code = ?', [$code]);
            foreach ($filePath as $key => $value) {}
            if($value->file_path){
                Storage::delete($value->file_path);
            }
            // dd($icon = $request->file('icon')->store('component'));
            $filePath = request()->file('fileInput')->store('files');
            DB::update('update files_storage set file_path = ? where code = ?', [$filePath, $code]);
        }
        return redirect()->back();
    }

    public function createLayanan(){
        // Menu dan slide terkait
        $menuId = request()->input('menu-id');
        $slideId = request()->input('slide-id');
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        // membuat layanan baru
        $title = request()->input('title');
        $description = request()->input('description-layanan');

        if(request()->file('fileInput')==NULL){
            DB::insert('insert into layanan_desa (title, description, updated) values (?, ?, NOW())', [$title, $description]);
            session(['notifIcon'=>'success']);
        }
        else{
            // dd($icon = $request->file('icon')->store('component'));
            $filePath = request()->file('fileInput')->store('files');
            DB::insert('insert into layanan_desa (image, title, description, updated) values (?, ?, ?, NOW())', [$filePath, $title, $description]);
            session(['notifIcon'=>'success']);
        }
        
        return redirect()->back();
    }

    public function editLayanan(){
        // Menu dan slide terkait
        $menuId = request()->input('menu-id');
        $slideId = request()->input('slide-id');
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        // membuat layanan baru
        $id = request()->id;
        $title = request()->input('title');
        $description = request()->input('description-layanan');

        if(request()->file('fileInput')==NULL){
            DB::update('update layanan_desa set title=?, description=?, updated=NOW() WHERE id=?', [$title, $description, $id]);
            session(['notifIcon'=>'success']);
        }
        else{
            $image = DB::select('select image from layanan_desa where id = ?', [$id]);
            $firstElement = collect($image)->first();
            $filePath = $firstElement->image;
            if($filePath){
                Storage::delete($filePath);
            }
            // dd($icon = $request->file('icon')->store('component'));
            $filePath = request()->file('fileInput')->store('files');
            DB::update('update layanan_desa set image=?, title=?, description=?, updated=NOW() WHERE id=?', [$filePath, $title, $description, $id]);
            session(['notifIcon'=>'success']);
        }
        
        return redirect()->back();
    }

    public function deleteLayanan(){
        // Menu dan slide terkait
        $menuId = request()->input('menu-id');
        $slideId = request()->input('slide-id');
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        // membuat layanan baru
        $id = request()->id;
        $image = DB::select('select image from layanan_desa where id = ?', [$id]);
            $firstElement = collect($image)->first();
            $filePath = $firstElement->image;
            if($filePath){
                Storage::delete($filePath);
        }

        DB::delete('DELETE FROM comments_storage WHERE id_layanan=?', [$id]);
        DB::delete('DELETE FROM layanan_desa WHERE id=?', [$id]);
        session(['notifIcon'=>'success']);
        
        return redirect()->back();
    }

    public function nextLayanan(){
        // Menu dan slide terkait
        $menuId = 'menu-layanan';
        $slideId = 'slide-layanan';
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        // update session limit layanan
        $oldSession = session('limit_layanan');

        session(['limit_layanan'=>$oldSession + 10]);
        
        return redirect()->back();
    }

    public function refreshLayanan(){
        // Menu dan slide terkait
        $menuId = 'menu-layanan';
        $slideId = 'slide-layanan';
        session(['updated_menu'=>$menuId]);
        session(['updated_slide'=>$slideId]);

        // update session limit layanan
        session()->forget('limit_layanan');
        
        return redirect()->back();
    }
}
?>