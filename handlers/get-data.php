<?php
require('../config/db.php');
require('../service/functions.php');
require('../service/graphs.php');

$sql_data = array();

$query = "SELECT {$_POST['category']}, {$_POST['value']} FROM data_table";
if ($sql = $db->query($query)) {
  $sql_data = $sql->fetch_all(MYSQLI_ASSOC);
}

$data['columns'] = array();
$data['titles'] = array('xTitle' => $_POST['category'], 'yTitle' => $_POST['value']);
foreach ($sql_data as $arr) {
  if (!array_key_exists($arr[$_POST['category']], $data['columns'])) {
    $data['columns'][$arr[$_POST['category']]] = (int) $arr[$_POST['value']];
  } else {
    $data['columns'][$arr[$_POST['category']]] += (int) $arr[$_POST['value']];
  }
}


$data['js'] = formJS($data);

echo json_encode($data);
