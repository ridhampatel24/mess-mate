
<?php

require 'database/include.php';

if(!isset($_SESSION['userno'])){
    header('location: login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $itm1 = $_POST['itm1'];
    $itm2 = $_POST['itm2'];
    $itm3 = $_POST['itm3'];
    $itm4 = $_POST['itm4'];
    $itm5 = $_POST['itm5'];

    $itm = $itm1."||||" . $itm2."||||" . $itm3."||||" . $itm4."||||" . $itm5;
    $tdate = date('Y-m-d');


    $sql = "INSERT INTO `meal`(`type`, `items`, `date`, `price`) VALUES ('0','$itm','$tdate','50')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
   
    echo "
        <script>
            alert('Menu Created');
            window.location.href = 'admin_index.php';
        </script>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/createmeal.css">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style2.css" rel="stylesheet">
  <link href="assets/css/profile.css" rel="stylesheet">

    <title>Create Dinner</title>
</head>
<body>


<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card px-1 py-4">
      <div class="card-body">
        <h5 class="card-title">Create Meal</h5>
        <form class="row g-3" method="post">
          <div class="col-12">
            <label for="inputNanme4" class="form-label" >Iteam 1</label>
            <input type="text" class="form-control" name="itm1" required id="inputNanme4">
          </div>
          <div class="col-12">
            <label for="inputEmail4" class="form-label" >Iteam 2</label>
            <input type="text" class="form-control" name="itm2" required id="inputEmail4">
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label" >Iteam 3</label>
            <input type="text" class="form-control" name="itm3" required id="inputPassword4">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label" >Item 4</label>
            <input type="text" class="form-control" name="itm4" required id="inputAddress" >
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Item 5</label>
            <input type="text" class="form-control" name="itm5" required id="inputAddress" >
          </div>
          <div class="d-flex pt-1 admin_btn">
            <button type="submit" name="create" class="btn btn-outline-dark me-1 flex-grow-1" >Submit</button>
            <button type="reset" name="create" class="btn btn-outline-dark me-1 flex-grow-1" >Reset</button>
            
          </div>
        </form>
      </div>
    </div>
</div>



</body>
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>