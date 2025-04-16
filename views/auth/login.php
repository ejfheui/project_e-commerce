<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-5">
                <!-- Nested Row within Card Body -->
                <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                    style="background-image: url('assets/img/DesainLogin/e-commerce.jpg'); 
                            background-size: cover; 
                            background-position: center;">
                </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                            </div>
                           
                                <?= $this->session->flashdata('message'); ?>

                                    <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan Alamat Email" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-login btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Lupa password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/registration');?>">Buat akun mu!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


<style>

.btn-login {
    background-color: #FF3C38;
    border: none;
    color: white;
    font-weight: bold;
    transition: 0.3s ease;
}

.btn-login:hover {
    background-color: #FF3C38; /* versi gelapnya buat efek hover */
    color: #fff;
}


</style>


