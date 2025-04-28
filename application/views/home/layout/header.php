<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $nama_usaha ?></title>
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/auth/images/coba3.png">

  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Favicons -->
  <link href="<?= base_url() ?>assets/home/home/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>assets/home/home/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>assets/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/home/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/home/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/home/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/home/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/home/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="<?= base_url() ?>assets/admin/vendor/jquery/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>assets/home/css/style.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/home/css/custom.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>assets/home/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/home/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?= base_url() ?>"><?= $nama_usaha ?></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="<?= ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a></li>
          <li><a class="<?= ($this->uri->segment(1) == 'katalog') ? 'active' : '' ?>" href="<?= base_url() ?>katalog">Katalog Menu</a></li>
          <li><a class="<?= ($this->uri->segment(2) == 'pemesanan') ? 'active' : '' ?>" href="<?= base_url() ?>home/pemesanan">Pemesanan</a></li>
          <li><a class="<?= ($this->uri->segment(1) == 'pembayaran') ? 'active' : '' ?>" href="<?= base_url() ?>pembayaran/cari">Cek Pembayaran</a></li>
          <li><a class="<?= ($this->uri->segment(1) == 'saran') ? 'active' : '' ?>" href="<?= base_url() ?>saran/add">Kritik & Saran</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php
      $CI = &get_instance();
      $CI->load->model('Profilusaha_model');
      $notifikasi_data = $CI->Profilusaha_model->getProfilUsaha();

      // Perbaikan pengecekan halaman home - lebih spesifik
      $current_segment = $CI->uri->segment(1);
      $second_segment = $CI->uri->segment(2);

      // Hanya tampilkan di halaman home (URL: "/" atau "/home" saja, bukan "/home/pemesanan")
      // Hanya tampilkan di halaman home (URL: "/" atau "/home" saja, bukan "/home/pemesanan")
      $is_homepage = ($current_segment == '' || ($current_segment == 'home' && $second_segment == ''));

      // Tambahkan pengecekan debug
      if ($is_homepage) {
        echo "<!-- Debug: Halaman home terdeteksi -->";

        foreach ($notifikasi_data as $notify) {
          if ($notify['notifikasi_aktif'] == 1 && !empty($notify['pesan_notifikasi'])) {
            $last_updated = $notify['last_updated'] ? $notify['last_updated'] : time();
      ?>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                // Cek apakah notifikasi sudah ditampilkan dalam sesi ini
                var notifShown = sessionStorage.getItem('notifShown');
                var lastNotifTime = parseInt(localStorage.getItem('lastNotifTime') || '0');
                var currentNotifTime = <?= $last_updated ?>;

                console.log("Debug - notifShown:", notifShown);
                console.log("Debug - lastNotifTime:", lastNotifTime);
                console.log("Debug - currentNotifTime:", currentNotifTime);

                // Tampilkan notifikasi jika belum pernah ditampilkan atau ada pembaruan wajib (force refresh)
                if (!notifShown || lastNotifTime < currentNotifTime) {
                  Swal.fire({
                    title: '<?= htmlspecialchars($notify['nama_usaha'], ENT_QUOTES) ?>',
                    text: '<?= htmlspecialchars($notify['pesan_notifikasi'], ENT_QUOTES) ?>',
                    icon: 'info',
                    confirmButtonText: 'OK'
                  }).then(function() {
                    // Setelah user menekan OK, simpan status bahwa notifikasi sudah ditampilkan
                    sessionStorage.setItem('notifShown', 'true'); // Gunakan sessionStorage bukan localStorage
                    localStorage.setItem('lastNotifTime', currentNotifTime);
                  });
                }
              });
            </script>
      <?php
          }
        }
      }
      ?>
    </div>
  </header><!-- End Header -->
</body>