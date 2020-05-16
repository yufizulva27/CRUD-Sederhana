<?php
// ini untuk menyiapkan data yg akan di tampilkan ke dalam tabel di bawah atau di dalam html
/* untuk memanggil file lain ada 2 cara yaitu menggunakan REQUIRE
atau INCLUDE keduanya sama walau ada  sedikit perbedaan.*/
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
// ORDER BY dalam query yaitu untuk mengurutkan data berdasarkan id terbarua maupun yg terlama
// ascending atau ASC : urutan dari terkecil - terbesar (maju)
// descending atau DESC : urutan dari terbesar - terkecil (mundur)

// tombol di tekan
if ( isset($_POST["cari"]) ) {
    // setelah tombol cari di tekAN
    $mahasiswa = cari($_POST["keyword"]) ;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>DAFTAR MAHASISWA</h1>
<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<form action="" method="post">
<!-- atribut html5 yaitu autofocus : untuk langsung cari data tanpa harus mengklik dulu form cari nya -->
<!-- atribut html5 yaitu placeholder : untuk panduan dalam form sperti "masukan keyword pencarian" -->
<!-- atribut html5 yaitu autocomplete : untuk menghilangkan history bekas pencarian -->
    <input type="text" name="keyword" size="40" autofocus 
    placeholder="Masukan keyword pencarian.." autocomplete="off">
    <button type="submit" name="cari">Cari</button>

</form>
<br>
    <table border="1" cellpadding="10" cellspacing="0">
      <!-- header -->
      <tr>
            <th>ID</th>
            <th>AKSI</th>
            <th>GAMBAR</th>
            <th>NAMA</th>
            <th>NPM</th>
            <th>EMAIL</th>
            <th>JURUSAN</th>
        </tr>
<!-- membuat variabel baru yaitu $row, ini untuk menandakan baris datanya -->
        <?php $i = 1; ?>
        <!-- foreach digunakan untuk melakukan looping pada array untuk menampilkan datanya -->
        <?php foreach( $mahasiswa as $row ) : ?>
        <tr>
        <!-- isi database / aksi -->
            <td><?= $i; ?> </td>
            <td>
                <a href="edit.php?id=<?= $row["id"]; ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a>
            </td>
            <td>
                <img src="img/<?= $row["gambar"]; ?>" width="60">
            </td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["npm"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr>
        <?php $i++ ; ?>
        <?php endforeach; ?>


    </table>



</body>
</html>