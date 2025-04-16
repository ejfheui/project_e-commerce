<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <!-- Card untuk Role Akses -->
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header" style="background-color: #FF6F3C; color: white; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user-shield mr-2"></i> Admin - Role Akses
                    </h6>
                    <a href="#" class="btn" style="background-color: #E0E0E0; color: black;" data-toggle="modal" data-target="#newRoleModal">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Role
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-hover">
                        <table class="table table-hover table-bordered" id="dataTable">
                            <thead style="background-color: #F5F5F5;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($role as $r) : ?>
                                <tr>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td class="text-center font-weight-bold text-dark"><?= $r['role']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="btn custom-role btn-sm mx-1">
                                            <i class="fas fa-key mr-2"></i> Akses
                                        </a>
                                        <a href="#" class="btn custom-edit btn-sm mx-1" data-toggle="modal" data-target="#editRoleModal<?= $r['id']; ?>">
                                            <i class="fas fa-edit mr-2"></i> Ubah
                                        </a>
                                        <a href="<?= base_url('admin/deleteRole/' . $r['id']); ?>" class="btn custom-delete btn-sm mx-1" onclick="return confirm('Yakin ingin menghapus role ini?');">
                                            <i class="fas fa-trash mr-2"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End of Main Content -->



                </div>
                <!-- End of Main Content -->

                <!-- Modal -->

              <!-- Modal Tambah Role Baru -->
                <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                        <div class="modal-content" style="border: none; box-shadow: none;">
                            <form action="<?= base_url('admin/role'); ?>" method="post">
                                <div class="modal-header">
                                    <div class="modal-title m-0 font-weight-bold text-dark" id="newRoleModalLabel"><i class="fas fa-plus mr-3" style="color: #416ea4;"></i>Tambah Role Baru</div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="role" class="m-0 font-weight-bold text-secondary">Nama Role</label>
                                        <input type="text" class="form-control mt-2" id="role" name="role" required>
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

                <!-- Edit Modals -->
                <?php foreach ($role as $r): ?>
                    <div class="modal fade" id="editRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel<?= $r['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                            <div class="modal-content" style="border: none; box-shadow: none;">
                                <form action="<?= base_url('admin/editRole'); ?>" method="post">
                                    <div class="modal-header">
                                        <div class="modal-title m-0 font-weight-bold text-dark" id="editRoleModalLabel<?= $r['id']; ?>"><i class="fas fa-pencil-alt mr-3" style="color: #c6a724;"></i>Edit Role</div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $r['id']; ?>">
                                        <div class="form-group">
                                            <label for="role" class="m-0 font-weight-bold text-secondary">Nama Role</label>
                                            <input type="text" class="form-control mt-2" id="role" name="role" value="<?= $r['role']; ?>">
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

.custom-role{
    align-items: center;
    appearance: none;
    background-color: #fff;
    border-radius: 30px;
    border-style: none;
    box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 5px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
    box-sizing: border-box;
    color: #5b67ae;
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
    color:rgb(1, 5, 224);
    background-color: #fff;
    border: 1px solid #dddfeb;
}
a {
    color: rgb(1, 5, 224);
    text-decoration: none;
    background-color: transparent;
}

/* Text Style */

.text-icon {
    color: #e69316; 
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