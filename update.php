<?php
// include database connection file
include "koneksi2.php";
// Display selected user data based on id
// Getting nim from url
$no = $_GET['kode_destinasi'];
// Fetech user data based on nim
$stmt = $conn->prepare("SELECT * FROM pelanggan WHERE           kode_destinasi= ?");
$stmt->bind_param("s", $no);
$stmt->execute();
$result = $stmt->get_result();
while ($user_data = $result->fetch_assoc()) {
$kode_destinasi = $user_data['kode_destinasi'];
$nama_destinasi  = $user_data['nama_destinasi'];
$alamat = $user_data['alamat'];
$harga_tiket = $user_data['harga_tiket'];
$propinsi = $user_data['propinsi'];
$foto = $user_data["foto"];
}
?>

<html>

<head>
<meta charset="utf-8" />
<link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>UPDATE Data </title>
 
   <style type="text/css" > 
  *,html,body{
    scroll-behavior: smooth;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    color:black;
    }       
    body{ 
    font-family:Times New Roman ;            
    color: black;
    font-size:26px;
    text-align:center;
    padding-top:30px;
    background-image:  url("1.jpg");  
    } 

   .persyaratan{
    font-size: 13px;
    margin-top: 5px;
    font-family:'Ubuntu';
    color:white;
    font-style: normal;
    font-family: Times New Roman;
    font-weight: lighter;
    text-align: center;
    line-height: 18px;
    text-shadow:2px 2px 2px black;
    font-weight:bolder;
    }
   input{
   font-size: 15px;
   background:orange;
   text-align: center;
   }
    textarea{
    font-size: 15px;
    background: orange;
    text-align: center;
    height:110px;
    width:230px;
   }
    p{
    color:white;
    font-size: 15px;
    padding-bottom: 25px;
    padding-top: -25px;
    }
    button{
    font-size: 15px;
    }
    select{
    font-size: 15px;
    }

   .alamat{
    background:orange;
    text-align: center;
    border-radius:5px;
    box-shadow:0 5px 5px 0 rgba(1,1,1,.9);
    }
    a{
    font-size:15px;
    color:red;
    text-shadow:1px 1px 1px white;
    }

    select{
    font-size: 15px;
    background: orange;
    text-align: center;
    height:20px;
    width:100px;
    }
   .gbr{
    box-shadow:7px 7px 2px red;
    border-radius:5px;
    }
</style> 

</head>

<body>
<a href="tampil.php">Kembali ke Halaman Tampil</a>
<br/><br/>

<div class="form-container">
<form action="update.php" method="post" name="form1" enctype="multipart/form-data">

<p class="persyaratan" >Kode Anggota<br>
<input type="text" name="kode_destinasi" placeholder="masukan
Kode destinasi." value="<?php echo $kode_destinasi ; ?>"/></p>

<p class="persyaratan" >Nama </br>
<input type="text" name="nama_destinasi" placeholder="masukan nama.." value="<?php echo $nama_destinasi; ?>"></p>

<p class="persyaratan" >jenis kelamin</br>
<input type="text" name="harga_tiket" placeholder="masukan harga.." value="<?php echo $harga_tiket; ?>"></p>

<p class="persyaratan" >Kelas</br>
<input type="text" name="propinsi" placeholder="masukan harga.." value="<?php echo $harga_tiket; ?>"></p>

<p class="persyaratan">Alamat</br>
<textarea name="alamat"  cols="50" class="alamat" placeholder="masukan alamat.." rows="5"><?php echo $alamat; ?></textarea></p>


      
<p class="persyaratan" >Foto Anggota</br>
<input type="file" name="gbr"><br>
<img src="<?php echo $foto; ?>" height="95" width="90" class="gbr" ></p>
      
<p class="persyaratan">
<input type="submit" name="Submit" value="UPDATE"></p>

</div>
</div>
</form>
</div>

<?php
 
  // Check if form submitted, insert form data into the database table.
if (isset($_POST['Submit'])) {
$kode_destinasi = $_POST['kode_destinasi'];
$nama_destinasi  = $_POST['nama_destinasi'];
$alamat = $_POST['alamat'];
$harga_tiket = $_POST['harga_tiket'];
$propinsi = $_POST['propinsi'];
  // File upload code
if (isset($_FILES['gbr']) && $_FILES['gbr']['error'] === UPLOAD_ERR_OK) {
$foto = $_FILES['gbr']['name'];
$ekstensi = array('png', 'jpg');
$x = explode('.', $foto);
$ext = strtolower(end($x));
$file_tmp = $_FILES['gbr']['tmp_name'];
if (in_array($ext, $ekstensi) === true) {
move_uploaded_file($file_tmp, 'gambar/' . $foto);
// Insert user data into the database table
$result = mysqli_query($conn, "INSERT INTO         pelanggan(kode_destinasi ,nama_destinasi ,alamat,harga_tiket,propinsi, foto) VALUES ('$kode_destinasi', '$nama_destinasi ', '$alamat', '$harga_tiket ', '$propinsi', 'gambar/$foto')");
if ($result) {
 // Redirect to the index.php page
header("<p>Location: tampil.php</p>");
exit;
} else {
echo "<p>Gagal tersimpan.</p>";
}
} else {
echo "<p><script>alert('Ekstensi gambar yang diperbolehkan hanya jpg atau png.'); window.location='tambahdata.php';</script></p>";
exit;
}
} else {
echo "<p>Mohon pilih file gambar.</p>";
}
}

?>


<script src="https://cdn.jsdelivr.net/npm/@mui/material@5.1.3/dist/umd/mui.min.js"
    integrity="sha384-r1rF3A1fo+z8XleDFdsEcyS+ZdK9KOMGn0ax05hBY1Y2iSWiozKQRQ3iGWcWWOkw"
crossorigin="anonymous"></script>

</body>
</html>