<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><?= $title; ?></h1>

        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?= base_url('assets'); ?>/img/avatars/<?= $user['image']; ?>" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h5 class="card-title mb-0"><?= $user['name']; ?></h5>
                        <div class="text-muted mb-2"><?= $user['username']; ?></div>
                        <!-- <div>
                            <a class="btn btn-primary btn-sm" href="#">Follow</a>
                            <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                        </div> -->
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><i class="fa-regular fa-clock"></i> Dibuat <span class="text-primary"><?= $timeAgo; ?></span>
                            </li>
                            <li class="mb-1"><i class="fa-solid fa-clock"></i> Member sejak <span class="text-primary"><?= $timeSince; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>