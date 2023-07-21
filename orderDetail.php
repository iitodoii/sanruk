<?php include '_header_admin.php'; ?>
<?php
include '_con.php';
$order_id = $_GET["order_id"];
$sql = "SELECT A.order_id,A.product_id,B.name,A.product_qty,B.price,A.detail_total,B.category cat FROM `order_detail` A JOIN `tbl_product` B on A.product_id = B.id WHERE A.order_id = '$order_id'";
$result = $conn->query($sql);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <h4 class="mr-4">รายละเอียดออเดอร์สินค้า </h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="summary" class="table table-bordered table-hover">
                        <thead class="bg-info">
                            <th>รหัสออเดอร์</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวนสินค้า</th>
                            <th>ราคาสินค้า</th>
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
                                    echo "<td> {$row['product_qty']} </td>";
                                    echo "<td> {$row['price']} </td>";
                                    echo "<td> {$row['detail_total']} </td>";
                                    echo "</tr>";
                                }
                            } else {
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <th colspan="5" class="text-right">ยอดรวมสุทธิ</th>
                            <th><?php echo $total; ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>

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
            }
        });

    });
</script>
<?php include '_footer_admin.php'; ?>