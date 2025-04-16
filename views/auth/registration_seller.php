<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-store mr-3"></i>Pendaftaran Seller</h1>
                    </div>
                    <form method="post" action="<?= base_url('auth/registration_seller'); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password1" placeholder="Kata Sandi">
                            <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password2" placeholder="Ulangi Kata Sandi">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="ktp" placeholder="Nomor KTP">
                            <?= form_error('ktp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="toko" placeholder="Nama Toko">
                            <?= form_error('toko', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-user btn-block" style="border-radius: 20px;">Daftar Akun</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
