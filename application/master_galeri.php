<?php if ($_GET[act]==''){ ?> 

            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">GALLERY EKSTRAKULIKULER</h3>
                  <?php if ($_SESSION[level] == '1' || $_SESSION[level] == '3') {?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=galeri&act=tambah'>Tambah Data</a>
                <?php } ?>
                  
                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action="?view=galeri" method='GET'>
                    <input type="hidden" name='view' value='galeri'>
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

                <?php 
                  if (isset($_GET[ekskul])){ ?>
                    <table id="example1" class="table table-bordered table-striped">
                  <?php }else{ ?>
                    <table id="example1" class="table table-bordered table-striped">
                  <?php } ?>

                  <thead>
                      <tr>

                        <th style='width:40px'>NO</th>
                        <th>FOTO KEGIATAN</th>
                        <th>NAMA KEGIATANA</th>
                        <th>TANGGAL</th>
                        <th style='width:70px'>Aksi</th>
                      </tr>
                    </thead> 
                    <tbody>
                  <?php 

            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul_gallery a LEFT JOIN tbl_ekskul b ON b.kode_ekskul = a.kode_ekskul WHERE a.kode_ekskul = '$_GET[ekskul]'");


                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>"; ?>



                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                      <a href="<?= $r[foto_ekskul] ?>" data-toggle="lightbox">
                        <img src="<?= $r[foto_ekskul] ?>" width="100px" height="100px" class="img-fluid mb-2" alt="white sample"/>
                      </a>
                    </div>


                              <?php echo "</td><td><b>$r[nama_ekskul]</b><br>$r[nama_kegiatan]</td>
                              <td>$r[tanggal]<br>$r[oleh]</td>"
                              ;

                        echo "<td><center>
                        <a class='btn btn-primary btn-xs' target='_BLANK' title='Unduh Gambar' href='$r[foto_ekskul]'><span class='glyphicon glyphicon-download'></span></a>";

                        $cekdata = mysqli_query($koneksi, "SELECT nama_ekskul FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
                        $cek = mysqli_fetch_array($cekdata);

                        if($_SESSION[level]=='1' || $cek['nama_ekskul'] == $r[nama_ekskul]){

                                echo "<a class='btn btn-success btn-xs' title='Edit Data' href='?view=galeri&act=edit&id=$r[kode_ekskul_gallery]'><span class='glyphicon glyphicon-edit'></span></a>
                                "; ?>

                                <a class='btn btn-danger btn-xs' title='Delete Data' onclick="return confirm('Apakah Kamu Yakin Ingin Hapus Data Kode : <?= $r[kode_ekskul_gallery]; ?> ?')" 


                                href="?view=galeri&hapus=<?= $r[kode_ekskul_gallery]; ?>"


                                ><span class='glyphicon glyphicon-remove'></span></a>

                              <?php } echo "</center></td>";

                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tbl_ekskul_gallery where kode_ekskul_gallery='$_GET[hapus]'");
                                      $gg = mysqli_query($koneksi, "SELECT foto_gallery FROM tbl_ekskul_gallery WHERE kode_ekskul_gallery =" . $_GET[hapus]);
            $dg = mysqli_fetch_array($gg);
            unlink($dg[foto_gallery]);
                          echo "<script>document.location='index.php?view=galeri';</script>";
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
  if (isset($_POST[update1])){

      $dir_gambar = 'foto_gallery/';
      $filename = basename($_FILES['file']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['file']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){

        $gg = mysqli_query($koneksi, "SELECT foto_ekskul FROM tbl_ekskul_gallery WHERE kode_ekskul_gallery = '$_POST[id]'");
        $dg = mysqli_fetch_array($gg);
        unlink($dg[foto_ekskul]);

           mysqli_query($koneksi,"
            UPDATE tbl_ekskul_gallery SET 
                               kode_ekskul   = '$_POST[a]',
                               foto_ekskul         = '$dir_gambar$filename',
                               tanggal       = '$_POST[b]',
                               nama_kegiatan    = '$_POST[c]'
                               -- ,oleh   = '$_POST[d]'
                               where kode_ekskul_gallery='$_POST[id]'");
        }
      }else{
           mysqli_query($koneksi,"
            UPDATE tbl_ekskul_gallery SET 
                               kode_ekskul   = '$_POST[a]',
                               tanggal       = '$_POST[b]',
                               nama_kegiatan    = '$_POST[c]'
                               -- ,oleh   = '$_POST[d]'
                               where kode_ekskul_gallery='$_POST[id]'");
      }
          echo "<script>document.location='index.php?view=galeri';</script>";
  }

    $edit = mysqli_query($koneksi,"SELECT * FROM tbl_ekskul_gallery a
                      LEFT JOIN tbl_ekskul b ON b.kode_ekskul = a.kode_ekskul WHERE a.kode_ekskul_gallery ='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Siswa</h3>
                </div>
                <div class='box-body'><div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Siswa </a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                          <input type='hidden' name='id' value='$s[kode_ekskul_gallery]'>
<th scope='row'>EKSTRAKULIKULER</th><td><select class='form-control' name='a'>";                       


  $pembina = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_ekskul = '$s[kode_ekskul]'");
  while ($a = mysqli_fetch_array($pembina)) {
    echo "<option value='$a[kode_ekskul]'>$a[nama_ekskul]</option>";
  }                           
                            echo "</select></td></tr>

<tr><th scope='row'>TANGGAL</th> <td><input type='date' class='form-control' value='$s[tanggal]'  name='b'></td></tr>
<tr><th scope='row'>NAMA KEGIATAN</th> <td><input type='text' class='form-control' value='$s[nama_kegiatan]'  name='c'></tr>

<th scope='row'>FOTO</th><td>
                            <input type='file' name='file'' id='file' accept='image/*' multiple>
                            </td></tr>
                          </tbody>
                          </table>
                        </div>
                        <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update1' class='btn btn-info'>Ubah</button>
                          <a href='index.php?view=galeri'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                        </div> 

                        </form>
                    </div>

                    </div>

                </div>
            </div>";

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

elseif ($_GET[act] == 'tambah') {
 
 // Count total files
 $countfiles = count($_FILES['file']['name']);

 // Looping all files
 for($i=0;$i<$countfiles;$i++){
  $filename = date("YmdHis").'-'.$_FILES['file']['name'][$i];


$sql =  "INSERT INTO `tbl_ekskul_gallery` (`kode_ekskul`, `foto_ekskul`, `tanggal`, nama_kegiatan) VALUES ('$_POST[a]', 'foto_gallery/$filename', '$_POST[b]', '$_POST[c]')";


  mysqli_query($koneksi, $sql);
 
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'][$i],'foto_gallery/'.$filename);

  echo "<script>document.location='index.php?view=galeri';</script>";
 
 }

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Galeri Ekstrakurikuler</h3>
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
                            <tbody>";

echo "<th scope='row'>EKSTRAKULIKULER</th><td><select class='form-control' name='a'>";                       

if ($_SESSION[level] == '3') {
$data = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_pegawai = '$_SESSION[id]'");
$s = mysqli_fetch_array($data);
  $pembina = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul WHERE kode_ekskul = '$s[kode_ekskul]'");


} else {
$pembina = mysqli_query($koneksi, "SELECT * FROM tbl_ekskul");  
}

  while ($a = mysqli_fetch_array($pembina)) {
    echo "<option value='$a[kode_ekskul]'>$a[nama_ekskul]</option>";
  }                           
                            echo "</select></td></tr>

<tr><th scope='row'>TANGGAL</th> <td><input type='date' class='form-control'  name='b'></td></tr>
<tr><th scope='row'>NAMA KEGIATAN</th> <td><input type='text' class='form-control'  name='c'></tr>

<th scope='row'>FOTO</th><td>
                            <input type='file' name='file[]'' id='file' accept='image/*' multiple>
                            </td></tr>





                                                                        </tbody>
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

<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>