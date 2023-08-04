<?php include '_header_admin.php'; ?>
<?php
include '_con.php';
$order_id = $_GET["order_id"];
$sql = "SELECT A.order_id,A.product_id,B.name,A.product_qty,B.price,A.detail_total,B.category,
B.img,
C.name AS category_name,
D.remark,
E.name AS color,
F.name AS material,
G.name AS size,
H.name As pattern
FROM `order_detail` A 
JOIN `tbl_product` B on A.product_id = B.id
LEFT JOIN `tbl_category` C on B.category = C.id
LEFT JOIN `tbl_custom_product` D on A.product_id = D.id
LEFT JOIN `tbl_m_color` E on D.color_id = E.id
LEFT JOIN `tbl_m_material` F on D.material_id = F.id
LEFT JOIN `tbl_m_size` G on D.size_id = G.id
LEFT JOIN `tbl_m_pattern` H on D.pattern_id = H.id
WHERE A.order_id = '$order_id';";
$result = $conn->query($sql);


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <h4 class="mr-4">รายละเอียดออเดอร์สินค้า </h4>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <table id="summary" class="table table-bordered table-hover">
                        <thead class="bg-info">
                            <th>รหัสออเดอร์</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ประเภทสินค้า</th>
                            <th class="d-none">remark</th>
                            <th class="d-none">color</th>
                            <th class="d-none">material</th>
                            <th class="d-none">size</th>
                            <th class="d-none">pattern</th>
                            <th class="d-none">pattern_img</th>
                            <th>จำนวนสินค้า</th>
                            <th>ราคาสินค้า</th>
                            <th>รายละเอียด</th>
                            <th>ยอดรวม</th>
                        </thead>
                        <tbody>

                            <?php
                            $total = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $total += $row['detail_total'];
                                    echo "<tr>";
                                    echo "<td> {$row['order_id']} </td>";
                                    echo "<td> {$row['product_id']} </td>";
                                    echo "<td> {$row['name']} </td>";
                                    echo "<td> {$row['category_name']} </td>";
                                    echo "<td class='d-none'> {$row['remark']} </td>";
                                    echo "<td class='d-none'> {$row['color']} </td>";
                                    echo "<td class='d-none'> {$row['material']} </td>";
                                    echo "<td class='d-none'> {$row['size']} </td>";
                                    echo "<td class='d-none'> {$row['pattern']} </td>";
                                    echo "<td class='d-none'> {$row['img']} </td>";
                                    echo "<td> {$row['product_qty']} </td>";
                                    echo "<td> {$row['price']} </td>";
                                    echo "<td class='text-center'><a class='btn btn-primary text-white' data-toggle='modal' data-target='#detailModal' id='detail'><i class='fas fa-info-circle text-white mr-1'></i>รายละเอียด</a></td>";
                                    // if ($row["category"] == "4") {
                                    //     echo "<td class='text-center'><a class='btn btn-primary text-white' data-toggle='modal' data-target='#detailModal' id='detail'><i class='fas fa-info-circle text-white mr-1'></i>รายละเอียด</a></td>";
                                    // } else {
                                    //     echo "<td class='text-center'><a class='btn btn-secondary text-white' style='cursor: context-menu !important;'><i class='fas fa-info-circle text-white mr-1'></i>รายละเอียด</a></td>";
                                    // }
                                    echo "<td> {$row['detail_total']} </td>";
                                    echo "</tr>";
                                }
                            } else {
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <th colspan="7" class="text-right">ยอดรวมสุทธิ</th>
                            <th><?php echo $total; ?></th>
                            <th colspan="6" class="d-none"></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="detailModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">รายละเอียดสินค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="product_id" />
                <div class="row mb-2">
                    <div class="col-4">
                        ภาพตัวอย่าง
                    </div>
                    <div class="col-8">
                        <img id="pattern_img" class="mr-4" style="width:70%;height:auto;border-radius: 25px !important;" src="" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>ชื่อสินค้า</p>
                    </div>
                    <div class="col-8">
                        <p>: <span id="product_name"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>ประเภทสินค้า</p>
                    </div>
                    <div class="col-8">
                        <p>: <span id="product_category"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>ลายของสินค้า</p>
                    </div>
                    <div class="col-8">
                        <p>: <span id="product_pattern"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>สีของสินค้า</p>
                    </div>
                    <div class="col-8">
                        <p>: <span id="product_color"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>วัสดุของสินค้า</p>
                    </div>
                    <div class="col-8">
                        <p>: <span id="product_material"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>ขนาดของสินค้า</p>
                    </div>
                    <div class="col-8">
                        <p>: <span id="product_size"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>รายละเอียดสินค้า</p>
                    </div>
                    <div class="col-8">
                        <textarea id="product_desc" class="form-control" rows="5"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "initComplete": function() {
                let api = this.api();
                api.$('td #detail').click(function() {
                    let product_id = api.row($(this).parent().parent()).data()[1];
                    let pattern_img = api.row($(this).parent().parent()).data()[9];
                    let product_name = api.row($(this).parent().parent()).data()[2];
                    let product_category = api.row($(this).parent().parent()).data()[3];
                    let product_desc = api.row($(this).parent().parent()).data()[4];
                    let product_color = api.row($(this).parent().parent()).data()[5];
                    let product_material = api.row($(this).parent().parent()).data()[6];
                    let product_size = api.row($(this).parent().parent()).data()[7];
                    let product_pattern = api.row($(this).parent().parent()).data()[8];
                    // <th>รหัสออเดอร์</th> 0
                    //         <th>รหัสสินค้า</th> 1
                    //         <th>ชื่อสินค้า</th> 2
                    //         <th>ประเภทสินค้า</th> 3
                    //         <th class="d-none">remark</th> 4
                    //         <th class="d-none">color</th> 5
                    //         <th class="d-none">material</th> 6
                    //         <th class="d-none">size</th> 7
                    //         <th class="d-none">pattern</th> 8
                    //         <th class="d-none">pattern_img</th> 9
                    $('#product_id').val(product_id);
                    $('#pattern_img').attr("src", pattern_img);
                    $('#product_name').text(product_name);
                    $('#product_category').text(product_category);
                    $('#product_desc').text(product_desc);
                    $('#product_color').text(product_color);
                    $('#product_material').text(product_material);
                    $('#product_size').text(product_size);
                    $('#product_pattern').text(product_pattern);
                    $('#detailModal').show();
                });
            }
        });

    });
</script>
<?php include '_footer_admin.php'; ?>