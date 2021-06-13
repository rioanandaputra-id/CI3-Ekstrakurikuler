<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Siswa </h3>
                  <?php if($_SESSION[level] == '1'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=siswa&act=tambah'>Tambah Data</a>
                  
                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action="?view=siswa" method='GET'>
                    <input type="hidden" name='view' value='siswa'>
                    <select name='kode_kelas' style='padding:4px; margin-right:5px;'>
                        <?php 
                            echo "<option value=''>- Filter Kelas</option>";

                            if ($_SESSION[kode_kelas] == '') {
                              $kode_kelas = mysqli_query($koneksi,"SELECT * FROM tbl_kelas");
                            } else {
                              $kode_kelas = mysqli_query($koneksi,"SELECT * FROM tbl_kelas where kode_kelas = '$_SESSION[kode_kelas]'");
                            }

                            
                            
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
<?php } ?>
                </div>
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
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
if($_SESSION[level] == '1') {


                    $tampil = mysqli_query($koneksi,"SELECT a.*,b.kelamin,c.* FROM `tbl_siswa` a LEFT JOIN tbl_kelamin b ON b.kode_kelamin = a.kode_kelamin LEFT JOIN tbl_kelas c ON c.kode_kelas = a.kode_kelas WHERE a.kode_kelas = '$_GET[kode_kelas]'");

} else {
  $tampil = mysqli_query($koneksi,"SELECT a.*,b.kelamin,c.* FROM `tbl_siswa` a LEFT JOIN tbl_kelamin b ON b.kode_kelamin = a.kode_kelamin LEFT JOIN tbl_kelas c ON c.kode_kelas = a.kode_kelas WHERE a.kode_kelas = '$_SESSION[kode_kelas]'");
}

                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[nisn]</td>
                              <td>$r[nama]</td>
                              <td>$r[angkatan]</td>";


              $jr = mysqli_query($koneksi, "SELECT * FROM tbl_jurusan WHERE kode_jurusan=" . $r[kode_jurusan]);
              $row_cnt = $jr->num_rows;
              if ($row_cnt > 0) {
                while ($t = mysqli_fetch_array($jr)) {
                  echo "<td>$t[nama_jurusan]</td>";
                }
              } else {
                echo "<td>dihapus</td>";
              }

                              echo "
                              <td>$r[nama_kelas]</td>"
                              ;


                              
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Detail Data' href='?view=siswa&act=detail&id=$r[kode_siswa]'><span class='glyphicon glyphicon-search'></span></a>";



                                if($_SESSION[level]=='1'){
                                echo "<a class='btn btn-success btn-xs' title='Edit Data' href='?view=siswa&act=edit&id=$r[kode_siswa]'><span class='glyphicon glyphicon-edit'></span></a>"; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[nisn]; ?> ?')" 


                                href="?view=siswa&hapus=<?= $r[kode_siswa]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php echo "</center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_siswa where kode_siswa='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=siswa';</script>";
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
    $edit = mysqli_query($koneksi,"SELECT a.*, b.kelamin, c.*, e.agama FROM `tbl_siswa` a LEFT JOIN tbl_kelamin b ON b.kode_kelamin = a.kode_kelamin LEFT JOIN tbl_kelas c ON c.kode_kelas = a.kode_kelas LEFT JOIN tbl_agama e ON e.kode_agama = a.kode_agama WHERE a.kode_siswa = '$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    
echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data siswa</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Biodata</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";


                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/default.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='$s[foto]'>";
                                }
                              if($_SESSION[level]=='1' || $_SESSION[id] == $s[kode_siswa]){
                                echo "<a href='?view=siswa&act=edit&id=$s[kode_siswa]' class='btn btn-success btn-block'>Edit Profile</a>";
                              }




                    echo "<input type='hidden' name='id' value='$s[kode_siswa]'>
                    <tr><th width='140px' scope='row'>Kode siswa</th> <td>$s[kode_siswa]</td></tr>
                    <tr><th scope='row'>NISN Siswa</th>       <td>$s[nisn]</td></tr>
                    <tr><th scope='row'>Nama Siswa</th>       <td>$s[nama]</td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>       <td>$s[kelamin]</td></tr>


                    <tr><th scope='row'>Tempat Lahir</th>       <td>$s[tempat_lahir]</td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>       <td>$s[tanggal_lahir]</td></tr>
                    <tr><th scope='row'>Agama</th>       <td>$s[agama]</td></tr>
                    <tr><th scope='row'>No. Telpon</th>       <td>$s[telpon]</td></tr>
                     <tr><th scope='row'>Username</th>       <td>$s[username]</td></tr>
                    <tr><th scope='row'>Email</th>       <td>$s[email]</td></tr>
                    <tr><th scope='row'>Alamat</th>       <td>$s[alamat]</td></tr>
                    
                    <tr><th scope='row'>Nama Kelas</th>       <td>$s[nama_kelas]</td></tr>
                    <tr><th scope='row'>Jurusan</th>";

              $jr = mysqli_query($koneksi, "SELECT * FROM tbl_jurusan WHERE kode_jurusan=" . $s[kode_jurusan]);
              $row_cnt = $jr->num_rows;
              if ($row_cnt > 0) {
                while ($t = mysqli_fetch_array($jr)) {
                  echo "<td>$t[nama_jurusan]</td>";
                }
              } else {
                echo "<td>dihapus</td>";
              }

              echo "</tr>

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
}

