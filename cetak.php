<?php
session_start();
if ($_SESSION['id'] == '') {

} else {

include "config/koneksi.php";

// if ($_GET['id'] != '') {

// $detail_1 = mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_siswa` a LEFT JOIN tbl_siswa b ON a.kode_siswa = b.kode_siswa LEFT JOIN tbl_ekskul_jabatan c ON a.kode_ekskul_jabatan=c.kode_ekskul_jabatan LEFT JOIN tbl_ekskul d ON a.kode_ekskul=d.kode_ekskul LEFT JOIN tbl_kelamin e ON b.kode_kelamin = e.kode_kelamin where a.kode_ekskul_siswa='$_GET[id]'");

// } else {

$detail_1 = mysqli_query($koneksi,"SELECT * FROM `tbl_ekskul_siswa` a LEFT JOIN tbl_siswa b ON a.kode_siswa = b.kode_siswa LEFT JOIN tbl_ekskul_jabatan c ON a.kode_ekskul_jabatan=c.kode_ekskul_jabatan LEFT JOIN tbl_ekskul d ON a.kode_ekskul=d.kode_ekskul LEFT JOIN tbl_kelamin e ON b.kode_kelamin = e.kode_kelamin where b.kode_siswa='$_GET[idd]'");

// }

$detail_2 = mysqli_query($koneksi,"SELECT * FROM identitas_sekolah");
$sekolah = mysqli_fetch_array($detail_2);
$siswa = mysqli_fetch_array($detail_1);

?>

<script type="text/javascript">
	window.print();
</script>

<table>
<thead>
  <tr>
  	<th><img height="40" width="40" src="foto_siswa/logo.png"></th>
    <th colspan="3">KARTU TANDA ANGGOTA EKSTRAKULIKULER<br><?=$sekolah['nama_sekolah']?></th>
  </tr>
  <tr>
  	<th bgcolor="brown" colspan="4"></th>
  </tr>
</thead>

<tbody>
  <tr>
    <td rowspan="4"><img height="100px" width="100px" src="<?= $siswa['foto'] ?>"></td>
    <td>NISN</td>
    <td>:</td>
    <td><?= $siswa['nisn'] ?></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td><?= $siswa['nama'] ?></td>
  </tr>
  <tr>
    <td>TTL</td>
    <td>:</td>
    <td><?= $siswa['tempat_lahir'] ?>, <?= $siswa['tanggal_lahir'] ?> </td>
  </tr>
  <tr>
    <td>J. Kelamin</td>
    <td>:</td>
    <td><?= $siswa['kelamin'] ?></td>
  </tr>
  <tr>
  	<td></td>
    <td>Ekskul</td>
    <td>:</td>
    <td><?= $siswa['nama_jabatan'] ?> - <?= $siswa['nama_ekskul'] ?></td>
  </tr>
  <tr>
  	<td></td>
    <td>Alamat</td>
    <td>:</td>
    <td><?= $siswa['alamat'] ?></td>
  </tr>
  <tr>
  	<th bgcolor="brown" colspan="4"></th>
  </tr>
  <tr>
    <td colspan="4"><i>Berlaku selama menjadi <?= $siswa['nama_jabatan'] ?> Ekskul <?= $siswa['nama_ekskul'] ?></i></td>
  </tr>
</tbody>
</table>

<?php } ?>