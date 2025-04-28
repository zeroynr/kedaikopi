<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengaturan Notifikasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Pengaturan Notifikasi Website</h3>
                </div>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div id="status-message"></div>
                    <?php foreach ($profil_usaha as $ps) { ?>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <strong>Informasi:</strong> Fitur ini memungkinkan Anda untuk menampilkan notifikasi popup kepada pengunjung <strong>hanya saat mereka mengakses halaman utama (home)</strong> website. Notifikasi akan muncul sekali per sesi kunjungan.
                            </div>

                            <form action="<?= base_url() ?>profilusaha/toggleNotifikasi" method="POST">
                                <div class="form-group">
                                    <label class="font-weight-bold mb-3">Status Notifikasi:</label>
                                    <div class="custom-control custom-switch ml-2">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status" value="1" <?= ($ps['notifikasi_aktif'] == 1) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="customSwitch1">
                                            <span id="statusText"><?= ($ps['notifikasi_aktif'] == 1) ? 'Aktif' : 'Nonaktif' ?></span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted mt-2">Pilih aktif untuk menampilkan notifikasi saat pengunjung masuk ke halaman utama website.</small>
                                    <button type="submit" class="btn btn-primary mt-3">
                                        <i class="fas fa-save mr-2"></i>Simpan Status
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <form action="<?= base_url() ?>profilusaha/updateNotifikasi" method="POST">
                                <div class="form-group">
                                    <label class="font-weight-bold mb-3">Pesan Notifikasi:</label>
                                    <textarea class="form-control" name="pesan_notifikasi" rows="5" placeholder="Masukkan pesan notifikasi yang akan ditampilkan kepada pengunjung"><?= $ps['pesan_notifikasi'] ?></textarea>
                                    <small class="form-text text-muted mt-2">Masukkan pesan yang akan ditampilkan sebagai notifikasi popup pada halaman utama.</small>
                                    <div class="d-flex mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-2"></i>Simpan Pesan
                                        </button>
                                        <button type="button" id="force_refresh" class="btn btn-warning ml-2">
                                            <i class="fas fa-sync mr-2"></i>Paksa Semua Pengunjung Melihat Notifikasi
                                        </button>
                                    </div>
                                    <small class="form-text text-muted mt-2">Gunakan tombol "Paksa" jika perubahan tidak langsung terlihat oleh pengunjung yang sudah pernah melihat notifikasi sebelumnya.</small>
                                </div>
                            </form>

                            <div class="mt-4">
                                <h5 class="mb-3">Pratinjau Notifikasi</h5>
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $ps['nama_usaha'] ?></h5>
                                        <p class="card-text"><?= !empty($ps['pesan_notifikasi']) ? $ps['pesan_notifikasi'] : 'Tidak ada pesan' ?></p>
                                        <button class="btn btn-sm btn-secondary" disabled>OK</button>
                                    </div>
                                </div>
                                <small class="text-muted">*Tampilan pratinjau notifikasi yang akan muncul pada halaman utama</small>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update label text ketika switch berubah
        const switchElement = document.getElementById('customSwitch1');
        const statusText = document.getElementById('statusText');

        if (switchElement) {
            switchElement.addEventListener('change', function() {
                statusText.textContent = this.checked ? 'Aktif' : 'Nonaktif';
            });
        }

        // Tambahkan event listener untuk tombol force refresh
        const forceRefreshBtn = document.getElementById('force_refresh');
        if (forceRefreshBtn) {
            forceRefreshBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Konfirmasi tindakan
                if (confirm('Yakin ingin memaksa semua pengunjung melihat notifikasi terbaru?')) {
                    // Kirim permintaan AJAX
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?= base_url() ?>profilusaha/forceRefreshNotifikasi', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.status === 'success') {
                                // Tampilkan pesan berhasil
                                const messageDiv = document.getElementById('status-message');
                                messageDiv.innerHTML = '<div class="alert alert-success" role="alert">Berhasil! Semua pengunjung akan melihat notifikasi terbaru.</div>';

                                // Hilangkan pesan setelah 3 detik
                                setTimeout(function() {
                                    messageDiv.innerHTML = '';
                                }, 3000);
                            }
                        }
                    };
                    xhr.send();
                }
            });
        }
    });
</script>