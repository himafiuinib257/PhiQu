<?php
session_start();

//mengatasi user masuk tanpa login
if(empty($_SESSION['id_user']) or empty($_SESSION['username']))
{
  echo "<script>
      alert('Kamu harus login dulu ya!!!');
      document.location='index.php';
        </script>";
}


?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>E-Arsip By PhiQu</title>
  </head>
  <body>
<!-- Menu -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
    <a class="navbar-brand" href="admin.php">E-Arsip</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=organisasi">Data Organisasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=pengirim_surat">Data Pengirim Surat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=arsip_surat">Data Arsip</a>
      </li>
    </ul>
    <form action="search.php" method="GET" style="display: flex; align-items: center; gap: 10px; justify-content: center; margin-top: 1px;">
    <input type="text" name="keyword" placeholder="Cari data..." required 
        style="width: 300px; padding: 10px; font-size: 16px; border: 2px solid #3498db; border-radius: 25px; outline: none; transition: 0.3s;">
    <button type="submit" 
        style="padding: 10px 20px; font-size: 16px; font-weight: bold; color: white; background: #3498db; border: none; border-radius: 25px; cursor: pointer; transition: 0.3s;">
        🔍 Cari
    </button>
</form>

<!-- Efek Hover pada Input dan Tombol -->
<style>
    input[name="keyword"]:focus {
        border-color: #2c3e50;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
    }

    button[type="submit"]:hover {
        background: #2980b9;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.8);
    }
</style>

  </nav>


  <!-- awal container -->
  <div class="container">