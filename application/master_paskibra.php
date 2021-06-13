 <?php 
if ($_GET[act]==''){  ?>     

      <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Siswa Terdaftar Ekstrakulikuler</h3>
                  <?php if ($_SESSION[level] == '1' || $_SESSION[level] == '3') {?>
                  <a class='pull-right btn btn-primary btn-sm' style="margin-right:5px;" href='index.php?view=paskibra&act=tambahekskul'>Daftar</a>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action="?view=paskibra" method='GET'>
                    <input type="hidden" name='view' value='paskibra'>
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

                </div>
                <div class="box-body">
                <form action='' method='GET'>
                <input type="hidden" name='view' value='paskibra'>
                <input type="hidden" name='ekskul' value='<?php echo $_GET[ekskul]; ?>'>
                <?php 
                  if (isset($_GET[ekskul])){
                   echo " <table id='example1' class='table table-bordered table-striped'>";
                  }else{

                   echo " <table id='example1' class='table table-bordered table-striped'>";
                  }
                  echo "<thead><tr><th>No</th>
                        <th>Nama Anggota</th>
                        <th>Jabatan</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";

// if ($_SESSION[level] == '1') {

                $tampil = mysqli_query($koneksi,
                "SELECT * FROM tbl_ekskul_siswa a
                  LEFT JOIN tbl_siswa b ON a.kode_siswa=b.kode_siswa 
                  LEFT JOIN tbl_ekskul d ON a.kode_ekskul=d.kode_ekskul
                  LEFT JOIN tbl_ekskul_jabatan f ON a.kode_ekskul_jabatan=f.kode_ekskul_jabatan
                  WHERE a.kode_ekskul='$_GET[ekskul]' ORDER BY a.kode_ekskul_siswa
                  ");
// } elseif ($_SESSION[level] == '3') {

// $data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
// $s = mysqli_fetch_array($data);


//                 $tampil = mysqli_query($koneksi,
//                 "SELECT * FROM tbl_ekskul_siswa a
//                   LEFT JOIN tbl_siswa b ON a.kode_siswa=b.kode_siswa 
//                   LEFT JOIN tbl_ekskul d ON a.kode_ekskul=d.kode_ekskul
//                   LEFT JOIN tbl_ekskul_jabatan f ON a.kode_ekskul_jabatan=f.kode_ekskul_jabatan
//                   WHERE a.kode_ekskul='$s[kode_ekskul]' ORDER BY a.kode_ekskul_siswa
//                   ");
// }


// else {
//                   $tampil = mysqli_query($koneksi,
//                 "SELECT * FROM tbl_ekskul_siswa a
//                   LEFT JOIN tbl_siswa b ON a.kode_siswa=b.kode_siswa 
//                   LEFT JOIN tbl_ekskul d ON a.kode_ekskul=d.kode_ekskul
//                   LEFT JOIN tbl_ekskul_jabatan f ON a.kode_ekskul_jabatan=f.kode_ekskul_jabatan
//                   WHERE a.kode_siswa='$_SESSION[id]' ORDER BY a.kode_ekskul_siswa
//                   ");
// }



                $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                      echo "
                      
                      <td>$no</td>
                      <td>$r[nisn] - $r[nama]</td>
                      <td>$r[nama_jabatan]</td>";


           $jr = mysqli_query($koneksi, "SELECT * FROM `tbl_kelas` a LEFT JOIN tbl_jurusan b ON b.kode_jurusan = a.kode_jurusan WHERE a.kode_kelas =" . $r[kode_kelas]);
              $row_cnt = $jr->num_rows;
              if ($row_cnt > 0) {
                while ($t = mysqli_fetch_array($jr)) {
                  echo "<td>$t[nama_jurusan]</td>";
                }
              } else {
                echo "<td>dihapus</td>";
              }




                      echo "<td><a class='btn btn-default btn-xs' title='Lihat Detail' href='?view=paskibra&act=detailekskul&id=$r[kode_ekskul_siswa]'><span class='glyphicon glyphicon-search'></span></a>";
                                  
                                  if ($_SESSION[level] == '1') {

                                  echo "<a class='btn btn-info btn-xs' title='Edit Siswa' href='?view=paskibra&act=editekskul&id=$r[kode_ekskul_siswa]'><span class='glyphicon glyphicon-edit'></span></a>
                                  
                                  <a class='btn btn-danger btn-xs' title='Delete ekskul' href='?view=paskibra&hapus=$r[kode_ekskul_siswa]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>";
                            }
                      echo "</td>
                      </tbody>";
                      $no++;
                    


                  }?>
                    </tbody>
                  </table>
                </div>

              </div>
              </form>
            </div>


<?php 


                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_ekskul_siswa where kode_ekskul_siswa='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=paskibra';</script>";
                      }


}

