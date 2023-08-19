<?php
($komentar_active == 1 || $user['role_id'] < 3) ? ($komentar_active = null) : ($komentar_active = 'disabled');

// Penanya
$anonim = null; // 
$color_anonim = null; // 
($user['id'] != $row['id_user_tanya']) ? ($anonim = 'Anonim-' . $row['index'] . ' <i class="fa-solid fa-circle-question text-primary"></i>') : ($anonim = 'Anonim-Anda  <i class="fa-solid fa-circle-question text-primary"></i>');
($user['id'] != $row['id_user_tanya']) ? ($color_anonim = null) : ($color_anonim = 'text-warning');

// Penjawab
$admin = null; // 
$color_admin = null; // 
($user['id'] !== $row['id_admin']) ? ($admin = $row['id_penjawab']['name']) : ($admin = 'Anda');
($user['id'] !== $row['id_admin']) ? ($color_admin = 'text-info') : ($color_admin = 'text-danger');

$answer_updated_at = null; // 
($row['answered_at'] !== $row['updated_at_fp_carbon']) ? ($answer_updated_at = '<br class="d-md-none"><span class="text-navy">( <i class="fad fa-edit"></i> Diedit ' . $row["updated_at_fp_carbon"] . ' )</span>') : ($answer_updated_at = null);

$hapus_pertanyaan = null; // 
$btn_ubah_jawaban = null; // 
if ($user['role_id'] <= 2) {
    $hapus_pertanyaan = '<a class="btn btn-sm btn-outline-danger mt-1 float-end rounded" id="btn_hapus_pertanyaan"><i class="fa-solid fa-trash-can"></i> Hapus</a>';
    if ($user['id'] === $row['id_admin']) {
        $btn_ubah_jawaban = '<a class="btn btn-sm btn-info mt-1 float-end rounded" id="btn_ubah_komentar"><i class="fa-solid fa-pen-clip"></i> Ubah</a>';
    }
}
?>

