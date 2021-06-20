<?php if ($_GET[act] == '') { ?>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Jadwal Perlombaan </h3>
        <?php if ($_SESSION[level] == '1' || $_SESSION[level] == '3') { ?>
          <a class='pull-right btn btn-primary btn-sm' href='index.php?view=jadwallomba&act=tambah'>Tambah Data</a>
        <?php } ?>

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
                  </form>

      </div><!-- /.box-header -->
      <div class="box-body">
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

            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul_lomba a LEFT JOIN tbl_ekskul b ON a.kode_ekskul = b.kode_ekskul WHERE a.kode_ekskul = '$_GET[ekskul]' ORDER BY a.tgl_daftar DESC");

            while ($r = mysqli_fetch_array($tampil)) {

              echo "<tr><td>$no</td>
              <td>$r[nama_ekskul]</td>
                              <td>$r[nama_kegiatan]</td>
                              <td>$r[tgl_daftar]</td>
                              <td>$r[tgl_tutup]</td>
                              <td>$r[tingkat]</td>";

              
                echo "<td><center>
                                <a class='btn btn-info btn-xs' title='Lihat Detail' href='?view=jadwallomba&act=detail&id=$r[kode_ekskul_lomba]'><span class='glyphicon glyphicon-search'></span></a>";


                        $cekdata = mysqli_query($koneksi, "SELECT nama_ekskul FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
                        $cek = mysqli_fetch_array($cekdata);

                        if($_SESSION[level]=='1' || $cek['nama_ekskul'] == $r[nama_ekskul]){
                                echo "<a class='btn btn-success btn-xs' title='Edit Data' href='?view=jadwallomba&act=vedit&id=$r[kode_ekskul_lomba]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=jadwallomba&hapus=$r[kode_ekskul_lomba]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
              } 
              echo "</tr>";
              $no++;
            }
            if (isset($_GET[hapus])) {
              $dir_gambar = 'file_lomba/';
              $gg = mysqli_query($koneksi, "SELECT file FROM tbl_ekskul_lomba WHERE kode_ekskul_lomba =" . $_GET[hapus]);
              $dg = mysqli_fetch_array($gg);
              unlink($dir_gambar . $dg[file]);
              mysqli_query($koneksi, "DELETE FROM tbl_ekskul_lomba where kode_ekskul_lomba='$_GET[hapus]'");
              echo "<script>document.location='index.php?view=jadwallomba';</script>";
            }

            ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
<?php
} 

elseif ($_GET[act] == 'tambah') {
  if (isset($_POST[tambah])) {
    $dir_gambar = 'file_lomba/';
    $filename = basename($_FILES['ai']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['ai']['name']);
    $uploadfile = $dir_gambar . $filenamee;
    if ($_POST[ad] < $_POST[ac] or $_POST[ac] < date('Y-m-d')) {
      echo "<script>
  alert('Tanggal Pendaftraan/Penutupan Lomba Tidak Benar!');
  </script>";
    } elseif ($_POST[ae] < $_POST[ad]) {
      echo "<script>
  alert('Tanggal Perlombaan Tidak Benar!');
  </script>";
    } else {
      if ($filename != '') {
        if (move_uploaded_file($_FILES['ai']['tmp_name'], $uploadfile)) {
          mysqli_query($koneksi, "INSERT INTO tbl_ekskul_lomba(kode_ekskul, nama_kegiatan, tgl_daftar, tgl_tutup, tgl_lomba, penyelenggara, lokasi, tingkat, file_lomba) VALUES ('$_POST[aa]','$_POST[ab]','$_POST[ac]','$_POST[ad]','$_POST[ae]','$_POST[af]','$_POST[ag]','$_POST[ah]','$uploadfile')");
        }
      } else {
        mysqli_query($koneksi, "INSERT INTO tbl_ekskul_lomba(kode_ekskul, nama_kegiatan, tgl_daftar, tgl_tutup, tgl_lomba, penyelenggara, lokasi, tingkat) VALUES ('$_POST[aa]','$_POST[ab]','$_POST[ac]','$_POST[ad]','$_POST[ae]','$_POST[af]','$_POST[ag]','$_POST[ah]')");
      }
      echo "<script>document.location='index.php?view=jadwallomba';</script>";
    }
  }

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Jadwal</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody><tr><th scope='row'>Ektrakulikuler</th>
                  <td><select class='form-control' name='aa'> 
                  <option value='0' selected>- Pilih Ekstrakurikuler -</option>";




$data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
$ss = mysqli_fetch_array($data);

if ($_SESSION[level] == '3') {
$ekstrakurikuler = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_ekskul = '$ss[kode_ekskul]'");
} else {


  $ekstrakurikuler = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul");

}


  while ($y = mysqli_fetch_array($ekstrakurikuler)) {
    if ($s[kode_ekskul] == $y[kode_ekskul]) {
      echo "<option value='$y[kode_ekskul]' selected>$y[nama_ekskul]</option>";
    } else {
      echo "<option value='$y[kode_ekskul]'>$y[nama_ekskul]</option>";
    }
  }

  echo "</select></td></tr>
                  <tr><th scope='row'>Nama Kegiatan</th>
                  <td><input type='text' class='form-control' name='ab'></td>
                  </tr>                  
                  <tr><th scope='row'>Tanggal Pendaftraan</th>
                  <td><input type='date' class='form-control' name='ac'></td>
                  </tr>
                  <tr><th scope='row'>Tanggal Penutupan</th>
                  <td><input type='date' class='form-control' name='ad'></td>
                  </tr>
                  <tr><th scope='row'>Tanggal Perlombaan</th>
                  <td><input type='date' class='form-control' name='ae'></td>
                  </tr>
                  <tr><th scope='row'>Penyelenggara</th>
                  <td><input type='text' class='form-control' name='af'></td>
                  </tr>
                  <tr><th scope='row'>Lokasi</th>
                  <td><input type='text' class='form-control' name='ag'></td>
                  </tr>
                  <tr><th scope='row'>Tingkat</th>
                  <td><input type='text' class='form-control' name='ah'></td>
                  </tr>
                  <tr><th scope='row'>File Jadwal Perlombaan</th>             <td><div style='position:relative;''>
                  <a class='btn btn-primary' href='javascript:;'>
                    <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
  <input type='file' class='files' name='ai' onchange='$("#upload-file-info").html($(this).val());'>
<?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                </div>
                </td></tr>

                  </tbody>
                  </table>
                </div>
                <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                          <a href='index.php?view=jadwallomba'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                        </div> 
              </div>
            </form>
            </div>";}

  elseif ($_GET[act] == 'vedit') {

  $idnya = $_GET['id'];

  if (isset($_POST[edit])) {
    $dir_gambar = 'file_lomba/';
    $filename = basename($_FILES['ai']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['ai']['name']);
    $uploadfile = $dir_gambar . $filenamee;

    if ($_POST[ad] < $_POST[ac] or $_POST[ac] < date('Y-m-d')) {
      echo "<script>
  alert('Tanggal Pendaftraan/Penutupan Lomba Tidak Benar!');
  </script>";
    } elseif ($_POST[ae] < $_POST[ad]) {
      echo "<script>
  alert('Tanggal Perlombaan Tidak Benar!');
  </script>";
    } else {

      if ($filename != '') {
        if (move_uploaded_file($_FILES['ai']['tmp_name'], $uploadfile)) {
          $gg = mysqli_query($koneksi, "SELECT file_lomba FROM tbl_ekskul_lomba WHERE kode_ekskul_lomba =" . $idnya);
          $dg = mysqli_fetch_array($gg);
          unlink($dir_gambar . $dg[file]);


$tes = "UPDATE tbl_ekskul_lomba SET 
      kode_ekskul = '$_POST[aa]',
      nama_kegiatan = '$_POST[ab]',
      tgl_daftar = '$_POST[ac]', 
      tgl_tutup = '$_POST[ad]',
      tgl_lomba = '$_POST[ae]',
      penyelenggara = '$_POST[af]',
      lokasi = '$_POST[ag]',
      tingkat = '$_POST[ah]',
        file_lomba  = '$filenamee'

         WHERE kode_ekskul_lomba = $_GET[id]";

          $sqlup = mysqli_query($koneksi, $tes);

         

         echo "<script>document.location='index.php?view=jadwallomba';</script>";
        }
      } else {
        $sqlup = mysqli_query($koneksi, "UPDATE tbl_ekskul_lomba SET 
      kode_ekskul = '$_POST[aa]',
      nama_kegiatan = '$_POST[ab]',
      tgl_daftar = '$_POST[ac]', 
      tgl_tutup = '$_POST[ad]',
      tgl_lomba = '$_POST[ae]',
      penyelenggara = '$_POST[af]',
      lokasi = '$_POST[ag]',
      tingkat = '$_POST[ah]'
      WHERE kode_ekskul_lomba = $_GET[id]");
        echo "<script>document.location='index.php?view=jadwallomba';</script>";
      }
    }
  }

  $sql = "SELECT p.*, e.nama_ekskul FROM tbl_ekskul_lomba p LEFT JOIN tbl_ekskul e ON p.kode_ekskul = e.kode_ekskul WHERE p.kode_ekskul_lomba = '$_GET[id]'";
  $vedit = mysqli_query($koneksi, $sql);
  $s = mysqli_fetch_array($vedit);

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Jadwal</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody><tr><th scope='row'>Ektrakulikuler</th>
                  <td><select class='form-control' name='aa'> 
                  <option value='0' selected>- Pilih Ekstrakurikuler -</option>";

$data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
$ss = mysqli_fetch_array($data);

if ($_SESSION[level] == '3') {
$ekstrakurikuler = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_ekskul = '$ss[kode_ekskul]'");
} else {


  $ekstrakurikuler = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul");

}


  while ($y = mysqli_fetch_array($ekstrakurikuler)) {


    if ($y[kode_ekskul] == $s[kode_ekskul]) {
      echo "<option value='$y[kode_ekskul]' selected>$y[nama_ekskul]</option>";
    } else {
      echo "<option value='$y[kode_ekskul]'>$y[nama_ekskul]</option>";
    }
  }

  echo "</select></td></tr>
                  <tr><th scope='row'>Nama Kegiatan</th>
                  <td><input type='text' class='form-control' name='ab' value = '$s[nama_kegiatan]'></td>
                  </tr>                  
                  <tr><th scope='row'>Tanggal Pendaftraan</th>
                  <td><input type='date' class='form-control' name='ac' value = '$s[tgl_daftar]'></td>
                  </tr>
                  <tr><th scope='row'>Tanggal Penutupan</th>
                  <td><input type='date' class='form-control' name='ad' value = '$s[tgl_tutup]'></td>
                  </tr>
                  <tr><th scope='row'>Tanggal Perlombaan</th>
                  <td><input type='date' class='form-control' name='ae' value = '$s[tgl_lomba]'></td>
                  </tr>
                  <tr><th scope='row'>Penyelenggara</th>
                  <td><input type='text' class='form-control' name='af' value = '$s[penyelenggara]'></td>
                  </tr>
                  <tr><th scope='row'>Lokasi</th>
                  <td><input type='text' class='form-control' name='ag' value = '$s[lokasi]'></td>
                  </tr>
                  <tr><th scope='row'>Tingkat</th>
                  <td><input type='text' class='form-control' name='ah' value = '$s[tingkat]'></td>
                  </tr>
                  <tr><th scope='row'>File Jadwal Perlombaan</th>             <td><div style='position:relative;''>
                  <a class='btn btn-primary' href='javascript:;'>
                    <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
  <input type='file' class='files' name='ai' onchange='$("#upload-file-info").html($(this).val());'>
<?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                </div>
                </td></tr>

                  </tbody>
                  </table>
                </div>
                <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='edit' class='btn btn-info'>Ubah</button>
                          <a href='index.php?view=jadwallomba'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                        </div> 
              </div>
            </form>
            </div>";
} 




elseif ($_GET[act] == 'detail') {
  $dir_gambar = 'file_lomba/';
  $det = mysqli_query($koneksi, "SELECT p.*, e.nama_ekskul FROM tbl_ekskul_lomba p LEFT JOIN tbl_ekskul e ON p.kode_ekskul = e.kode_ekskul WHERE p.kode_ekskul_lomba = '$_GET[id]'");
  $s = mysqli_fetch_array($det);
  
  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Jadwal Perlombaan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_ekskul_lomba]'>
                    <tr><th width='140px' scope='row'>Ekstrakurikuler</th> <td>$s[nama_ekskul]</td></tr>
                    <tr><th width='140px' scope='row'>Nama Kegiatan</th> <td>$s[nama_kegiatan]</td></tr>
                    <tr><th scope='row'>Tanggal Pendaftraan</th>       <td>$s[tgl_daftar]</td></tr>
                    <tr><th scope='row'>Tanggal Penutupan</th>    <td>$s[tgl_tutup]</td></tr>
                    <tr><th scope='row'>Tanggal Lomba</th>    <td>$s[tgl_lomba]</td></tr>
                    <tr><th scope='row'>Penyelenggara</th>    <td>$s[penyelenggara]</td></tr>
                    <tr><th scope='row'>Lokasi</th>  <td>$s[lokasi]</td></tr>
                    <tr><th scope='row'>Tingkat</th>            <td>$s[tingkat]</td></tr>
                    <tr><th scope='row'>File</th>           <td><a target='_BLANK' href='$s[file_lomba]'>Unduh File</a></td></tr>
                  </tbody>
                  </table>
                </div>
              </div><div class='box-footer'>";
              $data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
              $ss = mysqli_fetch_array($data);

               if ($_SESSION[level] == '1' || $s[kode_ekskul] == $ss[kode_ekskul]) {

              
              echo "<a class='btn btn-warning' title='Ubah' href='?view=jadwallomba&act=vedit&id=$s[kode_ekskul_lomba]'>Ubah</a>";
              }

if ($_SESSION[level] == '1' || $_SESSION[level] == 'siswa' || $s[kode_ekskul] == $ss[kode_ekskul]) {        
echo "<a href='index.php?view=jadwallomba&act=daftarlomba&id=$_GET[id]'><button type='button' class='btn btn-primary pull-left'>Mendaftar</button></a>";
}

                   echo "<a href='index.php?view=jadwallomba'><button type='button' class='btn btn-default pull-right'>Kembali</button></a> 
              </div></form>
            </div></div>";
?>

            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Siswa Terdaftar Perlombaan</h3>
                </div>
              <div class='box-body'>



                  <table class='table table-condensed table-bordered'>
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>NISN</th>
                      <th>NAMA</th>
                      <th>KELAS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  $no =1;
                    $datalomsis = mysqli_query($koneksi, "SELECT b.*, c.* FROM `tbl_ekskul_lomba_daftar` LEFT JOIN tbl_siswa b ON b.kode_siswa = tbl_ekskul_lomba_daftar.kode_siswa LEFT JOIN tbl_ekskul_lomba c ON c.kode_ekskul_lomba = tbl_ekskul_lomba_daftar.kode_ekskul_lomba WHERE c.kode_ekskul_lomba=$_GET[id]");
                    while($lomsi = mysqli_fetch_array($datalomsis)){
                    ?>

                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $lomsi['nisn'] ?></td>
                      <td><?= $lomsi['nama'] ?></td>
                      <?php
                      $datacls= mysqli_query($koneksi,"SELECT a.nama_kelas, b.nama_jurusan FROM `tbl_kelas` a LEFT JOIN tbl_jurusan b ON b.kode_jurusan = a.kode_jurusan WHERE a.kode_kelas = $lomsi[kode_kelas]");
                      $cls = mysqli_fetch_array($datacls);
                      ?>
                      <td><?= $cls['nama_kelas'] ?> - <?= $cls['nama_jurusan'] ?></td>
                    </tr>

                    <?php $no++;} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php }

  elseif($_GET[act]=='daftarlomba'){
  if (isset($_POST[daftarlomba])){

    $sqlcek = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul_lomba_daftar WHERE kode_ekskul_lomba = '$_GET[id]' AND kode_siswa = '$_POST[a]'");
    $hitung = mysqli_num_rows($sqlcek);

    if ($hitung >= 1) {
      echo "<script>alert('Siswa Sudah Terdaftar di Lomba Ini!');</script>";
      echo"<script>window.history.back();</script>";
    } else {

    $sql = "INSERT INTO `tbl_ekskul_lomba_daftar` (`kode_ekskul_lomba`, `kode_siswa`) VALUES ('$_GET[id]', '$_POST[a]');";
    mysqli_query($koneksi,$sql);
    echo "<script>document.location='index.php?view=jadwallomba&act=detail&id=$_GET[id]';</script>";
    }
  }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Pendaftaran Lomba</h3>
                </div>
                <div class='box-body'>
                <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                              <tr><th scope='row'>Nama Siswa</th> <td><select class='form-control' name='a'> 
                              <option value='0' selected>- Pilih Siswa -</option>"; 

                              if ($_SESSION['level'] == 'siswa') {
                                $siswa = mysqli_query($koneksi,"SELECT * FROM tbl_siswa WHERE kode_siswa = '$_SESSION[id]'");
                              } else {
                              $siswa = mysqli_query($koneksi,"SELECT * FROM tbl_siswa");
                              }
                              while($a = mysqli_fetch_array($siswa)){
                                echo "<option value='$a[kode_siswa]'>$a[nisn] - $a[nama]</option>";
                                                                              }

                      $datakg= mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_lomba` WHERE kode_ekskul_lomba = '$_GET[id]'");
                      $kg = mysqli_fetch_array($datakg);
                       
                       echo "</select></td></tr>
                       <tr><th scope='row'>Nama Kegiatan Lomba</th> <td>  </td><input class='form-control' disabled value='$kg[nama_kegiatan]'></tr>

                       <br>
                       <button type='submit' name='daftarlomba' class='btn btn-primary'>Mendaftar Lomba</button>
                       <a href='index.php?view=jadwallomba&act=detail&id=$_GET[id]'><button type='button' class='btn btn-default pull-right'>Kembali</button></a> 

                       </form>

                       

                </div>
            </div>
        </div>";
} ?>