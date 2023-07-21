<?php include '_header.php'; ?>
<!-- เมนูส่วนของ Admin -->

<?php
include '_con.php';
if (isset($_SESSION["user_id"])) {
  $username = $_SESSION["user_id"];
} else {
}

$sql = "SELECT * FROM order_header where user_id = '$username'";
$result = $conn->query($sql);

?>

<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .swal-title {
    color: '#716add' !important;
    background-color: '#292b2c' !important;
  }

  #swal-title {
    color: '#716add' !important;
    background-color: '#292b2c' !important;
  }
  .dataTable_filter{
    text-align: right !important;
  }
</style>
<!-- <div class="content-wrapper">
  <section class="content"> -->
<div class="wrapper" style="margin-top:5vh;margin-bottom:5vh">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="container pt-4">

      <div class="row">
        <h4 class="mr-4 mt-4">ออเดอร์สินค้าทั้งหมด </h4>
      </div>
      <div class="row">
        <div class="col-12">
          <table id="summary" class="table table-bordered table-hover">
            <!-- thead = table header ส่วนหัวของตาราง-->
            <thead class="bg-warning">
              <th class="d-none">รหัสออเดอร์</th>
              <th>ชื่อผู้สั่งซื้อ</th>
              <th>ที่อยู่ในการจัดส่ง</th>
              <!-- <th>อีเมล์</th> -->
              <th>เบอร์โทรศัพท์</th>
              <th>ยอดรวม</th>
              <th>เลขพัสดุ</th>
              <th>สถานะ</th>
              <th>รายละเอียด</th>
              <th>อัพเดทสถานะ</th>
            </thead>

            <!-- ส่วนของการวนซ้ำนำข้อมูลออเดอร์มาแสดง -->
            <tbody>
              <?php
              $total = 0;
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td class='d-none'> {$row['id']} </td>"; //รหัสออเดอร์
                  echo "<td> {$row['order_name']} </td>"; //ชื่อออเดอร์ ชื่อผู้รับสินค้า
                  echo "<td> {$row['order_address']} </td>"; //ที่อยู่จัดส่งพัสดุ
                  // echo "<td> {$row['order_email']} </td>";//อีเมลล์ของลูกค้า
                  echo "<td> {$row['order_tel']} </td>"; //เบอร์โทรศัพท์
                  echo "<td> {$row['order_total']} </td>"; //ยอดรวมราคาของออเดอร์
                  // echo "<td> {$value['']} </td>";

                  if ($row["order_status"] == "1") { //สถานะรอการชำระ
                    echo "<td></td>";
                    echo "<td>รอการชำระเงิน</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='check_order_detail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-warning text-white' data-toggle='modal' data-target='#updateSlipModal' id='updateSlip'><i class='fas fa-file-upload text-white mr-1'></i></i>อัพสลิป</a></td>"; //ปุ่มสีเหลือง
                  } else if ($row["order_status"] == "2") { //สถานะรอการยืนยัน
                    echo "<td></td>";
                    echo "<td>กำลังตรวจสอบ</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='check_order_detail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-secondary text-white'><i class='fas fa-shipping-fast fa-spin text-white mr-1'></i>รอการจัดส่ง</a></td>"; //ปุ่มสีเทา
                  } else if ($row["order_status"] == "3") { //สถานะจัดส่งแล้ว
                    echo "<td>{$row['track_number']}</td>";
                    echo "<td>กำลังจัดส่ง</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='check_order_detail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-success text-white' id='updateFinish'><i class='fas fa-archive text-white mr-1'></i></i>ยืนยันการรับสินค้า</a></td>"; //ปุ่มสีเขียว
                  } else if ($row["order_status"] == "4") { //สถานะได้รับแล้ว
                    echo "<td>{$row['track_number']}</td>";
                    echo "<td>จัดส่งเรียบร้อย</td>";
                    echo "<td class='text-center'><a class='btn btn-success' href='check_order_detail.php?order_id={$row['id']}' id='detail'><i class='fas fa-info-circle text-white mr-1'></i> รายละเอียด</a></td>";
                    echo "<td class='text-center'><a class='btn btn-secondary text-white'><i class='fas fa-archive text-white mr-1'></i></i>เสร็จสิ้น</a></td>"; //ปุ่มสีเทา
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
    <!-- </section>

</div> -->

    <!-- ส่วนที่เด้งขึ้นมาให้กรอกเลข Tracking (เลขพัสดุ) เพิ่มเปลี่ยนสถานะสินค้า -->
    <!-- <div class="modal fade" id="updateModal">
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
      </div>
    </div> -->
    <!-- ส่วนที่เด้งขึ้นมาอัพโหลดสลิป เพิ่มเปลี่ยนสถานะสินค้า -->
    <div class="modal fade" id="updateSlipModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">กรุณาอัพโหลดสลิป</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="slip-form" role="form">
              <input type="text" id="e_id" name="e_id" class="form-control d-none" placeholder="รหัส" />
              <div class="row">
                <div class="col-12">
                  <label for="pro_img">รูปภาพสลิป</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input clsEditValidate" name="e_img" id="e_img" accept="image/png, image/gif, image/jpeg" />
                      <label class="custom-file-label e_img_label" for="e_img">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" onclick="submitSlipForm()">อัพสลิป</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <script type="text/javascript">
      $(document).ready(function() {
        bsCustomFileInput.init();
        var table = $('#summary').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          "responsive": true,
          "initComplete": function() {
            let api = this.api();
            api.$('td #updateSlip').click(function() {
              let e_id = api.row($(this).parent().parent()).data()[0];
              $('#e_id').val(e_id);
              //$('#updateModal').show();
            });
            api.$('td #updateFinish').click(function() {
              let e_id = api.row($(this).parent().parent()).data()[0];
              updateStatus(e_id);
              //$('#updateModal').show();
            });
          }
        });

        $('#slip-form').on('submit', function(event) {
          event.preventDefault();
          var formData = new FormData(this);
          // formData.append('faviconFile', $('#fileinput').prop('files'));
          _uploadSlip(formData);
        });

      });

      function submitSlipForm() {
        if (chkEditValidate())
          $("#slip-form").submit();
        else {
          Swal.fire({
            title: 'แจ้งเตือน',
            icon: 'warning',
            text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
          })
        }
      }

      function chkEditValidate() {
        let isCanSave = true;
        $("input.clsEditValidate").each(function(index) {
          if ($(this).val() === '') {
            $(this).addClass('is-invalid').removeClass('is-valid');
            isCanSave = false;
          } else {
            $(this).addClass('is-valid').removeClass('is-invalid');
          }
        });
        return isCanSave;
      }

      function _uploadSlip(formData) {
        Swal.fire({
          title: 'ยืนยันจะอัพสลิป?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          //อัพเดทสถานะโดยไปยังไฟล์ _updateStatus.php
          if (result.isConfirmed) {
            $.ajax({
              url: '_uploadSlip.php',
              type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              // data: {
              //   order_id: $('#order_id').val(),
              //   tracking: $('#tracking').val()
              // },
              success: function(msg) {
                swal.fire({
                  toast: true,
                  position: 'top-end',
                  icon: 'success',
                  title: 'อัพเดทสลิปเรียบร้อย',
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
                  title: 'อัพเดทสลิปไม่สำเร็จ',
                  color: '#716add',
                  showConfirmButton: false,
                  timer: 2000
                })
              }
            });
          }
        })
      }

      function updateStatus(id) {
        Swal.fire({
          title: 'ยืนยันการรับสินค้า?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          //อัพเดทสถานะโดยไปยังไฟล์ _updateStatus.php
          if (result.isConfirmed) {
            $.ajax({
              url: '_updateConfirm.php',
              type: 'POST',
              data: {
                order_id: id
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
    <?php include '_footer.php'; ?>