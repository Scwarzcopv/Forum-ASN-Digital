<?php
($komentar_active == 1 || $user['role_id'] < 3) ? ($komentar_active = null) : ($komentar_active = 'd-none');
// =================================================================
// Color User Komen
$user_komen = null;
$color_user_komen = null;
$result_user_komen = null;
if ($user['id'] !== $data_user_komen['id']) {
    $user_komen = $data_user_komen['name'];
    if ($data_user_komen['role_id'] <= 2) {
        $color_user_komen = 'text-info';
    } else {
        $color_user_komen = null;
    }
} else {
    $user_komen = 'Anda';
    $color_user_komen = 'text-danger';
}

// Pembedaan role pengomentar
if ($data_user_komen['role_id'] <= 2) {
    $result_user_komen = '<strong class="' . $color_user_komen . '">' . $user_komen . ' <i class="fas fa-badge-check text-success"></i></strong>';
} else {
    $result_user_komen = '<strong class="' . $color_user_komen . '">' . $user_komen . '</strong>';
}

// =================================================================
// Color Parent User Komen
$user_komen_parent = null;
$color_user_parent = null;
$result_user_komen_parent = null;
// Pembedaan role parent pengomentar
if ($row['id_parent'] != null) {
    if ($user['id'] !== $data_user_parent['id']) {
        $user_komen_parent = $data_user_parent['name'];
        if ($data_user_parent['role_id'] <= 2) {
            $color_user_parent = 'text-info';
        } else {
            $color_user_parent = null;
        }
    } else {
        $user_komen_parent = 'Anda';
        $color_user_parent = 'text-danger';
    }

    if ($data_user_parent['role_id'] <= 2) {
        $result_user_komen_parent = ' membalas <strong class="' . $color_user_parent . '">' . $user_komen_parent . ' <i class="fas fa-badge-check text-success"></i></strong>';
    } else {
        $result_user_komen_parent = ' membalas <strong class="' . $color_user_parent . '">' . $user_komen_parent . '</strong>';
    }
}
if ($row['parent_anonim'] == 1) {
    if ($user['id'] == $id_user_tanya) {
        $result_user_komen_parent = ' membalas <strong class="">' . $nama_user_tanya . ' <span class="text-danger">(Anda)</span> <i class="fa-solid fa-circle-question text-primary"></i></strong>';
    } else {
        $result_user_komen_parent = ' membalas <strong>' . $nama_user_tanya . ' <i class="fa-solid fa-circle-question text-primary"></i></strong>';
    }
}
//================================================================
// Tampilan komentar pada admin
$style_text_commentar = null;
$bg_text_commentar = null;
$btn_disabled = null;
if ($row['forum_comment_hidden'] !== null || $row['forum_comment_del_by_user'] !== null) {
    $style_text_commentar = 'style = "opacity: 0.5;"';
    $btn_disabled = 'disabled';
}
if ($row['forum_comment_hidden'] !== null) {
    $bg_text_commentar = 'text-light bg-secondary';
}
if ($row['forum_comment_del_by_user'] !== null) {
    $bg_text_commentar = 'text-light bg-danger';
}

//================================================================
$_result_updated_at = null;
if ($row['updated_at'] !== $row['created_at']) {
    $_result_updated_at =  '<br class="d-md-none"><span class="text-navy">( <i class="fad fa-edit"></i> Diedit ' . $row['updated_at_carbon'] . ' )</span>';
}

//================================================================
$user['role_id'] = (int)$user['role_id'];

$btn_hapus_komentar = null;
if ($user['role_id'] <= 2) {
    $btn_hapus_komentar =  '<a class="btn btn-sm btn-outline-danger mt-1 mb-2 rounded ms-1" id="btn_hapus_komentar"><i class="fa-solid fa-trash-can"></i></a>';
}

//================================================================
$btn_hide_komentar = null;
if ($user['id'] === $data_user_komen['id'] || $user['role_id'] <= 2) {
    $btn_hide_komentar =  '<a class="btn btn-sm btn-danger mt-1 mb-2 rounded ms-1" id="btn_hide_komentar"><i class="fas fa-eye"></i> <span class="d-none d-lg-inline-flex">Hide</span></a>'; // Tampilan (admin) jika komentar tidak dihapus user / hidden
    if ($row['forum_comment_hidden'] !== null) {
        $btn_hide_komentar = '<a class="btn btn-sm btn-danger mt-1 mb-2 rounded ms-1" id="btn_hide_komentar"><i class="fas fa-eye-slash fa-flip-horizontal"></i> <span class="d-none d-lg-inline-flex">Show</span></a>'; // Tampilan (admin) jika komentar hidden
    }
    if ($user['role_id'] > 2 && $row['forum_comment_hidden'] === null) {
        $btn_hide_komentar =  '<a class="btn btn-sm btn-outline-danger mt-1 mb-2 rounded ms-1" id="btn_hide_komentar"><i class="fa-solid fa-trash-can"></i></a>'; // Tampilan khusus untuk selain admin (HAPUS)
    } else if ($user['role_id'] > 2 && $row['forum_comment_hidden'] !== null) {
        $btn_hide_komentar = null;
    }
}
if ($user['id'] !== $data_user_komen['id']) {
    if ($row['forum_comment_del_by_user'] !== null) { // Tampilan (admin) jika komentar user dihapus oleh user
        $btn_hide_komentar = null;
    }
}

