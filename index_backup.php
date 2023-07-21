<?php include '_header.php' ?>


<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" sty>
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="dist/img/c_8.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="dist/img/c_9.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="dist/img/c_11.jpg" alt="Third slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="dist/img/c_10.jpg" alt="Third slide">
        </div>
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
            <h4 class="m-0"> รายการสินค้า <small>สังฆภัณฑ์</small></h4>
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
    include '_con.php';
    $sql = "SELECT * FROM tbl_product order by date DESC";
    $result = $conn->query($sql);

    ?>



    <!-- Main content -->
    <div class="content mt-2 mb-4">
      <div class="container pb-4">
        <div class="row">

          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='col-lg-3 col-md-6 col-sm-12'>" .
                '<div class="card blue-hover" style="width: 17rem;">' .
                '<div class="card-body">' .
                "<a href='product.php?id={$row["id"]}'><img src='{$row["img"]}' style='width:100%;height:auto;object-fit: cover;'></a>" .
                "<p class='card-text font-weight-bold limit-text-head mt-2 pt-2'>{$row["name"]}</p>" .
                "<p class='card-text limit-text'>{$row["description"]}</p>" .
                "<a href='product.php?id={$row["id"]}' class='card-link'>ซื้อเลย</a>" .
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