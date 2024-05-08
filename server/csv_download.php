<?php
// include('db.php');
$name = $_POST['name'];
$balance = $_POST['balance'];
$status = $_POST['status'];

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="AllPlayers.csv"');
$csvdata[] = array('Name','Balance','Status');
for ( $i=0;$i<count($name);$i++){
    $csvdata[]= array($name[$i],$balance[$i],$status[$i]);
}
$fp = fopen('php://output', 'wb');
foreach ( $csvdata as $line ) {
    fputcsv($fp, $line, ',');
}
fclose($fp);

?>