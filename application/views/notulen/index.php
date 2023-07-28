<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" onClick="openModal()">Tambah
                            Notulen</button>
                        <button class="btn btn-info btn-lg" id="generateAbsensi" name="generateAbsensi">Generate
                            Absensi</button>
                        <!-- <h5 class="card-title">The</h5>
                                    <h6 class="card-subtitle text-muted">The</h6> -->
                    </div>
                    <div class="card-body">
                        <table id="notulen_table" class="table table-striped" style="width:100%">
                            <thead>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Tgl Rapat</th>
                                <th>Agenda Rapat</th>
                                <th>Pimpinan Rapat</th>
                                <th>Notulis</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_notulen">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Input Notulen</h4>
                </div>
                <div class="modal-body d-flex flex-column flex-fill pb-3 pt-3" style="height:100%;">
                    <div class="box-body">
                        <form action="<?= base_url('simpan_notulen/'); ?>" method="POST" id="form_notulen" enctype="multipart/form-data">
                            <input type="hidden" name="id_notulen" id="id_notulen">
                            <input type="text" class="form-control font-weight-bolder bg-info" value="DATA RAPAT" readonly><br>

                            <div class="row">
                                <div class="input-group">
                                    <span class="input-group-text">No.Surat</span>
                                    <input type="text" class="form-control font-weight-bolder" id="no_surat" name="no_surat">
                                    <button type="button" class="btn btn-sm btn-primary" onClick="view_surat()">Pilih Surat</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Agenda Rapat</label>
                                        <input type="text" class="form-control form-control-sm font-weight-bolder" name="agenda_rapat" id="agenda_rapat">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Penyelenggara</label>
                                        <input type="text" class="form-control form-control-sm font-weight-bolder" name="penyelenggara" id="penyelenggara">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input type="text" class="form-control form-control-sm font-weight-bolder" name="tempat_rapat" id="tempat_rapat">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Mulai Rapat</label>
                                        <input type="date" class="form-control form-control-sm font-weight-bolder" name="tanggal_mulai" id="tanggal_mulai">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <input type="time" class="form-control form-control-sm font-weight-bolder" name="jam_mulai" id="jam_mulai">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Selesai Rapat</label>
                                        <input type="date" class="form-control form-control-sm font-weight-bolder" name="tanggal_selesai" id="tanggal_selesai">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <input type="time" class="form-control form-control-sm font-weight-bolder" name="jam_selesai" id="jam_selesai">
                                    </div>
                                </div>
                            </div><br>
                            <input type="text" class="form-control form-control-sm font-weight-bolder bg-info" value="DATA NOTULEN" readonly><br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Notulis</label>
                                        <input type="text" class="form-control form-control-sm font-weight-bolder" id="nama_notulis" name="nama_notulis" readonly>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP / NIK Notulis</label>
                                        <input type="text" class="form-control form-control-sm font-weight-bolder" id="nip_notulis" name="nip_notulis" readonly>
                                    </div>
                                </div>
                            </div>

                            <input type="text" class="form-control form-control-sm font-weight-bolder bg-info" value="DATA PENANGGUNG JAWAB" readonly><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Penanggung Jawab</label>
                                        <select class="form-control form-control-sm font-weight-bolder" id="nip_pj" name="nip_pj"></select>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-sm font-weight-bolder bg-info" value="DATA HASIL RAPAT" readonly><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" id="cek_peserta" name="cek_peserta">
                                        <label>List Peserta Khusus</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea id="list_peserta" name="list_peserta" rows="8" class="col-12" hidden></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hasil Rapat</label>
                                <textarea id="isi_notulen" class="textarea" name="isi_notulen" rows="8" cols="100"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link Materi Rapat</label>
                                        <input class="form-control form-control-sm font-weight-bolder" style="width: 100%;" id="materi" name="materi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto Dokumentasi</label>
                                        <input type="file" name="foto[]" id="foto" class="form-control-sm" accept="image/jpeg" multiple="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <div id="gallery" class="mb-3 row">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="cek_pimpinan" name="cek_pimpinan">
                                    <label class="custom-control-label" for="cek_pimpinan">Notulen Khusus Pimpinan</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2" onClick="saveNotulen()">Simpan Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>
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
    function pdfjs(url) {
        "use strict";

        if (!pdfjsLib.getDocument || !pdfjsViewer.PDFPageView) {
            alert("Please build the pdfjs-dist library using\n  `gulp dist-install`");
        }
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.3.122/pdf.worker.min.js";

        const DEFAULT_URL = url;

        const ENABLE_XFA = true;
        const SEARCH_FOR = ""; // try "Mozilla";

        const SANDBOX_BUNDLE_SRC = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.3.122/pdf.sandbox.js";

        const container = document.getElementById("viewerContainer");

        const eventBus = new pdfjsViewer.EventBus();

        // (Optionally) enable hyperlinks within PDF files.
        const pdfLinkService = new pdfjsViewer.PDFLinkService({
            eventBus,
        });

        // (Optionally) enable find controller.
        const pdfFindController = new pdfjsViewer.PDFFindController({
            eventBus,
            linkService: pdfLinkService,
        });

        // (Optionally) enable scripting support.
        const pdfScriptingManager = new pdfjsViewer.PDFScriptingManager({
            eventBus,
            sandboxBundleSrc: SANDBOX_BUNDLE_SRC,
        });

        const pdfViewer = new pdfjsViewer.PDFViewer({
            container,
            eventBus,
            linkService: pdfLinkService,
            findController: pdfFindController,
            scriptingManager: pdfScriptingManager,
        });
        pdfLinkService.setViewer(pdfViewer);
        pdfScriptingManager.setViewer(pdfViewer);

        eventBus.on("pagesinit", function() {
            // We can use pdfViewer now, e.g. let's change default scale.
            pdfViewer.currentScaleValue = "page-width";

            // We can try searching for things.
            if (SEARCH_FOR) {
                eventBus.dispatch("find", {
                    type: "",
                    query: SEARCH_FOR
                });
            }
        });

        // Loading document.
        const loadingTask = pdfjsLib.getDocument({
            url: DEFAULT_URL,
            // cMapUrl: CMAP_URL,
            // cMapPacked: CMAP_PACKED,
            enableXfa: ENABLE_XFA,
        });
        (async function() {
            const pdfDocument = await loadingTask.promise;
            // Document loaded, specifying document for the viewer and
            // the (optional) linkService.
            pdfViewer.setDocument(pdfDocument);

            pdfLinkService.setDocument(pdfDocument, null);
            document.getElementById('viewerContainer').style.position = 'relative';
        })();
    }
