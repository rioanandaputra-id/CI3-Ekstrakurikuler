<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data gedung </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=ruangan&act=tambah'>Tambah Data</a>
                  <?php } ?>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th>Nama Gedung</th>
                        <th>Lantai Ke</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT a.*, b.nama_gedung FROM `tbl_ruangan` a LEFT JOIN tbl_gedung b ON b.kode_gedung = a.kode_gedung");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_ruangan]</td>
                              <td>$r[nama_ruangan]</td>
                              <td>$r[kode_gedung] - $r[nama_gedung]</td>
                              <td>$r[lantai]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Edit Data' href='?view=ruangan&act=detail&id=$r[kode_ruangan]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=ruangan&act=edit&id=$r[kode_ruangan]'><span class='glyphicon glyphicon-edit'></span></a>"; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[kode_ruangan]; ?> ?')" 


                                href="?view=ruangan&hapus=<?= $r[kode_ruangan]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php echo "</center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_ruangan where kode_ruangan='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=ruangan';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

<!-- //////////////////////////////////////////////////////////////////////////////////// -->

<?php 
}elseif($_GET[act]=='detail'){
    $edit = mysqli_query($koneksi,"SELECT a.*, b.nama_gedung FROM `tbl_ruangan` a LEFT JOIN tbl_gedung b ON b.kode_gedung = a.kode_gedung WHERE a.kode_ruangan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data gedung</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_ruangan]'>
                    <tr><th width='140px' scope='row'>Kode Ruangan</th> <td>$s[kode_ruangan]</td></tr>
                    <tr><th scope='row'>Nama Ruangan</th>       <td>$s[nama_ruangan]</td></tr>
                    <tr><th scope='row'>Nama Gedung</th>       <td>$s[kode_gedung] - $s[nama_gedung]</td></tr>
                    <tr><th scope='row'>Lantai Ke</th>       <td>$s[lantai]</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <a href='index.php?view=ruangan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                   <a class='btn btn-primary' title='Ubah' href='?view=ruangan&act=edit&id=$s[kode_ruangan]'>Ubah</a> 
              </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE tbl_ruangan SET
                                        nama_ruangan = '$_POST[b]',
                                        lantai = '$_POST[c]',
                                        kode_gedung = '$_POST[d]'
                                         where kode_ruangan='$_POST[id]'");
      echo "<script>document.location='index.php?view=ruangan';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT a.*, b.nama_gedung FROM `tbl_ruangan` a LEFT JOIN tbl_gedung b ON b.kode_gedung = a.kode_gedung WHERE a.kode_ruangan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Ruangan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_ruangan]'>

                    <tr><th scope='row'>Nama Ruangan</th>       <td><input type='text' class='form-control' name='b' value='$s[nama_ruangan]'></td></tr>
                    <tr><th scope='row'>Lantai Ke</th>       <td><input type='number' class='form-control' name='c' value='$s[lantai]'></td></tr>";
                            echo "<tr><th scope='row'>Nama Gedung</th><td><select class='form-control' name='d' style='padding:4px'><option value=''>- Pilih Gedung</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM `tbl_gedung`");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_gedung]==$k[kode_gedung]){
                                echo "<option value='$k[kode_gedung]' selected>$k[kode_gedung] - $k[nama_gedung]</option>";
                              }else{
                                echo "<option value='$k[kode_gedung]'>$k[kode_gedung] - $k[nama_gedung]</option>";
                              }
                            }

                  echo "</select></td></tr></tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Ubah</button>
                    <a href='index.php?view=ruangan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO tbl_ruangan VALUES(NULL,'$_POST[b]','$_POST[c]','$_POST[d]')");
        echo "<script>document.location='index.php?view=ruangan';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Ruangan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    

                    <tr><th scope='row'>Nama Ruangan</th>       <td><input type='text' class='form-control' name='b'></td></tr>
                    ";

                            echo "<tr><th scope='row'>Nama Gedung</th><td><select class='form-control' name='c' style='padding:4px'><option value=''>- Pilih Gedung</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM `tbl_gedung`");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_gedung]==$k[kode_gedung]){
                                echo "<option value='$k[kode_gedung]' selected>$k[kode_gedung] - $k[nama_gedung]</option>";
                              }else{
                                echo "<option value='$k[kode_gedung]'>$k[kode_gedung] - $k[nama_gedung]</option>";
                              }
                            }


                  echo "</select></td></tr><tr><th scope='row'>Lantai Ke</th>       <td><input type='number' class='form-control' name='d'></td></tr></tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=ruangan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                  </div>
              </form>
            </div>";
}
?>