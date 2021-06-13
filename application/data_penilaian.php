<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Penilain </h3>

                  <?php if($_SESSION[level]=='1' || $_SESSION[level]=='3'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=penilaian&act=tambah'>Tambah Data</a>
                  <?php } ?>

                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action="?view=penilaian" method='GET'>
                    <input type="hidden" name='view' value='penilaian'>


                    <select name='ekskul' style='padding:4px; margin-right:5px;' required="">
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

                    <input value="<?= $_GET['tahun_ajaran'] ?>" type="text" name="tahun_ajaran" placeholder="ex. 2020/2021" >
                    <input type="submit" style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
                  </form>
                

                </div>
                <div class="box-body">

                <?php 
                  if (isset($_GET[ekskul])){
                   echo " <table id='example1' class='table table-bordered table-striped'>";
                  }else{

                   echo " <table id='example1' class='table table-bordered table-striped'>";
                  } ?>

                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Penilaian</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Ekstrakurikuler</th>
                        <th>Nilai Siswa</th>
                        <th>Tahun Ajaran</th>
                        <?php if($_SESSION[level]=='1'){ ?>
                        <th style='width:70px'>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>


                  <?php 

                    if ($_GET['tahun_ajaran'] != '') {
                      $thaj = "AND a.tahun_ajaran LIKE '%$_GET[tahun_ajaran]%'";
                    } else {
                      $thaj = "";
                    }

                    if ($_SESSION['level'] == 'siswa') {
                      $tampil = mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_penilaian` a LEFT JOIN tbl_siswa b ON b.kode_siswa = a.kode_siswa LEFT JOIN tbl_ekskul c ON c.kode_ekskul = a.kode_ekskul WHERE a.kode_siswa='$_SESSION[id]' AND c.kode_ekskul='$_GET[ekskul]' ".$thaj." ORDER BY c.kode_ekskul ASC"); 
                    } else {

                    $tampil = mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_penilaian` a LEFT JOIN tbl_siswa b ON b.kode_siswa = a.kode_siswa LEFT JOIN tbl_ekskul c ON c.kode_ekskul = a.kode_ekskul WHERE c.kode_ekskul='$_GET[ekskul]' ".$thaj." ORDER BY c.kode_ekskul ASC"); 

                    }

                    $no = 1;

                    while($r=mysqli_fetch_array($tampil)){


                                        $kls = mysqli_query($koneksi,"SELECT * FROM `tbl_kelas` a LEFT JOIN tbl_jurusan b ON b.kode_jurusan = a.kode_jurusan where a.kode_kelas='$r[kode_kelas]'");
                                        $kl = mysqli_fetch_array($kls);
                                        
                    echo "<tr><td>$no</td>
                              <td>$r[kode_ekskul_penilaian]</td>
                              <td>$r[nama]</td>
                              <td>$kl[nama_kelas] - $kl[nama_jurusan]</td>
                              <td>$r[nama_ekskul]</td>
                              <td>$r[nilai_ekskul]</td>
                              <td>$r[tahun_ajaran]</td>";

                        $cekdata = mysqli_query($koneksi, "SELECT nama_ekskul FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
                        $cek = mysqli_fetch_array($cekdata);
                        if($_SESSION[level]=='1' || $cek['nama_ekskul'] == $r[nama_ekskul]){

                        echo "<td>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=penilaian&act=edit&id=$r[kode_ekskul_penilaian]'><span class='glyphicon glyphicon-edit'></span></a>"; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[kode_ekskul_penilaian]; ?> ?')" 


                                href="?view=penilaian&hapus=<?= $r[kode_ekskul_penilaian]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php echo "</td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_ekskul_penilaian where kode_ekskul_penilaian='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=penilaian';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

<!-- //////////////////////////////////////////////////////////////////////////////////// -->

<?php 
}

////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE tbl_ekskul_penilaian SET
                                         kode_ekskul = '$_POST[b]',
                                         nilai_ekskul = '$_POST[c]',
                                         tahun_ajaran = '$_POST[d]'
                                         where kode_ekskul_penilaian='$_POST[id]'");

      echo "<script>document.location='index.php?view=penilaian';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_penilaian` WHERE kode_ekskul_penilaian = '$_GET[id]'");
    $ds = mysqli_fetch_array($edit);
    
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Nilai Ekstrakulikuler</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <input type='hidden' type='text' class='form-control' value='$ds[kode_ekskul_penilaian]' name='id'>
                  <tr><th width='140px' scope='row'>Nama Siswa</th><td><select class='form-control' name='a' style='padding:4px'>";
                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_siswa WHERE kode_siswa=".$ds['kode_siswa']);
                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($ds[kode_siswa]==$k[kode_siswa]){
                                echo "<option value='$k[kode_siswa]' selected>$k[nisn] - $k[nama]</option>";
                              }else{
                                echo "<option value='$k[kode_siswa]'>$k[nisn] - $k[nama]</option>";
                              }
                            }



 echo "<tr><th scope='row'>Ekstrakulikuler</th><td><select class='form-control' name='b' style='padding:4px'><option value=''>- Pilih Ekstrakulikuler</option>";


if ($_SESSION[level] == '3') {
$data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
$s = mysqli_fetch_array($data);

                            $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul WHERE kode_ekskul = '$s[kode_ekskul]'");

} else {
  $pegawai = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul");
}


                            while ($k = mysqli_fetch_array($pegawai)){
                              if ($s[kode_ekskul]==$k[kode_ekskul]){
                                echo "<option value='$k[kode_ekskul]' selected>$k[kode_ekskul] - $k[nama_ekskul]</option>";
                              }else{
                                echo "<option value='$k[kode_ekskul]'>$k[kode_ekskul] - $k[nama_ekskul]</option>";
                              }
                            }



                  echo "</select></td></tr>
                    <tr><th scope='row'>Nilai Siswa</th>    <td><input type='number' value='$ds[nilai_ekskul]' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Tahun Ajaran</th>    <td><input type='text' value='$ds[tahun_ajaran]' class='form-control' name='d'></td></tr>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Ubah</button>
                    <a href='index.php?view=penilaian'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}