</script>

<script>
    $(function() {
        getListNotulen()
        var ckeditor = CKEDITOR.replace('isi_notulen', {
            height: '200px'
        });
        CKEDITOR.disableAutoInline = true;
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $('#nip_pj').select2({
            theme: 'bootstrap4',
            ajax: {
                url: "<?= base_url('notulen/autocomplete_penanggungjawab'); ?>",
                dataType: 'json',
                delay: 500,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
            }
        });
        $('#nip_pj2').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#modal_generate"),
            ajax: {
                url: "<?= base_url('notulen/autocomplete_penanggungjawab'); ?>",
                dataType: 'json',
                delay: 500,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
            }
        });
        $("#cek_peserta").on("change", function() {
            if ($('#cek_peserta').is(':checked') == true) {
                $('#list_peserta').attr('hidden', false)
                console.log($("#cek_peserta").val())
            } else {
                $('#list_peserta').attr('hidden', true)
                console.log($("#cek_peserta").val())
            }
        })
    })
    document.addEventListener("DOMContentLoaded", function() {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });

    function tippyjs(id, content) {
        tippy('#' + id, {
            placement: 'bottom-end',
            allowHTML: true,
            delay: [700, 0],
            content: content,
        });
    }

    // Ambil data notulen
    function getListNotulen() {
        $('#notulen_table').DataTable({
            "ordering": false,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax": {
                'url': '<?= base_url('notulen/get_list_notulen') ?>',
                'type': 'POST',
                'dataType': 'JSON',
                'data': function(d) {
                    return $.extend({}, d, {

                    });
                },
            },
            "columns": [{
                    "data": "no",
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                    "width": "20px"
                },
                {
                    "data": "no_surat",
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                    "width": "240px"
                },
                {
                    "data": "tgl_mulai",
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                },
                {
                    "data": "agenda_rapat",
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                },
                {
                    "data": "pimpinan_rapat",
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                },
                {
                    "data": "nama_notulis",
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                },
                {
                    "data": null,
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                    "render": function(data, type, row) {
                        if (data.pimpinan_rapat != "-") {
                            if (data.verified == 0) {
                                return `<button class="btn btn-block btn-warning">Belum Verifikasi</button>`;
                            } else if (data.verified == 1) {
                                return `<button class="btn btn-block btn-info">Sudah Verifikasi</button>`;
                            }
                        } else {
                            return ``;
                        }
                    }
                },
                {
                    "data": null,
                    "orderable": false,
                    "defaultContent": "<i>Not set</i>",
                    "className": "v-center",
                    "width": "100px",
                    "render": function(data, type, row) {
                        if (data.verified == 1) {
                            return `<div class="d-flex">
                                    <a class="mr-1" onClick="preview(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Preview">
                                        <div class="d-flex p-2" style="background-color: #B3E5FC;border-radius:5px;color:#01579B;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">file_open</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="view_peserta(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Lihat Peserta">
                                        <div class="d-flex p-2" style="background-color: #e1bee7;border-radius:5px;color:#6a1b9a;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">group</span>
                                        </div>
                                    </a>
                                    </div>`
                        } else if (data.verified == 0) {
                            if (data.kirim == 1) {
                                return `<div class="d-flex">
                                    <a class="mr-1" onClick="edit(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Edit">
                                        <div class="d-flex p-2" style="background-color: #FFE0B2;border-radius:5px;color:#E65100;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">edit</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="preview(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Preview">
                                        <div class="d-flex p-2" style="background-color: #B3E5FC;border-radius:5px;color:#01579B;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">file_open</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="view_peserta(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Lihat Peserta">
                                        <div class="d-flex p-2" style="background-color: #e1bee7;border-radius:5px;color:#6a1b9a;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">group</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="send(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Kirim ke pimpinan">
                                        <div class="d-flex p-2" style="background-color: #C8E6C9;border-radius:5px;color:#004D40;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">arrow_outward</span>
                                        </div>
                                    </a>
                                    </div>`
                            } else {
                                return `<div class="d-flex">
                                    <a class="mr-1" onClick="edit(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Edit">
                                        <div class="d-flex p-2" style="background-color: #FFE0B2;border-radius:5px;color:#E65100;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">edit</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="preview(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Preview">
                                        <div class="d-flex p-2" style="background-color: #B3E5FC;border-radius:5px;color:#01579B;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">file_open</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="show_qr(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Generate QR  absensi">
                                        <div class="d-flex p-2" style="background-color: #ffff8b;border-radius:5px;color:#c67100;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">qr_code_2</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="view_peserta(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Lihat Peserta">
                                        <div class="d-flex p-2" style="background-color: #e1bee7;border-radius:5px;color:#6a1b9a;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">group</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="send(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Kirim ke pimpinan">
                                        <div class="d-flex p-2" style="background-color: #C8E6C9;border-radius:5px;color:#004D40;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">arrow_outward</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="deletenotulen(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Hapus Notulen">
                                        <div class="d-flex p-2" style="background-color: #ffa4a2;border-radius:5px;color:#8e0000;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">delete</span>
                                        </div>
                                    </a>
                                    <a class="mr-1" onClick="cetak(` + data.id + `)" style="cursor:pointer;" data-toggle="tooltip" title="Cetak Dalam Format Laporan Perjalanan Dinas">
                                        <div class="d-flex p-2" style="background-color: #B3E5FC;border-radius:5px;color:#01579B;">
                                            <span class="nav-icon material-icons-outlined" style="font-size:1rem;">print</span>
                                        </div>
                                    </a>
                                    </div>`
                            }
                        }
                    }
                },

            ],
        });
    }

    function openModal() {
        $('#id_notulen').val("")
        $('#no_surat').val("")
        $('#agenda_rapat').val("")
        $('#penyelenggara').val("")
        $('#tempat_rapat').val("")
        $('#tanggal_mulai').val("")
        $('#jam_mulai').val("")
        $('#tanggal_selesai').val("")
        $('#jam_selesai').val("")
        $('#nama_notulis').val('')
        $('#nip_notulis').val('')
        $('#nip_pj').val("")
        $('#cek_peserta').prop('checked', false)
        $('#cek_pimpinan').prop('checked', false)
        $('#list_peserta').val("")
        // CKEDITOR.instances['isi_notulen'].setData("")
        $('#gallery').html('')
        $('#modal_notulen').modal('show')
        $('#list_peserta').attr('hidden', true)
    }

</script>