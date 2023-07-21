<main class="content">
    <div class="container-fluid p-0">
        <div class="col-12 col-xl-12">
            <!-- TRIGGER  MODAL TAMBAH DATA -->
            <button type="button" class="btn btn-primary mb-3 btn-lg" data-bs-toggle="modal" data-bs-target="#modalTambah" id="btnTambahMenu" name="btnTambahMenu">
                <i class="fa-solid fa-circle-plus"></i> Tambah role baru
            </button>
            <!-- END TRIGGER  MODAL TAMBAH DATA -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th style="width: 80%;">Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="menu-list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!------------------------------------------ MODAL TAMBAH DATA ------------------------------------------>
<div class="modal fade" id="modalTambah" name="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!-- START FORM MODAL -->
        <form action="<?= base_url('admin/role'); ?>" method="POST" id="formTambah" name="formTambah">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Role Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="idTambah">
                            <div class="mb-3 form-group">
                                <label class="form-label label-1" for="menu_Tambah">Nama role</label>
                                <input type="text" class="form-control" placeholder="Nama role" autocomplete="off" id="menu_Tambah" name="menu_Tambah">
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
                    <h5 class="modal-title fw-bold">Ubah Nama Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id_Edit">
                            <div class="mb-3 form-group">
                                <label class="form-label label-1" for="menu_Edit">Nama role</label>
                                <input type="text" class="form-control" placeholder="Nama role" autocomplete="off" id="menu_Edit" name="menu_Edit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitEdit" name="submitEdit">Ubah Role</button>
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
<script src="<?= base_url('assets'); ?>/js/customajax-role.js"></script>