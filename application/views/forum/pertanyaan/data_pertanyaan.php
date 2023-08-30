<!-- <article class="box col-12 bg-dark mb-3 py-0 pe-0 ps-2 rounded-2 shadow-rapat"> -->
<main class="">
    <article class="taget-box col-12 bg-dark mb-3 py-0 pe-0 ps-2 rounded-2 position-relative cursor-pointer">
        <a href="<?= base_url('forum/data_pertanyaan/' . $row['id'] . ''); ?>">
            <span class="linkSpanner"></span>
        </a>
        <div class="card border_radius-card mb-0" data-id="1">
            <div class="p-3">
                <div class="row">
                    <div class="<?php echo ($user['role_id'] <= 2) ? 'col-12 col-sm-8 col-lg-9' : 'col-sm-8 col-lg-11'; ?> col-12 my-auto card-button closest">
                        <!-- LIST DAYA -->
                        <article class="d-none">
                            <input name="id_forum" value="<?= $row['id']; ?>" type="text" readonly></input>
                        </article>
                        <!--  -->
                        <div class="fw-bold m-0 p-0 card-title"><?= $row['pimpinan_rapat']; ?></div>
                        <div class="m-0 p-0">
                            <a class="fs-3 fw-bold m-0 p-0 border-0 text-start lh-1 hover-underline-animation" style="color: rgba(73,80,87,255);"><?= $row['agenda_rapat']; ?></a>
                        </div>
                        <!-- <table class="text-break">
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
                        </table> -->
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>