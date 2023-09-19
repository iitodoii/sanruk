<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="dist/img/s.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบขายตะกร้าหวาย-บ้านหลุมข้าว</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Thai:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<?php
header("Content-Type: text/html;charset=UTF-8");
session_start();

if (isset($_SESSION["user_id"])) {
    if ($_SESSION["level"] = "user") {
    } else if ($_SESSION["level"] = "admin") {
    }
} else {
    echo "<script type='text/JavaScript'> alert('กรุณา Login ก่อน {$_SESSION["user_id"]}');window.location.href='index.php';</script>";
}
include '_con.php';
$id = $_SESSION["user_id"];
$sql = "SELECT * FROM tbl_user WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

        <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" style="font-family: 'Noto Serif Thai','Fredoka', Serif;">
            <div class="wrapper">

                <!-- Preloader -->
                <div class="preloader flex-column justify-content-center align-items-center">
                    <img class="animation__wobble" src="dist/img/s.png" alt="AdminLTELogo" height="60" width="60">
                </div>

                <!-- Navbar -->
                <nav class="main-header navbar navbar-expand navbar-dark">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                        <!-- <li class="nav-item d-none d-sm-inline-block">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contact</a>
                        </li> -->
                    </ul>

                </nav>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <!-- Brand Logo -->
                    <a href="index_admin.php" class="brand-link">
                        <!-- <img src="dist/img/s.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-white" style="opacity: 1"> -->
                        <small class="brand-text font-weight-light">ระบบขายตะกร้าหวาย-บ้านหลุมข้าว</small>
                    </a>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block"><?php echo $row['firstname'] . " " . $row['lastname'] ?></a>
                            </div>
                        </div>

                        <!-- SidebarSearch Form -->
                        <div class="form-inline">
                            <div class="input-group" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-sidebar">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item menu-open">
                                    <a href="#" class="nav-link active">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>
                                            เมนู
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="index_admin.php" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>ออเดอร์สินค้าทั้งหมด</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="manage_product.php" class="nav-link">
                                                <i class="fas fa-boxes nav-icon"></i>
                                                <p>จัดการข้อมูลสินค้า</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="manage_admin.php" class="nav-link">
                                                <i class="far fa-user-circle nav-icon"></i>
                                                <p>จัดการข้อมูลผู้ใช้งาน</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงาน</p>
                                            </a>
                                        </li>
                                    </ul> -->
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_1.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานสินค้าตามประเภท</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_2.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานข้อมูลสมาชิก</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_3.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานข้อมูลการสั่งซื้อ</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_4.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานสถานะการชำระเงิน</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_4_2.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานการจัดส่ง</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_5.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานข้อมูลสินค้าขายดี 5 อันดับ</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_6.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานจำนวนสินค้าคงเหลือ</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_7.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานจำนวนสินค้าคงเหลือต่ำกว่า 5 หน่วย</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="report_8.php" class="nav-link">
                                                <i class="far fa-file-alt nav-icon"></i>
                                                <p>รายงานยอดขาย</p>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </li>
                                <li class="nav-item">
                                    <a href="_logout.php" class="nav-link">
                                        <i class=" nav-icon fas fa-door-open text-danger"></i>
                                        <p>ออกจากระบบ</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>
        <?php
    }
} ?>