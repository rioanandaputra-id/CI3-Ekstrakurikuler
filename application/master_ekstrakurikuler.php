<?php if ($_GET[act] == '') { ?>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Ekstrakurikuler </h3>
        <?php if ($_SESSION[level] != 'kepala') { ?>
          <a class='pull-right btn btn-primary btn-sm' href='index.php?view=ekstrakurikuler&act=tambah'>Tambahkan Data</a>
        <?php } ?>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style='width:40px'>No</th>
              <th>Kode Ekstrakurikuler</th>
              <th>Nama Ekstrakurikuler</th>
              <th>Nama Pembina</th>

              <?php if ($_SESSION[level] != 'kepala') { ?>
                <th style='width:70px'>Action</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul ORDER BY kode_ekskul DESC");
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)) {
              echo "<tr><td>$no</td>
                              <td>$r[kode_ekskul]</td>
                              <td>$r[nama_ekskul]</td>";

              $pembina = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE kode_pegawai=" . $r[kode_pegawai]);
              $row_cnt = $pembina->num_rows;
              if ($row_cnt > 0) {
                while ($t = mysqli_fetch_array($pembina)) {
                  echo "<td>$t[nama]</td>";
                }
              } else {
                echo "<td>dihapus</td>";
              }

              if ($_SESSION[level] != 'kepala') {
                echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=ekstrakurikuler&act=edit&id=$r[kode_ekskul]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=ekstrakurikuler&hapus=$r[kode_ekskul]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
              }
              echo "</tr>";
              $no++;
            }

            if (isset($_GET[hapus])) {
              mysqli_query($koneksi, "DELETE FROM tbl_ekskul where kode_ekskul='$_GET[hapus]'");
              echo "<script>document.location='index.php?view=ekstrakurikuler';</script>";
            }

            ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
<?php
} elseif ($_GET[act] == 'edit') {
  if (isset($_POST[update])) {
    mysqli_query($koneksi, "UPDATE tbl_ekskul SET 
                                       nama_ekskul = '$_POST[b]',
                                       kode_pegawai = '$_POST[c]' where kode_ekskul='$_POST[id]'");
    echo "<script>document.location='index.php?view=ekstrakurikuler';</script>";
  }
  $edit = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul where kode_ekskul='$_GET[id]'");
  $s = mysqli_fetch_array($edit);
  echo "<div class='col-md-12'>
            <div class='box box-info'>
              <div class='box-header with-border'>
                <h3 class='box-title'>Edit Data Ekstrakurikuler</h3>
              </div>
            <div class='box-body'>
            <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
              <div class='col-md-12'>
                <table class='table table-condensed table-bordered'>
                <tbody>
                  <input type='hidden' name='id' value='$s[kode_ekskul]'>
                  <tr><th scope='row'>Nama Ekstrakurikuler</th>       <td><input type='text' class='form-control' name='b' value='$s[nama_ekskul]'></td></tr>
                  <tr><th scope='row'>Nama Pembina</th><td><select class='form-control' name='c'> 
                  <option value='0' selected>- Pilih Pembina -</option>";

  $pembina = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE kode_jabatan = '003'");
  while ($y = mysqli_fetch_array($pembina)) {
    if ($s[kode_pegawai] == $y[kode_pegawai]) {
      echo "<option value='$y[kode_pegawai]' selected>$y[nama]</option>";
    } else {
      echo "<option value='$y[kode_pegawai]'>$y[nama]</option>";
    }
  }

  echo "</select></td></tr>
                </tbody>
                </table>
              </div>
            </div>
            <div class='box-footer'>
                  <button type='submit' name='update' class='btn btn-info'>Update</button>
                  <a href='index.php?view=ekstrakurikuler'><button class='btn btn-default pull-right'>Cancel</button></a>
                  
                </div>
            </form>
          </div>";
} elseif ($_GET[act] == 'tambah') {
  if (isset($_POST[tambah])) {
    mysqli_query($koneksi, "INSERT INTO  tbl_ekskul VALUES(NULL,'$_POST[b]','$_POST[c]')");
    echo "<script>document.location='index.php?view=ekstrakurikuler';</script>";
  }

  echo "<div class='col-md-12'>
                    <div class='box box-info'>
                      <div class='box-header with-border'>
                        <h3 class='box-title'>Tambah Data Ekstrakurikuler</h3>
                      </div>
                    <div class='box-body'>
                    <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                      <div class='col-md-12'>
                        <table class='table table-condensed table-bordered'>
                        <tbody>

                          <tr><th scope='row'>Nama Ekstrakurikuler</th>       <td><input type='text' class='form-control' name='b'></td></tr>
                          <tr><th scope='row'>Nama Pembina</th>               <td><select class='form-control' name='c'> 
                          <option value='0' selected>- Pilih Pembina -</option>";
  $pembina = mysqli_query($koneksi, "SELECT * FROM tbl_pegawai WHERE kode_jabatan = '003'");
  while ($a = mysqli_fetch_array($pembina)) {
    echo "<option value='$a[kode_pegawai]'>$a[nama]</option>";
  }
  echo "</select></td></tr>                          
                        </tbody>
                        </table>
                      </div>
                    </div>
                    <div class='box-footer'>
                          <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                          <a href='index.php?view=ekstrakurikuler'><button class='btn btn-default pull-right'>Cancel</button></a>
                          
                        </div>
                    </form>
                  </div>";
}
?>