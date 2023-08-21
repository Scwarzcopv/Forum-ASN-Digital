<?php
($komentar_active == 1 || $user['role_id'] < 3) ? ($komentar_active = null) : ($komentar_active = 'disabled');
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
$_result_updated_at = null;
if ($row['updated_at'] != $row['created_at']) {
    $_result_updated_at =  '<br class="d-md-none"><span class="text-navy">( <i class="fad fa-edit"></i> Diedit ' . $row['updated_at_carbon'] . ' )</span>';
}

//================================================================
$result_hapus_komentar = null;
if ($user['id'] === $data_user_komen['id'] || $user['role_id'] <= 2) {
    $result_hapus_komentar =  '<a class="btn btn-sm btn-outline-danger mt-1 mb-2 float-end rounded ms-2" id="btn_hapus_komentar"><i class="fa-solid fa-trash-can"></i> Hapus</a>';
}

//================================================================
$result_btn_ubah_komentar = null;
if ($user['id'] === $data_user_komen['id']) {
    $result_btn_ubah_komentar =  '<a class="btn btn-sm btn-info mt-1 mb-2 float-end rounded" id="btn_ubah_komentar"><i class="fa-solid fa-pen-clip"></i> Ubah</a>';
}
?>


<article class="d-flex align-items-start sub-closest">
    <!-- LIST SUB DAYA -->
    <article class="mt-1 d-none data-sub-closest">
        <input name="id_fc" value="<?= $row['id']; ?>" type="text" readonly></input>
        <input name="id_user_fc" value="<?= $row['id_user']; ?>" type="text" readonly></input>
        <input name="parent_anonim" value="<?= $row['parent_anonim']; ?>" type="text" readonly></input>
    </article>

    <span class="pe-2">
        <img src="<?= base_url('assets/img/avatars/' . $data_user_komen['image']); ?>" width="36" height="36" class="rounded-circle me-2" alt="User">
    </span>
    <div class="flex-grow-1">
        <?= $result_user_komen . $result_user_komen_parent; ?>
        <br />
        <small class="text-muted"><?= $row['created_at_carbon']; ?> <span id="update_at"><?= $_result_updated_at; ?></span></small>
        <span class="closest_isi_komentar">
            <div class="textbox border p-2 mt-1 text-break">
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

        <!-- Button -->
        <a class="btn btn-lg rounded mb-1 ps-0 pe-2 border-0" style="cursor: default;" id="suka_komentar">
            <input class="checkbox" type="checkbox" id="checkbox_komentar_<?= $row['id']; ?>_<?= $row['id_forum']; ?>_<?= $row['id_forum_pertanyaan'] ?>" />
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
                <div class="my-auto pt-1"><?= $row['total_like']; ?></div>
            </label>
        </a>
        <a class="btn btn-lg mt-1 mb-1 px-1 border-0 <?= $komentar_active; ?>" id="balas_komentar"><i class="fad fa-reply"></i> Balas</a>
        <?= $result_hapus_komentar; ?>
        <?= $result_btn_ubah_komentar; ?>
        <a class="btn btn-sm btn-danger mt-1 float-end rounded me-2 d-none" id="btn_batal_edit_komentar"></i>Batal</a>
        <!-- FORM SUB REPLY -->
        <main class="d-none" id="sub_balas">
        </main>
    </div>
</article>