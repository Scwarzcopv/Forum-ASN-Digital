<style>
    .box {
        cursor: pointer;
        transition: 0.2s;
    }

    .box:hover {
        transform: scale(1.05);
        z-index: 2;
        box-shadow: 2px 2px 2px #000;

    }
</style>
<main class="content">
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
</main>




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