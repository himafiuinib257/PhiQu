<?php

    @$halaman = $_GET['halaman'];

    if($halaman == "organisasi")
    {
        //tampilkan halaman organisasi
        //echo "Tampil Halaman Modul Organisasi";
        include "modul/organisasi/organisasi.php";
    }
    elseif ($halaman == "pengirim_surat"){
        //Tampilkan Halaman Pengirim Surat
        //echo "Tampilkan Halaman Modul Pengirim Surat";
        include "modul/pengirim_surat/pengirim_surat.php";
    }
    elseif($halaman == "arsip_surat")
    {
        //Tampilkan halaman arsip surat
        //echo "Tampilkan Halaman Modul Arsip Surat";
        if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus") {
            include "modul/arsip/form.php";
        }else{
            include "modul/arsip/data.php";
        }
    }
    else{
        //echo "Tampilan Halaman Beranda";
        include "modul/home.php";
    }


?>