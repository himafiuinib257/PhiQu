<?php

//function untuk upload
function upload()
{
    //deklarasi variabel
    $namefile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    //cek file
    $eksfilevalid = ['pdf', 'jpeg', 'doc', 'docx', 'jpg', 'png', 'zip', 'rar'];
    $eksfile = explode('.', $namefile);
    $eksfile = strtolower(end($eksfile));

    if(!in_array($eksfile, $eksfilevalid)){
        echo "<script> alert('File yang kamu upload tidak sesuai') </script>";
        return false;
    }

    //cek jika ukuran file
    if($ukuranfile > 100000000){
        echo "<script> alert('File yang kamu upload terlalu besar') </script>";
        return false;
    }

    //jika lolos cek
    //generate nama file baru

    $namafilebaru = uniqid();
    $namafilebaru = '.';
    $namafilebaru = $eksfile;

    move_uploaded_file($tmpname, 'file/'.$namafilebaru);
    return $namafilebaru;

}


?>