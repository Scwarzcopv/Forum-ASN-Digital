var base_url = $('#baseUrl').val();
// --------------------------------------- TAMPIL DATA ---------------------------------------
// function all() {
//     // Ajax config
//     $.ajax({
//         type: "GET", // dapatkan semua record dari server
//         url: base_url+"Admin/allRoleAccess", // get the route value
//         success: function(response) {
//             response = JSON.parse(response);
//             var html = "";
//             // Periksa apakah ada record yang tersedia
//             if (response.length) {
//                 // Loop parsed JSON
//                 no = 1;
//                 $.each(response, function(key, value) {
//                     // List template
//                     html += '<tr>';
//                     html += '<td>' + no + '</td>';no++;
//                     html += '<td>' + value.menu + '</td>';
//                     html += '<td class="table-action">';
//                     html += '<div class="form-check form-switch">';
//                     html += '<input class="form-check-input h3 my-0" type="checkbox" role="switch" id="">'; 
//                     html += '</div>';
//                     html += '</td>';
//                     html += '</tr>';
//                 });
//             } else {
//                 html += '<tr class="alert alert-warning">';
//                 html += 'Data tidak tersedia!';
//                 html += '</tr>';
//             }
//             // Insert the HTML Template and display all employee records
//             $("#menu-list").html(html);
//         }
//     });
// }

//---- PANGGIL FUNGSI ----
$(document).ready(function () {
    // all();

    //Tippy
});