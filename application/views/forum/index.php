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
                    <input type="search" class="form-control border" id="keyword" placeholder="Search Filter">
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
<script>
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
            $(this).parent().closest('article').find('#label_saklar').removeClass('me-3');
            $(this).parent().closest('article').find('#spinner_saklar').removeClass('d-none');
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
                        self_find.find('#label_saklar').addClass('me-3');
                        self_find.find('#spinner_saklar').addClass('d-none');
                        Custom.fire({
                            icon: 'success',
                            title: 'Forum Telah Aktif'
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
                        self_find.find('#label_saklar').addClass('me-3');
                        self_find.find('#spinner_saklar').addClass('d-none');
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

    $(document).ready(function() {
        var limit = 7;
        var start = 0;
        var action = 'inactive';
        var keyword = '';
        var order = 'ASC';

        function loader(limit) {
            var output = '';
            for (var count = 0; count < limit; count++) {
                output += '<div class="post_data">';
                output += '<div class="row">';
                output += '<div class="mx-auto col-8 col-sm-4 col-lg-1 d-flex justify-content-center align-items-center pb-2 pb-sm-0 p-0"><span class="content-placeholder" style="width:100%; height: 50px;">&nbsp;</span></div>';
                output += '<div class="col-12 col-sm-6 col-lg-9 my-auto"><span class="content-placeholder" style="width:100%; height: 50px;">&nbsp;</span></div>';
                output += '<div class="col-12 col-sm-2 col-lg-2 my-auto"><span class="content-placeholder" style="width:100%; height: 50px;">&nbsp;</span></div>';
                output += '</div>';
                output += '</div>';
            }
            $('#load_data_message').html(output);
        }

        loader(limit);

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
                        if (keyword == '' || keyword == null) {
                            $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
                            action = 'active';
                        } else {
                            $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Tidak Ditemukan</div>');
                            action = 'active';
                        }
                    } else {
                        $('#load_data').append(resp.data);
                        $('#load_data_message').html("");
                        action = 'inactive';
                    }
                }
            })
        }

        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start, keyword, order);
        }

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
                loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start, keyword, order);
                }, 1000); //Buat animasi doang
            }
        });

        var timeout = null;
        $('#keyword').on('input', function() {
            $('#load_data').empty();
            $('#load_data').html('');
            keyword = $(this).val();
            limit = 7;
            start = 0;
            action = 'inactive';
            loader(limit);
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
                load_data(limit, start, keyword, order);
            }, 1000); //Buat animasi doang
        });

        $('#order').on('change', function() {
            $('#load_data').empty();
            $('#load_data').html('');
            order = $(this).find(":selected").val();
            limit = 7;
            start = 0;
            action = 'inactive';
            loader(limit);
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
                load_data(limit, start, keyword, order);
            }, 1000);
        });

        saklar_forum();
    });
</script>