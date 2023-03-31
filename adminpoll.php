
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
    $votes = "0||||0||||0||||0";


    $sql = "INSERT INTO `poll`(`pol`, `options`, `votes`) VALUES ('$que','$opt','$votes')";
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
  <link href="css/poll.css" rel="stylesheet">
    <title>Poll</title>
</head>
<body>
<section class="section">
<div class="row">

<div class="col-lg-6">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Create Poll</h5>
              <form class="row g-3" method="post">
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
                  <button type="submit" name="create" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
            </div>
    </div>
</div>
</div>
</section>

<section class="section">
    <div class="row">

      <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
                <h5> Poll Result</h5>
                <div>
                <?php
                 $sql = "SELECT * FROM `poll`";
                 $result = $conn->query($sql);
                 
                 foreach($result as $row){
                    echo "<h6>".$row['pol']."</h6>";
                    $opt = explode("||||",$row['options']);
                    $votes = explode("||||",$row['votes']);
                    for($i = 0; $i<count($opt); $i++){
                        $votePercent = '0%';
                        if($votes[$i] && $row['total_votes']){
                            $votePercent = round(($votes[$i]/$row['total_votes'])*100);
                            $votePercent = !empty($votePercent) ? $votePercent.'%' : '0%';
                        }
                        echo "
                        <h5>".$opt[$i]."</h5>
                        <div class='progress'>
                            <div class='progress-bar' role='progressbar' style='width: ".$votePercent."' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$votePercent."</div>
                            </div>";
                        

                    }
                }
                ?>
                </div>
          </div>
          </div>
      </div></div>
</section>

</body>
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>