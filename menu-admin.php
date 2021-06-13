<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $nama; ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $level; ?></a>
    </div>
  </div>

  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

<?php if($_SESSION[level] =='1'){ ?>

    <li <?php if ($_GET[view] == '') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li <?php if ($_GET[view] == 'identitas' || $_GET[view] == 'jurusan' || $_GET[view] == 'gedung' || $_GET[view] == 'ruangan' || $_GET[view] == 'ekstrakurikuler') {
          echo 'class="active treeview menu-open"';
        } else {
          echo 'class="treeview menu"';
        } ?>>

      <a href="#">
        <i class="fa fa-folder"></i> <span>Data Master</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li <?php if ($_GET[view] == 'identitas') {
              echo 'class="active"';
            } ?>><a href="index.php?view=identitas"><i class="fa fa-circle-o"></i> Identitas Sekolah</a></li>
        <li <?php if ($_GET[view] == 'jurusan') {
              echo 'class="active"';
            } ?>><a href="index.php?view=jurusan"><i class="fa fa-circle-o"></i> Data Jurusan</a></li>
        
        <li <?php if ($_GET[view] == 'gedung') {
              echo 'class="active"';
            } ?>><a href="index.php?view=gedung"><i class="fa fa-circle-o"></i> Data Gedung</a></li>

        <li <?php if ($_GET[view] == 'ruangan') {
              echo 'class="active"';
            } ?>><a href="index.php?view=ruangan"><i class="fa fa-circle-o"></i> Data Ruangan</a></li>

        <li <?php if ($_GET[view] == 'ekstrakurikuler') {
              echo 'class="active"';
            } ?>><a href="index.php?view=ekstrakurikuler"><i class="fa fa-circle-o"></i> Data Ekstrakurikuler</a></li>
      </ul>
    </li>

    <li <?php if ($_GET[view] == 'siswa' || $_GET[view] == 'pegawai') {
          echo 'class="active treeview menu-open"';
        } else {
          echo 'class="treeview menu"';
        } ?>>
      <a href="#">
        <i class="fa fa-user"></i> <span>Data Pengguna</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu">
        <li <?php if ($_GET[view] == 'siswa') {
              echo 'class="active"';
            } ?>><a href="index.php?view=siswa"><i class="fa fa-circle-o"></i> Data Siswa</a></li>

        <li <?php if ($_GET[view] == 'pegawai') {
              echo 'class="active"';
            } ?>><a href="index.php?view=pegawai"><i class="fa fa-circle-o"></i> Data Pegawai</a></li>

      </ul>
    </li>

<?php } ?>

<?php if($_SESSION[level] =='siswa'){ ?>

    <li <?php if ($_GET[view] == 'siswa' || $_GET[view] == '') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
      <a href="index.php?view=siswa"><i class="fa fa-users"></i> <span>Data Siswa</span></a>
    </li>
<?php } ?>

<?php if($_SESSION[level] =='1'){ ?>

    <li <?php if ($_GET[view] == 'kelas') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
      <a href="index.php?view=kelas"><i class="fa fa-university" aria-hidden="true"></i> <span>Data Kelas</span></a>
    </li>

<?php } ?>

    <li <?php if ($_GET[view] == 'paskibra') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
      <a href="index.php?view=paskibra"><i class="fa fa-futbol-o" aria-hidden="true"></i> <span>Data Ekstrakurikuler</span></a>
    </li>






    <li <?php if ($_GET[view] == 'jadwallomba') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
      <a href="index.php?view=jadwallomba"><i class="fa fa-calendar"></i> <span>Jadwal Perlombaan</span></a>
    </li>
    <li <?php if ($_GET[view] == 'galeri') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
    <a href="index.php?view=galeri"><i class="fa fa-image"></i> <span>Galeri Ekstrakurikuler</span></a></li>
    <li <?php if ($_GET[view] == 'penilaian') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
    <a href="index.php?view=penilaian"><i class="fa fa-edit"></i> <span>Data Penilaian</span></a></li>
  </ul>
</section>