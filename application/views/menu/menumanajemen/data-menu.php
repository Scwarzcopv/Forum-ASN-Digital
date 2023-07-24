<!-- TRIGGER  MODAL -->
<button type="button" class="tambah btn btn-primary mb-3 btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">
    <i class="fa-solid fa-circle-plus"></i> Tambah menu baru
</button>
<div class="card">
    <div class="card-body">
        <table id="table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 80%;">Menu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No.</th>
                    <th style="width: 80%;">Menu</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="judul"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body + Footer -->
                <div id="tampil_modal">
                    <!-- Data akan di tampilkan disini-->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets'); ?>/js/app.js"></script>
<script src="<?= base_url('assets'); ?>/js/datatables.js"></script>
<script>
    function modalFoucus() {
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    }

    function tambah() {
        $('.tambah').click(function() {
            var action = 'Tambah Menu Manajemen';
            $.ajax({
                url: '<?= base_url('menu/tambahMenuManajemen'); ?>',
                method: 'POST',
                data: {
                    action: action
                },
                success: function(result) {
                    $('#myModal').modal("show");
                    $('#tampil_modal').html(result);
                    document.getElementById("judul").innerHTML = 'Tambah Data';
                }
            });
        });
    }

    function edit() {
        $('.edit').click(function() {
            var id = $(this).attr("id");
            $.ajax({
                url: '<?php echo base_url(); ?>/menu/editMenuManajemen',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#myModal').modal("show");
                    $('#tampil_modal').html(data);
                    document.getElementById("judul").innerHTML = 'Edit Data';
                }
            });
        });
    }

    function hapus() {
        $('.hapus').click(function() {

            var id = $(this).attr("id");
            $.ajax({
                url: '<?php echo base_url(); ?>/menu/__hapusMenuManajemen',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#myModal').modal("show");
                    $('#tampil_modal').html(data);
                    document.getElementById("judul").innerHTML = 'Hapus Data';
                }
            });
        });
    }
    $(document).ready(function() {
        // modalFoucus();
        // tambah();
        // edit();
        // hapus();
    });
</script>
<script>
    // Inisialisasi DataTables API object & configure talbe
    var table = $('#table').DataTable({
        "processing": true,
        "serverside": true,
        "ajax": "fetchData.php",
        "columnDefs": [{
            "orderable": false,
            "targets": 7
        }]
    });
    $(document).ready(function() {
        // Draw table
        table.draw();
    });
</script>