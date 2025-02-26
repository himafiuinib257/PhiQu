<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "phiqu_db");

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil keyword dari form pencarian
$keyword = isset($_GET['keyword']) ? "%".$conn->real_escape_string($_GET['keyword'])."%" : '';
$searchPerformed = isset($_GET['keyword']); // Cek apakah pencarian telah dilakukan

// Query untuk mencari data di tiga tabel
$sql = "
    -- Mencari di tbl_arsip dengan JOIN tbl_organisasi dan tbl_pengirim_surat
    SELECT 'Arsip' AS sumber, 
           tbl_arsip.no_surat AS nama, 
           tbl_arsip.tanggal_surat AS keterangan, 
           tbl_arsip.prihal, 
           tbl_arsip.file, -- Menambahkan kolom file
           tbl_organisasi.nama_organisasi, 
           tbl_pengirim_surat.nama_pengirim 
    FROM tbl_arsip
    LEFT JOIN tbl_organisasi ON tbl_arsip.id_organisasi = tbl_organisasi.id_organisasi
    LEFT JOIN tbl_pengirim_surat ON tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim_surat
    WHERE tbl_arsip.no_surat LIKE ? 
       OR tbl_arsip.prihal LIKE ? 
       OR tbl_organisasi.nama_organisasi LIKE ? 
       OR tbl_pengirim_surat.nama_pengirim LIKE ?

    UNION

    -- Mencari di tbl_organisasi
    SELECT 'Organisasi' AS sumber, 
           nama_organisasi AS nama, 
           Waktu_akses AS keterangan, 
           NULL AS prihal, 
           NULL AS file, 
           NULL AS nama_organisasi, 
           NULL AS nama_pengirim
    FROM tbl_organisasi
    WHERE nama_organisasi LIKE ?

    UNION

    -- Mencari di tbl_pengirim_surat
    SELECT 'Pengirim Surat' AS sumber, 
           nama_pengirim AS nama, 
           alamat AS keterangan, 
           NULL AS prihal, 
           NULL AS file, 
           NULL AS nama_organisasi, 
           NULL AS nama_pengirim
    FROM tbl_pengirim_surat
    WHERE nama_pengirim LIKE ? OR alamat LIKE ?
";

// Gunakan prepared statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Form Pencarian -->
<form method="GET" action="">
    <input type="text" name="keyword" placeholder="Cari data..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
    <button type="submit">Cari</button>
</form>

<!-- Hasil Pencarian -->
<h2 id="searchResults">Hasil Pencarian</h2>
<ul>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<li><b>[" . htmlspecialchars($row["sumber"]) . "]</b> " . htmlspecialchars($row["nama"]) . 
             " ( " . htmlspecialchars($row["keterangan"]) . " )";

        // Jika ada informasi tambahan, tampilkan
        if (!empty($row["prihal"])) {
            echo " | Prihal: " . htmlspecialchars($row["prihal"]);
        }
        if (!empty($row["nama_organisasi"])) {
            echo " | Organisasi: " . htmlspecialchars($row["nama_organisasi"]);
        }
        if (!empty($row["nama_pengirim"])) {
            echo " | Pengirim: " . htmlspecialchars($row["nama_pengirim"]);
        }

        // Jika ada file, tampilkan link download
        if (!empty($row["file"])) {
            $filePath = "file/" . htmlspecialchars($row["file"]); // Sesuaikan dengan direktori penyimpanan file
            echo " | <a href='$filePath' target='_blank'>Lihat File</a>";
        }

        echo "</li>";
    }
} else {
    echo "<p>Tidak ada hasil ditemukan.</p>";
}
?>
</ul>

<!-- Script untuk Scroll Otomatis -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if ($searchPerformed) { ?>
            var searchResults = document.getElementById("searchResults");
            if (searchResults) {
                searchResults.scrollIntoView({ behavior: "smooth" });
            }
        <?php } ?>
    });
</script>
