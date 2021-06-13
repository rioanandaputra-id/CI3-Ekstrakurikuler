
<?php 
if ($_GET[act]==''){ 
  cek_session_admin();
    if (isset($_POST[pindahkelas])){
      if ($_POST[angkatan]!='' AND $_POST[kelas] != ''){
        $jml = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as jmlp FROM siswa where kode_kelas='$_POST[kelas]' AND angkatan='$_POST[angkatan]'"));
      }elseif ($_POST[angkatan]=='' AND $_POST[kelas] != ''){
        $jml = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as jmlp FROM siswa where kode_kelas='$_POST[kelas]'"));
      }elseif ($_POST[angkatan]!='' AND $_POST[kelas] == ''){
        $jml = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as jmlp FROM siswa where angkatan='$_POST[angkatan]'"));
      }

       $n = $jml[jmlp];
       $kelas = $_POST['kelaspindah'];
       $angkatan = $_POST['angkatanpindah'];
       for ($i=0; $i<=$n; $i++){
         if (isset($_POST['pilih'.$i])){
           $nisn = $_POST['pilih'.$i];
           if ($angkatan != '' AND $kelas != ''){
              mysqli_query($koneksi,"UPDATE siswa SET angkatan='$angkatan', kode_kelas='$kelas' where nisn='$nisn'");
           }elseif ($angkatan == '' AND $kelas != ''){
              mysqli_query($koneksi,"UPDATE siswa SET kode_kelas='$kelas' where nisn='$nisn'");
           }elseif ($angkatan != '' AND $kelas == ''){
              mysqli_query($koneksi,"UPDATE siswa SET angkatan='$angkatan' where nisn='$nisn'");
           }
         }
       }
       echo "<script>document.location='index.php?view=siswa&angkatan=".$angkatan."&kelas=".$kelas."';</script>";
    }
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Siswa </h3>
                   <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-success btn-sm' target='_BLANK' href='print-siswa.php?kelas=<?php echo $_GET[kelas]; ?>&angkatan=<?php echo $_GET[angkatan]; ?>'>Print Siswa</a>
                  <a style='margin-right:5px' class='pull-right btn btn-primary btn-sm' href='index.php?view=siswa&act=tambahsiswa'>Tambah Data</a>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                    <input type="hidden" name='view' value='siswa'>
                    <input type="number" name='angkatan' style='padding:3px' placeholder='Angkatan' value='<?php echo $_GET[angkatan]; ?>'>
                    <select name='kelas' style='padding:4px'>
                        <?php 
                            echo "<option value=''>- Filter Kelas</option>";
                            $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                            while ($k = mysqli_fetch_array($kelas)){
                              if ($_GET[kelas]==$k[kode_kelas]){
                                echo "<option value='$k[kode_kelas]' selected>$k[kode_kelas] - $k[nama_kelas]</option>";
                              }else{
                                echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas]</option>";
                              }
                            }
                        ?>
                    </select>
                    <input type="submit" style='margin-top:-4px' class='btn btn-info btn-sm' value='Filter'>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action='' method='POST'>
                <input type="hidden" name='angkatan' value='<?php echo $_GET[angkatan]; ?>'>
                <input type="hidden" name='kelas' value='<?php echo $_GET[kelas]; ?>'>
                <?php 
                  if (isset($_GET[kelas])){
                    echo "<table id='myTable' class='table table-bordered table-striped'>
                            <tr>";
                  }else{
                    echo "<table id='example' class='table table-bordered table-striped'>
                            <thead>
                              <tr>";
                  }
                  echo "<th>No</th>
                        <th>NIPD</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

                  if ($_GET[kelas] != '' AND $_GET[angkatan] != ''){
                    $tampil = mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                                              LEFT JOIN jenis_kelamin c ON a.id_jenis_kelamin=c.id_jenis_kelamin 
                                                LEFT JOIN jurusan d ON b.kode_jurusan=d.kode_jurusan 
                                                  where a.kode_kelas='$_GET[kelas]' AND a.angkatan='$_GET[angkatan]' ORDER BY a.id_siswa");
                  }elseif ($_GET[kelas] != '' AND $_GET[angkatan] == ''){
                    $tampil = mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                                              LEFT JOIN jenis_kelamin c ON a.id_jenis_kelamin=c.id_jenis_kelamin 
                                                LEFT JOIN jurusan d ON b.kode_jurusan=d.kode_jurusan 
                                                  where a.kode_kelas='$_GET[kelas]' ORDER BY a.id_siswa");
                  }elseif ($_GET[kelas] == '' AND $_GET[angkatan] != ''){
                    $tampil = mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                                              LEFT JOIN jenis_kelamin c ON a.id_jenis_kelamin=c.id_jenis_kelamin 
                                                LEFT JOIN jurusan d ON b.kode_jurusan=d.kode_jurusan 
                                                  where a.angkatan='$_GET[angkatan]' ORDER BY a.id_siswa");
                  }
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr>";

                              echo "<td>$no</td>
                              <td>$r[nipd]</td>
                              <td>$r[nisn]</td>
                              <td>$r[nama]</td>
                              <td>$r[angkatan]</td>
                              <td>$r[nama_jurusan]</td>
                              <td>$r[nama_kelas]</td>";
                              if($_SESSION[level]!='kepala'){
                                echo "<td><center>
                                  <a class='btn btn-default btn-xs' title='Lihat Detail' href='?view=siswa&act=detailsiswa&id=$r[nisn]'><span class='glyphicon glyphicon-search'></span></a>
                                  <a class='btn btn-info btn-xs' title='Edit Siswa' href='?view=siswa&act=editsiswa&id=$r[nisn]'><span class='glyphicon glyphicon-edit'></span></a>
                                  <a class='btn btn-danger btn-xs' title='Delete Siswa' href='?view=siswa&hapus=$r[nisn]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                </center></td>";
                              }else{
                                  echo "<td><center>
                                  <a class='btn btn-default btn-xs' title='Lihat Detail' href='?view=siswa&act=detailsiswa&id=$r[nisn]'><span class='glyphicon glyphicon-search'></span></a>
                                  </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM siswa where nisn='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=siswa';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <?php 
                    if ($_GET[kelas] == '' AND $_GET[tahun] == ''){
                        echo "<center style='padding:60px; color:red'>Silahkan Input Angkatan dan Memilih Kelas Terlebih dahulu...</center>";
                    }
                ?>
              </div><!-- /.box -->


              </form>
            </div>
<?php 
}elseif($_GET[act]=='tambahsiswa'){
  cek_session_admin();
  if (isset($_POST[tambah])){
      $rtrw = explode('/',$_POST[ai]);
      $rt = $rtrw[0];
      $rw = $rtrw[1];
      $dir_gambar = 'foto_siswa/';
      $filename = basename($_FILES['ao']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['ao']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['ao']['tmp_name'], $uploadfile)) {
           mysqli_query($koneksi,"INSERT INTO siswa VALUES('','$_POST[aa]','$_POST[ac]','$_POST[ad]','$_POST[bd]','$_POST[ab]',
                               '$_POST[bb]','$_POST[bc]','$_POST[bu]','$_POST[ba]','$_POST[be]','$_POST[bf]','$_POST[ah]','$rt','$rw',
                               '$_POST[aj]','$_POST[ak]','$_POST[al]','$_POST[am]','$_POST[bg]','$_POST[bh]','$_POST[bi]',
                               '$_POST[bj]','$_POST[bk]','$_POST[bl]','$_POST[bm]','$_POST[bn]','$filenamee','$_POST[ca]',
                               '$_POST[cb]','$_POST[cc]','$_POST[cd]','$_POST[ce]','$_POST[cf]','$_POST[cg]','$_POST[ch]',
                               '$_POST[ci]','$_POST[cj]','$_POST[ck]','$_POST[cl]','$_POST[cm]','$_POST[cn]','$_POST[co]',
                               '$_POST[cp]','$_POST[cq]','$_POST[cr]','$_POST[cs]','$_POST[af]','$_POST[an]','$_POST[bo]',
                               '','$_POST[ae]','$_POST[ag]','0')");
        }
      }else{
            mysqli_query($koneksi,"INSERT INTO siswa VALUES('','$_POST[aa]','$_POST[ac]','$_POST[ad]','$_POST[bd]','$_POST[ab]',
                               '$_POST[bb]','$_POST[bc]','$_POST[bu]','$_POST[ba]','$_POST[be]','$_POST[bf]','$_POST[ah]','$rt','$rw',
                               '$_POST[aj]','$_POST[ak]','$_POST[al]','$_POST[am]','$_POST[bg]','$_POST[bh]','$_POST[bi]',
                               '$_POST[bj]','$_POST[bk]','$_POST[bl]','$_POST[bm]','$_POST[bn]','','$_POST[ca]',
                               '$_POST[cb]','$_POST[cc]','$_POST[cd]','$_POST[ce]','$_POST[cf]','$_POST[cg]','$_POST[ch]',
                               '$_POST[ci]','$_POST[cj]','$_POST[ck]','$_POST[cl]','$_POST[cm]','$_POST[cn]','$_POST[co]',
                               '$_POST[cp]','$_POST[cq]','$_POST[cr]','$_POST[cs]','$_POST[af]','$_POST[an]','$_POST[bo]',
                               '','$_POST[ae]','$_POST[ag]','0')");
      }
          echo "<script>document.location='index.php?view=siswa&act=detailsiswa&id=".$_POST[ab]."';</script>";
  }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Siswa</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Siswa </a></li>
                      
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                          <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>NIPD</th> <td><input type='text' class='form-control' name='aa'></td></tr>
                              <tr><th scope='row'>NISN</th> <td><input type='text' class='form-control' name='ab'></td></tr>
                              <tr><th scope='row'>Password</th> <td><input type='text' class='form-control' name='ac'></td></tr>
                              <tr><th scope='row'>Nama Siswa</th> <td><input type='text' class='form-control' name='ad'></td></tr>
                              <tr><th scope='row'>Kelas</th> <td><select class='form-control' name='ae'> 
                                                                            <option value='0' selected>- Pilih Kelas -</option>"; 
                                                                              $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                                                                              while($a = mysqli_fetch_array($kelas)){
                                                                                  echo "<option value='$a[kode_kelas]'>$a[nama_kelas]</option>";
                                                                              }
                                                                    echo "</select></td></tr>
                              <tr><th scope='row'>Angkatan</th> <td><input type='text' class='form-control' name='af'></td></tr>
                              <tr><th scope='row'>Ekstrakurikuler</th> <td><input type='text' class='form-control' name='bu'></td></tr>
                              <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='ag'> 
                                                                            <option value='0' selected>- Pilih Jurusan -</option>"; 
                                                                              $jurusan = mysqli_query($koneksi,"SELECT * FROM jurusan");
                                                                              while($a = mysqli_fetch_array($jurusan)){
                                                                                  echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
                                                                              }
                                                                    echo "</select></td></tr>
                              <tr><th scope='row'>Alamat Siswa</th> <td><input type='text' class='form-control' name='ah'></td></tr>
                              <tr><th scope='row'>RT/RW</th> <td><input type='text' class='form-control' value='00/00' name='ai'></td></tr>
                              <tr><th scope='row'>Dusun</th> <td><input type='text' class='form-control' name='aj'></td></tr>
                              <tr><th scope='row'>Kelurahan</th> <td><input type='text' class='form-control' name='ak'></td></tr>
                              <tr><th scope='row'>Kecamatan</th> <td><input type='text' class='form-control' name='al'></td></tr>
                              <tr><th scope='row'>Kode Pos</th> <td><input type='text' class='form-control' name='am'></td></tr>
                              <tr><th scope='row'>Status Awal</th> <td><input type='text' class='form-control' name='an'></td></tr>
                              <tr><th scope='row'>Status Siswa</th> <td><input type='radio' name='bo' value='Aktif' checked> Aktif
                                                                        <input type='radio' name='bo' value='Tidak Aktif'> Tidak Aktif </td></tr>
                              <tr><th scope='row'>Foto</th>             <td><div style='position:relative;''>
                                                                            <a class='btn btn-primary' href='javascript:;'>
                                                                              <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                              <input type='file' class='files' name='ao' onchange='$("#upload-file-info").html($(this).val());'>
                                                                            <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                          </div>
                              </td></tr>
                            </tbody>
                            </table>
                          </div>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                            <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                          </div> 
                      </div>
                          </form>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>";
}elseif($_GET[act]=='editsiswa'){
  cek_session_siswa();
  if (isset($_POST[update1])){
      $rtrw = explode('/',$_POST[ai]);
      $rt = $rtrw[0];
      $rw = $rtrw[1];
      $dir_gambar = 'foto_siswa/';
      $filename = basename($_FILES['ao']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['ao']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['ao']['tmp_name'], $uploadfile)){
           mysqli_query($koneksi,"UPDATE siswa SET 
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
      }else{
            mysqli_query($koneksi,"UPDATE siswa SET 
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
          echo "<script>document.location='index.php?view=siswa&act=editsiswa&id=".$_POST[id]."';</script>";
  }

    if ($_SESSION[level] == 'siswa'){
        $nisn = $_SESSION[id];
        $close = 'readonly=on';
    }else{
        $nisn = $_GET[id];
        $close = '';
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
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
                
                  if ($_SESSION[level] == 'siswa'){
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
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
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
                                                                            $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                                                                            while($a = mysqli_fetch_array($kelas)){
                                                                              if ($_SESSION[level] == 'siswa'){
                                                                                if ($a[kode_kelas] == $s[kode_kelas]){
                                                                                  echo "<option value='$a[kode_kelas]' selected>$a[nama_kelas]</option>";
                                                                                }
                                                                              }else{
                                                                                if ($a[kode_kelas] == $s[kode_kelas]){
                                                                                  echo "<option value='$a[kode_kelas]' selected>$a[nama_kelas]</option>";
                                                                                }else{
                                                                                  echo "<option value='$a[kode_kelas]'>$a[nama_kelas]</option>";
                                                                                }
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                            <tr><th scope='row'>Angkatan</th> <td><input type='text' class='form-control' value='$s[angkatan]' name='af' $close></td></tr>
                            <tr><th scope='row'>Ekstrakurikuler</th> <td><input type='text' class='form-control' value='$s[ekstrakurikuler]' name='bu' $close></td></tr>
                            <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='ag' $close> 
                                                                          <option value='0' selected>- Pilih Jurusan -</option>"; 
                                                                            $jurusan = mysqli_query($koneksi,"SELECT * FROM jurusan");
                                                                            while($a = mysqli_fetch_array($jurusan)){
                                                                              if ($_SESSION[level] == 'siswa'){
                                                                                if ($a[kode_jurusan] == $s[kode_jurusan]){
                                                                                  echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
                                                                                }
                                                                              }else{
                                                                                if ($a[kode_jurusan] == $s[kode_jurusan]){
                                                                                  echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
                                                                                }else{
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
                                                                    if ($s[status_siswa]=='Aktif'){
                                                                        echo "<input type='radio' name='bo' value='Aktif' checked> Aktif
                                                                              <input type='radio' name='bo' value='Tidak Aktif'> Tidak Aktif";
                                                                    }else{
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

                    </div>

                </div>
            </div>";

}elseif($_GET[act]=='detailsiswa'){
  cek_session_siswa();
    if ($_SESSION[level] == 'siswa'){
        $nisn = $_SESSION[id];
    }else{
        $nisn = $_GET[id];
    }
    $detail = mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
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
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
                                }
                              if($_SESSION[level]!='kepala'){
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
                </div>
                                                  <div class='box-footer'>
                    <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
            </div>

            ";
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php
}
?>