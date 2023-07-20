var base_url = $('#baseUrl').val();
// --------------------------------------- TAMPIL DATA ---------------------------------------
function all() {
    // Ajax config
    $.ajax({
        type: "GET", // dapatkan semua record dari server
        url: base_url+"menu/all", // get the route value
        success: function(response) { // setelah permintaan berhasil diproses ke sisi server, hasilnya akan dikembalikan ke sini
            // Parsing hasil json
            response = JSON.parse(response);
            var html = "";
            // Periksa apakah ada record yang tersedia
            if (response.length) {
                // Loop parsed JSON
                no = 1;
                $.each(response, function(key, value) {
                    // List template
                    html += '<tr>';
                    html += '<td>' + no + '</td>';no++;
                    html += '<td>' + value.menu + '</td>';
                    html += '<td class="d-flex table-action">';
                    html += '<buttton class="btn btn-primary" data-bs-target="#modalEdit" data-bs-toggle="modal" data-id='+
                        value.id+' id="btnEditMenu" name="btnEditMenu"><i class="align-middle fa-solid fa-pen"></i></buttton>';
                    html += '<button class="btn btn-danger ms-1" data-id='+
                        value.id+' data-val='+value.menu+' id="btnHapusMenu" name="btnHapusMenu"><i class="align-middle fa-solid fa-trash"></i></button>';
                    html += '</td>';
                    html += '</tr>';
                });
            } else {
                html += '<tr class="alert alert-warning">';
                html += 'Data tidak tersedia!';
                html += '</tr>';
            }
            // Insert the HTML Template and display all employee records
            $("#menu-list").html(html);
        }
    });
}

// ---------------------------------------- SAVE DATA ----------------------------------------
function save_tambah() {
    var validatorTambah = $('#formTambah').validate({
        rules: {
            menu_Tambah: {
                required: true,
                remote: base_url + "menu/cekdata",
                minlength: 4,
                maxlength: 15
            },
        },
        messages: {
            menu_Tambah: {
                required: "Nama tidak boleh kosong",
                remote: "Nama sudah terpakai",
                minlength: jQuery.validator.format("Setidaknya {0} karakter dibutuhkan"),
                maxlength: jQuery.validator.format("Karakter melebihi {0}")
            }
        },
        highlight: function(element, errorClass) {
            $(element).closest("#menu_Tambah").addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass) {
            $(element).closest("#menu_Tambah").removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: $(form).attr('action'),
                data: $(form).serializeArray(),
                dataType:'json',
                beforeSend: function () {
                    $('#submitTambah').attr('disabled', true).html("Processing...");
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: "Menu '" + resp.success + "' berhasil ditambahkan"
                        });
                        $('#submitTambah').attr('disabled', false).html("Tambahkan");
                        resetForm(form);
                        all();
                        $('#modalTambah').modal('toggle');
                    }
                }
            });
        }
    });
    $('#modalTambah').on('hidden.bs.modal', function () {
        $('#formTambah input[type=text]').removeClass('is-valid is-invalid');
        validatorTambah.resetForm();
    });
}

// --------------------------------------- UPDATE DATA ---------------------------------------
function save_edit() 
{
    var validatorEdit = $('#formEdit').validate({
        rules: {
            menu_Edit: {
                required: true,
                // remote: base_url + "menu/cekdata2",
                remote: {
                    url: base_url + "menu/cekdata2",
                    type: "GET",
                    data: {
                        id: function () {
                            return $("#formEdit input[name='id_Edit']").val();
                        },
                        menu: function() {
                            return $("#formEdit input[name='menu_Edit']").val();
                        },
                    }
                },
                minlength: 4,
                maxlength: 15
            },
        },
        messages: {
            menu_Edit: {
                required: "Nama tidak boleh kosong",
                remote: "Nama sudah terpakai",
                minlength: jQuery.validator.format("Setidaknya {0} karakter dibutuhkan"),
                maxlength: jQuery.validator.format("Karakter melebihi {0}")
            }
        },
        highlight: function(element, errorClass) {
            $(element).closest("#menu_Edit").addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass) {
            $(element).closest("#menu_Edit").removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: $(form).attr('action'),
                data: $(form).serializeArray(),
                dataType:'json',
                beforeSend: function () {
                    $('#submitEdit').attr('disabled', true).html("Processing...");
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Perubahan berhasil',
                            text: "'" + resp.menuLama + "'  =>  '"+resp.success+"'"
                        });
                        $('#submitEdit').attr('disabled', false).html("Ubah Nama");
                        resetForm(form);
                        all();
                        $('#modalEdit').modal('toggle');
                    } 
                }
            });
        }
    });
    $('#modalEdit').on('hidden.bs.modal', function () {
        $('#formEdit input[type=text]').removeClass('is-valid is-invalid');
        validatorEdit.resetForm();
    });
}

// ---------------------------------------- GET DATA ----------------------------------------
function get() {
    $(document).delegate("[data-bs-target='#modalEdit']", "click", function () {
        var dataId = $(this).attr('data-id');
        // Ajax config
        $.ajax({
            type: "GET",
            url: base_url+'menu/getdata', // get the route value
            data: {
                id: dataId
            }, //set data
            beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

            },
            success: function (resp) { //once the request successfully process to the server side it will return result here
                resp = JSON.parse(resp);
                $("#formEdit input[name='id_Edit']").val(resp.id);
                $("#formEdit input[name='menu_Edit']").val(resp.menu);
            }
        });
    });
}

// --------------------------------------- HAPUS DATA ---------------------------------------
function del() 
{
	$(document).delegate("#btnHapusMenu", "click", function() {
		Swal.fire({
			icon: 'warning',
		  	title: "Yakin ingin menghapus<br>'"+$(this).attr('data-val')+"' ?",
		  	showDenyButton: false,
		  	showCancelButton: true,
		  	confirmButtonText: 'Yes'
		}).then((result) => {
		  if (result.isConfirmed) {
		  	var id = $(this).attr('data-id');
		  	// Ajax config
			$.ajax({
		        type: "POST",
		        url: base_url+'/menu/hapusmenu',
		        data: {id:id},
                beforeSend: function () {
		        },
		        success: function (response) {
	            	all();
		            Swal.fire('Success.', response, 'success')
		        }
		    });

		    
		  } else if (result.isDenied) {
		    Swal.fire('Changes are not saved', '', 'info')
		  }
		});

		
	});
}

//---- RESET FORM ----
function resetForm(selector) {
    $(selector)[0].reset();
}
//---- PANGGIL FUNGSI ----
$(document).ready(function() {
    all();
    save_tambah();
    save_edit();
    get();
    del();
});