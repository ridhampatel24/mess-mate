
<?php

require 'database/include.php';

if(!isset($_SESSION['userno'])){
    header('location: login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])){

    $que = $_POST['que'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];

    $opt = $opt1."||||" . $opt2."||||" . $opt3."||||" . $opt4;


    $sql = "INSERT INTO `poll`(`pol`, `options`) VALUES ('$que','$opt')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
   
    echo "
        <script>
            alert('Poll Created');
            window.location.href = 'home.php';
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
  <link href="./css/poll.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/poll.css"> 

    <title>Poll</title>
</head>
<body>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Create Poll</h5>
              <form class="row g-3" action="create_poll.php" method="post">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label" >Question</label>
                  <input type="text" class="form-control" name="que" required id="inputNanme4">
                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label" >Option 1</label>
                  <input type="text" class="form-control" name="opt1" required id="inputEmail4">
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label" >Option 2</label>
                  <input type="text" class="form-control" name="opt2" required id="inputPassword4">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label" >Option 3</label>
                  <input type="text" class="form-control" name="opt3" required id="inputAddress" >
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Option 4</label>
                  <input type="text" class="form-control" name="opt4" required id="inputAddress" >
                </div>
                <div class="text-center">
                  <button type="submit" name="create" class="btn btn-primary submit">Submit</button>
                  <button type="reset" class="btn btn-secondary reset">Reset</button>
                </div>
              </form>
            </div>
    </div>

   
          </div>


</body>
</html>