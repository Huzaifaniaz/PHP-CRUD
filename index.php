<?php
include 'connect.php';
// if(isset($_POST['submit'])){
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $age = $_POST['age'];
//     $mobile = $_POST['mobile'];
$limit = 5;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
;
$offset = ($page - 1) * $limit;


$sql = "select * from `data` ORDER BY id LIMIT {$offset},{$limit}";
$result = mysqli_query($con, $sql)

  // $result= mysqli_query($con,$sql);
  // if($result){
  //     echo "Data Inserted Successfully!";
  //     header('location:index.php');
  //     }else{
  //         die("Error: ".mysqli_error($con));
  // }
  // }
  ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>crud2</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <h1 class="text-center my-5">crud</h1>
  <div class="container my-5 text-center">
    <button class="btn btn-dark">
      <a href="add.php" class="text-light " style="text-decoration: none;">ADD USER</a>
    </button>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Age</th>
          <th scope="col">Mobile Number</th>
          <th scope="col">Profile Picture</th>
          <th scope="col">Operations</th>

        </tr>
      </thead>
      <tbody>
        <?php
        if ($result) {
          // Using While loop
        
          //     while ($row=mysqli_fetch_assoc($result)) {
          //         $id = $row['id'];
          //         $fname = $row ['fname'];
          //         $lname = $row["lname"];
          //         $age =$row ["age"] ;
          //         $mobile =  $row ["mobile"];
        
          //  echo '
        
          //   <tr>
          //     <th scope="row">'.$id.'</th>
          //     <td>'.$fname.'</td>
          //     <td>'.$lname.'</td>
          //     <td>'.$age .'</td>
          //     <td>'.$mobile.'</td>
          //     <td>        <button class="btn btn-warning"><a class="text-light" href="edit.php?editid=' . $id . '" style="text-decoration: none;">Edit</a>
          //     </button>
          //     <button class="btn btn-danger"><a class="text-light" href="delete.php?deleteid=' . $id . '" style="text-decoration: none;">Delete</a>
          //     </button></td>
          //   </tr>
        
          // ';
          //     
        
          //Using For loop
        
          // $count = mysqli_num_rows($result);
//     for($i = 0;$i<$count;$i++){
//        $row=mysqli_fetch_assoc($result);
//             $id = $row['id'];
//             $fname = $row ['fname'];
//             $lname = $row["lname"];
//             $age =$row ["age"] ;
//             $mobile =  $row["mobile"];
//             echo '
        
          //       <tr>
//         <th scope="row">'.$id.'</th>
//         <td>'.$fname.'</td>
//         <td>'.$lname.'</td>
//         <td>'.$age .'</td>
//         <td>'.$mobile.'</td>
//         <td>        <button class="btn btn-warning"><a class="text-light" href="edit.php?editid=' . $id . '" style="text-decoration: none;">Edit</a>
//         </button>
//         <button class="btn btn-danger"><a class="text-light" href="delete.php?deleteid=' . $id . '" style="text-decoration: none;">Delete</a>
//         </button></td>
//       </tr>
        
          //     ';
        

          $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

          foreach ($rows as $row) {

            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row["lname"];
            $age = $row["age"];
            $mobile = $row["mobile"];
            $image = $row['s_image'];
            echo '

      <tr>
        <th scope="row">' . $id . '</th>
        <td>' . $fname . '</td>
        <td>' . $lname . '</td>
        <td>' . $age . '</td>
        <td>' . $mobile . '</td>
        <td>
        <td><img src="upload/' . $row["s_image"] . '" width="100px"></td>        </td>

        <td>        <button class="btn btn-warning"><a class="text-light" href="edit.php?editid=' . $id . '" style="text-decoration: none;">Edit</a>
        </button>
        <button class="btn btn-danger"><a class="text-light" href="delete.php?deleteid=' . $id . '" style="text-decoration: none;">Delete</a>
        </button></td>
      </tr>

    ';

          }
        }
        ?>

      </tbody>
    </table>
    <?php
    $sql1 = "SELECT * FROM `data`";
    $result1 = mysqli_query($con, $sql1) or die("query failed");
    if (mysqli_num_rows($result1)) {
      $total_records = mysqli_num_rows($result1);
      $total_pages = ceil($total_records / $limit);

      echo '<ul class="pagination justify-content-center d-flex">';
      if ($page > 1) {
        echo '<li class="page-item ">
      <a class="page-link" href="index.php?page=' . ($page - 1) . '">Previous</a>
    </li>';
      }
      for ($i = 1; $i <= $total_pages; $i++) {

        if ($i == $page) {
          $active = "active";
        } else {
          $active = "";
        }
        ;
        echo '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
      }
      if ($total_pages > $page) {
        echo '<li class="page-item ">
      <a class="page-link" href="index.php?page=' . ($page + 1) . '">Next</a>
    </li>';
        echo '</ul>';
      }
      // else{
      //   echo 'No records found';
      // }
    
    }
    ?>
  </div>
</body>

</html>