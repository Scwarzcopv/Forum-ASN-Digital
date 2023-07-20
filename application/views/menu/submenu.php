<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><?= $title; ?></h1>
        <div class="col-12 col-xl-12">
            <!-- BEGIN  modal -->
            <button type="button" class="btn btn-primary mb-3 btn-lg" data-bs-toggle="modal" data-bs-target="#tambahSubMenu">
                <i class="fa-solid fa-circle-plus"></i> Tambah sub menu baru
            </button>
            <?= form_error('name',); ?>
            <div class="modal fade" id="tambahSubMenu" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="<?= base_url('menu/submenu'); ?>" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Tambah Sub Menu Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body m-3">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Title sub menu" id="title" name="title">
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control choices-single" name="menu_id" id="menu_id">
                                                    <?php foreach ($menu as $m) : ?>
                                                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Url" id="url" name="url">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Sub Menu Icon" id="icon" name="icon">
                                            </div>
                                            <div class="form-check user-select-none">
                                                <input class="form-check-input" type="checkbox" value="1" id="id_active" name="id_active" checked style="cursor: pointer;">
                                                <label class="form-check-label" for="id_active" style="cursor: pointer;">
                                                    Active?
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END  modal -->
            <div class="card">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 50%;">Title</th>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Icon Feather</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($subMenu as $sm) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?php echo $sm['title']; ?></td>
                                        <td><?php echo $sm['menu']; ?></td>
                                        <td><?php echo $sm['url']; ?></td>
                                        <td><?php echo $sm['icon']; ?></td>
                                        <td><?php echo $sm['is_active']; ?></td>
                                        <td class="table-action">
                                            <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                            <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                        </td>
                                        <?php $i++; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<?php
if (validation_errors()) {
    echo
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
                title: "Field harus lengkap"
            })
        </script>';
} ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Choices.js
        new Choices(document.querySelector(".choices-single"));
        new Choices(document.querySelector(".choices-multiple"));
    });
</script>