<?php include '_header.php' ?>


<div class="wrapper" style="margin-top:5vh;margin-bottom:5vh">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <?php
    include '_con.php';//1
    $sql = "SELECT * FROM tbl_user where id = '{$_SESSION['user_id']}'";//2
    $result = $conn->query($sql);//3
    ?>



    <!-- Main content -->
    <div class="content p-4">
      <div class="container mt-4">
        <div class="row">
          <h4 class="mr-4">รายละเอียดสินค้าในตะกร้า </h4>
        </div>
        <div class="row">
          <div class="col-12">
            <table id="summary" class="table table-bordered table-hover">
              <!-- thead = table header ส่วนหัวของตาราง -->
              <thead class="bg-warning"> 
                <th>รหัสสินค้า</th>
                <th>รูปสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวนสินค้า</th>
                <th>ราคาสินค้า</th>
                <th>ยอดรวม</th>
                <th>ลบ</th>
              </thead>
              <!-- tbody = table body ส่วนของข้อมูลที่ต้องวนซ้ำ -->
              <tbody>

                <?php
                $total = 0;
                if(isset($_SESSION['cart'])){ //วนซ้ำข้อมูลที่อยู่ในตะกร้าสินค้าออกมาในรูปแบบของตาราง
                  foreach ($_SESSION['cart'] as $key => $value) {
                    echo "<tr>";
                    echo "<td> {$value['id']} </td>"; //รหัสของสินค้า
                    echo "<td> <img src='{$value['img']}' width='auto' height='60vh'></td>"; //รูปภาพของสินค้า
                    echo "<td> {$value['name']} </td>"; //ชื่อของสินค้า
                    echo "<td> {$value['qty']} </td>"; //จำนวนสินค้า
                    echo "<td> {$value['price']} </td>"; //ราคาสินค้า
                    $sum = $value['qty'] * $value['price']; //นำจำนวนและราคามา * กัน
                    $total += $sum;
                    echo "<td> {$sum} </td>"; //แสดงผลยอดรวมของสินค้านั้นๆ
                    echo "<td><i id='delete-item' class='fas fa-trash text-danger'></i></td>";
                    echo "</tr>";
                  }
                }else{
                  
                }
                ?>
              </tbody>
              <!-- tfoot = Table footer ส่วนสรุปของตาราง -->
              <tfoot>
                <th colspan="5" class="text-right">ยอดรวมทั้งสิ้น</th>
                <th colspan="1">
                  <p id="total"><?php echo $total ?></p>
                </th>
                <th colspan="1"></th>
              </tfoot>
            </table>
          </div>
        </div>
        <hr>
        <div class="row">
          <h4 class="mr-4">รายละเอียดการจัดส่ง </h4>
          <!-- <button class="btn btn-outline-success btn-sm h-50"> ดึงข้อมูลเดิม <i class="fas fa-copy"></i></button> -->
        </div>
        <?php
        if ($result->num_rows > 0) { //นำข้อมูลมาแสดง
          while ($row = $result->fetch_assoc()) {
        ?>
            <div class="row mt-4 d-flex justify-content-center">
              <div class="col-2">
                <p>ชื่อ-นามสกุล</p>
              </div>
              <div class="col-4">
                <input type="name" id="name" name="name" class="form-control" placeholder="ชื่อ-นามสกุล" value='<?php echo $row["firstname"] . " " . $row["lastname"]; ?>' />
              </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
              <div class="col-2">
                <p>ที่อยู่</p>
              </div>
              <div class="col-4">
                <textarea class="form-control" type="address" id="address" name="address" placeholder="ที่อยู่"><?php echo $row["address"]; ?> </textarea>
              </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
              <div class="col-2">
                <p>อีเมล์</p>
              </div>
              <div class="col-4">
                <input type="email" id="email" name="email" class="form-control" placeholder="อีเมล์" value='<?php echo $row["email"]; ?>' />
              </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
              <div class="col-2">
                <p>เบอร์โทรศัพท์</p>
              </div>
              <div class="col-4">
                <input type="tel" id="tel" name="tel" class="form-control" placeholder="เบอร์โทรศัพท์" value='<?php echo $row["tel"]; ?>' />
              </div>
            </div>

          <?php
          }
        } else {
          ?>
          <div class="row mt-4 d-flex justify-content-center">
            <div class="col-2">
              <p>ชื่อ-นามสกุล</p>
            </div>
            <div class="col-4">
              <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อ-นามสกุล" />
            </div>
          </div>
          <div class="row mt-2 d-flex justify-content-center">
            <div class="col-2">
              <p>ที่อยู่</p>
            </div>
            <div class="col-4">
              <textarea class="form-control" type="text" id="address" name="address" placeholder="ที่อยู่"></textarea>
            </div>
          </div>
          <div class="row mt-2 d-flex justify-content-center">
            <div class="col-2">
              <p>อีเมล์</p>
            </div>
            <div class="col-4">
              <input type="email" id="email" name="email" class="form-control" placeholder="อีเมล์" />
            </div>
          </div>
          <div class="row mt-2 d-flex justify-content-center">
            <div class="col-2">
              <p>เบอร์โทรศัพท์</p>
            </div>
            <div class="col-4">
              <input type="text" id="tel" name="tel" class="form-control" placeholder="เบอร์โทรศัพท์" />
            </div>
          </div>
        <?php
        }
        ?>
        <div class="d-flex justify-content-end mt-4">
          <button class="btn btn-info" id="confirm">ยินยันการสั่งซื้อสินค้า</button>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->



  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    //ส่วนของตาราง ทำให้ตารางสวยขึ้น
    var table = $('#summary').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      columnDefs: [{
          targets: [-1],
          width: '10px'
        },
        // { targets: '_all', visible: false }
      ],
      "initComplete": function() {
        let api = this.api();
        api.$('td #delete-item').click(function() {
          let product_id = api.row($(this).parent().parent()).data()[0];
          console.log(product_id);

          Swal.fire({
            title: 'ยืนยันลบสินค้าจากตะกร้า?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
          }).then((result) => {
            //กดตกลงในการลบสินค้า จะทำการไปยังหน้า _deleteCart.php
            if (result.isConfirmed) {
              $.ajax({
                url: '_deleteCart.php', //ไปยังหน้า deleteCart.php
                type: 'POST',
                data: {
                  product_id: product_id
                },
                success: function(msg) {
                  swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'ลบสินค้าเรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 2000
                  }).then((result) => {
                    location.reload();
                  })
                },
                failure: function(msg) {
                  swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'ลบสินค้าไม่สำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                  })
                }
              });
            }
          })
        });
      }
    });

    //กดยืนยันออเดอร์ ConfirmOrder.php
    $('#confirm').click(function() {
      $.ajax({
        url: '_confirmOrder.php', //ไปยังหน้า ConfirmOrder.php
        type: 'POST',
        data: {
          name:$('#name').val(),
          address:$('#address').val(),
          email:$('#email').val(),
          tel:$('#tel').val(),
          total:parseFloat($('#total').text()),
        },
        success: function(msg) {
          swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'สั่งซื้อสินค้าเรียบร้อยแล้ว',
            showConfirmButton: false,
            timer: 2000
          }).then((result) => {
            location.reload();
          })
        },
        failure: function(msg) {
          swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'สั่งซื้อสินค้าไม่สำเร็จ',
            showConfirmButton: false,
            timer: 2000
          })
        }
      });
    });
  });
</script>
<?php include '_footer.php' ?>