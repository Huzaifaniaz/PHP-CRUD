<?php
include 'connect.php';

$id = $_GET['editid'];

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];

    $image = $_FILES['s_image']['name'];
    $image_tmp = $_FILES['s_image']['tmp_name'];

    if ($image != "") {
        $image_path = "upload/" . $image;
        move_uploaded_file($image_tmp, $image_path);
        $sql = "UPDATE `data` SET fname='$fname', lname='$lname', age='$age', mobile='$mobile', s_image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE `data` SET fname='$fname', lname='$lname', age='$age', mobile='$mobile', s_image='' WHERE id=$id";
    }

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Data Updated Successfully')</script>";
        header('location: index.php');
    } else {
        die("Error: " . mysqli_error($con));
    }
}


$sql = "SELECT * FROM `data` WHERE id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$fname = $row['fname'];
$lname = $row['lname'];
$age = $row['age'];
$mobile = $row['mobile'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" value="<?php echo $fname ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" value="<?php echo $lname ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="text" class="form-control" name="age" value="<?php echo $age ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo $mobile ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="s_image">
                <input type="hidden" name="stud_img_old" value="<?php echo $row['s_image']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>

</html>