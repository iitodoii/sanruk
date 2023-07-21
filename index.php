<?php include '_header.php' ?>
<!-- ส่วนของ Menu -->


<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- ส่วน Slide Picture -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" sty>
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="dist/img/banner1.png" alt="First slide">
        </div>
        <!-- <div class="carousel-item">
          <img class="d-block w-100" src="dist/img/c_9.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="dist/img/c_11.jpg" alt="Third slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="dist/img/c_10.jpg" alt="Third slide">
        </div> -->
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0"> รายการสินค้า <small>ตะกร้าหวาย</small></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Shop</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    include '_con.php'; //เชื่อมต่อฐานข้อมูล

    $sql = "SELECT * FROM tbl_product where category != 4 order by date DESC"; //คำสั่ง sql
    $result = $conn->query($sql); //การรันคำสั่ง sql

    ?>

    <!-- Main content -->
    <div class="content mt-2 mb-4">
      <div class="container pb-4">
        <div class="row">

          <?php
          if ($result->num_rows > 0) { //การแสดงผลโดยการวนซ้ำข้อมูลสินค้าจากฐานข้อมูล
            while ($row = $result->fetch_assoc()) {
              echo "<div class='col-lg-3 col-md-6 col-sm-12 my-4'>" .
                '<div class="card blue-hover" style="width: 17rem;">' .
                '<div class="card-body d-flex flex-column justify-content-between">' .


                "<a href='product.php?id={$row["id"]}'><img src='{$row["img"]}' style='width:100%;height:200px;object-fit: cover;'></a>" . //รูปภาพ

                "<p class='card-text font-weight-bold limit-text-head mt-2 pt-2'>{$row["name"]}</p>" . //ชื่อสินค้า
                "<p class='card-text limit-text'>{$row["description"]}</p>" . //รายละเอียดสินค้า
                "<a href='product.php?id={$row["id"]}' class='card-link btn btn-success'>ซื้อเลย</a>" . //ปุ่มสั่งซื้อและลิงค์ไปยังหน้าสินค้าพร้อมส่ง id (รหัสสินค้าไปด้วย)


                "</div></div></div>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();
          ?>


        </div>
        <div class="card">

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





  <?php include '_footer.php' ?>