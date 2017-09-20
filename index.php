<?php
require('config/db.php');
require('service/functions.php');

$data = formStartData();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vigo</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.src.js"></script>
  <script src="js/script.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="page-title">Highcharts</h1>
    <section class="content">
      <form class="form" action="handlers/get-data.php" method="post">
        <div class="select-block">
          <label>Категория:
            <select name="category" id="">
              <?php echo $data['category']; ?>
            </select>
          </label>
        </div>
        <div class="select-block">
          <label>Значение:
            <select name="value" id="">
              <?php echo $data['value']; ?>
            </select>
          </label>
        </div>
        <div class="select-block">
          <label>Тип диаграммы:
            <select name="graph">
              <option value="columnar">Столбчатая диаграмма</option>
              <option value="pie">Круговая диаграмма</option>
            </select>
          </label>
        </div>
        <input class="btn btn-build" type="submit" value="Построить график">
      </form>
      <div class="graph" id="graph">

      </div>
    </section>

  </div>
</body>
</html>
