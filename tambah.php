<?php
require 'functions.php';

// cek tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {


    // cek data apakah sudah di tambah atau tidak(gagal) menggunakan alert javascript
    if( tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
     ";
    } else {
         echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

<!-- didalam form terdapat atribut atribut wajib yaitu action="" dan method=""  -->
    <!-- atribut action="" yaitu untuk dikirim kemana data yg nantinya di dalam form tersebut -->
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
            <!-- fungsi required untuk menampilkan pesan kesalahan jika ada form yg belum diisi atau masih kosong -->
            <!-- required artinya jika jika kosong form nya tidak bisa di submit -->
                <label for="npm">NPM : </label>
                <input type="text" name="npm" id="npm" required>
            </li>
            <li>
                <label for="nama">NAMA : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">EMAIL : </label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="jurusan">JURUSAN : </label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar">GAMBAR : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
        
    </form>
</body>
</html>