<?php include '_header_admin.php'; ?>
<?php

include '_con.php';

$sql = "SELECT A.*,B.name as category_name from tbl_product A JOIN tbl_category B ON A.category = B.id WHERE B.id != 4";
// mysqli_query('utf8');
$result = $conn->query($sql);

$sql_category = "SELECT * from tbl_category";
// mysqli_query('utf8');
$result_category = $conn->query($sql_category);

// $sql_category_2 = "SELECT * from tbl_category";
// mysqli_query('utf8');
$result_category_2 = $conn->query($sql_category);


?>
<style type="text/css">
    .modal-color {
        color: '#716add' !important;
        background-color: '#292b2c' !important;
    }

    .swal-title {
        color: '#716add' !important;
        background-color: '#292b2c' !important;
    }

    .dataTables_filter {
        width: 50%;
        float: right;
        text-align: right;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <h4 class="mr-4 mt-4">รายละเอียดออเดอร์สินค้า </h4>
            </div>
            <div class="row mb-4">
                <!-- <div class="col-4">
                    <label for="url">เพิ่มสินค้า</label>
                    <input type="text" id="url" name="url" class="form-control" placeholder="Url Shoppee" />
                </div> -->
                <div class="col-2 d-flex align-items-end">
                    <!-- <button type="button" class="btn btn-success text-center align-middle" onclick="addProduct()">เพิ่มสินค้า</button> -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProductModal" onclick="addProduct()">
                        เพิ่มสินค้า
                    </button>

                </div>
            </div>

            <div class="row">
                <div class="col-12" style="overflow-x:auto">
                    <table id="summary" class="table table-bordered table-hover" style="overflow-x:auto">
                        <thead class="bg-primary">
                            <th>รหัส</th>
                            <th>ชื่อสินค้า</th>
                            <th>ประเภทสินค้า</th>
                            <th class="d-none">รหัสประเภท</th>
                            <th>รายละเอียดสินค้า</th>
                            <th class="d-none">รูปภาพ</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>หน่วย</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </thead>
                        <tbody>

                            <?php
                            $total = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td> {$row['id']} </td>";
                                    echo "<td> {$row['name']} </td>";
                                    echo "<td> {$row['category_name']} </td>";
                                    echo "<td class='d-none'> {$row['category']} </td>";
                                    echo "<td> {$row['description']} </td>";
                                    echo "<td class='d-none'> {$row['img']} </td>";
                                    // echo "<td> {$row['shoppee_url']} </td>";
                                    echo "<td> {$row['price']} </td>";
                                    echo "<td> {$row['qty']} </td>";
                                    echo "<td> {$row['unit']} </td>";
                                    echo "<td class='text-center'><a class='btn btn-warning text-white edit' id=''><i class='fas fa-wrench text-white mr-1'></i>แก้ไข</a></td>";
                                    echo "<td class='text-center'><a class='btn btn-danger text-white delete' id =''><i class='fas fa-trash text-white mr-1'></i>ลบ</a></td>";
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
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="general-form" role="form">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="prd_name">ชื่อสินค้า</label>
                                <input type="text" id="prd_name" name="prd_name" class="form-control clsValidate" placeholder="ชื่อสินค้า" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="prd_category">ประเภทของสินค้า</label>
                                <!-- <input type="text" id="prd_name" name="prd_name" class="form-control clsValidate" placeholder="ชื่อสินค้า" /> -->
                                <?php
                                echo "<select name='prd_category' id='prd_category' class='form-control clsValidate'>";
                                if ($result_category->num_rows > 0) {
                                    while ($row = $result_category->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="prd_price">ราคาสินค้า</label>
                                <input type="text" id="prd_price" name="prd_price" class="form-control clsValidate" placeholder="ราคาสินค้า" />
                            </div>
                            <div class="col-6">
                                <label for="prd_qty">จำนวนสินค้า</label>
                                <input type="text" id="prd_qty" name="prd_qty" class="form-control clsValidate" placeholder="จำนวนสินค้า" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="prd_unit">หน่วยสินค้า</label>
                                <input type="text" id="prd_unit" name="prd_unit" class="form-control clsValidate" placeholder="หน่วยสินค้า" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="prd_desc">รายละเอียดสินค้า</label>
                                <textarea type="text" id="prd_desc" name="prd_desc" class="form-control clsValidate" placeholder="รายละเอียดสินค้า" row="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="pro_img">รูปภาพสินค้า</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input clsValidate" name="pro_img" id="pro_img" accept="image/png, image/gif, image/jpeg" />
                                        <label class="custom-file-label" for="pro_img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                            <label for="pro_unit">หน่วยสินค้า</label>
                            <input type="text" id="pro_unit" name="pro_unit" class="form-control" placeholder="หน่วยสินค้า" />
                        </div> -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-primary rounded-pill" onclick="submitGeneralForm()"> เพิ่มสินค้า </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-form" role="form">
                        <!-- <input type="text" id="e_prd_id" name="e_prd_id" class="form-control clsEditValidate" placeholder="รหัสสินค้า" /> -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="e_prd_id">รหัสสินค้า</label>
                                <input type="text" id="e_prd_id" name="e_prd_id" class="form-control clsEditValidate" placeholder="รหัสสินค้า" readonly="true" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="e_prd_name">ชื่อสินค้า</label>
                                <input type="text" id="e_prd_name" name="e_prd_name" class="form-control clsEditValidate" placeholder="ชื่อสินค้า" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="e_prd_category">ประเภทของสินค้า</label>
                                <!-- <input type="text" id="prd_name" name="prd_name" class="form-control clsValidate" placeholder="ชื่อสินค้า" /> -->
                                <?php
                                echo "<select name='e_prd_category' id='e_prd_category' class='form-control clsValidate'>";
                                if ($result_category_2->num_rows > 0) {
                                    while ($row = $result_category_2->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="e_prd_price">ราคาสินค้า</label>
                                <input type="text" id="e_prd_price" name="e_prd_price" class="form-control clsEditValidate" placeholder="ราคาสินค้า" />
                            </div>
                            <div class="col-6">
                                <label for="e_prd_qty">จำนวนสินค้า</label>
                                <input type="text" id="e_prd_qty" name="e_prd_qty" class="form-control clsEditValidate" placeholder="จำนวนสินค้า" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="e_prd_unit">หน่วยสินค้า</label>
                                <input type="text" id="e_prd_unit" name="e_prd_unit" class="form-control clsEditValidate" placeholder="หน่วยสินค้า" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="e_prd_desc">รายละเอียดสินค้า</label>
                                <textarea type="text" id="e_prd_desc" name="e_prd_desc" class="form-control clsEditValidate" placeholder="รายละเอียดสินค้า" row="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="pro_img">รูปภาพสินค้า</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input clsEditValidate" name="e_prd_img" id="e_prd_img" accept="image/png, image/gif, image/jpeg" />
                                        <label class="custom-file-label e_img_label" for="e_prd_img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                            <label for="pro_unit">หน่วยสินค้า</label>
                            <input type="text" id="pro_unit" name="pro_unit" class="form-control" placeholder="หน่วยสินค้า" />
                        </div> -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-primary rounded-pill" onclick="submitEditForm()"> แก้ไขสินค้า </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "1500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    $(document).ready(function() {
        bsCustomFileInput.init();
        onChangeEvent();
        var table = $('#summary').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "autoWidth": true,
            // "overflow": true,
            "initComplete": function() {
                let api = this.api();
                api.$('td .delete').click(function() {
                    let prd_id = api.row($(this).parent().parent()).data()[0];
                    console.log(prd_id);
                    $.ajax({
                        url: '_deleteProduct.php',
                        type: 'POST',
                        data: {
                            prd_id: prd_id
                        },
                        success: function(result) {
                            toastr["success"]("ลบสินค้าสำเร็จ!");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        failure: function(msg) {
                            swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'ลบสินค้าไม่สำเร็จ',
                                color: '#716add',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    });
                });
                api.$('td .edit').click(function() {
                    let prd = api.row($(this).parent().parent()).data();
                    let prd_id = prd[0];
                    let prd_name = prd[1];
                    let prd_category = prd[3];
                    let prd_desc = prd[4];
                    let prd_img = prd[5];
                    let prd_price = prd[6];
                    let prd_qty = prd[7];
                    let prd_unit = prd[8];
                    $('#e_prd_id').val(prd_id);
                    $('#e_prd_name').val(prd_name);
                    $('#e_prd_category').val(prd_category);
                    $('#e_prd_desc').val(prd_desc);
                    $('#e_prd_price').val(prd_price);
                    $('#e_prd_qty').val(prd_qty);
                    $('#e_prd_unit').val(prd_unit);
                    $('.e_img_label').text(prd_img);
                    $('#editProductModal').modal('show')
                });
            }
        });
    });

    function onChangeEvent() {
        $("input.clsValidate").on('change', function() {
            if ($(this).val() === '') {
                $(this).addClass('is-invalid').removeClass('is-valid');
            } else {
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        });

        $('#general-form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            // formData.append('faviconFile', $('#fileinput').prop('files'));
            _addProduct(formData);
        });

        $('#edit-form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            // formData.append('faviconFile', $('#fileinput').prop('files'));
            _editProduct(formData);
        });
        // $("#faviconFile").on("change", function(e) {
        //     $("#general-form").submit();
        // });
    }

    function submitGeneralForm() {
        if (chkValidate())
            $("#general-form").submit();
        else {
            Swal.fire({
                title: 'แจ้งเตือน',
                icon: 'warning',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
            })
        }
    }

    function submitEditForm() {
        if (chkEditValidate())
            $("#edit-form").submit();
        else {
            Swal.fire({
                title: 'แจ้งเตือน',
                icon: 'warning',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
            })
        }
    }

    function addProduct() {

    }

    function chkValidate() {
        let isCanSave = true;
        $("input.clsValidate").each(function(index) {
            if ($(this).val() === '') {
                $(this).addClass('is-invalid').removeClass('is-valid');
                return false;
            } else {
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        });
        return isCanSave;
    }

    function chkEditValidate() {
        let isCanSave = true;
        $("input.clsEditValidate").each(function(index) {
            if ($(this).val() === '') {
                $(this).addClass('is-invalid').removeClass('is-valid');
                return false;
            } else {
                $(this).addClass('is-valid').removeClass('is-invalid');
            }
        });
        return isCanSave;
    }

    function _addProduct(formData) {
        $.ajax({
            url: '_addProduct.php',
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
                    text: msg,
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
                    title: msg,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        });
    }

    function _editProduct(formData) {
        $.ajax({
            url: '_editProduct.php',
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
                    text: msg,
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
                    title: msg,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        });
    }

    function addItem() {
        $.ajax({
            url: 'http://localhost:8082/getShopeeData',
            type: 'GET',
            data: {
                page: $('#url').val(),
            },
            success: function(result) {
                $.ajax({
                    url: '_addProduct.php',
                    type: 'POST',
                    data: {
                        prd_name: result.product.prd_name,
                        prd_desc: result.product.prd_desc,
                        prd_price: result.product.prd_price,
                        prd_img_url: result.product.prd_img_url,
                        prd_qty: result.product.prd_qty,
                        shopee_url: $('#url').val()
                    },
                    success: function(result) {
                        toastr["success"]("เพิ่มสินค้าสำเร็จ!");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    failure: function(msg) {
                        swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'เพิ่มสินค้าไม่สำเร็จ',
                            color: '#716add',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
            },
            failure: function(msg) {
                swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'เพิ่มสินค้าไม่สำเร็จ',
                    color: '#716add',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        });
    }
</script>
<?php include '_footer_admin.php'; ?>