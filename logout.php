<?php
session_start();
session_unset();
session_destroy();
header_remove(); 
header("Location: login.php");
echo "<script>window.location = 'login.php'</script>";
exit;
?>