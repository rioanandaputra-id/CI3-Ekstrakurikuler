<?php
if ($_GET[act] == '') {
  cek_session_admin();
  if (isset($_POST[pindahkelas])) {
    if ($_POST[angkatan] != '' and $_POST[kelas] != '') {
      $jml = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) as jmlp FROM siswa where kode_kelas='$_POST[kelas]' AND angkatan='$_POST[angkatan]'"));
    } elseif ($_POST[angkatan] == '' and $_POST[kelas] != '') {
      $jml = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) as jmlp FROM siswa where kode_kelas='$_POST[kelas]'"));
    } elseif ($_POST[angkatan] != '' and $_POST[kelas] == '') {
      $jml = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) as jmlp FROM siswa where angkatan='$_POST[angkatan]'"));
    }

    $n = $jml[jmlp];
    $kelas = $_POST['kelaspindah'];
    $angkatan = $_POST['angkatanpindah'];
    for ($i = 0; $i <= $n; $i++) {
      if (isset($_POST['pilih' . $i])) {
        $nisn = $_POST['pilih' . $i];
        if ($angkatan != '' and $kelas != '') {
          mysqli_query($koneksi, "UPDATE siswa SET angkatan='$angkatan', kode_kelas='$kelas' where nisn='$nisn'");
        } elseif ($angkatan == '' and $kelas != '') {
          mysqli_query($koneksi, "UPDATE siswa SET kode_kelas='$kelas' where nisn='$nisn'");
        } elseif ($angkatan != '' and $kelas == '') {
          mysqli_query($koneksi, "UPDATE siswa SET angkatan='$angkatan' where nisn='$nisn'");
        }
      }
    }
    echo "<script>document.location='index.php?view=siswa&angkatan=" . $angkatan . "&kelas=" . $kelas . "';</script>";
  }
?>






  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> Data Pembina </h3>
        <?php if ($_SESSION[level] != 'kepala') { ?>
          <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=pembina&act=tambahpembina'>Tambahkan Data Pembina</a>
        <?php } ?>
      </div>
      <div class="box-body">
        <form action='' method='POST'>
          <input type="hidden" name='angkatan' value='<?php echo $_GET[angkatan]; ?>'>
          <input type="hidden" name='kelas' value='<?php echo $_GET[kelas]; ?>'>

          <?php
          if (isset($_GET[ekstrakurikuler])) {
            echo "<table id='myTable' class='table table-bordered table-striped'>
                            <tr><th></th>";
          } else {
            echo "<table id='example' class='table table-bordered table-striped'>
                            <thead>
                              <tr>";
          }
          echo "<th>No</th>
                        <th>NIP</th>
                        <th>Nama Pembina</th>
                        <th>NIK</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
          $tampil = mysqli_query($koneksi, "SELECT * FROM pembina ORDER BY nip DESC");
          $no = 1;
          while ($r = mysqli_fetch_array($tampil)) {
            echo "<tr><td>$no</td>
                              <td>$r[nip]</td>
                              <td>$r[nama_pembina]</td> 
                              <td>$r[nik]</td>
                              <td>$r[no_hp]</td>
                              <td>$r[email]</td>";
            if ($_SESSION[level] != 'kepala') {
              echo "<td><center>
              <a class='btn btn-default btn-xs' title='Lihat Detail' href='?view=pembina&act=detailpembina&id=$r[nip]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=pembina&act=edit&id=$r[nip]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=pembina&hapus=$r[nip]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
            }
            echo "</tr>";
            $no++;
          }

          if (isset($_GET[hapus])) {
            $gg = mysqli_query($koneksi, "SELECT foto FROM pembina WHERE nip =" . $_GET[hapus]);
            $dg = mysqli_fetch_array($gg);
            unlink($dg[foto]);
            mysqli_query($koneksi, "DELETE FROM pembina where nip='$_GET[hapus]'");
            echo "<script>document.location='index.php?view=pembina';</script>";
          }

          ?>
          </tbody>
          </table>
      </div><!-- /.box-body -->

    </div><!-- /.box -->
    <?php if ($_SESSION[level] != 'kepala') {
      if (isset($_GET[kelas])) { ?>
        <div class='box-footer'>
          Pindah Ke :
          <input type="number" name='angkatanpindah' style='padding:3px' placeholder='Angkatan' value='<?php echo $_GET[angkatan]; ?>'>
          <select name='kelaspindah' style='padding:4px' required>
            <?php
            echo "<option value=''>- Pilih Kelas -</option>";
            $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
            while ($k = mysqli_fetch_array($kelas)) {
              echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas]</option>";
            }
            ?>
          </select>
          <button style='margin-top:-5px' type='submit' name='pindahkelas' class='btn btn-sm btn-info'>Proses</button>
          <a href='index.php?view=siswa'><button type='button' class='btn btn-sm  btn-default pull-right'>Cancel</button></a>
        </div>
    <?php }
    } ?>

    </form>
  </div>
