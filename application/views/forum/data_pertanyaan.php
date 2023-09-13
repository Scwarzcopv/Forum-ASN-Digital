<?php
$tanya_active = 'd-none';
// $komentar_active = 'disabled';
($info_notulen['tanya_active'] == 1 || $user['id'] == $info_notulen['id_notulis']) ? ($tanya_active = null) : ($tanya_active = 'd-none');
// ($info_notulen['komentar_active'] == 1) ? ($komentar_active = null) : ($komentar_active = 'disabled');
if ($info_notulen['narasumber']) $narasumber = explode('+', $info_notulen['narasumber']);
?>
<style>
    .modal-backdrop {
        opacity: 0.8 !important;
    }

    .nav-item .active {
        background-color: #17a2b8 !important;
        color: #FBFBFB !important;
    }

    .nav-item .active .total {
        background-color: #FBFBFB !important;
        color: #17a2b8 !important;
    }

    .scrollDiv {
        max-height: 80vh;
        overflow: auto;
    }
</style>
<!-- MAIN -->
<main class="content px-1 px-md-3 px-lg-5">
    <div class="d-flex mb-1 mb-lg-2">
        <button type="button" class="btn btn-primary btn_open_modal <?= $tanya_active; ?>">Input Pertanyaan <i class="fas fa-comment-plus ms-1"></i></button>
        <!-- <div class="nav-item dropdown ms-auto">
            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                <div class="position-relative">
                    <i class="align-middle" data-feather="bell"></i>
                    <span class="indicator">4</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0 scrollDiv" aria-labelledby="alertsDropdown">
                <div class="dropdown-menu-header">
                    4 New Notifications
                </div>
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-2">
                                <i class="text-danger" data-feather="alert-circle"></i>
                            </div>
                            <div class="col-10">
                                <div class="text-dark">Update completed</div>
                                <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                <div class="text-muted small mt-1">30m ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-2">
                                <i class="text-warning" data-feather="bell"></i>
                            </div>
                            <div class="col-10">
                                <div class="text-dark">Lorem ipsum</div>
                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                <div class="text-muted small mt-1">2h ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-2">
                                <i class="text-primary" data-feather="home"></i>
                            </div>
                            <div class="col-10">
                                <div class="text-dark">Login from 192.186.1.8</div>
                                <div class="text-muted small mt-1">5h ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-2">
                                <i class="text-success" data-feather="user-plus"></i>
                            </div>
                            <div class="col-10">
                                <div class="text-dark">New connection</div>
                                <div class="text-muted small mt-1">Christina accepted your request.</div>
                                <div class="text-muted small mt-1">14h ago</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-menu-footer">
                    <a href="#" class="text-muted">Show all notifications</a>
                </div>
            </div>
        </div> -->
    </div>
    <div class="tab">
        <ul class="nav nav-tabs bg-secondary bg-opacity-25 p-2 px-lg-3" role="tablist">
            <li class="nav-item"><a class="nav-link rounded text-secondary fw-bold active" href="#pending" data-bs-toggle="tab" role="tab" id="refresh_pending"><i class="fad fa-layer-group"></i> Pending <span class="bg-success text-light ms-1 px-2 text-sm rounded rounded-4 total_pending">0</span></a></li>
            <?php if ($user['id'] == $info_notulen['id_notulis']) : ?>
                <li class="nav-item"><a class="nav-link rounded text-secondary fw-bold" href="#approved" data-bs-toggle="tab" role="tab" id="refresh_approved"><i class="fad fa-clipboard-check"></i> Approved <span class="bg-success text-light ms-1 px-2 text-sm rounded rounded-4 total_approved">0</span></a></a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link rounded text-secondary fw-bold" href="#published" data-bs-toggle="tab" role="tab" id="refresh_published"><i class="fad fa-globe-asia"></i> Published <span class="bg-success text-light ms-1 px-2 text-sm rounded rounded-4 total_published">0</span></a></a></li>
            <?php if ($user['id'] == $info_notulen['id_notulis']) : ?>
                <li class="nav-item"><a class="nav-link rounded text-secondary fw-bold" href="#deleted" data-bs-toggle="tab" role="tab" id="refresh_deleted"><i class="fad fa-trash-alt"></i> Deleted <span class="bg-success text-light ms-1 px-2 text-sm rounded rounded-4 total_deleted">0</span></a></a></li>
            <?php endif; ?>
        </ul>
        <div class="tab-content bg-transparent shadow-none px-0 pt-0">
            <!-- PANE 1 -->
            <div class="tab-pane active bg-white p-4" id="pending" role="tabpanel">
                <div id="load_data_pending"></div> <!-- Target 1 -->
                <div id="load_data_message_pending"></div>
            </div>
            <?php if ($user['id'] == $info_notulen['id_notulis']) : ?>
                <!-- PANE 2 -->
                <div class="tab-pane bg-white p-4" id="approved" role="tabpanel">
                    <div id="load_data_approved"></div> <!-- Target 2 -->
                    <div id="load_data_message_approved"></div>
                </div>
            <?php endif; ?>
            <!-- PANE 3 -->
            <div class="tab-pane bg-white p-4" id="published" role="tabpanel">
                <div id="load_data_published"></div> <!-- Target 3 -->
                <div id="load_data_message_published"></div>
            </div>
            <?php if ($user['id'] == $info_notulen['id_notulis']) : ?>
                <!-- PANE 4 -->
                <div class="tab-pane bg-white p-4" id="deleted" role="tabpanel">
                    <div id="load_data_deleted"></div> <!-- Target 4 -->
                    <div id="load_data_message_deleted"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<!-- MODAL -->
