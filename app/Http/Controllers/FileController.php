<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function displayImage($filename)
    {
        $filePath = storage_path('app/public/' . $filename);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $contentType = 'image/jpeg';
                break;
            case 'png':
                $contentType = 'image/png';
                break;
            case 'gif':
                $contentType = 'image/gif';
                break;
            case 'svg':
                $contentType = 'image/svg+xml';
                break;
            default:
                $contentType = 'application/octet-stream'; // Tipe konten default jika tidak dikenali
                break;
        }

        return response()->file($filePath, ['Content-Type' => $contentType]);
    }

    public function displayPdf($filename)
    {
        $filePath = storage_path('app/public/' . $filename);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
