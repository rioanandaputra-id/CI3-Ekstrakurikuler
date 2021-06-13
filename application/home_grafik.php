
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Units'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        this.point.y + ' ' + this.point.name.toLowerCase();
                }
            }
        });
    });
</script>

<div class="box box-success">
    <div class="box-header">
    <i class="fa fa-comments-o"></i>
    <h3 class="box-title">Grafik Kunjungan Siswa dan Guru</h3>
        <div class="box-tools pull-right">
           <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
        </div>

<div class="box-body chat" id="chat-box">
    <script src="plugins/highchart/highcharts.js"></script>
    <script src="plugins/highchart/modules/data.js"></script>
    <script src="plugins/highchart/modules/exporting.js"></script>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style='display:none'>
    <thead>
        <tr>
            <th></th>
            <th>Siswa</th>
            <th>Admin</th>
            <th>Pembina</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $grafik = mysqli_query($koneksi,"SELECT * FROM users_aktivitas GROUP BY tanggal ORDER BY tanggal ASC LIMIT 5");
        while ($r = mysqli_fetch_array($grafik)){
            $ale = tgl_grafik($r[tanggal]);
            $siswa = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM users_aktivitas where status='siswa' AND tanggal='$r[tanggal]'"));
            $admin = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM users_aktivitas where status='1' AND tanggal='$r[tanggal]'"));
            $pembina = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM users_aktivitas where status='3' AND tanggal='$r[tanggal]'"));
            echo "<tr>
                    <th>$ale</th>
                    <td>$siswa</td>
                    <td>$admin</td>
                    <td>$pembina</td>
                  </tr>";
        }
    ?>
    </tbody>
</table>
</div><!-- /.chat -->
</div><!-- /.box (chat box) -->

