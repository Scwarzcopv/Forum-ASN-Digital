<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registrasi User</h5>
                <h6 class="card-subtitle text-muted">Admin & Anggota</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('registration'); ?>" method="POST">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama" id="name" name="name" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger ms-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Masukkan username" id="username" name="username" value="<?= set_value('username'); ?>">
                            <?= form_error('username', '<small class="text-danger ms-3">', '</small>'); ?>
                        </div>
                        <div class="mb-1 user-select-none">
                            <label class="form-label form-switch" class="form-check m-0">
                                <input type="checkbox" class="form-check-input" role="switch" id="password_username" checked>
                                <span class="form-check-label">Password = 1234</span>
                            </label>
                        </div>
                        <div class="mb-3 col-md-6 show_password d-none">
                            <label class="form-label" for="password1">Password</label>
                            <input class="form-control" type="password" placeholder="Masukkan password" id="password1" name="password1" value="1234" />
                        </div>
                        <div class="mb-3 col-md-6 show_password d-none">
                            <label class="form-label" for="password2">Konfirmasi Password</label>
                            <input class="form-control" type="password" placeholder="Masukkan konfirmasi password" id="password2" name="password2" value="1234" />
                            <?= form_error('password2', '<small class="text-danger ms-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="role">User Role</label>
                            <select id="role" name="role" class="form-control">
                                <option value="3" selected="selected">Member</option>
                                <option value="2">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>




    </div>
</main>
<?= $this->session->flashdata('message'); ?>
<script>
    $('#password_username').click(function() {
        if ($('.show_password').is(':visible')) {
            $('.show_password').hide();
            $('#password1').val('1234');
            $('#password2').val('1234');
            $('.user-select-none').removeClass('mb-0').addClass('mb-1');
            // $('#input_komentar').blur();
        } else {
            $('.show_password').removeClass('d-none').show();
            $('#password1').val('');
            $('#password2').val('');
            $('.user-select-none').removeClass('mb-1').addClass('mb-0');
            // $('#input_komentar').blur().focus();
        }
    });
</script>