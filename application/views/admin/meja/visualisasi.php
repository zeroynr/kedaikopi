<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>meja">Manajemen Meja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Visualisasi Meja</li>
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
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Area Indoor</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($meja_indoor as $meja) : ?>
                            <div class="col-md-2 col-4 mb-3">
                                <div class="text-center">
                                    <div class="seat <?= $meja['status_tersedia'] == 1 ? 'available' : 'unavailable' ?>">
                                        <span class="seat-number"><?= $meja['nomor_meja'] ?></span>
                                        <span class="seat-capacity"><?= $meja['kapasitas_meja'] ?> org</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Area Outdoor</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($meja_outdoor as $meja) : ?>
                            <div class="col-md-2 col-4 mb-3">
                                <div class="text-center">
                                    <div class="seat <?= $meja['status_tersedia'] == 1 ? 'available' : 'unavailable' ?>">
                                        <span class="seat-number"><?= $meja['nomor_meja'] ?></span>
                                        <span class="seat-capacity"><?= $meja['kapasitas_meja'] ?> org</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .seat {
        width: 100%;
        aspect-ratio: 1/1;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .available {
        background-color: #2ecc71;
        /* Hijau untuk meja tersedia */
        box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
    }

    .unavailable {
        background-color: #e74c3c;
        /* Merah untuk meja tidak tersedia */
        box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
    }

    .seat-number {
        font-size: 1.5rem;
    }

    .seat-capacity {
        font-size: 0.9rem;
        opacity: 0.9;
    }
</style>