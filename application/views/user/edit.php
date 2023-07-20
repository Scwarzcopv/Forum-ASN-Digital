<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Settings</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                            Password
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Basic Info</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" class="d-none" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                                                <input type=" text" class="form-control" value="<?= $user['username']; ?>" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="User Image" src="<?= base_url('assets/img/avatars/') . $user['image']; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                                <div class="mt-2">
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalUpload"><i class="fas fa-upload"></i> Upload</button>
                                                </div>
                                                <small>Ukuran file maks 5mb</small>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">More info</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <!-- <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputFirstName">First name</label>
                                            <input type="text" class="form-control" id="inputFirstName" placeholder="First name">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputLastName">Last name</label>
                                            <input type="text" class="form-control" id="inputLastName" placeholder="Last name">
                                        </div>
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="form-label" for="inputAddress">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $user['name']; ?>">
                                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <form>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" id="inputPasswordCurrent">
                                        <small><a href="#">Forgot your password?</a></small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew">New password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="inputPasswordNew2">Verify password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew2">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="modal_upload" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_upload">Crop Gambar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="<?= base_url('assets/img/avatars/') . $user['image']; ?>" alt="Picture">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



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
    // window.onload = function() {
    //     localStorage.setItem("name", $('#name').val());
    // }
    // var name = localStorage.getItem('name');
    // console.log(name)


    window.addEventListener('DOMContentLoaded', function() {
        var image = document.getElementById('image');
        var cropBoxData;
        var canvasData;
        var cropper;

        $('#modal').on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                autoCropArea: 0.5,
                ready: function() {
                    //Should set crop box data first here
                    cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                }
            });
        }).on('hidden.bs.modal', function() {
            cropBoxData = cropper.getCropBoxData();
            canvasData = cropper.getCanvasData();
            cropper.destroy();
        });
    });
</script>