elseif($_GET[act]=='tambahekskul'){
  if (isset($_POST[tambah])){
    $sql = "INSERT INTO `tbl_ekskul_siswa`(`kode_siswa`, `kode_ekskul_jabatan`, `kode_ekskul`) VALUES ('$_POST[aa]','$_POST[bb]','$_POST[cc]')";
    mysqli_query($koneksi,$sql);
    echo "<script>document.location='index.php?view=paskibra';</script>";
  }



    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Pendaftaran ekskul</h3>
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
                              <tr><th scope='row'>Nama Siswa</th> <td><select class='form-control' name='aa'> 
                                                                            <option value='0' selected>- Pilih Siswa -</option>"; 
                                                                              $siswa = mysqli_query($koneksi,"SELECT * FROM tbl_siswa");
                                                                              while($a = mysqli_fetch_array($siswa)){
                                                                                  echo "<option value='$a[kode_siswa]'>$a[nisn] - $a[nama]</option>";
                                                                              }
                                                                    echo "</select></td></tr>
                              <tr><th scope='row'>Jabatan Siswa</th> <td><select class='form-control' name='bb'> 
                                                                            <option value='0' selected>- Pilih Jabatan -</option>"; 
                                                                              $jabatan = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul_jabatan");
                                                                              while($a = mysqli_fetch_array($jabatan)){
                                                                                  echo "<option value='$a[kode_ekskul_jabatan]'>$a[nama_jabatan]</option>";
                                                                              }
echo "</select></td>";


if ($_SESSION[level] == '3') {


echo "</tr>
                              <tr><th scope='row'>Ekstrakulikuler</th> <td><select class='form-control' name='cc'> 
                                                                            <option value='0' selected>- Pilih ekskul -</option>"; 
                                                                              $ekskul = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
                                                                              while($a = mysqli_fetch_array($ekskul)){
                                                                                  echo "<option value='$a[kode_ekskul]'>$a[nama_ekskul]</option>";
                                                                              }
                        echo "</select></td>";
} else {

echo "</tr>
                              <tr><th scope='row'>Ekstrakulikuler</th> <td><select class='form-control' name='cc'> 
                                                                            <option value='0' selected>- Pilih ekskul -</option>"; 
                                                                              $ekskul = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul");
                                                                              while($a = mysqli_fetch_array($ekskul)){
                                                                                  echo "<option value='$a[kode_ekskul]'>$a[nama_ekskul]</option>";
                                                                              }
                        echo "</select></td>";

}



                        echo "</tr>
                            </tbody>
                            </table>
                          </div>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                            <a href='index.php?view=paskibra'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                          </div> 
                      </div>
                          </form>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>";

} elseif ($_GET[act]=='detailekskul') {
    
    $detail = mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_siswa` a LEFT JOIN tbl_siswa b ON a.kode_siswa = b.kode_siswa LEFT JOIN tbl_ekskul_jabatan c ON a.kode_ekskul_jabatan=c.kode_ekskul_jabatan LEFT JOIN tbl_ekskul d ON a.kode_ekskul=d.kode_ekskul LEFT JOIN tbl_kelamin e ON b.kode_kelamin = e.kode_kelamin where a.kode_ekskul_siswa='$_GET[id]'");

    $sss = mysqli_fetch_array($detail); 

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail ekskul Siswa</h3>
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
                                if (trim($sss[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='$sss[foto]'>";
                                }

$data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
$s = mysqli_fetch_array($data);


                                if ($_SESSION[level] == '1' || $sss[kode_ekskul] == $s[kode_ekskul]) {
                                echo "<a href='?view=paskibra&act=editekskul&id=$sss[kode_ekskul_siswa]' class='btn btn-success btn-block'>Edit Profile</a>"; }
                                echo "</th>
                            </tr>
                          <tr><th scope='row'>NISN</th> <td>$sss[nisn]</td></tr>
                          <tr><th scope='row'>Nama</th> <td>$sss[nama]</td></tr>
                          <tr><th scope='row'>TTL</th> <td>$sss[tempat_lahir], $sss[tanggal_lahir]</td></tr>
                          <tr><th scope='row'>J. Kelamin</th> <td>$sss[kelamin]</td></tr>
                          <tr><th scope='row'>Ekskul</th> <td>$sss[nama_ekskul]</td></tr>
                          <tr><th scope='row'>Jabatan</th> <td>$sss[nama_jabatan]</td></tr>
                          <tr><th scope='row'>Alamat</th> <td>$sss[alamat]</td></tr>
                          <tr><th scope='row'>No. HP</th> <td>$sss[telpon]</td></tr>
                          <tr><th scope='row'>Email</th> <td>$sss[email]</td></tr>
                          
                          </tbody>
                          </table>
                        </div>
                        </form>
              </div>

                    </div>
                </div>
                  <div class='box-footer'>
                    <a href='index.php?view=paskibra'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
            </div>";



}

elseif($_GET[act]=='editekskul'){
  if (isset($_POST[tambah])){
    $sql = "UPDATE `tbl_ekskul_siswa` SET `kode_siswa`='$_POST[a]',`kode_ekskul_jabatan`='$_POST[c]',`kode_ekskul`='$_POST[b]' WHERE kode_ekskul_siswa = '$_GET[id]'";
    mysqli_query($koneksi,$sql);


    echo "<script>document.location='index.php?view=paskibra';</script>";
  }


    $edit = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul_siswa WHERE kode_ekskul_siswa ='$_GET[id]'");
    $sss = mysqli_fetch_array($edit);


    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Pendaftaran ekskul</h3>
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
                            <tbody>";


 echo "<tr><th scope='row'>Nama Siswa</th><td><select class='form-control' name='a' style='padding:4px'><option value=''>- Pilih Kelamin</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_siswa");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($sss[kode_siswa]==$k[kode_siswa]){
                                echo "<option value='$k[kode_siswa]' selected>$k[nisn] - $k[nama]</option>";
                              }else{
                                echo "<option value='$k[kode_siswa]'>$k[nisn] - $k[nama]</option>";
                              }
                            }



if ($_SESSION[level] == '3') {


echo "</tr>
                              <tr><th scope='row'>Ekstrakulikuler</th> <td><select class='form-control' name='cc'> 
                                                                            <option value='0' selected>- Pilih ekskul -</option>"; 
                                                                              $ekskul = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
                                                                              while($a = mysqli_fetch_array($ekskul)){
                                                                                  echo "<option value='$a[kode_ekskul]'>$a[nama_ekskul]</option>";
                                                                              }
                        echo "</select></td>";
} else {

 echo "<tr><th scope='row'>Ekstrakulikuler</th><td><select class='form-control' name='b' style='padding:4px'><option value=''>- Pilih Kelamin</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($sss[kode_ekskul]==$k[kode_ekskul]){
                                echo "<option value='$k[kode_ekskul]' selected>$k[kode_ekskul] - $k[nama_ekskul]</option>";
                              }else{
                                echo "<option value='$k[kode_ekskul]'>$k[kode_ekskul] - $k[nama_ekskul]</option>";
                              }
                            }

}












 echo "<tr><th scope='row'>Jabatan Siswa</th><td><select class='form-control' name='c' style='padding:4px'><option value=''>- Pilih Kelamin</option>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul_jabatan");
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($sss[kode_ekskul_jabatan]==$k[kode_ekskul_jabatan]){
                                echo "<option value='$k[kode_ekskul_jabatan]' selected>$k[kode_ekskul_jabatan] - $k[nama_jabatan]</option>";
                              }else{
                                echo "<option value='$k[kode_ekskul_jabatan]'>$k[kode_ekskul_jabatan] - $k[nama_jabatan]</option>";
                              }
                            }




                        echo "</select></td></tr>
                            </tbody>
                            </table>
                          </div>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                          <div class='box-footer'>
                            <button type='submit' name='tambah' class='btn btn-info'>Ubah</button>
                            <a href='index.php?view=paskibra'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                          </div> 
                      </div>
                          </form>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>";

} 