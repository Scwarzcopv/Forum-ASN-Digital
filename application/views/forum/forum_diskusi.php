<style>
    .img-carrousel {
        height: 200px;
        object-fit: cover;
    }

    .transition-02 {
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

    .transition-05 {
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }

    .modal-body textarea {
        min-height: 100px !important;
    }
</style>
<main class="content">
    <div class="container-fluid p-0">
        <div class="row  justify-content-end">
            <span class="show_hide text-secondary mb-2 user-select-none" style="cursor: pointer;"><i class="fa-solid fa-circle-chevron-up transition-05"></i><span id="show_hide"> Tampilkan</span> Informasi Kegiatan</span>
            <div class="col-12 col-sm-5 col-lg-4" id="detail_kegiatan">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            Informasi Kegiatan
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="7000">
                                    <img src="img/dokumentasi/dokumentasi1.jpeg" alt="Dokumentasi" class="thumbnails img-fluid mb-2 w-100 img-carrousel rounded-4 px-1" data-large="img/dokumentasi/dokumentasi1.jpeg" />
                                </div>
                                <div class="carousel-item" data-bs-interval="7000">
                                    <img src="img/dokumentasi/dokumentasi2.jpeg" alt="Dokumentasi" class="thumbnails img-fluid mb-2 w-100 img-carrousel rounded-4 px-1" data-large="img/dokumentasi/dokumentasi2.jpeg" />
                                </div>
                                <div class="carousel-item" data-bs-interval="7000">
                                    <img src="img/dokumentasi/dokumentasi3.jpeg" alt="Dokumentasi" class="thumbnails img-fluid mb-2 w-100 img-carrousel rounded-4 px-1" data-large="img/dokumentasi/dokumentasi3.jpeg" />
                                </div>
                                <div class="carousel-item" data-bs-interval="7000">
                                    <img src="img/dokumentasi/dokumentasi4.jpeg" alt="Dokumentasi" class="thumbnails img-fluid mb-2 w-100 img-carrousel rounded-4 px-1" data-large="img/dokumentasi/dokumentasi4.jpeg" />
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left fa-lg"></i></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="" aria-hidden="true"><i class="fa-solid fa-circle-chevron-right fa-lg"></i></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <h5 class="card-title mb-0">Cek Kesehatan</h5>
                        <div class="text-muted mb-2">Kadin OPD Uji Coba 1</div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Detail Kegiatan</h5>
                        <table class="text-break">
                            <tr class="align-baseline">
                                <td class="pe-2"><i class="fa-solid fa-calendar-check"></i></td>
                                <td>Kamis, 20 Juli 2023</td>
                            </tr>
                            <tr class="align-baseline">
                                <td><i class="fa-solid fa-envelope-open-text"></i></td>
                                <td>005/535/000.000/2023</td>
                            </tr>
                            <tr class="align-baseline">
                                <td><i class="fa-solid fa-location-dot"></i></td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia inventore soluta ipsa magni modi quos pariatur assumenda amet, cum accusantium? Minus voluptate asperiores odio a quibusdam perspiciatis assumenda eaque alias!</td>
                            </tr>
                        </table>
                    </div>
                    <hr class="my-0" />
                </div>
            </div>
            <div class="col-12 col-sm-7 col-lg-8 transition-02" id="pertanyaan">
                <div class="card">
                    <div class="card-header d-flex">
                        <h5 class="card-title mb-0">Pertanyaan</h5>
                        <!-- Button trigger modal Tambah Pertanyaan -->
                        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalTambahPertanyaan"><i class="fa-solid fa-plus"></i> Tambah Pertanyaan</button>
                    </div>
                    <div class="card-body h-100">
                        <!-- Modal -->
                        <div class="modal fade" id="modalTambahPertanyaan" tabindex="-1" aria-labelledby="tambahPertanyaanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="tambahPertanyaanLabel">Tambahkan Pertanyaan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <div class="d-flex align-items-start mt-1 mb-2">
                                            <span class="pe-2">
                                                <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                            </span>
                                            <div class="flex-grow-1">
                                                <form action="" method="">
                                                    <strong class="text-danger">Anda</strong>
                                                    <div class="text-sm text-muted">
                                                        *PERTANYAAN AKAN DIVERIFIKASI ADMIN*
                                                        <div class="input-group">
                                                            <textarea type="text" class="form-control min" id="input_pertanyaan" data-textarea="0" placeholder="Tambahkan pertanyaan.."></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Ajukan Pertanyaan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CHAT 2 -->
                        <div class="d-flex align-items-start">
                            <span class="pe-2">
                                <img src="img/avatars/default.png" width="36" height="36" class="rounded-circle me-2" alt="Anonim">
                            </span>
                            <div class="flex-grow-1">
                                <strong>Anonim-User</strong><br />
                                <small class="text-muted">Hari ini 7:21 pm</small>

                                <div class="border p-2 mt-1">
                                    Bagaimana tanggapan anda? tentang Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias aut perspiciatis deserunt vero alias sapiente facere, asperiores magni voluptates ea sed quos ullam autem recusandae modi corrupti. Eos, ducimus perspiciatis.
                                </div>
                                <a href="#" class="btn btn-lg rounded mt-1 mb-3 px-2"><i class="fa-solid fa-thumbs-up"></i><span class="ps-2">1</span></a>
                                <a class="btn btn-lg mt-1 mb-3 px-1" id="tampil_balas"><i class="fa-solid fa-reply"></i> Balas</a>
                                <a class="btn btn-lg mt-1 mb-3 px-1" id="tampil_balasan"><i class="fa-solid fa-chevron-down" id="chevron_down" style="transition: all 0.5s;"></i> Tampilkan Balasan</a>
                                <a href="#" class="btn btn-sm btn-outline-danger mt-1 mb-3 float-end rounded"><i class="fa-solid fa-trash-can"></i> Hapus</a>

                                <!-- FORM REPLY -->
                                <main class="d-none" id="balas">
                                    <div class="d-flex align-items-start mt-1 mb-2">
                                        <span class="pe-2">
                                            <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                        </span>
                                        <div class="flex-grow-1">
                                            <form action="" method="">
                                                <strong class="text-danger">Anda</strong> <span id="parent"> membalas <strong>Anonim-User</strong></span>
                                                <div class="form-check form-switch form-control-lg user-select-none px-0 pt-0 mt-0 mb-1">
                                                    <input class="form-check-input ms-0 me-1" type="checkbox" role="switch" id="switch_balasan" checked>
                                                    <label class="form-check-label mx-0" for="switch_balasan"> Show parent</label>
                                                </div>
                                                <small class="text-muted"></small>
                                                <div class="text-sm text-muted mb-3">
                                                    <div class="input-group">
                                                        <textarea type="text" class="form-control mb-2" placeholder="Tambahkan komentar.." id="input_komentar" data-textarea="1"></textarea>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-paper-plane"></i> Send</button>
                                                        <button type="button" class="btn btn-sm btn-danger ms-auto" data-hapus="1" id="kosongkan_komentar"><i class="fa-solid fa-trash-can"></i> Kosongkan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </main>

                                <main id="balasan" class="d-none">
                                    <!-- ADMIN REPLY -->
                                    <div class="d-flex align-items-start mt-1">
                                        <span class="pe-2">
                                            <img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Admin">
                                        </span>
                                        <div class="flex-grow-1">
                                            <strong class="text-info">Ghost <i class="fa-regular fa-circle-check text-success"></i></strong> membalas
                                            <strong>Anonim-User</strong>
                                            <!-- <strong>Ghost <i class="fa-regular fa-circle-check text-success"></i></strong> membalas <strong>Ghost</strong> -->
                                            <small class="float-end text-navy"><i class="fa-solid fa-pen-clip"></i> Diubah 5m yang lalu</small><br />
                                            <small class="text-muted">Hari ini 7:21 pm</small>
                                            <div class="border p-2 mt-1">
                                                Kalau menurut saya sih, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia repudiandae
                                                voluptate assumenda repellat iure nulla, minus vitae architecto ut consectetur ipsa accusantium, porro ipsam
                                                velit illo eos magnam libero nihil.
                                            </div>
                                            <a href="#" class="btn btn-lg rounded mt-1 mb-1 px-2"><i class="fa-regular fa-thumbs-up"></i><span class="ps-2">99</span></a>
                                            <a href="#" class="btn btn-lg mt-1 mb-1 px-1"><i class="fa-solid fa-reply"></i> Balas</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger mt-1 mb-2 float-end rounded"><i class="fa-solid fa-trash-can"></i>
                                                Hapus</a>
                                            <!-- FORM SUB REPLY -->
                                            <div class="d-flex align-items-start mt-1 mb-2 d-none">
                                                <span class="pe-2">
                                                    <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <strong class="text-danger">Anda</strong> membalas <strong class="text-primary">Ghost</strong>
                                                    <div class="form-check form-switch form-control-lg user-select-none px-0 pt-0 mt-0 mb-1">
                                                        <input class="form-check-input ms-0 me-1" type="checkbox" role="switch" id="switch_balasan2" checked>
                                                        <label class="form-check-label mx-0" for="switch_balasan2"> Show parent</label>
                                                    </div>
                                                    <small class="text-muted"></small>
                                                    <div class="text-sm text-muted mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mb-2" placeholder="Type your message">
                                                        </div>
                                                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-paper-plane"></i> Send</button>
                                                        <button class="btn btn-sm btn-danger float-end "><i class="fa-solid fa-trash-can"></i>
                                                            Batalkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- USERS REPLY -->
                                    <div class="d-flex align-items-start mt-1">
                                        <span class="pe-2">
                                            <img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                        </span>
                                        <div class="flex-grow-1">
                                            <strong>Ouja</strong> membalas <strong class="text-info">Ghost <i class="fa-regular fa-circle-check text-success"></i></strong>
                                            <small class="float-end text-navy"><i class="fa-solid fa-pen-clip"></i> Diubah 5m yang lalu</small><br />
                                            <small class="text-muted">Hari ini 7:21 pm</small>
                                            <div class="border p-2 mt-1">
                                                Kalau menurut saya sih, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia repudiandae
                                                voluptate assumenda repellat iure nulla, minus vitae architecto ut consectetur ipsa accusantium, porro ipsam
                                                velit illo eos magnam libero nihil.
                                            </div>
                                            <a href="#" class="btn btn-lg rounded mt-1 mb-1 px-2"><i class="fa-regular fa-thumbs-up"></i><span class="ps-2">99</span></a>
                                            <a href="#" class="btn btn-lg mt-1 mb-1 px-1"><i class="fa-solid fa-reply"></i> Balas</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger mt-1 mb-2 float-end rounded"><i class="fa-solid fa-trash-can"></i>
                                                Hapus</a>
                                            <!-- FORM SUB REPLY -->
                                            <div class="d-flex align-items-start mt-1 mb-2 d-none">
                                                <span class="pe-2">
                                                    <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <strong class="text-danger">Anda</strong> membalas <strong class="text-primary">Ghost</strong>
                                                    <div class="form-check form-switch form-control-lg px-0 pt-0 mt-0 mb-1">
                                                        <input class="form-check-input ms-0 me-1" type="checkbox" role="switch" id="switch_balasan3" checked>
                                                        <label class="form-check-label mx-0" for="switch_balasan3"> Show parent</label>
                                                    </div>
                                                    <small class="text-muted"></small>
                                                    <div class="text-sm text-muted mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mb-2" placeholder="Type your message">
                                                        </div>
                                                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-paper-plane"></i> Send</button>
                                                        <button class="btn btn-sm btn-danger float-end "><i class="fa-solid fa-trash-can"></i>
                                                            Batalkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ANDA KOMENTAR -->
                                    <div class="d-flex align-items-start mt-1">
                                        <span class="pe-2">
                                            <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                        </span>
                                        <div class="flex-grow-1">
                                            <strong class="text-danger">Anda</strong> membalas <strong>Ouja</strong><br />
                                            <small class="text-muted">Hari ini 7:21 pm</small>
                                            <div class="border p-2 mt-1">
                                                Kalau menurut saya sih, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia repudiandae
                                                voluptate assumenda repellat iure nulla, minus vitae architecto ut consectetur ipsa accusantium, porro ipsam
                                                velit illo eos magnam libero nihil.
                                            </div>
                                            <a href="#" class="btn btn-lg rounded mt-1 mb-1 px-2"><i class="fa-regular fa-thumbs-up"></i><span class="ps-2">99</span></a>
                                            <a href="#" class="btn btn-lg mt-1 mb-1 px-1"><i class="fa-solid fa-file-pen"></i> Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger mt-1 mb-2 float-end rounded"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                                            <!-- FORM SUB REPLY -->
                                            <div class="d-flex align-items-start mt-1 mb-2 d-none">
                                                <span class="pe-2">
                                                    <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2" alt="User">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <strong class="text-danger">Anda</strong> membalas <strong class="text-primary">Ghost</strong><br />
                                                    <small class="text-muted"></small>
                                                    <div class="text-sm text-muted mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mb-2" placeholder="Type your message">
                                                        </div>
                                                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-paper-plane"></i> Send</button>
                                                        <button class="btn btn-sm btn-danger float-end "><i class="fa-solid fa-trash-can"></i>
                                                            Batalkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </main>

                                <hr style="height: 3px; background-color: #333;" class="rounded-5 " />
                            </div>
                        </div>
                        <!-- <div class="d-grid">
                            <a href="#" class="btn btn-primary">Load more</a>
                        </div> -->
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
    $(document).ready(function() {
        function tippyjs(id, content) {
            tippy('#' + id, {
                placement: 'bottom-end',
                allowHTML: true,
                delay: [700, 0],
                content: content,
            });
        }
        tippyjs('notulen-pdf', 'Preview Notulen');
        tippyjs('notulen-peserta', 'Lihat Perserta');

        var position = 0;
        $('#tampil_balasan').on('click', function() {
            if (!$('#balasan').is(':animated')) {
                position += 180;
                $('#chevron_down').css({
                    '-webkit-transform': 'rotate(' + position + 'deg)',
                    '-moz-transform': 'rotate(' + position + 'deg)',
                    '-o-transform': 'rotate(' + position + 'deg)',
                    '-ms-transform': 'rotate(' + position + 'deg)',
                    'transform': 'rotate(' + position + 'deg)'
                });
                if ($('#balasan').is(':visible')) {
                    $('#balas').slideUp(500);
                    $('#balasan').slideUp(500);
                    $('#input_komentar').blur();
                } else {
                    $('#balasan').removeClass('d-none').slideUp(0).slideDown(500);
                    $('#input_komentar').blur();
                }
            }
        });

        $('#tampil_balas').on('click', function() {
            if (!$('#balas').is(':animated')) {
                if ($('#balas').is(':visible')) {
                    $('#balas').slideUp(200);
                    $('#input_komentar').blur();
                } else {
                    $('#balas').removeClass('d-none').slideUp(0).blur().slideDown(200);
                    $('#input_komentar').blur().focus();
                }
            }
        });

        $('#switch_balasan').on('click', function() {
            if (!$(this).is(':checked')) {
                $('#parent').addClass('d-none');
            } else {
                $('#parent').removeClass('d-none');
            }
        })

        var position2 = 0;
        $('.show_hide').on('click', function() {
            if (!$('#detail_kegiatan').is(':animated')) {
                // var col = $('#pertanyaan').attr('class').split(' ');
                position2 += 180;
                $('.fa-circle-chevron-up').css({
                    '-webkit-transform': 'rotate(' + position2 + 'deg)',
                    '-moz-transform': 'rotate(' + position2 + 'deg)',
                    '-o-transform': 'rotate(' + position2 + 'deg)',
                    '-ms-transform': 'rotate(' + position2 + 'deg)',
                    'transform': 'rotate(' + position2 + 'deg)'
                });
                if ($('#detail_kegiatan').is(':visible')) {
                    $('#detail_kegiatan').slideUp(300);
                    // $('#show_hide').html(' Tampilkan');
                    setTimeout(function() {
                        $('#pertanyaan').removeClass("col-sm-7 col-lg-8");
                    }, 300);
                } else {
                    $('#pertanyaan').addClass("col-sm-7 col-lg-8");
                    // $('#show_hide').html(' Sembunyikan');
                    setTimeout(function() {
                        $('#detail_kegiatan').slideDown(300);
                    }, 300);
                }
            }
            // $('.show').removeClass('d-none').hide().slideDown(300).queue(function () {
            // 	$('#pertanyaan').removeClass('col-8').addClass('col-12', 1000).dequeue();
            // });
            // $("#pertanyaan").delay(300).animate({ width: '100%' }, 200);
        });

        $("textarea").each(function() {
            this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
        }).on("input", function() {
            this.style.height = 0;
            this.style.height = (this.scrollHeight) + "px";
        });

        $('#kosongkan_komentar').on("click", function() {
            // $('input[data-textarea="1"]').val("");
            $(this).closest('form').find("input[type=text], textarea").val("").height(0).focus();
        });

        $('#modalTambahPertanyaan').on('shown.bs.modal', function() {
            $('#input_pertanyaan').focus();
        });

    });
</script>