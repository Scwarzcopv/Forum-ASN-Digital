<?php
$key_anonim_new = $row['id_anonim'];
// Penjawab
if ($row['valid'] === '1' && $row['deleted'] == null) {
    $key_anonim_new = $key_anonim;
    $admin = null; // 
    $color_admin = null; // 
    ($user['id'] !== $row['id_admin']) ? ($admin = $penjawab['name']) : ($admin = 'Anda');
    ($user['id'] !== $row['id_admin']) ? ($color_admin = 'text-info') : ($color_admin = 'text-danger');

    $answer_updated_at = null; // 
    ($row['answered_at'] !== $row['updated_at_fp'] || $row['updated_at_fp'] !== null || $row['updated_at_fp'] !== '') ? ($answer_updated_at = '<br class="d-md-none"><span class="text-navy">( <i class="fad fa-edit"></i> Diedit ' . $updated_at_carbon . ' )</span>') : ($answer_updated_at = null);

    $hapus_pertanyaan = null; // 
    $btn_ubah_jawaban = null; // 
    if ($user['role_id'] <= 2) {
        if ($user['id'] === $row['id_admin']) {
            $btn_ubah_jawaban = '<a class="btn btn-sm btn-info ms-auto mt-1 rounded" id="btn_ubah_jawaban"><i class="fa-solid fa-pen-clip"></i> Ubah</a>';
            $hapus_pertanyaan = '<a class="btn btn-sm btn-danger ms-1 mt-1 rounded" id="btn_hapus_pertanyaan"><i class="fa-solid fa-trash-can"></i></a>';
        }
    }
}
// Penanya
$penanya = null; //
if ($user['id'] == $row['id_user_tanya']) {
    $penanya = '<span class="text-danger">Anda</span>';
} else {
    $penanya = 'Anonim-' . @$key_anonim_new;
}
?>

<main class="col-12 d-flex sub-closest" id="sub_closest_<?= @$row['id_fp']; ?>">
    <!-- LIST DAYA -->
    <article class="d-none data-sub-closest">
        <input name="id_fp" value=<?= @$row['id_fp']; ?> type="text" readonly></input>
        <!-- Modal -->
        <input name="key_anonim" value=<?= @$key_anonim_new; ?> type="text" readonly></input>
        <input name="created_at" value="<?= $created_at_carbon; ?>" type="text" readonly></input>
        <input name="narasumber" value="<?= $narasumber; ?>" type="text" readonly></input>
        <!-- <input name="action" id="action" value="inactive" type="text" readonly></input> -->
    </article>
    <div class="d-flex">
        <span class="">
            <img src="<?= base_url('assets/img/avatars/default.png'); ?>" width="36" height="36" class="rounded-circle me-2" alt="Anonim">
        </span>
    </div>
    <div class="flex-grow-1 ">
        <div class=""><strong><?= $penanya; ?> <i class="fa-solid fa-circle-question text-primary"></i></strong><small class="text-muted"> (<?= $created_at_carbon; ?>)</small></div>
        <div><small class="text-muted">Narasumber: <?= @$narasumber; ?></small></div>
        <span class="closest_isi_pertanyaan">
            <div class="textbox border p-2 mt-1 text-break rounded position-relative">
                <!-- <a data-bs-toggle="modal" data-bs-target="#modal_pertanyaan"> -->
                <?php if ($id_notulis == $user['id']) : ?>
                    <a class="modal_pertanyaan">
                        <span class="linkSpanner"></span>
                    </a>
                <?php endif; ?>
                <div id="isi_pertanyaan" style="max-height: 100px; overflow-y: hidden; transition: all 0.3s ease-out;">
                    <div id="isi_text_pertanyaan">
                        <?= nl2br(htmlspecialchars($row['isi_pertanyaan'])); ?>
                    </div>
                </div>
            </div>
            <div class="d-none" id="baca_lengkap"><a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a></div>
        </span>
        <?php if ($row['valid'] === '1' && $row['deleted'] == null) : ?>
            <!-- <div class="card-title mt-2">Jawaban :</div> -->
            <div class="col-12 d-flex" id="balasan">
                <span class="mt-2">
                    <img src="<?= base_url('assets/img/avatars/' . $penjawab['image'] . ''); ?>" width="36" height="36" class="rounded-circle me-2" alt="Anonim">
                </span>
                <div class="flex-grow-1 mt-2">
                    <div class="<?= $color_admin; ?>">
                        <strong><?= $admin; ?> <i class="fas fa-badge-check text-success"></i></strong>
                    </div>
                    <small class="text-muted"><?= $answered_at_carbon; ?> <span id="update_at"><?= $answer_updated_at; ?></span></small>
                    <div class="closest_isi_pertanyaan" id="closest_isi_pertanyaan">
                        <div class="textbox border p-2 mt-1 text-break rounded">
                            <!-- <a data-bs-toggle="modal" data-bs-target="#modal_pertanyaan"> -->
                            <div id="isi_pertanyaan" style="max-height: 100px; overflow-y: hidden; transition: all 0.3s ease-out;">
                                <div id="isi_text_pertanyaan">
                                    <?= nl2br(htmlspecialchars($row['isi_jawaban'])); ?>
                                </div>
                            </div>
                            <div class="edit-pertanyaan input-group">
                                <div class="input-group comment">
                                    <textarea type="text" class="form-control d-none" placeholder="Edit pertanyaan.." id="input_edit_pertanyaan" data-textarea="1"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-none" id="baca_lengkap"><a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($id_notulis != $user['id']) : ?>
            <div class="py-1"></div>
        <?php endif; ?>
        <div class="pt-0 d-flex align-items-center">
            <?php if ($row['approved'] == null && $row['valid'] == null && $row['deleted'] == null && $id_notulis == $user['id']) : ?>
                <a class="btn btn-danger ms-auto mt-2" id="reject">Reject</a>
                <a class="btn btn-success ms-1 mt-2" id="approve">Approve</a>
                <!-- <a class="btn btn-primary ms-1 mt-2" id="approve"><span class="spinner-grow spinner-grow-sm fw-bold fs-2 spinner-border-sm" role="status"></span></a> -->
            <?php endif; ?>
            <?php if ($row['approved'] === '1' && $row['valid'] == null && $row['deleted'] == null && $id_notulis == $user['id']) : ?>
                <a class="btn btn-success ms-auto mt-2" id="btn_approved">Approved <i class="far fa-check"></i></a>
                <a class="btn btn-outline-secondary ms-1 mt-2" id="btn_publish"><i class="fas fa-arrow-up"></i> Publish</a>
            <?php endif; ?>
            <?php if ($row['valid'] === '1' && $row['deleted'] == null && $id_notulis == $user['id']) : ?>
                <a class="btn btn-sm btn-danger ms-auto mt-1 rounded d-none" id="btn_batal_edit_pertanyaan"></i>Batal</a>
                <?= $btn_ubah_jawaban; ?>
                <?= $hapus_pertanyaan; ?>
            <?php endif; ?>
            <!-- <a class="btn btn-danger ms-auto mt-2" id="delete"><i class="fad fa-trash-alt"></i></a> -->
            <?php if ($row['deleted'] === '1' && $id_notulis == $user['id']) : ?>
                <a class="btn btn-secondary ms-auto mt-2" id="restore"><i class="fad fa-trash-restore"></i> Restore</a>
            <?php endif; ?>
        </div>
    </div>
</main>