<?php include_once "../includes/db.php";?><?php include_once "function.php";ob_start();session_start();?><?php    if (!isset($_SESSION['user_role'])){        if($_SESSION['user_role'] != 'admin'){            header('Location: ../index.php');        }    }?><!DOCTYPE html><html lang="en">    <head>                <meta charset="utf-8">        <meta http-equiv="X-UA-Compatible" content="IE=edge">        <meta name="viewport" content="width=device-width, initial-scale=1">        <meta name="description" content="">        <meta name="author" content="">        <title>SB Admin - Bootstrap Admin Template</title>        <!-- Bootstrap Core CSS -->        <link href="css/bootstrap.min.css" rel="stylesheet">        <!-- Custom CSS -->        <link href="css/sb-admin.css" rel="stylesheet">        <link href="css/styles.css" rel="stylesheet">        <script language="javascript" type="text/javascript" src="js/jquery.js"></script>        <!-- CDN -->        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>        <!-- Custom Fonts -->        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->        <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>        <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>        <!-- GOOGLE CHART -->        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>        <!-- TinyMCE script --><!--        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->        <script src="https://cdn.tiny.cloud/1/fm2bv66y1t9gye351sovgjyea0by609hn8cwdyg58uoej5d5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>    </head>    <body><!-- Footer--><?php include "includes/admin_footer.php"; ?>