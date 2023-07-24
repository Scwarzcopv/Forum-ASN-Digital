<main class="content">
    <div class="container-fluid p-0">
        <h5 class="mb-4">Role : <?php if (!empty($user_role)) : ?><?= $user_role['role']; ?><?php endif; ?></h5>
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th style="width: 80%;">Menu</th>
                                <th>Access</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" name="tbody">
                            <?php $i = 1; ?>
                            <?php if (!empty($user_role)) : ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr id="<?= $user_role['id']; ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $m['menu']; ?></td>
                                        <td>
                                            <div class="form-check form-switch"><input class="form-check-input h3 my-0" type="checkbox" role="switch" <?= check_access($user_role['id'], $m['id']) ?> data-role="<?= $user_role['id']; ?>" data-menu="<?= $m['id']; ?>"></div>
                                        </td>
                                        <?php $i++ ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>



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
<script src="<?= base_url('assets'); ?>/js/customajax-role-access.js"></script>
<script>
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('menu/changeaccess'); ?>",
            type: "POST",
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function(response) {
                if (roleId == 1) {
                    Custom2.fire({
                        icon: "success",
                        title: "Akses berhasil diubah",
                        confirmButtonText: 'Reload page?',
                        customClass: {
                            confirmButton: 'confirmButton',
                            title: 'tittleSwall',
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href = "<?= base_url('menu/roleaccess/'); ?>" + roleId;
                        }
                    });
                } else {
                    Custom.fire({
                        icon: "success",
                        title: "Akses berhasil diubah"
                    })
                }
            }
        });
    });
</script>