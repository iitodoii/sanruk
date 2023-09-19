<?php include '_header_admin.php'; ?>
<?php

include '_con.php';

$sql = "SELECT * from tbl_user order by id asc";
// mysqli_query('utf8');
$result = $conn->query($sql);

$sql_category = "SELECT * from tbl_category";
// mysqli_query('utf8');
$result_category = $conn->query($sql_category);

// $sql_category_2 = "SELECT * from tbl_category";
// mysqli_query('utf8');
$result_category_2 = $conn->query($sql_category);

$sql_report2 = "SELECT * FROM `tbl_user` WHERE level = 'user'";
$res_report2 = $conn->query($sql_report2);

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
                <h4 class="mr-4 mt-4">รายงาน </h4>
            </div>
            <div class="row">
                <div class="col-12" style="overflow-x:auto">
                    <h4 class="mr-4 mt-4">รายงานข้อมูลสมาชิก</h4>
                    <table id="report2" class="table table-bordered table-hover" style="overflow-x:auto">
                        <thead class="bg-primary">
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>อีเมล์</th>
                            <th>เบอร์โทรศัพท์</th>
                        </thead>
                        <tbody>

                            <?php
                            $total = 0;
                            if ($res_report2->num_rows > 0) {
                                while ($row = $res_report2->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td> {$row['firstname']} </td>";
                                    echo "<td> {$row['lastname']} </td>";
                                    echo "<td> {$row['email']} </td>";
                                    echo "<td> {$row['tel']} </td>";
                                    echo "</tr>";
                                }
                            } else {
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
        </div>
    </section>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ใช้งาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="general-form" role="form">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="name">ชื่อ</label>
                                <input type="text" id="name" name="name" class="form-control clsValidate" placeholder="ชื่อ" />
                            </div>
                            <div class="col-6">
                                <label for="lastname">นามสกุล</label>
                                <input type="text" id="lastname" name="lastname" class="form-control clsValidate" placeholder="นามสกุล" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="username">ชื่อผู้ใช้งาน</label>
                                <input type="text" id="username" name="username" class="form-control clsValidate" placeholder="ชื่อผู้ใช้งาน" />
                            </div>
                            <div class="col-6">
                                <label for="password">รหัสผ่าน</label>
                                <input type="password" id="password" name="password" class="form-control clsValidate" placeholder="รหัสผ่าน" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="email">อีเมล์</label>
                                <input type="email" id="email" name="email" class="form-control clsValidate" placeholder="อีเมล์" />
                            </div>
                            <div class="col-6">
                                <label for="tel">เบอร์โทรศัพท์</label>
                                <input type="text" id="tel" name="tel" class="form-control clsValidate" placeholder="เบอร์โทรศัพท์" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="address">ที่อยู่</label>
                                <textarea type="text" id="address" name="address" class="form-control clsValidate" placeholder="ที่อยู่" row="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="level">สิทธิ์</label>
                                <select name='level' id='level' class='form-control clsValidate'>
                                    <option value='admin'>admin</option>
                                    <option value='user'>user</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-primary rounded-pill" onclick="submitGeneralForm()"> เพิ่มผู้ใช้งาน </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="row d-none">
                            <div class="col-6">
                                <label for="e_id">ชื่อ</label>
                                <input type="text" id="e_id" name="e_id" class="form-control clsEditValidate" placeholder="รหัส" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="e_name">ชื่อ</label>
                                <input type="text" id="e_name" name="e_name" class="form-control clsEditValidate" placeholder="ชื่อ" />
                            </div>
                            <div class="col-6">
                                <label for="e_lastname">นามสกุล</label>
                                <input type="text" id="e_lastname" name="e_lastname" class="form-control clsEditValidate" placeholder="นามสกุล" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="e_username">ชื่อผู้ใช้งาน</label>
                                <input type="text" id="e_username" name="e_username" class="form-control clsEditValidate" placeholder="ชื่อผู้ใช้งาน" />
                            </div>
                            <div class="col-6">
                                <label for="e_password">รหัสผ่าน</label>
                                <input type="password" id="e_password" name="e_password" class="form-control clsEditValidate" placeholder="รหัสผ่าน" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="e_email">อีเมล์</label>
                                <input type="email" id="e_email" name="e_email" class="form-control clsEditValidate" placeholder="อีเมล์" />
                            </div>
                            <div class="col-6">
                                <label for="e_tel">เบอร์โทรศัพท์</label>
                                <input type="text" id="e_tel" name="e_tel" class="form-control clsEditValidate" placeholder="เบอร์โทรศัพท์" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="e_address">ที่อยู่</label>
                                <textarea type="text" id="e_address" name="e_address" class="form-control clsEditValidate" placeholder="ที่อยู่" row="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="e_level">สิทธิ์</label>
                                <select name='e_level' id='e_level' class='form-control clsEditValidate'>
                                    <option value='admin'>admin</option>
                                    <option value='user'>user</option>
                                </select>
                            </div>
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
        var table = $('#report1').DataTable({
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
                    let id = api.row($(this).parent().parent()).data()[0];
                    console.log(id);
                    $.ajax({
                        url: '_deleteUser.php',
                        type: 'POST',
                        data: {
                            id: id
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
                    let id = prd[0];
                    let name = prd[1];
                    let lastname = prd[2];
                    let username = prd[3];
                    let password = prd[4];
                    let email = prd[5];
                    let address = prd[6];
                    let tel = prd[7];
                    let level = prd[8];
                    $('#e_id').val(id);
                    $('#e_name').val(name);
                    $('#e_lastname').val(lastname);
                    $('#e_username').val(username);
                    $('#e_password').val(password);
                    $('#e_email').val(email);
                    $('#e_address').val(address);
                    $('#e_tel').val(tel);
                    $('#e_level').val(level);
                    $('#editUserModal').modal('show')
                });
            }
        });
        var table2 = $('#report2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "autoWidth": true,
            // "overflow": true,
            "initComplete": function() {}
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
            _addUser(formData);
        });

        $('#edit-form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            // formData.append('faviconFile', $('#fileinput').prop('files'));
            _editUser(formData);
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

    function _addUser(formData) {
        $.ajax({
            url: '_addUser.php',
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

    function _editUser(formData) {
        $.ajax({
            url: '_editUser.php',
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