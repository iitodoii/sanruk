<?php include '_header.php' ?>


<!-- Content Wrapper. Contains page content -->
<?php
include '_con.php';
$id = $_GET['id']; //ดึงค่า id (รหัสสินค้า) มาจาก url

$sql = "SELECT * FROM tbl_product WHERE id = '$id'";
$result = $conn->query($sql);

?>
<div class="content-wrapper" style="margin-top:5vh;margin-bottom:5vh">

  <!-- Main content -->
  <div class="content p-4">

    <section class="container mt-4 mb-4">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { //นำข้อมูลที่ได้มาวนซ้ำเพื่อแสดงผล
      ?>
          <!-- Default box -->
          <div class="card card-solid">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="col-12">
                    <img src="<?php echo $row["img"] ?>" class="product-image" alt="Product Image">
                    <!-- แสดงผลรูปภาพจาก url ในฐานข้อมูล -->
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                  <h1 class="my-3"><?php echo $row["name"] ?></h1>
                  <!-- ชื่อของสินค้า -->
                  <hr>

                  <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                      ราคา <?php echo $row["price"] ?> บาท
                      <!-- ราคาของสินค้า -->
                    </h2>

                  </div>
                  <div class="row mt-2">
                    <div class="col-3">
                      <h5>การจัดส่ง : </h5>
                    </div>
                    <div class="col-9">
                      <p><i class="fas fa-truck"></i> จัดส่งทั่วประเทศ</p>
                    </div>
                    <div class="col-12">
                      <h5>มีสินค้าทั้งหมด <?php echo "<span id='qtyCount'>" . $row["qty"] . "</span>" . $row["unit"] ?></h5>
                    </div>
                    <div class="col-9">
                      <input type="text" id="product_id" name="product_id" class="form-control w-25 d-none" value='<?php echo $row["id"] ?>'>
                      <input type="text" id="product_name" name="product_name" class="form-control w-25 d-none" value='<?php echo $row["name"] ?>'>
                      <input type="text" id="product_price" name="product_price" class="form-control d-none" value='<?php echo $row["price"] ?>'>
                      <input type="text" id="product_img" name="product_img" class="form-control w-25 d-none" value='<?php echo $row["img"] ?>'>
                      <div class="input-group mb-3" style="width:30%">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-danger" type="button" onclick="decrease()">-</button>
                        </div>
                        <input type="text" id="product_qty" name="product_qty" class="form-control text-center" value="1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-success" type="button" onclick="increase()">+</button>
                        </div>
                      </div>
                      <p>มีสินค้าทั้งหมด <?php //echo $row["qty"] . " " . $row["unit"] 
                                          ?></p>
                    </div>
                  </div>

                  <!-- <div class="mt-4">
                    <a class="btn btn-lg rounded-lg" style="background-color:#ff9d47" href="<?php echo $row["shoppee_url"] ?>" target="_blank">
                      <img src="dist/img/Shopee-Logo-Transparent-Background.png" style="height:5vh;width:auto;" alt="Product Image">
                      ซื้อสินค้าเลย
                    </a>
                  </div> -->

                  <div class="mt-4">
                    <a id="add-item" class="btn btn-lg rounded-lg" style="background-color:#ff9d47">
                      <!-- <i class="background-image:url('../dist/img/Shopee-Logo-Transparent-Background.png')"></i> -->
                      <!-- <img src="dist/img/Shopee-Logo-Transparent-Background.png" style="height:5vh;width:auto;" alt="Product Image"> -->
                      เพิ่มสินค้าลงตะกร้า
                    </a>
                  </div>

                </div>
              </div>
              <div class="row mt-4">
                <nav class="w-100">
                  <div class="nav nav-tabs" id="product-tab" role="tablist">
                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">รายละเอียดสินค้า</a>
                  </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo nl2br($row["description"]) ?></div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      <?php  }
      } else {
        echo "0 results";
      }
      $conn->close();
      ?>
    </section>


  </div>
  <!-- /.content -->
</div>
<script type="text/javascript">
  $(document).ready(function() {
    //ถ้าปุ่มเพิ่มสินค้าโดนคลิก
    // if(parseInt(('#qtyCount').text())<=0){
    //   $('add-item').prop("disabled", true);
    // }
    $('#add-item').click(function() {
      var qtyCount = parseInt($("#qtyCount").text());
      if (parseInt($('#product_qty').val()) > qtyCount) {
        swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'สินค้าคงเหลือไม่เพียงพอ',
          showConfirmButton: false,
          timer: 2000
        })
      } else {
        $.ajax({
          url: '_addCart.php',
          type: 'POST',
          data: {
            //รับค่าจากหน้าจอแล้วส่งไปยังหน้า _addCart.php
            product_id: $('#product_id').val(),
            product_name: $('#product_name').val(),
            product_qty: $('#product_qty').val(),
            product_price: $('#product_price').val(),
            product_img: $('#product_img').val()
          },
          success: function(msg) {
            swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'เพิ่มสินค้าลงตระกร้าเรียบร้อย',
              showConfirmButton: false,
              timer: 2000
            })
          },
          failure: function(msg) {
            swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'เพิ่มสินค้าไม่สำเร็จ',
              showConfirmButton: false,
              timer: 2000
            })
          }
        });
      }

    });
  });
</script>
<?php include '_footer.php' ?>