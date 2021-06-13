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

  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
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


    <li <?php if ($_GET[view] == 'siswa') {
          echo 'class="active treeview"';
        } else {
          echo 'class="treeview"';
        } ?>>
      <a href="index.php?view=siswa"><i class="fa fa-users" aria-hidden="true"></i> <span>Data Siswa</span></a>
    </li>

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