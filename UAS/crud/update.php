<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['id_barang'])) {
        $id_peserta=input($_GET["id_barang"]);

        $sql="select * from toko_fridtz where id_barang=$id_barang";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peserta=htmlspecialchars($_POST["id_barang"]);
        $nama=input($_POST["nama_barang"]);
        $deskripsi_barang=input($_POST["deskripsi_barang"]);
        $harga_barang=input($_POST["harga_barang"]);
        $stok_barang=input($_POST["stok_barang"]);

        //Query update data pada tabel anggota
        $sql="update toko_fridtz set
			nama_barang='$nama_barang',
			deskripsi_barang='$deskripsi_barang',
			harga_barang='$harga_barang',
			stok_barang='$stok_barang'
			where id_barang=$id_barang";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Barang :</label>
            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang" required />

        </div>
        <div class="form-group">
            <label>Deskripsi Barang :</label>
            <input type="text" name="deskripsi_barang" class="form-control" placeholder="Masukan Deskripsi Barang" required/>
        </div>
        <div class="form-group">
            <label>harga_barang :</label>
            <input type="text" name="harga_barang" class="form-control" placeholder="Masukan Harga Barang" required/>
        </div>
        <div class="form-group">
            <label>Stok Barang:</label>
            <textarea name="stok_barang" class="form-control" rows="5"placeholder="Masukan Stok Barang" required></textarea>
        </div>

        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>