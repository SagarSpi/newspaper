<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    function downloadPage()
    {
        return view('download');
    }

    function downloadFile()
    {

        $filePath = storage_path('app/public/download_file/inLove.zip');
        
        return response()->download($filePath);
        
    }
}
