<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="dist/img/s.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>San Ruk Shop | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Thai:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style type="text/css">
  .blur-card {
    backdrop-filter: blur(20px);
    background-color: rgba(white, 0.1);
    border: 1px solid rgba(white, 0.1);
    border-radius: 25px;
    box-shadow: 2px 2px 2px rgba(black, 0.1);
    /* cursor: pointer; */
  }
</style>

<body class="hold-transition login-page" style="background: url('dist/img/bg_2.jpg') no-repeat center center fixed; -webkit-background-size: cover;font-family: 'Noto Serif Thai','Fredoka', Serif;;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;">
  <div class="login-box">
    <div class="login-logo">
      <img src="dist/img/s.png" width="150vw" height="150vh">
      <br>
      <hr>
      <div class="blur-card">
        <a href="#" class="text-dark"><b>San ruk</b></a><br>
        <a href="#" class="text-dark"><b>ร้านค้าตะกร้าหวาย</b></a>
      </div>

    </div>
    <!-- /.login-logo -->
    <div class="card" style="border-radius: 15px !important; background-color:rgba(255, 156, 36,0.8);">
      <div class="card-body ">
        <p class="login-box-msg">กรุณาเข้าสู่ระบบ</p>

        <!-- หลังจากกด Login จะทำการเรียกไฟล์ CheckLogin.php -->
        <form action="_checklogin.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้งาน">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-friends"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-info btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>