<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="icon" href="<?= base_url()?>assets/logo/logo.png" type="image/png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dashboard - Cikrak</title>
        <!-- STYLE LOGIN -->
        <style>
            #dataPetugas th {
            white-space: nowrap; /* Agar teks dalam th tidak patah-patah */
            }

            #dataPetugas td {
            max-width: 200px; /* Menentukan lebar maksimal kolom */
            overflow: hidden;
            text-overflow: ellipsis; /* Menampilkan ellipsis jika teks terlalu panjang */
            white-space: nowrap;
            }
            .divider:after,
            .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            }
            .h-custom {
            height: calc(100% - 73px);
            }
            @media (max-width: 450px) {
            .h-custom {
            height: 100%;
            }
            }
        </style>
        <style>
            .image-crop {
                width: 150px;
                height: 180px;
                overflow: hidden;               
            }

            .image-crop img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        </style>
        <style>
            .centered-header {
                text-align: center;
            }
            .aksi-column {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .aksi-column button {
                margin: 0 5px; /* Sesuaikan jarak antara tombol jika diperlukan */
            }
            .loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #eeeeee;
                z-index: 9999;
                transition: opacity 0.75s, visibility 0.75s;
            }

            .loader::after{
                content: "";
                width: 75px;
                height: 75px;
                border: 8px solid #dddddd;
                border-top-color: #286090;
                border-radius: 50%;
                animation: loading 0.75s ease infinite;

            }

            .loader--hidden {
                opacity: 0;
                visibility: hidden;
            }
            @keyframes loading {
                from { transform: rotate(0turn);}
                to { transform: rotate(1turn);}
            }
        </style>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url()?>assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url()?>assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url()?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url()?>assets/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?php echo base_url()?>assets/css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>