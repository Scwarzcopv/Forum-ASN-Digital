<main class="content">
    <div class="container-fluid p-0">
        <div class="col-12 col-xl-12">
            <div class="card">
                <form action="<?= base_url('user/change_password'); ?>" method="POST">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end" for="username">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="d-none" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                                <input type=" text" class="form-control" value="<?= $user['username']; ?>" readonly disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end" for="currentpassword">Current Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                                <?= form_error('currentpassword', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end" for="newpassword1">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="newpassword1" name="newpassword1">
                                <?= form_error('newpassword1', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-sm-2 text-sm-end" for="newpassword2">Ulangi Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="newpassword2" name="newpassword2">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 form-group row justify-content-end ">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary ms-2">Ubah Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>