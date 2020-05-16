<?php 

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows []= $row;
    }
    /* Return atau dalam bahasa Indonesia "Mengembalikan" adalah sebuah pernyataan yang 
    digunakan untuk menghetikan dan mengembalikan nilai yang telah dihasilkan didalam Fungsi / function.*/
    return $rows;
}

function tambah($data) {
    global $conn;

    // fungsi htmlspecialchars() yaitu mencegah hack user
  // ambil data dari tiap elemen di form
    $npm = htmlspecialchars($data["npm"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    // query insert data
    $query = ("INSERT INTO mahasiswa VALUES('',
                '$nama', '$npm', '$email', '$jurusan', '$gambar') ");
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yg di upload
    if( $error === 4 ) {
        // jika tidak ada yg di upload tampilkan pesan kesalahan
        echo "
                <script>
                    alert('Pilih gambar terlebih dahulu!');
                </script>
            ";
        return false;
    }

    // cek apakah file yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "
                <script>
                    alert('Yang anda Upload bukan gambar!');
                </script>
            ";
    }

    // cek jika ukuran gambar terlalu besar
    if ( $ukuranFile > 2000000 ) {
        echo "
                <script>
                    alert('Ukuran gambar terlalu besar!');
                </script>
            ";

            return false;
    }
 
    // jika lolos pengecekan , gambar siap diupload
    // generate nama gambar baru
$namaFileBaru = uniqid();
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);


    return $namaFileBaru; 
}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id =$id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
     global $conn;

    // fungsi htmlspecialchars() yaitu mencegah hack user
  // ambil data dari tiap elemen di form
// htmlspecialchars() ini digunakan hanya untuk data yg di inputkan oleh user saja
    $id = $data["id"];
    $npm = htmlspecialchars($data["npm"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
   

    // query insert data
    $query = "UPDATE mahasiswa SET 
                npm = '$npm',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa WHERE
    npm LIKE '%$keyword%' OR
    nama LIKE '%$keyword%' OR
    email LIKE  '%$keyword%' OR
    jurusan LIKE  '%$keyword%'
    ";

    return query($query);
}

?>