<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            
            <!-- DataTales Example -->
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between custom-card-header">
                    <h6 class="m-0 font-weight-bold text-dark badge badge-subJudul">
                        <i class="fas fa-folder-open mr-3 ml-3"></i>Menu - Submenu
                    </h6>
                </div>
                <div class="card-body">

                <a href="" class="btn custom-add mb-4" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-plus mr-2"></i>Tambah Data - Submenu</a>
                    <div class="table-responsive" style="overflow-y: auto; overflow-x: auto;">
                    <table class="table table-hover" id="dataTable">
                        <thead class="thead-custom">
                            <tr>
                                <th scope="col" style="white-space: nowrap;" class="m-0 font-weight-bold text-secondary">#</th>
                                <th scope="col" style="white-space: nowrap;">Judul</th>
                                <th scope="col" style="white-space: nowrap;">Menu</th>
                                <th scope="col" style="white-space: nowrap;">Url</th>
                                <th scope="col" style="white-space: nowrap;">Icon</th>
                                <th scope="col" style="white-space: nowrap;">Aktif</th>
                                <th class="text-center" style="white-space: nowrap;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($subMenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td class="m-0 font-weight-bold text-secondary" style="white-space: nowrap;"><?= $sm['title']; ?></td>
                                <td class="m-0 font-weight-bold text-secondary" style="white-space: nowrap;"><?= $sm['menu']; ?></td>
                                <td class="m-0 font-weight-bold text-link" style="white-space: nowrap;"><?= $sm['url']; ?></td>
                                <td class="m-0 font-weight-bold text-icon" style="white-space: nowrap;"><?= $sm['icon']; ?></td>
                                <td class="text-center m-0 font-weight-bold text-primary" style="white-space: nowrap;"><?= $sm['is_active']; ?></td>
                                <td class="text-center m-0 font-weight-bold text-secondary" style="white-space: nowrap;">
                                    <a href="" class="btn custom-edit mr-3" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id']; ?>"><i class="fas fa-pencil-alt mr-2"></i>Ubah</a>
                                    <a href="#" class="btn custom-delete" data-toggle="modal" data-target="#deleteSubMenuModal<?= $sm['id']; ?>">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus
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
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- ADD - Modal -->
        <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                <div class="modal-content" style="border: none; box-shadow: none;">
                    <div class="modal-header">
                        <div class="modal-title m-0 font-weight-bold text-dark text-small" id="newSubMenuModalLabel"><i class="fas fa-plus mr-3" style="color: #416ea4;"></i>Tambah Data - <span class="m-0 font-weight-bold text-primary"><?= $title;?></span></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/submenu'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                            </div>
                            <div class="form-group">
                                <select name="menu_id" id="menu_id" class="form-control custom-select">
                                    <option value="">Pilih Menu</option>
                                    <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                    <label class="form-check-label" for="is_active">
                                        Active?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn custom-close" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn custom-submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 

        <!-- Edit - Modal -->
        <?php foreach ($subMenu as $sm) : ?>
        <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                <div class="modal-content" style="border: none; box-shadow: none;">
                    <div class="modal-header">
                        <div class="modal-title m-0 font-weight-bold text-dark text-small" id="editSubMenuModalLabel"><i class="fas fa-pencil-alt mr-3" style="color: #c6a724;"></i>Edit Submenu - <span class="m-0 font-weight-bold text-primary"><?= $title; ?></span></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/editSubMenu'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?= $sm['title']; ?>">
                            </div>
                            <div class="form-group">
                                <select name="menu_id" id="menu_id" class="form-control custom-select">
                                    <option value="">Select Menu</option>
                                    <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['id']; ?>" <?= $m['id'] == $sm['menu_id'] ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $sm['url']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $sm['icon']; ?>">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active<?= $sm['id']; ?>" <?= $sm['is_active'] ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="is_active<?= $sm['id']; ?>">Active?</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn custom-close" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn custom-submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Delete - modal -->
        <?php foreach ($subMenu as $sm) : ?>
            <div class="modal fade" id="deleteSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSubMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="border-radius: 25px; overflow: hidden; border: 5px solid white;">
                    <div class="modal-content" style="border: none; box-shadow: none;">
                        <div class="modal-header">
                            <div class="modal-title m-0 font-weight-bold text-dark text-small" id="deleteSubMenuModalLabel"><i class="fas fa-trash-alt mr-3" style="color: #cb3605; "></i>Hapus - <span class="m-0 font-weight-bold text-danger"><?= $title; ?></span></div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body m-0 font-weight-bold text-secondary">
                            Apakah Anda yakin untuk menghapus data tersebut? bila iya klik hapus <span class="m-0 font-weight-bold text-dark"><?= $sm['title']; ?></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn custom-close" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('menu/deleteSubMenu/' . $sm['id']); ?>" class="btn custom-buttonmodaldelete">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

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
    color: #4120d3; /* Customize the color of the ascending arrow */
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