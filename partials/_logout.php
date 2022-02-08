<?php
    session_start();

    session_destroy();   
    header("location:/ecourse/index.php");

    // echo '<script> location.href= "index.php"; </script>';
?>