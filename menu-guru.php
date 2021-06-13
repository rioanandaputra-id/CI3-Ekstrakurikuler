<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $nama; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU <?php echo $level; ?></li>
            <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="index.php?view=absensiswa&act=detailabsenguru"><i class="fa fa-th-large"></i> <span>Absensi Siswa</span></a></li>
            <li><a href="index.php?view=bahantugas&act=listbahantugasguru"><i class="fa fa-file"></i><span>Bahan dan Tugas</span></a></li>
            <li><a href="index.php?view=soal&act=detailguru"><i class="fa fa-users"></i><span>Quiz / Ujian Online</span></a></li>
            <li><a href="index.php?view=forum&act=detailguru"><i class="fa fa-th-list"></i> <span>Forum Diskusi</span></a></li>
            <li><a href="index.php?view=kompetensiguru"><i class="fa fa-tags"></i> <span>Kompetensi Dasar</span></a></li>
            <li><a href="index.php?view=journalguru"><i class="fa fa-list"></i> <span>Journal KBM</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-calendar"></i> <span>Laporan Nilai Siswa</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=raportuts&act=detailguru"><i class="fa fa-circle-o"></i> Input Nilai UTS</a></li>
                <li><a href="index.php?view=raport&act=detailguru"><i class="fa fa-circle-o"></i> Input Nilai Raport</a></li>
              </ul>
            </li>
            <li><a href="index.php?view=dokumentasiguru"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
          </ul>
        </section>