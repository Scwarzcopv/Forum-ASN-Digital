<form method="post" action="<?= base_url('menu/saveMenuManajemen'); ?>" id="form">
    <div class="modal-body">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <input type="text" class="d-none" name="id" value="<?= $result['id']; ?>" readonly>
                    <label class="form-label label-1" for="menu">Nama menu</label>
                    <input type="text" class="form-control" placeholder="Nama menu" autocomplete="off" id="menu" name="menu" value="<?= $result['menu']; ?>" autofocus>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
    </div>
</form>
<script type="text/javascript">
    function inputFocus() {
        $('#menu').on('focus', function() {
            var temp_value = this.value;
            this.value = '';
            this.value = temp_value
        });
    }

    function ubah() {
        var validatorEdit = $('#form').validate({
            rules: {
                menu: {
                    required: true,
                    remote: {
                        url: "<?= base_url('menu/cekMenuManajemenEdit'); ?>",
                        type: "GET",
                        data: {
                            id: function() {
                                return $("#form input[name='id']").val();
                            },
                            menu: function() {
                                return $("#form input[name='menu']").val();
                            },
                        }
                    },
                    minlength: 4,
                    maxlength: 15
                },
            },
            messages: {
                menu: {
                    required: "Nama tidak boleh kosong",
                    remote: "Nama sudah terpakai",
                    minlength: jQuery.validator.format("Setidaknya {0} karakter dibutuhkan"),
                    maxlength: jQuery.validator.format("Karakter melebihi {0}")
                }
            },
            highlight: function(element, errorClass) {
                $(element).closest("#menu").addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass) {
                $(element).closest("#menu").removeClass("is-invalid").addClass("is-valid");
            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('menu/saveEditMenuManajemen'); ?>",
                    data: $('#form').serializeArray(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#submit').attr('disabled', true).html("Processing...");
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            $('#myModal').modal('toggle');
                            $('#tampil').load("<?php echo base_url(); ?>/menu/showMenuManajemen");
                            Swal.fire({
                                icon: 'success',
                                title: "Menu Berhasil Diubah",
                                text: "'" + resp.success + "' => " + resp.menuLama + "'",
                            }).then(function() {
                                $('#submit').attr('disabled', false).html("Simpan");
                            })
                        }
                    }
                });
            }
        });
        $('#modalTambah').on('hidden.bs.modal', function() {
            $('#form input[type=text]').removeClass('is-valid is-invalid');
            validatorEdit.resetForm();
        });
    }

    $(document).ready(function() {
        inputFocus();
        ubah();
    });
</script>