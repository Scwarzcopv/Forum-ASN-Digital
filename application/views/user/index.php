<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><?= $title; ?></h1>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= base_url('assets'); ?>/img/avatars/<?= $user['image']; ?>" class="img-fluid rounded-start" alt="avatar.jpg">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name']; ?></h5>
                        <p class="card-text"><?= $user['username']; ?></p>
                        <p class="card-text"><small class="text-muted"><?= $timeAgo; ?><br>Member sejak <?= date('d F Y', $user['date_created']); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>