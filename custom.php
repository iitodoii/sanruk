<?php include '_header.php' ?>


<div class="wrapper" style="margin-top:5vh;margin-bottom:5vh">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <?php
        include '_con.php'; //1
        $sql = "SELECT * FROM tbl_user where id = '{$_SESSION['user_id']}'"; //2
        $result = $conn->query($sql); //3
        ?>



        <!-- Main content -->
        <div class="content p-4">
            <div class="container mt-4">
                <div class="row">
                    <h4 class="mr-4">สั่งตะกร้าแบบกำหนดรูปแบบเอง </h4>
                </div>
                <hr>
                <div class="row">
                    <h4 class="mr-4">รูปแบบของตะกร้า</h4>
                    <!-- <button class="btn btn-outline-success btn-sm h-50"> ดึงข้อมูลเดิม <i class="fas fa-copy"></i></button> -->
                </div>
                <form id="form-custom" role="form">
                    <div class="row mt-4 d-flex">
                        <div class="col-6 d-none">
                            <div class="form-group">
                                <label for="name">ชื่อสินค้า</label>
                                <input type="text" name="name" class="form-control" id="name" value="สินค้าแบบกำหนดรูปแบบเอง" placeholder="ชื่อสินค้า">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="qty">จำนวนสินค้า</label>
                                <input type="text" name="qty" class="form-control" id="qty" placeholder="จำนวนสินค้า">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 d-flex justify-content-center">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="color">สีของตะกร้า</label>
                                <?php
                                $sql_color = "SELECT * FROM tbl_m_color";
                                $result_color = $conn->query($sql_color);
                                echo "<select name='color' id='color' class='form-control'>";
                                if ($result_color->num_rows > 0) {
                                    while ($row = $result_color->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . " (" . $row['price'] . "฿) </option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="size">ขนาดตะกร้า</label>
                                <?php
                                $sql_size = "SELECT * FROM tbl_m_size";
                                $result_size = $conn->query($sql_size);
                                echo "<select name='size' id='size' class='form-control'>";
                                if ($result_size->num_rows > 0) {
                                    while ($row = $result_size->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . " (" . $row['price'] . "฿) </option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="material">วัสดุ</label>
                                        <?php
                                        $sql_material = "SELECT * FROM tbl_m_material";
                                        $result_material = $conn->query($sql_material);
                                        echo "<select name='material' id='material' class='form-control'>";
                                        if ($result_material->num_rows > 0) {
                                            while ($row = $result_material->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . " (" . $row['price'] . "฿) </option>";
                                            }
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="pattern">ลายสินค้า</label><span class="text-danger">*รูปภาพตัวอย่างเฉพาะลายเท่านั้น</span>
                                        <?php
                                        $sql_pattern = "SELECT * FROM tbl_m_pattern";
                                        $result_pattern = $conn->query($sql_pattern);
                                        echo "<select name='pattern' id='pattern' class='form-control'>";
                                        echo "<option value='' selected>กรุณาเลือกลาย</option>";
                                        if ($result_pattern->num_rows > 0) {
                                            while ($row = $result_pattern->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                            }
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <input id="pattern_img" type="hidden" name="pattern_img"></input>
                            <img id="pattern_img_show" class="rounded-lg" style="width:50%;height:auto;padding:0px 50px 0px 50px" src="" />
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="img">รูปภาพสินค้า</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="img" id="img" accept="image/png, image/gif, image/jpeg" />
                                        <label class="custom-file-label" for="img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-4 d-flex justify-content-center">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="remark">รายละเอียดสินค้า</label>
                                <textarea type="text" name="remark" class="form-control" id="remark" placeholder="รายละเอียดสินค้า" rows="2" maxlength="2000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-end">
                        <div class="col-4">
                            <label for="price">ราคาสินค้าต่อชิ้น</label>
                            <input type="text" id="price" name="price" class="form-control" placeholder="ราคาสินค้าต่อชิ้น" readonly />
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-end">
                        <div class="col-6">
                            <label for="priceTotal">ราคาสินค้าทั้งหมด</label>
                            <input type="text" id="priceTotal" name="priceTotal" class="form-control" placeholder="ราคาสินค้าทั้งหมด" readonly />
                        </div>
                    </div>
                    <?php
                    if ($result->num_rows > 0) { //นำข้อมูลมาแสดง
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="row mt-4 d-flex justify-content-center">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="send_name">ชื่อนามสกุล</label>
                                        <input type="text" id="send_name" name="send_name" class="form-control" placeholder="ชื่อ-นามสกุล" value='<?php echo $row["firstname"] . " " . $row["lastname"]; ?>' />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 d-flex justify-content-center">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">อีเมล์</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="อีเมล์" value='<?php echo $row["email"]; ?>' />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tel">เบอร์โทรศัพท์</label>
                                        <input type="tel" id="tel" name="tel" class="form-control" placeholder="เบอร์โทรศัพท์" value='<?php echo $row["tel"]; ?>' />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 d-flex justify-content-center">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">ที่อยู่</label>
                                        <textarea class="form-control" type="address" id="address" name="address" placeholder="ที่อยู่"><?php echo $row["address"]; ?> </textarea>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </form>
                <div class="d-flex justify-content-end my-4">
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
        bsCustomFileInput.init();
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
        onchangeEvent();


        //กดยืนยันออเดอร์ ConfirmOrder.php

    });

    function addCustomProduct(formData) {
        $.ajax({
            url: '_newCustomProduct.php', //ไปยังหน้า ConfirmOrder.php
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            data: formData,
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
    }

    function onchangeEvent() {
        $('#pattern_img_show').hide();
        $('#qty').on('change', function() {
            $('#price').val(calculatePrice());
        });
        $('#color').on('change', function() {
            $('#price').val(calculatePrice());
        });
        $('#size').on('change', function() {
            $('#price').val(calculatePrice());
        });
        $('#material').on('change', function() {
            $('#price').val(calculatePrice());
        });

        $('#confirm').click(function() {
            $("#form-custom").submit();
            // Get the data URL (base64 encoded) of the image
        });
        $('#form-custom').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            // formData.append('faviconFile', $('#fileinput').prop('files'));
            addCustomProduct(formData);
        });
        $('#pattern').on('change', function() {
            if ($("#pattern").val() != "") {
                $('#pattern_img_show').fadeOut();
                $('#pattern_img_show').attr("src", "dist/img/pattern/" + $("#pattern option:selected").text() + ".jpg");
                $('#pattern_img').val("dist/img/pattern/" + $("#pattern option:selected").text() + ".jpg");
                $('#pattern_img_show').fadeIn();
            } else {
                $('#pattern_img_show').attr("src", "");
                $('#pattern_img').val("");
                $('#pattern_img_show').fadeOut();
            }
        });
    }

    function calculatePrice() {
        const color = $("#color option:selected").text();
        const colorArray = color.match(/\d+/g);
        let color_price = colorArray[0];

        const size = $("#size option:selected").text();
        const sizeArray = size.match(/\d+/g);
        let size_price = sizeArray[0];

        const material = $("#material option:selected").text();
        const materialArray = material.match(/\d+/g);
        let material_price = materialArray[0];
        $('#priceTotal').val((parseFloat(color_price) + parseFloat(size_price) + parseFloat(material_price)) * $('#qty').val())
        return (parseFloat(color_price) + parseFloat(size_price) + parseFloat(material_price));
    }
</script>
<?php include '_footer.php' ?>