////////////////////////////////////////////////////////////////////////////////////


elseif($_GET[act]=='edit'){
  if (isset($_POST[update1])){

      $dir_gambar = 'foto_siswa/';
      $filename = basename($_FILES['m']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['m']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['m']['tmp_name'], $uploadfile)){

        $gg = mysqli_query($koneksi, "SELECT foto FROM tbl_siswa WHERE kode_siswa = '$_POST[id]'");
        $dg = mysqli_fetch_array($gg);
        unlink($dg[foto]);

        if ($_POST['pw'] != '') {
           mysqli_query($koneksi,"
            UPDATE tbl_siswa SET 
                               nisn   = '$_POST[a]',
                               nama       = '$_POST[b]',
                               tempat_lahir    = '$_POST[c]',
                               tanggal_lahir   = '$_POST[d]',
                               kode_kelamin = '$_POST[e]',
                               kode_agama = '$_POST[f]',
                               kode_kelas = '$_POST[g]',
                               angkatan = '$_POST[h]',
                               username = '$_POST[i]',
                               password = md5('$_POST[pw]'),
                               email   = '$_POST[j]',
                               alamat        = '$_POST[k]',
                               telpon    = '$_POST[l]',
                               foto       = '$uploadfile'
                               where kode_siswa='$_POST[id]'");          
        } else {
           mysqli_query($koneksi,"
            UPDATE tbl_siswa SET 
                               nisn   = '$_POST[a]',
                               nama       = '$_POST[b]',
                               tempat_lahir    = '$_POST[c]',
                               tanggal_lahir   = '$_POST[d]',
                               kode_kelamin = '$_POST[e]',
                               kode_agama = '$_POST[f]',
                               kode_kelas = '$_POST[g]',
                               angkatan = '$_POST[h]',
                               username = '$_POST[i]',
                               email   = '$_POST[j]',
                               alamat        = '$_POST[k]',
                               telpon    = '$_POST[l]',
                               foto       = '$uploadfile'
                               where kode_siswa='$_POST[id]'");
         }
        }
      }else{
        if ($_POST['pw']) {
           mysqli_query($koneksi,"
            UPDATE tbl_siswa SET 
                               nisn   = '$_POST[a]',
                               nama       = '$_POST[b]',
                               tempat_lahir    = '$_POST[c]',
                               tanggal_lahir   = '$_POST[d]',
                               kode_kelamin = '$_POST[e]',
                               kode_agama = '$_POST[f]',
                               kode_kelas = '$_POST[g]',
                               angkatan = '$_POST[h]',
                               username = '$_POST[i]',
                               password = md5('$_POST[pw]'),
                               email   = '$_POST[j]',
                               alamat        = '$_POST[k]',
                               telpon    = '$_POST[l]'
                               where kode_siswa='$_POST[id]'");
        } else {
           mysqli_query($koneksi,"
            UPDATE tbl_siswa SET 
                               nisn   = '$_POST[a]',
                               nama       = '$_POST[b]',
                               tempat_lahir    = '$_POST[c]',
                               tanggal_lahir   = '$_POST[d]',
                               kode_kelamin = '$_POST[e]',
                               kode_agama = '$_POST[f]',
                               kode_kelas = '$_POST[g]',
                               angkatan = '$_POST[h]',
                               username = '$_POST[i]',
                               email   = '$_POST[j]',
                               alamat        = '$_POST[k]',
                               telpon    = '$_POST[l]'
                               where kode_siswa='$_POST[id]'");
         }
      }
          echo "<script>document.location='index.php?view=siswa&act=detail&id=".$_POST[id]."';</script>";
  }
    $edit = mysqli_query($koneksi,"SELECT * FROM tbl_siswa WHERE kode_siswa='$_GET[id]'");
    $sss = mysqli_fetch_array($edit);

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Siswa</h3>
                </div>
                <div class='box-body'>";
                
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
                          <input type='hidden' type='text' class='form-control' value='$sss[kode_siswa]' name='id'>
                            <tr><th scope='row'>NISN siswa</th> <td><input type='text' class='form-control' value='$sss[nisn]' name='a'></td></tr>

        

                            <tr><th scope='row'>Nama Lengkap</th> <td><input type='text' class='form-control' value='$sss[nama]' name='b' $close></td></tr>

                            <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control' value='$sss[tempat_lahir]' name='c' $close></td></tr>

                            <tr><th scope='row'>Tanggal Lahir</th> <td><input type='date' class='form-control' value='$sss[tanggal_lahir]'  name='d' $close></td></tr>";


                            echo "<tr><th scope='row'>Jenis Kelamin</th><td><select class='form-control' name='e' style='padding:4px'><option value=''>- Pilih Kelamin</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_kelamin");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($sss[kode_kelamin]==$k[kode_kelamin]){
                                echo "<option value='$k[kode_kelamin]' selected>$k[kode_kelamin] - $k[kelamin]</option>";
                              }else{
                                echo "<option value='$k[kode_kelamin]'>$k[kode_kelamin] - $k[kelamin]</option>";
                              }
                            }


                            echo "</td></tr><tr><th scope='row'>Agama</th><td><select class='form-control' name='f' style='padding:4px'><option value=''>- Pilih Agama</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_agama");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($sss[kode_agama]==$k[kode_agama]){
                                echo "<option value='$k[kode_agama]' selected>$k[kode_agama] - $k[agama]</option>";
                              }else{
                                echo "<option value='$k[kode_agama]'>$k[kode_agama] - $k[agama]</option>";
                              }
                            }



                            echo "</td></tr><tr><th scope='row'>Kelas</th><td><select class='form-control' name='g' style='padding:4px'><option value=''>- Pilih Kelas</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT a.*, b.nama_jurusan FROM tbl_kelas a LEFT JOIN tbl_jurusan b ON b.kode_jurusan = a.kode_jurusan");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($sss[kode_kelas]==$k[kode_kelas]){
                                echo "<option value='$k[kode_kelas]' selected>$k[kode_kelas] - $k[nama_kelas] - $k[nama_jurusan]</option>";
                              }else{
                                echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas] - $k[nama_jurusan]</option>";
                              }
                            }


                            echo "</td></tr><tr><th scope='row'>Tahun Masuk</th> <td><input type='number' class='form-control' value='$sss[angkatan]' name='h' $close></td></tr>

                            <tr><th scope='row'>Username</th> <td><input type='text' class='form-control' value='$sss[username]' name='i' $close></td></tr>

                            <tr><th scope='row'>Password</th> <td><input type='password' class='form-control' name='pw' $close></td></tr>


                            <tr><th scope='row'>Email</th> <td><input type='email' class='form-control' value='$sss[email]'  name='j' ></td></tr>

                            <tr><th scope='row'>Alamat Lengkap</th> <td><input type='text' class='form-control' value='$sss[alamat]' name='k' $close></td></tr>

                            <tr><th scope='row'>No. Telpon</th> <td><input type='number' class='form-control' value='$sss[telpon]'  name='l' $close></td></tr>";



                            echo "

                            <tr><th scope='row'>Unggah Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                            <input type='file' class='files' name='m' onchange='$("#upload-file-info").html($(this).val());'>
                                                                          <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div></td></tr>                    
                          </tbody>
                          </table>
                        </div>
                        <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update1' class='btn btn-info'>Ubah</button>
                          <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                        </div> 

                        </form>
                    </div>

                    </div>

                </div>
            </div>";

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

