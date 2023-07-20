<!-- AMBIL ROLE ID DARI SESSION -->
<?php $role_id = $this->session->userdata('role_id'); ?>

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="sidebar-brand-text align-middle">
                <!-- <span class="sidebar-brand-text align-middle d-flex align-items-center">
                    <span class="ext-light position relative me-2">
                        <i class="fa-solid fa-circle fs-1 bg-danger px-3 py-1 rounded-2"></i>
                        <span class="position-absolute text-dark fw-bold miring" style="right: 76.3%; top: 3.2%; font-weight: bolder;">卐</span>
                    </span> -->
                <?= $role; ?>
            </span>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="<?= base_url('assets'); ?>/img/avatars/<?= $user['image']; ?>" class="avatar img-fluid rounded me-1" alt="avatar.jpg" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <?= $user['name']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1" data-feather="settings"></i> Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('login/logout'); ?>"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
                    </div>

                    <div class="sidebar-user-subtitle"><?= $role; ?></div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <!-- QUERY MENU -->
            <?php
            $queryMenu = "
                SELECT `user_menu`.`id`, `menu` 
                FROM `user_menu` JOIN `user_access_menu`
                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_access_menu`.`menu_id` ASC
                ";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>

            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) : ?>
                <li class="sidebar-header">
                    <?= $m['menu']; ?>
                </li>

                <!-- Sub-menu sesuai menu -->
                <?php
                $menuId = $m['id'];
                $querySubMenu = "
                    SELECT *
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    WHERE `user_sub_menu`.`menu_id` = $menuId
                    AND `user_sub_menu`.`is_active` = 1
                    ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>
                <?php foreach ($subMenu as $sm) : ?>
                    <li class="sidebar-item <?php if ($sidebar == $sm['title']) echo "active"; ?>">
                        <a class="sidebar-link" href="<?= base_url($sm['url']); ?>">
                            <i class="align-middle <?= $sm['icon']; ?>"></i> <span class="align-middle"><?= $sm['title']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <!-- *TEMPLATE MENU* -->
            <!-- <li class="sidebar-header">
                User
            </li>
            <li class="sidebar-item active">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboards</span>
                </a>
            </li> -->

        </ul>

    </div>
</nav>