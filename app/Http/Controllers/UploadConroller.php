<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\DB;

class UploadConroller extends Controller
{
    //
    public function store(Request $request){
        
        $d=date("Y-m-d");
            $d=date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $d) ) ));
            $file=TemporaryFile::where('date','<=', $d)->get();
            foreach ($file as $post) {
                Storage::deleteDirectory('livewire-tmp/tmp/'.$post->folder);
                TemporaryFile::where('folder',$post->folder)->delete();
            }
            
        $ext=$request->file('csv')->extension();
        if (($request->hasFile('csv')&&($ext=="csv"))){
            //Storage::deleteDirectory('livewire-tmp/tmp');
            $file = $request->file('csv');
            $filename=$file->getClientOriginalName();
            $folder = uniqid().'-'.now()->timestamp;
            $file->storeAs('livewire-tmp/tmp/'.$folder,$filename);
            $d=date("Y-m-d");
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
                'date' => $d
            ]);
            
            return $folder;
        }
        else{
            abort("invalid");
        }
        
       
    }
   
}
