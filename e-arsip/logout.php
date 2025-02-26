<?php
    session_start();
    //hapus sesi
    unset($_SESSION['id_user']);
    unset($_SESSION['username']);

    session_destroy();
    echo "<script>
        alert('Sampai Jumpa Lagi!!!')
        document.location='index.php';
        </script>"

?>