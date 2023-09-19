<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="dist/img/s.png">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>San ruk</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="dist/css/custom.css">
    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Thai:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<?php
header("Content-Type: text/html;charset=UTF-8");
session_start();

// if (isset($_SESSION["user_id"])) {

// } else {
//     echo "<script type='text/JavaScript'> alert('กรุณา Login ก่อน {$_SESSION["user_id"]}');window.location.href='index.php';</script>";
// }
if (isset($_SESSION["user_id"])) {
    include '_con.php';
    $id = $_SESSION["user_id"];
    $sql = "SELECT * FROM tbl_user WHERE id = $id";
    $firstname = "";
    $lastname = "";
    $address = "";
    $tel = "";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $address = $row['address'];
            $tel = $row['tel'];
        }
    }
}
?>

<body class="hold-transition layout-top-nav" style="font-family: 'Noto Serif Thai','Fredoka', Serif;">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/s.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- Content Wrapper. Contains page content -->
        <!-- Navbar -->
        <!-- <nav class="main-header navbar navbar-expand-md fixed-top navbar-light" > -->
        <nav class="main-header navbar navbar-expand-md fixed-top navbar-light" style="background-color:#ff9d47;">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="dist/img/s.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text text-shadow text-dark">San ruk</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">ร้านค้า</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="custom.php" target="_blank" class="nav-link">สั่งตะกร้าแบบกำหนดรูปแบบเอง</a>
                        </li>
                    </ul>

                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <?php
                    if (isset($_SESSION["user_id"])) {
                    ?>
                        <li class="nav-item">
                            <div>
                                <!-- <a class="nav-link">สวัสดีคุณ</a> -->
                                <a class="nav-link">สวัสดีคุณ <?php echo $firstname . " " . $lastname ?></a>

                            </div>
                        </li>
                        <li class="nav-item dropdown-cart">
                            <a class="nav-link" href="summary.php">
                                <i class="fas fa-shopping-cart"></i>
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    $sum = count($_SESSION['cart']);
                                    echo "<span class='badge badge-info navbar-badge'>{$sum}</span>";
                                } else {
                                    echo "<span class='badge badge-info navbar-badge'>0</span>";
                                }
                                ?>

                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">สินค้าทั้งหมด</span>
                                <div class="dropdown-divider"></div>
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $key => $value) { //เป็นการวนซ้ำข้อมูลที่อยู่ในตัวแปร Global ในส่วนของตะกร้ามาแสดงผล
                                        echo '<a href="summary.php" class="d-flex justify-content-between  dropdown-item">';
                                        echo "<div><span class='mini-limit-text'><i class='fas fa-shopping-basket mr-2'></i>{$value['name']}</span></div>";
                                        echo "<span class='float-right text-muted text-sm'>{$value['qty']}</span>";
                                        echo "</a>";
                                    }
                                } else {
                                    echo '<a href="summary.php" class="d-flex justify-content-center  dropdown-item">';
                                    echo "<div><span>ไม่มีรายการสินค้า</span></div>";
                                    echo "</a>";
                                }

                                ?>
                                <div class="dropdown-divider"></div>
                                <a href="summary.php" class="dropdown-item dropdown-footer">ดูรายการสินค้าทั้งหมด</a>
                            </div>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                                <i class="fas fa-th-large"></i>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-slide="true" href="check_order.php" role="button">
                                <i class="fas fa-file-invoice"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="_logout.php" class="nav-link text-danger"><i class=" nav-icon fas fa-door-open text-danger"></i> ออกจากระบบ</a>
                        </li>
                    <?php
                    } else {
                        echo '<a class="nav-link" data-toggle="modal" data-target="#loginModal" href="#" role="button">
                                    <i class="far fa-user-circle"></i>
                                </a>';
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เข้าสู่ระบบ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form id="login-form" role="form">
                            <div class="form-group">
                                <label for="username"><span class="glyphicon glyphicon-user"></span>ชื่อผู้ใช้งาน</label>
                                <input type="text" name="username" class="form-control clsValidate" id="username" placeholder="ชื่อผู้ใช้งาน">
                            </div>
                            <div class="form-group">
                                <label for="password"><span class="glyphicon glyphicon-eye-open"></span> รหัสผ่าน</label>
                                <input type="password" name="password" class="form-control clsValidate" id="password" placeholder="รหัสผ่าน">
                            </div>
                        </form>
                        <button class="btn btn-success btn-block" onclick="submitLoginForm()"><span class="glyphicon glyphicon-off"></span>เข้าสู่ระบบ</button=>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger">hello</button> -->
                        <div class="row">
                            <p><a href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal" aria-label="Close"> ลงทะเบียน</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">สมัครสมาชิก</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form id="register-form" role="form">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="reg_name"><span class="glyphicon glyphicon-user"></span>ชื่อ</label>
                                        <input type="text" class="form-control clsValidate" id="reg_name" name="reg_name" placeholder="ชื่อ">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="reg_lastname"><span class="glyphicon glyphicon-user"></span>ชื่อนามสกุล</label>
                                        <input type="text" class="form-control clsValidate" id="reg_lastname" name="reg_lastname" placeholder="ชื่อนามสกุล">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_address"><span class="glyphicon glyphicon-user"></span>ที่อยู่</label>
                                <textarea type="text" class="form-control clsValidate" id="reg_address" name="reg_address" placeholder="ที่อยู่" row="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="reg_email"><span class="glyphicon glyphicon-user"></span>อีเมล์</label>
                                <input type="email" class="form-control clsValidate" id="reg_email" name="reg_email" placeholder="อีเมล์">
                            </div>
                            <div class="form-group">
                                <label for="reg_tel"><span class="glyphicon glyphicon-user"></span>เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="reg_tel clsValidate" name="reg_tel" placeholder="เบอร์โทรศัพท์">
                            </div>
                            <div class="form-group">
                                <label for="reg_usrname"><span class="glyphicon glyphicon-user"></span>ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" id="reg_usrname clsValidate" name="reg_usrname" placeholder="ชื่อผู้ใช้งาน">
                            </div>
                            <div class="form-group">
                                <label for="reg_psw"><span class="glyphicon glyphicon-eye-open"></span> รหัสผ่าน</label>
                                <input type="password" class="form-control clsValidate" id="reg_psw" name="reg_psw" placeholder="รหัสผ่าน">
                            </div>
                        </form>
                        <button class="btn btn-success btn-block" onclick="submitRegisterForm()"><span class="glyphicon glyphicon-off"></span>ลงทะเบียน</button=>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger">hello</button> -->
                        <div class="row">
                            <p><a href="#"> ลงทะเบียน</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                onChangeEvent();
            });

            function onChangeEvent() {
                $("input").change(function() {
                    var inputElements = $(".modal").find("input");
                    inputElements.each(function() {
                        if ($(this).val() === '') {
                            $(this).addClass('is-invalid').removeClass('is-valid');
                        } else {
                            $(this).addClass('is-valid').removeClass('is-invalid');
                        }
                    });
                });

                var textAreaElements = $(".modal").find("textarea");
                textAreaElements.each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid').removeClass('is-valid');
                    } else {
                        $(this).addClass('is-valid').removeClass('is-invalid');
                    }
                });

                $('#login-form').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    // formData.append('faviconFile', $('#fileinput').prop('files'));
                    _chkLogin(formData);
                });
                $('#register-form').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    // formData.append('faviconFile', $('#fileinput').prop('files'));
                    register(formData);
                });
            }

            function submitLoginForm() {
                if (chkValidateLogin())
                    $("#login-form").submit();
                else {
                    Swal.fire({
                        title: 'แจ้งเตือน',
                        icon: 'warning',
                        text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
                    })
                }
            }

            function submitRegisterForm() {
                if (chkValidateRegister())
                    $("#register-form").submit();
                else {
                    Swal.fire({
                        title: 'แจ้งเตือน',
                        icon: 'warning',
                        text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
                    })
                }
            }

            function chkValidateLogin() {
                let isCanSave = true;
                var inputElements = $("#loginModal").find("input");
                inputElements.each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid').removeClass('is-valid');
                        isCanSave = false;
                    } else {
                        $(this).addClass('is-valid').removeClass('is-invalid');
                    }
                });
                // $("#loginModal > div > form > input.clsValidate").each(function(index) {

                // });
                return isCanSave;
            }

            function chkValidateRegister() {
                let isCanSave = true;
                var inputElements = $("#registerModal").find("input");
                inputElements.each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid').removeClass('is-valid');
                        isCanSave = false;
                    } else {
                        $(this).addClass('is-valid').removeClass('is-invalid');
                    }
                });
                var textAreaElements = $("#registerModal").find("textarea");
                textAreaElements.each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid').removeClass('is-valid');
                        isCanSave = false;
                    } else {
                        $(this).addClass('is-valid').removeClass('is-invalid');
                    }
                });
                return isCanSave;
            }

            function _chkLogin(formData) {
                $.ajax({
                    url: '_chkLogin_User.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(msg) {
                        if (msg == 'user') {
                            swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: "Successfully",
                                text: "เข้าสู่ระบบสำเร็จ",
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                location.reload(true);
                            })
                        } else if (msg == 'admin') {
                            swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: "Successfully",
                                text: "เข้าสู่ระบบสำเร็จ",
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                window.location.href = "index_admin.php";
                            })
                        } else {
                            swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: "Failed",
                                text: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง",
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    },
                    failure: function(msg) {
                        swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: msg,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
            }

            function register(formData) {
                $.ajax({
                    url: '_register.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(msg) {
                        swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: "Successfully",
                            text: "สมัครสมาชิกสำเร็จ",
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            location.reload(true);
                        })
                    },
                    failure: function(msg) {
                        swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: "Error",
                            text: "สมัครสมาชิกไม่สำเร็จ",
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
            }
        </script>

        <style type="text/css">
        </style>
        <!-- /.navbar -->