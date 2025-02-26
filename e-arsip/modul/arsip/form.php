<?php

    //untuk function upload file
    include "config/function.php";

    //uji jika klik tombol edit atau hapus
    if(isset($_GET['hal']))
    {
        if($_GET['hal'] == "edit")
        {
                //Tampilan data yang akan di edit
            $tampil = mysqli_query($koneksi, "SELECT tbl_arsip.*,
                                            tbl_organisasi.nama_organisasi,
                                            tbl_pengirim_surat.nama_pengirim, tbl_pengirim_surat.no_hp
                                           FROM
                                            tbl_arsip, tbl_organisasi, tbl_pengirim_surat
                                           WHERE
                                            tbl_arsip.id_organisasi = tbl_organisasi.id_organisasi
                                            and tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim_surat
                                            and tbl_arsip.id_arsip='$_GET[id]'");


            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //Jika data ditemukan, maka ditamping ke dalam variabel
                $vno_surat = $data['no_surat'];
                $vtanggal_surat = $data['tanggal_surat'];
                $vtanggal_diterima = $data['tanggal_diterima'];
                $vprihal = $data['prihal'];
                $vid_organisasi = $data['id_organisasi'];
                $vnama_organisasi = $data['nama_organisasi'];
                $vid_pengirim = $data['id_pengirim'];
                $vnama_pengirim = $data['nama_pengirim'];
                $vfile = $data['file'];
            }

        }
        elseif($_GET['hal'] == 'hapus')
        {
            $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$_GET[id]'");
            if($hapus){
                echo "<script>
                     alert('Data Dihapus');
                     document.location='?halaman=arsip_surat';
                     </script>";
            }
        }
    }
    
    //uji jika tombol simpan di klik
    if(isset($_POST['bsimpan']))
    {

        //apakah data akan di edit atau simpan baru
        if(@$_GET['hal'] == "edit") {
         //ubah data

         //cek user pilih file
         if($_FILES['file']['error'] === 4){
            $file = $vfile;
         }else{
            $file = upload();
         }
         $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET 
                                        no_surat = '$_POST[no_surat]', 
                                        tanggal_surat = '$_POST[tanggal_surat]',
                                        tanggal_diterima = '$_POST[tanggal_diterima]',
                                        prihal = '$_POST[prihal]',
                                        id_organisasi = '$_POST[id_organisasi]',
                                        id_pengirim = '$_POST[id_pengirim]',
                                        file = '$file'
                                    where id_arsip ='$_GET[id]' ");

         if($ubah)
         {
             echo "<script>
                     alert('Data Diubah');
                     document.location='?halaman=arsip_surat';
                     </script>";
         }
        else
        {
            echo "<script>
                     alert('Data Gagal Diubah');
                     document.location='?halaman=arsip_surat';
                     </script>";
        }
    }
        else
        {
         //simpan data
         $file = upload();
         $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip VALUES ('', 
                                                                                '$_POST[no_surat]', 
                                                                                '$_POST[tanggal_surat]', 
                                                                                '$_POST[tanggal_diterima]',
                                                                                '$_POST[prihal]',
                                                                                '$_POST[id_organisasi]',
                                                                                '$_POST[id_pengirim]',
                                                                                '$file'
                                                                                ) ");
        }
         if($simpan)
         {
             echo "<script>
                     alert('Data Tersimpan');
                     document.location='?halaman=arsip_surat';
                     </script>";
         }else{
            echo "<script>
                     alert('Data Gagal Tersimpan');
                     document.location='?halaman=arsip_surat';
                     </script>";
         }

        }

?>


<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Arsip Surat
  </div>
  <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="no_surat">No. Surat</label>
        <input type="text" class="form-control" id="no_surat" name="no_surat" 
        value="<?=@$vno_surat?>">
    </div>
    <div class="form-group">
        <label for="tanggal_surat">Tanggal Surat</label>
        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" 
        value="<?=@$vtanggal_surat?>">
    </div>
    <div class="form-group">
        <label for="tanggal_diterima">Tanggal Diterima</label>
        <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" 
        value="<?=@$vtanggal_diterima?>">
    </div>
    <div class="form-group">
        <label for="prihal">Prihal</label>
        <input type="prihal" class="form-control" id="prihal" name="prihal" 
        value="<?=@$vprihal?>">
    </div>
    <div class="form-group">
        <label for="id_organisasi">Organisasi / Tujuan</label>
        <select class="form-control" name="id_organisasi">
            <option value="<?=@$vid_organisasi?>"><?=@$vnama_organisasi?></option>
            <?php
                $tampil = mysqli_query($koneksi, "SELECT * from tbl_organisasi order by nama_organisasi asc");
                while($data = mysqli_fetch_array($tampil)){
                    echo "<option value = '$data[id_organisasi]'> $data[nama_organisasi] </option> ";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id_pengirim">Pengirim Surat</label>
        <select class="form-control" name="id_pengirim">
            <option value="<?=@$vid_pengirim?>"><?=@$vnama_pengirim?></option>
            <?php
                $tampil = mysqli_query($koneksi, "SELECT * from tbl_pengirim_surat order by nama_pengirim asc");
                while($data = mysqli_fetch_array($tampil)){
                    echo "<option value = '$data[id_pengirim_surat]'> $data[nama_pengirim] </option> ";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="file">Pilih File</label>
        <input type="file" class="form-control" id="file" name="file" 
        value="<?=@$vfile?>">
    </div>

    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>