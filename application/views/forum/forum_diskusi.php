<?php
$tanya_active = 'disabled';
// $komentar_active = 'disabled';
($info_notulen['tanya_active'] == 1 || $user['role_id'] < 3) ? ($tanya_active = null) : ($tanya_active = 'disabled');
// ($info_notulen['komentar_active'] == 1) ? ($komentar_active = null) : ($komentar_active = 'disabled');
?>
<!-- <style>
    .toast {
        opacity: 1 !important;
    }
</style> -->
<main class="content px-3 px-md-5">
    <div class="container-fluid p-0">
        <div class="row  justify-content-end">
            <span class="show_hide text-secondary mb-2 user-select-none" style="cursor: pointer;"><i class="fa-solid fa-circle-chevron-down transition-05"></i> Tampilkan Informasi Kegiatan</span>
            <!-- INFORMASI KEGIATAN / DETAIL KEGIATAN -->
            <main class="col-12 col-sm-5 col-lg-4 px-0 px-md-3" id="detail_kegiatan" style="height: fit-content;">
                <div class="card mb-3 mb-md-0">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            Informasi Kegiatan
                        </h5>
                    </div>
                    <article class="card-body text-center">
                        <?php if (!empty($foto_dokumentasi)) : ?>
                            <span class="content-placeholder img-fluid mb-2 w-100 rounded-4 px-1" style="height: 200px;" id="slick-loader">&nbsp;</span>
                            <div class="parent-slick d-none">
                                <div class="slick">
                                    <?php foreach ($foto_dokumentasi as $img) : ?>
                                        <?php $path = base_url('assets/img/photos/' . $img['path'] . ''); ?>
                                        <!-- <div class="magnific-img"> -->
                                        <span class="image-popup" href="<?= $path; ?>">
                                            <img src="<?= $path; ?>" alt="Dokumentasi" class="zoom-anim-dialog img-fluid mb-2 w-100 img-carrousel rounded-4 px-1" />
                                        </span>
                                        <!-- </div> -->
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <h5 class="card-title mb-0"><?= $info_notulen['agenda_rapat']; ?></h5>
                        <div class="text-muted mb-2"><?= $info_notulen['pimpinan_rapat']; ?></div>
                    </article>
                    <hr class="my-0" />
                    <article class="card-body">
                        <h5 class="h6 card-title">Detail Kegiatan</h5>
                        <table class="text-break">
                            <tr class="align-baseline">
                                <td class="pe-2"><i class="fa-solid fa-calendar-check"></i></td>
                                <td><?= $info_notulen['tgl_selesai']; ?></td>
                            </tr>
                            <tr class="align-baseline">
                                <td><i class="fa-solid fa-envelope-open-text"></i></td>
                                <td><?= $info_notulen['no_surat']; ?></td>
                            </tr>
                            <tr class="align-baseline">
                                <td><i class="fa-solid fa-location-dot"></i></td>
                                <td><?= $info_notulen['tempat_rapat']; ?></td>
                            </tr>
                        </table>
                    </article>
                </div>
            </main>
            <!-- PERTANYAAN -->
            <main class="col-12 col-sm-7 col-lg-8 transition-02 px-0 px-md-3" id="pertanyaan">
                <div class="card">
                    <div class="card-header d-flex align-items-center align-items-sm-start">
                        <div class="row w-100 mx-auto">
                            <div class="col-12 px-0 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center px-0">
                                    <div class="row w-100 px-0">
                                        <div class="col-12 d-flex align-items-center justify-content-between px-0">
                                            <div class="d-flex align-items-center">
                                                <h5 class="card-title mb-0">Pertanyaan (<span id="total_pertanyaan">0</span>)</h5>
                                                <a class="btn btn-outline-secondary rounded rounded-4 py-0 px-2 ms-2 fw-bolder d-none d-lg-block" id="refresh_pertanyaan"><i class="fas fa-redo-alt"></i> Reload</a>
                                            </div>
                                            <div>
                                                <!-- Button trigger modal Tambah Pertanyaan -->
                                                <button type="button" class="btn btn-primary ms-auto btn_open_modal d-none d-lg-block" <?= $tanya_active; ?>>Input Pertanyaan <i class="fas fa-comment-plus ms-1"></i></button>
                                                <button type="button" class="btn btn-primary ms-auto btn_open_modal d-block d-lg-none" <?= $tanya_active; ?>>Pertanyaan <i class="fas fa-comment-plus ms-1"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-12 d-block d-lg-none px-0">
                                            <a class="btn btn-outline-secondary rounded rounded-4 py-0 px-2 fw-bolder" id="refresh_pertanyaan"><i class="fas fa-redo-alt"></i> Reload</a>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($user['role_id'] < 3) : ?>
                                    <div class="mt-3 user-select-none">
                                        <table class="">
                                            <tr class="">
                                                <td class="pb-1">
                                                    <i class="fad fa-circle me-1"></i>
                                                </td>
                                                <td class="pb-1">
                                                    <label class="card-title my-auto me-3" id="label_saklar_1" for="saklar_comment_hidden">Tampilkan hidden komentar</label>
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <div class="spinner-border text-primary my-1 d-none" role="status" id="spinner_saklar_1" style="width: 1rem; height: 1rem;">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <div class="form-check form-switch saklar_comment_hidden">
                                                        <input class="form-check-input my-auto" type="checkbox" name="active_forum" id="saklar_comment_hidden" style="width: 40px; height: 20px;" checked>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="">
                                                <td class="pb-1">
                                                    <i class="fad fa-circle me-1"></i>
                                                </td>
                                                <td>
                                                    <label class="card-title my-auto me-3" id="label_saklar_2" for="saklar_comment_del_by_user">Tampilkan komentar dihapus user</label>
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <div class="spinner-border text-primary my-1 d-none" role="status" id="spinner_saklar_2" style="width: 1rem; height: 1rem;">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <div class="form-check form-switch saklar_comment_del_by_user">
                                                        <input class="form-check-input my-auto" type="checkbox" name="active_forum" id="saklar_comment_del_by_user" style="width: 40px; height: 20px;">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Button trigger modal Tambah Pertanyaan -->
                            <!-- <div class="col-12 col-md-6 px-0">
                                <button type="button" class="btn btn-primary ms-auto d-none d-md-block btn_open_modal" >Tambah Pertanyaan <i class="fas fa-comment-plus ms-1"></i></button>
                            </div> -->
                        </div>
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
                                                <img src="<?= base_url('assets/img/avatars/' . $user['image']); ?>" width="36" height="36" class="rounded-circle me-2" alt="User">
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
                                        <div class="row d-flex w-100">
                                            <div class="col-12 col-md-6 px-0 mb-2 mb-mb-0">
                                                <div class="col-12 col-md-8 m-0 p-0">
                                                    <select class="form-select" aria-label="Select Narasumber" id="pilih_narasumber">
                                                        <option value="disabled" selected disabled class="fw-bold">Pilih Narasumber</option>
                                                        <option value="1">Narasumber-1 (Uzumaki Sudarsono)</option>
                                                        <option value="1">Narasumber-2 (Moh. Sumbul)</option>
                                                        <option value="2">Narasumber-3 (James Born)</option>
                                                        <option value="3">Narasumber-4 (Joko)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 text-end pe-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary disabled" id="btn_input_pertanyaan">Ajukan Pertanyaan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CHAT -->
                        <div id="load_data"></div>
                        <div id="load_data_message"></div>
                        <!-- <div class="d-grid">
                            <a href="#" class="btn btn-primary">Load more</a>
                        </div> -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</main>

