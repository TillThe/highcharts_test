<?php

function formStartData() {
  global $db;

  $sql = $db->query("SHOW FIELDS FROM data_table");
  $data = $sql->fetch_all(MYSQLI_ASSOC);

  $result = array('category' => '', 'value' => '');

  foreach ($data as $key => $arr) {
    if ($arr['Type'] === 'int(15)' || $arr['Type'] === 'varchar(255)') {
      $result['category'] .= "<option value='{$arr['Field']}'>{$arr['Field']}</option>";
    }
    if ($arr['Type'] === 'int(15)') {
      $result['value'] .= "<option value='{$arr['Field']}'>{$arr['Field']}</option>";
    }
  }

  return $result;
}

function formJS($data) {
  global $graphs;
  
  $data['js'] = "
    let yTitle = '{$_POST['value']}',
      xTitle = '{$_POST['category']}',
      columns = [],
      arr = JSON.parse('" . json_encode($data['columns']) . "');
  ";

  if ($_POST['graph'] == 'pie') {

    $data['js'] .= "
      for (let key in arr) {
        columns.push({name: key, y: arr[key]});
      };
    ";
    $data['js'] .= $graphs['pie'];

  } else {

    $data['js'] .= "
      for (let key in arr) {
        columns.push({name: key, data: [arr[key]]});
      };
    ";
    $data['js'] .= $graphs['columnar'];

  }

  $data['js'] .= "
  window.onresize = function() {

    if (document.documentElement.clientWidth < 440) {
      graph.setSize(280, 200);
      document.getElementById('graph').style.width = '280px';
      document.getElementById('graph').style.height = '200px';
    } else {
      graph.setSize(400, 300);
      document.getElementById('graph').style.width = '400px';
      document.getElementById('graph').style.height = '300px';
    }

  }
  ";
  return $data['js'];
}