<section class="d-flex align-items-start closest">
    <!-- LIST DAYA -->
    <article class="d-none data-closest">
        <input name="id_fp" value="<?= $row['id_fp']; ?>" type="text" readonly></input>
        <input name="id_forum" value="<?= $row['id_forum']; ?>" type="text" readonly></input>
        <input name="id_user_tanya" value="<?= $row['id_user_tanya']; ?>" type="text" readonly></input>
        <input name="index_user_tanya" value="<?= $row['index']; ?>" type="text" readonly></input>
        <input name="nama_user_tanya" value="Anonim-<?= $row['index']; ?>" type="text" readonly></input>
        <input name="user_id" value="<?= $user['id']; ?>" type="text" readonly></input>
        <input name="start" id="start" value=0 type="text" readonly></input>
        <!-- <input name="action" id="action" value="inactive" type="text" readonly></input> -->
    </article>

    <div>
        <span class="pe-2">
            <img src="<?= base_url('assets/img/avatars/default.png'); ?>" width="36" height="36" class="rounded-circle me-2" alt="Anonim">
        </span>
    </div>
    <div class="flex-grow-1">
        <!-- PERTANYAAN -->
        <main id="isi_pertanyaan">
            <article> <strong class="<?= $color_anonim; ?>"><?= $anonim; ?></strong> </article>
            <article> <small class="text-muted"><?= $row['created_at_fp_carbon']; ?></small> </article>
            <article class="textbox border p-2 mt-1"> <?= nl2br(htmlspecialchars($row['isi_pertanyaan'])); ?> </article>

            <!-- Button -->
            <a class="btn btn-lg rounded mb-md-3 ps-0 pe-2 border-0" style="cursor: default;">
                <input class="checkbox" type="checkbox" id="checkbox_<?= $row['id_forum']; ?>_<?= $row['id_fp']; ?>" />
                <label class="m-0 p-0 d-flex justify-content-center align-content-stretch cursor-pointer" for="checkbox_<?= $row['id_forum']; ?>_<?= $row['id_fp']; ?>">
                    <svg class="m-0 p-0" id="heart-svg" viewBox="467 392 58 57">
                        <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                            <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="#AAB8C2" />
                            <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5" />

                            <g id="grp7" opacity="0" transform="translate(7 6)">
                                <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2" />
                                <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2" />
                            </g>

                            <g id="grp6" opacity="0" transform="translate(0 28)">
                                <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2" />
                                <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2" />
                            </g>

                            <g id="grp3" opacity="0" transform="translate(52 28)">
                                <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2" />
                                <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2" />
                            </g>

                            <g id="grp2" opacity="0" transform="translate(44 6)">
                                <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2" />
                                <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2" />
                            </g>

                            <g id="grp5" opacity="0" transform="translate(14 50)">
                                <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2" />
                                <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2" />
                            </g>

                            <g id="grp4" opacity="0" transform="translate(35 50)">
                                <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2" />
                                <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2" />
                            </g>

                            <g id="grp1" opacity="0" transform="translate(24)">
                                <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2" />
                                <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2" />
                            </g>
                        </g>
                    </svg>
                    <div class="my-auto pt-1"><?= $row['total_like_fp']; ?></div>
                </label>
            </a>
            <a class="btn btn-lg mt-1 mb-md-3 px-1 border-0 <?= $komentar_active; ?>" id="tampil_balas"><i class="fad fa-reply"></i> Balas</a>
            <?= $hapus_pertanyaan; ?>
            <a class="btn btn-lg mt-md-1 mb-3 px-1 border-0" id="tampil_balasan"><i class="fad fa-chevron-right" id="chevron_right" style="transition: all 0.5s;"></i> Tampilkan Balasan</a>
            <!-- Form reply pertanyaan -->
            <div class="d-none" id="balas"></div>
        </main>
        <!-- JAWABAN -->
        <main id="balasan" class="d-none">
            <!-- ANSWER QUESION -->
            <article class="d-flex align-items-start mt-1 sub-closest" id="isi_jawaban">
                <!-- LIST SUB DAYA -->
                <article class="d-none data-sub-closest">
                    <input name="id_user_admin" value="<?= $row['id_admin']; ?>" type="text" readonly></input>
                </article>

                <span class="pe-2">
                    <img src="<?= base_url('assets/img/avatars/' . $row['id_penjawab']['image']); ?>" width="36" height="36" class="rounded-circle me-2" alt="Admin">
                </span>
                <div class="flex-grow-1">
                    <strong class="<?= $color_admin; ?>"> <?= $admin; ?> <i class="fas fa-badge-check text-success"></i></strong> membalas <strong class="<?= $color_anonim; ?>"> <?= $anonim; ?> </strong>
                    <br />
                    <small class="text-muted"><?= $row['answered_at_carbon']; ?> <?= $answer_updated_at; ?></small>
                    <div class="textbox border p-2 mt-1">
                        <span id="isi_komentar"><?= nl2br(htmlspecialchars($row['isi_jawaban'])); ?></span>
                        <div class="edit-comment input-group">
                            <textarea type="text" class="form-control d-none" placeholder="Edit komentar.." id="input_edit_komentar" data-textarea="1"></textarea>
                        </div>
                    </div>

                    <!-- Button -->
                    <a class="btn btn-lg rounded ps-0 pe-2 border-0" style="cursor: default;" id="suka_komentar">
                        <input class="checkbox" type="checkbox" id="checkbox_answered_<?= $row['id_fp']; ?>" />
                        <label class="m-0 p-0 d-flex justify-content-center align-content-stretch cursor-pointer" for="checkbox_answered_<?= $row['id_fp']; ?>">
                            <svg class="m-0 p-0" id="heart-svg" viewBox="467 392 58 57">
                                <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                                    <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="#AAB8C2" />
                                    <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5" />

                                    <g id="grp7" opacity="0" transform="translate(7 6)">
                                        <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2" />
                                        <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2" />
                                    </g>

                                    <g id="grp6" opacity="0" transform="translate(0 28)">
                                        <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2" />
                                        <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2" />
                                    </g>

                                    <g id="grp3" opacity="0" transform="translate(52 28)">
                                        <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2" />
                                        <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2" />
                                    </g>

                                    <g id="grp2" opacity="0" transform="translate(44 6)">
                                        <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2" />
                                        <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2" />
                                    </g>

                                    <g id="grp5" opacity="0" transform="translate(14 50)">
                                        <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2" />
                                        <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2" />
                                    </g>

                                    <g id="grp4" opacity="0" transform="translate(35 50)">
                                        <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2" />
                                        <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2" />
                                    </g>

                                    <g id="grp1" opacity="0" transform="translate(24)">
                                        <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2" />
                                        <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2" />
                                    </g>
                                </g>
                            </svg>
                            <div class="my-auto pt-1"><?= $row['total_like_jawaban']; ?></div>
                        </label>
                    </a>
                    <a class="btn btn-lg px-1 border-0 <?= $komentar_active; ?>" id="balas_komentar"><i class="fa-solid fa-reply"></i> Balas</a>
                    <?= $btn_ubah_jawaban; ?>
                    <a class="btn btn-sm btn-danger float-end rounded mt-1 me-2 d-none" id="btn_batal_edit_komentar"></i>Batal</a>
                    <!-- FORM SUB REPLY -->
                    <main class="d-none" id="sub_balas">
                    </main>
                </div>
            </article>
            <div class="mx-auto d-flex justify-content-center align-items-center" id="tampil_balasan_komentar">
                <a class="btn btn-lg mb-3 mb-md-1 mt-3 mt-lg-0 px-1 py-0 border-0"><i class="fad fa-chevron-right" style="transition: all 0.5s;" id="chevron_right_komentar"></i> Tampilkan Komentar (<span id="total_komentar">0</span>)</a>
            </div>

            <!-- USERS REPLY -->
            <main id="isi_balasan" class="d-none"></main>
            <main id="loader_komentar"></main>

        </main>
        <!-- <hr style="height: 3px; background-color: #333;" class="rounded-5 " /> -->
    </div>
</section>