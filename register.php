<?php
// include database connection file
include "koneksi_login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>LOGIN UNPAM</title>
    <style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap');
*{
    font-family: 'poppins' ,sans-serif;
}
body{
    background-image: url("a13c2d0777ed7931b6969616ff2e74b5.gif");
    background-size: 500px;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
}
.box{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 90vh;
}
.container{
    width: 350px;
    display: flex;
    flex-direction: column;
    padding: 0 15px 0 15px;
    
}
span{
    color: black;
    font-size: small;
    display: flex;
    justify-content: center;
    padding: 10px 0 10px 0;
}
header{
    color: black;
    font-size: 25px;
    display: flex;
    justify-content: center;
    padding: 10px 0 10px 0;

font-family: Times New Roman;
}


.input-field .input{
    height: 24px;
    width: 77%;
margin-left: 20px;
    border: none;
    
    color: black;
    font-size: 15px;
    padding: 0 0 0 45px;
    background:#5F9EA0;
    outline: none;
margin-bottom: 20px;
box-shadow:0 5px 5px 0 rgba(1,1,1,.9);
}
.input-field .file{
    height: 24px;
    width: 77%;
    margin-left: 20px;
    border: none;
    color: white;
    font-size: 13px;
    padding: 0 0 0 45px;
    background:blue;
    outline: none;
    margin-top: 20px;
    margin-bottom: 20px;
    box-shadow:0 5px 5px 0 rgba(1,1,1,.9);
}

i{
    position: relative;
    top: -33px;
    left: 17px;
    color: #fff;
}
::-webkit-input-placeholder{
    color:#fff;
}
.submit{
    border: none;
    border-radius: 30px;
    font-size: 15px;
    height: 45px;
    outline: none;
    width: 25%;
    color: white;
    background: red;
    cursor: pointer;
    transition: .3s ;
    margin-left: 130px;
    margin-bottom: 30px;
    margin-top: 10px;
box-shadow:0 5px 5px 0 rgba(1,1,1,.9);
}
}
.submit:hover{
    box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
}
.two-col{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    color: black;
    font-size: small;
    margin-top: 10px;
}
.one{
    display: flex;
}
label a{
    text-decoration: none;
    color: black;
}
.logo{
height:75px;
width:100px;
margin-left:125px;
}
    </style>

</head>
<body>
  <form action="register.php" method="post" name="form1" enctype="multipart/form-data">
   <div class="box">
    <div class="container">

        <div class="top">
          <img src="rumus unpam logo.png"class="logo">
            <span>UKM RUMUS</span>
            <header>Register</header>
        </div>
 	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
        <div class="input-field">
            <input type="text"name="nama"class="input" placeholder="Nama" id="">
            <i class='bx bx-user' ></i>
        </div>
   <div class="input-field">
            <input type="text"name="user_name"class="input" placeholder="Email" id="">
            <i class='bx bx-envelope' ></i>
        </div>
        <div class="input-field">
            <input type="number"name="id"class="input" placeholder="Password" id="">
            <i class='bx bx-lock-alt'></i>
        </div>
        
 <div class="input-field">
            <input type="Password"name="password"class="input" placeholder="Konfirmasi Password" id="">
            <i class='bx bx-lock-alt'></i>
        </div>
           <div class="input-field">
            <input type="file"name="gbr"class="file" placeholder="Nama" id="">
            <i class='bx bx-image-add' ></i>
        </div>
        
        <div class="input-field">
            <input type="submit" name="Submit"class="submit" value="Register" id="">
        </div>

        <div class="two-col">
            <div class="one">
               <input type="checkbox" name="" id="check">
               <label for="check"> Remember Me</label>
            </div>
            
            
            <div class="two">
                <label><a href="index.html">Kembali Login?</a></label>
            </div>
        </div>
    </div>
</div>  
 </form>
 
   <?php
  // Check if form submitted, insert form data into the database table.
  if (isset($_POST['Submit'])) {
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $user_name = $_POST['user_name'];
    $id = $_POST['id'];
 
    
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
        $result = mysqli_query($conn, "INSERT INTO users(nim, user_name, password, name, foto) VALUES ('$id', '$user_name', '$password', '$nama', 'gambar/$foto')");
        echo "<br><br><br><p>Data baru telah tersimpan</p>";
        if ($result) {
          // Redirect to the index.php page
          header("Location: index.html");
          exit;
        } else {
          echo "Gagal tersimpan.";
        }
      } else {
        echo "<script>alert('Ekstensi gambar yang diperbolehkan hanya jpg atau png.'); window.location='register.php';</script>";
        exit;
      }
    } else {
      echo "Mohon pilih file gambar.";
    }
  }
  ?>
</body>
</html>