elseif ($_GET[act] == 'tambah') {
  if (isset($_POST[tambah])) {
    $pass = md5($_POST['pw']);
    
    $dir_gambar = 'foto_siswa/';
    $filename = basename($_FILES['l']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['l']['name']);
    $uploadfile = $dir_gambar . $filenamee;
    
    if ($filename != '') {
      if (move_uploaded_file($_FILES['l']['tmp_name'], $uploadfile)) {
        mysqli_query($koneksi, "INSERT INTO `tbl_siswa`(`nisn`, `nama`, kode_kelamin, kode_agama, kode_kelas, angkatan, `foto`, `tempat_lahir`, `tanggal_lahir`, `username`, `email`, password, `alamat`, `telpon`) VALUES (
            '$_POST[b]','$_POST[d]','$_POST[c]','$_POST[aa]','$_POST[bb]','$_POST[cc]',
           '$uploadfile','$_POST[e]','$_POST[f]','$_POST[g]','$_POST[h]','$pass','$_POST[i]','$_POST[j]')");

      }
    } else {
      mysqli_query($koneksi, "INSERT INTO `tbl_siswa`(`nisn`, `nama`, kode_kelamin, kode_agama, kode_kelas, angkatan, `tempat_lahir`, `tanggal_lahir`, `username`, `email`, password, `alamat`, `telpon`) VALUES (
            '$_POST[b]','$_POST[d]','$_POST[c]','$_POST[aa]','$_POST[bb]','$_POST[cc]',
           '$_POST[e]','$_POST[f]','$_POST[g]','$_POST[h]','$pass','$_POST[i]','$_POST[j]')");

    }
    echo "<script>document.location='index.php?view=siswa';</script>";
  }

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah siswa</h3>
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
                    

                            <tr><th scope='row'>NISN siswa</th> <td><input type='number' class='form-control'  name='b'></td></tr>

        

                            <tr><th scope='row'>Nama Lengkap</th> <td><input type='text' class='form-control'  name='d' $close></td></tr>

                            <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control'  name='e' $close></td></tr>

                            <tr><th scope='row'>Tanggal Lahir</th> <td><input type='date' class='form-control'  name='f' $close></td></tr>";


                            echo "<tr><th scope='row'>Jenis Kelamin</th><td><select class='form-control' name='c' style='padding:4px'><option value=''>- Pilih Kelamin</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_kelamin");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_kelamin]==$k[kode_kelamin]){
                                echo "<option value='$k[kode_kelamin]' selected>$k[kode_kelamin] - $k[kelamin]</option>";
                              }else{
                                echo "<option value='$k[kode_kelamin]'>$k[kode_kelamin] - $k[kelamin]</option>";
                              }
                            }


                            echo "</td></tr><tr><th scope='row'>Agama</th><td><select class='form-control' name='aa' style='padding:4px'><option value=''>- Pilih Agama</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_agama");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_agama]==$k[kode_agama]){
                                echo "<option value='$k[kode_agama]' selected>$k[kode_agama] - $k[agama]</option>";
                              }else{
                                echo "<option value='$k[kode_agama]'>$k[kode_agama] - $k[agama]</option>";
                              }
                            }



                            echo "</td></tr><tr><th scope='row'>Kelas</th><td><select class='form-control' name='bb' style='padding:4px'><option value=''>- Pilih Kelas</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT a.*, b.nama_jurusan FROM tbl_kelas a LEFT JOIN tbl_jurusan b ON b.kode_jurusan = a.kode_jurusan");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_kelas]==$k[kode_kelas]){
                                echo "<option value='$k[kode_kelas]' selected>$k[kode_kelas] - $k[nama_kelas] - $k[nama_jurusan]</option>";
                              }else{
                                echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas] - $k[nama_jurusan]</option>";
                              }
                            }


                            echo "</td></tr><tr><th scope='row'>Tahun Masuk</th> <td><input type='number' class='form-control' name='cc' $close></td></tr>

                            <tr><th scope='row'>Username</th> <td><input type='text' class='form-control' name='g' $close></td></tr>

                            <tr><th scope='row'>Password</th> <td><input type='password' class='form-control' name='pw' $close></td></tr>

                            <tr><th scope='row'>Email</th> <td><input type='email' class='form-control'  name='h' ></td></tr>

                            <tr><th scope='row'>Alamat Lengkap</th> <td><input type='text' class='form-control'  name='i' $close></td></tr>

                            <tr><th scope='row'>No. Telpon</th> <td><input type='number' class='form-control'  name='j' $close></td></tr>";



                            echo "

                            <tr><th scope='row'>Unggah Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                            <input type='file' class='files' name='l' onchange='$("#upload-file-info").html($(this).val());'>
                                                                          <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div></td></tr>    </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                            <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                          </div> 
                      </div>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>";
}
?>