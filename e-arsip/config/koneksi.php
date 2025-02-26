<?php


    //persiapan identitas
    $server = "localhost"; //nama server
    $user = "root"; //username database server
    $pass = ""; //password database server
    $database = "phiqu_db"; //nama database

    //koneksi database
    $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

?>