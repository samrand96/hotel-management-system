<?php
if(basename($_SERVER['PHP_SELF']) == 'header.php'):
    header("Location: index.php");
endif;
session_start();
if(!isset($_SESSION["login"]) || !$_SESSION["login"]):
    echo '<script>window.location.href = "login.php"</script>';
    exit(0);
endif;
$title = basename($_SERVER["PHP_SELF"]);
$title = substr($title,0,strpos($title,'.'));
$title = str_replace("_"," ",$title);
$title = ucwords($title);
if($title == "Index"):
    $title = "Dashboard";
endif;
$fileName = (basename($_SERVER["PHP_SELF"]));
$fileName = substr($fileName,0,strpos($fileName,'.'));
$pages = empty($_GET['page'])?"none":$_GET['page'];
if(in_array($fileName,array('users','reservation_types','room_types','customer_types','room_locations','room_accommodations')) && !$_SESSION['is_admin']){
    echo '<script>window.location.href = "login.php"</script>';
    exit(0);
}
?>
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title; ?> - iHospitality</title>
        <link href="_assets/css/styles.css" rel="stylesheet" />
        <link href="_assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="_assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">iHospitality</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="logout.php"><i class="fas fa-user"></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?= $fileName==='index'?'active':''; ?>" href="index.php">
                                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Customer</div>
                            <a class="nav-link <?= $fileName==='customers'?'active':''; ?>" href="customers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customers
                            </a>
                            <?php if($_SESSION['is_admin']): ?>
                            <a class="nav-link <?= $fileName==='customer_types.php'?'active':''; ?>" href="customer_types.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Customer Types
                            </a>
                            <?php endif; ?>
                            <div class="sb-sidenav-menu-heading">Reservation</div>
                            <a class="nav-link <?= $fileName==='reservations.php'?'active':''; ?>" href="reservations.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-restroom"></i></div>
                                Reservations
                            </a>
                            <?php if($_SESSION['is_admin']): ?>
                            <a class="nav-link <?= $fileName==='reservation_types'?'active':''; ?>" href="reservation_types.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-prescription-bottle"></i></div>
                               	Reservation Types
                            </a>
                            <?php endif; ?>
                            <div class="sb-sidenav-menu-heading">Room</div>
                            <a class="nav-link <?= $fileName==='rooms'?'active':''; ?>" href="rooms.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-house-user"></i></div>
                                Rooms
                            </a>
                            <?php if($_SESSION['is_admin']): ?>
                            <a class="nav-link <?= $fileName==='room_types'?'active':''; ?>" href="room_types.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-laptop-house"></i></div>
                                Room Types
                            </a>
                            <a class="nav-link <?= $fileName==='room_accommodations'?'active':''; ?>" href="room_accommodations.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Room Accommodations
                            </a>
                            <a class="nav-link <?= $fileName==='room_locations'?'active':''; ?>" href="room_locations.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-map-pin"></i></div>
                                Room Locations
                            </a>
                            <div class="sb-sidenav-menu-heading">Settings</div>
                            <a class="nav-link <?= $fileName==='users'?'active':''; ?>" href="users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Users
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= $_SESSION["full_name"] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-9 col-sm-9">
                                <h1 class="mt-4"><?= $title; ?></h1>
                            </div>
                            <?php if($title != "Dashboard"): ?>
                            <div class="col col-3 col-sm-3 mt-4">
                                <button class="btn btn-lg btn-success float-right" data-toggle="modal" data-target="#add_modal"><span class="fas fa-plus"></span>&nbsp;Add <?= $title; ?></button>
                            </div>
                            <?php endif; ?>
                        </div>    
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item <?= $title=="Dashboard"?"active":""; ?>"><?= $title!="Dashboard"?"<a href='index.php'>":""; ?>Dashboard<?= $title!="Dashboard"?"</a>":""; ?></li>
                            <?php if($title != "Dashboard"): ?>
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            <?php endif; ?>
                        </ol>