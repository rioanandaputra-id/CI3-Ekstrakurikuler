<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Jurusan </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=jurusan&act=tambah'>Tambah Data</a>
                  <?php } ?>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Bidang Keahlian</th>
                        <th>Kompetensi Umum</th>
                        <th>Kompetensi Khusus</th>
                        <th>Nama Kajur</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT a.*,b.nama FROM tbl_jurusan a LEFT JOIN tbl_pegawai b ON b.kode_pegawai = a.kode_pegawai");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_jurusan]</td>
                              <td>$r[nama_jurusan]</td>
                              <td>$r[bidang_keahlian]</td>
                              <td>$r[kompetensi_umum]</td>
                              <td>$r[kompetensi_khusus]</td>
                              <td>$r[nama]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Edit Data' href='?view=jurusan&act=detail&id=$r[kode_jurusan]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=jurusan&act=edit&id=$r[kode_jurusan]'><span class='glyphicon glyphicon-edit'></span></a>"; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[kode_jurusan]; ?> ?')" 


                                href="?view=jurusan&hapus=<?= $r[kode_jurusan]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php echo "</center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_jurusan where kode_jurusan='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=jurusan';</script>";
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
    $edit = mysqli_query($koneksi,"SELECT a.*, b.nama, b.kode_pegawai FROM tbl_jurusan a LEFT JOIN tbl_pegawai b ON a.kode_pegawai = a.kode_pegawai WHERE a.kode_jurusan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Jurusan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_jurusan]'>
                    <tr><th width='140px' scope='row'>Kode Jurusan</th> <td>$s[kode_jurusan]</td></tr>
                    <tr><th scope='row'>Nama Jurusan</th>       <td>$s[nama_jurusan]</td></tr>
                    <tr><th scope='row'>Bidang Keahlian</th>    <td>$s[bidang_keahlian]</td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>    <td>$s[kompetensi_umum]</td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>  <td>$s[kompetensi_khusus]</td></tr>
                    <tr><th scope='row'>Kode Pegawai</th>            <td>$s[kode_pegawai]</td></tr>
                    <tr><th scope='row'>Nama Kajur</th>            <td>$s[nama]</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <a href='index.php?view=jurusan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                   <a class='btn btn-primary' title='Ubah' href='?view=jurusan&act=edit&id=$s[kode_jurusan]'>Ubah</a> 
              </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE tbl_jurusan SET
                                         nama_jurusan = '$_POST[b]',
                                         bidang_keahlian = '$_POST[c]',
                                         kompetensi_umum = '$_POST[d]',
                                         kompetensi_khusus = '$_POST[e]',
                                         kode_pegawai = '$_POST[f]'
                                         where kode_jurusan='$_POST[id]'");
      echo "<script>document.location='index.php?view=jurusan';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT a.*, b.nama, b.kode_pegawai FROM tbl_jurusan a LEFT JOIN tbl_pegawai b ON a.kode_pegawai = b.kode_pegawai WHERE a.kode_jurusan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Jurusan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_jurusan]'>
                    <tr><th scope='row'>Nama Jurusan</th>       <td><input type='text' class='form-control' name='b' value='$s[nama_jurusan]'></td></tr>
                    <tr><th scope='row'>Bidang Keahlian</th>    <td><input type='text' class='form-control' name='c' value='$s[bidang_keahlian]'></td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>    <td><input type='text' class='form-control' name='d' value='$s[kompetensi_umum]'></td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>  <td><input type='text' class='form-control' name='e' value='$s[kompetensi_khusus]'></td></tr>";

                            echo "<tr><th scope='row'>Nama Kajur</th><td><select class='form-control' name='f' style='padding:4px'><option value=''>- Filter Kajur</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT kode_pegawai,nama FROM tbl_pegawai WHERE kode_jabatan = '4'");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s['kode_pegawai']==$k['kode_pegawai']){
                                echo "<option value='$k[kode_pegawai]' selected>$k[kode_pegawai] - $k[nama]</option>";
                              }else{
                                echo "<option value='$k[kode_pegawai]'>$k[kode_pegawai] - $k[nama]</option>";
                              }
                            }

                  echo "</select></td></tr></tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Ubah</button>
                    <a href='index.php?view=jurusan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO tbl_jurusan VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]')");
        echo "<script>document.location='index.php?view=jurusan';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Jurusan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Jurusan</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Nama Jurusan</th>       <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Bidang Keahlian</th>    <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>    <td><input type='text' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>  <td><input type='text' class='form-control' name='e'></td></tr>";

                            echo "<tr><th scope='row'>Nama Kajur</th><td><select class='form-control' name='f' style='padding:4px'><option value=''>- Filter Kajur</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT kode_pegawai,nama FROM tbl_pegawai WHERE kode_jabatan = '4'");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_pegawai]==$k[kode_pegawai]){
                                echo "<option value='$k[kode_pegawai]' selected>$k[kode_pegawai] - $k[nama]</option>";
                              }else{
                                echo "<option value='$k[kode_pegawai]'>$k[kode_pegawai] - $k[nama]</option>";
                              }
                            }

                  echo "</select></td></tr></tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=jurusan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                  </div>
              </form>
            </div>";
}
?>

<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>