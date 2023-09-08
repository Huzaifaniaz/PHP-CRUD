<?php
session_start();
include 'connect.php';
if (isset($_POST['submit'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $age = $_POST['age'];
  $mobile = $_POST['mobile'];
  $image = $_FILES['s_image']['name'];

  $sql = "INSERT INTO `data`(fname,lname,age,mobile,s_image) values('$fname','$lname','$age','$mobile','$image')";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:index.php');
    move_uploaded_file($_FILES["s_image"]["tmp_name"], "upload/" . $_FILES["s_image"]["name"]);
    $_SESSION['status'] = "image stored";

    // echo "<script>alert('Data Added Successfully')</script>";
  } else {
    //die("Error: ".mysqli_error($con));
    $_SESSION['status'] = "image not stored";
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <div class="container my-5">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" name="fname">
      </div>
      <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lname">
      </div>
      <div class="mb-3">
        <label class="form-label">Age</label>
        <input type="text" class="form-control" name="age">
      </div>
      <div class="mb-3">
        <label class="form-label">Mobile Number</label>
        <input type="text" class="form-control" name="mobile">
      </div>
      <div class="mb-3">
        <label class="form-label">Profile Picture</label>
        <input type="file" class="form-control" name="s_image">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">ADD</button>
    </form>
  </div>
</body>

</html>