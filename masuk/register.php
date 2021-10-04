<?php

require_once("config.php");

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO users (name, username, email, password) 
            VALUES (:name, :username, :email, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":name" => $name,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/style2.css">
    <!-- font -->
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
        </style> 
    <title>Register</title>

</head>
    
    <div class="bck">
        <p>&larr; <a href="/pendaftaran/index.html">Home</a></p>
            </div>
    <div class="title">
        <h3>register</h3>
        </div>

        <div class="desc">
        <p>daftar dan carilah kebutuhanmu</p>
            </div>

        <form action="" method="POST">

            <div class="nama">
                <label for="name">Nama Lengkap</label><br>
                <input class="form-control" type="text" name="name" placeholder="Nama kamu" />
            </div>

            <div class="usrnm">
                <label for="username">Nama pengguna</label><br>
                <input class="form-control" type="text" name="username" placeholder="Username" />
            </div>

            <div class="eml">
                <label for="email">Email</label><br>
                <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
            </div>

            <div class="pswd">
                <label for="password">Password</label><br>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>
        <div class="subm">
            <input type="submit" class="subm" name="register" value="Daftar" />
            </div>
        </form>
            
        </div>
        <div class="footer">
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
<!--        <div class="col-md-6">
            <img class="img img-responsive" src="img/connect.png" />
        </div> -->

    </div>
</div>

</body>
</html>