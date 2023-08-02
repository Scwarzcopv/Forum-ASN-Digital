<article class="col-12 bg-dark mb-3 py-0 pe-0 ps-2 rounded-2 shadow-rapat">
    <div class="card box border_radius-card mb-0" data-id="1">
        <div class="p-3">
            <div class="row">
                <div class="mx-auto col-8 col-sm-2 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0">
                    <div class="col-10 col-sm-8 col-lg-12">
                        <img src="<?= base_url('assets'); ?>/img/icons/discussdark.png" alt="Envelope" class="img-thumbnail-custom rounded mx-auto d-block bg-transparent border-0" />
                    </div>
                </div>
                <div class="<?php echo ($user['role_id'] <= 2) ? 'col-12 col-sm-8 col-lg-9' : 'col-sm-8 col-lg-11'; ?> col-12 my-auto closest">
                    <div class="fw-bold m-0 p-0 card-title"><?= $row['pimpinan_rapat']; ?></div>
                    <div class="m-0 p-0">
                        <a href="<?= base_url('forum/forum_diskusi/' . $row['id']); ?>" target="_blank" class="fs-3 fw-bold m-0 p-0 border-0 text-start lh-1" style="color: rgba(73,80,87,255);"><?= $row['agenda_rapat']; ?></a>
                    </div>
                    <table class="text-break">
                        <tr>
                            <td class="pe-2"><i class="fa-solid fa-calendar-check"></i></td>
                            <td class="text-secondary "><?= $row['tgl_mulai']; ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-envelope-open-text"></i></td>
                            <td class="text-secondary "><?= $row['no_surat']; ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-location-dot"></i></td>
                            <td class="text-secondary "><?= $row['tempat_rapat']; ?></td>
                        </tr>
                    </table>
                    <!-- INPUT HIDDEN -->
                    <input class="d-none" type="text" value="<?= $row['id']; ?>" name="id_forum" readonly></input>
                </div>
                <?php if ($user['role_id'] <= 2) : ?>
                    <div class="col-12 col-sm-2 col-lg-2 user-select-none d-flex align-items-center justify-content-end ">
                        <div class="row ">
                            <div class="col-12 d-flex justify-content-end">
                                <label class="card-title my-auto me-3" id="label_saklar_1" for="active_forum_<?= $row['id']; ?>">Forum</label>
                                <div class="form-check form-switch">
                                    <div class="d-flex align-content-center justify-content-start d-none p-0 m-0" id="spinner_saklar_1">
                                        <div class="spinner-border text-primary m-0 p-0" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <input class="form-check-input" type="checkbox" name="active_forum" id="active_forum_<?= $row['id']; ?>" style="width: 40px; height: 20px;" <?php if ($row['forum_active'] == 1) echo 'checked'; ?>>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end py-1">
                                <label class="card-title my-auto me-3" id="label_saklar_2" for="active_tanya_<?= $row['id']; ?>">Pertanyaan</label>
                                <div class="form-check form-switch">
                                    <div class="d-flex align-content-center justify-content-start d-none p-0 m-0" id="spinner_saklar_2">
                                        <div class="spinner-border text-primary m-0 p-0" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <input class="form-check-input" type="checkbox" name="active_tanya" id="active_tanya_<?= $row['id']; ?>" style="width: 40px; height: 20px;" <?php if ($row['tanya_active'] == 1) echo 'checked'; ?>>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <label class="card-title my-auto me-3" id="label_saklar_3" for="active_komentar_<?= $row['id']; ?>">Komentar</label>
                                <div class="form-check form-switch">
                                    <div class="d-flex align-content-center justify-content-start d-none p-0 m-0" id="spinner_saklar_3">
                                        <div class="spinner-border text-primary m-0 p-0" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <input class="form-check-input" type="checkbox" name="active_komentar" id="active_komentar_<?= $row['id']; ?>" style="width: 40px; height: 20px;" <?php if ($row['komentar_active'] == 1) echo 'checked'; ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>