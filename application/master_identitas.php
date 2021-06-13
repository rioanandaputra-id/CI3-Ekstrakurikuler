<?php if ($_GET[act]==''){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE identitas_sekolah SET nama_sekolah   = '$_POST[a]',
                                         npsn = '$_POST[b]',
                                         nss = '$_POST[c]',
                                         alamat_sekolah = '$_POST[d]',
                                         kode_pos = '$_POST[e]',
                                         no_telpon = '$_POST[f]',
                                         kelurahan = '$_POST[g]',
                                         kecamatan = '$_POST[h]',
                                         kabupaten_kota = '$_POST[i]',
                                         provinsi = '$_POST[j]',
                                         website = '$_POST[k]',
                                         email = '$_POST[l]' where id_identitas_sekolah='$_POST[id]'");
      echo "<script>document.location='index.php?view=identitas';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM identitas_sekolah ORDER BY id_identitas_sekolah DESC LIMIT 1");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Data Identitas Sekolah</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_identitas_sekolah]'>
                    <tr><th width='120px' scope='row'>Nama Sekolah</th>   <td><input type='text' class='form-control' name='a' value='$s[nama_sekolah]'></td></tr>
                    <tr><th scope='row'>NPSN</th>                         <td><input type='text' class='form-control' name='b' value='$s[npsn]'></td></tr>
                    <tr><th scope='row'>NSS</th>                          <td><input type='text' class='form-control' name='c' value='$s[nss]'></td></tr>
                    <tr><th scope='row'>Alamat Sekolah</th>               <td><input type='text' class='form-control' name='d' value='$s[alamat_sekolah]'></td></tr>
                    <tr><th scope='row'>Kode Pos</th>                     <td><input type='text' class='form-control' name='e' value='$s[kode_pos]'></td></tr>
                    <tr><th scope='row'>No Telpon</th>                    <td><input type='text' class='form-control' name='f' value='$s[no_telpon]'></td></tr>
                    <tr><th scope='row'>Kelurahan</th>                    <td><input type='text' class='form-control' name='g' value='$s[kelurahan]'></td></tr>
                    <tr><th scope='row'>Kecamatan</th>                    <td><input type='text' class='form-control' name='h' value='$s[kecamatan]'></td></tr>
                    <tr><th scope='row'>Kabupaten / Kota</th>             <td><input type='text' class='form-control' name='i' value='$s[kabupaten_kota]'></td></tr>
                    <tr><th scope='row'>Provinsi</th>                     <td><input type='text' class='form-control' name='j' value='$s[provinsi]'></td></tr>
                    <tr><th scope='row'>Website</th>                      <td><input type='text' class='form-control' name='k' value='$s[website]'></td></tr>
                    <tr><th scope='row'>Email</th>                        <td><input type='text' class='form-control' name='l' value='$s[email]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Ubah</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>