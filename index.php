<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_seo.php";

if (isset($_SESSION[id])) {
  

  if ($_SESSION[level] == '1') {
    $iden = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_pegawai where kode_pegawai='$_SESSION[id]'"));
    $nama =  $iden[nama];
    $level = 'Administrator';
    $foto = $iden[foto];
  } 

  elseif ($_SESSION[level] == '2') {
    $iden = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_pegawai where kode_pegawai='$_SESSION[id]'"));
    $nama =  $iden[nama];
    $level = 'Guru';
    $foto = 'foto_pegawai/' . $iden[foto];
  }

  elseif ($_SESSION[level] == '3') {
    $iden = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_pegawai where kode_pegawai='$_SESSION[id]'"));
    $nama =  $iden[nama];
    $level = 'Pembina';
    $foto = $iden[foto];
  }

  elseif ($_SESSION[level] == '4') {
    $iden = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_pegawai where kode_pegawai='$_SESSION[id]'"));
    $nama =  $iden[nama];
    $level = 'Ketua JUrusan';
    $foto = $iden[foto];
  }

  elseif ($_SESSION[level] == 'siswa') {
    $iden = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tbl_siswa where kode_siswa='$_SESSION[id]'"));
    $nama =  $iden[nama];
    $level = 'Siswa';
    $foto = $iden[foto];
  }

  $kurikulum = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kurikulum where status_kurikulum='Ya'"));
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Ekstrakurikuler</title>
    <meta name="author" content="2bagus.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->

<link rel="stylesheet" href="bootstrap/ekko-lightbox.css">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style type="text/css">
      .files {
        position: absolute;
        z-index: 2;
        top: 0;
        left: 0;
        filter: alpha(opacity=0);
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        opacity: 0;
        background-color: transparent;
        color: transparent;
      }
    </style>
    <script type="text/javascript" src="plugins/jQuery/jquery-1.12.3.min.js"></script>
    <script language="javascript" type="text/javascript">
      var maxAmount = 160;

      function textCounter(textField, showCountField) {
        if (textField.value.length > maxAmount) {
          textField.value = textField.value.substring(0, maxAmount);
        } else {
          showCountField.value = maxAmount - textField.value.length;
        }
      }
    </script>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <?php include "main-header.php"; ?>
      </header>

      <aside class="main-sidebar">
          <?php include "menu-admin.php";
        ?>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1> Dashboard <small>Control panel</small> </h1>
        </section>

        <section class="content">
          <?php
          if ($_GET[view] == 'home' or $_GET[view] == '') {

if($_SESSION[level] =='siswa'){

            echo "<div class='row'>";
            include "application/data_siswa.php";

} elseif ($_SESSION[level] =='3') {
   echo "<div class='row'>";
            include "application/master_paskibra.php";
}


else {


              echo "<div class='row'>";
              include "application/home_admin_row1.php";
              echo "</div>
                        <div class='row'>";
              include "application/home_admin_row2.php";
              echo "</div>";}


          } elseif ($_GET[view] == 'psbmenu') {
            echo "<div class='row'>";
            include "application/psb_menu.php";
            echo "</div>";
          } elseif ($_GET[view] == 'paskibra') {
            echo "<div class='row'>";
            include "application/master_paskibra.php";
            echo "</div>";
          } elseif ($_GET[view] == 'psbhalaman') {
            echo "<div class='row'>";
            include "application/psb_halaman.php";
            echo "</div>";
          } elseif ($_GET[view] == 'psbsma') {
            echo "<div class='row'>";
            include "application/psb_pendaftaran.php";
            echo "</div>";
          } elseif ($_GET[view] == 'psbsmk') {
            echo "<div class='row'>";
            include "application/psb_pendaftaran.php";
            echo "</div>";
          } elseif ($_GET[view] == 'psbsmp') {
            echo "<div class='row'>";
            include "application/psb_pendaftaran.php";
            echo "</div>";
          } elseif ($_GET[view] == 'psbaktivasi') {
            echo "<div class='row'>";
            include "application/psb_aktivasi.php";
            echo "</div>";
          } elseif ($_GET[view] == 'journalkbm') {
            echo "<div class='row'>";
            include "application/journal_semua.php";
            echo "</div>";
          } elseif ($_GET[view] == 'journalguru') {
            echo "<div class='row'>";
            include "application/journal_guru.php";
            echo "</div>";
          } elseif ($_GET[view] == 'kompetensiguru') {
            echo "<div class='row'>";
            include "application/kompetensidasar_guru.php";
            echo "</div>";
          } elseif ($_GET[view] == 'siswa') {
            echo "<div class='row'>";
            include "application/data_siswa.php";
            echo "</div>";
          } elseif ($_GET[view] == 'guru') {
            echo "<div class='row'>";
            include "application/master_guru.php";
            echo "</div>";
          } elseif ($_GET[view] == 'pembina') {
            echo "<div class='row'>";
            include "application/master_pembina.php";
            echo "</div>";
          } elseif ($_GET[view] == 'wakilkepala') {
            echo "<div class='row'>";
            include "application/master_wakilkepala.php";
            echo "</div>";
          } elseif ($_GET[view] == 'admin') {
            echo "<div class='row'>";
            include "application/master_admin.php";
            echo "</div>";
          } elseif ($_GET[view] == 'kelas') {
            echo "<div class='row'>";
            include "application/master_kelas.php";
            echo "</div>";
          } elseif ($_GET[view] == 'ekstrakurikuler') {
            echo "<div class='row'>";
            include "application/master_ekstrakurikuler.php";
            echo "</div>";
          } elseif ($_GET[view] == 'tahunakademik') {
            echo "<div class='row'>";
            include "application/master_tahun_akademik.php";
            echo "</div>";
          } elseif ($_GET[view] == 'gedung') {
            echo "<div class='row'>";
            include "application/master_gedung.php";
            echo "</div>";
          } elseif ($_GET[view] == 'pegawai') {
            echo "<div class='row'>";
            include "application/data_pegawai.php";
            echo "</div>";
          } elseif ($_GET[view] == 'ruangan') {
            echo "<div class='row'>";
            include "application/master_ruangan.php";
            echo "</div>";
          } elseif ($_GET[view] == 'skberkala') {
            echo "<div class='row'>";
            include "application/master_skberkala.php";
            echo "</div>";
          } elseif ($_GET[view] == 'jadwalujian') {
            echo "<div class='row'>";
            include "application/master_jadwal_ujian.php";
            echo "</div>";
          } elseif ($_GET[view] == 'jadwallomba') {
            echo "<div class='row'>";
            include "application/master_jadwal_perlombaan.php";
            echo "</div>";
          } elseif ($_GET[view] == 'penilaian') {
          
                        echo "<div class='row'>";
                        include "application/data_penilaian.php";
                        echo "</div>";
                      } 


          elseif ($_GET[view] == 'galeri') {
            echo "<div class='row'>";
            include "application/master_galeri.php";
            echo "</div>";
          } elseif ($_GET[view] == 'golongan') {
            echo "<div class='row'>";
            include "application/master_golongan.php";
            echo "</div>";
          } elseif ($_GET[view] == 'ptk') {
            echo "<div class='row'>";
            include "application/master_ptk.php";
            echo "</div>";
          } elseif ($_GET[view] == 'matapelajaran') {
            echo "<div class='row'>";
            include "application/master_matapelajaran.php";
            echo "</div>";
          } elseif ($_GET[view] == 'jadwalpelajaran') {
            echo "<div class='row'>";
            include "application/master_jadwalpelajaran.php";
            echo "</div>";
          } elseif ($_GET[view] == 'jurusan') {
            echo "<div class='row'>";
            include "application/master_jurusan.php";
            echo "</div>";
          } elseif ($_GET[view] == 'kurikulum') {
            echo "<div class='row'>";
            include "application/master_kurikulum.php";
            echo "</div>";
          } elseif ($_GET[view] == 'predikat') {
            echo "<div class='row'>";
            include "application/master_predikat.php";
            echo "</div>";
          } elseif ($_GET[view] == 'statuspegawai') {
            echo "<div class='row'>";
            include "application/master_statuspegawai.php";
            echo "</div>";
          } elseif ($_GET[view] == 'identitas') {
            echo "<div class='row'>";
            include "application/master_identitas.php";
            echo "</div>";
          } elseif ($_GET[view] == 'kelompokmapel') {
            echo "<div class='row'>";
            include "application/master_kelompokmapel.php";
            echo "</div>";
          } elseif ($_GET[view] == 'kompetensidasar') {
            echo "<div class='row'>";
            include "application/master_kompetensidasar.php";
            echo "</div>";
          } elseif ($_GET[view] == 'penilaiandiri') {
            echo "<div class='row'>";
            include "application/master_penilaiandiri.php";
            echo "</div>";
          } elseif ($_GET[view] == 'penilaianteman') {
            echo "<div class='row'>";
            include "application/master_penilaianteman.php";
            echo "</div>";
          } elseif ($_GET[view] == 'absensiswa') {
            echo "<div class='row'>";
            include "application/absensi_siswa.php";
            echo "</div>";
          } elseif ($_GET[view] == 'rekapabsensiswa') {
            echo "<div class='row'>";
            include "application/absensi_siswa_rekap.php";
            echo "</div>";
          } elseif ($_GET[view] == 'absenguru') {
            echo "<div class='row'>";
            include "application/absensi_guru.php";
            echo "</div>";
          } elseif ($_GET[view] == 'bahantugas') {
            echo "<div class='row'>";
            include "application/bahan_tugas.php";
            echo "</div>";
          } elseif ($_GET[view] == 'soal') {
            echo "<div class='row'>";
            include "application/quiz_ujian_soal.php";
            echo "</div>";
          } elseif ($_GET[view] == 'forum') {
            echo "<div class='row'>";
            include "application/forum_diskusi.php";
            echo "</div>";
          } elseif ($_GET[view] == 'penilaiandirisiswa') {
            echo "<div class='row'>";
            include "application/penilaiandiri_siswa.php";
            echo "</div>";
          } elseif ($_GET[view] == 'penilaiantemansiswa') {
            echo "<div class='row'>";
            include "application/penilaianteman_siswa.php";
            echo "</div>";
          } elseif ($_GET[view] == 'raport') {
            echo "<div class='row'>";
            include "application/raport.php";
            echo "</div>";
          } elseif ($_GET[view] == 'raportuts') {
            echo "<div class='row'>";
            include "application/raport_uts.php";
            echo "</div>";
          } elseif ($_GET[view] == 'raportcetak') {
            echo "<div class='row'>";
            include "application/raport_cetak.php";
            echo "</div>";
          } elseif ($_GET[view] == 'raportcetakuts') {
            echo "<div class='row'>";
            include "application/raport_cetak_uts.php";
            echo "</div>";
          } elseif ($_GET[view] == 'capaianhasilbelajar') {
            echo "<div class='row'>";
            include "application/raport/raport_capaian_hasil_belajar.php";
            echo "</div>";
          } elseif ($_GET[view] == 'extrakulikuler') {
            echo "<div class='row'>";
            include "application/raport/raport_extrakulikuler.php";
            echo "</div>";
          } elseif ($_GET[view] == 'prestasi') {
            echo "<div class='row'>";
            include "application/raport/raport_prestasi.php";
            echo "</div>";
          } elseif ($_GET[view] == 'bukuinduk') {
            echo "<div class='row'>";
            include "application/buku_induk.php";
            echo "</div>";
          } elseif ($_GET[view] == 'dokumentasi') {
            echo "<div class='row'>";
            include "application/dokumentasi.php";
            echo "</div>";
          } elseif ($_GET[view] == 'dokumentasiguru') {
            echo "<div class='row'>";
            include "application/dokumentasi_guru.php";
            echo "</div>";
          } elseif ($_GET[view] == 'dokumentasisiswa') {
            echo "<div class='row'>";
            include "application/dokumentasi_siswa.php";
            echo "</div>";
          } elseif ($_GET[view] == 'sms') {
            echo "<div class='row'>";
            include "application/sms/sms.php";
            echo "</div>";
          } elseif ($_GET[view] == 'broadcast') {
            echo "<div class='row'>";
            include "application/sms/broadcast.php";
            echo "</div>";
          } elseif ($_GET[view] == 'autoreply') {
            echo "<div class='row'>";
            include "application/sms/autoreply.php";
            echo "</div>";
          } elseif ($_GET[view] == 'smstoweb') {
            echo "<div class='row'>";
            include "application/sms/sms_to_web.php";
            echo "</div>";
          } elseif ($_GET[view] == 'outboxautoreply') {
            echo "<div class='row'>";
            include "application/sms/outbox_autoreply.php";
            echo "</div>";
          }
          ?>
        </section>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <?php include "footer.php"; ?>
      </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <script src="bootstrap/ekko-lightbox.min.js"></script>

    <script>
      $(function() {
        $("#example1").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false
        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        $('#example3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false,
          "pageLength": 200
        });
      });
      $('.datepicker').datepicker();
    </script>

  </body>

  </html>

<?php
}

elseif ($_GET['view'] == '' || $_GET['ekskul'] != '') {
  include 'landing_page.php';
}

elseif ($_GET['view'] == 'login') {
  include 'login.php';
}

//  else {
//   include "login.php";
// }
?>