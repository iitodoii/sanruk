<?php
function genRunNo($prefix)
{
    include '_con.php';
    $sql = "SELECT * FROM `tbl_m_runno` WHERE prefix = '$prefix'";
    $result = $conn->query($sql);
    $id = "";
    $arr = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $temp = "0000000" . ($row['current_id'] + 1);
            $id = $row['prefix'] . substr($temp, -4);
            $data = array(
                "id" => $id,
                "updateId" => $row['current_id'] + 1,
            );
            array_push($arr, $data);
        }
    }
    return $arr;
}

function updateRunNo($prefix, $id)
{
    include '_con.php';
    $sql = "UPDATE `tbl_m_runno` SET `current_id`= $id WHERE prefix = '$prefix'";
    $conn->query($sql);
}
?>