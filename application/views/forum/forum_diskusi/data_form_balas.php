<?php
$id_user = $user_id['id'];
$id_parent = $id_user_parent['id'];

//================================================
// Cek apakah anda admin || buat fa-check admin
$fa_check = null;
if ($user_id['role_id'] <= 3) {
    $fa_check = '<i class="fas fa-badge-check text-success"></i>';
}

//================================================
// GET NAMA PARENT
$nama_parent = null;
$parent = null;
$d_none = null;
$mt = null;
// Jika yang dibalas anonim
if ($nama_user_tanya !== null) {
    $nama_parent = $nama_user_tanya;
    if ($id_user === $id_parent) {
        $parent = 'membalas <strong class="text-warning">Anonim-Anda</strong>';
    } else {
        $parent = 'membalas <strong>' . $nama_parent . ' <i class="fa-solid fa-circle-question text-primary"></i></strong>';
    }
} else {
    // Jika yang dibalas bukan anonim ataupun diri sendiri
    if ($id_user !== $id_parent) {
        $nama_parent = $id_user_parent['name'];
        $parent = 'membalas <strong>' . $nama_parent . '</strong>';
        //================================================
        // Cek apakah parent user admin atau bukan
        if ($id_user_parent['role_id'] <= 2) {
            $parent = 'membalas <strong class="text-info">' . $nama_parent . ' ' . $fa_check . '</strong>';
        }
    } else {
        $mt = "mt-3";
        $d_none = 'd-none';
    }
}

?>

<div class="d-flex align-items-start mt-1 mb-2 closest-form">
    <span class="pe-2">
        <img src="<?= base_url('assets/img/avatars/' . $user_id['image'] . ''); ?>" width="36" height="36" class="rounded-circle me-2" alt="User">
    </span>
    <div class="flex-grow-1 form-komentar">
        <strong class="text-danger">Anda <?= $fa_check; ?></strong> <span id="parent"> <?= $parent; ?> </span>
        <div class="form-check form-switch form-control-lg user-select-none px-0 pt-0 mt-0 mb-1 <?= $d_none; ?>">
            <input class="form-check-input ms-0 me-1 switch_balasan" type="checkbox" role="switch" id="switch_balasan_<?= $id_fp; ?>_<?= $id_fc; ?>" value="<?= $fp['id_user_tanya']; ?>" checked name="switch_balasan">
            <label class="form-check-label mx-0" for="switch_balasan_<?= $id_fp; ?>_<?= $id_fc; ?>"> Show parent</label>
        </div>
        <!-- <small class="text-muted"></small> -->
        <div class="text-sm text-muted mb-3 <?= $mt; ?>">
            <div class="input-group comment">
                <textarea type="text" class="form-control mb-2" placeholder="Tambahkan komentar.." id="input_komentar" name="input_komentar" data-textarea="1"></textarea>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-success ms-auto" id="btn_send"><i class="fa-solid fa-paper-plane"></i> Send</button>
            </div>
        </div>
    </div>
</div>