<!-- Tutup elemen dari topbar.php -->
</div>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<?= $this->session->flashdata('message'); ?>

<!-- Global Variable -->
<script>
    // Editable
    var show_hidden_comment = true; //Harus sinkron
    var show_deleted_comment = false; //Harus sinkron
    const min_heght_baca_selengkapnya = 100; //Harus sinkron
    const grow_baca_selengkapnya = 100;
    const limit_pertanyaan = 4;
    const limit_komentar = 4;
    // Effect
    const placeholder_timer = 2000;
    const spinner_timer = 500;
    const is_pertanyaan_sDown = 'easeInOutExpo';
    // Jangan Ganti
    const id_forum = <?= $id_forum; ?>;
    const role_id = <?= $user['role_id']; ?>;
    var start = 0; // Start invinite scroll pertanyaan
    var action = 'inactive'; // Action invinite scroll pertanyaan
    var toggle_sidebar = false;
</script>

<!-- Slick -->
<script>
    function func_slick(slick, parent_slick) {
        function btnArrow(directionSlick, directionFA) {
            return '<span class="slick-' + directionSlick + ' text-white position-absolute top-50 translate-middle-y w-auto h-100 d-flex align-items-center"><i class="fa-solid fa-circle-chevron-' + directionFA + '"></i></span>';
        }
        var slick = $(slick);
        var parent_slick = $(parent_slick);
        slick.slick({
            // dots: true,
            infinite: true,
            speed: 300,
            swipeToSlide: true,
            lazyLoad: 'ondemand',
            // fade: true,
            // cssEase: 'linear',
            // autoplay: true,
            // autoplaySpeed: 5000,
            prevArrow: btnArrow('prev', 'left'),
            nextArrow: btnArrow('next', 'right'),
        });
        parent_slick.removeClass('d-none').slideUp(0, function() {
            $('#slick-loader').addClass('d-none');
            parent_slick.slideDown(1000, 'easeInOutBack');
        });
        slick.on('wheel', (function(e) {
            e.preventDefault();
            if (e.originalEvent.deltaY < 0) {
                $(this).slick('slickNext');
            } else {
                $(this).slick('slickPrev');
            }
        }));
    }

    function func_slick_sidebar_toggle(parent_slick) {
        var parent_slick = $(parent_slick);
        $('.sidebar-toggle').on('click', function() {
            if ($('#detail_kegiatan').is(':visible')) {
                $('.slick').slick('refresh');
                parent_slick.slideUp(350, 'easeInOutExpo', function() {
                    $('.slick').slick('refresh');
                    parent_slick.slideDown(1000, 'easeInOutBack');
                });
            }
        });
    }

    function func_slick_show_hide(parent_slick) {
        var parent_slick = $(parent_slick);
        $('.show_hide').on('click', function() {
            if (!$('#detail_kegiatan').is(':animated')) {
                if ($('#detail_kegiatan').is(':hidden')) {
                    parent_slick.hide(0);
                    setTimeout(function() {
                        $('.slick').slick('refresh');
                        parent_slick.fadeIn(1000);
                    }, 300);
                }
            }
        });
    }
</script>

<!-- Magnific Popup -->
<script>
    function magnific(magnific) {
        var magnific = $(magnific);
        var enableMagnific = false;

        magnific.magnificPopup({
            type: 'image',
            fixedContentPos: true,
            overflow: 'hidden',
            gallery: {
                enabled: false
            },
            removalDelay: 300,
            // mainClass: 'mfp-fade',
            // mainClass: 'my-mfp-slide-bottom',
            mainClass: 'mfp-with-zoom',
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            },
            disableOn: function() {
                return enableMagnific;
            }
        });

        // Magnific trigger (active pada single click)
        var holdclick = false;
        var x = 0;
        var y = 0;
        magnific.mousedown(function(event) {
            holdclick = true;
            x = event.pageX;
            y = event.pageY;
            $(this).on("mouseup", function(event) {
                if (event.pageX == x && event.pageY == y) {
                    enableMagnific = true;
                }
            })
        });
        magnific.on("mouseup mouseout", function() {
            holdclick = false;
            enableMagnific = false;
        })
        magnific.mousemove(function() {
            if (holdclick == false) {
                $(this).css("cursor", "pointer");
            } else {
                $(this).css("cursor", "grabbing");
            };
        });

    }
</script>

<!-- Infinite Scroll Pertanyaan -->
<script>
    function loader(limit) {
        var output = '';
        for (var count = 0; count < limit; count++) {
            output += '<div class="post_data">';
            output += '<div class="row">';
            output += '<div class="mx-auto col-8 col-sm-4 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><span class="content-placeholder" style="width:100%; height: 50px;">&nbsp;</span></div>';
            output += '<div class="col-12 col-sm-8 col-lg-11 my-auto"><span class="content-placeholder" style="width:100%; height: 50px;">&nbsp;</span></div>';
            output += '</div>';
            output += '</div>';
        }
        $('#load_data_message').html(output);
    }
    var limit = limit_pertanyaan;
    loader(limit);

    function show_more_pertanyaan() {
        var output = '';
        output += '<div class="row mt-2">';
        output += '<div class="mx-auto d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><button class="btn btn-outline-info border-0 rounded-5 " id="more_pertanyaan"><i class="fas fa-caret-circle-down"></i> Tampilkan Lebih</button></div>';
        output += '</div>';
        $('#load_data_message').html(output);
    }

    function load_data(limit, start, id_forum, overwrite = false, callback = function() {}) {
        $.ajax({
            url: "<?php echo base_url(); ?>forum/fetch_forum_diskusi",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                id_forum: id_forum
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                $('#total_pertanyaan').html(resp.num_rows);
                if (resp.data == 'null') {
                    $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Masih Kosong</div>');
                    action = 'active';
                } else if (resp.data == 'null2') {
                    $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
                    action = 'active';
                } else {
                    if (overwrite == false) {
                        $(resp.data).appendTo('#load_data').slideUp(0).slideDown(1000, is_pertanyaan_sDown, function() {
                            func_baca_lengkap();
                            func_baca_lengkap_hide();
                            $('.slick').slick('refresh');
                        });
                    } else {
                        $('#load_data').html(resp.data).slideUp(0).slideDown(0, function() {
                            func_baca_lengkap();
                            func_baca_lengkap_hide();
                            $('.slick').slick('refresh');
                        });
                    }
                    if (resp.next == 'true') {
                        show_more_pertanyaan();
                        action = 'inactive';
                    } else {
                        $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
                        action = 'active'
                    }
                }
                callback();
            }
        })
    }

    function readyToInfinte() {
        if (action == 'inactive') {
            action = 'active';
            setTimeout(function() {
                load_data(limit, start, id_forum);
            }, placeholder_timer); //Buat animasi doang
        }
    }

    function more_pertanyaan() {
        $(document).delegate('#more_pertanyaan', 'click', function() {
            // $('#load_data_message');
            $('#load_data_message').html(func_loader_spinner()).fadeOut(0).fadeIn();
            action = 'active';
            start = start + limit;
            setTimeout(function() {
                load_data(limit, start, id_forum);
            }, spinner_timer); //Buat animasi doang
        });

        // $(window).scroll(function() {
        //     if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
        //         loader(limit);
        //         action = 'active';
        //         start = start + limit;
        //         setTimeout(function() {
        //             load_data(limit, start, id_forum);
        //         }, 1000); //Buat animasi doang
        //     }
        // });
    }
