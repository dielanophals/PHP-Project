<?php
class Post{
  public function createDirectory(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $charactersLength; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    mkdir("uploads/posts/" . $randomString, 0777);

    return $randomString;
  }
}
