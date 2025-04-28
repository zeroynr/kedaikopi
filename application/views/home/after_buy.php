<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Pemesanan Berhasil</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Pemesanan Berhasil</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Event List Section ======= -->
    <section id="event-list" class="event-list">
        <div class="container">
            <div class="row">
                <?php foreach ($home as $item) { ?>
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Terima Kasih, <?= $item['nama_pemesan'] ?> telah melakukan pemesanan di <?= $nama_usaha ?></h5>
                            <!-- The text field -->
                            <p class="card-text">
                                1. Silakan screenshot dan simpan kode di bawah ini. Kode tersebut digunakan untuk pencarian pada halaman bukti pembayaran saat Anda ingin menguploadnya.
                                <strong>Pembayaran dapat dilakukan melalui transfer ataupun secara tunai di kasir</strong> :
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" disabled class="form-control" value="<?= $item['id_detail_menu'] ?>" id="myInput">
                                </div>
                                <div class="col-lg-2">
                                    <!-- The button used to copy the text -->
                                    <button class="btn btn-primary" onclick="myFunction()">Copy Invoice</button>
                                </div>
                            </div>
                            </p>
                            <p class="card-text">2. Silahkan Untuk Melakukan Pembayaran Dengan Transfer Via : <br>
                            <ol>
                                <?php foreach ($bayar as $b) {
                                ?>
                                    <li><?= $b['nama_merchant'] ?> - <?= $b['kode_pembayaran'] ?> (<?= $b['atas_nama'] ?>)</li>
                                <?php

                                } ?>
                            </ol>
                            <strong> Dengan Total Pembayaran : <span style="color: red;"> Rp.<?= number_format($item['total_pembayaran'], 0, ',', '.') ?></span></strong>
                            </p>
                            <p class="card-text">3. Silahkan Screenshoot bukti pembayaran anda</p>
                            <p class="card-text">4. Lalu, kirimkan ke link berikut atau lewat menu diatas berikut dengan bukti pembayaran</p>
                            <p class="card-text">5. Pembatalan Transaski Akan dilakukan jika dalam 1x24 jam tidak dilakukan konfirmasi pembayaran</p>
                            <a href="<?= base_url() ?>/home" class="btn btn-primary">Kembali Ke Halaman Awal</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section><!-- End Event List Section -->

</main><!-- End #main -->

<script>
    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
</script>