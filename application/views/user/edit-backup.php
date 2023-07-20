<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><?= $title; ?></h1>
        <div class="col-12 col-xl-12">
            <div class="card">
                <?= form_open_multipart('user/edit'); ?>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="d-none" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                            <input type=" text" class="form-control" value="<?= $user['username']; ?>" readonly disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2 text-sm-end">Gambar</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="<?= base_url('assets/img/avatars/') . $user['image']; ?>" class="img-thumbnail rounded">
                                </div>
                                <div class="col-sm-10">
                                    <div class="">
                                        <input class="form-control custom-file-input" type="file" id="image" name="image">
                                        <?php if ($user['image'] != 'default.png') : ?>
                                            <button type="button" class="btn btn-outline-danger mt-3" id="btnHapusImg" name="btnHapusImg" data-img="<?= $user['image']; ?>" data-username="<?= $user['username']; ?>"><i class=" align-middle fa-solid fa-trash""></i> Hapus Gambar</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group row justify-content-end ">
                        <div class=" col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script>
    // Ambil gambar
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Hapus gambar
    $('#btnHapusImg').on('click', function() {
        Swal.fire({
            icon: 'warning',
            title: "Hapus gambar tersimpan?",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var img = $(this).attr('data-img');
                var username = $(this).attr('data-username');
                var username =
                    // Ajax config
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url('user/hapusgambar'); ?>',
                        data: {
                            img: img,
                            username: username
                        },
                        beforeSend: function() {},
                        success: function(response) {
                            document.location.href = "<?= base_url('user/edit/'); ?>";
                        }
                    });


            }
        });
    });
    window.onload = function() {
        localStorage.setItem("name", $('#name').val());
    }
    var name = localStorage.getItem('name');
    console.log(name)
</script>