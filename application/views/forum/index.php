<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-4 mt-3 mt-lg-0">
            <div class="col-12 col-lg-7 mb-2 mb-lg-0">
                <div class="input-group">
                    <span class="card-title my-auto me-3 d-none d-md-block">Urut Berdasar :</span>
                    <!-- <div class="col-md-4 col-lg-5 me-3"> -->
                    <select class="form-select flex-grow-1 rounded me-3 form-select-lg " id="order" style="max-width: 10rem;">
                        <option value="ASC" selected>Data Baru</option>
                        <option value="DESC">Data Lama</option>
                    </select>
                    <!-- </div> -->
                    <span class="card-title my-auto">(<span id="num_rows">0</span>) Data</span>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="input-group input-group-lg ">
                    <input type="search" class="form-control border" id="keyword" placeholder="Search...">
                    <span class="btn bg-white border" style="cursor: default;"><i class="fa-solid fa-magnifying-glass"></i> Search</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="load_data"></div>
            <div id="load_data_message"></div>
        </div>
    </div>
</main>

<!-- Tutup elemen dari topbar.php -->
</div>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<?= $this->session->flashdata('message'); ?>

<!-- Global Variable -->
<script>
    // Editable
    const limit = 10;
    // Effect
    const placeholder_timer = 1000;
    // Jangan ganti
    var start = 0;
    var action = 'inactive';
    var keyword = '';
    var order = 'ASC';
    var timeout = null;
</script>

<!-- Infinite Scroll -->
<script>
    function loader(limit) {
        var output = '';
        for (var count = 0; count < limit; count++) {
            output += '<div class="post_data">';
            output += '<div class="row">';
            output += '<div class="mx-auto col-8 col-sm-4 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><span class="content-placeholder" style="width:100%; height: 50px; background-size: 3000px 110px;">&nbsp;</span></div>';
            output += '<div class="col-12 col-sm-8 col-lg-11 my-auto"><span class="content-placeholder" style="width:100%; height: 50px; background-size: 3000px 110px;">&nbsp;</span></div>';
            output += '</div>';
            output += '</div>';
        }
        $('#load_data_message').html(output);
    }

    function func_loader_spinner() {
        var output = '';
        output += '<div class="row">';
        output += '<div class="d-flex justify-content-center">';
        output += '<div class="spinner-border text-primary fw-bold fs-2 my-2" role="status">';
        output += '<span class="visually-hidden">Loading...</span>';
        output += '</div>';
        output += '</div>';
        output += '</div>';
        $('#load_data_message').html(output);
    }

    function load_data(limit, start, keyword, order) {
        $.ajax({
            url: "<?php echo base_url(); ?>forum/fetch_index",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                keyword: keyword,
                order: order
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                $('#num_rows').html(resp.num_rows);
                if (resp.data == 'null') {
                    $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Masih Kosong</div>');
                    action = 'active';
                } else if (resp.data == 'null2') {
                    $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
                    action = 'active';
                } else {
                    $('#load_data_message').html("");
                    action = 'inactive';
                    $('.taget-box').each(function() {
                        $(this).removeClass('box shadow-rapat');
                    })
                    $(resp.data).appendTo('#load_data').slideUp(0).slideDown(1000, 'easeInOutExpo', function() {
                        $('.taget-box').each(function() {
                            $(this).addClass('box shadow-rapat');
                        })
                    });
                    // $('#load_data').append(resp.data).slideUp(0).slideDown(500, 'easeInOutExpo');
                }
            }
        })
    }

    function readyToInfinite() {
        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start, keyword, order);
        }
    }

    function scrollWindow() {
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
                func_loader_spinner();
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start, keyword, order);
                }, placeholder_timer); //Buat animasi doang
            }
        });
    }
</script>

