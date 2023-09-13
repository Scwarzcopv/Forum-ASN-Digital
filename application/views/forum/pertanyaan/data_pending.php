<main class="closest">
    <!-- LIST DAYA -->
    <article class="d-none data-closest">
        <input name="key_narasumber" id="key_narasumber" value=<?= @$key_narasumber; ?> type="text" readonly></input>
        <input name="narasumber" id="narasumber" value="<?= @$narasumber; ?>" type="text" readonly></input>
        <input name="start" id="start" value=0 type="text" readonly></input>
        <!-- <input name="action" id="action" value="inactive" type="text" readonly></input> -->
    </article>
    <strong class="card-title">Narasumber: <?= @$narasumber; ?></strong>
    <a class="btn btn-lg px-2 pb-0 border-0 d-flex align-items-center fw-bold text-secondary" id="tampil_pertanyaan"><i class="fad fa-chevron-right me-2" id="chevron_right" style="transition: all 0.5s;"></i><span class="d-none d-md-block me-1">Tampilkan</span> Pertanyaan (<span id="total_pertanyaan"><?= $total_sub_pertanyaan_pending; ?></span>)</a>

    <div class="row d-none" id="load_isi_pertanyaan"></div>
    <div id="loader_pending"></div>

    <hr style="height: 3px; background-color: #333;" class="rounded-5 ">
</main>