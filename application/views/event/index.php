<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 bg-primary m-0 py-0 pe-0 ps-2 rounded-2 shadow-rapat">
                <div class="card box border_radius-card mb-0" data-id="1">
                    <div class="p-3">
                        <div class="row">
                            <div class="mx-auto col-8 col-sm-4 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0">
                                <div class="col-12">
                                    <img src="<?= base_url('assets'); ?>/img/icons/envelope2.png" alt="Envelope" class="img-thumbnail-custom rounded mx-auto d-block bg-transparent border-0" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-9 my-auto">
                                <div class="fw-bold m-0 p-0 card-title">KADIN OPD UJI COBA 1</div>
                                <div class="m-0 p-0">
                                    <button class="btn fs-3 fw-bold m-0 p-0 border-0 text-primary  text-start lh-1 ">Fraud Detection and Investigation, and Prevention at Digital Era</button>
                                </div>
                                <div class="">005/535/000.000/2023</div>
                            </div>
                            <div class="col-12 col-sm-2 col-lg-2 my-auto">
                                <button class="btn fs-3 fw-bold m-0 p-0 border-0 text-secondary lh-1 float-end me-lg-3" id="download"><i class="fa-solid fa-download fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    tippy('#download', {
        content: "Download PDF",
        placement: "bottom",
        delay: [700, 0]
    });
    // $(function() {
    //     $('[data-bs-toggle="tooltip"]').tooltip({
    //         trigger: 'hover'
    //     });

    //     $('[data-bs-toggle="tooltip"]').on('click', function() {
    //         $(this).tooltip('hide')
    //     });
    // });
</script>