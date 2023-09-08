<?php
include 'connect.php';
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "delete from `data` where id = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header("location:index.php");
        echo "<script>alert('Data Deleted Successfully')</script>";
    } else {
        die('Error deleting record');
    }
}


?>