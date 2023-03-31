
<?php 

require 'database/include.php';

if(!isset($_SESSION['userno'])){
  header('location: login.php');
  exit();
}

?>
<?php

//for tommorow

$yesterdaydate = date('Y-m-d', strtotime('yesterday'));
$sqlt = "SELECT type, GROUP_CONCAT(users) AS users, SUM(price) AS total_price FROM meal WHERE date = '2023-03-02' GROUP BY type";

$resultt = mysqli_query($conn, $sqlt);

$no_of_userst = 0;

while($rowt = mysqli_fetch_assoc($resultt)){
$meal_typet = "lunch";
 if($rowt['type'] == '1'){
    $meal_typet = "dinner";
 }
 $userst = explode(",", $rowt['users']);
 $no_of_userst = count($userst);
 $total_pricet = $rowt['total_price'];
}


?>
<?php 

// for statastics

$sql = "SELECT type, GROUP_CONCAT(users) AS users, SUM(price) AS total_price, price FROM meal
WHERE date >= '2023-03-01' AND date <= '2023-03-07' GROUP BY type";

$result = mysqli_query($conn, $sql);
$data = array();

$no_of_users = 0;
$total_price = 0;

while($row = mysqli_fetch_assoc($result)){
$meal_type = "lunch";
 if($row['type'] == '1'){
    $meal_type = "dinner";
 }
 $users = explode(",", $row['users']);
 $no_of_users += count($users);

 $data = array(
   'meal_type' => $meal_type,
   'no_of_users' => $no_of_users,
   'total_price' => $total_price
 );
}

$total_price = $no_of_users * 50;

?>

<?php

// for chart

$week_start = date('Y-m-d', strtotime('last Monday'));
$week_end = date('Y-m-d', strtotime('next Sunday'));

// Query to get the user data for the week
$sqlg = "SELECT date, type, users AS total_users FROM meal 
WHERE date >= '2023-03-01' AND date <= '2023-03-07' GROUP BY date, type";

$resultg = mysqli_query($conn, $sqlg);

// Prepare the data for the chart
$datag = array();
$labelsg = array();

while ($rowg = mysqli_fetch_assoc($resultg)) {
$dateg = $rowg['date'];
$meal_typeg = "lunch";
if ($rowg['type'] == "1") {
    $meal_typeg = "dinner";
}
$usersg = explode(",", $rowg['total_users']);
$total_usersg = count($usersg);

$datag[$meal_typeg][] = $total_usersg;
if (!in_array($dateg, $labelsg)) {
    $labelsg[] = $dateg;
}
}

// Convert the data to JSON format
$data_jsong = json_encode($datag);
$labels_jsong = json_encode($labelsg);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/report.css" rel="stylesheet">
</head>

<body>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Sales <span>| Yesterday</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $no_of_userst; ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Week</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-rupee"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo $total_price; ?> &#8377;</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Customers <span>| This Week</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo $no_of_users; ?> </h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>

    <section class="section">
    <div class="row">

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
          <h5 class="card-title">Reports <span>/This week</span></h5>
            <div style="min-height: 400px;" class="echart">
        <canvas id="user-chart" ></canvas>
    </div>

            <script>
              var config = {
            type: 'line',
            data: {
                labels: <?php echo $labels_jsong; ?>,
                datasets: [
                    {
                        label: 'Lunch Users',
                        data: <?php echo json_encode($datag['lunch'] ?? []); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: 'Dinner Users',
                        data: <?php echo json_encode($datag['dinner'] ?? []); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Weekly User Report'
                },
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'MMM D'
                            }
                        }
                    }],
yAxes: [{
ticks: {
beginAtZero: true
                }
            }]
        }
    }
};

var ctx = document.getElementById('user-chart').getContext('2d');
    var myChart = new Chart(ctx, config);

            </script>

          </div>
        </div>
      </div>
    </div>
</section> 


</body>
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>