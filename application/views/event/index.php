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
            <span id="row_data">
                <div id="load_data"></div>
            </span>
            <div id="load_data_message"></div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 card-title">Detail Rapat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="h4 text-break">
                    <tr class="align-baseline">
                        <td class="fw-semibold">No. Surat</td>
                        <td class="fw-semibold px-3"> : </td>
                        <td id="no_surat_modal">-</td>
                    </tr>
                    <tr class="align-baseline">
                        <td class="fw-semibold">Agenda Rapat</td>
                        <td class="fw-semibold px-3"> : </td>
                        <td id="agenda_rapat_modal">-</td>
                    </tr>
                    <tr class="align-baseline">
                        <td class="fw-semibold">Penyelenggara</td>
                        <td class="fw-semibold px-3"> : </td>
                        <td id="penyelenggara_modal">-</td>
                    </tr>
                    <tr class="align-baseline">
                        <td class="fw-semibold">Pimpinan Rapat</td>
                        <td class="fw-semibold px-3"> : </td>
                        <td id="pimpinan_rapat_modal">-</td>
                    </tr>
                    <tr class="align-baseline">
                        <td class="fw-semibold">Mulai Rapat</td>
                        <td class="fw-semibold px-3"> : </td>
                        <td id="tgl_mulai_modal">-</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>

<!-- Infinite Scroll -->
<script>
    $(document).ready(function() {
        var data_elem = [];
        var limit = 7;
        var start = 0;
        var action = 'inactive';
        var keyword = '';
        var order = 'ASC';
        // var e = $('<div id="load_data"></div>');
        // $('#load_data').empty().remove();
        // $('#load_data').html("");
        // $('#row_data').append(e);



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
                url: "<?php echo base_url(); ?>event/fetch",
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
                        // data_elem.push(data);
                        // $('#load_data').html(data_elem);
                        $('#load_data').append(resp.data);
                        if (resp.next == 'true') {
                            $('#load_data_message').html("");
                            action = 'inactive';
                        } else {
                            $('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
                            action = 'active'
                        }
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
    });
</script>

<!-- Olah Data -->
<script>
    function detail_modal() {
        $(document).delegate("#triggerModal", "click", function() {
            // var data = $(this).attr('data-id');
            var dataArray = $(this).closest(".closest").find("input[type=text]").serializeArray(),
                data = {};
            $(dataArray).each(function(i, field) {
                data[field.name] = field.value;
            });
            $("#detailModal .modal-body #no_surat_modal").html(data['no_surat']);
            $("#detailModal .modal-body #agenda_rapat_modal").html(data['agenda_rapat']);
            $("#detailModal .modal-body #penyelenggara_modal").html(data['penyelenggara']);
            $("#detailModal .modal-body #pimpinan_rapat_modal").html(data['pimpinan_rapat']);
            $("#detailModal .modal-body #mulai_rapat_modal").html(data['mulai_rapat']);
            $("#detailModal").modal('show');
        });
        $('#detailModal').on('hidden.bs.modal', function() {
            $("#detailModal .modal-body #no_surat_modal").html('-');
            $("#detailModal .modal-body #agenda_rapat_modal").html('-');
            $("#detailModal .modal-body #penyelenggara_modal").html('-');
            $("#detailModal .modal-body #pimpinan_rapat_modal").html('-');
            $("#detailModal .modal-body #mulai_rapat_modal").html('-');
        });
    }

    $(document).ready(function() {
        // Search
        var timeout = null;
        $('#keyword').on('input', function() {
            $('#load_data').empty();
            $('#load_data').html('');
            keyword = $(this).val();
            limit = 7;
            start = 0;
            action = 'inactive';
            // var e = $('<div id="load_data"></div>');
            // $('#load_data').empty().remove();
            // $('#row_data').append(e);
            loader(limit);
            if (timeout !== null) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
                load_data(limit, start, keyword, order);
            }, 1000); //Buat animasi doang
            // console.log(keyword);
            // if (keyword != '') {
            //     infinite_scroll(keyword);
            // } else {
            //     infinite_scroll();
            // }
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

        detail_modal();
    });

    // function search() {
    //     // $('#keyword').on('input', function()
    //     // $(document).delegate("#keyword", "input", function()
    //     $('#keyword').on('input', function() {
    //         var keyword = $(this).val();
    //         // var e = $('<div id="load_data"></div>');
    //         // $('#load_data').empty().remove();
    //         // $('#row_data').append(e);
    //         $('#load_data').html("");
    //         console.log(keyword);
    //         if (keyword != '') {
    //             infinite_scroll(keyword);
    //         } else {
    //             infinite_scroll();
    //         }
    //     });
    // }
</script>