
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-EKSKUL</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="landing_page.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><h3>SI-EKSKUL</h3></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="index.php?view=login">LOGIN</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h4 class="m-0"> Selamat datang!</h4> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
<!--             <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Beranda</li>
              <li class="breadcrumb-item"><a href="">Login</a></li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg">


            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0"><b>Selamat Datang!</b></h5>
              </div>
              <div class="card-body">
                <p class="card-text">Sistem Informasi Ekstrakulikuler (SI-EKSKUL) adalah sebuah platform berbasis website untuk manajemen data Ekstrakulikuler.</p>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"><b>Jadwal Perlombaan</b></h5>
              </div>
              <div class="card-body">


                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action="?view=jadwallomba" method='GET'>
                    <input type="hidden" name='view' value='jadwallomba'>
                    <select name='ekskul' style='padding:4px; margin-right:5px;'>
                        <?php  
                            echo "<option value=''>- Filter ekskul</option>";
                            $ekskul = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul");
                            while ($k = mysqli_fetch_array($ekskul)){
                              if ($_GET[ekskul]==$k[kode_ekskul]){
                                echo "<option value='$k[kode_ekskul]' selected>$k[kode_ekskul] - $k[nama_ekskul]</option>";
                              }else{
                                echo "<option value='$k[kode_ekskul]'>$k[kode_ekskul] - $k[nama_ekskul]</option>";
                              }
                            }
                        ?>
                    </select>
                    <input type="submit" style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
                  </form><br>



                <?php 
                  if (isset($_GET[ekskul])){ ?>
                    <table id="example1" class="table table-bordered table-striped">
                  <?php }else{ ?>
                    <table id="example1" class="table table-bordered table-striped">
                  <?php } ?>

        
          <thead>
            <tr>
              <th>No</th>
              <th>Ekskul</th>
              <th>Nama Kegiatan</th>
              <th>Tanggal Pendaftraan</th>
              <th>Tanggal Penutupan</th>
              <th>Tingkat</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            if ($_GET['ekskul'] != '') {
              $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul_lomba a LEFT JOIN tbl_ekskul b ON a.kode_ekskul = b.kode_ekskul WHERE a.kode_ekskul = '$_GET[ekskul]' ORDER BY a.tgl_daftar DESC");  
            } else {
              $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul_lomba a LEFT JOIN tbl_ekskul b ON a.kode_ekskul = b.kode_ekskul ORDER BY a.tgl_daftar DESC");
            }
            

            while ($r = mysqli_fetch_array($tampil)) {

              echo "<tr><td>$no</td>
              <td>$r[nama_ekskul]</td>
                              <td>$r[nama_kegiatan]</td>
                              <td>$r[tgl_daftar]</td>
                              <td>$r[tgl_tutup]</td>
                              <td>$r[tingkat]</td>";
                                echo "<td><a class='btn btn-success btn-xs' title='Mendaftar' href='index.php?view=login&lomba=$r[kode_ekskul_lomba]'>Mendaftar</a>
                              </center></td>";

              echo "</tr>";
              $no++;
            } ?>
          </tbody>
        </table>




              </div>
            </div>

          </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <center>
    <strong>Copyright &copy; 2021 <a href="landing_page.php">SI-EKSKUL</a></strong>
    </center>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script>
</body>
</html>
