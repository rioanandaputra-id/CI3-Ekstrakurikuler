<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Kelas </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=kelas&act=tambah'>Tambahkan Data</a>
                  <?php } ?>


                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action="?view=kelas" method='GET'>
                    <input type="hidden" name='view' value='kelas'>
                    <select name='kode_kelas' style='padding:4px; margin-right:5px;'>
                        <?php 
                            echo "<option value=''>- Filter Kelas</option>";
                            $kode_kelas = mysqli_query($koneksi,"SELECT * FROM tbl_kelas");
                            while ($k = mysqli_fetch_array($kode_kelas)){
                              if ($_GET[kode_kelas]==$k[kode_kelas]){
                                echo "<option value='$k[kode_kelas]' selected>$k[kode_kelas] - $k[nama_kelas]</option>";
                              }else{
                                echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas]</option>";
                              }
                            }
                        ?>
                    </select>
                    <input type="submit" style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
                  </form>


                </div><!-- /.box-header -->
                <div class="box-body">

                <?php 
                  if (isset($_GET[kode_kelas])){ ?>
                    <table id="example1" class="table table-bordered table-striped">
                  <?php }else{ ?>
                    <table id="example1" class="table table-bordered table-striped">
                  <?php } ?>

                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Jurusan</th>
                        <th>Ruangan</th>
                        <th>Gedung</th>
                        <th>Jumlah Siswa</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM tbl_kelas a LEFT JOIN tbl_pegawai b ON a.kode_pegawai = b.kode_pegawai LEFT JOIN tbl_jurusan c ON a.kode_jurusan = c.kode_jurusan LEFT JOIN tbl_ruangan d ON a.kode_ruangan = d.kode_ruangan LEFT JOIN tbl_gedung e ON d.kode_gedung = e.kode_gedung WHERE a.kode_kelas ='$_GET[kode_kelas]' ORDER BY a.kode_kelas DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    $hitung = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tbl_siswa where kode_kelas='$r[kode_kelas]'"));
                    echo "<tr><td>$no</td>
                              <td>$r[kode_kelas]</td>
                              <td>$r[nama_kelas]</td>
                              <td>$r[nama]</td>
                              <td>$r[nama_jurusan]</td>
                              <td>$r[nama_ruangan]</td>
                              <td>$r[nama_gedung]</td>
                              <td>$hitung Orang</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=kelas&act=edit&id=$r[kode_kelas]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=kelas&hapus=$r[kode_kelas]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_kelas where kode_kelas='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=kelas';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}


elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE tbl_kelas SET
                                         kode_pegawai = '$_POST[b]',
                                         kode_jurusan = '$_POST[c]',
                                         kode_ruangan = '$_POST[d]',
                                         nama_kelas = '$_POST[e]'
                                         where kode_kelas='$_POST[id]'");
      echo "<script>document.location='index.php?view=kelas';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT *, a.kode_pegawai as kd_pgw FROM tbl_kelas a LEFT JOIN tbl_pegawai b ON a.kode_pegawai = b.kode_pegawai LEFT JOIN tbl_jurusan c ON a.kode_jurusan = c.kode_jurusan LEFT JOIN tbl_ruangan d ON a.kode_ruangan = d.kode_ruangan WHERE a.kode_kelas ='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Kelas</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_kelas]'>
                    
                    <tr><th scope='row'>Wali Kelas</th>               <td><select class='form-control' name='b'> 
                                                                          <option value='0' selected>- Pilih Wali Kelas -</option>"; 
                                                                            $wali = mysqli_query($koneksi,"SELECT * FROM tbl_pegawai WHERE kode_jabatan = '2'");
                                                                            while($a = mysqli_fetch_array($wali)){
                                                                              if ($a['kode_pegawai'] == $s['kd_pgw']){
                                                                                echo "<option value='$a[kode_pegawai]' selected>$a[nip] - $a[nama]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[kode_pegawai]'>$a[nip] - $a[nama]</option>";
                                                                              }
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Jurusan</th>               <td><select class='form-control' name='c'> 
                                                                          <option value='0' selected>- Pilih Jurusan -</option>"; 
                                                                            $jur = mysqli_query($koneksi,"SELECT * FROM tbl_jurusan");
                                                                            while($a = mysqli_fetch_array($jur)){
                                                                              if ($a[kode_jurusan] == $s[kode_jurusan]){
                                                                                echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
                                                                              }
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Ruangan</th>               <td><select class='form-control' name='d'> 
                                                                          <option value='0' selected>- Pilih Ruangan -</option>"; 
                                                                            $rua = mysqli_query($koneksi,"SELECT * FROM tbl_ruangan a JOIN tbl_gedung b ON a.kode_gedung=b.kode_gedung ");
                                                                            while($a = mysqli_fetch_array($rua)){
                                                                              if ($a[kode_ruangan] == $s[kode_ruangan]){
                                                                                echo "<option value='$a[kode_ruangan]' selected>$a[nama_gedung] - $a[nama_ruangan]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[kode_ruangan]'>$a[nama_gedung] - $a[nama_ruangan]</option>";
                                                                              }
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Nama Kelas</th>           <td><input type='text' class='form-control' name='e' value='$s[nama_kelas]'></td></tr>";
                    
                    
                  echo "
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Ubah</button>
                    <a href='index.php?view=kelas'><button class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}



elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO tbl_kelas(kode_pegawai, kode_jurusan, kode_ruangan, nama_kelas) VALUES ('$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]')");
        echo "<script>document.location='index.php?view=kelas';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Kelas</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr>
                    <tr><th scope='row'>Wali Kelas</th>               <td><select class='form-control' name='b'> 
                                                                          <option value='0' selected>- Pilih Wali Kelas -</option>"; 
                                                                            $wali = mysqli_query($koneksi,"SELECT * FROM tbl_pegawai WHERE kode_jabatan = '2'");
                                                                            while($a = mysqli_fetch_array($wali)){
                                                                                echo "<option value='$a[kode_pegawai]'>$a[nama]</option>";
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Jurusan</th>               <td><select class='form-control' name='c'> 
                                                                          <option value='0' selected>- Pilih Jurusan -</option>"; 
                                                                            $jur = mysqli_query($koneksi,"SELECT * FROM tbl_jurusan");
                                                                            while($a = mysqli_fetch_array($jur)){
                                                                                echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Ruangan</th>               <td><select class='form-control' name='d'> 
                                                                          <option value='0' selected>- Pilih Ruangan -</option>"; 
                                                                            $rua = mysqli_query($koneksi,"SELECT * FROM tbl_ruangan a JOIN tbl_gedung b ON a.kode_gedung=b.kode_gedung ");
                                                                            while($a = mysqli_fetch_array($rua)){
                                                                                echo "<option value='$a[kode_ruangan]'>$a[nama_gedung] - $a[nama_ruangan]</option>";
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Nama Kelas</th>           <td><input type='text' class='form-control' name='e' value='$s[nama_kelas]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=kelas'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>