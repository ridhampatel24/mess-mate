<?php

require 'database/include.php';

if ($_SESSION['user_type'] != 'admin') {
  header('location: login.php');
  exit();
}

$sql = "SELECT * FROM meal";
$result = mysqli_query($conn, $sql);
$file = fopen("data.csv", "w");
fputcsv($file, array("Date", "Lunch/Dinner","users","user count","Menu","Revenu","Wastage Plate","Wastage Amount"));


while ($row = mysqli_fetch_assoc($result)) {
    if ($row['type'] == '0') {
        $row['type'] = 'Lunch';
    } else {
        $row['type'] = 'Dinner';
    }

    if($row['items'] != NULL){
      $items = explode('||', $row['items']);
    }
    $items = implode(',', $items);
    $row['items'] = $items;
    $cnt = sizeof(explode(',', $row['users']));
    $revenu  = $row['price'] * $cnt;
    fputcsv($file, array($row['date'], $row['type'], $row['users'],$cnt,$row['items'], $revenu,$row['wastage_user'],$row['wastage_user']*$row['price']));
}

$file = "data.csv";

if (file_exists($file)) {
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($file).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($file));
  readfile($file);
  exit;

} else {
  echo "File not found";
}

fclose($file); 


mysqli_close($conn);

?>