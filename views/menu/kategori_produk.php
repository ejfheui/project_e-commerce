<div class="container-fluid">


<!-- Alert  -->
<?= $this->session->flashdata('message'); ?>

  
        <!-- DataTales Example -->
        <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between custom-card-header">
                    <h6 class="m-0 font-weight-bold text-dark badge badge-subJudul">
                        <i class="fas fa-tags mr-3 ml-3"></i>MasterData - Kategori Produk
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Button Tambah Kategori -->
                    <button class="btn custom-add mb-4" data-toggle="modal" data-target="#addKategoriModal"><i class="fas fa-plus mr-2"></i>Tambah Kategori</button>
                    <table class="table table-hover" id="dataTable">
                        <thead class="thead-custom">
                            <tr>
                                <th class="m-0 font-weight-bold text-secondary">#</th>
                                <th class="m-0 font-weight-bold text-dark text-center">Nama Kategori</th>
                                <th class="m-0 font-weight-bold text-dark text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($kategori as $k): ?>
                                <tr>
                                    <td class="m-0 font-weight-bold text-secondary"><?= $no++; ?></td>
                                    <td class="m-0 font-weight-bold text-secondary text-center"><?= $k['nama_kategori']; ?></td>
                                    <td class="text-center">
                                        <button class="btn custom-edit mr-2" data-toggle="modal" data-target="#editKategoriModal<?= $k['id_kategori']; ?>"><i class="fas fa-pencil-alt mr-2"></i>Edit</button>
                                        <button class="btn custom-delete" data-toggle="modal" data-target="#deleteKategoriModal<?= $k['id_kategori']; ?>"><i class="fas fa-trash-alt mr-2"></i>Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Edit -->
                <?php foreach ($kategori as $k): ?>
                <div class="modal fade" id="editKategoriModal<?= $k['id_kategori']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <form action="<?= base_url('KategoriProduk/editKategori'); ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title m-0 font-weight-bold text-dark">
                                        <i class="fas fa-pencil-alt mr-3" style="color: #c6a724;"></i>Edit Kategori
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_kategori" value="<?= $k['id_kategori']; ?>">
                                    <div class="form-group">
                                        <label for="nama_kategori" class="m-0 font-weight-bold text-secondary">Nama Kategori</label>
                                        <input type="text" class="form-control mt-2" name="nama_kategori" value="<?= $k['nama_kategori']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn custom-close" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn custom-submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Modal Tambah -->
                <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <form action="<?= base_url('KategoriProduk/addKategori'); ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title m-0 font-weight-bold text-dark"><i class="fas fa-plus mr-3" style="color: #416ea4;"></i>Tambah Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_kategori" class="m-0 font-weight-bold text-secondary">Nama Kategori</label>
                                        <input type="text" class="form-control mt-2" name="nama_kategori" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn custom-close" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn custom-submit">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal - Delete -->
                <?php foreach ($kategori as $k): ?>
                <div class="modal fade" id="deleteKategoriModal<?= $k['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteKategoriModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <div class="modal-header">
                                <h5 class="modal-title m-0 font-weight-bold text-dark" id="deleteKategoriModalLabel"><i class="fas fa-trash-alt mr-3" style="color: #cb3605;"></i>Hapus Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('KategoriProduk/deleteKategori/' . $k['id_kategori']); ?>" method="post">
                                <div class="modal-body">
                                    <p class="m-0 font-weight-bold text-secondary">Apakah Anda yakin ingin menghapus kategori <span class="m-0 font-weight-bold text-dark"><?= $k['nama_kategori']; ?></span>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn custom-close" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn custom-buttonmodaldelete">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>



<!-- Style - Css Element -->

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

.custom-buttonmodaldelete {
    align-items: center;
    appearance: none;
    background-color: #cb3605;
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
    color: #6b01e0; /* Customize the color of the ascending arrow */
    font-weight: bold; /* Make the arrow bold */
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #FF6F3C;
    border-color: #FF6F3C;
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

</style>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": true, // Mengaktifkan fitur pagination
        "searching": true, // Mengaktifkan fitur pencarian
        "info": true, // Menampilkan informasi jumlah data
        "language": {
            "lengthMenu": "Tampilkan _MENU_ entri per halaman",
            "zeroRecords": "Ups! Data tidak ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang tersedia",
            "infoFiltered": "(disaring dari total _MAX_ entri)",
            "search": "Cari Data:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});
</script>