<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Pemasukan Bulan Ini</h5>
                <span class="h2 font-weight-bold mb-0">Rp. <?= number_format($total_pendapatan_bulan_ini->total_pendapatan_bulan_ini, 0, ',', '.') ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                  <i class="fas fa-money-bill"></i>
                </div>
              </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">

            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Pemasukan Hari Ini</h5>
                <span class="h2 font-weight-bold mb-0">Rp. <?= number_format($total_pendapatan->total_pendapatan, 0, ',', '.')  ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                  <i class="fas fa-money-bill"></i>
                </div>
              </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">

            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Transaksi Hari Ini</h5>
                <span class="h2 font-weight-bold mb-0"><?= $total_transaksi->total_transaksi ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                  <i class="fas fa-handshake"></i>
                </div>
              </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">

            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Transaksi Bulan Ini</h5>
                <span class="h2 font-weight-bold mb-0"><?= $total_transaksi_bulan_ini->total_transaksi_bulan_ini ?></span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                  <i class="fas fa-handshake"></i>
                </div>
              </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">

            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- Grafik Penjualan Bulanan -->
<div class="container-fluid mt-2">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header border-0">
          <div id="chart-area" style="width:100%; height:400px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Grafik Penjualan Makanan Populer di atas -->
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-0">
          <h3 class="mb-0">Penjualan Makanan Populer</h3>
          <small class="text-muted">Menampilkan makanan dengan minimal 5 pesanan</small>
          <div id="chart-food-sales" style="width:100%; height:400px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Catatan Pesanan Jarang di bawah grafik -->
<div class="container-fluid mt-4 mb-5">
  <div class="row">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header bg-warning text-white">
          <h3 class="mb-0"><i class="fas fa-exclamation-triangle mr-2"></i>Catatan Pesanan Jarang</h3>
          <small class="text-white">Menu dengan kurang dari 5 pesanan (termasuk 0 pesanan)</small>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 class="mb-3">Menu yang Jarang Dipesan:</h4>
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Nama Menu</th>
                      <th class="text-center">Jumlah Pesanan</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($rarely_ordered_items)): ?>
                      <tr>
                        <td colspan="3" class="text-center">Tidak ada data</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($rarely_ordered_items as $item): ?>
                        <tr>
                          <td><?= $item->nama_makanan ?></td>
                          <td class="text-center"><?= $item->total_terjual ?></td>
                          <td class="text-center">
                            <?php if ($item->total_terjual == 0): ?>
                              <span class="badge badge-danger">Belum pernah dipesan</span>
                            <?php elseif ($item->total_terjual < 3): ?>
                              <span class="badge badge-warning">Sangat jarang</span>
                            <?php else: ?>
                              <span class="badge badge-info">Jarang</span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card bg-light">
                <div class="card-body">
                  <h4 class="card-title"><i class="fas fa-lightbulb text-warning mr-2"></i>Rekomendasi</h4>
                  <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item bg-light border-0"><i class="fas fa-check-circle text-success mr-2"></i>Promosikan menu yang jarang dipesan</li>
                    <li class="list-group-item bg-light border-0"><i class="fas fa-check-circle text-success mr-2"></i>Pertimbangkan diskon khusus</li>
                    <li class="list-group-item bg-light border-0"><i class="fas fa-check-circle text-success mr-2"></i>Evaluasi kembali harga atau penyajian</li>
                    <li class="list-group-item bg-light border-0"><i class="fas fa-check-circle text-success mr-2"></i>Pertimbangkan untuk mengganti menu yang tidak pernah dipesan</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-light">
          <p class="text-muted mb-0">
            <i class="fas fa-info-circle mr-1"></i> Data menu diambil dari tabel menu dan direlasikan dengan data pesanan aktual. Menu yang tidak muncul di tabel pesanan dihitung sebagai 0 pesanan.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // Add this to your existing script section below the first chart
  document.addEventListener('DOMContentLoaded', function() {
    // First chart code remains unchanged

    // Add food sales chart
    Highcharts.chart('chart-food-sales', {
      chart: {
        type: 'bar'
      },
      title: {
        text: 'Menu Makanan Terpopuler'
      },
      subtitle: {
        text: 'Berdasarkan Jumlah Pesanan'
      },
      xAxis: {
        categories: [
          <?php foreach ($popular_menu_items as $item): ?> '<?= $item->nama_makanan ?>',
          <?php endforeach; ?>
        ],
        title: {
          text: 'Menu Makanan'
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Jumlah Terjual',
          align: 'high'
        },
        labels: {
          overflow: 'justify'
        }
      },
      tooltip: {
        valueSuffix: ' pesanan'
      },
      plotOptions: {
        bar: {
          dataLabels: {
            enabled: true
          },
          colorByPoint: true
        }
      },
      legend: {
        enabled: false
      },
      credits: {
        enabled: false
      },
      series: [{
        name: 'Terjual',
        data: [
          <?php foreach ($popular_menu_items as $item): ?>
            <?= $item->total_terjual ?>,
          <?php endforeach; ?>
        ]
      }]
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    Highcharts.chart('chart-area', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Pendapatan Bulanan '
      },
      subtitle: {
        text: 'Tahun <?= date('Y') ?>'
      },
      xAxis: {
        categories: [
          'Jan',
          'Feb',
          'Mar',
          'Apr',
          'May',
          'Jun',
          'Jul',
          'Aug',
          'Sep',
          'Oct',
          'Nov',
          'Dec'
        ],
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Pendapatan Bulanan'
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      colors: ['#1CC88A'],
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [{
        name: 'Pendapatan',
        data: [<?= $month['januari']->total_harga ?>, <?= $month['februari']->total_harga ?>, <?= $month['maret']->total_harga ?>, <?= $month['april']->total_harga ?>, <?= $month['mei']->total_harga ?>, <?= $month['juni']->total_harga ?>, <?= $month['juli']->total_harga ?>, <?= $month['agustus']->total_harga ?>, <?= $month['september']->total_harga ?>, <?= $month['oktober']->total_harga ?>, <?= $month['november']->total_harga ?>, <?= $month['desember']->total_harga ?>]
      }]
    });
  });
</script>