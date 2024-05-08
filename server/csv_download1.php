<?php
// include('db.php');
$name = $_POST['name'];
$balance = $_POST['balance'];
$status = 'outstanding';
// var_dump($name);die;
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Players with status balance outstanding.csv"');
$csvdata[] = array('Name','Balance','Status');
for ( $i=0;$i<count($name);$i++){
    $csvdata[]= array($name[$i],$balance[$i],'outstanding');
}
$fp = fopen('php://output', 'wb');
foreach ( $csvdata as $line ) {
    fputcsv($fp, $line, ',');
}
fclose($fp);

?>