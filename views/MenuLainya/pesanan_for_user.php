<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <?php if (!empty($pesanan)) : ?>
        <div class="row">
            <?php foreach ($pesanan as $p) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold"><?= $p['nama_lengkap']; ?></h5>
                            <p class="card-text mb-1"><strong>Alamat:</strong> <?= $p['alamat']; ?> <?= $p['detail_alamat']; ?>, <?= $p['alamat_rumah']; ?></p>
                            <p class="card-text mb-1"><strong>No. Telepon:</strong> <?= $p['no_telepon']; ?></p>
                            <p class="card-text mb-1"><strong>Status:</strong> 
                                <span class="badge badge-<?= $p['status'] == 'pending' ? 'warning' : 'success'; ?>">
                                    <?= ucfirst($p['status']); ?>
                                </span>
                            </p>
                            <!-- <p class="card-text"><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($p['tanggal'])); ?></p> -->

                            <?php if ($p['status'] == 'pending') : ?>
                                <form method="post" action="<?= base_url('Pesanan/approve/' . $p['id_checkout']); ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            <?php else : ?>
                                <button class="btn btn-secondary btn-sm" disabled>Sudah Diterima</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-info">Belum ada pesanan masuk.</div>
    <?php endif; ?>
</div>
