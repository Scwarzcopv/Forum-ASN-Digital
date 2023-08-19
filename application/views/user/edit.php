<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#page_account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#page_edit_password" role="tab">
                            Password
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <!-- TAB PANEL UBAH AKUN -->
                    <div class="tab-pane fade show active" role="tabpanel" id="page_account">
                        <!-- BASIC INFO -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Info</h5>
                            </div>
                            <div class="card-body">
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
                                                <span class="btn btn-primary btn-file"><i class="fas fa-upload"></i> Upload <input type="file" accept=".jpg, .jpeg, .png" id="upload_image" data-img="<?= $user['image']; ?>"></span>
                                            </div>
                                            <small>Format jpg/jpeg/png</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MORE INFO -->
                        <div class=" card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">More info</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= base_url('user/edit') ?>">
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
                                        <label class="form-label" for="name">Name (Maks. 20 karakter)</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $user['name']; ?>">
                                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- TAB PANEL UBAH PASSWORD -->
                    <div class="tab-pane fade" role="tabpanel" id="page_edit_password">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <form method="POST" action="<?= base_url('user/change_password') ?>" id="formUbahPassword">
                                    <div class="mb-3">
                                        <label class="form-label" for="currentpassword">Password sekarang</label>
                                        <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                                        <!-- <small><a href="#">Forgot your password?</a></small> -->
                                        <?= form_error('currentpassword', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="newpassword1">Password Baru</label>
                                        <input type="password" class="form-control" id="newpassword1" name="newpassword1">
                                        <?= form_error('newpassword1', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="newpassword2">Verifikasi password</label>
                                        <input type="password" class="form-control" id="newpassword2" name="newpassword2">
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="simpanPerubahan">Simpan Perubahan</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- MODAL EDIT IMAGE -->
<div class="modal fade" id="modal_edit_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Crop Gambar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-8 col-md-8 d-flex d-md-block">
                            <div class="col-12">
                                <img src="" id="sample_image" class=" fit-image " />
                            </div>
                        </div>
                        <div class="col-4 col-md-4 d-flex align-items-center justify-content-center ">
                            <div class="preview rounded-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->



<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script>
    function save_edit() {
        var validatorEdit = $('#formUbahPassword').validate({
            rules: {
                currentpassword: {
                    required: true,
                },
                newpassword1: {
                    required: true,
                    minlength: 5,
                    // maxlength: 15
                },
                newpassword2: {
                    required: true,
                    remote: {
                        // remote: base_url + "user/cekpassword",
                        url: base_url + "user/cekconfirm",
                        type: "POST",
                        data: {
                            newpassword1: function() {
                                return $("#formUbahPassword input[name='newpassword1']").val();
                            },
                            newpassword2: function() {
                                return $("#formUbahPassword input[name='newpassword2']").val();
                            },
                        }
                    },
                }
            },
            messages: {
                currentpassword: {
                    required: "Password tidak boleh kosong",
                },
                newpassword1: {
                    required: "Pasword baru tidak boleh kosong",
                    minlength: jQuery.validator.format("Setidaknya {0} karakter dibutuhkan"),
                    // maxlength: jQuery.validator.format("Karakter melebihi {0}")
                },
                newpassword2: {
                    required: "Konfirmasi password tidak boleh kosong",
                    remote: "Konfirmasi password tidak sama",
                }
            },
            highlight: function(element, errorClass) {
                $(element).closest("#currentpassword").addClass("is-invalid").removeClass("is-valid");
                $(element).closest("#newpassword1").addClass("is-invalid").removeClass("is-valid");
                $(element).closest("#newpassword2").addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass) {
                $(element).closest("#currentpassword").removeClass("is-invalid").addClass("is-valid");
                $(element).closest("#newpassword1").removeClass("is-invalid").addClass("is-valid");
                $(element).closest("#newpassword2").removeClass("is-invalid").addClass("is-valid");
            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: $(form).attr('action'),
                    data: $(form).serializeArray(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#simpanPerubahan').attr('disabled', true).html("Processing...");
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            $('#simpanPerubahan').attr('disabled', false).html("Simpan Perubahan");
                            resetForm(form)
                            Swal.fire({
                                icon: 'success',
                                title: 'Perubahan berhasil',
                                text: resp.success
                            }).then(function() {
                                window.location = base_url + 'user/edit';
                            });
                        } else if (resp.status == 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Perubahan Gagal',
                                text: resp.error
                            });
                            $('#simpanPerubahan').attr('disabled', false).html("Simpan Perubahan");
                        }
                    }
                });
            }
        });
        $('#modalEdit').on('hidden.bs.modal', function() {
            $('#formEdit input[type=text]').removeClass('is-valid is-invalid');
            validatorEdit.resetForm();
        });
    }

    function editImage() {
        var $modal = $('#modal_edit_modal');
        var image = $('#sample_image')[0];
        var cropper;
        // Konfigurasi image cropper
        $('#upload_image').change(function(event) {
            var files = event.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        // Trigger crop
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });
            canvas.toBlob(function(blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    var img = $('#upload_image').attr('data-img');
                    // var username = $('#username').val();

                    $.ajax({
                        url: base_url + "user/editgambar",
                        method: "POST",
                        data: {
                            image: base64data,
                            oldImage: img,
                            // username: username,
                        },
                        success: function(response) {
                            window.location = base_url + 'user/edit';
                            // location.reload(true);
                        }
                    });
                }
            });
        });
    }

    function resetForm(selector) {
        $(selector)[0].reset();
    }
    var base_url = $('#baseUrl').val();
    $(document).ready(function() {
        editImage();
        save_edit();
    });
</script>