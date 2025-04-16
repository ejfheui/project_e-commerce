<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Card 2 (Filter dan Search) -->
        <div class="col-md-6">
            <div class="card shadow mb-4 p-3" style="border-radius: 20px; background-color: #ffffff; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body text-white">
                    <div class="row">
                        <!-- Input Pencarian -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchProduk" class="form-control" placeholder="Cari produk...">
                                <div class="input-group-prepend mt-2">
                                </div>
                            </div>
                        </div>

                        <!-- Dropdown Filter Kategori -->
                        <div class="col-md-6">
                            <select id="filterKategori" class="custom-select form-control">
                                <option value="">Semua Kategori</option>
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat['id_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk card - Kelola Produk -->
    <div class="row mt-3" id="produkContainer">
        <?php foreach ($produk as $row) : ?>
            <div class="col-md-3 mb-4 produk-item" data-kategori="<?= $row['id_kategori']; ?>" data-nama="<?= strtolower($row['nama_produk']); ?>">
                <div class="card h-100 shadow" style="border-radius: 30px;">
                    <!-- Gambar Produk -->
                    <?php if ($row['foto']) : ?>
                        <img src="<?= base_url('assets/img/gambarProduk/' . $row['foto']); ?>" class="card-img-top" alt="<?= $row['nama_produk']; ?>" style="height: 250px; object-fit: cover; border-radius: 30px;">
                    <?php else : ?>
                        <img src="<?= base_url('assets/img/no-image.png'); ?>" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>

                    <!-- Body Card -->
                    <div class="card-body">
                        <h5 class="card-title m-0 font-weight-bold text-secondary"><?= $row['nama_produk']; ?></h5>
                        <p class="card-text m-0 font-weight-bold text-kategori mt-3"><?= $row['nama_kategori']; ?></p>
                        <p class="card-text text-muted mt-2">Stok: <?= $row['stok']; ?></p>
                        <p class="card-text">
                            <span class="badge badge-primary badge-custom">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<style>

.custom-carousel-image {
    width: 100%; 
    height: 500px; 
    object-fit: cover; 
}

.carousel-inner {
    overflow: hidden;
}

.badge-custom {
    background-color: rgba(0, 123, 255, 0.2); 
    color: #007bff; 
    font-size: 0.9rem; 
    padding: 0.5rem 0.5rem; 
    border-radius: 1.0rem; 
}

/* Efect Hover pada card */

.produk-item .card {
    border-radius: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.produk-item .card:hover {
    transform: scale(1.05);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}

.produk-item .card img {
    height: 250px;
    object-fit: cover;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    transition: opacity 0.3s ease;
}

.produk-item .card:hover img {
    opacity: 0.9;
}

.input-group-text {
    background-color: #43b449; /* Warna background input-group */
    border-right: 0; /* Hilangkan border di sebelah kanan */
}

.input-group .form-control {
    border-right: 0; /* Hilangkan border di sebelah kiri input */
}


</style>

<script>
    // Filter Produk berdasarkan kategori
    document.getElementById("filterKategori").addEventListener("change", function () {
        let selectedKategori = this.value;
        let produkItems = document.querySelectorAll(".produk-item");

        produkItems.forEach(item => {
            if (selectedKategori === "" || item.getAttribute("data-kategori") === selectedKategori) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });

    document.getElementById("searchProduk").addEventListener("input", function() {
        let keyword = this.value.toLowerCase();
        let produkItems = document.querySelectorAll(".produk-item");

        produkItems.forEach(item => {
            let namaProduk = item.getAttribute("data-nama");
            if (namaProduk.includes(keyword)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });
</script>
