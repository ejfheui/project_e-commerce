<div class="container">

<!-- allert -->
<?= $this->session->flashdata('message'); ?>

        <!-- DataTales Example -->
        <div class="card1 shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between custom-card-header">
                    <h6 class="m-0 font-weight-bold text-dark badge badge-subJudul">
                        <i class="fas fa-box mr-2 ml-3"></i><i class="fas fa-plus mr-2"></i>Tambah produk baru 
                    </h6>
                </div>
                <div class="card-body">

                   <!-- Card Filter & Search Data -->
                    <div class="card1 shadow-sm silver-3d" style="border-radius: 20px;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between" style="height: 70px;">
                            
                            <!-- Filter Kategori -->
                            <div class="form-group m-2 w-50 position-relative">
                                <label for="filterKategori" class="sr-only">Filter Kategori:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-0" style="border-radius: 10px 0 0 10px;">
                                            <i class="fas fa-filter"></i>
                                        </span>
                                    </div>
                                    <select id="filterKategori" class="form-control custom-select">
                                        <option value="all">Semua Kategori</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Pencarian Produk dengan Icon Search -->
                            <div class="form-group m-2 w-50 position-relative">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-0" style="border-radius: 10px 0 0 10px;">
                                            <i class="fas fa-search"></i> 
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="searchProduk" onkeyup="filterProduk()" placeholder="Cari produk..." style="border-radius: 0 10px 10px 0;">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Tombol Tambah Produk -->
                    <button class="btn custom-addbutton mb-4 mt-3" data-toggle="modal" data-target="#addProdukModal"><i class="fas fa-plus mr-2"></i>Tambah Produk</button>

                  <!-- produk card -->
                    <div class="row">
                        <?php if (empty($produk)) : ?>
                            <div id="noProduk" class="col-12 text-center">
                                <img src="<?= base_url('assets/img/no-data.png'); ?>" alt="No Data" style="width: 200px;" class="mb-3">
                                <p class="text-muted">Maaf, data produk belum tersedia.</p>
                            </div>
                        <?php else : ?>
                            <?php foreach ($produk as $p) : ?>
                                <div class="col-6 col-md-3 mb-3 produk-card" data-kategori="<?= $p['id_kategori']; ?>" data-nama="<?= strtolower($p['nama_produk']); ?>">
                                    <div class="card shadow-sm h-100" style="border-radius: 25px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
                                        <img src="<?= base_url('assets/img/gambarProduk/') . $p['foto']; ?>" 
                                            class="card-img-top" 
                                            alt="Produk" 
                                            style="height: 240px; object-fit: cover; border-top-left-radius: 25px; border-top-right-radius: 25px;">
                                        <div class="card-body p-2">
                                            <h6 class="card-title m-0 font-weight-bold text-secondary mb-2"><?= $p['nama_produk']; ?></h6>
                                            <p class="small text-muted mb-1"><?= substr($p['deskripsi'], 0, 20); ?>...</p>
                                            <span class="badge small text-muted mb-1" 
                                                style="background-color: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745;">
                                                Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                                            </span>
                                            <p class="small text-muted mb-1">Total Stok: <?= $p['total_stok']; ?></p>
                                            <p class="small text-muted">Kategori 
                                                <span class="badge" 
                                                    style="background-color: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid #ffc107;">
                                                    <?= $p['nama_kategori']; ?>
                                                </span>
                                            </p>
                                            <p class="small text-muted mb-1">
                                                Varian:
                                                <?php foreach ($p['varian'] as $v) : ?>
                                                    <?php if (!empty($v['varian_tambahan'])) : ?>
                                                        <span class="badge badge-secondary mr-1 mb-1"><?= $v['varian_tambahan']; ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </p>
                                            <p class="small text-muted mb-2 ml-4">
                                                <?php foreach ($p['varian'] as $v) : ?>
                                                    <?php if (!empty($v['nama_varian'])) : ?>
                                                        <span class="badge badge-primary mr-1 mb-1"><?= $v['nama_varian']; ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn custom-buttondeletecard btn-sm w-100" 
                                                        data-toggle="modal" data-target="#modalDelete" 
                                                        onclick="setDeleteId(<?= $p['id_kelola']; ?>)">
                                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                </button>
                                                <button class="btn custom-buttoneditcard ml-2 btn-sm w-100" 
                                                        data-toggle="modal" data-target="#editProdukModal<?= $p['id_kelola']; ?>">
                                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                <!-- Modals Penambahan Produk -->
                <div class="modal fade" id="addProdukModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <div class="modal-header">
                                <div class="modal-title m-0 font-weight-bold text-dark"><i class="fas fa-plus mr-3" style="color: #395e93;"></i>Tambah Produk Baru</div>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('KelolaProduk/add'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Nama Produk</label>
                                                <input type="text" name="nama_produk" class="form-control mt-2" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Label Harga Produk</label>
                                                <input type="number" name="harga" class="form-control mt-2" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control mt-2" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Kategori</label>
                                                <select name="id_kategori" class="form-control custom-select mt-2">
                                                    <?php foreach ($kategori as $k) : ?>
                                                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- form foto -->
                                   
                                    <div class="form-group">
                                        <label class="m-0 font-weight-bold text-secondary">Foto Produk</label>
                                        <input type="file" name="foto" class="form-control mt-2" required>
                                    </div>

                                    <!-- Tombol Tambah -->
                                    <div class="d-flex mb-3 mt-2">
                                        <button type="button" class="btn custom-add mb-3" id="add-varian-tambahan-row">
                                            <i class="fas fa-plus mr-2"></i>Tambah varian
                                        </button>
                                        <button type="button" class="btn custom-add ml-3" id="add-varian">
                                            <i class="fas fa-plus mr-2"></i>Varian Tambahan
                                        </button>
                                    </div>

                                   <!-- Form Varian Tambahan (ADD) -->
                                    <div class="form-group mt-3">
                                        <label class="m-0 font-weight-bold text-secondary mb-2">Varian Tambahan</label>
                                        <div id="form-varian-tambahan-container">
                                            <div class="input-group mb-2">
                                                <input type="text" name="varian_tambahan[]" class="form-control" placeholder="Varian Warna, dll.">
                                                <input type="number" name="stok_warna_varian[]" class="form-control ml-2" placeholder="Stok varian">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Form Utama Varian -->
                                    <div class="form-group">
                                        <label class="m-0 font-weight-bold text-secondary mb-2">Varian Tambahan</label>
                                        <div id="varian-container">
                                            <div class="input-group mb-2">
                                                <input type="text" name="varian[]" class="form-control" placeholder="Warna, Ukuran, dll.">
                                                <input type="number" name="stok_varian[]" class="form-control ml-2" placeholder="Stok yang dibutuhkan">
                                                <input type="text" name="harga_varian[]" class="form-control ml-2" placeholder="Harga varian">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn custom-submit mt-3 mr-2"><i class="fas fa-check-circle mr-3"></i>Tambah Produk</button>
                                    <button type="button" class="btn custom-close mt-3" data-dismiss="modal">Tutup</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- modals edit data -->
                <?php foreach ($produk as $p) : ?>
                    <div class="modal fade" id="editProdukModal<?= $p['id_kelola']; ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                            <div class="modal-content" style="border: none; box-shadow: none;">
                                <div class="modal-header">
                                    <div class="modal-title m-0 font-weight-bold text-dark">
                                        <i class="fas fa-pencil-alt mr-3 text-warning"></i>Edit Produk
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('KelolaProduk/edit/' . $p['id_kelola']); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_kelola" value="<?= $p['id_kelola']; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-0 font-weight-bold text-secondary">Nama Produk</label>
                                                    <input type="text" name="nama_produk" class="form-control mt-2" value="<?= $p['nama_produk']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-0 font-weight-bold text-secondary">Label harga Produk</label>
                                                    <input type="number" name="harga" class="form-control mt-2" value="<?= $p['harga']; ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-0 font-weight-bold text-secondary">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control mt-2" required><?= $p['deskripsi']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-0 font-weight-bold text-secondary">Kategori</label>
                                                    <select name="id_kategori" class="form-control custom-select mt-2">
                                                        <?php foreach ($kategori as $k) : ?>
                                                            <option value="<?= $k['id_kategori']; ?>" <?= ($k['id_kategori'] == $p['id_kategori']) ? 'selected' : ''; ?>><?= $k['nama_kategori']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <!-- foto produk -->
                                        <div class="form-group">
                                            <label class="m-0 font-weight-bold text-secondary">Foto Produk</label>
                                            <input type="hidden" name="foto" value="<?= $p['foto']; ?>">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto</small>
                                        </div>

                                       <!-- Tombol Tambah -->
                                        <div class="d-flex mb-3 mt-2">
                                            <button type="button" class="btn custom-add mb-3 btn-add-varian-tambahan" data-id="<?= $p['id_kelola']; ?>">
                                                <i class="fas fa-plus mr-2"></i>Tambah Varian Tambahan
                                            </button>
                                            <button type="button" class="btn custom-add ml-3 btn-add-varian" data-id="<?= $p['id_kelola']; ?>">
                                                <i class="fas fa-plus mr-2"></i>Tambah Varian
                                            </button>
                                        </div>

                                        <!-- Form Varian Tambahan -->
                                        <div class="form-group mt-3">
                                            <label class="m-0 font-weight-bold text-secondary mb-2">Varian Tambahan</label>
                                            <div id="form-varian-tambahan-container-<?= $p['id_kelola']; ?>">
                                                <?php foreach ($p['varian'] as $v) : ?>
                                                    <?php if (!empty($v['varian_tambahan'])) : ?>
                                                        <div class="input-group mb-2">
                                                            <input type="text" name="varian_tambahan[]" class="form-control" value="<?= $v['varian_tambahan']; ?>" placeholder="Varian Warna, dll.">
                                                            <input type="number" name="stok_warna_varian[]" class="form-control ml-2" value="<?= $v['stok_warna_varian']; ?>" placeholder="Stok varian">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Form Utama Varian -->
                                        <div class="form-group">
                                            <label class="m-0 font-weight-bold text-secondary mb-2">Varian</label>
                                            <div id="varian-container-<?= $p['id_kelola']; ?>">
                                                <?php foreach ($p['varian'] as $v) : ?>
                                                    <?php if (!empty($v['nama_varian'])) : ?>
                                                        <div class="input-group mb-2">
                                                            <input type="text" name="varian[]" class="form-control" value="<?= $v['nama_varian']; ?>" placeholder="Warna, Ukuran, dll.">
                                                            <input type="number" name="stok_varian[]" class="form-control ml-2" value="<?= $v['stok_varian']; ?>" placeholder="Stok yang dibutuhkan">
                                                            <input type="text" name="harga_varian[]" class="form-control ml-2" value="<?= $v['harga_varian']; ?>" placeholder="Harga varian">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn custom-submit mt-3 mr-2">
                                            <i class="fas fa-check-circle mr-3"></i>Simpan Perubahan
                                        </button>
                                        <button type="button" class="btn custom-close mt-3" data-dismiss="modal">Tutup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

               <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <div class="modal-header">
                                <div class="modal-title m-0 font-weight-bold text-dark" id="modalDeleteLabel"><i class="fas fa-trash-alt mr-3 text-danger"></i>Konfirmasi Hapus</div>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="m-0 font-weight-bold text-secondary">Apakah Anda yakin ingin menghapus produk ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn custom-close mr-2" data-dismiss="modal">Batal</button>
                                <a id="btnDeleteConfirm" class="btn custom-buttondeletecard"><i class="fas fa-trash-alt mr-3"></i>Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>


<!-- loading screen -->
<div id="loadingScreen" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #ffffff;z-index: 9999;display: none;align-items: center;justify-content: center;transition: opacity 0.3s ease;">
    <span style="color: #555555; font-size: 20px;">Silahkan tunggu...</span>
</div>




<!--  Css / style Templates -->

<style>

/* Custom Tables */
.thead-custom {
    background: linear-gradient(to bottom, #ffffff, #e9e9e9); 
    border-bottom: 2px solid #d6d6d6; 
    color: #555; 
    text-shadow: 0 1px 0 #fff;
}

.thead-custom .th {
    padding: 10px; 
    text-align: center; 
}

.table-hover tbody tr:hover {
    transform: scale(1.02); 
    transition: transform 0.2s ease-in-out; 
    background-color: #f9f9f9; 
}

    
/* Custom Card Tables*/
.custom-card {
    border: none; 
    border-radius: var(--card-border-radius, 25px); 
    overflow: hidden; 
    background-color: #fff; 
}

/* Card header styling */
.custom-card-header {
    background-color: #ffffff; 
    border-bottom: 1px solid #e0e0e0; Optional: subtle border below header
    padding: 1rem;
    color: #4e4e4e; 
    font-weight: bold;
    border: none; 
}

:root {
    --card-border-radius: 25px; 
}

.badge-subJudul {
    background-color: rgba(255, 193, 7, 0.2); 
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem; 
}


/* Button Style */

.custom-edit {
    align-items: center;
    appearance: none;
    background-color: #fff;
    border-radius: 30px;
    border-style: none;
    box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 5px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
    box-sizing: border-box;
    color: #c6a724;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 30px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-delete{
    align-items: center;
    appearance: none;
    background-color: #fff;
    border-radius: 30px;
    border-style: none;
    box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 5px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
    box-sizing: border-box;
    color: #cb3605;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 30px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-add {
    align-items: center;
    appearance: none;
    background-color: #fff;
    border-radius: 15px;
    border-style: none;
    box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 5px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
    box-sizing: border-box;
    color: #416ea4;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 35px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-close {
    align-items: center;
    appearance: none;
    background-color: #60656b;
    border-radius: 15px;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 40px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-addbutton {
    align-items: center;
    appearance: none;
    background-color: #395e93;
    border-radius: 15px;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 40px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-buttondeletecard {
    align-items: center;
    appearance: none;
    background-color:rgb(203, 12, 5);
    border-radius: 15px;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 35px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-buttoneditcard {
    align-items: center;
    appearance: none;
    background-color: #c6a724;
    border-radius: 15px;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 35px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

.custom-submit {
    align-items: center;
    appearance: none;
    background-color: #395e93;
    border-radius: 15px;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-flex;
    fill: currentcolor;
    font-family: "Google Sans", Roboto, Arial, sans-serif;
    font-size: 14px;
    font-weight: 500;
    height: 40px;
    justify-content: center;
    letter-spacing: .25px;
    line-height: normal;
    max-width: 100%;
    overflow: visible;
    padding: 3px 15px;
    position: relative;
    text-align: center;
    text-transform: none;
    transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: auto;
    will-change: transform, opacity;
    z-index: 0;
}

/* Data Tables Style - Element*/

/* General styling for the sorting arrows */
.table.dataTable>thead .sorting:before,
.table.dataTable>thead .sorting_asc:before, 
.table.dataTable>thead .sorting_desc:before, 
.table.dataTable>thead .sorting_asc_disabled:before, 
.table.dataTable>thead .sorting_desc_disabled:before {
    right: 1em;
}

/* Ascending arrow */
.table.dataTable>thead .sorting_asc:before {
    content: "↑";
    color: #4120d3; /* Customize the color of the ascending arrow */
    font-weight: bold; /* Make the arrow bold */
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #555555;
    border-color: #555555;
}

.page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #6b01e0;
    background-color: #fff;
    border: 1px solid #dddfeb;
}
a {
    color: #6b01e0;
    text-decoration: none;
    background-color: transparent;
}

/* Text Style */

.text-icon {
    color: #397a93; 
}

.text-is_active {
    color: #938b39; 
}

.text-link {
    color: #57598e; 
}

/* style card for filter and search */

.silver-3d {
    background: linear-gradient(145deg, #f0f0f0, #d6d6d6); /* Efek gradient silver */
    border: 1px solid #b8b8b8;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2), 
                -4px -4px 10px rgba(255, 255, 255, 0.5); /* Efek timbul */
    transition: all 0.3s ease-in-out;
}

.silver-3d:hover {
    box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.3), 
                -6px -6px 12px rgba(255, 255, 255, 0.6); /* Efek hover lebih kuat */
}

.input-group-text {
    background: linear-gradient(145deg, #e0e0e0, #c4c4c4);
    border: 1px solid #b8b8b8;
}

/* hover card */

.card:hover {
    transform: scale(1.03);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

/* loading screen */

body.loading {
    overflow: hidden;
}

</style>

<script>
function setDeleteId(id) {
    document.getElementById('btnDeleteConfirm').href = "<?= base_url('KelolaProduk/delete/'); ?>" + id;
}

function filterProduk() {
    var kategoriId = document.getElementById("filterKategori").value.toLowerCase();
    var searchKeyword = document.getElementById("searchProduk").value.toLowerCase();
    var cards = document.querySelectorAll(".produk-card");

    cards.forEach(function(card) {
        var kategoriProduk = card.getAttribute("data-kategori").toLowerCase();
        var namaProduk = card.getAttribute("data-nama").toLowerCase();

        var kategoriMatch = (kategoriId === "" || kategoriProduk === kategoriId);
        var namaMatch = (searchKeyword === "" || namaProduk.includes(searchKeyword));

        if (kategoriMatch && namaMatch) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

$(document).ready(function () {
    $("#add-varian").click(function () {
        $("#varian-container").append(`
            <div class="input-group mb-2">
                <input type="text" name="varian[]" class="form-control" placeholder="Warna, Ukuran, dll." required>
                <input type="number" name="stok_varian[]" class="form-control ml-2" placeholder="Stok" required>
                <input type="text" name="harga_varian[]" class="form-control ml-2" placeholder="Harga varian">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-varian">&times;</button>
                </div>
            </div>
        `);
    });

    $(document).on("click", ".remove-varian", function () {
        $(this).closest(".input-group").remove();
    });

    $('#add-varian-tambahan-row').on('click', function () {
        $('#form-varian-tambahan-container').append(`
            <div class="input-group mb-2">
                <input type="text" name="varian_tambahan[]" class="form-control" placeholder="Varian Warna, dll.">
                <input type="number" name="stok_warna_varian[]" class="form-control ml-2" placeholder="Stok varian">
                <div class="input-group-append">
                    <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.remove-varian-row', function () {
        $(this).closest('.input-group').remove();
    });

    <?php foreach ($produk as $p) : ?>
        $('.btn-add-form-varian[data-target="<?= $p['id_kelola']; ?>"]').on('click', function () {
            $('#form-varian-tambahan-container-<?= $p['id_kelola']; ?>').append(`
                <div class="input-group mb-2">
                    <input type="text" name="varian[]" class="form-control" placeholder="Warna, Ukuran, dll.">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-varian">&times;</button>
                    </div>
                </div>
            `);
        });

        $('.btn-add-varian[data-target="<?= $p['id_kelola']; ?>"]').on('click', function () {
            $('#varian-container-<?= $p['id_kelola']; ?>').append(`
                <div class="input-group mb-2">
                    <input type="text" name="varian[]" class="form-control" placeholder="Warna, Ukuran, dll.">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-varian">&times;</button>
                    </div>
                </div>
            `);
        });
    <?php endforeach; ?>
});

// modal edit

$(document).ready(function () {
    // Tambah Varian Tambahan pada Modal Tambah Produk
    $('#add-varian-tambahan-row').on('click', function () {
        $('#form-varian-tambahan-container').append(`
            <div class="input-group mb-2">
                <input type="text" name="varian_tambahan[]" class="form-control" placeholder="Varian Warna, dll.">
                <input type="number" name="stok_warna_varian[]" class="form-control ml-2" placeholder="Stok varian">
                <div class="input-group-append">
                    <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                </div>
            </div>
        `);
    });

    // Tambah Varian Tambahan pada Modal Edit Produk
    $('.btn-add-varian-tambahan').on('click', function () {
        var id = $(this).data('id');
        $('#form-varian-tambahan-container-' + id).append(`
            <div class="input-group mb-2">
                <input type="text" name="varian_tambahan[]" class="form-control" placeholder="Varian Warna, dll.">
                <input type="number" name="stok_warna_varian[]" class="form-control ml-2" placeholder="Stok varian">
                <div class="input-group-append">
                    <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                </div>
            </div>
        `);
    });

    // Tambah Varian pada Modal Tambah Produk
    $('#add-varian').on('click', function () {
        $('#varian-container').append(`
            <div class="input-group mb-2">
                <input type="text" name="varian[]" class="form-control" placeholder="Warna, Ukuran, dll.">
                <input type="number" name="stok_varian[]" class="form-control ml-2" placeholder="Stok yang dibutuhkan">
                <input type="text" name="harga_varian[]" class="form-control ml-2" placeholder="Harga varian">
                <div class="input-group-append">
                    <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                </div>
            </div>
        `);
    });

    // Tambah Varian pada Modal Edit Produk
    $('.btn-add-varian').on('click', function () {
        var id = $(this).data('id');
        $('#varian-container-' + id).append(`
            <div class="input-group mb-2">
                <input type="text" name="varian[]" class="form-control" placeholder="Warna, Ukuran, dll.">
                <input type="number" name="stok_varian[]" class="form-control ml-2" placeholder="Stok yang dibutuhkan">
                <input type="text" name="harga_varian[]" class="form-control ml-2" placeholder="Harga varian">
                <div class="input-group-append">
                    <button class="btn btn-danger remove-varian-row" type="button">&times;</button>
                </div>
            </div>
        `);
    });

    // Hapus baris varian/varian tambahan
    $(document).on('click', '.remove-varian-row', function () {
        $(this).closest('.input-group').remove();
    });
});

// loading screen

// Tampilkan loading screen saat berpindah halaman
window.addEventListener('beforeunload', function () {
    document.getElementById('loadingScreen').style.display = 'flex';
});

// Sembunyikan saat halaman sudah dimuat
window.addEventListener('load', function () {
    document.getElementById('loadingScreen').style.display = 'none';
});

// Set ID Produk yang mau dihapus
function setDeleteId(id) {
        document.getElementById('deleteIdInput').value = id;
    }

// kondisi ketika data tersebut tidak ada

window.addEventListener('DOMContentLoaded', () => {
    const kategoriSelect = document.getElementById('filterKategori');
    const searchInput = document.getElementById('searchProduk');
    const produkCards = document.querySelectorAll('.produk-card');

    function filterProduk() {
        const selectedKategori = kategoriSelect.value;
        const keyword = searchInput.value.toLowerCase();

        let adaYangTampil = false;

        produkCards.forEach(card => {
            const cardKategori = card.dataset.kategori;
            const cardNama = card.dataset.nama;

            const matchKategori = selectedKategori === 'all' || cardKategori === selectedKategori;
            const matchNama = cardNama.includes(keyword);

            if (matchKategori && matchNama) {
                card.style.display = '';
                adaYangTampil = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Optional: tampilkan notifikasi jika tidak ada produk ditemukan
        const noProduk = document.getElementById('noProduk');
        if (noProduk) {
            noProduk.style.display = adaYangTampil ? 'none' : 'block';
        }
    }

    kategoriSelect.addEventListener('change', filterProduk);
    searchInput.addEventListener('keyup', filterProduk);

    // Jalankan sekali saat awal load
    filterProduk();
});


// kondisi ketika data tersebut tidak ada

window.addEventListener('DOMContentLoaded', () => {
    const kategoriSelect = document.getElementById('filterKategori');
    const searchInput = document.getElementById('searchProduk');
    const produkCards = document.querySelectorAll('.produk-card');

    function filterProduk() {
        const selectedKategori = kategoriSelect.value;
        const keyword = searchInput.value.toLowerCase();

        let adaYangTampil = false;

        produkCards.forEach(card => {
            const cardKategori = card.dataset.kategori;
            const cardNama = card.dataset.nama;

            const matchKategori = selectedKategori === 'all' || cardKategori === selectedKategori;
            const matchNama = cardNama.includes(keyword);

            if (matchKategori && matchNama) {
                card.style.display = '';
                adaYangTampil = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Optional: tampilkan notifikasi jika tidak ada produk ditemukan
        const noProduk = document.getElementById('noProduk');
        if (noProduk) {
            noProduk.style.display = adaYangTampil ? 'none' : 'block';
        }
    }

    kategoriSelect.addEventListener('change', filterProduk);
    searchInput.addEventListener('keyup', filterProduk);

    // Jalankan sekali saat awal load
    filterProduk();
});

</script>