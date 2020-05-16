<?php
require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];


// cek tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    // cek data apakah sudah di ubah atau tidak(gagal) menggunakan alert javascript
    if( ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
         echo "
            <script>
                alert('Data gagal diubah!');
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
    <title>Ubah Data Mahasiswa</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>

<!-- didalam form terdapat atribut atribut wajib yaitu action="" dan method=""  -->
    <!-- atribut action="" yaitu untuk dikirim kemana data yg nantinya di dalam form tersebut -->
    <form action="" method="post" enctype="multipart/form-data">
    
    <!-- fungsi HIDDEN yg dimana data ini data tetapi user tidak tau kala data tersebut ada -->
    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
            <!-- fungsi required untuk menampilkan pesan kesalahan jika ada form yg belum diisi atau masih kosong -->
            <!-- required artinya jika jika kosong form nya tidak bisa di submit -->
                <label for="npm">NPM : </label>
                <input type="text" name="npm" id="npm" required value="<?= $mhs["npm"]; ?>">
            </li>
            <li>
                <label for="nama">NAMA : </label>
                <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="email">EMAIL : </label>
                <input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">JURUSAN : </label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">GAMBAR : </label> <br>
                <img src="img/<?= $mhs['gambar'];?> " width="50"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Update</button>
            </li>
        </ul>
        
    </form>
</body>
</html>