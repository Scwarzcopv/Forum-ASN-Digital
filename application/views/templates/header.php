<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/icons/logo.png" />

    <title>
        <?= $title; ?>
    </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Custom -->
    <link href="<?= base_url('assets'); ?>/css/custom-all.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Template -->
    <link href="<?= base_url('assets'); ?>/css/light.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JqueryValidation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js" integrity="sha512-IFD8s8Ds5M/7XsAQXNXtHVdiA8EnBR6bZhy0R+Y7fruej9fNPkrZ6+0/dP8yfRU1u2x9De4WYGCNvoaIhmhnpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- TippyJs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/2.5.4/themes/translucent.css" integrity="sha512-dWBQD/Xe0nNL1i41lgke8ZvPLqos/dGKi2u4h95v8c0tB2JgiULjCYWptWfBqEW58bxP6wHsFI0DwTZlCRYtHQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CropperJs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.css" integrity="sha512-5ZQRy5L3cl4XTtZvjaJRucHRPKaKebtkvCWR/gbYdKH67km1e18C1huhdAc0wSnyMwZLiO7nEa534naJrH6R/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.css" integrity="sha512-5ZQRy5L3cl4XTtZvjaJRucHRPKaKebtkvCWR/gbYdKH67km1e18C1huhdAc0wSnyMwZLiO7nEa534naJrH6R/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <!-- Buat inisialisasi di js -->
    <input href="" class="d-none" id="baseUrl" name="baseUrl" value="<?= base_url(); ?>"></input>
    <div class="wrapper">