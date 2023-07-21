<?php include '_header_admin.php'; ?>
<!-- เมนูส่วนของ Admin -->

<?php
include '_con.php';
$sql = "SELECT * FROM order_header";
$result = $conn->query($sql);

?>

<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .swal-title{
    color:'#716add' !important;
    background-color: '#292b2c' !important;
  }
  #swal-title{
    color:'#716add' !important;
    background-color: '#292b2c' !important;
  }
  .dataTables_filter {
    text-align: right;
  }
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <h4 class="mr-4 mt-4">ออเดอร์สินค้าทั้งหมด </h4>
      </div>
      <div class="row">
        <div class="col-12">
          <table id="summary" class="table table-bordered table-hover">
            <!-- thead = table header ส่วนหัวของตาราง--> 
            <thead class="bg-warning"> 
              <th>รหัสออเดอร์</th>
              <th>ชื่อผู้สั่งซื้อ</th>
              <th>ที่อยู่ในการจัดส่ง</th>
              <th>อีเมล์</th>
              <th>เบอร์โทรศัพท์</th>
              <th>ยอดรวม</th>
              <th>สถานะ</th>
              <th class="text-nowrap">รายละเอียด</th>
              <th class="text-nowrap">อัพเดทสถานะ</th>
            </thead>

            <!-- ส่วนของการวนซ้ำนำข้อมูลออเดอร์มาแสดง -->
            <tbody>
              <?php
              $total = 0;
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td> {$row['id']} </td>"; //รหัสออเดอร์
                  echo "<td> {$row['order_name']} </td>"; //ชื่อออเดอร์ ชื่อผู้รับสินค้า
                  echo "<td> {$row['order_address']} </td>"; //ที่อยู่จัดส่งพัสดุ
                  echo "<td> {$row['order_email']} </td>";//อีเมลล์ของลูกค้า
                  echo "<td> {$row['order_tel']} </td>";//เบอร์โทรศัพท์
                  echo "<td> {$row['order_total']} </td>"; //ยอดรวมราคาของออเดอร์
                  // echo "<td> {$value['']} </td>";

                  if ($row["order_status"] == "1") { //รอการชำระเงิน
                    echo "<td>รอการชำระเงิน</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='orderDetail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-secondary text-white'><i class='fas fa-wrench text-white mr-1'></i>รอการชำระเงิน</a></td>";//ปุ่มสีเหลือง
                  }else if ($row["order_status"] == "2") { //กำลังตรวจสอบ
                    echo "<td>กำลังตรวจสอบ</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='orderDetail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-info text-white' data-toggle='modal' data-target='#updateModal' id='update'><i class='fas fa-wrench text-white mr-1' ></i>ยืนยัน</a></td>";//ปุ่มสีเทา
                  }else if ($row["order_status"] == "3") { //กำลังจัดส่ง
                    echo "<td>กำลังจัดส่ง</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='orderDetail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-secondary text-white'><i class='fas fa-wrench text-white mr-1'></i>รอยืนยัน</a></td>";//ปุ่มสีเทา
                  }else if ($row["order_status"] == "4") { //จัดส่งเรียบร้อย
                    echo "<td>จัดส่งเรียบร้อย</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='orderDetail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-secondary text-white' data-toggle='modal' data-target='#updateModal' id='update'><i class='fas fa-wrench text-white mr-1'></i>เสร็จสิ้น</a></td>";
                  }
                  echo "</tr>";
                }
              } else {
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- ส่วนที่เด้งขึ้นมาให้กรอกเลข Tracking (เลขพัสดุ) เพิ่มเปลี่ยนสถานะสินค้า -->
<div class="modal fade" id="updateModal"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">กรุณาใส่เลข Tracking เพื่ออัพเดท</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="order_id" />
        <div class="row">
          <div class="col-12">
              สลิปยืนยัน
          </div>
          <div class="col-12">
            <img class="rounded-lg" style="width:100%;height:auto;padding:10px 50px 10px 50px" src="dist/img/slip/SL0005/SL0005.jpg"/>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <p>Tracking number</p>
          </div>
          <div class="col-8">
            <input class="form-control" type="text" id="tracking" />
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateStatus()" class="btn btn-primary">อัพเดทสถานะ</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#summary').DataTable({
      dom: '<"top"f>rt<"bottom"lip><"clear">',
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "initComplete": function() {
        let api = this.api();
        api.$('td #update').click(function() {
          let order_id = api.row($(this).parent().parent()).data()[0];
          console.log(order_id);
          $('#order_id').val(order_id);
          $('#updateModal').show();
        });
      }
    });

  });

  function updateStatus() {
    Swal.fire({
      title: 'ยืนยันจะอัพเดทสถานะ?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'ตกลง',
      cancelButtonText: 'ยกเลิก',
    }).then((result) => {
      //อัพเดทสถานะโดยไปยังไฟล์ _updateStatus.php
      if (result.isConfirmed) {
        $.ajax({
          url: '_updateStatus.php',
          type: 'POST',
          data: {
            order_id: $('#order_id').val(),
            tracking: $('#tracking').val()
          },
          success: function(msg) {
            swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'อัพเดทสถานะเรียบร้อย',
              color: '#716add',
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
              title: 'อัพเดทสถานะไม่สำเร็จ',
              color: '#716add',
              showConfirmButton: false,
              timer: 2000
            })
          }
        });
      }
    })
  }
</script>
<?php include '_footer_admin.php'; ?>