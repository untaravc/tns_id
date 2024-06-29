<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function fileUploadProcessing(Request $request, $folder_name = 'files', String $file_container = 'file')
    {
        $fileNameToStore = null;
        if ($request->hasFile($file_container)) {
            $filenameWithExt = $request->file($file_container)->getClientOriginalName();

            $filename        = str_replace(' ', '_', strtolower(pathinfo($filenameWithExt, PATHINFO_FILENAME)));
            $extension       = $request->file($file_container)->getClientOriginalExtension();
            $fileNameToStore = $folder_name . '/' . $filename . '_' . time() . '.' . $extension;
            Storage::disk('public')->put($fileNameToStore, file_get_contents($request->file($file_container)));
        }

        return $fileNameToStore;
    }
}