</script>

<!-- Olah Data -->
<script>
    // ======================================= View =======================================
    // Kontrol Tampilkan Informasi Kegiatan
    function show_hide_detail_kegiatan() {
        function changePos(pos) {
            $('.fa-circle-chevron-down').css({
                '-webkit-transform': 'rotate(' + pos + 'deg)',
                '-moz-transform': 'rotate(' + pos + 'deg)',
                '-o-transform': 'rotate(' + pos + 'deg)',
                '-ms-transform': 'rotate(' + pos + 'deg)',
                'transform': 'rotate(' + pos + 'deg)'
            });
        };
        $('.show_hide').on('click', function() {
            if (!$('#detail_kegiatan').is(':animated')) {
                var position2 = 0;
                // var col = $('#pertanyaan').attr('class').split(' ');
                if ($('#detail_kegiatan').is(':visible')) {
                    position2 -= 90;
                    changePos(position2);
                    $('#detail_kegiatan').slideUp(500, 'easeOutExpo', function() {
                        $('#pertanyaan').removeClass("col-sm-7 col-lg-8");
                        setTimeout(function() {
                            func_baca_lengkap();
                        }, 300);
                    });
                    // $('#show_hide').html(' Tampilkan');
                } else {
                    changePos(position2);
                    $('#pertanyaan').addClass("col-sm-7 col-lg-8");
                    // $('#show_hide').html(' Sembunyikan');
                    setTimeout(function() {
                        $('#detail_kegiatan').slideDown(300, 'easeInExpo', function() {
                            func_baca_lengkap_hide();
                        });
                    }, 300);
                }
            }
            // $('.show').removeClass('d-none').hide().slideDown(300).queue(function () {
            // 	$('#pertanyaan').removeClass('col-8').addClass('col-12', 1000).dequeue();
            // });
            // $("#pertanyaan").delay(300).animate({ width: '100%' }, 200);
        });
    }
    // Auto Match Width
    function auto_width_textarea() {
        $("textarea").each(function() {
            this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
        }).on("input", function() {
            this.style.height = 0;
            this.style.height = (this.scrollHeight) + "px";
        });
        $(document).delegate("textarea", "input", function() {
            this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
            this.style.height = 0;
            this.style.height = (this.scrollHeight) + "px";
        });
        $('.sidebar-toggle').on('click', function() {
            setTimeout(function() {
                $("textarea").each(function() {
                    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                    this.style.height = 0;
                    this.style.height = (this.scrollHeight) + "px";
                })
            }, 300);
        });
        $('.show_hide').on('click', function() {
            var timer = 500;
            ($('#detail_kegiatan').is(':visible')) ? (timer = 500) : (timer = 200);
            setTimeout(function() {
                $("textarea").each(function() {
                    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                    this.style.height = 0;
                    this.style.height = (this.scrollHeight) + "px";
                })
            }, timer);
        });
    }

    // ================================= Material Trigger ================================
    // Spinner 1
    function func_loader_spinner() {
        var output = '';
        output += '<div class="row">';
        output += '<div class="d-flex justify-content-center">';
        output += '<div class="spinner-border text-primary fw-bold fs-2 my-2" role="status">';
        output += '<span class="visually-hidden">Loading...</span>';
        output += '</div>';
        output += '</div>';
        output += '</div>';
        return output;
    }
    // Spinner 2
    function func_loader_spinner_2() {
        var output = '';
        output += '<div class="mx-auto my-auto">';
        output += '<div class="d-flex justify-content-center text-center">';
        output += '<div class="spinner-border text-primary fw-bold fs-2 mb-2" role="status">';
        output += '<span class="visually-hidden">Loading...</span>';
        output += '</div>';
        output += '</div>';
        output += '</div>';
        return output;
    }
    // Material Infinite Scroll Komentar - Show btn more
    function show_more_komentar() {
        var output = '';
        output += '<div class="row">';
        output += '<div class="mx-auto d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><button class="btn btn-outline-info border-0 rounded-5 " id="more_komentar"><i class="fad fa-caret-down fa-lg"></i> Tampilkan Komentar Lebih</button></div>';
        output += '</div>';
        return output;
    }
    // Material Infinite Scroll Komentar - Load data
    function load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, position = '', chevron_right_komentar = '', slide = 1000, overwrite = false, callback = function() {}) {
        var timeout = 0;
        var slide_baca = 0;
        (slide === 0) ? (timeout = 0) : (timeout = 800);
        (slide === 0) ? (slide_baca = 400) : (slide_baca = 200);
        data['hidden_comment'] = show_hidden_comment;
        data['deleted_comment'] = show_deleted_comment;
        $.ajax({
            url: "<?php echo base_url(); ?>forum/fetch_forum_diskusi_komentar",
            method: "POST",
            data: data,
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                $(chevron_right_komentar).css({
                    '-webkit-transform': 'rotate(' + position + 'deg)',
                    '-moz-transform': 'rotate(' + position + 'deg)',
                    '-o-transform': 'rotate(' + position + 'deg)',
                    '-ms-transform': 'rotate(' + position + 'deg)',
                    'transform': 'rotate(' + position + 'deg)'
                });

                if (resp.data == 'null') {
                    // Data masih kosong
                } else if (resp.data == 'null2') {
                    // Tidak Ada Lagi Hasil yang Ditemukan
                } else {
                    if (overwrite == false) {
                        if (resp.next == 'true') {
                            $(resp.data).appendTo($(isi_balasan)).slideUp(0).slideDown(slide, 'easeInOutExpo', function() {
                                $('.slick').slick('refresh');
                            });
                            $(show_more_komentar()).appendTo($(isi_balasan)).slideUp(0).slideDown(slide, 'easeInOutExpo');
                        } else {
                            // Tidak Ada Lagi Hasil yang Ditemukan
                            $(resp.data).appendTo($(isi_balasan)).slideUp(0).slideDown(slide, 'easeInOutExpo', function() {
                                $('.slick').slick('refresh');
                            });
                        }
                    } else {
                        if (resp.next == 'true') {
                            $(isi_balasan).html($(resp.data)).prepend('<div class="m-2"></div>').append(show_more_komentar());
                        } else {
                            // Tidak Ada Lagi Hasil yang Ditemukan
                            $(isi_balasan).html($(resp.data)).prepend('<div class="m-2"></div>');
                        }
                    }
                    setTimeout(function() {
                        func_baca_lengkap(slide_baca);
                        func_baca_lengkap_hide(slide_baca);
                    }, timeout)
                    $(loader_komentar).empty();
                }
                $(total_komentar).html(resp.num_rows);
                callback();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $(loader_komentar).empty();
                console.log(errorThrown);
                // console.error(this.props.url, status, err.toString());
                Swal.fire({
                    icon: 'error',
                    title: textStatus,
                    text: errorThrown,
                });
            }
        });
    }

    // Self find
    function func_self_find(self, closest) {
        return self.parent().closest(closest);
    }
    // Get this(self) data
    function func_self_data(self, closest, data_closest) {
        var dataArray = func_self_find(self, closest).find('' + data_closest + ' input[type=text]').serializeArray(),
            data = {};
        $(dataArray).each(function(i, field) {
            data[field.name] = field.value;
        });
        return data;
    }
    // Baca selengkapanya 1
    function func_baca_lengkap(slide = 200) {
        $('div[id^="isi_komentar"]').each(function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest_isi_komentar');
            var isi_text_komentar = self_find.find('#isi_text_komentar');
            var baca_lengkap = self_find.find('#baca_lengkap');
            var height_cover = parseInt($(isi_text_komentar).css('height').split('px')[0]);
            var height_isi = parseInt(self.css('height').split('px')[0]);
            if (height_cover > height_isi) {
                $(baca_lengkap).html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Lebih sedikit..</a>');
            } else if (height_cover < height_isi) {
                $(baca_lengkap).html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a>');
            } else if (height_cover == height_isi) {
                if (height_cover <= min_heght_baca_selengkapnya) {
                    $(baca_lengkap).slideUp(slide);
                } else {
                    $(baca_lengkap).html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Lebih sedikit..</a>');
                }
            }
        });
    }
    //  Baca selengkapanya 2
    function func_baca_lengkap_hide(slide = 200) {
        $('div[id^="isi_komentar"]').each(function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest_isi_komentar');
            var isi_text_komentar = self_find.find('#isi_text_komentar');
            var baca_lengkap = self_find.find('#baca_lengkap');
            var height_cover = parseInt($(isi_text_komentar).css('height').split('px')[0]);
            var height_isi = parseInt(self.css('height').split('px')[0]);
            if (height_cover > height_isi) {
                $(baca_lengkap).removeClass('d-none').html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Lebih sedikit..</a>');
            } else if (height_cover < height_isi) {
                $(baca_lengkap).html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a>').slideDown('fast');
            } else if (height_cover == height_isi) {
                if (height_cover <= min_heght_baca_selengkapnya) {
                    $(baca_lengkap).html('');
                } else {
                    $(baca_lengkap).html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Lebih sedikit..</a>').slideDown(slide);
                }
            }
            if ($(baca_lengkap).hasClass('d-none')) {
                $(baca_lengkap).removeClass('d-none').slideUp(0).slideDown(slide);
            }
        });
    }
    // Decode SpecialChars
    function decode_chars(str) {
        // this prevents any overhead from creating the object each time
        var newDiv = $('<div>');

        if (str && typeof str === 'string') {
            // strip script/html tags
            str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
            str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
            newDiv.html(str);
            str = newDiv.text();
            newDiv.text('');
        }
        return str;
    };
    // Encode SpecialChars
    function encode_chars(str) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return str.replace(/[&<>"']/g, function(m) {
            return map[m];
        });
    }
    // Encode SpecialChars (newline to br)
    function nl2br(str, self) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (self || typeof self === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    // ===================================== Trigger ====================================
    // Reload Pertanyaan
    function reloadPertanyaan() {
        $('#refresh_pertanyaan').on('click', function() {
            $('#load_data').html('');
            $('#load_data_message').html(func_loader_spinner()).fadeOut(0).fadeIn();
            start = 0;
            setTimeout(function() {
                load_data(limit_pertanyaan, start, id_forum, false, callback = function() {
                    // setTimeout(function() {
                    //     $('.slick').slick('refresh');
                    // }, 1000);
                });
            }, spinner_timer); //Buat animasi doang
        });
    }
    // Open Modal
    function open_modal() {
        $('.btn_open_modal').on('click', function() {
            var self = $(this);
            func_self_find(self, '#pertanyaan');
            var data = func_self_data(self, '#pertanyaan', '.data-closest');
            $.ajax({
                url: "<?php echo base_url(); ?>forum/fetch_modal",
                method: "POST",
                data: data,
                success: function(resp) {
                    if (resp == 'blocked') {
                        location.reload();
                    } else if (resp == '0') {
                        Custom.fire({
                            icon: 'error',
                            title: 'Mohon maaf, pertanyaan saat ini ditutup',
                        });
                    } else {
                        $('#modalTambahPertanyaan').modal('toggle').on('shown.bs.modal', function() {
                            $('#input_pertanyaan').focus();
                        });
                    }
                }
            })
        })
    }
    // Show Form (Balas) Pertanyaaan / Komentar
    function tampil_balas() {
        function show_form(self, id_elem, sub_closest = '') {
            var self_find = null;
            (sub_closest == '') ? (self_find = '.closest') : (self_find = '.sub-closest');
            self_find = func_self_find(self, self_find);
            var data1 = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, sub_closest, '.data-sub-closest');
            var data = {
                ...data1,
                ...data2
            };

            if (!self_find.find(id_elem).is(':animated')) {
                if (!self_find.find(id_elem).is(':visible')) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>forum/fetch_balas",
                        method: "POST",
                        data: data,
                        // TARGET - REVISI AJAX (Jika data terhapus)
                        success: function(resp) {
                            if (resp == 'blocked') {
                                location.reload();
                            } else if (resp == '0') {
                                Custom.fire({
                                    icon: 'error',
                                    title: 'Mohon maaf, komentar saat ini ditutup',
                                });
                            } else {
                                self_find.find(id_elem).append(resp).removeClass('d-none').slideUp(0).slideDown(200);
                                self_find.find(id_elem + ' #input_komentar').focus();
                            }
                        }
                    })
                } else {
                    self_find.find(id_elem).slideUp(200, function() {
                        $(this).empty();
                    });
                }
            }
        }

        $(document).delegate("#tampil_balas", "click", function() {
            var self = $(this);
            show_form(self, '#balas');
            $('.slick').slick('refresh');
        });

        $(document).delegate("#balas_komentar", "click", function() {
            var self = $(this);
            show_form(self, '#sub_balas', '.sub-closest');
            $('.slick').slick('refresh');
        });

        $(document).delegate("#input_komentar", "keyup", function() {
            self = $(this);
            var self_find = func_self_find(self, ".form-komentar");
            var panjang_text_isi_komentar = self.val().replace(/ /g, '').replace(/\n/g, '').length;
            var btn_send = self_find.find('#btn_send');

            if (panjang_text_isi_komentar < 1) {
                $(btn_send).addClass('disabled');
            } else {
                $(btn_send).removeClass('disabled');
            }
        });
    }
    // Saklar Show Parent
    function saklar_show_parent() {
        $(document).delegate(".switch_balasan", "change", function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest-form');
            // var data = func_self_data(self, '.closest', '.data-closest');
            if (self.is(':checked')) {
                self_find.find('#parent').show();
            } else {
                self_find.find('#parent').hide();
            }
        });
    }
    // Tampilkan Balasan Pertanyaan
    function tampil_balasan() {
        $('.sidebar-toggle').on('click', function() {
            if (toggle_sidebar == false) {
                toggle_sidebar = true;
                setTimeout(function() {
                    func_baca_lengkap();
                }, 300);
            } else {
                toggle_sidebar = false;
                setTimeout(function() {
                    func_baca_lengkap_hide();
                }, 300);
            }
        });
        $(document).delegate("#tampil_balasan", "click", function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            data['hidden_comment'] = show_hidden_comment;
            data['deleted_comment'] = show_deleted_comment;
            // var data = func_self_data(self, '.closest', '.data-closest');
            // Id Element
            var balasan = self_find.find('#balasan');
            var chevron_right = self_find.find('#chevron_right');
            var chevron_right_komentar = self_find.find('#chevron_right_komentar');
            var balas = self_find.find('#balas');
            var input_komentar = self_find.find('#input_komentar');
            var sub_balas = self_find.find('#sub_balas');
            var total_komentar = self_find.find('#total_komentar');
            var isi_balasan = self_find.find('#balasan #isi_balasan');
            var tampil_balasan_komentar = self_find.find('#balasan #tampil_balasan_komentar');
            var isi_komentar = self_find.find('#balasan #isi_komentar');
            var isi_text_komentar = self_find.find('#balasan #isi_text_komentar');
            var baca_lengkap = self_find.find('#balasan #baca_lengkap');

            if (!$(balasan).is(':animated')) {
                var position = 0;
                if ($(balasan).is(':visible')) {
                    $(chevron_right).css({
                        '-webkit-transform': 'rotate(' + position + 'deg)',
                        '-moz-transform': 'rotate(' + position + 'deg)',
                        '-o-transform': 'rotate(' + position + 'deg)',
                        '-ms-transform': 'rotate(' + position + 'deg)',
                        'transform': 'rotate(' + position + 'deg)'
                    });
                    $(chevron_right_komentar).css({
                        '-webkit-transform': 'rotate(' + position + 'deg)',
                        '-moz-transform': 'rotate(' + position + 'deg)',
                        '-o-transform': 'rotate(' + position + 'deg)',
                        '-ms-transform': 'rotate(' + position + 'deg)',
                        'transform': 'rotate(' + position + 'deg)'
                    });
                    $(balas).slideUp(400, function() {
                        $(this).empty();
                    });
                    $(balasan).slideUp(500, function() {
                        $(isi_balasan).empty();
                        $(sub_balas).empty();
                        // $(baca_lengkap).addClass('d-none');
                        $(tampil_balasan_komentar).addClass('d-none');
                        $('.slick').slick('refresh');
                    });
                } else {
                    position += 90;
                    $(baca_lengkap).addClass('d-none');

                    $.ajax({
                        url: "<?php echo base_url(); ?>forum/fetch_tampilkan_balasan",
                        method: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function(resp) {
                            $(chevron_right).css({
                                '-webkit-transform': 'rotate(' + position + 'deg)',
                                '-moz-transform': 'rotate(' + position + 'deg)',
                                '-o-transform': 'rotate(' + position + 'deg)',
                                '-ms-transform': 'rotate(' + position + 'deg)',
                                'transform': 'rotate(' + position + 'deg)'
                            });
                            $(balasan).removeClass('d-none');
                            total_komentar.html(resp.total_komentar);
                            $(balasan).slideUp(0).slideDown(500, function() {
                                if (resp.total_komentar > 0) {
                                    $(tampil_balasan_komentar).removeClass('d-none').slideUp(0).slideDown(200);
                                    var height_isi = parseInt($(isi_komentar).css('height').split('px')[0]);
                                    if (height_isi > min_heght_baca_selengkapnya) {
                                        $(baca_lengkap).html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a>').removeClass('d-none').slideUp(0).slideDown(200);
                                    }
                                    $('.slick').slick('refresh');
                                }
                            });
                        },
                    });
                }
            }
        });
    }
    // Tampilkan Balasan Komentar (Infinite Scroll Komentar)
    function tampil_komentar() {
        $(document).delegate('#tampil_balasan_komentar', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            var limit = {
                limit: limit_komentar
            };
            var data = {
                ...data,
                ...limit
            };
            // Id Element
            var balasan = self_find.find('#balasan');
            var chevron_right_komentar = self_find.find('#chevron_right_komentar');
            var balas = self_find.find('#isi_balasan #balas');
            var input_komentar = self_find.find('#isi_balasan #input_komentar');
            var isi_balasan = self_find.find('#isi_balasan');
            var sub_balas = self_find.find('#isi_balasan #sub_balas');
            var total_komentar = self_find.find('#total_komentar');
            var loader_komentar = self_find.find('#loader_komentar');
            var start = self_find.find('#start'); //

            if (!$(isi_balasan).is(':animated')) {
                var position = 0;
                if ($(loader_komentar).html() == '') {
                    if ($(isi_balasan).is(':visible')) {
                        $(chevron_right_komentar).css({
                            '-webkit-transform': 'rotate(' + position + 'deg)',
                            '-moz-transform': 'rotate(' + position + 'deg)',
                            '-o-transform': 'rotate(' + position + 'deg)',
                            '-ms-transform': 'rotate(' + position + 'deg)',
                            'transform': 'rotate(' + position + 'deg)'
                        });
                        $(balas).slideUp(400, function() {
                            $(this).empty();
                        });
                        $(isi_balasan).slideUp(500, function() {
                            $(isi_balasan).empty();
                            $(sub_balas).empty();
                            $(start).val(0);
                        });
                    } else {
                        position += 90;
                        if (total_komentar.html() != '0') {
                            $(isi_balasan).empty().append('<div class="m-2"></div>');
                            loader_komentar.html(func_loader_spinner()).fadeOut(0).fadeIn();
                            setTimeout(function() {
                                load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, position, chevron_right_komentar, 1000, false, function() {
                                    if (total_komentar.html() == '0') {
                                        $(loader_komentar).empty();
                                        $(chevron_right_komentar).css({
                                            '-webkit-transform': 'rotate(' + 0 + 'deg)',
                                            '-moz-transform': 'rotate(' + 0 + 'deg)',
                                            '-o-transform': 'rotate(' + 0 + 'deg)',
                                            '-ms-transform': 'rotate(' + 0 + 'deg)',
                                            'transform': 'rotate(' + 0 + 'deg)'
                                        });
                                        $(balas).slideUp(400, function() {
                                            $(this).empty();
                                        });
                                        $(isi_balasan).slideUp(500, function() {
                                            $(isi_balasan).empty();
                                            $(sub_balas).empty();
                                            $(start).val(0);
                                            self.slideUp(200, function() {
                                                self.addClass('d-none');
                                            });
                                        });
                                    }
                                });
                            }, spinner_timer); //Buat animasi doang
                        }
                        isi_balasan.removeClass('d-none').show();
                    }
                }
            }
        });

        $(document).delegate('#more_komentar', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var start = self_find.find('#start'); //
            var val_start = parseInt($(start).val());
            var new_start = val_start + limit_komentar;
            $(start).val(new_start);

            var data = func_self_data(self, '.closest', '.data-closest');
            var data2 = {
                limit: limit_komentar,
            };
            var data = {
                ...data,
                ...data2
            };
            // Id Element
            var balasan = self_find.find('#balasan');
            var chevron_right_komentar = self_find.find('#chevron_right_komentar');
            var balas = self_find.find('#isi_balasan #balas');
            var input_komentar = self_find.find('#isi_balasan #input_komentar');
            var isi_balasan = self_find.find('#isi_balasan');
            var sub_balas = self_find.find('#isi_balasan #sub_balas');
            var total_komentar = self_find.find('#total_komentar');
            var loader_komentar = self_find.find('#loader_komentar');

            loader_komentar.html(func_loader_spinner(limit_komentar)).fadeOut(0).fadeIn();
            self.remove();
            setTimeout(function() {
                load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, chevron_right_komentar);
            }, spinner_timer); //Buat animasi doang
        });
    }
    // Baca selengkapnya
    function baca_lengkap() {
        $(document).delegate('#baca_lengkap', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest_isi_komentar');
            var isi_komentar = self_find.find('#isi_komentar');
            var isi_text_komentar = self_find.find('#isi_text_komentar');
            var baca_lengkap = self_find.find('#baca_lengkap');
            var height_cover = parseInt($(isi_text_komentar).css('height').split('px')[0]);
            var height_isi = parseInt($(isi_komentar).css('height').split('px')[0]);
            if (height_cover >= height_isi) {
                $(isi_text_komentar).css('max-height', min_heght_baca_selengkapnya + 'px');
                if (height_cover <= height_isi) {
                    self.html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a>');
                }
            } else {
                $(isi_text_komentar).css('max-height', (height_cover + grow_baca_selengkapnya) + 'px');
                if (height_cover >= height_isi - grow_baca_selengkapnya) {
                    self.html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Lebih sedikit..</a>');
                }
            }
            $('.slick').slick('refresh');
        });
    }
    // Tambah Komentar
    function tambah_komentar() {
        $(document).delegate('#btn_send', 'click', function(e) {
            e.preventDefault();
            var self = $(this);
            var balas = func_self_find(self, '#balas');
            var sub_balas = func_self_find(self, '#sub_balas');
            var self_find = func_self_find(self, '.closest');
            var self_find_sub = func_self_find(self, '.sub-closest');
            var self_find_form = func_self_find(self, '.closest-form');
            var data1 = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            var data3 = {
                parent: self_find_form.find('input[name="switch_balasan"]:checked').val(),
                komentar: self_find_form.find('textarea[name="input_komentar"]').val(),
            };
            var data = {
                ...data1,
                ...data2,
                ...data3
            };

            // Id Element
            var tampil_balasan_komentar = self_find.find('#tampil_balasan_komentar');
            // var balasan = self_find.find('#balasan');
            // var balas = self_find.find('#isi_balasan #balas');
            // var input_komentar = self_find.find('#isi_balasan #input_komentar');
            // var sub_balas = self_find.find('#isi_balasan #sub_balas');

            var isi_balasan = self_find.find('#isi_balasan');
            var total_komentar = self_find.find('#total_komentar');
            var loader_komentar = self_find.find('#loader_komentar');
            var start = self_find.find('#start'); //
            var range = {
                start: 0, //start
                limit: parseInt($(start).val()) + limit_komentar, //start + limit
            }
            var data = {
                ...data,
                ...range
            };

            if (!$(isi_balasan).is(':animated')) {
                if ($(loader_komentar).html() == '') {
                    $(self_find_form).html(func_loader_spinner_2()).fadeOut(0).fadeIn(0);

                    $.ajax({
                        url: "<?php echo base_url(); ?>forum/tambah_komentar_forum_diskusi",
                        method: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function(resp) {
                            if (resp.result === false) {
                                Custom.fire({
                                    icon: 'error',
                                    title: 'Maaf, mohon muat ulang halaman',
                                });
                            } else {
                                setTimeout(function() {
                                    $(balas).empty().slideUp(0);
                                    $(sub_balas).empty().slideUp(0);
                                    load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                                        if (parseInt($(total_komentar).html()) >= 0) {
                                            $(tampil_balasan_komentar).removeClass('d-none').slideUp(0).slideDown(200);
                                        }
                                        toastr.success("Komentar ditambahkan");
                                    });
                                }, spinner_timer) //Animasi doang;
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $(balas).empty().slideUp(0);
                            $(sub_balas).empty().slideUp(0);
                            console.log(errorThrown);
                            // console.error(this.props.url, status, err.toString());
                            Swal.fire({
                                icon: 'error',
                                title: textStatus,
                                text: errorThrown,
                            });
                        }
                    });
                }
            }
        });
    }
    // Ubah Komentar
    function ubah_komentar() {
        $(document).delegate("#btn_ubah_komentar", "click", function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var self_find_sub = func_self_find(self, '.sub-closest');
            var self_find_form = func_self_find(self, '.closest-form');

            var data1 = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            var data = {
                ...data1,
                ...data2
            };

            var baca_lengkap = func_self_find(self, '.sub-closest').find('#baca_lengkap');
            var update_at = func_self_find(self, '.sub-closest').find('#update_at');
            var isi_komentar = func_self_find(self, '.sub-closest').find('#isi_komentar');
            var text_isi_komentar = isi_komentar.html().trim();
            var input_edit_komentar = func_self_find(self, '.sub-closest').find('textarea', '#input_edit_komentar');
            var btn_batal_edit_komentar = func_self_find(self, '.sub-closest').find('#btn_batal_edit_komentar');
            var btn_hapus_komentar = func_self_find(self, '.sub-closest').find('#btn_hapus_komentar');
            var btn_hide_komentar = func_self_find(self, '.sub-closest').find('#btn_hide_komentar');

            // Id Element
            var tampil_balasan_komentar = self_find.find('#tampil_balasan_komentar'); //
            var isi_balasan = self_find.find('#isi_balasan');
            var total_komentar = self_find.find('#total_komentar');
            var loader_komentar = self_find.find('#loader_komentar');
            var start = self_find.find('#start'); //
            var range = {
                start: 0, //start
                limit: parseInt($(start).val()) + limit_komentar, //start + limit
            }
            var data = {
                ...data,
                ...range
            };


            function done(resp) {
                isi_komentar.html(nl2br(encode_chars(value_input_edit_komentar, isi_komentar)));
                update_at.html('<br class="d-md-none"><span class="text-navy">( <i class="fad fa-edit"></i> Diedit ' + resp.time_update + ' )</span>');
                isi_komentar.show();
                input_edit_komentar.val('').addClass('d-none');
                btn_batal_edit_komentar.addClass('d-none').removeClass('disabled');
                self.html('<i class="fa-solid fa-pen-clip"></i> Ubah</a>').removeClass('disabled');
                btn_hapus_komentar.show();
                btn_hide_komentar.show();
                func_baca_lengkap();
                func_baca_lengkap_hide();
                Custom.fire({
                    icon: 'success',
                    title: 'Jawaban telah diperbarui',
                });
            }

            function failed(title) {
                // isi_komentar.show();
                // input_edit_komentar.val('').addClass('d-none');
                // btn_batal_edit_komentar.addClass('d-none').removeClass('disabled');
                // self.html('<i class="fa-solid fa-pen-clip"></i> Ubah</a>').removeClass('disabled');
                // btn_hapus_komentar.show();
                // btn_hide_komentar.show();                            if (data['id_fc']) {
                // $(self_find_sub).remove();
                load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                    setTimeout(function() {
                        // Sembunyikan tampilkan komentar jika komentar < 1
                        if (parseInt($(total_komentar).html()) <= 0) {
                            $(tampil_balasan_komentar).slideUp(300, 'easeInExpo', function() {
                                $(tampil_balasan_komentar).addClass('d-none');
                            });
                            $(isi_balasan).slideUp(300, 'easeInExpo', function() {
                                $(isi_balasan).addClass('d-none').empty();
                            });
                        }
                    }, 300);
                    Custom.fire({
                        icon: 'error',
                        title: title,
                    });
                });
            }
            if (isi_komentar.is(':visible') || input_edit_komentar.is(':hidden')) { //Jika field tidak tampil (jika tekan tombol ubah)
                self.addClass('disabled');
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/pre_update_forum_diskusi",
                    method: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function(resp) {
                        self.removeClass('disabled');
                        if (resp.result === null) {
                            baca_lengkap.hide();
                            isi_komentar.hide();
                            btn_hapus_komentar.hide();
                            btn_hide_komentar.hide();
                            input_edit_komentar.val(decode_chars(text_isi_komentar)).removeClass('d-none').focus();
                            btn_batal_edit_komentar.removeClass('d-none');
                            self.html('<i class="fa-solid fa-paper-plane"></i> Simpan</a>');

                            input_edit_komentar.each(function() {
                                this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                                this.style.height = 0;
                                this.style.height = (this.scrollHeight) + "px";
                            });
                        } else if (resp.result == '1') {
                            failed('Komentar telah disembunyikan oleh admin');
                        } else if (resp.result == 'deleted') {
                            failed('Komentar telah dihapus oleh admin');
                        }
                    },
                });
            } else { //Jika tekan tombol simpan
                var value_input_edit_komentar = $.trim(input_edit_komentar.val());
                var val_komentar = {
                    value_input_edit_komentar: value_input_edit_komentar
                };
                var data = {
                    ...data,
                    ...val_komentar
                };
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/update_forum_diskusi",
                    method: "POST",
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        btn_batal_edit_komentar.addClass('disabled');
                        self.addClass('disabled');
                    },
                    success: function(resp) {
                        if (resp.result === true) {
                            if (data['id_fc']) { // jika data yg diubah data komentar
                                load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                                    if (parseInt($(total_komentar).html()) >= 0) {
                                        $(tampil_balasan_komentar).removeClass('d-none').slideUp(0).slideDown(200);
                                    }
                                    toastr.success("Komentar telah diperbarui");
                                });
                            } else {
                                done(resp);
                            }
                        } else if (resp.result == '1') {
                            failed('Komentar telah disembunyikan oleh admin');
                        } else if (resp.result == 'deleted') {
                            failed('Komentar telah dihapus oleh admin');
                        } else {
                            failed('Update gagal');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        failed();
                        // console.error(this.props.url, status, err.toString());
                        // Swal.fire({
                        //     icon: 'error',
                        //     title: textStatus,
                        //     text: errorThrown,
                        // });
                        failed('Terjadi kesalahan internal');
                    }
                });
            }
        });

        $(document).delegate("#input_edit_komentar", "keyup", function() {
            var self = $(this);
            var panjang_text_isi_komentar = self.val().replace(/ /g, '').replace(/\n/g, '').length;
            var btn_ubah_komentar = func_self_find(self, '.sub-closest').find('#btn_ubah_komentar');

            if (panjang_text_isi_komentar < 1) {
                btn_ubah_komentar.addClass('disabled');
            } else {
                btn_ubah_komentar.removeClass('disabled');
            }
        })

        $(document).delegate("#btn_batal_edit_komentar", "click", function() {
            var self = $(this);
            var isi_komentar = func_self_find(self, '.sub-closest').find('#isi_komentar');
            var input_edit_komentar = func_self_find(self, '.sub-closest').find('textarea', '#input_edit_komentar');
            var btn_ubah_komentar = func_self_find(self, '.sub-closest').find('#btn_ubah_komentar');

            isi_komentar.show();
            input_edit_komentar.val('').addClass('d-none');
            self.addClass('d-none');
            btn_ubah_komentar.html('<i class="fa-solid fa-pen-clip"></i> Ubah</a>').removeClass('disabled');
            func_baca_lengkap();
            func_baca_lengkap_hide();
        });
    }
    // Hapus Element
    function hapus_element() {
        $(document).delegate('#btn_hapus_pertanyaan', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var balasan = self_find.find('#balasan');
            var data = func_self_data(self, '.closest', '.data-closest');

            Swal.fire({
                title: "Hapus pertanyaan?",
                text: "Semua data terkait pertanyaan ini akan dihapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>forum/hapus_forum_diskusi",
                        method: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function(resp) {
                            if (resp.result === true) {
                                $('#total_pertanyaan').html(resp.total_pertanyaan);
                                balasan.slideUp(500, function() {
                                    self_find.fadeOut(300, function() {
                                        var new_limit = start + limit_pertanyaan;
                                        console.log(new_limit);
                                        load_data(new_limit, 0, id_forum, true, function() {
                                            Custom.fire({
                                                icon: 'success',
                                                title: 'Pertanyaan berhasil dihapus',
                                            });
                                        });
                                    });
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // console.error(this.props.url, status, err.toString());
                            Swal.fire({
                                icon: 'error',
                                title: textStatus,
                                text: errorThrown,
                            });
                        }
                    });
                }
            })
        });

        $(document).delegate('#btn_hapus_komentar', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data1 = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            var data = {
                ...data1,
                ...data2,
            };
            var tampil_balasan_komentar = self_find.find("#tampil_balasan_komentar");
            var isi_balasan = self_find.find("#isi_balasan");
            var total_komentar = self_find.find('#total_komentar');
            var loader_komentar = self_find.find('#loader_komentar');
            var start = self_find.find('#start'); //
            var range = {
                start: 0, //start
                limit: parseInt($(start).val()) + limit_komentar, //start + limit
            }
            var data = {
                ...data,
                ...range
            };

            Swal.fire({
                title: "Hapus komentar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>forum/hapus_forum_diskusi",
                        method: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function(resp) {
                            if (resp.result === true) {
                                self_find_sub.fadeOut(300, function() {
                                    self_find_sub.remove();
                                    load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                                        toastr.success("Komentar berhasil dihapus");
                                        // Custom.fire({
                                        //     icon: 'success',
                                        //     title: 'Komentar berhasil dihapus',
                                        // });
                                        setTimeout(function() {
                                            // Sembunyikan tampilkan komentar jika komentar < 1
                                            if (parseInt($(total_komentar).html()) <= 0) {
                                                $(tampil_balasan_komentar).slideUp(300, 'easeInExpo', function() {
                                                    $(tampil_balasan_komentar).addClass('d-none');
                                                });
                                                $(isi_balasan).slideUp(300, 'easeInExpo', function() {
                                                    $(isi_balasan).addClass('d-none').empty();
                                                });
                                            }
                                        }, 300);
                                    });
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown);
                            // console.error(this.props.url, status, err.toString());
                            Swal.fire({
                                icon: 'error',
                                title: textStatus,
                                text: errorThrown,
                            });
                        }
                    });
                }
            });
        });
    }
    // Show Hide Element
    function hide_show_element(role_id) {
        var role_id = parseInt(role_id);
        $(document).delegate("#btn_hide_komentar", "click", function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data1 = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            var data = {
                ...data1,
                ...data2,
            };
            // Elemen opacity
            var avatar = $(self_find_sub).find("#avatar");
            var content_sub_closest = $(self_find_sub).find("#content-sub-closest");
            var suka_komentar = $(self_find_sub).find("#suka_komentar");
            var balas_komentar = $(self_find_sub).find("#balas_komentar");
            // Bg text komentar
            var textbox = $(self_find_sub).find(".textbox");
            // Reloader
            var tampil_balasan_komentar = self_find.find("#tampil_balasan_komentar");
            var isi_balasan = self_find.find("#isi_balasan");
            var total_komentar = self_find.find('#total_komentar');
            var loader_komentar = self_find.find('#loader_komentar');
            var start = self_find.find('#start'); //
            var range = {
                start: 0, //start
                limit: parseInt($(start).val()) + limit_komentar, //start + limit
            }
            var data = {
                ...data,
                ...range
            };

            <?php if ($user['role_id'] < 3) : ?>
                if ($(avatar).css('opacity') != 0.5) {
                    Swal.fire({
                        title: "Sembunyikan komentar?",
                        text: "Komentar akan disembunyikan (tidak dihapus).",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hide',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log(data);
                            data['instruction'] = 'hide';
                            $.ajax({
                                url: "<?php echo base_url(); ?>forum/show_hide_forum_diskusi",
                                method: "POST",
                                data: data,
                                dataType: "JSON",
                                success: function(resp) {
                                    if (resp.result === true) {
                                        avatar.css('opacity', 0.5);
                                        content_sub_closest.css('opacity', 0.5);
                                        suka_komentar.css('opacity', 0.5).addClass('disabled');
                                        balas_komentar.css('opacity', 0.5).addClass('disabled');
                                        self.html('<i class="fas fa-eye-slash fa-flip-horizontal"></i> Show');
                                        (textbox).addClass('text-light bg-secondary');
                                        setTimeout(function() {
                                            load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                                                toastr.success("Komentar berhasil disembunyikan");
                                                // Custom.fire({
                                                //     icon: 'success',
                                                //     title: 'Komentar berhasil disembunyikan',
                                                // });
                                                if (parseInt($(total_komentar).html()) <= 0) {
                                                    self_find_sub.fadeOut(200, function() {
                                                        self_find_sub.remove();
                                                        setTimeout(function() {
                                                            tampil_balasan_komentar.slideUp(200, function() {
                                                                tampil_balasan_komentar.addClass('d-none');
                                                            });
                                                        }, 200);
                                                    })
                                                }
                                            });
                                        }, 300);
                                    }
                                },
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Tampilkan komentar?",
                        text: "Komentar akan ditampilkan kembali.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Show',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            data['instruction'] = 'show';
                            $.ajax({
                                url: "<?php echo base_url(); ?>forum/show_hide_forum_diskusi",
                                method: "POST",
                                data: data,
                                dataType: "JSON",
                                success: function(resp) {
                                    if (resp.result === true) {
                                        avatar.css('opacity', 1);
                                        content_sub_closest.css('opacity', 1);
                                        suka_komentar.css('opacity', 1).removeClass('disabled');
                                        balas_komentar.css('opacity', 1).removeClass('disabled');
                                        self.html('<i class="fas fa-eye"></i> Hide');
                                        textbox.removeClass('text-light bg-secondary');
                                        setTimeout(function() {
                                            load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                                                toastr.success("Komentar berhasil ditampilkan");
                                                // Custom.fire({
                                                //     icon: 'success',
                                                //     title: 'Komentar berhasil ditampilkan',
                                                // });
                                            });
                                        }, 250);
                                    }
                                },
                            });
                        }
                    });
                }
            <?php else : ?> //Khusus untuk selain admin
                Swal.fire({
                    title: "Hapus komentar?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        data['instruction'] = 'delete';
                        $.ajax({
                            url: "<?php echo base_url(); ?>forum/show_hide_forum_diskusi",
                            method: "POST",
                            data: data,
                            dataType: "JSON",
                            success: function(resp) {
                                if (resp.result === true) {
                                    self_find_sub.fadeOut(300, function() {
                                        self_find_sub.remove();
                                        load_data_komentar(data, isi_balasan, total_komentar, loader_komentar, '', '', 0, true, function() {
                                            toastr.success("Komentar berhasil dihapus");
                                            // Custom.fire({
                                            //     icon: 'success',
                                            //     title: 'Komentar berhasil dihapus',
                                            // });
                                            setTimeout(function() {
                                                // Sembunyikan tampilkan komentar jika komentar < 1
                                                if (parseInt($(total_komentar).html()) <= 0) {
                                                    $(tampil_balasan_komentar).slideUp(300, 'easeInExpo', function() {
                                                        $(tampil_balasan_komentar).addClass('d-none');
                                                    });
                                                    $(isi_balasan).slideUp(300, 'easeInExpo', function() {
                                                        $(isi_balasan).addClass('d-none').empty();
                                                    });
                                                }
                                            }, 300);
                                        });
                                    });
                                }
                            },
                        });
                    }
                });
            <?php endif; ?>
        });
    }
    // Input Pertanyaan
    function input_pertanyaan() {
        var disabled1 = true;
        var disabled2 = true;

        function check() {
            if (disabled1 == false && disabled2 == false) {
                $('#btn_input_pertanyaan').removeClass('disabled');
            } else {
                $('#btn_input_pertanyaan').addClass('disabled');
            }
        }
        $('#input_pertanyaan').on('keyup', function() {
            self = $(this);
            if ($.trim(self.val()) != '') {
                disabled1 = false;
            } else {
                disabled1 = true;
            }
            check();
        });
        $('#pilih_narasumber').on('change', function() {
            self = $(this);
            if (self.val() != 'disabled') {
                disabled2 = false;
            } else {
                disabled2 = true;
            }
            check();
        });
    }
    // Saklar Tampilkan komentar
    function saklar() {
        $('#saklar_comment_hidden').on('change', function() {
            self = $(this);
            // self.addClass('d-none');
            // $('#spinner_saklar_1').removeClass('d-none');
            if (self.is(':checked')) {
                show_hidden_comment = true;
            } else {
                show_hidden_comment = false;
            }
            var newLimit = limit_pertanyaan + start;
            load_data(newLimit, 0, id_forum, true, callback = function() {
                // self.removeClass('d-none');
                // $('#spinner_saklar_1').addClass('d-none');
            });
        });
        $('#saklar_comment_del_by_user').on('change', function() {
            self = $(this);
            // self.addClass('d-none');
            // $('#spinner_saklar_2').removeClass('d-none');
            if (self.is(':checked')) {
                show_deleted_comment = true;
            } else {
                show_deleted_comment = false;
            }
            var newLimit = limit_pertanyaan + start;
            load_data(newLimit, 0, id_forum, true, callback = function() {
                // self.removeClass('d-none');
                // $('#spinner_saklar_2').addClass('d-none');
            });
        });
    }
    // Memberi laik
    function heart() {
        $(document).delegate('.suka_pertanyaan', 'change', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            data['give_to'] = 'Q';

            $.ajax({
                url: "<?php echo base_url(); ?>forum/heart_forum_diskusi",
                method: "POST",
                data: data,
                dataType: 'json',
                success: function(resp) {
                    self_find.find('.total_suka_pertanyaan').html(resp.result);
                }
            });
        });

        $(document).delegate('.suka_jawaban', 'change', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            data['give_to'] = 'A';

            $.ajax({
                url: "<?php echo base_url(); ?>forum/heart_forum_diskusi",
                method: "POST",
                data: data,
                dataType: 'json',
                success: function(resp) {
                    self_find.find('.total_suka_jawaban').html(resp.result);
                }
            });
        });

        $(document).delegate('.suka_komentar', 'change', function() {
            var self = $(this);
            var self_find_sub = func_self_find(self, '.sub-closest');

            var data1 = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            var data = {
                ...data1,
                ...data2
            };
            data['give_to'] = 'C';

            $.ajax({
                url: "<?php echo base_url(); ?>forum/heart_forum_diskusi",
                method: "POST",
                data: data,
                dataType: 'json',
                success: function(resp) {
                    self_find_sub.find('.total_suka_komentar').html(resp.result);
                }
            });
        });
    }

    // ======================================= Document Ready =======================================
    $(document).ready(function() {
        // Slick.js
        func_slick('.slick', '.parent-slick');
        func_slick_sidebar_toggle('.parent-slick');
        func_slick_show_hide('.parent-slick');
        // MagnificPopUp.js
        magnific('.image-popup');

        // Infinite Scroll(Click) Pertanyaan
        readyToInfinte();
        more_pertanyaan();

        // View
        show_hide_detail_kegiatan();
        auto_width_textarea();
        // Trigger
        reloadPertanyaan();
        saklar();
        open_modal();
        tampil_balas();
        saklar_show_parent();
        tampil_balasan();
        tampil_komentar();
        baca_lengkap();

        ubah_komentar();
        hapus_element();
        hide_show_element(role_id);
        tambah_komentar();
        input_pertanyaan();
        heart();

        // $(document).ajaxStop(function() {
        //     func_baca_lengkap();
        //     func_baca_lengkap_hide();
        // });
    });
</script>