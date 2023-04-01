
<?php

require 'database/include.php';

if ($_SESSION['user_type'] != 'admin') {
  header('location: login.php');
  exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){


  
  $date = $_POST['date'];
  $check = "SELECT * FROM `meal` WHERE `date` = '$date' and `type` = '1'";
  $result = mysqli_query($conn, $check);
  $num = mysqli_num_rows($result);
  if($num > 0){
      echo "
          <script>
              alert('Already Created for that day');
              window.location.href = 'admin_index.php';
          </script>";
      exit();
  }else{
    $tdate = date("Y-m-d");
    $activate_user = "SELECT count(userid) as users FROM `token` WHERE `status` = '1' and `dontgo` != '$tdate'  "; 
    $result = mysqli_query($conn, $activate_user);
    $ans = mysqli_fetch_assoc($result);
    $waste_users = $ans['users'];


    $itm1 = $_POST['itm1'];
    $itm2 = $_POST['itm2'];
    $itm3 = $_POST['itm3'];
    $itm4 = $_POST['itm4'];
    $itm5 = $_POST['itm5'];

    $itm = $itm1."||" . $itm2."||" . $itm3."||" . $itm4."||" . $itm5;


    $sql = "INSERT INTO `meal`(`type`, `items`, `wastage_user` ,`date`, `price`) VALUES ('1','$itm', '$waste_users' ,'$date','50')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
   
    echo "
        <script>
            alert('Menu Created');
            window.location.href = 'admin_index.php';
        </script>";
    }
  }else{
    echo "
        <script>
            alert('Something went wrong');
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
        <center>
        <h5 class="card-title">Create Dinner</h5>
        </center>
        <form class="row g-3" method="post">
        <div class="col-12">
            <label for="inputNanme4" class="form-label" >Date</label>
            <input type="date" class="form-control" name="date" required id="inputNanme4" min= "<?php echo date('Y-m-d'); ?>" >
          </div>
          <div class="col-12">
            <label for="inputNanme4" class="form-label" >Item 1</label>
            <select class="form-select" name="itm1" required aria-label="Default select example">
              <option selected value="Roti">Roti</option>
              <option value="Puri">Puri</option>
              <option value="Paratha">Paratha</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputNanme4" class="form-label" >Item 2</label>
            <select class="form-select" name="itm2" required aria-label="Default select example">
              <option selected value="Rice">Rice</option>
              <option value="Jeera Rice">Jeera Rice</option>
              <option value="Pulao">Pulao</option>
              <option value="Kichidi">Kichidi</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputNanme4" class="form-label" >Item 3</label>
            <select class="form-select" name="itm3" required aria-label="Default select example">
              <option selected value="Dal">Dal</option>
              <option value="Dal Fry">Dal Fry</option>
              <option value="Kadhi">Kadhi</option>
              <option value="Punjabi Dal">Punjabi Dal</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputNanme4" class="form-label" >Item 4</label>
            <select class="form-select" name="itm4" required aria-label="Default select example">
              <option value="Aloo Gobi">Aloo Gobi</option>
              <option value="Aloo Matar">Aloo Matar</option>
              <option value="Aloo Palak">Aloo Palak</option>
              <option value="Aloo Jeera">Aloo Jeera</option>
              <option value="Aloo Tamatar">Aloo Tamatar</option>
              <option value="Mag Mogar">Mag Mogar</option>
              <option value="Chana Dal">Chana Dal</option>
              <option value="Chole">Chole</option>
              <option value="Matar Paneer">Matar Paneer</option>
              <option value="Shahi Paneer">Shahi Paneer</option>
            </select>
          </div>

          <div class="col-12">
          <label for="inputNanme4" class="form-label" >Item 5</label>
          <select class="form-select" name="itm5" required aria-label="Default select example">
            <option selected value="Chhas">Chhas</option>
            <option value="Lassi">Lassi</option>
            <option value ="Papad">Papad</option>
          </select>
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