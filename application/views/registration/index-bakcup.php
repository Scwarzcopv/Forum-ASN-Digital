<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Registrasi User</h1>
        <div class="card">
            <div class="card-body">
                <div class="m-sm-4">
                    <form action="<?= base_url('login/registration'); ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Masukkan nama" id="name" name="name" value="<?= set_value('name'); ?>" />
                            <?= form_error('name', '<small class="text-danger ms-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input class="form-control form-control-lg" type="text" placeholder="Masukkan username" id="username" name="username" value="<?= set_value('username'); ?>" />
                            <?= form_error('username', '<small class="text-danger ms-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password1">Password</label>
                            <input class="form-control form-control-lg" type="password" placeholder="Masukkan password" id="password1" name="password1" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password2">Konfirmasi Password</label>
                            <input class="form-control form-control-lg" type="password" placeholder="Masukkan konfirmasi password" id="password2" name="password2" />
                            <?= form_error('password2', '<small class="text-danger ms-3">', '</small>'); ?>
                        </div>

                        <div class="text-center mt-4">
                            <!-- <a href="index.html" class="btn btn-lg btn-primary">Sign up</a> -->
                            <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary">Buat Akun</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>




    </div>
</main>

<?= $this->session->flashdata('message'); ?>