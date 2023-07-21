<?php
    session_start();
    session_unset();
    echo '<script type="text/JavaScript"> alert("Logout สำเร็จ");window.location.href="index.php"</script>';
?>
