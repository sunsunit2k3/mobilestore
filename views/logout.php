<?php
include_once "../controllers/auth.php";

$message = logoutUser();
echo "<script>
        alert('$message');
        window.location.href = '../index.php';
      </script>";
exit();
?>