<!-- Olah Data -->
<script>
    // ================================= Material Trigger ================================
    // Self find
    function func_self_find(self, closest) {
        return self.parent().closest(closest);
    }
    // Get *this data
    function self_data_self(self) {
        var dataArray = self.find('article input[type=text]').serializeArray(),
            data = {};
        $(dataArray).each(function(i, field) {
            data[field.name] = field.value;
        });
        return data;
    }

    function self_data(self) {
        var dataArray = self.parent().closest('.closest').find('article input[type=text]').serializeArray(),
            data = {};
        $(dataArray).each(function(i, field) {
            data[field.name] = field.value;
        });
        return data;
    }

    // ===================================== Trigger ====================================
    // Switch Forum
    function saklar_forum() {
        $(document).delegate("input[type=checkbox][name=active_forum]", "change", function() {
            var self = $(this);
            var self_find = $(this).parent().closest('article');
            var dataArray = $(this).parent().closest('article').find('.closest input[type=text]').serializeArray(),
                data = {};
            $(dataArray).each(function(i, field) {
                data[field.name] = field.value;
            });
            var id_forum = data['id_forum'];
            $(this).addClass('d-none');
            $(this).parent().closest('article').find('#label_saklar_1').removeClass('me-3');
            $(this).parent().closest('article').find('#spinner_saklar_1').removeClass('d-none');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/saklar_forum",
                    method: "POST",
                    data: {
                        id_forum: id_forum,
                        forum_active: 1
                    },
                    success: function(resp) {
                        self.removeClass('d-none');
                        self_find.find('#label_saklar_1').addClass('me-3');
                        self_find.find('#spinner_saklar_1').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Forum Diaktifkan'
                        });
                    },
                    error: function() {
                        Swal.fire('Error');
                    }
                })
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/saklar_forum",
                    method: "POST",
                    data: {
                        id_forum: id_forum,
                        forum_active: 0
                    },
                    success: function(resp) {
                        self.removeClass('d-none');
                        self_find.find('#label_saklar_1').addClass('me-3');
                        self_find.find('#spinner_saklar_1').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Forum Dinonaktifkan'
                        });
                    },
                    error: function() {
                        Swal.fire('Error');
                    }
                })
            }

        });
    }
    // Switch Pertanyaan
    function saklar_tanya() {
        $(document).delegate("input[type=checkbox][name=active_tanya]", "change", function() {
            var self = $(this);
            var self_find = $(this).parent().closest('article');
            var dataArray = $(this).parent().closest('article').find('.closest input[type=text]').serializeArray(),
                data = {};
            $(dataArray).each(function(i, field) {
                data[field.name] = field.value;
            });
            var id_forum = data['id_forum'];
            $(this).addClass('d-none');
            $(this).parent().closest('article').find('#label_saklar_2').removeClass('me-3');
            $(this).parent().closest('article').find('#spinner_saklar_2').removeClass('d-none');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/saklar_tanya",
                    method: "POST",
                    data: {
                        id_forum: id_forum,
                        tanya_active: 1
                    },
                    success: function(resp) {
                        self.removeClass('d-none');
                        self_find.find('#label_saklar_2').addClass('me-3');
                        self_find.find('#spinner_saklar_2').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Pertanyaan Diaktifkan'
                        });
                    },
                    error: function() {
                        Swal.fire('Error');
                    }
                })
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/saklar_tanya",
                    method: "POST",
                    data: {
                        id_forum: id_forum,
                        tanya_active: 0
                    },
                    success: function(resp) {
                        self.removeClass('d-none');
                        self_find.find('#label_saklar_2').addClass('me-3');
                        self_find.find('#spinner_saklar_2').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Pertanyaan Dinonaktifkan'
                        });
                    },
                    error: function() {
                        Swal.fire('Error');
                    }
                })
            }

        });
    }
    // Switch Komentar
    function saklar_komentar() {
        $(document).delegate("input[type=checkbox][name=active_komentar]", "change", function() {
            var self = $(this);
            var self_find = $(this).parent().closest('article');
            var dataArray = $(this).parent().closest('article').find('.closest input[type=text]').serializeArray(),
                data = {};
            $(dataArray).each(function(i, field) {
                data[field.name] = field.value;
            });
            var id_forum = data['id_forum'];
            $(this).addClass('d-none');
            $(this).parent().closest('article').find('#label_saklar_3').removeClass('me-3');
            $(this).parent().closest('article').find('#spinner_saklar_3').removeClass('d-none');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/saklar_komentar",
                    method: "POST",
                    data: {
                        id_forum: id_forum,
                        komentar_active: 1
                    },
                    success: function(resp) {
                        self.removeClass('d-none');
                        self_find.find('#label_saklar_3').addClass('me-3');
                        self_find.find('#spinner_saklar_3').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Komentar Diaktifkan'
                        });
                    },
                    error: function() {
                        Swal.fire('Error');
                    }
                })
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>forum/saklar_komentar",
                    method: "POST",
                    data: {
                        id_forum: id_forum,
                        komentar_active: 0
                    },
                    success: function(resp) {
                        self.removeClass('d-none');
                        self_find.find('#label_saklar_3').addClass('me-3');
                        self_find.find('#spinner_saklar_3').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Komentar Dinonaktifkan'
                        });
                    },
                    error: function() {
                        Swal.fire('Error');
                    }
                })
            }

        });
    }
    // Trigger search engine
    function searchEngine() {
        $('#keyword').on('input', function() {
            $('#load_data').empty();
            $('#load_data').html('');
            keyword = $(this).val();
            start = 0;
            action = 'inactive';
            func_loader_spinner();
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
                load_data(limit, start, keyword, order);
            }, 1000); //Buat animasi doang
        });
    }
    // Trigger order
    function order() {
        $('#order').on('change', function() {
            $('#load_data').empty();
            $('#load_data').html('');
            order = $(this).find(":selected").val();
            start = 0;
            action = 'inactive';
            func_loader_spinner();
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
                load_data(limit, start, keyword, order);
            }, 1000);
        });
    }
    // Trigger menu
    function article() {
        $(document).delegate(".card-button", "mousedown", function(event) {
            var self = $(this);
            var data = self_data_self(self);
            var id_forum = data['id_forum'];
            var x = event.pageX;
            var y = event.pageY;
            console.log(x, y);
            $(this).on("mouseup", function(event) {
                if (event.pageX == x && event.pageY == y) {
                    window.open("<?= base_url('forum/forum_diskusi/'); ?>" + id_forum);
                }
            })

        });
    }

    $(document).ready(function() {
        func_loader_spinner();
        readyToInfinite();
        scrollWindow();

        searchEngine();
        order();

        saklar_forum();
        saklar_tanya();
        saklar_komentar();
        // article();
    });
</script>