////////////////////////////////////////////////////////////////////////////////////////

elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO `tbl_ekskul_penilaian`(`kode_siswa`, `kode_ekskul`, `nilai_ekskul`, tahun_ajaran) VALUES ('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
        echo "<script>document.location='index.php?view=penilaian';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Nilai Ekstrakulikuler</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                              <tr><th width='140px' scope='row'>Nama Siswa</th> <td><select class='form-control' name='a'> 
                                                                            <option value='0' selected>- Pilih Siswa -</option>"; 
                                                                              $siswa = mysqli_query($koneksi,"SELECT * FROM tbl_siswa");
                                                                              while($a = mysqli_fetch_array($siswa)){
                                                                                  echo "<option value='$a[kode_siswa]'>$a[nisn] - $a[nama]</option>";
                                                                              }

                                                                              echo "</select></td></tr>
                              <tr><th scope='row'>Ekstrakulikuler</th> <td><select class='form-control' name='b'> 
                                                                            <option value='0' selected>- Pilih ekskul -</option>"; 

if ($_SESSION[level] == '3') {

                            $ekskul = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");

} else {
  $ekskul = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul");
}
                                                                              





                                                                              while($a = mysqli_fetch_array($ekskul)){
                                                                                  echo "<option value='$a[kode_ekskul]'>$a[nama_ekskul]</option>";
                                                                              }
                  echo "</select></td></tr>
                    <tr><th scope='row'>Nilai Siswa</th>    <td><input type='number' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Tahun Ajaran</th>    <td><input type='text' class='form-control' name='d' placeholder='ex. 2020/2021'></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=penilaian'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
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