<?php

trait UploadFile {
    public static function upload($file,$path){
        $filename = $file["name"];
        $tmp_path = $file["tmp_name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $new_file_name = $_SERVER['REQUEST_TIME'] . '.' . $extension;
        $new_path = $path. $new_file_name;
        move_uploaded_file($tmp_path, $new_path);
        return $new_path;
    } 
}

?>