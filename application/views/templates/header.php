<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/icons/logo.png" />

    <!-- Gstatic -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="<?= base_url('assets'); ?>/css/gstatic.css" rel="stylesheet">

    <title>
        <?= $title; ?>
    </title>

    <!-- Jquery -->
    <script src="<?= base_url('assets'); ?>/js/jquery3-7-0.js"></script>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets'); ?>/css/bootstrap5-3-0.min.css" rel="stylesheet">

    <!-- Template -->
    <link href="<?= base_url('assets'); ?>/css/light.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets'); ?>/js/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JqueryValidation -->
    <script src="<?= base_url('assets'); ?>/js/validate.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/validate.js"></script>

    <!-- TippyJs -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/tippy.css">

    <!-- CropperJs -->
    <link href="<?= base_url('assets'); ?>/css/cropper.css" rel="stylesheet" />
    <script src="<?= base_url('assets'); ?>/js/cropper.js"></script>

    <!-- Custom -->
    <link href="<?= base_url('assets'); ?>/css/custom-all.css" rel="stylesheet">
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <!-- Buat inisialisasi di js -->
    <input href="" class="d-none" id="baseUrl" name="baseUrl" value="<?= base_url(); ?>"></input>
    <div class="wrapper">