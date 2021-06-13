<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SI-Ekskul | Log in</title>
    <meta name="author" content="2bagus.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>SISTEM INFORMASI</b> EKSTRAKURIKULER</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan Login Pada Form dibawah ini</p>

        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name='a' placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name='b' placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button name='login' type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

<?php 

if (isset($_POST[login])){
  $pass=md5($_POST[b]);

  $admin = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE username='".$_POST[a]."' AND password='$pass' AND kode_jabatan = '1'");

  $guru = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE username='".$_POST[a]."' AND password='$pass' AND kode_jabatan = '2'");

  $pembina = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE username='".$_POST[a]."' AND password='$pass' AND kode_jabatan = '3'");

  $kajur = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE username='".$_POST[a]."' AND password='$pass' AND kode_jabatan = '4'");

  $siswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE username='".$_POST[a]."' AND password='$pass'");


  echo $hitungadmin = mysqli_num_rows($admin);
  echo $hitungguru = mysqli_num_rows($guru);
  echo $hitungpembina = mysqli_num_rows($pembina);
  echo $hitungkajur = mysqli_num_rows($kajur);
  echo $hitungsiswa = mysqli_num_rows($siswa);


  if ($hitungadmin >= 1){
    $r = mysqli_fetch_array($admin);
    $_SESSION[id]     = $r[kode_pegawai];
    $_SESSION[namalengkap]  = $r[nama];
    $_SESSION[level]    = $r[kode_jabatan];
    include "config/user_agent.php";
    mysqli_query($koneksi,"INSERT INTO users_aktivitas VALUES('','$r[kode_pegawai]','$ip','$user_browser $version','$user_os','$r[kode_jabatan]','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
  }
  elseif ($hitungguru >= 1){
    $r = mysqli_fetch_array($guru);
    $_SESSION[id]     = $r[kode_pegawai];
    $_SESSION[namalengkap]  = $r[nama];
    $_SESSION[level]    = $r[kode_jabatan];
    include "config/user_agent.php";
    mysqli_query($koneksi,"INSERT INTO users_aktivitas VALUES('','$r[kode_pegawai]','$ip','$user_browser $version','$user_os','$r[kode_jabatan]','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
  }
  elseif ($hitungpembina >= 1){
    $r = mysqli_fetch_array($pembina);
    $_SESSION[id]     = $r[kode_pegawai];
    $_SESSION[namalengkap]  = $r[nama];
    $_SESSION[level]    = $r[kode_jabatan];
    include "config/user_agent.php";
    mysqli_query($koneksi,"INSERT INTO users_aktivitas VALUES('','$r[kode_pegawai]','$ip','$user_browser $version','$user_os','$r[kode_jabatan]','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
  }
  elseif ($hitungkajur >= 1){
    $r = mysqli_fetch_array($kajur);
    $_SESSION[id]     = $r[kode_pegawai];
    $_SESSION[namalengkap]  = $r[nama];
    $_SESSION[level]    = $r[kode_jabatan];
    include "config/user_agent.php";
    mysqli_query($koneksi,"INSERT INTO users_aktivitas VALUES('','$r[kode_pegawai]','$ip','$user_browser $version','$user_os','$r[kode_jabatan]','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
  }
  elseif ($hitungsiswa >= 1){
    $r = mysqli_fetch_array($siswa);
    $_SESSION[id]     = $r[kode_siswa];
    $_SESSION[namalengkap]  = $r[nama];
    $_SESSION[kode_kelas]     = $r[kode_kelas];
    $_SESSION[angkatan]     = $r[angkatan];
    $_SESSION[level]    = 'siswa';
    include "config/user_agent.php";
    mysqli_query($koneksi,"INSERT INTO users_aktivitas VALUES('','$r[kode_siswa]','$ip','$user_browser $version','$user_os','siswa','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
  }else{
    echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                                  window.location=('index.php?view=login')</script>";
  }


}
?>

          
