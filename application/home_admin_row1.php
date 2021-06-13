            <a style='color:#000' href='index.php?view=siswa'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                <?php $siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as total FROM tbl_siswa")); ?>
                  <span class="info-box-text">Siswa</span>
                  <span class="info-box-number"><?php echo $siswa[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='index.php?view=pegawai'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                <?php $guru = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as total FROM tbl_pegawai")); ?>
                  <span class="info-box-text">Pegawai</span>
                  <span class="info-box-number"><?php echo $guru[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='index.php?view=ekstrakurikuler'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-futbol-o"></i></span>
                <div class="info-box-content">
                <?php $upload = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as total FROM tbl_ekskul")); ?>
                  <span class="info-box-text">Ekstrakulikuler</span>
                  <span class="info-box-number"><?php echo $upload[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='index.php?view=kelas'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-university"></i></span>
                <div class="info-box-content">
                <?php $forum = mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(*) as total FROM tbl_kelas")); ?>
                  <span class="info-box-text">Kelas</span>
                  <span class="info-box-number"><?php echo $forum[total]; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>