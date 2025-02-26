<?php
    //uji jika tombol simpan di klik
    if(isset($_POST['bsimpan']))
    {

        //apakah data akan di edit atau simpan baru
        if($_GET['hal'] == "edit") {
         //ubah data
         $ubah = mysqli_query($koneksi, "UPDATE tbl_organisasi SET nama_organisasi = '$_POST[nama_organisasi]' where id_organisasi ='$_GET[id]' ");

    
         if($ubah)
         {
             echo "<script>
                     alert('Data Tersimpan');
                     document.location='?halaman=organisasi';
                     </script>";
         }
        }
        else
        {
         //simpan data
         $simpan = mysqli_query($koneksi, "INSERT INTO tbl_organisasi (nama_organisasi) VALUES ('$_POST[nama_organisasi]')");

         if($simpan)
         {
             echo "<script>
                     alert('Data Tersimpan');
                     document.location='?halaman=organisasi';
                     </script>";
         }
        }

    }

    //uji jika klik tombol edit atau hapus
    if(isset($_GET['hal']))
    {
        if($_GET['hal'] == "edit")
        {
                //Tampilan data yang akan di edit
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_organisasi where id_organisasi='$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //Jika data ditemukan, maka ditamping ke dalam variabel
                $vnama_organisasi = $data['nama_organisasi'];
            }

        }else{
            
            $hapus = mysqli_query($koneksi, "DELETE FROM tbl_organisasi WHERE id_organisasi='$_GET[id]'");
            if($hapus){
                echo "<script>
                     alert('Data Dihapus');
                     document.location='?halaman=organisasi';
                     </script>";
            }

        }
    
    }

?>


<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Organisasi
  </div>
  <div class="card-body">
  <form method="post" action="">
  <div class="form-group">
    <label for="nama_organisasi">Nama Organisasi</label>
    <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" 
    value="<?=@$vnama_organisasi?>">
  </div>
  <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
  <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
</form>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Data Organisasi
  </div>
  <div class="card-body">
  <table class="table table-borderd table-hovered table-striped">
    <tr>
        <th>No</th>
        <th>Nama Organisasi</th>
        <th>Aksi</th>
    </tr>

    <?php
        $tampil = mysqli_query($koneksi, "SELECT * from tbl_organisasi order by id_organisasi desc");
        $no = 1;
        while($data = mysqli_fetch_array($tampil)) :
    
    ?>

    <tr>
        <td><?=$no++?></td>
        <td><?=$data['nama_organisasi']?></td>
        <td>
    <a href="?halaman=organisasi&hal=edit&id=<?=$data['id_organisasi']?>" class="btn btn-success">Edit </a>
    <a href="?halaman=organisasi&hal=hapus&id=<?=$data['id_organisasi']?>" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">Hapus </a>
        </td>
    </tr>
    <?php endwhile; ?>
  </table>
  </div>
</div>