<?php

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\File;


function upload_picture($imageName, $image, $destination){

    $image_name = basename($imageName);

    $image_path = public_path($destination.'/'.$image_name);
   
    if(File::exists($image_path)){
            
        File::delete($image_path);
    }

    $extension = $image->getClientOriginalExtension();

    $filename = rand().".".$extension;

    $image->move(public_path().$destination, $filename);

    return url($destination,$filename);     

}

function delete_picture($imageName, $destination ){

    $image_name = basename($imageName);

    $image_path = public_path($destination.'/'.$image_name);
   
    if(File::exists($image_path)){
            
        File::delete($image_path);
    }

    return null;
}


