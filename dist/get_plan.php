<?php
  // 画面から送られたきた値
  $title = "test";	// $_POST['id']とも書ける
  $color = "#257e4a";
  $start = $_GET['start'];
  $end = $_GET['end'];


  $list = array(array("title" => $title, "start" => $start, "end" => $end, "color" => $color));
  // 明示的に指定しない場合は、text/html型と判断される
  header("Content-type: application/json; charset=UTF-8");
  //JSONデータを出力
  echo json_encode($list);
?>