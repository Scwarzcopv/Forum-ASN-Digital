<style>
    /* .box {
        cursor: pointer;
        transition: 0.2s;
    }

    .box:hover {
        transform: scale(1.01);
        z-index: 2;
        box-shadow: 2px 2px 2px #000;

    } */
</style>

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 bg-dark mb-3 py-0 pe-0 ps-2 rounded-2 shadow-rapat">
                <div class="card box border_radius-card mb-0" data-id="1">
                    <div class="p-3">
                        <div class="row">
                            <div class="mx-auto col-8 col-sm-4 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0">
                                <div class="col-12">
                                    <img src="<?= base_url('assets'); ?>/img/icons/discussdark.png" alt="Envelope" class="img-thumbnail-custom rounded mx-auto d-block bg-transparent border-0" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-lg-11 my-auto">
                                <div class="fw-bold m-0 p-0 card-title">KADIN OPD UJI COBA 1</div>
                                <div class="m-0 p-0">
                                    <a href="" class="fs-3 fw-bold m-0 p-0 border-0 text-start lh-1 " style="color: rgba(73,80,87,255);">Fraud Detection and Investigation, and Prevention at Digital Era</a>
                                </div>
                                <table class="text-break">
                                    <tr>
                                        <td class="pe-2"><i class="fa-solid fa-calendar-check"></i></td>
                                        <td class="text-secondary ">Kamis, 20 Juli 2023</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa-solid fa-envelope-open-text"></i></td>
                                        <td class="text-secondary ">005/535/000.000/2023</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa-solid fa-location-dot"></i></td>
                                        <td class="text-secondary ">Kediriiiiiiiiiiiiiiiiii</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- <main class="content">
    <div class="container-fluid p-0">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-3" id="card_forum" name="card_forum">
                <div class="card box" data-id="1">
                    <div class="card-header px-4 pt-4">
                        <h5 class="card-title mb-0">Cek Kesehatan</h5>
                        <div class="badge my-2 bg-info text-wrap"> KADIN OPD UJI COBA 1</div>
                    </div>
                    <div class="card-body px-4 pt-2">
                        <table class="text-break">
                            <tr>
                                <td class="pe-2"><i class="fa-solid fa-calendar-check"></i></td>
                                <td>Kamis, 20 Juli 2023</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-envelope-open-text"></i></td>
                                <td>005/535/000.000/2023</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-location-dot"></i></td>
                                <td>Kediriiiiiiiiiiiiiiiiii</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main> -->




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script>
    // function click() {
    //     $('#card_forum').click(function() {
    //         Swal.fire('Success', 'aa')
    //     })
    // }

    // $(document).ready(function() {
    //     click();
    // })
</script>