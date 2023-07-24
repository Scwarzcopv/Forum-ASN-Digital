<script type="text/javascript">
    $(document).ajaxStart(function() {
        $("#ajax-wait").css({
            left: ($(window).width() - 32) / 2 + "px", // 32 = lebar gambar
            top: ($(window).height() - 32) / 2 + "px", // 32 = tinggi gambar
            display: "block"
        })
    }).ajaxComplete(function() {
        $("#ajax-wait").fadeOut();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?= base_url(); ?>/menu/showMenuManajemen",
            cache: false,
            success: function(data) {
                $("#tampil").html(data);
            }
        });

    });
</script>
<main class="content">
    <div class="container-fluid p-0">
        <div class="col-12 col-xl-12">
            <div id="tampil">
                <!-- DATA TAMPIL -->
            </div>
            <div class="position-absolute top-50 start-50 translate-middle">
                <div id='ajax-wait'>
                    <img alt='loading...' src='<?php echo base_url() ?>/assets/img/icons/Rolling-1s-84px.png' />
                </div>
            </div>
        </div>
    </div>
</main>

<!------------------------------------------ MODAL TAMBAH DATA ------------------------------------------>
<div class="modal fade" id="modalTambah" name="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!-- START FORM MODAL -->
        <form action="<?= base_url('menu/tambahdata'); ?>" method="POST" id="formTambah" name="formTambah">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Menu Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="idTambah">
                            <div class="mb-3 form-group">
                                <label class="form-label label-1" for="menu_Tambah">Nama menu</label>
                                <input type="text" class="form-control" placeholder="Nama menu" autocomplete="off" id="menu_Tambah" name="menu_Tambah">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitTambah">Tambahkan</button>
                </div>
            </div>
        </form>
        <!-- END FORM MODAL -->
    </div>
</div>
<!------------------------------------------ END MODAL TAMBAH DATA ------------------------------------------>

<!------------------------------------------ MODAL EDIT DATA ------------------------------------------>
<div class="modal fade" id="modalEdit" name="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!-- START FORM MODAL -->
        <form action="<?= base_url('menu/ubahdata'); ?>" method="POST" id="formEdit" name="formEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ubah Nama Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id_Edit">
                            <div class="mb-3 form-group">
                                <label class="form-label label-1" for="menu_Edit">Nama menu</label>
                                <input type="text" class="form-control" placeholder="Nama menu" autocomplete="off" id="menu_Edit" name="menu_Edit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitEdit" name="submitEdit">Ubah Nama</button>
                </div>
            </div>
        </form>
        <!-- END FORM MODAL -->
    </div>
</div>
<!------------------------------------------ END MODAL EDIT DATA ------------------------------------------>
















<!-- Tutup elemen dari topbar.php -->

</div>

<?= $this->session->flashdata('message'); ?>
<?= form_error(
    'menu',
    '<script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "error",
                title: "',
    '"
            })
        </script>'
) ?>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>