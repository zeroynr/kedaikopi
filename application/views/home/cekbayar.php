<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Riwayat Pembayaran</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Riwayat Pembayaran</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact-us" class="contact-us">
        <div class="container">
            <div class="col-lg-12">
                <?= $this->session->flashdata('message'); ?>
                <h3>Riwayat Pembayaran</h3>
                <p>Silahkan cek pembayaran anda dengan memasukkan kode pembayaran.</p>
                <form action="<?= base_url("pembayaran/cari") ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Kode Pembayaran" required>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <div class="d-flex">
                                <button class="btn btn-primary me-2" type="submit" value="search" name="submit"><i class="bi-search"></i> Cek</button>
                                <a href="<?= base_url() ?>" class="btn btn-secondary"><i class="bi-house"></i>Home</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- End Contact Us Section -->

    <section id="features" class="features">
        <div class="container">
            <div class="card text-center">
                <?php
                if (!empty($keyword) &&  $keyword !== "Invalid" && !empty($bbayar) && $bbayar !== "Invalid") {
                ?>
                    <div class="card-header">
                        Pesanan : <?= $keyword  ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Terima kasih telah melakukan pembayaran pesananan.</h5>
                        <?php
                        if ($bbayar == "Gambar Salah") {
                        ?>
                            <p class="card-text"><span style="font-weight: bold;color: red;">Gambar yang anda upload sebelumnya salah atau masih kurang!.</span><br> Silahkan upload ulang bukti pembayaran anda berupa screenshot gambar</p>
                        <?php
                        } else {
                        ?>
                            <p class="card-text">Silahkan upload bukti pembayaran anda berupa screenshot gambar</p>
                        <?php
                        }
                        ?>

                        <form action="<?= base_url() ?>pembayaran/uploadGambar" method="post" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <input type="hidden" name="invoice" value="<?= $keyword ?>">
                                <input type="file" class="form-control" name="bukti_pembayaran" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required accept=".jpg, .jpeg, .png">
                                <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="<?= base_url() ?>" class="btn btn-secondary"><i class="bi-house"></i> Kembali ke Home</a>
                            </div>
                        </form>
                    </div>
                <?php
                } else if (!empty($bbayar) && $bbayar  !== "Valid" && !empty($status) && $status == "Menunggu Pembayaran") {
                ?>
                    <div class="card-header">
                        Sedang dalam review.
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Anda telah mengupload bukti pembayaran. Silahkan menunggu admin untuk verifikasi bukti pembayaran anda.</h5>
                    </div>
                <?php
                } else if (!empty($status) && $status == "Sudah Bayar") {
                ?>
                    <div class="card-header">
                        Pesanan anda sudah berhasil dibayar.
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Yay! Kami sudah terima pembayaranmu. Tim dapur lagi siapin pesanan kamu dan <br> akan segera meluncur ke meja kamu.</h5>
                    </div>
                <?php
                } else if (!empty($status) && $status == "Hangus") {
                ?>
                    <div class="card-header">
                        Pesanan anda hangus.
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Anda telah melewati batas pembayaran 1x24 jam. Silahkan order kembali. Terimakasih</h5>
                    </div>
                <?php
                } else if (empty($keyword)) {
                ?>
                    <!-- Kosong, tidak ada yang ditampilkan -->
                <?php
                } else {
                ?>
                    <div class="card-header">
                        NOT FOUND
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Kode Pembayaran tidak tersedia. Sepertinya anda belum melakukan pemesanan</h5>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- End Features Section -->

</main><!-- End #main -->