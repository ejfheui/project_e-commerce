<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex align-items-center justify-content-between custom-card-header">
            <h6 class="m-0 font-weight-bold text-dark badge badge-subJudul">
                <i class="fas fa-truck mr-3 ml-3"></i>Menu - Jasa Kirim
            </h6>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah Data -->
            <button class="btn custom-add mb-4" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus mr-2"></i>Tambah Jasa Kirim</button>

            <table class="table table-hover" id="dataTable">
                <thead class="thead-custom">
                    <tr>
                        <th class="m-0 font-weight-bold text-secondary">#</th>
                        <th class="m-0 font-weight-bold text-dark text-center">Nama Jasa Kirim</th>
                        <th class="m-0 font-weight-bold text-dark text-center">Estimasi Waktu</th>
                        <th class="m-0 font-weight-bold text-dark text-center">Harga Per KM</th>
                        <th class="m-0 font-weight-bold text-dark text-center">Status Aktif</th>
                        <th class="m-0 font-weight-bold text-dark text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($jasa_kirim as $jk) : ?>
                        <tr>
                            <td class="m-0 font-weight-bold text-secondary"><?= $no++; ?></td>
                            <td class="m-0 font-weight-bold text-secondary text-center"><?= $jk['nama_jasa_kirim']; ?></td>
                            <td class="m-0 font-weight-bold text-secondary text-center"><?= $jk['estimasi_waktu']; ?></td>
                            <td class="m-0 font-weight-bold text-harga text-center">Rp <?= number_format($jk['harga_per_km'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <?= $jk['status_aktif'] 
                                    ? '<span class="badge badge-success text-white" style="background-color: rgba(38, 212, 79, 0.5); font-size: 14px; padding: 7px 10px; border-radius: 10px">Aktif</span>' 
                                    : '<span class="badge badge-danger text-white" style="background-color: rgba(170, 164, 165, 0.5); font-size: 14px; padding: 7px 10px; border-radius: 10px">Nonaktif</span>'; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn custom-edit mr-2" data-toggle="modal" data-target="#modalEdit<?= $jk['id_jasa_kirim']; ?>"><i class="fas fa-pencil-alt mr-2"></i>Edit</button>
                                <button href="<?= base_url('JasaKirim/hapus/') . $jk['id_jasa_kirim']; ?>" class="btn custom-delete"><i class="fas fa-trash-alt m-2"></i>Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit<?= $jk['id_jasa_kirim']; ?>" tabindex="-1">
                            <div class="modal-dialog" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                                <div class="modal-content" style="border: none; box-shadow: none;">
                                    <form action="<?= base_url('JasaKirim/edit'); ?>" method="post">
                                        <input type="hidden" name="id_jasa_kirim" value="<?= $jk['id_jasa_kirim']; ?>">
                                        <div class="modal-header">
                                            <div class="modal-title m-0 font-weight-bold text-dark"><i class="fas fa-pencil-alt mr-3" style="color: #c6a724;"></i>Edit Data</div>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Nama Jasa Kirim</label>
                                                <input type="text" class="form-control mt-2" name="nama_jasa_kirim" value="<?= $jk['nama_jasa_kirim']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Estimasi Waktu</label>
                                                <input type="text" class="form-control mt-2" name="estimasi_waktu" value="<?= $jk['estimasi_waktu']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary">Harga Per KM</label>
                                                <input type="number" class="form-control mt-2" name="harga_per_km" value="<?= $jk['harga_per_km']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="status_aktif" <?= $jk['status_aktif'] ? 'checked' : ''; ?> value="1">
                                                <label class="form-check-label ml-2" for="status_aktif">
                                                    Active?
                                                </label>
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
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                <div class="modal-content" style="border: none; box-shadow: none;">
                    <form action="<?= base_url('JasaKirim/tambah'); ?>" method="post">
                        <div class="modal-header">
                            <div class="modal-title m-0 font-weight-bold text-dark"><i class="fas fa-plus mr-3" style="color: #416ea4;"></i>Tambah Data</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="m-0 font-weight-bold text-secondary">Nama Jasa Kirim</label>
                                <input type="text" class="form-control mt-2" name="nama_jasa_kirim" required>
                            </div>
                            <div class="form-group">
                                <label class="m-0 font-weight-bold text-secondary">Estimasi Waktu</label>
                                <input type="text" class="form-control mt-2" name="estimasi_waktu" required>
                            </div>
                            <div class="form-group">
                                <label class="m-0 font-weight-bold text-secondary">Harga Per KM</label>
                                <input type="number" class="form-control mt-2" name="harga_per_km" required>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="status_aktif" value="1">
                                <label class="form-check-label ml-2" for="status_aktif">
                                    Active?
                                </label>
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

.text-date {
    color: #deb93c; 
}

.text-harga {
    color: #6c9e66; 
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

document.addEventListener('DOMContentLoaded', function () {
    const readMoreLinks = document.querySelectorAll('.read-more');

    readMoreLinks.forEach(link => {
        link.addEventListener('click', function () {
            const fullDescription = this.getAttribute('data-deskripsi');
            document.getElementById('descModalBody').innerText = fullDescription;
        });
    });
});
</script>

