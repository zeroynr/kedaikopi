<!-- application/views/home/katalog/index.php -->
<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Katalog Menu</h2>
        <ol>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li>Katalog Menu</li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Search Section ======= -->
  <section id="search-section" class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card shadow">
            <div class="card-body">
              <form action="<?= base_url('katalog/search') ?>" method="GET" class="row g-3">
                <div class="col-md-1">
                  <a href="<?= base_url() ?>" class="btn btn-outline-secondary" title="Kembali ke Beranda">
                    <i class="bi bi-house-fill"></i>
                  </a>
                </div>
                <div class="col-md-7">
                  <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari menu, kategori, atau deskripsi..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                  </div>
                </div>
                <div class="col-md-4">
                  <select name="filter" class="form-select" onchange="this.form.submit()">
                    <option value="" <?= (!isset($_GET['filter']) || $_GET['filter'] == '') ? 'selected' : '' ?>>Semua Menu</option>
                    <option value="price_asc" <?= (isset($_GET['filter']) && $_GET['filter'] == 'price_asc') ? 'selected' : '' ?>>Harga Termurah</option>
                    <option value="price_desc" <?= (isset($_GET['filter']) && $_GET['filter'] == 'price_desc') ? 'selected' : '' ?>>Harga Tertinggi</option>
                    <option value="category_makanan" <?= (isset($_GET['filter']) && $_GET['filter'] == 'category_makanan') ? 'selected' : '' ?>>Kategori Makanan</option>
                    <option value="category_minuman" <?= (isset($_GET['filter']) && $_GET['filter'] == 'category_minuman') ? 'selected' : '' ?>>Kategori Minuman</option>
                  </select>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Search Section -->

  <!-- ======= Popular Menu Section ======= -->
  <?php if (!isset($_GET['keyword']) && (!isset($_GET['filter']) || $_GET['filter'] == '')): ?>
    <section id="popular-menu" class="py-4 bg-light">
      <div class="container">
        <div class="section-title text-center mb-4">
          <h2 class="popular-title"><i class="bi bi-star-fill"></i> Menu Paling Populer</h2>
        </div>
        <div class="row">
          <?php if (isset($popular_menu) && !empty($popular_menu)): ?>
            <?php foreach ($popular_menu as $pm): ?>
              <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card menu-card h-100">
                  <?php if (isset($pm['is_popular']) && $pm['is_popular']): ?>
                    <div class="popular-badge">
                      <i class="bi bi-award-fill"></i> Populer
                    </div>
                  <?php endif; ?>

                  <?php
                  $id_menu = $pm['id_menu'];
                  $getGambar = $this->db->query("SELECT * FROM gambar_menu WHERE id_menu = $id_menu LIMIT 1");
                  $gambar = "default.jpg"; // Default image if none found

                  if ($getGambar->num_rows() > 0) {
                    foreach ($getGambar->result_array() as $gambarm) {
                      if (!empty($gambarm['gambar'])) {
                        $gambar = $gambarm['gambar'];
                      }
                    }
                  }
                  ?>

                  <div class="menu-img-container">
                    <img
                      src="<?= base_url('assets/dataresto/menu/' . $gambar) ?>"
                      class="card-img-top menu-img"
                      alt="<?= $pm['nama_menu'] ?>"
                      onerror="this.src='<?= base_url('assets/dataresto/menu/default.jpg') ?>'; this.classList.add('error');"
                      loading="lazy">
                  </div>

                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title menu-title"><?= $pm['nama_menu'] ?></h5>
                    <p class="fst-italic text-center"><?= $pm['detail_menu'] ?></p>
                    <div class="menu-price mb-2">Rp <?= number_format($pm['harga'], 0, ',', '.') ?></div>
                    <div class="d-flex justify-content-between mt-auto align-items-center">
                      <span class="stock-info">Stok: <?= isset($pm['stok']) && $pm['stok'] !== 'Tidak Tersedia' ? $pm['stok'] : 'Tidak Tersedia' ?></span>
                      <div class="d-flex">
                        <a href="<?= base_url('katalog/detail/' . $pm['id_menu']) ?>" class="btn btn-sm btn-outline-secondary me-1">Detail</a>
                        <a href="<?= base_url() ?>home/pemesanan" class="btn btn-sm btn-success">
                          <i class=""></i> Pesan Sekarang
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12 text-center">
              <p>Belum ada menu populer</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <!-- End Popular Menu Section -->

  <!-- ======= All Menu Section ======= -->
  <section id="all-menu" class="py-5">
    <div class="container">
      <?php if (isset($result_count)): ?>
        <div class="row mb-3">
          <div class="col-md-12">
            <p>Ditemukan <?= $result_count ?> menu
              <?= isset($_GET['keyword']) && !empty($_GET['keyword']) ? 'dengan kata kunci "' . $_GET['keyword'] . '"' : '' ?>
              <?= isset($_GET['filter']) && !empty($_GET['filter']) ?
                ($_GET['filter'] == 'category_makanan' ? ' dalam kategori Makanan' : ($_GET['filter'] == 'category_minuman' ? ' dalam kategori Minuman' : ($_GET['filter'] == 'price_asc' ? ' urut harga terendah' : ($_GET['filter'] == 'price_desc' ? ' urut harga tertinggi' : '')))) : '' ?>
            </p>
          </div>
        </div>
      <?php else: ?>
        <div class="section-title text-center mb-4">
          <h2>Semua Menu</h2>
        </div>
      <?php endif; ?>

      <div class="row">
        <?php if (empty($menu)): ?>
          <div class="col-md-12 text-center py-5">
            <div class="no-data">
              <i class="bi bi-search"></i>
              <h4>Menu tidak ditemukan</h4>
              <p>Coba kata kunci lain atau reset pencarian</p>
              <a href="<?= base_url('katalog') ?>" class="btn btn-outline-primary">Lihat Semua Menu</a>
            </div>
          </div>
        <?php else: ?>
          <?php foreach ($menu as $m): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
              <div class="card menu-card h-100 <?= isset($m['is_popular']) && $m['is_popular'] ? 'popular' : '' ?>">
                <?php if (isset($m['is_popular']) && $m['is_popular']): ?>
                  <div class="popular-badge">
                    <i class="bi bi-award-fill"></i> Populer
                  </div>
                <?php endif; ?>

                <?php
                $id_menu = $m['id_menu'];
                $getGambar = $this->db->query("SELECT * FROM gambar_menu WHERE id_menu = $id_menu LIMIT 1");
                $gambar = "default.jpg"; // Default image if none found
                if ($getGambar->num_rows() > 0) {
                  foreach ($getGambar->result_array() as $gambarm) {
                    if (!empty($gambarm['gambar'])) {
                      $gambar = $gambarm['gambar'];
                    }
                  }
                }
                ?>

                <div class="menu-img-container">
                  <img
                    src="<?= base_url('assets/dataresto/menu/' . $gambar) ?>"
                    class="card-img-top menu-img"
                    alt="<?= $m['nama_menu'] ?>"
                    onerror="this.src='<?= base_url('assets/dataresto/menu/default.jpg') ?>'; this.classList.add('error');"
                    loading="lazy">
                </div>

                <div class="card-body d-flex flex-column">
                  <h5 class="card-title menu-title"><?= $m['nama_menu'] ?></h5>
                  <p class="fst-italic text-center"><?= $m['detail_menu'] ?></p>
                  <div class="menu-price mb-2">Rp <?= number_format($m['harga'], 0, ',', '.') ?></div>
                  <div class="d-flex justify-content-between mt-auto align-items-center">
                    <span class="stock-info">Stok: <?= isset($m['stok']) && $m['stok'] !== 'Tidak Tersedia' ? $m['stok'] : 'Tidak Tersedia' ?></span>
                    <div class="d-flex">
                      <a href="<?= base_url('katalog/detail/' . $m['id_menu']) ?>" class="btn btn-sm btn-outline-secondary me-1">Detail</a>
                      <a href="<?= base_url() ?>home/pemesanan" class="btn btn-sm btn-success">
                        <i class=""></i> Pesan Sekarang
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section><!-- End All Menu Section -->
</main><!-- End #main -->