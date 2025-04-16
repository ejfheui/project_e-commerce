<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-5">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- Image Section -->
                <div class="col-lg-5 d-none d-lg-block bg-register-image" 
                    style="background-image: url('<?= base_url('assets/img/DesainLogin/store.jpg'); ?>'); 
                            background-size: cover; 
                            background-position: center;">
                </div>
                <!-- Registration Form Section -->
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Mu!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-registration btn-user btn-block">
                                Daftar Akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Lupa Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth');?>">Sudah punya akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.btn-registration {
    background-color: #FF3C38;
    border: none;
    color: white;
    font-weight: bold;
    transition: 0.3s ease;
}

.btn-registration:hover {
    background-color: #FF3C38; /* versi gelapnya buat efek hover */
    color: #fff;
}


</style>