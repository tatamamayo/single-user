<?php
// karena kita pakai session
session_start();
// untuk koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "coba-1";
$koneksi = mysqli_connect($host, $user, $pass, $db);
//untuk mendefinisikan variabel
$err = "";
$username = "";

// untuk pengecekan ketika seorang user menekan tombol login
if(isset($_POST['login'])){
    // masukkan variabel = didapatkan dari
    $username = $_POST['username'];
    $password = $_POST['password'];

    // memastikan username dan password tidak kosong
    if($username == '' || $password == ''){
        $err .= "<li>username dan password tidak boleh kosong</li>";
    }else{ // jika username dan password tidak kosong 
        $sql1 = "SELECT * FROM login WHERE username = '$username'";
        // menghubungkan variabel $sql1 dengan database
        $q1 = mysqli_query($koneksi, $sql1);
        // untuk mengambil data dari hasil query database dan menyimpannya dalam bentuk array
        $r1 = mysqli_fetch_array($q1);

        // perintah untuk melakukan pengecekan username yang dimasukkan ada datanya
        if ($r1 !== null) {
            if ($r1['username'] == '') {
                $err .= "<li>username <b>$username</b> tidak ditemukan</li>";
            } elseif ($r1['password'] != md5($password)) {
                $err .= "<li>Password yang dimasukkan tidak sesuai</li>";
            }
        } else {
            $err .= "<li>Data pengguna tidak ditemukan</li>";
        }
        
        // kalau tidak ada error
        if(empty($err)){
            // $_SESSION untuk mengambil data, ['username'] untuk kasih nama sessionnya
            $_SESSION['session_username'] = $username;// disimpan dalam server
            $_SESSION['session_password'] = md5($password);
            // untuk mengarahkan user jika berhasilar kehalaman lain
            header('location: setelahmasuk.php');
            // buat file baru
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hehe Not Bad !</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="container my-4">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Login dan Masuk Ke Sistem</div>
            </div>      
            <div style="padding-top:30px" class="panel-body" >
                <?php if($err){ ?>
                    <div id="login-alert" class="alert alert-danger col-sm-12">
                        <ul><?php echo $err ?></ul>
                    </div>
                <?php } ?>                
                <form id="loginform" class="form-horizontal" action="" method="post" role="form">       
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="login" class="btn btn-success" value="Login"/>
                        </div>
                    </div>
                </form>    
            </div>                     
        </div>  
    </div>
</div>
</body>
</html>