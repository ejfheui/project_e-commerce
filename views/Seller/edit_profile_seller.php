<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex align-items-center justify-content-between custom-card-header">
            <h6 class="m-0 font-weight-bold text-dark badge badge-subJudul">
                <i class="fas fa-user-edit mr-3 ml-3"></i>Edit -Profile
            </h6>
        </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8">

                        <?= form_open_multipart('EditProfileSeller/edit_profile_seller'); ?>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Full name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Picture</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn custom-submit">Edit</button>
                            </div>
                        </div>


                        </form>


                    </div>
                </div>



            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content --> 


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

.text-date {
    color: #deb93c; 
}

.text-harga {
    color: #6c9e66; 
}

</style>
