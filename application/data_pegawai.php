<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pegawai </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=pegawai&act=tambah'>Tambah Data</a>
                  <?php } ?>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>NIP, <br>NIK</th>
                        <th>Nama Lengkap, <br> Jabatan</th>
                        <th>Email,<br> No. Telpon</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT a.*,b.nama_jabatan FROM `tbl_pegawai` a LEFT JOIN tbl_jabatan b ON b.kode_jabatan = a.kode_jabatan ORDER BY a.kode_jabatan ASC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[nip],<br>$r[nik]</td>
                              <td>$r[nama],<br>$r[nama_jabatan]</td>
                              <td>$r[email],<br>$r[telpon]</td>"
                              ;
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Edit Data' href='?view=pegawai&act=detail&id=$r[kode_pegawai]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=pegawai&act=edit&id=$r[kode_pegawai]'><span class='glyphicon glyphicon-edit'></span></a>"; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[kode_pegawai]; ?> ?')" 


                                href="?view=pegawai&hapus=<?= $r[kode_pegawai]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php echo "</center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_pegawai where kode_pegawai='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=pegawai';</script>";
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
    $edit = mysqli_query($koneksi,"SELECT a.*,b.nama_jabatan FROM `tbl_pegawai` a LEFT JOIN tbl_jabatan b ON b.kode_jabatan = a.kode_jabatan WHERE a.kode_pegawai='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    
echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Pegawai</h3>
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
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/default.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='$s[foto]'>";
                                }
                              if($_SESSION[level]!='kepala'){
                                echo "<a href='?view=pegawai&act=edit&id=$s[kode_pegawai]' class='btn btn-success btn-block'>Edit Profile</a>";
                              }




                    echo "<input type='hidden' name='id' value='$s[kode_pegawai]'>
                    <tr><th width='140px' scope='row'>Kode Pegawai</th> <td>$s[kode_pegawai]</td></tr>
                    <tr><th scope='row'>NIP Pegawai</th>       <td>$s[nip]</td></tr>
                    <tr><th scope='row'>NIK Pegawai</th>       <td>$s[nik]</td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>       <td>$s[nama]</td></tr>


                    <tr><th scope='row'>Tempat Lahir</th>       <td>$s[tempat_lahir]</td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>       <td>$s[tanggal_lahir]</td></tr>
                    <tr><th scope='row'>Username</th>       <td>$s[username]</td></tr>

                    <tr><th scope='row'>Email</th>       <td>$s[email]</td></tr>
                    <tr><th scope='row'>Alamat</th>       <td>$s[alamat]</td></tr>
                    <tr><th scope='row'>No. Telpon</th>       <td>$s[telpon]</td></tr>
                    <tr><th scope='row'>Jabatan</th>       <td>$s[nama_jabatan]</td></tr>

                          </tbody>
                          </table>
                        </div>
                        </form>
              </div>

                    </div>
                </div>
                                                  <div class='box-footer'>
                    <a href='index.php?view=pegawai'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
            </div>

            ";
}

////////////////////////////////////////////////////////////////////////////////////