<?php

} elseif ($_GET[act] == 'detailpembina') {
  $nip = $_GET[id];
  $detail = mysqli_query($koneksi,"SELECT * FROM pembina WHERE nip = ".$nip);
  $s = mysqli_fetch_array($detail);


    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Pembina</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Pembina </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_pembina/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='$s[foto]'>";
                                }
                              if($_SESSION[level]!='kepala'){
                                echo "<a href='index.php?view=pembina&act=edit&id=$s[nip]' class='btn btn-success btn-block'>Edit Profile</a>";
                              }
                                echo "</th>
                            </tr>
                            <tr><th scope='row'>NIP</th> <td>$s[nip]</td></tr>
                            <tr><th scope='row'>Nama Pembina</th> <td>$s[nama_pembina]</td></tr>
                            <tr><th scope='row'>NIK</th> <td>$s[nik]</td></tr>
                            <tr><th scope='row'>No. HP</th> <td>$s[no_hp]</td></tr>
                            <tr><th scope='row'>Email</th> <td>$s[email]</td></tr>
                          </tbody>
                          </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                                                  <div class='box-footer'>
                    <a href='index.php?view=pembina'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>";




} 


elseif ($_GET[act] == 'tambahpembina') {
  if (isset($_POST[tambah])) {
    $data = md5($_post[b]);
    $pass = hash("sha512", $data);
    $dir_gambar = 'foto_pembina/';
    $filename = basename($_FILES['h']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['h']['name']);
    $uploadfile = $dir_gambar . $filenamee;
    if ($filename != '') {
      if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {
        mysqli_query($koneksi, "INSERT INTO pembina(nip, password, nama_pembina, id_jenis_kelamin, nik, no_hp, email, foto) VALUES('$_POST[a]','$pass','$_POST[c]','$_POST[d]','$_POST[e]',
           '$_POST[f]','$_POST[g]','$uploadfile')");
      }
    } else {
      mysqli_query($koneksi, "INSERT INTO pembina(nip, password, nama_pembina, id_jenis_kelamin, nik, no_hp, email) VALUES('$_POST[a]','$pass','$_POST[c]','$_POST[d]','$_POST[e]',
                               '$_POST[f]','$_POST[g]')");
    }
    echo "<script>document.location='index.php?view=pembina';</script>";
  }

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Pembina</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Pembina </a></li>
                      
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>NIP</th> <td><input type='text' class='form-control' name='a'></td></tr>
                              <tr><th scope='row'>Password</th> <td><input type='text' class='form-control' name='b'></td></tr>
                              <tr><th scope='row'>Nama Pembina</th> <td><input type='text' class='form-control' name='c'></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th>          <td><select class='form-control' name='d'> 
                                                                          <option value='0' selected>- Pilih Jenis Kelamin -</option>";
  $jk = mysqli_query($koneksi, "SELECT * FROM jenis_kelamin");
  while ($a = mysqli_fetch_array($jk)) {
    echo "<option value='$a[id_jenis_kelamin]'>$a[jenis_kelamin]</option>";
  }
  echo "</select></td></tr>
                              <tr><th scope='row'>NIK</th> <td><input type='text' class='form-control' name='e'></td></tr>
                              <tr><th scope='row'>No HP</th> <td><input type='text' class='form-control' name='f'></td></tr>
                              <tr><th scope='row'>Email</th> <td><input type='text' class='form-control' name='g'></td></tr>
                              <tr><th scope='row'>Foto</th>             <td><div style='position:relative;''>
                                                                            <a class='btn btn-primary' href='javascript:;'>
                                                                              <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
  <input type='file' class='files' name='h' onchange='$("#upload-file-info").html($(this).val());'>
  <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                          </div>
                              </td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                            <a href='index.php?view=pembina'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                          </div> 
                      </div>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>";
} elseif ($_GET[act] == 'edit') {
  $nip = $_GET['id'];

  if (isset($_POST[update])) {
    $dir_gambar = 'foto_pembina/';
    $filename = basename($_FILES['h']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['h']['name']);
    $uploadfile = $dir_gambar . $filenamee;

    if ($filename != '') {

      if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {
        $gg = mysqli_query($koneksi, "SELECT foto FROM pembina WHERE nip =" . $nip);
        $dg = mysqli_fetch_array($gg);
        unlink($dg[foto]);

        if ($_POST[b] != "") {
          $data = md5($_post[b]);
          $pass = hash("sha512", $data);
          mysqli_query($koneksi, "UPDATE `pembina` SET `nip`= '$_POST[a]',`password`= '$pass',`nama_pembina`= '$_POST[c]',`id_jenis_kelamin`= '$_POST[d]',`nik`= '$_POST[e]',`no_hp`= '$_POST[f]',`email`='$_POST[g]',`foto`= '$uploadfile' WHERE nip= $nip");
          echo "<script>document.location='index.php?view=pembina';</script>";
        } else {
          mysqli_query($koneksi, "UPDATE `pembina` SET `nip`= '$_POST[a]',`nama_pembina`= '$_POST[c]',`id_jenis_kelamin`= '$_POST[d]',`nik`= '$_POST[e]',`no_hp`= '$_POST[f]',`email`='$_POST[g]',`foto`= '$uploadfile' WHERE nip= $nip");
          echo "<script>document.location='index.php?view=pembina';</script>";
        }
      }
    } else {
      if ($_POST[b] != "") {
        $data = md5($_post[b]);
        $pass = hash("sha512", $data);
        mysqli_query($koneksi, "UPDATE `pembina` SET `nip`= '$_POST[a]',`password`= '$pass',`nama_pembina`= '$_POST[c]',`id_jenis_kelamin`= '$_POST[d]',`nik`= '$_POST[e]',`no_hp`= '$_POST[f]',`email`='$_POST[g]' WHERE nip= $nip");
        echo "<script>document.location='index.php?view=pembina';</script>";
      } else {
        mysqli_query($koneksi, "UPDATE `pembina` SET `nip`= '$_POST[a]',`nama_pembina`= '$_POST[c]',`id_jenis_kelamin`= '$_POST[d]',`nik`= '$_POST[e]',`no_hp`= '$_POST[f]',`email`='$_POST[g]' WHERE nip= $nip");
        echo "<script>document.location='index.php?view=pembina';</script>";
      }
    }
  }

  $ep = mysqli_query($koneksi, "SELECT * FROM pembina WHERE nip =" . $nip);
  while ($dp = mysqli_fetch_array($ep)) {
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Pembina</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Pembina </a></li>
                    </ul><br>
                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>NIP</th> <td><input value='$dp[nip]' type='text' class='form-control' name='a'></td></tr>
                              <tr><th scope='row'>Password</th> <td><input type='password' value='' class='form-control' name='b'></td></tr>
                              <tr><th scope='row'>Nama Pembina</th> <td><input type='text' value='$dp[nama_pembina]' class='form-control' name='c'></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th> <td><select class='form-control' name='d'> <option value='0' selected>- Pilih Jenis Kelamin -</option>";

    $jk = mysqli_query($koneksi, "SELECT * FROM jenis_kelamin");
    while ($y = mysqli_fetch_array($jk)) {
      if ($y[id_jenis_kelamin] == $dp[id_jenis_kelamin]) {
        echo "<option value='$y[id_jenis_kelamin]' selected>$y[jenis_kelamin]</option>";
      } else {
        echo "<option value='$y[id_jenis_kelamin]'>$y[jenis_kelamin]</option>";
      }
    }

    echo "</select></td></tr>
    <tr><th scope='row'>NIK</th> <td><input type='text'  value='$dp[nik]' class='form-control' name='e'></td></tr>
    <tr><th scope='row'>No HP</th> <td><input type='text' value='$dp[no_hp]' class='form-control' name='f'></td></tr>
    <tr><th scope='row'>Email</th> <td><input type='text' value='$dp[email]' class='form-control' name='g'></td></tr>

    <tr><th scope='row'>Foto</th>             <td><div style='position:relative;''>
    <a class='btn btn-primary' href='javascript:;'>
      <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
    <input type='file' class='files' name='h' onchange='$("#upload-file-info").html($(this).val());'>
  <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
  </div>
</td></tr>

    </tbody></table>
                          </div>
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='update' class='btn btn-info'>Edit</button>
                            <a href='index.php?view=pembina'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                          </div> 
                      </div>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>";
  }
} elseif ($_GET[act] == 'editsiswa') {
  cek_session_siswa();
  if (isset($_POST[update1])) {
    $rtrw = explode('/', $_POST[ai]);
    $rt = $rtrw[0];
    $rw = $rtrw[1];
    $dir_gambar = 'foto_siswa/';
    $filename = basename($_FILES['ao']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['ao']['name']);
    $uploadfile = $dir_gambar . $filenamee;
    if ($filename != '') {
      if (move_uploaded_file($_FILES['ao']['tmp_name'], $uploadfile)) {
        mysqli_query($koneksi, "UPDATE siswa SET 
                               nipd        = '$_POST[aa]',
                               nisn   = '$_POST[ab]',
                               password         = '$_POST[ac]',
                               nama       = '$_POST[ad]',
                               kode_kelas    = '$_POST[ae]',
                               angkatan   = '$_POST[af]',
                               ekstrakurikuler = '$_POST[bu]',
                               kode_jurusan   = '$_POST[ag]',
                               alamat        = '$_POST[ah]',
                               rt         = '$rt',
                               rw   = '$rw',
                               dusun    = '$_POST[aj]',
                               kelurahan       = '$_POST[ak]',
                               kecamatan     = '$_POST[al]',
                               kode_pos      = '$_POST[am]',
                               status_awal   = '$_POST[an]',
                               foto = '$filenamee',
                               status_siswa = '$_POST[bo]' where nipd='$_POST[id]'");
      }
    } else {
      mysqli_query($koneksi, "UPDATE siswa SET 
                               nipd        = '$_POST[aa]',
                               nisn   = '$_POST[ab]',
                               password         = '$_POST[ac]',
                               nama       = '$_POST[ad]',
                               kode_kelas    = '$_POST[ae]',
                               angkatan   = '$_POST[af]',
                               ekstrakurikuler = '$_POST[bu]',
                               kode_jurusan   = '$_POST[ag]',
                               alamat        = '$_POST[ah]',
                               rt         = '$rt',
                               rw   = '$rw',
                               dusun    = '$_POST[aj]',
                               kelurahan       = '$_POST[ak]',
                               kecamatan     = '$_POST[al]',
                               kode_pos      = '$_POST[am]',
                               status_awal   = '$_POST[an]',
                               status_siswa = '$_POST[bo]' where nipd='$_POST[id]'");
    }
    echo "<script>document.location='index.php?view=siswa&act=editsiswa&id=" . $_POST[id] . "';</script>";
  }

  if ($_SESSION[level] == 'siswa') {
    $nisn = $_SESSION[id];
    $close = 'readonly=on';
  } else {
    $nisn = $_GET[id];
    $close = '';
  }
  $edit = mysqli_query($koneksi, "SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                              LEFT JOIN jenis_kelamin c ON a.id_jenis_kelamin=c.id_jenis_kelamin 
                                  LEFT JOIN jurusan d ON b.kode_jurusan=d.kode_jurusan
                                    LEFT JOIN agama e ON a.id_agama=e.id_agama 
                                      where a.nisn='$nisn'");
  $s = mysqli_fetch_array($edit);
  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Siswa</h3>
                </div>
                <div class='box-body'>";

  if ($_SESSION[level] == 'siswa') {
    echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'> 
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span></button> <strong>Perhatian!</strong> - Semua Data-data yang ada dibawah ini akan digunakan untuk keperluan pihak sekolah, jadi tolong di isi dengan data sebenarnya dan jika kedapatan data yang diisikan tidak seuai dengan yang sebenarnya, maka pihak sekolah akan memberikan sanksi tegas !!!
                    </div>";
  }

  echo "<div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Siswa </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";
  if (trim($s[foto]) == '') {
    echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
  } else {
    echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
  }
  echo "</th></tr>
                            <input type='hidden' value='$s[nipd]' name='id'>
                            <tr><th width='120px' scope='row'>NIPD</th> <td><input type='text' class='form-control' value='$s[nipd]' name='aa' $close></td></tr>
                            <tr><th scope='row'>NISN</th> <td><input type='text' class='form-control' value='$s[nisn]' name='ab' $close></td></tr>
                            <tr><th scope='row'>Password</th> <td><input type='text' class='form-control' value='$s[password]' name='ac'></td></tr>
                            <tr><th scope='row'>Nama Siswa</th> <td><input type='text' class='form-control' value='$s[nama]' name='ad'></td></tr>
                            <tr><th scope='row'>Kelas</th> <td><select class='form-control' name='ae' $close> 
                                                                          <option value='0' selected>- Pilih Kelas -</option>";
  $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
  while ($a = mysqli_fetch_array($kelas)) {
    if ($_SESSION[level] == 'siswa') {
      if ($a[kode_kelas] == $s[kode_kelas]) {
        echo "<option value='$a[kode_kelas]' selected>$a[nama_kelas]</option>";
      }
    } else {
      if ($a[kode_kelas] == $s[kode_kelas]) {
        echo "<option value='$a[kode_kelas]' selected>$a[nama_kelas]</option>";
      } else {
        echo "<option value='$a[kode_kelas]'>$a[nama_kelas]</option>";
      }
    }
  }
  echo "</select></td></tr>
                            <tr><th scope='row'>Angkatan</th> <td><input type='text' class='form-control' value='$s[angkatan]' name='af' $close></td></tr>
                            <tr><th scope='row'>Ekstrakurikuler</th> <td><input type='text' class='form-control' value='$s[ekstrakurikuler]' name='bu' $close></td></tr>
                            <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='ag' $close> 
                                                                          <option value='0' selected>- Pilih Jurusan -</option>";
  $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
  while ($a = mysqli_fetch_array($jurusan)) {
    if ($_SESSION[level] == 'siswa') {
      if ($a[kode_jurusan] == $s[kode_jurusan]) {
        echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
      }
    } else {
      if ($a[kode_jurusan] == $s[kode_jurusan]) {
        echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
      } else {
        echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
      }
    }
  }
  echo "</select></td></tr>
                            <tr><th scope='row'>Alamat Siswa</th> <td><input type='text' class='form-control' value='$s[alamat]' name='ah'></td></tr>
                            <tr><th scope='row'>RT/RW</th> <td><input type='text' class='form-control' value='$s[rt]/$s[rw]' name='ai'></td></tr>
                            <tr><th scope='row'>Dusun</th> <td><input type='text' class='form-control' value='$s[dusun]' name='aj'></td></tr>
                            <tr><th scope='row'>Kelurahan</th> <td><input type='text' class='form-control' value='$s[kelurahan]' name='ak'></td></tr>
                            <tr><th scope='row'>Kecamatan</th> <td><input type='text' class='form-control' value='$s[kecamatan]' name='al'></td></tr>
                            <tr><th scope='row'>Kode Pos</th> <td><input type='text' class='form-control' value='$s[kode_pos]' name='am'></td></tr>
                            <tr><th scope='row'>Status Awal</th> <td><input type='text' class='form-control' value='$s[status_awal]' name='an' $close></td></tr>
                            <tr><th scope='row'>Ganti Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
  <input type='file' class='files' name='ao' onchange='$("#upload-file-info").html($(this).val());'>
  <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div>
                            <tr><th scope='row'>Status Siswa</th> <td>";
  if ($s[status_siswa] == 'Aktif') {
    echo "<input type='radio' name='bo' value='Aktif' checked> Aktif
                                                                              <input type='radio' name='bo' value='Tidak Aktif'> Tidak Aktif";
  } else {
    echo "<input type='radio' name='bo' value='Aktif'> Aktif
                                                                              <input type='radio' name='bo' value='Tidak Aktif' checked> Tidak Aktif";
  }
  echo "</td></tr>
                           
                          </tbody>
                          </table>
                        </div>
                        <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update1' class='btn btn-info'>Update</button>
                          <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 

                        </form>
                    </div>
                                                </tbody>
                          </table>
                        </div>
                        <div class='box-footer'>
                          <button type='submit' name='update2' class='btn btn-info'>Update</button>
                          <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div>
                        </form>
                    </div>

                </div>
            </div>";
} elseif ($_GET[act] == 'detailsiswa') {
  cek_session_siswa();
  if ($_SESSION[level] == 'siswa') {
    $nisn = $_SESSION[id];
  } else {
    $nisn = $_GET[id];
  }
  $detail = mysqli_query($koneksi, "SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                              LEFT JOIN jenis_kelamin c ON a.id_jenis_kelamin=c.id_jenis_kelamin 
                                  LEFT JOIN jurusan d ON b.kode_jurusan=d.kode_jurusan
                                    LEFT JOIN agama e ON a.id_agama=e.id_agama 
                                      where a.nisn='$nisn'");
  $s = mysqli_fetch_array($detail);
  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Siswa</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Siswa </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";
  if (trim($s[foto]) == '') {
    echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
  } else {
    echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
  }
  if ($_SESSION[level] != 'kepala') {
    echo "<a href='index.php?view=siswa&act=editsiswa&id=$_GET[id]' class='btn btn-success btn-block'>Edit Profile</a>";
  }
  echo "</th>
                            </tr>
                            <tr><th width='120px' scope='row'>NIPD</th> <td>$s[nipd]</td></tr>
                            <tr><th scope='row'>NISN</th> <td>$s[nisn]</td></tr>
                            <tr><th scope='row'>Password</th> <td>$s[password]</td></tr>
                            <tr><th scope='row'>Nama Siswa</th> <td>$s[nama]</td></tr>
                            <tr><th scope='row'>Kelas</th> <td>$s[nama_kelas]</td></tr>
                            <tr><th scope='row'>Angkatan</th> <td>$s[angkatan]</td></tr>
                            <tr><th scope='row'>Ekstrakurikuler</th> <td>$s[ekstrakurikuler]</td></tr>
                            <tr><th scope='row'>Jurusan</th> <td>$s[nama_jurusan]</td></tr>
                            <tr><th scope='row'>Alamat Siswa</th> <td>$s[alamat]</td></tr>
                            <tr><th scope='row'>RT/RW</th> <td>$s[rt]/$s[rw]</td></tr>
                            <tr><th scope='row'>Dusun</th> <td>$s[dusun]</td></tr>
                            <tr><th scope='row'>Kelurahan</th> <td>$s[kelurahan]</td></tr>
                            <tr><th scope='row'>Kecamatan</th> <td>$s[kecamatan]</td></tr>
                            <tr><th scope='row'>Kode Pos</th> <td>$s[kode_pos]</td></tr>
                            <tr><th scope='row'>Status Awal</th> <td>$s[status_awal]</td></tr>
                            <tr><th scope='row'>Status Siswa</th> <td>$s[status_siswa]</td></tr>
                          </tbody>
                          </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>";
  ?>
  </tbody>
  </table>
  </div><!-- /.box-body -->
  </div><!-- /.box -->
  </div>
<?php
}
?>