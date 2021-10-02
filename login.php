<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: content.html");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- font -->
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
        </style> 
     <!-- /font-->
    <meta charset="utf-8">
    <title>Login</title>
<link rel="stylesheet" type="text/css" href="style/style1.css">
   
</head>
<body>


<div class="bck">
        <p>&larr; <a href="/pendaftaran/index.html">Home</a>
            </div>
    <div class="judul">
        <h4>login</h4>
       </div>

        <form action="" method="POST">

            <div class="usrnm">
                <label for="username">username</label><br>
                <input class="form-control" type="text" name="username" placeholder="Username atau email" />
            </div>


            <div class="pswd">
                <label for="password">password</label><br>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

    <div class="subm">
            <input type="submit" name="login" value="masuk" />
        </div>
        </form>
            
        </div>
             
        <div class="ket">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>

    </div>
</div>
    
</body>
</html>