<div class="modal fade" id="modal_pertanyaan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="" id="exampleModalLabel">
                    <div class="text-secondary my-auto d-flex align-items-baseline">
                        <div class="fw-bold fs-2">
                            <strong>Anonim-<span id='modal_key_anonim'></span> <i class="fa-solid fa-circle-question text-primary"></i></strong>
                        </div>
                        <div class="text-secondary fs-3 ms-2">
                            <small class="text-muted"> (<span id="modal_created_at"></span>)</small>
                        </div>
                    </div>
                    <div class="text-secondary fs-3 mt-0 pt-0 lh-1">
                        <small class="text-muted">Narasumber: <span id="modal_narasumber"></span></small>
                    </div>
                </div>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <strong class="card-title ">Pertanyaan :</strong>
                <div class="textbox border p-3 text-break rounded lh-1 h3 text-dark" id="modal_isi_pertanyaan">
                </div>
                <div class="mt-2 d-none" id="modal_jawaban">
                    <strong class="card-title">Jawaban :</strong>
                    <div class="textbox border p-3 text-break rounded lh-1 h3 text-dark" id="modal_isi_jawaban">
                        -
                    </div>
                </div>
                <form class="mt-2 d-none" id="form_jawab">
                    <strong class="card-title">Jawaban :</strong>
                    <div class="input-group comment">
                        <textarea type="text" class="form-control fs-3 lh-1" id="input_jawaban" data-textarea="0" placeholder="Masukkan jawaban.."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success d-none" id="btn_modal_approve">Approve</button>
                <button type="button" class="btn btn-primary d-none" id="btn_modal_publish"><i class="fad fa-paper-plane"></i> Publish</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL INPUT PERTANYAAN -->
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
                                <?php foreach ($narasumber as $key => $n) : ?>
                                    <option value="<?= $key; ?>"><?= $n; ?></option>
                                <?php endforeach; ?>
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

<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
<?= $this->session->flashdata('message'); ?>

<!-- Global Variable -->
<script>
    // Editable
    var show_hidden_comment = true; // GG
    var show_deleted_comment = false; // GG
    const min_heght_baca_selengkapnya = 100; //Harus sinkron
    const grow_baca_selengkapnya = 100;
    const limit_pertanyaan_pending = 2;
    const limit_pertanyaan = 6;
    // Effect
    const placeholder_timer = 1000;
    const spinner_timer = 500;
    const is_pertanyaan_sDown = 'easeInOutExpo';
    // Jangan Ganti
    const id_forum = <?= $id_forum; ?>;
    const role_id = <?= $user['role_id']; ?>;
    var start = 0; // Start invinite scroll pertanyaan
    var action = 'inactive'; // Action invinite scroll pertanyaan
    var ld_message = '#load_data_message_pending';
    var toggle_sidebar = false;
    var pane = 'pending';
    var target = null;
    var nextSlide = false;
</script>
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

    if (show_hidden_comment == true) {
        $('#saklar_comment_hidden').attr('checked', 'true');
    }
    if (show_deleted_comment == true) {
        $('#saklar_comment_del_by_user').attr('checked', 'true');
    }
</script>

