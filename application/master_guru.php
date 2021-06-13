<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Data Guru </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=guru&act=tambahguru'>Tambahkan Data Guru</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                        <th>Status Pegawai</th>
                        <th>Jenis PTK</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM guru a 
                                          LEFT JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin 
                                            LEFT JOIN status_kepegawaian c ON a.id_status_kepegawaian=c.id_status_kepegawaian 
                                              LEFT JOIN jenis_ptk d ON a.id_jenis_ptk=d.id_jenis_ptk
                                              ORDER BY a.nip DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    $tanggal = tgl_indo($r[tgl_posting]);
                    echo "<tr><td>$no</td>
                              <td>$r[nip]</td>
                              <td>$r[nama_guru]</td>
                              <td>$r[jenis_kelamin]</td>
                              <td>$r[hp]</td>
                              <td>$r[status_kepegawaian]</td>
                              <td>$r[jenis_ptk]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-info btn-xs' title='Lihat Detail' href='?view=guru&act=detailguru&id=$r[nip]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=guru&act=editguru&id=$r[nip]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=guru&hapus=$r[nip]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }else{
                                echo "<td><center>
                                <a class='btn btn-info btn-xs' title='Lihat Detail' href='?view=guru&act=detailguru&id=$r[nip]'><span class='glyphicon glyphicon-search'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM guru where nip='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=guru';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET[act]=='tambahguru'){
  if (isset($_POST[tambah])){
      $rtrw = explode('/',$_POST[al]);
      $rt = $rtrw[0];
      $rw = $rtrw[1];
      $day1 = strtotime($_POST["ae"]);
      $day1 = date('Y-m-d', $day1);
      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['ax']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['ax']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['ax']['tmp_name'], $uploadfile)) {
          mysqli_query($koneksi,"INSERT INTO guru VALUES('$_POST[aa]','$_POST[ab]','$_POST[ac]','$_POST[af]','$_POST[ad]',
                           '$day1','$_POST[ba]','$_POST[bv]','$_POST[aq]','$_POST[au]','$_POST[as]','$_POST[ar]', 
                           '$_POST[ag]','$_POST[ak]','$rt','$rw','$_POST[am]','$_POST[an]','$_POST[ao]','$_POST[ap]',
                           '$_POST[ai]','$_POST[ah]','$_POST[aj]','$_POST[at]','$_POST[av]','$_POST[bb]','$_POST[bc]', 
                           '$_POST[bd]','$_POST[be]','$_POST[bf]','$_POST[bg]','$_POST[bi]','$_POST[bh]','$_POST[bj]',
                           '$_POST[aw]','$_POST[bk]','$_POST[bl]','$_POST[bm]','$_POST[bn]','$_POST[bo]','$_POST[bp]',
                           '$_POST[bq]','$_POST[br]','$_POST[bs]','$_POST[bt]','$_POST[bw]','$_POST[bu]','$filenamee')");
        }
      }else{
          mysqli_query($koneksi,"INSERT INTO guru VALUES('$_POST[aa]','$_POST[ab]','$_POST[ac]','$_POST[af]','$_POST[ad]',
                           '$day1','$_POST[ba]','$_POST[bv]','$_POST[aq]','$_POST[au]','$_POST[as]','$_POST[ar]', 
                           '$_POST[ag]','$_POST[ak]','$rt','$rw','$_POST[am]','$_POST[an]','$_POST[ao]','$_POST[ap]',
                           '$_POST[ai]','$_POST[ah]','$_POST[aj]','$_POST[at]','$_POST[av]','$_POST[bb]','$_POST[bc]', 
                           '$_POST[bd]','$_POST[be]','$_POST[bf]','$_POST[bg]','$_POST[bi]','$_POST[bh]','$_POST[bj]',
                           '$_POST[aw]','$_POST[bk]','$_POST[bl]','$_POST[bm]','$_POST[bn]','$_POST[bo]','$_POST[bp]',
                           '$_POST[bq]','$_POST[br]','$_POST[bs]','$_POST[bt]','$_POST[bw]','$_POST[bu]','')");
      }
      echo "<script>document.location='index.php?view=guru&act=detailguru&id=".$_POST[aa]."';</script>";
  }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Guru</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[nip]'>
                    <tr><th width='120px' scope='row'>Nip</th>      <td><input type='text' class='form-control' name='aa'></td></tr>
                    <tr><th scope='row'>Password</th>               <td><input type='text' class='form-control' name='ab'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>           <td><input type='text' class='form-control' name='ac'></td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>           <td><input type='text' class='form-control' name='ad'></td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>          <td><input type='date' class='form-control' name='ae'></td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>          <td><select class='form-control' name='af'> 
                                                                          <option value='0' selected>- Pilih Jenis Kelamin -</option>"; 
                                                                            $jk = mysqli_query($koneksi,"SELECT * FROM jenis_kelamin");
                                                                            while($a = mysqli_fetch_array($jk)){
                                                                                echo "<option value='$a[id_jenis_kelamin]'>$a[jenis_kelamin]</option>";
                                                                            }
                                                                            echo "</select></td></tr>
                    <tr><th scope='row'>Agama</th>                  <td><select class='form-control' name='ag'> 
                                                                          <option value='0' selected>- Pilih Agama -</option>"; 
                                                                            $agama = mysqli_query($koneksi,"SELECT * FROM agama");
                                                                            while($a = mysqli_fetch_array($agama)){
                                                                                echo "<option value='$a[id_agama]'>$a[nama_agama]</option>";
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>No Hp</th>                  <td><input type='text' class='form-control' name='ah'></td></tr>
                    <tr><th scope='row'>No Telpon</th>              <td><input type='text' class='form-control' name='ai'></td></tr>
                    <tr><th scope='row'>Alamat Email</th>           <td><input type='text' class='form-control' name='aj'></td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td><input type='text' class='form-control' name='ak'></td></tr>
                    <tr><th scope='row'>RT/RW</th>                  <td><input type='text' class='form-control' value='00/00' name='al'></td></tr>
                    <tr><th scope='row'>Status Nikah</th>           <td><select class='form-control' name='aw'> 
                                                                          <option value='0' selected>- Pilih Status Pernikahan -</option>"; 
                                                                            $status_pernikahan = mysqli_query($koneksi,"SELECT * FROM status_pernikahan");
                                                                            while($a = mysqli_fetch_array($status_pernikahan)){
                                                                                echo "<option value='$a[id_status_pernikahan]'>$a[status_pernikahan]</option>";
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                            <input type='file' class='files' name='ax' onchange='$("#upload-file-info").html($(this).val());'>
                                                                          <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div>
                    </td></tr>
                  </tbody>
                  </table>
                </div>

                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                  <tr><th scope='row'>Dusun</th>                  <td><input type='text' class='form-control' name='am'></td></tr>
                  <tr><th scope='row'>Kelurahan</th>              <td><input type='text' class='form-control' name='an'></td></tr>
                  <tr><th scope='row'>Kecamatan</th>              <td><input type='text' class='form-control' name='ao'></td></tr>
                  <tr><th scope='row'>Kode Pos</th>               <td><input type='text' class='form-control' name='ap'></td></tr>
                  <tr><th scope='row'>NUPTK</th>                  <td><input type='text' class='form-control' name='aq'></td></tr>
                  <tr><th scope='row'>Bidang Studi</th>           <td><input type='text' class='form-control' name='ar'></td></tr>
                  <tr><th scope='row'>Jenis PTK</th>              <td><select class='form-control' name='as'> 
                  <option value='0' selected>- Pilih Jenis PTK -</option>"; 
                    $ptk = mysqli_query($koneksi,"SELECT * FROM jenis_ptk");
                    while($a = mysqli_fetch_array($ptk)){
                        echo "<option value='$a[id_jenis_ptk]'>$a[jenis_ptk]</option>";
                    }
          echo "</select></td></tr>
<tr><th scope='row'>Tugas Tambahan</th>         <td><input type='text' class='form-control' name='at'></td></tr>
<tr><th scope='row'>Status Pegawai</th>         <td><select class='form-control' name='au'> 
                  <option value='0' selected>- Pilih Status Kepegawaian -</option>"; 
                    $status_kepegawaian = mysqli_query($koneksi,"SELECT * FROM status_kepegawaian");
                    while($a = mysqli_fetch_array($status_kepegawaian)){
                        echo "<option value='$a[id_status_kepegawaian]'>$a[status_kepegawaian]</option>";
                    }
          echo "</select></td></tr>
                    <tr><th width='150px' scope='row'>NIK</th>      <td><input type='text' class='form-control' name='ba'></td></tr>
                    <tr><th scope='row'>Kewarganegaraan</th>        <td><input type='text' class='form-control' name='bu'></td></tr>
                    <tr><th scope='row'>NPWP</th>                   <td><input type='text' class='form-control' name='bw'></td></tr>
                    <tr><th scope='row'>Status Keaktifan</th>       <td><select class='form-control' name='av'> 
                    <option value='0' selected>- Pilih Status Keaktifan -</option>"; 
                      $status_keaktifan = mysqli_query($koneksi,"SELECT * FROM status_keaktifan");
                      while($a = mysqli_fetch_array($status_keaktifan)){
                          echo "<option value='$a[id_status_keaktifan]'>$a[nama_status_keaktifan]</option>";
                      }
            echo "</select></td></tr>

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
            </div>";
}elseif($_GET[act]=='editguru'){
  if (isset($_POST[update1])){
      $rtrw = explode('/',$_POST[al]);
      $rt = $rtrw[0];
      $rw = $rtrw[1];
      $day1 = strtotime($_POST["ae"]);
      $day1 = date('Y-m-d', $day1);
      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['ax']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['ax']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['ax']['tmp_name'], $uploadfile)) {
          mysqli_query($koneksi,"UPDATE guru SET 
                           nip          = '$_POST[aa]',
                           password     = '$_POST[ab]',
                           nama_guru         = '$_POST[ac]',
                           tempat_lahir       = '$_POST[ad]',
                           tanggal_lahir = '$day1',
                           id_jenis_kelamin       = '$_POST[af]',
                           id_agama           = '$_POST[ag]',
                           hp         = '$_POST[ah]',
                           telepon       = '$_POST[ai]',
                           email        = '$_POST[aj]',
                           alamat_jalan      = '$_POST[ak]',
                           rt = '$rt',
                           rw          = '$rw',
                           nama_dusun = '$_POST[am]',
                           desa_kelurahan = '$_POST[an]',
                           kecamatan = '$_POST[ao]',
                           kode_pos = '$_POST[ap]',
                           nuptk = '$_POST[aq]',
                           pengawas_bidang_studi = '$_POST[ar]', 
                           id_jenis_ptk = '$_POST[as]',
                           tugas_tambahan = '$_POST[at]', 
                           id_status_kepegawaian = '$_POST[au]',
                           id_status_keaktifan = '$_POST[av]',
                           id_status_pernikahan = '$_POST[aw]', 
                           foto = '$filenamee', 

                           nik = '$_POST[ba]', 
                           sk_cpns = '$_POST[bb]', 
                           tanggal_cpns = '$_POST[bc]', 
                           sk_pengangkatan = '$_POST[bd]', 
                           tmt_pengangkatan = '$_POST[be]', 
                           lembaga_pengangkatan = '$_POST[bf]',
                           id_golongan = '$_POST[bg]', 
                           sumber_gaji = '$_POST[bh]',
                           keahlian_laboratorium = '$_POST[bi]',
                           nama_ibu_kandung = '$_POST[bj]',
                           nama_suami_istri = '$_POST[bk]',
                           nip_suami_istri = '$_POST[bl]',
                           pekerjaan_suami_istri = '$_POST[bm]',
                           tmt_pns = '$_POST[bn]',
                           lisensi_kepsek = '$_POST[bo]',
                           jumlah_sekolah_binaan = '$_POST[bp]',
                           diklat_kepengawasan = '$_POST[bq]',
                           mampu_handle_kk = '$_POST[br]',
                           keahlian_breile = '$_POST[bs]',
                           keahlian_bahasa_isyarat = '$_POST[bt]',
                           kewarganegaraan = '$_POST[bu]',
                           niy_nigk = '$_POST[bv]',
                           npwp = '$_POST[bw]' where nip='$_POST[id]'");
        }
      }else{
          mysqli_query($koneksi,"UPDATE guru SET 
                           nip          = '$_POST[aa]',
                           password     = '$_POST[ab]',
                           nama_guru         = '$_POST[ac]',
                           tempat_lahir       = '$_POST[ad]',
                           tanggal_lahir = '$day1',
                           id_jenis_kelamin       = '$_POST[af]',
                           id_agama           = '$_POST[ag]',
                           hp         = '$_POST[ah]',
                           telepon       = '$_POST[ai]',
                           email        = '$_POST[aj]',
                           alamat_jalan      = '$_POST[ak]',
                           rt = '$rt',
                           rw          = '$rw',
                           nama_dusun = '$_POST[am]',
                           desa_kelurahan = '$_POST[an]',
                           kecamatan = '$_POST[ao]',
                           kode_pos = '$_POST[ap]',
                           nuptk = '$_POST[aq]',
                           pengawas_bidang_studi = '$_POST[ar]', 
                           id_jenis_ptk = '$_POST[as]',
                           tugas_tambahan = '$_POST[at]', 
                           id_status_kepegawaian = '$_POST[au]',
                           id_status_keaktifan = '$_POST[av]',
                           id_status_pernikahan = '$_POST[aw]',

                           nik = '$_POST[ba]', 
                           sk_cpns = '$_POST[bb]', 
                           tanggal_cpns = '$_POST[bc]', 
                           sk_pengangkatan = '$_POST[bd]', 
                           tmt_pengangkatan = '$_POST[be]', 
                           lembaga_pengangkatan = '$_POST[bf]',
                           id_golongan = '$_POST[bg]', 
                           sumber_gaji = '$_POST[bh]',
                           keahlian_laboratorium = '$_POST[bi]',
                           nama_ibu_kandung = '$_POST[bj]',
                           nama_suami_istri = '$_POST[bk]',
                           nip_suami_istri = '$_POST[bl]',
                           pekerjaan_suami_istri = '$_POST[bm]',
                           tmt_pns = '$_POST[bn]',
                           lisensi_kepsek = '$_POST[bo]',
                           jumlah_sekolah_binaan = '$_POST[bp]',
                           diklat_kepengawasan = '$_POST[bq]',
                           mampu_handle_kk = '$_POST[br]',
                           keahlian_breile = '$_POST[bs]',
                           keahlian_bahasa_isyarat = '$_POST[bt]',
                           kewarganegaraan = '$_POST[bu]',
                           niy_nigk = '$_POST[bv]',
                           npwp = '$_POST[bw]' where nip='$_POST[id]'");
      }
      echo "<script>document.location='index.php?view=guru&act=detailguru&id=".$_POST[id]."';</script>";
  }

    $detail = mysqli_query($koneksi,"SELECT * FROM guru where nip='$_GET[id]'");
    $s = mysqli_fetch_array($detail);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Guru</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-7'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[nip]'>
                    <tr><th style='background-color:#E7EAEC' width='160px' rowspan='25'>";
                        if (trim($s[foto])==''){
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                        }else{
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/$s[foto]'>";
                        }
                        echo "</th>
                    </tr>
                    <input type='hidden' name='id' value='$s[nip]'>
                    <tr><th width='120px' scope='row'>Nip</th>      <td><input type='text' class='form-control' value='$s[nip]' name='aa'></td></tr>
                    <tr><th scope='row'>Password</th>               <td><input type='text' class='form-control' value='$s[password]' name='ab'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>           <td><input type='text' class='form-control' value='$s[nama_guru]' name='ac'></td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>           <td><input type='text' class='form-control' value='$s[tempat_lahir]' name='ad'></td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>          <td><input type='date' class='form-control' value='$s[tanggal_lahir]' name='ae'></td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>          <td><select class='form-control' name='af'> 
                                                                          <option value='0' selected>- Pilih Jenis Kelamin -</option>"; 
                                                                            $jk = mysqli_query($koneksi,"SELECT * FROM jenis_kelamin");
                                                                            while($a = mysqli_fetch_array($jk)){
                                                                              if ($a[id_jenis_kelamin] == $s[id_jenis_kelamin]){
                                                                                echo "<option value='$a[id_jenis_kelamin]' selected>$a[jenis_kelamin]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_jenis_kelamin]'>$a[jenis_kelamin]</option>";
                                                                              }
                                                                            }
                                                                            echo "</select></td></tr>
                    <tr><th scope='row'>Agama</th>                  <td><select class='form-control' name='ag'> 
                                                                          <option value='0' selected>- Pilih Agama -</option>"; 
                                                                            $agama = mysqli_query($koneksi,"SELECT * FROM agama");
                                                                            while($a = mysqli_fetch_array($agama)){
                                                                              if ($a[id_agama] == $s[id_agama]){
                                                                                echo "<option value='$a[id_agama]' selected>$a[nama_agama]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_agama]'>$a[nama_agama]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>No Hp</th>                  <td><input type='text' class='form-control' value='$s[hp]' name='ah'></td></tr>
                    <tr><th scope='row'>No Telpon</th>              <td><input type='text' class='form-control' value='$s[telepon]' name='ai'></td></tr>
                    <tr><th scope='row'>Alamat Email</th>           <td><input type='text' class='form-control' value='$s[email]' name='aj'></td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td><input type='text' class='form-control' value='$s[alamat_jalan]' name='ak'></td></tr>
                    <tr><th scope='row'>RT/RW</th>                  <td><input type='text' class='form-control' value='$s[rt]/$s[rw]' name='al'></td></tr>
                    <tr><th scope='row'>Dusun</th>                  <td><input type='text' class='form-control' value='$s[nama_dusun]' name='am'></td></tr>
                    <tr><th scope='row'>Kelurahan</th>              <td><input type='text' class='form-control' value='$s[desa_kelurahan]' name='an'></td></tr>
                    <tr><th scope='row'>Kecamatan</th>              <td><input type='text' class='form-control' value='$s[kecamatan]' name='ao'></td></tr>
                    <tr><th scope='row'>Kode Pos</th>               <td><input type='text' class='form-control' value='$s[kode_pos]' name='ap'></td></tr>
                    <tr><th scope='row'>NUPTK</th>                  <td><input type='text' class='form-control' value='$s[nuptk]' name='aq'></td></tr>
                    <tr><th scope='row'>Bidang Studi</th>           <td><input type='text' class='form-control' value='$s[pengawas_bidang_studi]' name='ar'></td></tr>
                    <tr><th scope='row'>Jenis PTK</th>              <td><select class='form-control' name='as'> 
                                                                          <option value='0' selected>- Pilih Jenis PTK -</option>"; 
                                                                            $ptk = mysqli_query($koneksi,"SELECT * FROM jenis_ptk");
                                                                            while($a = mysqli_fetch_array($ptk)){
                                                                              if ($a[id_jenis_ptk] == $s[id_jenis_ptk]){
                                                                                echo "<option value='$a[id_jenis_ptk]' selected>$a[jenis_ptk]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_jenis_ptk]'>$a[jenis_ptk]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>Tugas Tambahan</th>         <td><input type='text' class='form-control' value='$s[tugas_tambahan]' name='at'></td></tr>
                    <tr><th scope='row'>Status Pegawai</th>         <td><select class='form-control' name='au'> 
                                                                          <option value='0' selected>- Pilih Status Kepegawaian -</option>"; 
                                                                            $status_kepegawaian = mysqli_query($koneksi,"SELECT * FROM status_kepegawaian");
                                                                            while($a = mysqli_fetch_array($status_kepegawaian)){
                                                                              if ($a[id_status_kepegawaian] == $s[id_status_kepegawaian]){
                                                                                echo "<option value='$a[id_status_kepegawaian]' selected>$a[status_kepegawaian]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_status_kepegawaian]'>$a[status_kepegawaian]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>Status Keaktifan</th>       <td><select class='form-control' name='av'> 
                                                                          <option value='0' selected>- Pilih Status Keaktifan -</option>"; 
                                                                            $status_keaktifan = mysqli_query($koneksi,"SELECT * FROM status_keaktifan");
                                                                            while($a = mysqli_fetch_array($status_keaktifan)){
                                                                              if ($a[id_status_keaktifan] == $s[id_status_keaktifan]){
                                                                                echo "<option value='$a[id_status_keaktifan]' selected>$a[nama_status_keaktifan]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_status_keaktifan]'>$a[nama_status_keaktifan]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>Status Nikah</th>           <td><select class='form-control' name='aw'> 
                                                                          <option value='0' selected>- Pilih Status Pernikahan -</option>"; 
                                                                            $status_pernikahan = mysqli_query($koneksi,"SELECT * FROM status_pernikahan");
                                                                            while($a = mysqli_fetch_array($status_pernikahan)){
                                                                              if ($a[id_status_pernikahan] == $s[id_status_pernikahan]){
                                                                                echo "<option value='$a[id_status_pernikahan]' selected>$a[status_pernikahan]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_status_pernikahan]'>$a[status_pernikahan]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>Ganti Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                            <input type='file' class='files' name='ax' onchange='$("#upload-file-info").html($(this).val());'>
                                                                          <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div>
                    </td></tr>
                  </tbody>
                  </table>
                </div>

                <div class='col-md-5'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='150px' scope='row'>NIK</th>      <td><input type='text' class='form-control' value='$s[nik]' name='ba'></td></tr>
                    <tr><th scope='row'>SK CPNS</th>                <td><input type='text' class='form-control' value='$s[sk_cpns]' name='bb'></td></tr>
                    <tr><th scope='row'>Tanggal CPNS</th>           <td><input type='text' class='form-control' value='$s[tanggal_cpns]' name='bc'></td></tr>
                    <tr><th scope='row'>SK Pengangkat</th>          <td><input type='text' class='form-control' value='$s[sk_pengangkatan]' name='bd'></td></tr>
                    <tr><th scope='row'>TMT Pengangkat</th>         <td><input type='text' class='form-control' value='$s[tmt_pengangkatan]' name='be'></td></tr>
                    <tr><th scope='row'>Lemb. Pengangkat</th>       <td><input type='text' class='form-control' value='$s[lembaga_pengangkatan]' name='bf'></td></tr>
                    <tr><th scope='row'>Golongan</th>               <td><select class='form-control' name='bg'> 
                                                                          <option value='0' selected>- Pilih Golongan -</option>"; 
                                                                            $golongan = mysqli_query($koneksi,"SELECT * FROM golongan");
                                                                            while($a = mysqli_fetch_array($golongan)){
                                                                              if ($a[id_golongan] == $s[id_golongan]){
                                                                                echo "<option value='$a[id_golongan]' selected>$a[nama_golongan]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_golongan]'>$a[nama_golongan]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                    <tr><th scope='row'>Sumber Gaji</th>            <td><input type='text' class='form-control' value='$s[sumber_gaji]' name='bh'></td></tr>

                    <tr><th scope='row'>Ahli Laboratorium</th>      <td><input type='text' class='form-control' value='$s[keahlian_laboratorium]' name='bi'></td></tr>
                    <tr><th scope='row'>Nama Ibu Kandung</th>       <td><input type='text' class='form-control' value='$s[nama_ibu_kandung]' name='bj'></td></tr>
                    <tr><th scope='row'>Nama Suami/Istri</th>       <td><input type='text' class='form-control' value='$s[nama_suami_istri]' name='bk'></td></tr>
                    <tr><th scope='row'>Nip Suami/Istri</th>        <td><input type='text' class='form-control' value='$s[nip_suami_istri]' name='bl'></td></tr>
                    <tr><th scope='row'>Pekerjaan Suami/Istri</th>  <td><input type='text' class='form-control' value='$s[pekerjaan_suami_istri]' name='bm'></td></tr>
                    <tr><th scope='row'>TMT PNS</th>                <td><input type='text' class='form-control' value='$s[tmt_pns]' name='bn'></td></tr>
                    <tr><th scope='row'>Lisensi Kepsek</th>         <td><input type='text' class='form-control' value='$s[lisensi_kepsek]' name='bo'></td></tr>
                    <tr><th scope='row'>Jml Sekolah Binaan</th>     <td><input type='text' class='form-control' value='$s[jumlah_sekolah_binaan]' name='bp'></td></tr>
                    <tr><th scope='row'>Diklat Kepengawasan</th>    <td><input type='text' class='form-control' value='$s[diklat_kepengawasan]' name='bq'></td></tr>
                    <tr><th scope='row'>Mampu Handle KK</th>        <td><input type='text' class='form-control' value='$s[mampu_handle_kk]' name='br'></td></tr>
                    <tr><th scope='row'>Keahlian Breile</th>        <td><input type='text' class='form-control' value='$s[keahlian_breile]' name='bs'></td></tr>
                    <tr><th scope='row'>Keahlian B.Isyarat</th>     <td><input type='text' class='form-control' value='$s[keahlian_bahasa_isyarat]' name='bt'></td></tr>
                    <tr><th scope='row'>Kewarganegaraan</th>        <td><input type='text' class='form-control' value='$s[kewarganegaraan]' name='bu'></td></tr>
                    <tr><th scope='row'>NIY NIGK</th>               <td><input type='text' class='form-control' value='$s[niy_nigk]' name='bv'></td></tr>
                    <tr><th scope='row'>NPWP</th>                   <td><input type='text' class='form-control' value='$s[npwp]' name='bw'></td></tr>

                  </tbody>
                  </table>
                </div> 
                <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update1' class='btn btn-info'>Update</button>
                          <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 
              </div>
            </form>
            </div>";
}elseif($_GET[act]=='detailguru'){
    $detail = mysqli_query($koneksi,"SELECT a.*, b.jenis_kelamin, c.status_kepegawaian, d.jenis_ptk, e.nama_agama, f.nama_status_keaktifan, g.nama_golongan, h.status_pernikahan 
                                FROM guru a LEFT JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin 
                                  LEFT JOIN status_kepegawaian c ON a.id_status_kepegawaian=c.id_status_kepegawaian 
                                    LEFT JOIN jenis_ptk d ON a.id_jenis_ptk=d.id_jenis_ptk 
                                      LEFT JOIN agama e ON a.id_agama=e.id_agama 
                                        LEFT JOIN status_keaktifan f ON a.id_status_keaktifan=f.id_status_keaktifan 
                                          LEFT JOIN golongan g ON a.id_golongan=g.id_golongan
                                            LEFT JOIN status_pernikahan h ON a.id_status_pernikahan=h.id_status_pernikahan
                                              where a.nip='$_GET[id]'");
    $s = mysqli_fetch_array($detail);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Guru</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-7'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[nip]'>
                    <tr><th style='background-color:#E7EAEC' width='160px' rowspan='25'>";
                        if (trim($s[foto])==''){
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                        }else{
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/$s[foto]'>";
                        }
                      if($_SESSION[level]!='kepala'){
                        echo "<a href='index.php?view=guru&act=editguru&id=$_GET[id]' class='btn btn-success btn-block'>Edit Profile</a>";
                      }
                        echo "</th>
                    </tr>
                    <tr><th width='120px' scope='row'>Nip</th>      <td>$s[nip]</td></tr>
                    <tr><th scope='row'>Password</th>               <td>$s[password]</td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>           <td>$s[nama_guru]</td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>           <td>$s[tempat_lahir]</td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>          <td>$s[tanggal_lahir]</td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>          <td>$s[jenis_kelamin]</td></tr>
                    <tr><th scope='row'>Agama</th>                  <td>$s[nama_agama]</td></tr>
                    <tr><th scope='row'>No Hp</th>                  <td>$s[hp]</td></tr>
                    <tr><th scope='row'>No Telpon</th>              <td>$s[telepon]</td></tr>
                    <tr><th scope='row'>Alamat Email</th>           <td>$s[email]</td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td>$s[alamat_jalan]</td></tr>
                    <tr><th scope='row'>RT/RW</th>                  <td>$s[rt]/$s[rw]</td></tr>
                    <tr><th scope='row'>Dusun</th>                  <td>$s[nama_dusun]</td></tr>
                    <tr><th scope='row'>Kelurahan</th>              <td>$s[desa_kelurahan]</td></tr>
                    <tr><th scope='row'>Kecamatan</th>              <td>$s[kecamatan]</td></tr>
                    <tr><th scope='row'>Kode Pos</th>               <td>$s[kode_pos]</td></tr>
                    <tr><th scope='row'>NUPTK</th>                  <td>$s[nuptk]</td></tr>
                    <tr><th scope='row'>Bidang Studi</th>           <td>$s[pengawas_bidang_studi]</td></tr>
                    <tr><th scope='row'>Jenis PTK</th>              <td>$s[jenis_ptk]</td></tr>
                    <tr><th scope='row'>Tugas Tambahan</th>         <td>$s[tugas_tambahan]</td></tr>
                    <tr><th scope='row'>Status Pegawai</th>         <td>$s[status_kepegawaian]</td></tr>
                    <tr><th scope='row'>Status Keaktifan</th>       <td>$s[nama_status_keaktifan]</td></tr>
                    <tr><th scope='row'>Status Nikah</th>           <td>$s[status_pernikahan]</td></tr>
                  </tbody>
                  </table>
                </div>

                <div class='col-md-5'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='150px' scope='row'>NIK</th>      <td>$s[nik]</td></tr>
                    <tr><th scope='row'>SK CPNS</th>                <td>$s[sk_cpns]</td></tr>
                    <tr><th scope='row'>Tanggal CPNS</th>           <td>$s[tanggal_cpns]</td></tr>
                    <tr><th scope='row'>SK Pengangkat</th>          <td>$s[sk_pengangkatan]</td></tr>
                    <tr><th scope='row'>TMT Pengangkat</th>         <td>$s[tmt_pengangkatan]</td></tr>
                    <tr><th scope='row'>Lemb. Pengangkat</th>       <td>$s[lembaga_pengangkatan]</td></tr>
                    <tr><th scope='row'>Golongan</th>               <td>$s[nama_golongan]</td></tr>
                    <tr><th scope='row'>Sumber Gaji</th>            <td>$s[sumber_gaji]</td></tr>

                    <tr><th scope='row'>Ahli Laboratorium</th>  <td>$s[keahlian_laboratorium]</td></tr>
                    <tr><th scope='row'>Nama Ibu Kandung</th>            <td>$s[nama_ibu_kandung]</td></tr>
                    <tr><th scope='row'>Nama Suami/Istri</th>            <td>$s[nama_suami_istri]</td></tr>
                    <tr><th scope='row'>Nip Suami/Istri</th>            <td>$s[nip_suami_istri]</td></tr>
                    <tr><th scope='row'>Pekerjaan Suami/Istri</th>            <td>$s[pekerjaan_suami_istri]</td></tr>
                    <tr><th scope='row'>TMT PNS</th>            <td>$s[tmt_pns]</td></tr>
                    <tr><th scope='row'>Lisensi Kepsek</th>            <td>$s[lisensi_kepsek]</td></tr>
                    <tr><th scope='row'>Jml Sekolah Binaan</th>            <td>$s[jumlah_sekolah_binaan]</td></tr>
                    <tr><th scope='row'>Diklat Kepengawasan</th>            <td>$s[diklat_kepengawasan]</td></tr>
                    <tr><th scope='row'>Mampu Handle KK</th>            <td>$s[mampu_handle_kk]</td></tr>
                    <tr><th scope='row'>Keahlian Breile</th>            <td>$s[keahlian_breile]</td></tr>
                    <tr><th scope='row'>Keahlian B.Isyarat</th>            <td>$s[keahlian_bahasa_isyarat]</td></tr>
                    <tr><th scope='row'>Kewarganegaraan</th>            <td>$s[kewarganegaraan]</td></tr>
                    <tr><th scope='row'>NIY NIGK</th>            <td>$s[niy_nigk]</td></tr>
                    <tr><th scope='row'>NPWP</th>                   <td>$s[npwp]</td></tr>

                  </tbody>
                  </table>
                </div> 
              </div>
            </form>
            </div>";
}  
?>