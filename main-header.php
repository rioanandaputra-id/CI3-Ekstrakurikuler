<style type="text/css">
  .sekolah{
    float: left;
    background-color: transparent;
    background-image: none;
    padding: 15px 15px;
    font-family: fontAwesome;
    color:#fff;
  }

  .sekolah:hover{
    color:#fff;
  }
</style>
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SI-Ekskul</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $foto; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $nama; ?></span> <span class='caret'></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $nama; ?>
                      <small><?php echo $level; ?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="index.php" class="btn btn-default btn-flat">Dashboard</a>
                    </div>
                    <div class="pull-right">
                      <?php 
                        if ($_SESSION[level]!='siswa'){
                            echo "<a href='index.php?view=pegawai&act=edit&id=$_SESSION[id]' class='btn btn-default btn-flat'>Edit Profile</a>";
                        }
                        else{
                            echo "<a href='index.php?view=siswa&act=edit&id=$_SESSION[id]' class='btn btn-default btn-flat'>Edit Profile</a>";    
                        }

                      ?>
                    </div>
                  </li>
                </ul>
              </li>
              <li><a href="logout.php" >Logout</a></li>
            </ul>
          </div>
        </nav>