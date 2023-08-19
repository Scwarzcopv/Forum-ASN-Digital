<div class="box col-12 bg-primary mb-3 py-0 pe-0 ps-2 rounded-2 shadow-rapat">
    <div class="card border_radius-card mb-0" data-id="1">
        <div class="p-3">
            <div class="row">
                <div class="mx-auto col-8 col-sm-2 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0">
                    <div class="col-10 col-sm-8 col-lg-12">
                        <img src="<?= base_url('assets'); ?>/img/icons/envelope2.png" alt="Envelope" class="img-thumbnail-custom rounded mx-auto d-block bg-transparent border-0" />
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-lg-9 my-auto closest">
                    <div class="fw-bold m-0 p-0 card-title"><?= $row['pimpinan_rapat']; ?></div>
                    <div class="m-0 p-0">
                        <a class="fs-3 fw-bold m-0 p-0 border-0 text-primary text-start lh-1 hover-underline-animation" data-id="<?= $row['agenda_rapat']; ?>" id="triggerModal"><?= $row['agenda_rapat']; ?></a>
                    </div>
                    <div class=""><?= $row['no_surat']; ?></div>
                    <!-- INPUT HIDDEN -->
                    <input class="d-none" type="text" value="<?= $row['no_surat']; ?>" name="no_surat" readonly></input>
                    <input class="d-none" type="text" value="<?= $row['agenda_rapat']; ?>" name="agenda_rapat" readonly></input>
                    <input class="d-none" type="text" value="<?= $row['penyelenggara']; ?>" name="penyelenggara" readonly></input>
                    <input class="d-none" type="text" value="<?= $row['pimpinan_rapat']; ?>" name="pimpinan_rapat" readonly></input>
                    <input class="d-none" type="text" value="<?= $row['tgl_mulai']; ?>" name="mulai_rapat" readonly></input>
                </div>
                <div class="col-12 col-sm-2 col-lg-2 my-auto">
                    <button class="btn fs-3 fw-bold m-0 p-0 border-0 text-secondary lh-1 float-end me-lg-3" id="download"><i class="fa-solid fa-download fa-lg"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>