elseif($_GET[act]=='edit'){
  if (isset($_POST[update1])){

      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['l']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['l']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['l']['tmp_name'], $uploadfile)){

        $gg = mysqli_query($koneksi, "SELECT foto FROM tbl_pegawai WHERE kode_pegawai = '$_POST[id]'");
        $dg = mysqli_fetch_array($gg);
        unlink($dg[foto]);

        if ($_POST['pw'] != '') {

           mysqli_query($koneksi,"
            UPDATE tbl_pegawai SET 
                               nip   = '$_POST[b]',
                               nik         = '$_POST[c]',
                               nama       = '$_POST[d]',
                               tempat_lahir    = '$_POST[e]',
                               tanggal_lahir   = '$_POST[f]',
                               username = '$_POST[g]',
                               email   = '$_POST[h]',
                               password = md5('$_POST[pw]'),
                               alamat        = '$_POST[i]',
                               telpon    = '$_POST[j]',
                               kode_jabatan       = '$_POST[k]',
                               foto       = '$uploadfile'
                               where kode_pegawai='$_POST[id]'");

        } else {

           mysqli_query($koneksi,"
            UPDATE tbl_pegawai SET 
                               nip   = '$_POST[b]',
                               nik         = '$_POST[c]',
                               nama       = '$_POST[d]',
                               tempat_lahir    = '$_POST[e]',
                               tanggal_lahir   = '$_POST[f]',
                               username = '$_POST[g]',
                               email   = '$_POST[h]',
                               alamat        = '$_POST[i]',
                               telpon    = '$_POST[j]',
                               kode_jabatan       = '$_POST[k]',
                               foto       = '$uploadfile'
                               where kode_pegawai='$_POST[id]'");
         }
        }
      }else{
        if ($_POST['pw'] != '') {

           mysqli_query($koneksi,"
            UPDATE tbl_pegawai SET 
                               nip   = '$_POST[b]',
                               nik         = '$_POST[c]',
                               nama       = '$_POST[d]',
                               tempat_lahir    = '$_POST[e]',
                               tanggal_lahir   = '$_POST[f]',
                               username = '$_POST[g]',
                               email   = '$_POST[h]',
                               password = md5('$_POST[pw]'),
                               alamat        = '$_POST[i]',
                               telpon    = '$_POST[j]',
                               kode_jabatan       = '$_POST[k]'
                               where kode_pegawai='$_POST[id]'");
          
        }
           mysqli_query($koneksi,"
            UPDATE tbl_pegawai SET 
                               nip   = '$_POST[b]',
                               nik         = '$_POST[c]',
                               nama       = '$_POST[d]',
                               tempat_lahir    = '$_POST[e]',
                               tanggal_lahir   = '$_POST[f]',
                               username = '$_POST[g]',
                               email   = '$_POST[h]',
                               alamat        = '$_POST[i]',
                               telpon    = '$_POST[j]',
                               kode_jabatan       = '$_POST[k]'
                               where kode_pegawai='$_POST[id]'");
      }
          echo "<script>document.location='index.php?view=pegawai&act=edit&id=".$_POST[id]."';</script>";
  }
    $edit = mysqli_query($koneksi,"SELECT a.*,b.nama_jabatan FROM `tbl_pegawai` a LEFT JOIN tbl_jabatan b ON b.kode_jabatan = a.kode_jabatan WHERE a.kode_pegawai='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
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
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='$s[foto]'>";
                                }
                            echo "</th></tr>
                            <input type='hidden' value='$s[kode_pegawai]' name='id'>
                            

                            <tr><th scope='row'>NIP Pegawai</th> <td><input type='text' class='form-control' value='$s[nip]' name='b'></td></tr>

                            <tr><th scope='row'>NIK Pegawai</th> <td><input type='text' class='form-control' value='$s[nik]' name='c'></td></tr>

                            <tr><th scope='row'>Nama Lengkap</th> <td><input type='text' class='form-control' value='$s[nama]' name='d' $close></td></tr>

                            <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control' value='$s[tempat_lahir]' name='e' $close></td></tr>

                            <tr><th scope='row'>Tanggal Lahir</th> <td><input type='date' class='form-control' value='$s[tanggal_lahir]' name='f' $close></td></tr>

                            <tr><th scope='row'>Username</th> <td><input type='text' class='form-control' value='$s[username]' name='g' $close></td></tr>

                            <tr><th scope='row'>Password</th> <td><input type='password' class='form-control' name='pw' $close></td></tr>

                            <tr><th scope='row'>Email</th> <td><input type='email' class='form-control' value='$s[email]' name='h' $close></td></tr>

                            <tr><th scope='row'>Alamat Lengkap</th> <td><input type='text' class='form-control' value='$s[alamat]' name='i' $close></td></tr>

                            <tr><th scope='row'>No. Telpon</th> <td><input type='number' class='form-control' value='$s[telpon]' name='j' $close></td></tr>";

                            echo "<tr><th scope='row'>Jabatan</th><td><select class='form-control' name='k' style='padding:4px'><option value=''>- Pilih Jabatan</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT kode_jabatan, nama_jabatan FROM tbl_jabatan WHERE kode_jabatan != '004'");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_jabatan]==$k[kode_jabatan]){
                                echo "<option value='$k[kode_jabatan]' selected>$k[kode_jabatan] - $k[nama_jabatan]</option>";
                              }else{
                                echo "<option value='$k[kode_jabatan]'>$k[kode_jabatan] - $k[nama_jabatan]</option>";
                              }
                            }

                            echo "</select></td></tr>

                            <tr><th scope='row'>Ganti Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                            <input type='file' class='files' name='l' onchange='$("#upload-file-info").html($(this).val());'>
                                                                          <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div></td></tr>                          
                          </tbody>
                          </table>
                        </div>
                        <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update1' class='btn btn-info'>Ubah</button>
                          <a href='index.php?view=pegawai'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
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
    
    $dir_gambar = 'foto_pegawai/';
    $filename = basename($_FILES['l']['name']);
    $filenamee = date("YmdHis") . '-' . basename($_FILES['l']['name']);
    $uploadfile = $dir_gambar . $filenamee;
    
    if ($filename != '') {
      if (move_uploaded_file($_FILES['l']['tmp_name'], $uploadfile)) {
       echo "ok";
        mysqli_query($koneksi, "INSERT INTO `tbl_pegawai`( `nip`, `nik`, `nama`, `foto`, `tempat_lahir`, `tanggal_lahir`, `username`, `email`, password, `alamat`, `telpon`, `kode_jabatan`) VALUES (
           '$_POST[b]','$_POST[c]','$_POST[d]',
           '$uploadfile','$_POST[e]','$_POST[f]','$_POST[g]','$_POST[h]','$pass','$_POST[i]','$_POST[j]','$_POST[k]')");
      }
    } else {
    echo "no";

      mysqli_query($koneksi, "INSERT INTO `tbl_pegawai`( `nip`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `username`, `email`, password, `alamat`, `telpon`, `kode_jabatan`) VALUES (
            '$_POST[b]','$_POST[c]','$_POST[d]',
           '$_POST[e]','$_POST[f]','$_POST[g]','$_POST[h]','$pass','$_POST[i]','$_POST[j]','$_POST[k]')");
    }
    echo "<script>document.location='index.php?view=pegawai';</script>";
  }

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Pegawai</h3>
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
                            
                            

                            <tr><th scope='row'>NIP Pegawai</th> <td><input type='text' class='form-control'  name='b'></td></tr>

                            <tr><th scope='row'>NIK Pegawai</th> <td><input type='text' class='form-control' name='c'></td></tr>

                            <tr><th scope='row'>Nama Lengkap</th> <td><input type='text' class='form-control'  name='d' $close></td></tr>

                            <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control'  name='e' $close></td></tr>

                            <tr><th scope='row'>Tanggal Lahir</th> <td><input type='date' class='form-control'  name='f' $close></td></tr>

                            <tr><th scope='row'>Username</th> <td><input type='text' class='form-control' name='g' $close></td></tr>



                            <tr><th scope='row'>Password</th> <td><input type='password' class='form-control' name='pw' $close></td></tr>

                            <tr><th scope='row'>Email</th> <td><input type='email' class='form-control'  name='h' ></td></tr>

                            <tr><th scope='row'>Alamat Lengkap</th> <td><input type='text' class='form-control'  name='i' $close></td></tr>

                            <tr><th scope='row'>No. Telpon</th> <td><input type='number' class='form-control'  name='j' $close></td></tr>";

                            echo "<tr><th scope='row'>Jabatan</th><td><select class='form-control' name='k' style='padding:4px'><option value=''>- Pilih Jabatan</option>";

                            $pegawai = mysqli_query($koneksi,"SELECT kode_jabatan, nama_jabatan FROM tbl_jabatan ");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_jabatan]==$k[kode_jabatan]){
                                echo "<option value='$k[kode_jabatan]' selected>$k[kode_jabatan] - $k[nama_jabatan]</option>";
                              }else{
                                echo "<option value='$k[kode_jabatan]'>$k[kode_jabatan] - $k[nama_jabatan]</option>";
                              }
                            }

                            echo "</select></td></tr>

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
?>