<!-- Global Material -->
<script>
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
        $('div[id^="isi_text_pertanyaan"]').each(function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest_isi_pertanyaan');
            var isi_pertanyaan = self_find.find('#isi_pertanyaan');
            var baca_lengkap = self_find.find('#baca_lengkap');
            var height_cover = parseInt($(isi_pertanyaan).css('height').split('px')[0]);
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
        $('div[id^="isi_text_pertanyaan"]').each(function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest_isi_pertanyaan');
            var isi_pertanyaan = self_find.find('#isi_pertanyaan');
            var baca_lengkap = self_find.find('#baca_lengkap');
            var height_cover = parseInt($(isi_pertanyaan).css('height').split('px')[0]);
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
    // Loader with target
    function start_func_loader_spinner(target) {
        var output = '';
        output += '<div class="row">';
        output += '<div class="d-flex justify-content-center">';
        output += '<div class="spinner-border text-primary fw-bold fs-2 my-2" role="status">';
        output += '<span class="visually-hidden">Loading...</span>';
        output += '</div>';
        output += '</div>';
        output += '</div>';
        $(target).html(output);
    }
    // Loader with return
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
    // Total Pertanyaan
    function func_total_pertanyaan() {
        $.ajax({
            url: "<?php echo base_url(); ?>forum/total_pertanyaan",
            method: "POST",
            data: {
                id_forum: id_forum
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                $('.total_pending').html(resp.total_pending);
                $('.total_approved').html(resp.total_approved);
                $('.total_published').html(resp.total_published);
                $('.total_deleted').html(resp.total_deleted);
            },
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
    // Trigger refresh
    function _triggerRefresh() {
        $('#load_data_pending').empty();
        $('#load_data_approved').empty();
        $('#load_data_published').empty();
        $('#load_data_deleted').empty();
        $('#load_data_message_pending').html('<div class="card-title">Tekan Enter</div>');
        $('#load_data_message_approved').html('<div class="card-title">Tekan Enter</div>');
        $('#load_data_message_published').html('<div class="card-title">Tekan Enter</div>');
        $('#load_data_message_deleted').html('<div class="card-title">Tekan Enter</div>');
        func_total_pertanyaan();
        start_func_loader_spinner(ld_message);
    }




    function load_data(limit, start, pane, target, overwrite = false, callback = function() {}) {
        nextSlide = false;
        $.ajax({
            url: "<?php echo base_url(); ?>forum/fetch_pertanyaan_excPending",
            method: "POST",
            data: {
                id_forum: id_forum,
                limit: limit,
                start: start,
                pane: pane,
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                if (resp.data == 'null') {
                    $(ld_message).html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Masih Kosong</div>');
                    action = 'active';
                } else if (resp.data == 'null2') {
                    $(ld_message).html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
                    action = 'active';
                } else {
                    $(ld_message).html('');
                    action = 'inactive';
                    if (overwrite == false) {
                        $(resp.data).appendTo(target).slideUp(0).slideDown(1000, 'easeInOutExpo', function() {
                            nextSlide = true;
                        });
                        setTimeout(function() {
                            func_baca_lengkap(300);
                            func_baca_lengkap_hide(300);
                        }, 800);
                    }
                    if (overwrite == true) {
                        $(target).html(resp.data);
                        nextSlide = true;
                        func_baca_lengkap(200);
                        func_baca_lengkap_hide(200);
                    };
                    // $(target).append(resp.data).slideUp(0).slideDown(500, 'easeInOutExpo');
                }
                callback();
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
        })
    }

    function scrollWindow() {
        $(window).scroll(function() {
            // console.log($(window).scrollTop());
            // console.log($(window).height());
            // console.log($(target).height());
            if (pane != 'pending') {
                if ($(window).scrollTop() + $(window).height() > $(target).height() && action == 'inactive' && nextSlide == true) {
                    start_func_loader_spinner(ld_message);
                    action = 'active';
                    start = start + limit_pertanyaan;
                    setTimeout(function() {
                        load_data(limit_pertanyaan, start, pane, target, false);
                    }, placeholder_timer); //Buat animasi doang
                }
            }
        });
    }
</script>

<!-- Load Pending -->
<script>
    // Start Load Data Pending
    function load_pending() {
        func_total_pertanyaan();
        $.ajax({
            url: "<?php echo base_url(); ?>forum/fetch_pertanyaan_pending",
            method: "POST",
            data: {
                id_forum: id_forum
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                $(ld_message).empty();
                $('#load_data_pending').html(resp.result);
                if (resp.result === '' || resp.result === 'null') {
                    $('#load_data_pending').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Pertanyaan Pending Kosong</div>');
                }
            },
        });
    }
    // Load data infinite scroll pertanyaan pending
    function load_data_pertanyaan(data, load_isi_pertanyaan, total_pertanyaan, loader_pending, position = '', chevron_right = '', slide = 1000, overwrite = false, callback = function() {}) {
        var timeout = 0;
        var slide_baca = 0;
        (slide === 0) ? (timeout = 0) : (timeout = 800);
        (slide === 0) ? (slide_baca = 400) : (slide_baca = 200);
        // data['hidden_comment'] = show_hidden_comment;
        // data['deleted_comment'] = show_deleted_comment;
        $.ajax({
            url: "<?php echo base_url(); ?>forum/fetch_sub_pertanyaan_pending",
            method: "POST",
            data: data,
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                $(loader_pending).empty();
                $(total_pertanyaan).html(resp.num_rows);
                $(chevron_right).css({
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
                            $(resp.data).appendTo($(load_isi_pertanyaan)).slideUp(0).slideDown(slide, 'easeInOutExpo', function() {});
                            $(btn_show_more()).appendTo($(load_isi_pertanyaan)).slideUp(0).slideDown(slide, 'easeInOutExpo');
                        } else {
                            // Tidak Ada Lagi Hasil yang Ditemukan
                            $(resp.data).appendTo($(load_isi_pertanyaan)).slideUp(0).slideDown(slide, 'easeInOutExpo', function() {});
                        }
                    } else {
                        if (resp.next == 'true') {
                            $(load_isi_pertanyaan).html($(resp.data)).prepend('<div class="m-2"></div>').append(btn_show_more());
                        } else {
                            // Tidak Ada Lagi Hasil yang Ditemukan
                            $(load_isi_pertanyaan).html($(resp.data)).prepend('<div class="m-2"></div>');
                        }
                    }
                    setTimeout(function() {
                        func_baca_lengkap(slide_baca);
                        func_baca_lengkap_hide(slide_baca);
                    }, timeout);
                }
                callback();
                func_total_pertanyaan();
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
    // Style btn show more
    function btn_show_more() {
        var output = '';
        output += '<div class="row">';
        output += '<div class="mx-auto d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><button class="btn btn-outline-info border-0 rounded-5 " id="more_pending"><i class="fad fa-caret-down fa-lg"></i> Tampilkan Pertanyaan Lebih</button></div>';
        output += '</div>';
        return output;
    }

    // function show_more_pertanyaan(target) {
    //     var output = '';
    //     output += '<div class="row mt-2">';
    //     output += '<div class="mx-auto d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><button class="btn btn-outline-info border-0 rounded-5 " id="more_pertanyaan"><i class="fas fa-caret-circle-down"></i> Tampilkan Lebih</button></div>';
    //     output += '</div>';
    //     $(target).html(output);
    // }

    // function load_data(limit, start, id_forum, overwrite = false, callback = function() {}) {
    //     $.ajax({
    //         url: "<?php echo base_url(); ?>forum/fetch_forum_diskusi",
    //         method: "POST",
    //         data: {
    //             limit: limit,
    //             start: start,
    //             id_forum: id_forum
    //         },
    //         dataType: "JSON",
    //         cache: false,
    //         success: function(resp) {
    //             $('#total_pertanyaan').html(resp.num_rows);
    //             if (resp.data == 'null') {
    //                 $(ld_message).html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Masih Kosong</div>');
    //                 action = 'active';
    //             } else if (resp.data == 'null2') {
    //                 $(ld_message).html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
    //                 action = 'active';
    //             } else {
    //                 if (overwrite == false) {
    //                     $(resp.data).appendTo('#load_data').slideUp(0).slideDown(1000, is_pertanyaan_sDown, function() {
    //                         func_baca_lengkap();
    //                         func_baca_lengkap_hide();
    //                         // $('.slick').slick('refresh');
    //                     });
    //                 } else {
    //                     $('#load_data').html(resp.data).slideUp(0).slideDown(0, function() {
    //                         func_baca_lengkap();
    //                         func_baca_lengkap_hide();
    //                         // $('.slick').slick('refresh');
    //                     });
    //                 }
    //                 if (resp.next == 'true') {
    //                     show_more_pertanyaan();
    //                     action = 'inactive';
    //                 } else {
    //                     $(ld_message).html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
    //                     action = 'active'
    //                 }
    //             }
    //             callback();
    //         }
    //     })
    // }

    function triggerTampilkanPertanyaan() {
        $(document).delegate('#tampil_pertanyaan', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            data['id_forum'] = id_forum;
            data['limit'] = limit_pertanyaan_pending;
            // Id Element
            var load_isi_pertanyaan = self_find.find('#load_isi_pertanyaan');
            var chevron_right = self_find.find('#chevron_right');
            // var input_komentar = self_find.find('#isi_balasan #input_komentar');
            var total_pertanyaan = self_find.find('#total_pertanyaan');
            var loader_pending = self_find.find('#loader_pending');
            var start = self_find.find('#start');

            if (!$(load_isi_pertanyaan).is(':animated')) {
                var position = 0;
                if ($(loader_pending).html() == '') {
                    if ($(load_isi_pertanyaan).is(':visible')) {
                        $(chevron_right).css({
                            '-webkit-transform': 'rotate(' + position + 'deg)',
                            '-moz-transform': 'rotate(' + position + 'deg)',
                            '-o-transform': 'rotate(' + position + 'deg)',
                            '-ms-transform': 'rotate(' + position + 'deg)',
                            'transform': 'rotate(' + position + 'deg)'
                        });
                        $(load_isi_pertanyaan).slideUp(500, function() {
                            $(load_isi_pertanyaan).empty();
                            $(start).val(0);
                        });
                    } else {
                        // console.log(data);
                        position += 90;
                        if (total_pertanyaan.html() != '0') {
                            $(loader_pending).html(func_loader_spinner()).fadeOut(0).fadeIn();
                            $(load_isi_pertanyaan).html('<div class="mt-3"></div>');
                            setTimeout(function() {
                                load_data_pertanyaan(data, load_isi_pertanyaan, total_pertanyaan, loader_pending, position, chevron_right);
                            }, spinner_timer); //Buat animasi doang
                        }
                        $(load_isi_pertanyaan).removeClass('d-none').show();
                    }
                }
            }
        });
    }
    // Tampil More Pending
    function triggerTampilkanPertanyaanLebih() {
        $(document).delegate('#more_pending', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var start = self_find.find('#start'); //
            var val_start = parseInt($(start).val());
            var new_start = val_start + limit_pertanyaan_pending;
            $(start).val(new_start);

            var data = func_self_data(self, '.closest', '.data-closest');
            data['id_forum'] = id_forum;
            data['limit'] = limit_pertanyaan_pending;
            // Id Element
            var load_isi_pertanyaan = self_find.find('#load_isi_pertanyaan');
            var chevron_right = self_find.find('#chevron_right');
            // var input_komentar = self_find.find('#isi_balasan #input_komentar');
            var total_pertanyaan = self_find.find('#total_pertanyaan');
            var loader_pending = self_find.find('#loader_pending');
            var start = self_find.find('#start');

            $(loader_pending).html(func_loader_spinner()).fadeOut(0).fadeIn();
            self.remove();
            setTimeout(function() {
                load_data_pertanyaan(data, load_isi_pertanyaan, total_pertanyaan, loader_pending);
                func_total_pertanyaan();
            }, spinner_timer); //Buat animasi doang
        });
    }
    // Refresh Pending
    function triggerRefreshPending() {
        $('#refresh_pending').on('click', function() {
            ld_message = '#load_data_message_pending';
            pane = 'pending';
            _triggerRefresh();
            load_pending();
        });
    }
    // Approve
    function triggerApprove() {
        $(document).delegate('#approve', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            data = {
                ...data,
                ...data2,
            };
            data['id_forum'] = id_forum;

            var total_pertanyaan = self_find.find('#total_pertanyaan');
            var chevron_right = self_find.find('#chevron_right');
            var start = self_find.find('#start');

            var load_isi_pertanyaan = self_find.find('#load_isi_pertanyaan');
            var total_pertanyaan = self_find.find('#total_pertanyaan');
            var loader_pending = self_find.find('#loader_pending');
            // console.log(data);
            $.ajax({
                url: "<?php echo base_url(); ?>forum/approve",
                method: "POST",
                data: data,
                dataType: "JSON",
                success: function(resp) {
                    var timing = 0;
                    if (total_pertanyaan.html() === '1') timing = 250;
                    self_find_sub.fadeOut(timing, function() {
                        if (total_pertanyaan.html() === '1') self_find_sub.remove();
                        // total_pertanyaan.html(resp.total_pertanyaan);
                        // if (resp.total_pertanyaan != 0) {
                        val_start = parseInt(start.val());
                        data['start'] = 0;
                        data['limit'] = val_start + limit_pertanyaan_pending;
                        load_data_pertanyaan(data, load_isi_pertanyaan, total_pertanyaan, loader_pending, '', '', '', true, function() {
                            // start.val('0');
                            self_find_sub.remove();
                            func_total_pertanyaan();
                            toastr["success"]("Aprroved!");
                            if (total_pertanyaan.html() === '0') {
                                chevron_right.css({
                                    '-webkit-transform': 'rotate(' + 0 + 'deg)',
                                    '-moz-transform': 'rotate(' + 0 + 'deg)',
                                    '-o-transform': 'rotate(' + 0 + 'deg)',
                                    '-ms-transform': 'rotate(' + 0 + 'deg)',
                                    'transform': 'rotate(' + 0 + 'deg)'
                                });
                                load_isi_pertanyaan.slideUp(500, function() {
                                    load_isi_pertanyaan.empty();
                                    start.val(0);
                                });
                            }
                        });
                        // }
                    });
                }
            });
        });
    }
    // Approve
    function triggerReject() {
        $(document).delegate('#reject', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.closest');
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data = func_self_data(self, '.closest', '.data-closest');
            var data2 = func_self_data(self, '.sub-closest', '.data-sub-closest');
            data = {
                ...data,
                ...data2,
            };
            data['id_forum'] = id_forum;

            var total_pertanyaan = self_find.find('#total_pertanyaan');
            var chevron_right = self_find.find('#chevron_right');
            var start = self_find.find('#start');

            var load_isi_pertanyaan = self_find.find('#load_isi_pertanyaan');
            var total_pertanyaan = self_find.find('#total_pertanyaan');
            var loader_pending = self_find.find('#loader_pending');
            // console.log(data);
            $.ajax({
                url: "<?php echo base_url(); ?>forum/reject",
                method: "POST",
                data: data,
                dataType: "JSON",
                success: function(resp) {
                    var timing = 0;
                    if (total_pertanyaan.html() === '1') timing = 250;
                    self_find_sub.fadeOut(timing, function() {
                        if (total_pertanyaan.html() === '1') self_find_sub.remove();
                        // total_pertanyaan.html(resp.total_pertanyaan);
                        // if (resp.total_pertanyaan != 0) {
                        val_start = parseInt(start.val());
                        data['start'] = 0;
                        data['limit'] = val_start + limit_pertanyaan_pending;
                        load_data_pertanyaan(data, load_isi_pertanyaan, total_pertanyaan, loader_pending, '', '', '', true, function() {
                            // start.val('0');
                            self_find_sub.remove();
                            func_total_pertanyaan();
                            toastr["success"]("Rejected!");
                            if (total_pertanyaan.html() === '0') {
                                chevron_right.css({
                                    '-webkit-transform': 'rotate(' + 0 + 'deg)',
                                    '-moz-transform': 'rotate(' + 0 + 'deg)',
                                    '-o-transform': 'rotate(' + 0 + 'deg)',
                                    '-ms-transform': 'rotate(' + 0 + 'deg)',
                                    'transform': 'rotate(' + 0 + 'deg)'
                                });
                                load_isi_pertanyaan.slideUp(500, function() {
                                    load_isi_pertanyaan.empty();
                                    start.val(0);
                                });
                            }
                        });
                        // }
                    });
                }
            });
        });
    }
</script>

<!-- Load Approved -->
<script>
    function triggerRefreshApprove() {
        $('#refresh_approved').on('click', function() {
            ld_message = '#load_data_message_approved';
            _triggerRefresh();
            pane = 'approved';
            target = '#load_data_approved';
            action = 'active';
            start = 0;
            nextSlide = false;
            load_data(limit_pertanyaan, start, pane, target, false);
        });
    }

    function triggerApproved() {
        $(document).delegate('#btn_approved', 'click', function() {
            var self = $(this);
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data = func_self_data(self, '.sub-closest', '.data-sub-closest');
            data['id_forum'] = id_forum;

            Swal.fire({
                title: "Unapprove pertanyaan?",
                html: "Pertanyaan akan dikembalikan ke <br><span class='fw-bold'>daftar pending</span>.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Unapprove',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url(); ?>forum/approved",
                        method: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function(resp) {
                            self_find_sub.fadeOut('fast', function() {
                                self_find_sub.remove();
                                ld_message = '#load_data_message_approved';
                                pane = 'approved';
                                target = '#load_data_approved';
                                action = 'active';
                                nextSlide = false;
                                func_total_pertanyaan();
                                load_data(start + limit_pertanyaan, 0, pane, target, true, function() {
                                    toastr["success"]("Unapproved!");
                                });
                            });
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
</script>

<!-- Load Published -->
<script>
    function triggerRefreshPublished() {
        $('#refresh_published').on('click', function() {
            ld_message = '#load_data_message_published';
            _triggerRefresh();
            pane = 'published';
            target = '#load_data_published';
            action = 'active';
            start = 0;
            nextSlide = false;
            load_data(limit_pertanyaan, start, pane, target, false);
        });
    }

    function ubah_jawaban() {
        $(document).delegate("#btn_ubah_jawaban", "click", function() {
            var self = $(this);
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data = func_self_data(self, '.sub-closest', '.data-sub-closest');

            var baca_lengkap = $(self_find_sub).find('#closest_isi_pertanyaan #baca_lengkap');
            var update_at = $(self_find_sub).find('#update_at');
            var isi_pertanyaan = $(self_find_sub).find('#closest_isi_pertanyaan #isi_text_pertanyaan');
            var text_isi_pertanyaan = isi_pertanyaan.html().trim();
            var input_edit_pertanyaan = $(self_find_sub).find('textarea', '#input_edit_pertanyaan');
            var btn_batal_edit_pertanyaan = $(self_find_sub).find('#btn_batal_edit_pertanyaan');
            var btn_hapus_pertanyaan = $(self_find_sub).find('#btn_hapus_pertanyaan');

            function done(resp) {
                isi_pertanyaan.html(nl2br(encode_chars(data['value_input_edit_komentar'], isi_pertanyaan)));
                update_at.html('<br class="d-md-none"><span class="text-navy">( <i class="fad fa-edit"></i> Diedit ' + resp.time_update + ' )</span>');
                isi_pertanyaan.show();
                input_edit_pertanyaan.val('').addClass('d-none');
                btn_batal_edit_pertanyaan.addClass('d-none').removeClass('disabled');
                self.removeClass('ms-1').addClass('ms-auto').html('<i class="fa-solid fa-pen-clip"></i> Ubah</a>').removeClass('disabled');
                btn_hapus_pertanyaan.show();
                func_baca_lengkap();
                func_baca_lengkap_hide();
                Custom.fire({
                    icon: 'success',
                    title: 'Jawaban telah diperbarui',
                });
            }

            function failed(title) {
                Custom.fire({
                    icon: 'error',
                    title: title,
                });
            }

            if (isi_pertanyaan.is(':visible') || input_edit_pertanyaan.is(':hidden')) { //Jika field tidak tampil (jika tekan tombol ubah)
                baca_lengkap.hide();
                isi_pertanyaan.hide();
                btn_hapus_pertanyaan.hide();
                input_edit_pertanyaan.val(decode_chars(text_isi_pertanyaan)).removeClass('d-none').focus();
                btn_batal_edit_pertanyaan.removeClass('d-none');
                self.removeClass('ms-auto').addClass('ms-1').html('<i class="fa-solid fa-paper-plane"></i> Simpan</a>');

                input_edit_pertanyaan.each(function() {
                    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
                    this.style.height = 0;
                    this.style.height = (this.scrollHeight) + "px";
                });
            } else { //Jika tekan tombol simpan
                data['value_input_edit_komentar'] = $.trim(input_edit_pertanyaan.val());
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/update_forum_diskusi",
                    method: "POST",
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        btn_batal_edit_pertanyaan.addClass('disabled');
                        self.addClass('disabled');
                    },
                    success: function(resp) {
                        if (resp.result === true) {
                            done(resp);
                        } else {
                            failed('Update gagal');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        // failed();
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

        $(document).delegate("#input_edit_pertanyaan", "keyup", function() {
            var self = $(this);
            var panjang_text_isi_pertanyaan = self.val().replace(/ /g, '').replace(/\n/g, '').length;
            var btn_ubah_jawaban = func_self_find(self, '.sub-closest').find('#btn_ubah_jawaban');

            if (panjang_text_isi_pertanyaan < 1) {
                btn_ubah_jawaban.addClass('disabled');
            } else {
                btn_ubah_jawaban.removeClass('disabled');
            }
        })

        $(document).delegate("#btn_batal_edit_pertanyaan", "click", function() {
            var self = $(this);
            var self_find_sub = func_self_find(self, '.sub-closest');

            var isi_pertanyaan = $(self_find_sub).find('#closest_isi_pertanyaan #isi_text_pertanyaan');
            var input_edit_pertanyaan = $(self_find_sub).find('textarea', '#input_edit_pertanyaan');
            var btn_ubah_jawaban = self_find_sub.find('#btn_ubah_jawaban');
            var btn_hapus_pertanyaan = self_find_sub.find('#btn_hapus_pertanyaan');

            btn_hapus_pertanyaan.show();
            isi_pertanyaan.show();
            input_edit_pertanyaan.val('').addClass('d-none');
            self.addClass('d-none');
            btn_ubah_jawaban.removeClass('ms-1 disabled').addClass('ms-auto').html('<i class="fa-solid fa-pen-clip"></i> Ubah</a>');
            func_baca_lengkap();
            func_baca_lengkap_hide();
        });
    }

    function hapus_pertanyaan() {
        $(document).delegate('#btn_hapus_pertanyaan', 'click', function() {
            var self = $(this);
            var self_find_sub = func_self_find(self, '.sub-closest');
            var data = func_self_data(self, '.sub-closest', '.data-sub-closest');
            data['id_forum'] = id_forum;

            Swal.fire({
                title: "Hapus pertanyaan?",
                // html: "Semua data terkait pertanyaan ini akan dihapus <br><span class='fw-bold'>secara permanen</span>.",
                html: "Semua data terkait pertanyaan ini akan dimasukkan ke <br><span class='fw-bold'>daftar sampah</span>.",
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
                                func_total_pertanyaan();
                                self_find_sub.fadeOut(300, function() {
                                    self_find_sub.remove();
                                    var new_limit = start + limit_pertanyaan;
                                    // console.log(new_limit);
                                    load_data(new_limit, 0, pane, target, true, function() {
                                        Custom.fire({
                                            icon: 'success',
                                            title: 'Pertanyaan berhasil dihapus',
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
    }
</script>

<!-- Load Deleted -->
<script>
    function triggerRefreshDeleted() {
        $('#refresh_deleted').on('click', function() {
            ld_message = '#load_data_message_deleted';
            _triggerRefresh();
            pane = 'deleted';
            target = '#load_data_deleted';
            action = 'active';
            start = 0;
            nextSlide = false;
            load_data(limit_pertanyaan, start, pane, target, false);
        });
    }

    function restore() {
        $(document).delegate('#restore', 'click', function() {
            var self = $(this);
            var self_find = func_self_find(self, '.sub-closest');
            var data = func_self_data(self, '.sub-closest', '.data-sub-closest');

            $(self_find).removeClass('d-flex').html(func_loader_spinner());
            $.ajax({
                url: "<?php echo base_url(); ?>forum/restore",
                method: "POST",
                data: data,
                dataType: "JSON",
                cache: false,
                success: function(resp) {
                    load_data(start + limit_pertanyaan, 0, pane, target, true, function() {
                        $(self_find).remove();
                        func_total_pertanyaan();
                        toastr["success"]("Restore berhasil!");
                    });
                }
            });
        });
    };
</script>

<!-- Trigger -->
<script>
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
    // Sidebar Trigger
    function sidebar() {
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
    }
    // Trigger Baca selengkapnya
    function baca_lengkap() {
        $(document).delegate('#baca_lengkap', 'click', function() {
            // swal.fire('ok')
            var self = $(this);
            var self_find = func_self_find(self, '.closest_isi_pertanyaan');
            var isi_pertanyaan = self_find.find('#isi_pertanyaan');
            var isi_text_pertanyaan = self_find.find('#isi_text_pertanyaan');
            var height_cover = parseInt($(isi_pertanyaan).css('height').split('px')[0]);
            var height_isi = parseInt($(isi_text_pertanyaan).css('height').split('px')[0]);
            if (height_cover >= height_isi) {
                $(isi_pertanyaan).css('max-height', min_heght_baca_selengkapnya + 'px');
                if (height_cover <= height_isi) {
                    self.html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Baca selengkapnya..</a>');
                }
            } else {
                $(isi_pertanyaan).css('max-height', (height_cover + grow_baca_selengkapnya) + 'px');
                if (height_cover >= height_isi - grow_baca_selengkapnya) {
                    self.html('<a class="my-0 py-0 ps-0 btn btn-outline-info border-0 bg-transparent text-info">Lebih sedikit..</a>');
                }
            }
            // $('.slick').slick('refresh');
        });
    }
    // Modal Trigger Tampil Pertanyaan
    function triggerModalTampilPertanyaan() {
        var self_find = {};
        var data = {};
        $(document).delegate('.modal_pertanyaan', 'click', function() {
            var self = $(this);
            self_find = func_self_find(self, '.sub-closest');
            data = {
                ...func_self_data(self, '.closest', '.data-closest'),
                ...func_self_data(self, '.sub-closest', '.data-sub-closest'),
            }
            data['id_forum'] = id_forum;
            $.ajax({
                url: "<?php echo base_url(); ?>forum/info_fp",
                method: "POST",
                data: data,
                dataType: "JSON",
                beforeSend: function() {
                    // btn_batal_edit_pertanyaan.addClass('disabled');
                    // self.addClass('disabled');
                },
                success: function(resp) {
                    $('#modal_key_anonim').html(data['key_anonim']);
                    $('#modal_created_at').html(data['created_at']);
                    $('#modal_narasumber').html(data['narasumber']);
                    $('#modal_isi_pertanyaan').html(nl2br(encode_chars(resp.data['isi_pertanyaan'], $('#modal_isi_jawaban'))));
                    if (pane == 'pending') {
                        $('#btn_modal_approve').removeClass('d-none');
                    }
                    if (pane == 'approved') {
                        $('#form_jawab').removeClass('d-none');
                        $('#btn_modal_publish').removeClass('d-none');
                    }
                    if (pane == 'published') {
                        $('#modal_isi_jawaban').html(nl2br(encode_chars(resp.data['isi_jawaban'], $('#modal_isi_jawaban'))));
                        // $('#modal_isi_jawaban').html(data['isi_jawaban']);
                        $('#modal_jawaban').removeClass('d-none');
                    }
                    $('#modal_pertanyaan').modal('show');
                },
            });
        });

        $('#modal_pertanyaan').on('hidden.bs.modal', function() {
            $('#modal_jawaban').addClass('d-none');
            $('#modal_isi_jawaban').empty();
            $('#form_jawab').addClass('d-none');
            $('#btn_modal_approve').addClass('d-none');
            $('#btn_modal_publish').addClass('d-none');
        });

        $('#modal_pertanyaan').on('shown.bs.modal', function() {
            $('#input_jawaban').focus();
        });

        $('#btn_modal_approve').on('click', function() {
            var var_sub_closest = $('#sub_closest_' + data["id_fp"] + '');
            var var_closest = func_self_find(var_sub_closest, '.closest');

            var total_pertanyaan = var_closest.find('#total_pertanyaan');
            var chevron_right = var_closest.find('#chevron_right');
            var start = var_closest.find('#start');

            var load_isi_pertanyaan = var_closest.find('#load_isi_pertanyaan');
            var total_pertanyaan = var_closest.find('#total_pertanyaan');
            var loader_pending = var_closest.find('#loader_pending');
            // var data = data;
            // console.log(data);

            $.ajax({
                url: "<?php echo base_url(); ?>forum/approve",
                method: "POST",
                data: data,
                dataType: "JSON",
                success: function(resp) {
                    var timing = 0;
                    if (total_pertanyaan.html() === '1') timing = 'fast';
                    $('#modal_pertanyaan').modal('hide');
                    setTimeout(function() {
                        var_sub_closest.fadeOut(timing, function() {
                            if (total_pertanyaan.html() === '1') var_sub_closest.remove();
                            val_start = parseInt(start.val());
                            data['start'] = 0;
                            data['limit'] = val_start + limit_pertanyaan_pending;
                            load_data_pertanyaan(data, load_isi_pertanyaan, total_pertanyaan, loader_pending, '', '', 1000, true, function() {
                                // start.val('0');
                                setTimeout(function() {
                                    var_sub_closest.remove();
                                    func_total_pertanyaan();
                                    toastr["success"]("Aprroved!");
                                    if (total_pertanyaan.html() === '0') {
                                        chevron_right.css({
                                            '-webkit-transform': 'rotate(' + 0 + 'deg)',
                                            '-moz-transform': 'rotate(' + 0 + 'deg)',
                                            '-o-transform': 'rotate(' + 0 + 'deg)',
                                            '-ms-transform': 'rotate(' + 0 + 'deg)',
                                            'transform': 'rotate(' + 0 + 'deg)'
                                        });
                                        load_isi_pertanyaan.slideUp(500, function() {
                                            load_isi_pertanyaan.empty();
                                            start.val(0);
                                        });
                                    }
                                }, 500);
                            });
                        });
                    }, 500);
                }
            });
        });

        $(document).delegate('#btn_publish', 'click', function() {
            var self = $(this);

            self_find = func_self_find(self, '.sub-closest');
            data = {
                ...func_self_data(self, '.closest', '.data-closest'),
                ...func_self_data(self, '.sub-closest', '.data-sub-closest'),
            }
            data['id_forum'] = id_forum;
            $.ajax({
                url: "<?php echo base_url(); ?>forum/info_fp",
                method: "POST",
                data: data,
                dataType: "JSON",
                beforeSend: function() {
                    // btn_batal_edit_pertanyaan.addClass('disabled');
                    // self.addClass('disabled');
                },
                success: function(resp) {
                    $('#modal_key_anonim').html(data['key_anonim']);
                    $('#modal_created_at').html(data['created_at']);
                    $('#modal_narasumber').html(data['narasumber']);
                    $('#modal_isi_pertanyaan').html(nl2br(encode_chars(resp.data['isi_pertanyaan'], $('#modal_isi_jawaban'))));
                    if (pane == 'approved') {
                        $('#form_jawab').removeClass('d-none');
                        $('#btn_modal_publish').removeClass('d-none');
                        $('#modal_pertanyaan').modal('show');
                    }
                },
            });
        });

        $('#btn_modal_publish').on('click', function() {
            var isi_jawaban = $('#input_jawaban');
            data['isi_jawaban'] = $.trim(isi_jawaban.val());

            var var_sub_closest = $('#sub_closest_' + data["id_fp"] + '');

            $.ajax({
                url: "<?php echo base_url(); ?>forum/publish",
                method: "POST",
                data: data,
                dataType: "JSON",
                success: function(resp) {
                    if (resp.result == true) {
                        $('#modal_pertanyaan').modal('hide');
                        $(isi_jawaban).val('');
                        setTimeout(function() {
                            var_sub_closest.fadeOut(200, function() {
                                var_sub_closest.remove();
                                load_data(start + limit_pertanyaan, 0, pane, target, overwrite = true, callback = function() {
                                    func_total_pertanyaan();
                                    toastr["success"]("Published!");
                                });
                            });
                        }, 500);
                    }
                }
            });
        });
    }
</script>

<!-- Input Pertanyaan -->
<script>
    // Trigger open modal
    function triggerOpenModalInputPertanyaan() {
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
    // Input Pertanyaan
    function triggerInputPertanyaan() {
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

        $('#btn_input_pertanyaan').on('click', function() {
            self = $(this);
            var data = {};
            data['id_forum'] = <?= $id_forum; ?>;
            data['key_narasumber'] = $('#pilih_narasumber').val();
            data['pertanyaan'] = $('#input_pertanyaan').val();
            console.log(data);
            Swal.fire({
                title: "Kirim pertanyaan?",
                html: "Pertanyaan yang sudah dikirim <span class='fw-bold'>tidak dapat</span> diedit.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>forum/input_pertanyaan",
                        method: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function(resp) {
                            if (resp.result == true) {
                                $('#modalTambahPertanyaan').modal('hide');
                                $('#input_pertanyaan').val('');
                                $('#pilih_narasumber').val('disabled');
                                disabled1 = true;
                                disabled2 = true;
                                self.addClass('disabled');
                                func_total_pertanyaan();
                                Custom.fire({
                                    icon: 'success',
                                    title: 'Input berhasil',
                                });
                                if (pane == 'pending') {
                                    ld_message = '#load_data_message_pending';
                                    pane = 'pending';
                                    _triggerRefresh();
                                    load_pending();
                                }
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
</script>
<!-- Document Ready -->
<script>
    $(document).ready(function() {
        // View
        auto_width_textarea();
        sidebar();
        baca_lengkap();
        triggerModalTampilPertanyaan();
        // Pending
        start_func_loader_spinner('#load_data_pending');
        load_pending();
        triggerTampilkanPertanyaan();
        triggerTampilkanPertanyaanLebih();
        triggerRefreshPending();
        triggerApprove();
        triggerReject();
        scrollWindow();
        // Approve
        triggerRefreshApprove();
        triggerApproved();
        // Published
        triggerRefreshPublished();
        ubah_jawaban();
        hapus_pertanyaan();
        // Deleted
        triggerRefreshDeleted();
        restore();
        // Input Pertanyaan
        triggerOpenModalInputPertanyaan();
        triggerInputPertanyaan();
        // magnific('.text-popup');

    });
</script>