//================================================================
$btn_ubah_komentar = null;
if ($user['id'] === $data_user_komen['id']) {
    $btn_ubah_komentar =  '<a class="btn btn-sm btn-info mt-1 mb-2 rounded" id="btn_ubah_komentar"><i class="fa-solid fa-pen-clip"></i> <span class="d-none d-lg-inline-flex">Ubah</span></a>';
}
if ($user['role_id'] > 2 && $row['forum_comment_hidden'] !== null) {
    $btn_ubah_komentar =  null;
}

// Komen heart
$C = null;
(@$Comment == true) ? ($C = 'checked') : ($C = null);
?>


<article class="d-flex align-items-start sub-closest">
    <!-- LIST SUB DAYA -->
    <article class="mt-1 d-none data-sub-closest">
        <input name="id_fc" value="<?= $row['id']; ?>" type="text" readonly></input>
        <input name="id_user_fc" value="<?= $row['id_user']; ?>" type="text" readonly></input>
        <input name="parent_anonim" value="<?= $row['parent_anonim']; ?>" type="text" readonly></input>
    </article>

    <span class="pe-md-2" id="avatar" <?= $style_text_commentar; ?>>
        <img src="<?= base_url('assets/img/avatars/' . $data_user_komen['image']); ?>" width="36" height="36" class="rounded-circle me-2" alt="User">
    </span>
    <div class="flex-grow-1">
        <div id="content-sub-closest" <?= $style_text_commentar; ?>>
            <?= $result_user_komen . $result_user_komen_parent; ?>
            <br />
            <small class="text-muted"><?= $row['created_at_carbon']; ?> <span id="update_at"><?= $_result_updated_at; ?></span></small>
            <span class="closest_isi_komentar">
                <div class="textbox border p-2 mt-1 text-break rounded <?= $bg_text_commentar; ?>">
                    <div id="isi_text_komentar" style="max-height: 100px; overflow-y: hidden; transition: all 0.3s ease-out;">
                        <div id="isi_komentar">
                            <?= nl2br(htmlspecialchars($row['isi_comment'])); ?>
                        </div>
                    </div>
                    <div class="edit-comment input-group">
                        <textarea type="text" class="form-control d-none" placeholder="Edit komentar.." id="input_edit_komentar" data-textarea="1"></textarea>
                    </div>
                </div>
                <div class="d-none" id="baca_lengkap"><a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a></div>
            </span>
        </div>

        <!-- Button -->
        <div class="row">
            <div class="col-12 pt-0 d-flex align-items-center ">
                <a class="btn btn-lg rounded mb-1 ps-0 pe-2 border-0 <?= $btn_disabled; ?>" style="cursor: default;" id="suka_komentar" <?= $style_text_commentar; ?>>
                    <input class="checkbox suka_komentar" type="checkbox" id="checkbox_komentar_<?= $row['id']; ?>_<?= $row['id_forum']; ?>_<?= $row['id_forum_pertanyaan'] ?>" <?= $C; ?> />
                    <label class="m-0 p-0 d-flex justify-content-center align-content-stretch cursor-pointer" for="checkbox_komentar_<?= $row['id']; ?>_<?= $row['id_forum']; ?>_<?= $row['id_forum_pertanyaan'] ?>">
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
                        <div class="my-auto pt-1 total_suka_komentar"><?= $row['total_like']; ?></div>
                    </label>
                </a>
                <a class="btn btn-lg mt-1 mb-1 px-1 border-0 <?= $komentar_active; ?> <?= $btn_disabled; ?>" id="balas_komentar" <?= $style_text_commentar; ?>><i class="fad fa-reply"></i> Balas</a>
                <div class="ms-auto d-flex ">
                    <a class="btn btn-sm btn-danger mt-1 mb-2 rounded me-1 d-none" id="btn_batal_edit_komentar"></i>Batal</a>
                    <?= $btn_ubah_komentar; ?>
                    <?= $btn_hide_komentar; ?>
                    <?= $btn_hapus_komentar; ?>
                </div>
            </div>
            <div class="col-12 col-lg-8 pt-0">
            </div>
        </div>
        <!-- FORM SUB REPLY -->
        <main class="d-none" id="sub_balas">
        </main>
    </div>
</article>