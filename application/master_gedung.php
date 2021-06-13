<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data gedung </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=gedung&act=tambah'>Tambah Data</a>
                  <?php } ?>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Gedung</th>
                        <th>Nama Gedung</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM tbl_gedung ORDER BY nama_gedung ASC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_gedung]</td>
                              <td>$r[nama_gedung]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Edit Data' href='?view=gedung&act=detail&id=$r[kode_gedung]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=gedung&act=edit&id=$r[kode_gedung]'><span class='glyphicon glyphicon-edit'></span></a>"; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[kode_gedung]; ?> ?')" 


                                href="?view=gedung&hapus=<?= $r[kode_gedung]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php echo "</center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_gedung where kode_gedung='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=gedung';</script>";
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
    $edit = mysqli_query($koneksi,"SELECT * FROM tbl_gedung WHERE kode_gedung='$_GET[id]'");
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
                    <input type='hidden' name='id' value='$s[kode_gedung]'>
                    <tr><th width='140px' scope='row'>Kode gedung</th> <td>$s[kode_gedung]</td></tr>
                    <tr><th scope='row'>Nama gedung</th>       <td>$s[nama_gedung]</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <a href='index.php?view=gedung'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                   <a class='btn btn-primary' title='Ubah' href='?view=gedung&act=edit&id=$s[kode_gedung]'>Ubah</a> 
              </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE tbl_gedung SET
                                         nama_gedung = '$_POST[b]'
                                         where kode_gedung='$_POST[id]'");
      echo "<script>document.location='index.php?view=gedung';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM tbl_gedung WHERE kode_gedung='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data gedung</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_gedung]'>

                    <tr><th scope='row'>Nama gedung</th>       <td><input type='text' class='form-control' name='b' value='$s[nama_gedung]'></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Ubah</button>
                    <a href='index.php?view=gedung'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO tbl_gedung VALUES('','$_POST[b]')");
        echo "<script>document.location='index.php?view=gedung';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data gedung</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>

                    <tr><th scope='row'>Nama gedung</th>       <td><input type='text' class='form-control' name='b'></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=gedung'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
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