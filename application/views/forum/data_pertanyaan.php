<main class="content">
    <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#pending" data-bs-toggle="tab" role="tab"><i class="fad fa-layer-group"></i> Pending <span class="bg-primary text-light px-2 text-sm rounded rounded-4">90</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#published" data-bs-toggle="tab" role="tab"><i class="fad fa-globe-asia"></i> Published <span class="bg-primary text-light px-2 text-sm rounded rounded-4">90</span></a></a></li>
            <li class="nav-item"><a class="nav-link" href="#deleted" data-bs-toggle="tab" role="tab"><i class="fad fa-trash-alt"></i> Deleted <span class="bg-primary text-light px-2 text-sm rounded rounded-4">90</span></a></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="pending" role="tabpanel">
                <h4 class="tab-title">Default tabs</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                    rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                </p>
                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                    justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                    justo.</p>
            </div>
            <div class="tab-pane" id="published" role="tabpanel">
                <h4 class="tab-title">Another one</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                    rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                </p>
                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                    justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                    justo.</p>
            </div>
            <div class="tab-pane" id="deleted" role="tabpanel">
                <h4 class="tab-title">One more</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                    rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                </p>
                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                    justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                    justo.</p>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
<?= $this->session->flashdata('message'); ?>

<!-- Global Variable -->
<script>
    // Editable
    var show_hidden_comment = true;
    var show_deleted_comment = false;
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