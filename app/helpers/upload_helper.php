<?php 
function upload_dir($dir){ 
    return $_SERVER['DOCUMENT_ROOT']."/sipelit/".$dir;
}

function upload_path($dir){   
    $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://";  
    return $protocol.$_SERVER['HTTP_HOST']."/sipelit/".$dir;
}

function check_photo($path){
    if(file_exists(upload_dir($path))){
        return upload_path($path).'?'.rand();
    }else{
        return base_url('img/image_not_avaliable.jpg');
    }
}
?>